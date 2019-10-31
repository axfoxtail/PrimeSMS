<?php

namespace App\Http\Controllers\Admin;

use App\Coverage;
use App\GeneralSetting;
use App\Plan;
use App\SmsGateway;
use App\SmsLog;
use App\SupportMessage;
use App\SupportTicket;
use App\Transaction;
use App\User;
use Auth;
use App\Admin;
use Illuminate\Support\Facades\Hash;
use Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class AdminController extends Controller
{
    public function index(){
        $users = User::count('id');
        $routes = Coverage::where('status', 1)->count('id');
        $gateways = SmsGateway::where('status', 1)->count('id');
        $supports = SupportTicket::where('status', '!=', 4)->count('id');
        $lastTransactions = Transaction::latest()->take(5)->get();
        $lastsupports = SupportTicket::latest()->take(5)->get();
        $monthTrans =  Transaction::whereYear('created_at', '=', date('Y'))->get()->groupBy(function($d) {
            return $d->created_at->format('F');
        });
        $monthly_trans = [];
        $js = '';
        foreach ($monthTrans as $key => $value) {
            $js .= collect([
                    'y' => $key,
                    'a' => count($value)
                ])->toJson() . ',';

        }
        $monthly_trans = '[' . $js . ']';

        $monthSmss =  SmsLog::whereYear('created_at', '=', date('Y'))->where('status', 'success')->get()->groupBy(function($d) {
            return $d->created_at->format('F');
        });
        $monthly_sms = [];
        $jss = '';
        foreach ($monthSmss as $key => $value) {
            $jss .= collect([
                    'label' => $key,
                    'value' => count($value)
                ])->toJson() . ',';

        }
        $monthly_sms = '[' . $jss . ']';

        return view('admin.index', compact('users', 'routes', 'gateways', 'supports', 'lastTransactions', 'lastsupports', 'monthly_trans', 'monthly_sms'));
    }

    public function password(){
        return view('admin.password');
    }

    public function passwordChange(Request $request){
        $user = Admin::findOrFail(Auth::guard('admin')->user()->id);
        $this->validate($request,[
            'cur_pass' => 'required',
            'new_pass' => 'required|min:5',
            'con_pass' => 'required',
        ],
            [
                'cur_pass.required' => 'Current Password must not be empty',
                'new_pass.required' => 'New Password must not be empty',
                'new_pass.min' => 'New Password must be at least 5 characters',
                'con_pass.required' => 'Confirm Password must not be empty',
            ]);
        if (Hash::check($request->cur_pass, $user->password)) {
            if ($request->new_pass == $request->con_pass) {
            $user->password = Hash::make($request->new_pass);
            $user->save();
            session()->flash('success', 'Password Updated Successfully');
            return back();
            } else {
                session()->flash('alert', 'New Password and Confirm Password did not match');
                return back();
            }
        } else {
            session()->flash('alert', 'Invalid Current Password');
            return back();
        }
    }

    public function plan(){
        $items = Plan::orderBy('min', 'ASC')->paginate(10);
        return view('admin.plan', compact('items'));
    }

    public function planStore(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:plans,name',
            'price' => 'required',
            'min' => 'required',
            'max' => 'required',
            'validity' => 'required',
            'support' => 'required',
        ], [
            'min.required' => 'minimum amount is required',
            'max.required' => 'maximum amount is required',
        ]);
        $excp = $request->except('_token', 'status');
        $status = $request->status == 1? 1:0;
        Plan::create($excp + ['status' => $status]);
        session()->flash('success', 'Plan Stored successfully');
        return back();
    }

    public function planUpdate(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'min' => 'required',
            'max' => 'required',
            'validity' => 'required',
            'support' => 'required',
        ], [
            'min.required' => 'minimum amount is required',
            'max.required' => 'maximum amount is required',
        ]);
        $excp = $request->except('_token', 'status');
        $status = $request->status == 1? 1:0;
        Plan::findOrFail($id)->update($excp + ['status' => $status]);
        session()->flash('success', 'Plan Updated successfully');
        return back();
    }

    public function dbBackup(){
        return view('admin.db');
    }

    public function dbdownload(){
        if(Auth::guard('admin')->check()){
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            $host = Config('database.connections.mysql.host');
            $user = Config('database.connections.mysql.username');
            $pass = Config('database.connections.mysql.password');
            $database = Config('database.connections.mysql.database');
            $dir = dirname('assets/admin/upload') . '/'.$database.'backup'.time().'.sql';
            exec("mysqldump --user={$user} --password={$pass} --host={$host} {$database} --result-file={$dir} 2>&1", $output);
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($dir));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($dir));
            ob_clean();
            flush();
            readfile($dir);
            @unlink($dir);
        }else{
            return redirect()->route('404');
        }
    }

    public function supportTicket()
    {
        $items = SupportTicket::orderBy('id', 'DESC')->paginate(15);
        return view('admin.support.tickets', compact('items'));
    }

    public function pendingSupportTicket()
    {
        $items = SupportTicket::whereIN('status', [0, 2])->orderBy('id', 'DESC')->paginate(15);
        return view('admin.support.pendingTickets', compact('items'));
    }

    public function ticketReply($id)
    {
        $ticket = SupportTicket::findOrFail($id);
        $messages = SupportMessage::where('supportticket_id', $ticket->id)->get();
        return view('admin.support.reply', compact('ticket', 'messages'));
    }

    public function ticketReplySend(Request $request, $id)
    {
        $ticket = SupportTicket::findOrFail($id);
        $message = new SupportMessage();
        if ($request->replayTicket == 1) {
            $this->validate($request,
                [
                    'message' => 'required',
                ]);
            $ticket->status = 1;
            $ticket->save();

            $message->supportticket_id = $ticket->id;
            $message->type = 2;
            $message->message = $request->message;
            $message->save();
            session()->flash('success', 'Support ticket replied successfully');
        } elseif ($request->replayTicket == 2) {
            $ticket->status = 3;
            $ticket->save();
            session()->flash('success', 'Support ticket closed successfully');
        }
        return back();
    }

    public function coverage(){
        $items = Coverage::orderBy('country', 'ASC')->paginate(10);
        return view('admin.coverage', compact('items'));
    }

    public function coverageStore(Request $request){
        $this->validate($request, [
            'country' => 'required|unique:coverages,country',
            'code' => 'required|unique:coverages,code',
            'sms_charge' => 'required',
        ]);
        $item = new Coverage();
        $item->country = $request->country;
        $item->code = $request->code;
        $item->sms_charge = $request->sms_charge;
        $item->len = strlen($request->code);
        $item->status = $request->status == 1 ? 1 : 0;
        $item->save();
        session()->flash('success', 'Routing save successfully');
        return back();
    }

    public function coverageEdit(Request $request, $id){
        $item = Coverage::findOrFail($id);
        $item->country = $request->country;
        $item->code = $request->code;
        $item->sms_charge = $request->sms_charge;
        $item->len = strlen($request->code);
        $item->status = $request->status == 1 ? 1 : 0;
        $item->save();
        session()->flash('success', 'Routing updated successfully');
        return back();
    }

    public function coverageDelete($id){
        Coverage::findOrFail($id)->delete();
        session()->flash('success', 'Routing deleted successfully');
        return back();
    }

    public function smsGateway(){
        $items = SmsGateway::orderBy('name', 'ASC')->paginate(10);
        return view('admin.smsGateway', compact('items'));
    }

    public function smsGatewayEdit(Request $request, $id){
        $item = SmsGateway::findOrFail($id);
        $item->val1 = $request->val1;
        $item->val2 = $request->val2;
        $item->val3 = $request->val3;
        $item->status = $request->status =="1" ?1:0 ;
        $item->save();
        session()->flash('success', 'SMS gateway updated successfully');
        return back();
    }

    public function userIndex()
    {
        $users = User::orderBy('id', 'desc')->paginate(15);
        $pt = 'USER LIST';
        return view('admin.users.index', compact('users','pt', 'spent'));
    }

    public function userSearch(Request $request)
    {
        $this->validate($request, [ 'search' => 'required' ]);

        $users = User::where('username', 'like', '%' . $request->search . '%')->orWhere('email', 'like', '%' . $request->search . '%')->orWhere('name', 'like', '%' . $request->search . '%')->paginate(10);
        $key = $request->search;
        return view('admin.users.search', compact('users','key'));

    }

    public function singleUser($id)
    {
        $user = User::findOrFail($id);
        $gateways = SmsGateway::where('status', 1)->orderBy('name', 'ASC')->get();
        return view('admin.users.single', compact('user', 'gateways'));
    }

    public function uerRoll($id){
        $user = User::findOrFail($id);
        if($user->roll == 0){
            $user->roll = 1;
            $user->save();
            $gnrl = GeneralSetting::first();
            $msg =  'Congratulations. you have been appointed as a reseller of '.$gnrl->title.'.';
            send_email($user->email, $user->username, 'Appointed as a Reseller', $msg);
            send_sms($user->mobile, $msg);
            return back()->with('success', $user->username.' mark as a reseller successfully');
        }else{
            session()->flash('alert', $user->username.' already a reseller');
        }
        return back();
    }

    public function userTransaction($id){
        $user = User::findOrFail($id);
        $items = Transaction::where('to_add', $id)->orWhere('from_add', $id)->latest()->paginate(10);
        if(empty($items)){
            return back();
        }else{
            return view('admin.users.singleTransaction', compact('items', 'user'));
        }

    }

    public function userSms($id){
        $user = User::findOrFail($id);
        $items = SmsLog::where('user_id', $id)->latest()->paginate(10);
        if(empty($items)){
            return back();
        }else{
            return view('admin.users.singleSms', compact('items', 'user'));
        }
    }

    public function email($id)
    {
        $user = User::findorFail($id);
        $pt = 'SEND EMAIL';
        return view('admin.users.email',compact('user','pt'));
    }

    public function sendemail(Request $request)
    {
        $this->validate($request,
            [   'emailto' => 'required|email',
                'reciver' => 'required',
                'subject' => 'required',
                'emailMessage' => 'required'
            ]);
        $to = $request->emailto;
        $name = $request->reciver;
        $subject = $request->subject;
        $message = $request->emailMessage;

        send_email($to, $name, $subject, $message);

        return back()->withSuccess('Mail Sent Successfuly');

    }

    public function broadcast()
    {
        return view('admin.users.broadcast');
    }

    public function broadcastemail(Request $request)
    {
        $this->validate($request,[ 'subject' => 'required','emailMessage' => 'required']);

        $users = User::where('status', '1')->get();

        foreach ($users as $user)
        {

            $to = $user->email;
            $name = $user->name;
            $subject = $request->subject;
            $message = $request->emailMessage;

            send_email($to, $name, $subject, $message);
        }

        return back()->withSuccess('Mail Sent Successfuly');
    }

    public function userPasschange(Request $request,$id)
    {
        $user = User::find($id);

        $this->validate($request,['password' => 'required|string|min:6|confirmed']);
        if($request->password == $request->password_confirmation)
        {
            $user->password = Hash::make($request->password);
            $user->save();

            $msg =  'Password Changed By Admin. New Password is: '.$request->password;
            send_email($user->email, $user->username, 'Password Changed', $msg);
            send_sms($user->mobile, $msg);
            return back()->with('success', 'Password Changed');
        }
        else
        {
            return back()->with('alert', 'Password Not Matched');
        }
    }

    public function userSMSBalance(Request $request, $id){
        $user = User::findOrFail($id);

        $this->validate($request,['amount' => 'required']);
        $gnl = GeneralSetting::first();
        if(isset($request->status)){
            $user->sms = $user->sms + $request->amount;
            $user->save();
            $trasaction = new Transaction();
            $trasaction->to_add = $user->id;
            $trasaction->to_bal = $user->sms;
            $trasaction->from_add = 0;
            $trasaction->from_bal = 0;
            $trasaction->amount = $request->amount;
            $trasaction->type = '1';
            $trasaction->trx = str_random(12);
            $trasaction->save();
            $msg =  $request->amount.' SMS added By Admin';
            send_email($user->email, $user->username, 'SMS balance added', $msg);
            send_sms($user->mobile, $msg);
            session()->flash('success', 'SMS Balance added successfully');
        }else{
            if($user->sms >= $request->amount){
                $user->sms = $user->sms - $request->amount;
                $user->save();
                $trasaction = new Transaction();
                $trasaction->to_add = $user->id;
                $trasaction->to_bal = $user->sms;
                $trasaction->from_add = 0;
                $trasaction->from_bal = 0;
                $trasaction->amount = $request->amount;
                $trasaction->type = '2';
                $trasaction->trx = str_random(12);
                $trasaction->save();
                $msg =  $gnl->currency_symbol.' '.$request->amount.' SMS subtracted By Admin';
                send_email($user->email, $user->username, 'SMS balance subtracted', $msg);
                send_sms($user->mobile, $msg);
                session()->flash('success', 'SMS Balance subtracted successfully');
            }else{
                session()->flash('alert', 'User SMS balance is too low to subtract');
            }
        }
        return back();
    }

    public function clientGateway(Request $request, $id){
        $user = User::findOrFail($id);
        $user->gateway = $request->gateway;
        $user->save();
        $allusers = User::where('refer_by', $id)->get();
        foreach ($allusers as $myuser){
            $newUser = User::findOrFail($myuser->id);
            $newUser->gateway = $request->gateway;
            $newUser->save();
        }
        session()->flash('success', 'SMS Gateway added successfully');
        return back();
    }

    public function statupdate(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request,
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'mobile' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'post_code' => 'required|string|max:255',
                'address' => 'required',
                'image' => 'image|mimes:jpg,png,jpeg|max:3000',
            ]);

        $user['name'] = $request->name ;
        $user['mobile'] = $request->mobile;
        $user['email'] = $request->email;
        if ($request->hasFile('image')) {
            @unlink('assets/user/upload/profile/' . $user->image);
            if ($request->image->getClientOriginalExtension() == 'jpg' or $request->image->getClientOriginalName() == 'jpeg' or $request->image->getClientOriginalName() == 'png') {
                $user->image = uniqid() . '.' . $request->image->getClientOriginalExtension();
            } else {
                $user->image = uniqid() . '.jpg';
            }
            Image::make($request->file('image')->getRealPath())->resize(300, 250)->save("assets/user/upload/profile/" . $user->image);
        }
        $user['country'] = $request->country ;
        $user['city'] = $request->city;
        $user['post_code'] = $request->post_code;
        $user['address'] = $request->address;
        $user['status'] = $request->status =="1" ?1:0;
        $user['email_verify'] = $request->email_verify =="1" ?1:0;
        $user['sms_verify'] = $request->sms_verify =="1" ?1:0;
        $user['two_step_verify'] = $request->two_step_verify =="1" ?1:0;
        $user['two_step_verification'] = 1;
        $user->save();

        $msg =  'Your Profile has been Updated by Admin';
        send_email($user->email, $user->username, 'Profile Updated', $msg);

        return back()->withSuccess('User Profile Updated Successfuly');
    }

    public function bannedUser()
    {
        $users = User::where('status', '0')->orderBy('id', 'desc')->paginate(10);
        $pt = 'BANNED USERS';
        return view('admin.users.banned', compact('users','pt'));
    }

    public function smsLog(){
        $items = SmsLog::orderBy('id', 'DESC')->paginate(10);
        return view('admin.users.SmsLogs', compact('items'));
    }

    public function transactionLogs(){
        $items = Transaction::orderBy('id', 'DESC')->paginate(10);
        return view('admin.users.transactionlogs', compact('items'));
    }

    public function sendSMS(){
        $gateways = SmsGateway::where('status', 1)->orderBy('name', 'ASC')->get();
        return view('admin.sendSMS', compact('gateways'));
    }

    public function deliverSMS(Request $request){
        $this->validate($request,[
            'from' => 'required',
            'gateway' => 'required',
            'to' => 'required',
            'message' => 'required',
        ]);
        $recipients = explode(';', $request->to);
        foreach ($recipients as $to){
            if (empty($to)) {
                continue;
            }
            if (substr($to, 0, 1) != '+') {
                $to = '+' . $to;
            }
            $coverlength = Coverage::distinct('len')->get(['len']);
            foreach ($coverlength as $coverlen) {
                $coverages = Coverage::where('status', 1)->where('len', $coverlen->len)->get();
                $tocode = substr($to, 0, $coverlen->len);
                foreach ($coverages as $cover) {
                    if ($cover->code == $tocode) {
                        $country = $cover;
                        break;
                    }
                }
            }
            if (empty($country)) {
                $smslog = new SmsLog();
                $smslog->user_id = Auth::id();
                $smslog->number = $to;
                $smslog->status = 'fail';
                $smslog->save();
                continue;
            }
                $to = $request->country.$to;
                sendSMS($to, $request->from, $request->message, $request->gateway);
                $smslog = new SmsLog();
                $smslog->user_id = 0;
                $smslog->number = $to;
                $smslog->status = 'success';
                $smslog->save();
        }
        session()->flash('success', 'SMS send successfully');
        return back();
    }
}
