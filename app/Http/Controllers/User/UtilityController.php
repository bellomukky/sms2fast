<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PinNumber;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use App\Log;
use App\Group;
use App\Contact;

class UtilityController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
    public function buySMS()
    {
        return view('user.sms.buy_sms');
    }

    public function verifySMSToken(Request $request)
    {
        $request->validate([
            'card_number'=>'required|min:13|max:13'
        ]);
        $client = Auth::user();
 
		if(!$request->session()->exists('card_entry_attempt'))
		{
			$request->session()->put('card_entry_attempt',0);
		}
		$pin_number = PinNumber::where('card_number',$request->card_number)->first();
		if($pin_number == null)
		{
			$tries = $request->session()->get('card_entry_attempt');
			$request->session()->put('card_entry_attempt',$tries);
			if($request->session()->get('card_entry_attempt') == 3)
			{
				$client->active = 2;
				$client->save();
				Auth::logout();
				return redirect(route('login'))->withInput()->with(['error'=>'Your account has been deactivated. 
				Please contact administrator']);
			}
			else
			{	
				return redirect()->back()->withInput()->with(['error'=>'The card number you have 
				entered is not valid!']);
			}
		}else{
			if($pin_number->status == 1)
			{
				if($client->id == $pin_number->used_by)
				{
					return redirect()->back()->withInput()->with(['error'=>'The card has been used by You. 
					Please contact administrator for more information']);
				}
				else
				{
						return redirect()->back()->withInput()->with(['error'=>'The card has been used. 
					Please contact administrator for more information']);
				}
			
			}else{

				//get the card denomination
				$card_denomination = $pin_number->card_denomination;
				//divide the card denomination by 4 and credit the user
				$credit_bought = ceil($card_denomination/$pin_number->rates);		
				//credit account of user
				$initial_balance = $client->available_sms;
	
				$pin_number->status = 1;
				$pin_number->date_used = date("Y-m-d",time());
				$pin_number->used_by = $client->id;
				$pin_number->save();

				$client->available_sms += $credit_bought;
				$client->cumm_sms += $credit_bought;
				$client->save();
				
				$log = new Log();
				$log->resellerId = 0;
				$log->logType = 1;
				$log->message = "Purchase";
				$log->clientId = $client->id;
				$log->dateDone = time();
				$log->previousBalance = $initial_balance;
				$log->used = $credit_bought;
				$log->newBalance = $client->available_sms;
				$log->save();

				return redirect(route('buy.sms'))->with(['message'=>'Your recharge of '
				.number_format($card_denomination,2).' naira  was successful. 
				You now have  '.($initial_balance+$credit_bought).' credits. Thank you for choosing us']);
					
			}
		}	
    }


    public function transferCredit()
    {
        return view('user.sms.transfer_credits');
	}
	
	function postTransferCredit(Request $request)
	{
		$request->validate([
			'recipients'=>'required',
			'credit_unit'=>'required|numeric'
		]);
		$client = Auth::user();
		
		$recipients = explode(",",$request->recipients);
		$valid_recipients=[];
		$reg = "/^[a-z0-9_\+-]+(\.[a-z0-9_\+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*\.([a-z]{2,4})*$/"; 
		$message ="";
		$report = "";
		$ntindb = "";
		//get valid recipient
		foreach($recipients as $recipient)
		{
			if(!preg_match($reg,$recipient))
			{
				$message.=$recipient.", ";
			}
			else if(strcmp($client->email,$recipient)==0)
			{
				$message.="You cannot send credit to your self at $recipient<br>";
				continue;
			}
			else if(count(Client::where('email',$recipient)->get()) == 0)
			{
				$ntindb.=$recipient."<br>";
			}else
			{
				array_push($valid_recipients,$recipient);
			}
		}//close for loop
		
		if(!empty($message) || !(empty($ntindb)))
		{

			if(!empty($message)){
				
				$report ="The following email(s) is/are invalid<br>".$message."<br>";
			}
			if(!empty($ntindb))
			{
				
				$report .="The following email(s) do not exist<br>".$ntindb;
			}

			return redirect()->back()->withInput()->with(['error'=>$report]);
		}else
		{
			//remove duplicate from the array
			$valid_recipients = array_unique($valid_recipients);
			//count the number of credit to be sent
			$total_credit = $request->credit_unit * count($valid_recipients);
			if($total_credit > $client->available_sms)
			{
				return redirect()->back()->withInput()->with(['error'=>'The credit specified will not go round for 
				the recipients. try reducing the number of recipients or recharge your account']);
			}
			else
			{
				
				$client_prev = $client->available_sms;
				foreach($valid_recipients as $email)
				{
					$recipient = Client::where('email',$email)->first();
					$prev_balance = $recipient->available_sms;
					$recipient->available_sms +=$request->credit_unit;
					$recipient->cumm_sms += $request->credit_unit;
					$recipient->save();
					

					$log = new Log();
					$log->logType = 2;
					$log->message = "Transfer From".$client->email;
					$log->dateDone = time();
					$log->clientId = $recipient->id;
					$log->transferredTo = $recipient->id;
					$log->transferredBy = $client->id;
					$log->previousBalance = $prev_balance;
					$log->used = $request->credit_unit;
					$log->newBalance = $recipient->available_sms;
					$log->save();

					
					$log = new Log();
					$log->logType = 2;
					$log->message = "Transfer to".$recipient->email;
					$log->dateDone = time();
					$log->clientId = $client->id;
					$log->transferredTo = $recipient->id;
					$log->transferredBy = $client->id;
					$log->previousBalance = $client_prev;
					$log->used = $total_credit;
					$log->newBalance = $client->available_sms;
					$log->save();
				
				}//close for each loop
				$client->available_sms -= $total_credit;
				$client->cumm_sms -= $total_credit;
				$client->save();
				return redirect(route('transfer.credit'))->withMessage('You have successfully 
				transferred ('.$request->credit_unit.') credits to <br>'.implode(',',$valid_recipients));
			}
		}//close else loop
		
	}
}
