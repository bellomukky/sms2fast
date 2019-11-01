<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PinNumber;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use App\Log;
use App\Models\Api;
use App\Group;
use App\Contact;
use GuzzleHttp\Exception\GuzzleException;
use App\Models\SMSUtilities;
use DB;



class SMSController extends Controller
{

	protected $schedule_timestamp = null;
	protected $message;
	protected $formatted_sender;
	protected $total_unit_required;
	protected $formatted_numbers;


	public function __construct()
	{
		$this->middleware('auth');
	}

    public function composeSMS()
    {
		$groups = Group::where('client_id',Auth::user()->id)->select(['id','group_name'])->get();
		
        return view('user.sms.send_sms',compact('groups'));
	}

	public function sendSMS(Request $request) {

		$request->validate([
			'sender_id'=>'required',
			'message'=>'required',
			'recipients'=>'required',
			'message_type'=>'required'
		]);
		
		$client = Auth::user();
		$this->message = $this->formatMessage($request->message);
		$this->formatted_sender = $this->formatSNR($request->sender_id);

		$router = new SMSUtilities($request->recipients,'','');
		$router->splitRawStringedRecipients();
		$router->formatInternationalNumbers();
		$router->ValidatePhoneNumber();
		$router->removeDuplicateNumbers();
		$router->removeCDMAs();
		
		$this->formatted_numbers = $router->getTempArray();
		
		$availableSMS = $client->available_sms;
		//$resellerBalance = $this->getResellerBalance();
		$previous_unit_balance = $client->available_sms;
		$this->total_unit_required = $this->getTotalUnitsRequired();

		if ($availableSMS < $this->total_unit_required) {
			return redirect()->back()->withInput()->with(['error'=>'<b>Oosp! :</b>You have 
			insufficient balance. You need ' . ($this->total_unit_required - $available_sms) .
			 ' credits more for this transaction']);
		} else {

			$in = str_replace("'","",$this->message);
			$id = DB::table('smpp_reseller')->insertGetId([
				'message'=>$in,
				'unit_used'=>$this->total_unit_required,
				'transac_date'=>time(),
				'client_id'=>$client->id,
				'sender_id'=>$this->formatted_sender,
				'previous'=>$client->available_sms,
				'new_balance'=>$client->available_sms-$this->total_unit_required
			]);

			//$s denote success $f denotes failed
			$s = 0;
			$f = 0;
			$api = Api::all()->first();
			
			$apiurl = $api->api_url;
			$apiusername = $api->api_username;
			$apipassword = $api->api_password;
			
			$valid_reciepients = array();
			$regex = "/[+]234[87][0-9]{9}/";
			$regex2 = "/.*[0-9]$/"; // ends with a number
			foreach($this->formatted_numbers as $recipient)
			{
				// recipients starts with + and ends with a number
				if(substr($recipient,0,1) == "+" && preg_match($regex2,$recipient)) 
				{
					if(substr($recipient,0,4) == "+234")
					{
						if(preg_match($regex,$recipient))
						array_push($valid_reciepients,$recipient);
					}
					else
					{
						array_push($valid_reciepients,$recipient);
					}
				}
			}

			$valid_reciepients = array_unique($valid_reciepients);
			$count = 0;
			$number = "";
			$real_units = 0;
			
			while($count < count($valid_reciepients))
			{
				$number = $number.$valid_reciepients[$count].",";	
				$count++;
				if($count%20 ==0)
				{
					//remove trailing comma
					$number = substr_replace($number,"",-1,1);
					if ($this->send_message( $this->formatted_sender,$number,
					$id,$this->message,7,$apiurl, $apiusername,
					 $apipassword,$this->schedule_timestamp,$request->message_type  )) 
					{
						$s += 20;
						//Deduct credit used
						$units = $this->getTotalUnitsNeeded($number);
						$real_units += $units;
						$client->available_sms -= $units;
						$client->save();
					} 
					else 
					{
						$f += 20;
					}
					unset($number);
					continue;
				}
			}
			//send if less than 20 
			
			if($number && $count%20 != 0)
			{
				$number = substr_replace($number,"",-1,1);
				if ($this->send_message($this->formatted_sender,$number,$id, $this->message, 7,
				 $apiurl, $apiusername, $apipassword,$this->schedule_timestamp,$request->message_type)) 
				{
					$units = $this->getTotalUnitsNeeded($number);
					$real_units += $units;
					$client->available_sms -= $units;
					$client->save();
					
				} 
				else 
				{
					$f += count(explode(",",$number));
				}
				unset($number);
			}
			
			$tot = count(explode(",",$_POST['recipients']));
			DB::table('sms_transactions')->insertGetId([
				'total_no'=>$tot,
				'total_unknown'=>$router->getTotalUnknown(),
				'total_duplicate'=>$router->getTotalDuplicate(),
				'total_failed'=>$f,
				'total_sent'=>$s,
				'client_id'=>$client->id,
				'date_sent'=>time(),
				'sms_length'=>$this->determineMessageLength(),
				'sms_deducted'=>$real_units,
				'message_id'=>$id,
				'complete_no'=>$request->recipients
			]);

			if ($request->is_schedule != "") {
				return redirect()->back()->with(['message'=>"SMS successfully scheduled for ".date( "l jS M Y g:i a", $this->schedule_timestamp)]);
			} else {				
				return redirect()->back()->with(['message'=>"$s SMS sent successfully"]);
			}
		}

	
	}
		
	
	
