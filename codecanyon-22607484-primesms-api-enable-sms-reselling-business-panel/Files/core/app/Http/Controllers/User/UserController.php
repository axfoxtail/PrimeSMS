<?php

namespace App\Http\Controllers\User;

use App\Coverage;
use App\GeneralSetting;
use App\Lib\GoogleAuthenticator;
use App\PasswordReset;
use App\Plan;
use App\SmsLog;
use App\SupportMessage;
use App\SupportTicket;
use App\Transaction;
use App\User;
use Auth;
use Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function authCheck()
    {
        if (Auth()->user()->status == '1' && Auth()->user()->email_verify == '1' && Auth()->user()->sms_verify == '1' && Auth()->user()->two_step_verification == '1') {
            return redirect()->route('user.home');
        } else {
            return view('user.authorization');
        }
    }

    public function authorization(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ], [
            'code.required' => 'Verification Code is required',
        ]);
        $user = User::find(Auth::user()->id);
        if ($user->verification_code == $request->code) {
            $user->email_verify = 1;
            $user->sms_verify = 1;
            $user->save();
            session()->flash('success', 'Your Profile has been verfied successfully');
        } else {
            session()->flash('alert', 'Verification Code Did not matched');
        }
        return back();
    }

    public function reAuthorization()
    {
        $user = User::find(Auth::user()->id);
        if (Carbon::parse($user->verification_time)->addMinutes(10) > Carbon::now()) {
            $time = Carbon::parse($user->verification_time)->addMinutes(10);
            $delay = $time->diffInSeconds(Carbon::now());
            $delay = gmdate('i:s', $delay);
            session()->flash('alert', 'You can resend Verification Code after ' . $delay . ' minutes');
        } else {
            $code = str_random(6);
            $user->verification_time = Carbon::now();
            $user->verification_code = $code;
            $user->save();
            send_email($user->email, $user->name, 'Verificatin Code', 'Your Verification Code is ' . $code);
            send_sms($user->mobile, 'Your Verification Code is ' . $code);
            session()->flash('success', 'Verification Code Send successfully');
        }
        return back();
    }

    public function check2StepAuth(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ], [
            'code.required' => 'Verification Code is required',
        ]);
        $user = User::findOrFail(Auth::id());
        $ga = new GoogleAuthenticator();
        $secret = $user->two_step_code;
        $oneCode = $ga->getCode($secret);
        $userCode = $request->code;
        if ($userCode == $oneCode) {
            $user->two_step_verification = 1;
            $user->save();
        } else {
            session()->flash('alert', 'Incorrect verification code');
        }
        return back();
    }

    public function index()
    {
        $transaction = Transaction::where('to_add', Auth::user()->id)->orWhere('from_add', Auth::id())->count('id');
        $clients = User::where('refer_by', Auth::user()->id)->count('id');
        $support = SupportTicket::where('user_id', Auth::user()->id)->where('status', '!=', 4)->count('id');
        $sms = SmsLog::where('user_id', Auth::id())->where('status', 'success')->count('id');
        $lastTransactions = Transaction::where('to_add', Auth::user()->id)->orWhere('from_add', Auth::id())->take(5)->get();
        $monthSmss = SmsLog::whereYear('created_at', '=', date('Y'))->where('status', 'success')->where('user_id', Auth::id())->get()->groupBy(function ($d) {
            return $d->created_at->format('F');
        });
        $monthly_sms = [];
        $jss = '';
        foreach ($monthSmss as $key => $value) {
            $jss .= collect([
                    'y' => $key,
                    'a' => count($value)
                ])->toJson() . ',';

        }
        $monthly_sms = '[' . $jss . ']';
        return view('user.home', compact('clients', 'transaction', 'support', 'sms', 'monthly_sms', 'lastTransactions'));
    }

    public function profile()
    {
        $item = User::findOrFail(Auth::user()->id);
        return view('user.profile', compact('item'));
    }

    public function updateProfile(Request $request)
    {
        $item = User::find(Auth::user()->id);
        $this->validate($request, [
            'name' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg|max:3000',
            'country' => 'required',
            'city' => 'required',
            'post_code' => 'required',
        ]);
        $item->name = $request->name;
        $item->mobile = $request->mobile;
        $item->address = $request->address;
        $item->country = $request->country;
        $item->post_code = $request->post_code;
        $item->city = $request->city;
        if ($request->hasFile('image')) {
            @unlink('assets/user/upload/profile/' . $item->image);
            if ($request->image->getClientOriginalExtension() == 'jpg' or $request->image->getClientOriginalName() == 'jpeg' or $request->image->getClientOriginalName() == 'png') {
                $item->image = uniqid() . '.' . $request->image->getClientOriginalExtension();
            } else {
                $item->image = uniqid() . '.jpg';
            }
            Image::make($request->file('image')->getRealPath())->resize(300, 250)->save("assets/user/upload/profile/" . $item->image);
        }
        $msg = $item->save();
        if ($msg) {
            session()->flash('success', 'Profile Updated Successfully');
        } else {
            session()->flash('alert', 'Something went wrong');
        }
        return back();
    }

    public function changePassword()
    {
        return view('user.password');
    }

    public function passwordChange(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $this->validate($request, [
            'cur_pass' => 'required',
            'new_pass' => 'required|min:6',
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

    public function smsPlans()
    {
        if (Auth::check() && Auth::user()->refer_by == 0) {
            $items = Plan::where('status', 1)->orderByRaw('min+0')->get();
            return view('user.plan', compact('items'));
        } else {
            return back();
        }
    }

    public function coverage(){
        $items = Coverage::where('status', 1)->orderBy('country')->paginate(10);
        return view('user.coverage', compact('items'));
    }

    public function sendSMS()
    {
        return view('user.sendSMS');
    }

    public function deliverSMS(Request $request)
    {
        $gnl = GeneralSetting::first();
        $user = User::findOrFail(Auth::id());
        $this->validate($request, [
            'from' => 'required',
            'to' => 'required',
            'message' => 'required',
        ]);
        $recipients = explode(';', $request->to);
        foreach ($recipients as $to) {
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
            if (empty($country->sms_charge)) {
                $sms_charge = $gnl->sms_charge;
            } else {
                $sms_charge = $country->sms_charge;
            }
            if ($user->sms >= $sms_charge) {
                if(!empty($user->gateway)){
                    $gateway = $user->gateway;
                }else{
                    $gateway = $gnl->default_gateway;
                }
                sendSMS($to, $request->from, $request->message, $gateway);
                $user->sms = $user->sms - $sms_charge;
                $user->save();
                $smslog = new SmsLog();
                $smslog->user_id = Auth::id();
                $smslog->number = $to;
                $smslog->status = 'success';
                $smslog->save();
                $trasaction = new Transaction();
                $trasaction->to_add = 0;
                $trasaction->to_bal = 0;
                $trasaction->from_add = $user->id;
                $trasaction->from_bal = $user->sms;
                $trasaction->amount = $sms_charge;
                $trasaction->type = '3';
                $trasaction->trx = str_random(12);
                $trasaction->save();
                session()->flash('success', 'SMS sent successfully');
            } else {
                session()->flash('alert', 'Insufficient balance');
                return back();
            }
        }
        return back();
    }

    public function apiDocumentation()
    {
        return view('user.apiV1');
    }

    public function generateKey()
    {
        if (Auth::check()) {
            $key = str_random(30);
            $user = User::findOrFail(Auth::id());
            $user->api_key = $key;
            $user->save();
            return $key;
        } else {
            return redirect()->route('404');
        }
    }

    public function myClients(Request $request)
    {
        if (Auth::user()->refer_by == 0 && Auth::user()->roll == 1) {
            $users = User::where('refer_by', Auth::id())->orderBy('name', 'ASC')->paginate(10);
            return view('user.users.index', compact('users'));
        } else {
            return back();
        }
    }

    public function searchClients(Request $request)
    {
        if (Auth::user()->refer_by == 0 && Auth::user()->roll == 1) {
            $this->validate($request, ['search' => 'required']);
            $key = $request->search;
            $users = User::where('refer_by', Auth::id())
                ->where(function ($query) use ($key) {
                    $query->where('username', 'like', '%' . $key . '%')->orWhere('email', 'like', '%' . $key . '%')->orWhere('name', 'like', '%' . $key . '%');
                })->orderBy('name', 'ASC')->paginate(10);
            return view('user.users.search', compact('users', 'key'));
        } else {
            return back();
        }
    }

    public function clientDetails($id)
    {
        if (Auth::user()->refer_by == 0 && Auth::user()->roll == 1) {
            $user = User::where('refer_by', Auth::id())->where('id', $id)->first();
            return view('user.users.clientDetails', compact('user'));
        } else {
            return back();
        }
    }

    public function clientTransaction($id){
        $user = User::findOrFail($id);
        $items = Transaction::where('to_add', $id)->orWhere('from_add', $id)->latest()->paginate(10);
        if(empty($items)){
            return back();
        }else{
            return view('user.users.singleTransaction', compact('items', 'user'));
        }

    }

    public function clientSmslog($id){
        $user = User::findOrFail($id);
        $items = SmsLog::where('user_id', $id)->latest()->paginate(10);
        if(empty($items)){
            return back();
        }else{
            return view('user.users.singleSms', compact('items', 'user'));
        }
    }

    public function clientPass(Request $request, $id)
    {
        if (Auth::user()->refer_by == 0 && Auth::user()->roll == 1) {
            $user = User::findOrFail($id);
            $this->validate($request, ['password' => 'required|string|min:6|confirmed']);
            if ($user->refer_by == Auth::id()) {
                if ($request->password == $request->password_confirmation) {
                    $user->password = Hash::make($request->password);
                    $user->save();

                    $msg = 'Password Changed By Your Service Provider. New Password is: ' . $request->password;
                    send_email($user->email, $user->username, 'Password Changed', $msg);
                    send_sms($user->mobile, $msg);
                    return back()->with('success', 'Password Changed');
                } else {
                    return back()->with('alert', 'Password Not Matched');
                }
            } else {
                return back()->with('alert', 'This user not belong to you');
            }
        } else {
            return back();
        }
    }

    public function clientSMS(Request $request, $id)
    {
        if (Auth::user()->refer_by == 0 && Auth::user()->roll == 1) {
            $gnl = GeneralSetting::first();
            $user = User::findOrFail($id);
            $this->validate($request, ['amount' => 'required']);
            if ($user->refer_by == Auth::id()) {
                if (Auth::user()->sms >= $request->amount) {
                    $auth = User::findOrFail(Auth::id());
                    $user->sms = $user->sms + $request->amount;
                    $user->gateway = $auth->gateway;
                    $user->save();
                    $auth->sms = $auth->sms - $request->amount;
                    $auth->save();
                    $trasaction = new Transaction();
                    $trasaction->to_add = $user->id;
                    $trasaction->to_bal = $user->sms;
                    $trasaction->from_add = $auth->id;
                    $trasaction->from_bal = $auth->sms;
                    $trasaction->amount = $request->amount;
                    $trasaction->type = '1';
                    $trasaction->trx = str_random(12);
                    $trasaction->save();
                    $msg = $gnl->currency_symbol . ' ' . $request->amount . ' SMS added By service provider';
                    send_email($user->email, $user->username, 'SMS balance added', $msg);
                    send_sms($user->mobile, $msg);
                    session()->flash('success', 'SMS Balance added successfully');
                } else {
                    session()->flash('alert', 'Insufficient SMS balance');
                }
            } else {
                session()->flash('alert', 'This user not belong to you');
            }
            return back();
        } else {
            return back();
        }
    }

    public function clientUpdate(Request $request, $id)
    {
        if (Auth::user()->refer_by == 0 && Auth::user()->roll == 1) {
            $user = User::find($id);

            $this->validate($request,
                [
                    'name' => 'required|string|max:191',
                    'email' => 'required|string|max:191',
                    'mobile' => 'required|string|max:191',
                    'country' => 'required|string|max:191',
                    'city' => 'required|string|max:191',
                    'post_code' => 'required|string|max:191',
                    'address' => 'required',
                    'image' => 'image|mimes:jpg,png,jpeg|max:5000',
                ]);

            $user['name'] = $request->name;
            $user['mobile'] = $request->mobile;
            $user['email'] = $request->email;
            if ($request->hasFile('image')) {
                if ($user->image != 'default.png') {
                    @unlink('assets/user/upload/profile/' . $user->image);
                }
                if ($request->image->getClientOriginalExtension() == 'jpg' or $request->image->getClientOriginalName() == 'jpeg' or $request->image->getClientOriginalName() == 'png') {
                    $user->image = uniqid() . '.' . $request->image->getClientOriginalExtension();
                } else {
                    $user->image = uniqid() . '.jpg';
                }
                Image::make($request->file('image')->getRealPath())->resize(300, 250)->save("assets/user/upload/profile/" . $user->image);
            }
            $user['country'] = $request->country;
            $user['city'] = $request->city;
            $user['post_code'] = $request->post_code;
            $user['address'] = $request->address;
            $user['status'] = $request->status == "1" ? 1 : 0;
            $user->save();
            $msg = 'Your Profile has been Updated by Your service provider';
            send_email($user->email, $user->username, 'Profile Updated', $msg);
            send_sms($user->mobile, $msg);
            return back()->withSuccess('User Profile Updated Successfuly');
        } else {
            return back();
        }
    }

    public function addClient()
    {
        if (Auth::user()->refer_by == 0 && Auth::user()->roll == 1) {
            return view('user.users.addClient');
        } else {
            return back();
        }
    }

    public function storeClient(Request $request)
    {
        if (Auth::user()->refer_by == 0 && Auth::user()->roll == 1) {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|max:150',
                'mobile' => 'required',
                'username' => 'required|string|alpha_dash|max:25|unique:users',
                'password' => 'required|string|min:6',
                'image' => 'image|mimes:jpg,jpeg,png|max:5000',
                'country' => 'required'
            ]);
            $excp = $request->except('_token', 'password', 'image');
            $password = Hash::make($request->password);
            if ($request->hasFile('image')) {
                if ($request->image->getClientOriginalExtension() == 'jpg' or $request->image->getClientOriginalName() == 'jpeg' or $request->image->getClientOriginalName() == 'png') {
                    $image = uniqid() . '.' . $request->image->getClientOriginalExtension();
                } else {
                    $image = uniqid() . '.jpg';
                }
                Image::make($request->file('image')->getRealPath())->resize(300, 250)->save("assets/user/upload/profile/" . $image);
            } else {
                $image = 'default.png';
            }
            User::create($excp + ['password' => $password, 'image' => $image, 'refer_by' => Auth::id(), 'roll' => 0]);
            $msg = 'Your account has created successfully. Your username is ' . $request->username . ' and password is ' . $request->password;
            send_email($request->email, $request->name, 'Account created', $msg);
            send_sms($request->mobile, $msg);
            session()->flash('success', 'User Created successfully');
            return back();
        }else{
            return back();
        }
    }

    public function broadcast()
    {
        if (Auth::user()->refer_by == 0 && Auth::user()->roll == 1) {
            return view('user.users.broadcast');
        }else{
            return back();
        }
    }

    public function broadcastemail(Request $request)
    {
        if (Auth::user()->refer_by == 0 && Auth::user()->roll == 1) {
            $this->validate($request, ['subject' => 'required', 'emailMessage' => 'required']);

            $users = User::where('refer_by', Auth::id())->where('status', '1')->get();

            foreach ($users as $user) {

                $to = $user->email;
                $name = $user->name;
                $subject = $request->subject;
                $message = $request->emailMessage;

                send_email($to, $name, $subject, $message);
            }
            return back()->withSuccess('Mail Sent Successfuly');
        }else{
            return back();
        }
    }

    public function email($id)
    {
        if (Auth::user()->refer_by == 0 && Auth::user()->roll == 1) {
            $user = User::findorFail($id);
            return view('user.users.email', compact('user'));
        }else{
            return back();
        }
    }

    public function sendemail(Request $request)
    {
        if (Auth::user()->refer_by == 0 && Auth::user()->roll == 1) {
            $this->validate($request,
                ['emailto' => 'required|email',
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
        }else{
            return back();
        }
    }

    public function smsLog()
    {
        $items = SmsLog::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(10);
        return view('user.smsLog', compact('items'));
    }

    public function transactionLog()
    {
        $items = Transaction::where('to_add', Auth::user()->id)->orWhere('from_add', Auth::user()->id)->orderBy('id', 'DESC')->paginate(10);
        return view('user.transactionLog', compact('items'));
    }

    public function verification()
    {
        $gnl = GeneralSetting::first();
        $ga = new GoogleAuthenticator();
        if (isset(Auth::user()->two_step_code) && Auth::user()->two_step_verify == 1) {
            $secret = Auth::user()->two_step_code;
        } else {
            $secret = $ga->createSecret();
        }
        $qrCodeUrl = $ga->getQRCodeGoogleUrl(Auth::user()->username . '@' . $gnl->title, $secret);

        return view('user.verification', compact('secret', 'qrCodeUrl'));
    }

    public function verificationStatus(Request $request)
    {
        $this->validate($request, [
            'key' => 'required',
            'code' => 'required',
        ]);
        $user = User::findOrFail(Auth::id());
        $ga = new GoogleAuthenticator();
        $secret = $request->key;
        $oneCode = $ga->getCode($secret);
        $userCode = $request->code;
        if (Auth::user()->two_step_verify == 0) {
            if ($userCode == $oneCode) {
                $user->two_step_verify = 1;
                $user->two_step_verification = 1;
                $user->two_step_code = $secret;
                $user->save();
                $msg = 'Google Two Factor Authentication Enabled Successfully';
                send_email($user->email, $user->username, 'Google 2FA', $msg);
                send_sms($user->mobile, $msg);
                session()->flash('success', 'Google Two Factor Authentication Enabled Successfully');
            } else {
                session()->flash('alert', 'Incorrect Verification Code');
            }
        } else {
            if ($userCode == $oneCode) {
                $user->two_step_verify = 0;
                $user->save();
                $msg = 'Google Two Factor Authentication Disabled Successfully';
                send_email($user->email, $user->username, 'Google 2FA', $msg);
                send_sms($user->mobile, $msg);
                session()->flash('success', 'Google Two Factor Authentication Disabled Successfully');
            } else {
                session()->flash('alert', 'Incorrect Verification Code');
            }
        }
        return back();
    }

    public function supportTicket()
    {
        if (Auth::user()->refer_by == 0) {
            $supports = SupportTicket::where('user_id', Auth::id())->orderBy('id', 'DESC')->paginate(10);
            return view('user.support.supportTicket', compact('supports'));
        }else{
            return back();
        }
    }

    public function openSupportTicket()
    {
        if (Auth::user()->refer_by == 0) {
            return view('user.support.sendSupportTicket');
        }else{
            return back();
        }
    }

    public function storeSupportTicket(Request $request)
    {
        if (Auth::user()->refer_by == 0) {
            $ticket = new SupportTicket();
            $message = new SupportMessage();
            $this->validate($request, [
                'subject' => 'required',
                'message' => 'required',
            ]);

            $ticket->user_id = Auth::id();
            $random = rand(100000, 999999);

            $ticket->ticket = 'S-' . $random;
            $ticket->subject = $request->subject;
            $ticket->status = 0;
            $ticket->save();

            $message->supportticket_id = $ticket->id;
            $message->type = 1;
            $message->message = $request->message;
            $message->save();

            session()->flash('success', 'Support ticket created successfully');
            return back();
        }else{
            return back();
        }
    }

    public function supportMessage($ticket)
    {if (Auth::user()->refer_by == 0) {
        $my_ticket = SupportTicket::where('ticket', $ticket)->latest()->first();
        $messages = SupportMessage::where('supportticket_id', $my_ticket->id)->get();
        if ($my_ticket->user_id == Auth::id()) {
            return view('user.support.supportMessage', compact('my_ticket', 'messages'));
        } else {
            return redirect()->route('404');
        }
    }else{
        return back();
    }
    }

    public function supportMessageStore(Request $request, $id)
    {if (Auth::user()->refer_by == 0) {
        $ticket = SupportTicket::findOrFail($id);
        $message = new SupportMessage();
        if ($ticket->status != 3) {

            if ($request->replayTicket == 1) {
                $ticket->status = 2;
                $ticket->save();

                $message->supportticket_id = $ticket->id;
                $message->type = 1;
                $message->message = $request->message;
                $message->save();

                session()->flash('success', 'Support ticket replied successfully');
            } elseif ($request->replayTicket == 2) {
                $ticket->status = 3;
                $ticket->save();
                session()->flash('success', 'Support ticket closed successfully');
            }
            return back();
        } else {
            session()->flash('alert', 'Support ticket has alredy been closed');
            return back();
        }
    }else{
        return back();
    }
    }

    public function forgotPass(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required',
            ]);
        $user = User::where('email', $request->email)->first();

        if ($user == null) {
            return back()->with('alert', 'Invalid Email Address');
        } else {
            $to = $user->email;
            $name = $user->name;
            $subject = 'Password Reset';
            $code = str_random(30);
            $message = 'Use This Link to Reset Password: ' . url('/') . '/reset/' . $code;

            PasswordReset::create(
                ['email' => $to, 'token' => $code]
            );

            send_email($to, $name, $subject, $message);

            return redirect()->route('login')->with('success', 'Password Reset Email Sent Succesfully');
        }

    }

    public function resetLink($code)
    {
        $reset = PasswordReset::where('token', $code)->orderBy('created_at', 'desc')->first();
        if (is_null($reset)) {
            return redirect()->route('login')->with('alert', 'Invalid Reset Link');
        } else {
            if ($reset->status == 1 || Carbon::now() > $reset->created_at->addHour(1)) {
                return redirect()->route('login')->with('alert', 'Invalid Reset Link');
            } else {
                return view('auth.passwords.reset', compact('reset'));
            }
        }
    }

    public function passwordReset(Request $request)
    {
        $this->validate($request,
            [
                'token' => 'required',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|min:6',
            ]);
        $reset = PasswordReset::where('token', $request->token)->orderBy('created_at', 'desc')->first();
        $user = User::where('email', $reset->email)->first();
        if ($reset->status == 1) {
            return redirect()->route('login')->with('alert', 'Invalid Reset Link');
        } else {
            if ($request->password == $request->password_confirmation) {
                $user->password = bcrypt($request->password);
                $user->save();
                PasswordReset::where('email', $user->email)->where('token', $request->token)->update(['status' => 1]);

                $msg = 'Your Password has been Changed Successfully';
                send_email($user->email, $user->username, 'Password Changed', $msg);
                return redirect()->route('login')->with('success', 'Password Changed Successfully');
            } else {
                return back()->with('alert', 'Password Not Matched');
            }
        }
    }
}
