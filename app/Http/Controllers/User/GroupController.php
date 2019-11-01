<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Group;
use App\Models\Client;
use App\Contact;
use File;
use DB;
class GroupController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        $client_id = Auth::user()->id; 
        $groups = Group::with('contacts')->where('client_id',$client_id)->get();
        return view('user.groups.groups',compact('groups'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'group_name'=>'required'
        ]);
         $client_id = Auth::user()->id; 
        $group = new Group();
        $group->client_id = $client_id;
        $group->group_name = $request->group_name;
        $group->save();
        return redirect(route('groups.index'))
        ->with(['message'=>"Group has been created successfully"]);
    }

    public function manageGroup($id)
    {
        $client_id = Auth::user()->id;
        $group = Group::with("contacts")->where('id',$id)->where('client_id',$client_id)->first();
        if($group == null){
            return redirect(route('user.dashboard'))->with(['error'=>'You are trying to edit wrong group']);
        }
        return view('user.groups.manage_group',compact('group'));
    }

    public function deletegroup($id)
    {
        $client_id = Auth::user()->id;
        $group = Group::with("contacts")->where('id',$id)->where('client_id',$client_id)->first();
        if($group == null){
            return redirect(route('user.dashboard'))->with(['error'=>'You are trying to delete wrong group']);
        }
       
        $group->delete();
        return redirect(route('groups.index'))->with(['message'=>'You have deleted a group successfully']);
    }

    public function editContact($id)
    {
        $contact = Contact::with('group')->where('id',$id)->first();
         if($contact == null){
            return redirect(route('user.dashboard'))->with(['error'=>'You are trying to edit wrong contact']);
        }

        return view('user.groups.edit_contact',compact('contact'));
    }

    public function updateContact($id,Request $request)
    {
        $request->validate([
            'name'=>'required',
            'phone_number'=>'required'
        ]);
        $contact = Contact::with('group')->where('id',$request->id)->first();
         if($contact == null){
            return redirect(route('user.dashboard'))->with(['error'=>'You are trying to edit wrong contact']);
        }

        $contact->name = $request->name;
        $contact->phone_number= $request->phone_number;
        $contact->save();
        return redirect(route('group.manage',$contact->group->id))
        ->with(['message'=>'You have updated '.$contact->name.' contact successfully']);
    }

    public function deleteContact($id)
    {
         $contact = Contact::with('group')->where('id',$id)->first();
         if($contact == null){
            return redirect(route('user.dashboard'))->with(['error'=>'You are trying to delete wrong contact']);
        }
        $group_id = $contact->group->id;
        $contact->delete();
        return redirect(route('group.manage',$group_id))->
        with(['message'=>'you have successfully removed a contact']);
    }

    public function uploadContact($id)
    {
         $client_id = Auth::user()->id;
        $group = Group::with('contacts')->where('id',$id)->where('client_id',$client_id)->first();
        if($group == null){
            return redirect(route('user.dashboard'))->with(['error'=>'You are trying to edit wrong group']);
        }
        return view('user.groups.upload_contact',compact('group'));
    }

    public function saveContact($id, Request $request)
    {
        $request->validate([
            'choose_contact'=>'required',
            'contacts_file'=>'required|file'
        ]);
        $client_id = Auth::user()->id;
        $group = Group::with('contacts')->where('id',$id)->where('client_id',$client_id)->first();
        if($group == null){
            return redirect(route('user.dashboard'))->with(['error'=>'You are trying to edit wrong group']);
        }
        $contacts = [];
        $extension = File::extension($request->file('contacts_file')->getClientOriginalName());
        switch ($request->choose_contact) {
            case 'txt':
                if($extension == "txt")
                {
                    $contacts = $this->contactFromText($request->file('contacts_file'),$group->id);
                    
                }
                break;
            case 'csv':
                if($extension == "csv")
                {
                    $contacts = contactFromCSV($request->file('contacts_file'),$group->id);
                }
                break;
            case 'csv':
                 if($extension == "xlsx" || $extension)
                {
                    $contacts = contactFromCSV($request->file('contacts_file'),$group->id);
                }
            break;
            default:
            
                break;
        }
       
        DB::table('contacts')->insert($contacts);
        return redirect(route('group.manage',$group->id))->with(['message'=>'You have upload '.count($contacts).' contacts successfully']);
    }

    protected function contactFromText($contact_file,$group_id)
    {
        $tmp_contacts = [];
        $insert = [];
        $file_handle = fopen($contact_file, "r");
        $reg_ex = '/^[0-9\-\(\)\/\+\s]*$/';
        while (!feof($file_handle) ) 
		{
			$data = fgets($file_handle, 1024);
			//try exploding the files
            $contact = explode("-",$data);
            
            $name = trim($contact[0]);
          
            $phone = trim($contact[1]);
			if(preg_match($reg_ex,$phone) && !empty($name))
			{
             
                 $db_contact = Contact::where('group_id',$group_id)
                 ->where('phone_number',$phone)->first();
                if($db_contact == null)
				{
                    array_push($insert,[
                        'name'=>$name,
                        'phone_number'=>$phone,
                        'group_id'=>$group_id,
                        'client_id'=>Auth::user()->id
                    ]);
                   
					
				}
			}
		}

        fclose($file_handle);
        return $insert;
    }

    protected function contactFromExcel($contacts_file,$group_id)
    {

        $data = Excel::load($path,function($reader){})->get();
        if(!empty($data) && count($data))
        {
            foreach($data as $key => $row)
            {
                $insert[] = [
                    'name'=>$name,
                    'phone_number'=>$phone,
                    'group_id'=>$group_id,
                    'client_id'=>Auth::user()->id
                ];
            }
            return $insert;
        }

        //$file_handle = fopen($contacts_file, "r");
         //$reg_ex = '/^[0-9\-\(\)\/\+\s]*$/';
		// while (!feof($file_handle) ) 
		// {
		// 	$contact = fgetcsv($file_handle, 1024);
		// 	//$ccontact[0] first name
        //     //phone number $contact[1];

		// 	if(!empty($contact[0]) && preg_match(trim($contact[1])))
		// 	{
		// 		 $db_contact = Contact::where('group_id',$group_id)
        //          ->where('phone_number',$contact[1])->first();
        //         if($db_contact)
		// 		{
		// 	    	array_push($tmp_contacts,$data);
		// 		}
		// 	}
			
			

		// }

		// fclose($file_handle);
    }

}