	public function getTotalUnitsNeeded($numbers) {
		$numbers = explode(",",$numbers);
		$units = 0;
		foreach ( $numbers as $number ) {
			$units += $this->determineCreditToBeRemoved ($number);
		}
		return $units;
	}
	public function formatPhoneNumbers($recipients) {
		
		$recipients = $recipients;
		//define an array
		$unique = array ();
		
		//explode the phone numbers into an array
		$phones = explode ( ",", $recipients );
		
		//remove duplicates
		$phones = array_unique ( $phones );
		
		//further remove white spaces.
		$phones = $this->remove_element ( $phones, "" );
		
		//add the +234 tingi
		foreach ( $phones as $phone ) {
			//trim white spaces
			$phone = trim ( $phone );
			//remove CDMAs
			if (substr ( $phone, 0, 3 ) == '819' || substr ( $phone, 0, 4 ) == '0709'||substr ( $phone, 0, 7 )=='+234709' ||substr ( $phone, 0, 4 ) == '0804' || substr ( $phone, 0, 7 )=='+234804' || substr ( $phone, 0, 5 ) == "07023" || substr ( $phone, 0, 4 ) == "0707" || strlen ( $phone ) <= 9 || substr ( $phone, 0, 4 ) == "0819" || substr ( $phone, 0, 5 ) == "07027" || substr ( $phone, 0, 5 ) == "07026" || substr ( $phone, 0, 4 ) == "0704" || substr ( $phone, 0, 4 ) == "0702" || substr ( $phone, 0, 3 ) == "702"){
				$_SESSION ['not_supported'] = $phone . "<br>"; 
				continue;
			} 

			else if (substr ( $phone, 0, 4 ) == "+234") {
				//$phones = substr_replace ( $phone, '', 0, 1 );
				array_push ( $unique, $phone );
			} else if (substr ( $phone, 0, 3 ) == "234") {
				$phones = "+" . $phone;
				array_push ( $unique, $phones );
			} 

			else if (substr ( $phone, 0, 1 ) == "8" || substr ( $phone, 0, 1 ) == "7") {
				$phone = "+234" . $phone;
				array_push ( $unique, $phone );
			} 

			else if (substr ( $phone, 0, 1 ) == "0") {
				$phone = substr_replace ( $phone, '+234', 0, 1 );
				array_push ( $unique, $phone );
			} else {
				array_push ( $unique, $phone );
			}
		}
		
		//be sure there is no cdma : +234702, +234704, +234707, +234709
		$uniqued = array ();
		foreach ( $unique as $phone ) {
			if (substr ( $phone, 0, 8 ) == "+2347027" || substr ( $phone, 0, 7 ) == "+234707" || substr ( $phone, 0, 8 ) == "+2347023" || substr ( $phone, 0, 7 ) == "+234819") {
				continue;
			} else {
				array_push ( $uniqued, $phone );
			}
		}
		
		//Now that all CDMA is removed, we now need to remove duplicates again
		//remove duplicates
		$phones = array_unique ( $uniqued );
		
		//further remove white spaces.
		$phones = $this->remove_element ( $phones, "" );
		//remove +234
		$phones = $this->remove_element ( $phones, "+234" );
		
		//Now we now implode the array to a string
		
		$this->setFormatedNumbers($phones);
		return $phones;
	
	}
	
	public function formatSNR($brand) {
		$sender_id = $brand;
		if (is_numeric($sender_id)) {
			if (strlen ( $sender_id ) == 11) {
				$sender_id = substr_replace ( $sender_id, '234', 0, 1 );
				return $sender_id;
			}
			if (strlen ( $sender_id ) == 10) {
				$sender_id = '234' . $sender_id;
				return $sender_id;
			}
		
		}
		return $sender_id;
	}
	

	function formatMessage($message){
		$me = str_replace ( "\r", "", $message );
		$message = mb_convert_encoding ( $me, "7bit", "utf-8" );
		return $message;
	}
	function determineMessageLength() {
		$message = $this->message;
		$length = strlen ( $message );
		if ($length <= 160) {
			return 1;
		} else {
			return ceil ( $length / 153 );

		}
	}
	function determineCreditToBeRemoved($number) {
		$messagelength = $this->determineMessageLength ( $this->formatMessage ( $this->message));
		$substr = substr ( $number, 0, 7 );
		switch ($substr) {
			case "+234803" :
				return 1.5 * $messagelength;
				break;
			case "+234806" :
				return 1.5 * $messagelength;
				break;
			case "+234813" :
				return 1.5 * $messagelength;
				break;
			case "+234703" :
				return 1.5 * $messagelength;
				break;
			case "+234706" :
				return 1.5 * $messagelength;
				break;
			case "+234810" :
				return 1.5 * $messagelength;
				break;
            			case "+234816" :
				return 1.5 * $messagelength;
				break;
			case "+234903" :
				return 1.5 * $messagelength;
				break;
			case "+234814" :
				return 1.5 * $messagelength;
				break;	
			
			/* ZAIN Prefixes */
			
			case "+234802" :
				return 1 * $messagelength;
				break;
			case "+234808" :
				return 1 * $messagelength;
				break;
			case "+234812" :
				return 1 * $messagelength;
				break;
            		case "+234708" :
				return 1 * $messagelength;
				break;
			case "+234701" :
				return 1 * $messagelength;
				break;	
			case "+234902" :
				return 1 * $messagelength;
				break;
			case "+234818" :
				return 1 * $messagelength;
				break;
				
			/* GLO Prefixes */
			
			case "+234805" :
				return 1 * $messagelength;
				break;
			case "+234807" :
				return 1 * $messagelength;
				break;
			case "+234705" :
				return 1 * $messagelength;
				break;
			case "+234815" :
				return 1 * $messagelength;
				break;
			case "+234811" :
				return 1 * $messagelength;
				break;	
			
			/* ETISALAT Prefixes */
			
			case "+234809" :
				return 1 * $messagelength;
				break;
				
			case "+234818" :
				return 1 * $messagelength;
				break;
			case "+234817" :
				return 1 * $messagelength;
				break;
			case "+234909" :
				return 1 * $messagelength;
				break;
			
			/* CDMA AND INTERNATIONAL prefixes */
			default :
				return 5 * $messagelength;
		
		}
	}
	
	function getTotalUnitsRequired() {
		$numbers = $this->formatted_numbers;
		$units = 0;
		foreach ( $numbers as $number ) {
			$units += $this->determineCreditToBeRemoved ( $number );
		}
		return $units;
	}

	function send_message($from, $to, $id, $message, $track_delivery, $apiurl, $apiusername, $apipassword,$sch,$flash) {
		
		$url = $apiurl;
		$data = array ("receiver" => $to, "sender" => "08119974190", "schedule" => $sch, "message" => $message,"flash" => $flash, "user" => $apiusername, "pass" => $apipassword, "mid" => $id  );
	
		foreach ( $data as $key => $val ) {
			$url .= "&{$key}=".urlencode($val);
		}
	
		$client = new \GuzzleHttp\Client();
		$request = $client->post($url);
		$response = json_decode($request->getBody()->getContents());


		if($response=="" || $response>0) {
			return true;
		}
		return false;
		
	}
	
	protected function remove_element($arr, $val)
	{
		foreach ($arr as $key => $value)
		{
			if ($arr[$key] == $val)
			{
				unset($arr[$key]);
			}
		}
		return $arr = array_values($arr);
	}


    
	public function getContact(Request $request)
	{
		$request->validate([
			'id'=>'required'
		]);
		try{
			$contacts = Contact::select('phone_number')->where('group_id',$request->id)->get();
			$recipients = array();
			
			foreach($contacts as $contact)
			{
				array_push($recipients,$contact->phone_number);
			}
			echo implode(", ",$recipients);
		}catch(\Exception $ex)
		{
			return null;
		}
	}

    public function smsLog()
    {
        $logs = [];
        return view('user.sms.sms_logs',compact('logs'));
    } 
}
