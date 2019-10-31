<?php

namespace App\Http\Controllers\Admin;

use App\GeneralSetting;
use App\SmsGateway;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebsiteController extends Controller
{
    public function genSetting(){
        $item = GeneralSetting::first();
        $gateways = SmsGateway::where('status', 1)->orderBy('name')->get();
        return view('admin.website.general', compact('item', 'gateways'));
    }

    public function updateGenSetting(Request $request){
        $general = GeneralSetting::first();
        $general->title = $request->title;
        $general->base_color = ltrim($request->color, '#');
        $general->currency_symbol = $request->currency_symbol;
        $general->sms_charge = $request->sms_charge;
        $general->default_gateway = $request->default_gateway;
        $general->email_verification = $request->emailver =="1" ?1:0 ;
        $general->sms_verification = $request->smsver =="1" ?1:0 ;
        $general->email_notification = $request->emailnotf=="1" ?1:0;
        $general->sms_notification = $request->smsnotf=="1" ?1:0;
        $general->recaptcha = $request->recaptcha=="1" ?1:0;
        $general->site_key = $request->site_key;
        $general->secret_key = $request->secret_key;
        $res = $general->save();
        if ($res) {
            session()->flash('success', 'Updated Successfully!');
            return back();
        }else{
            session()->flash('alert', 'Problem With Updating');
            return back();
        }
    }

    public function emailSetting(){
        $item = GeneralSetting::first();
        return view('admin.website.emailtemplate', compact('item'));
    }

    public function updateEmailSetting(Request $request){
        $emailtemp = GeneralSetting::first();
        if($emailtemp){
            $emailtemp->e_sender = $request->esender;
            $emailtemp->e_message = $request->emessage;
        }else{
            $emailtemp = new GeneralSetting();
            $emailtemp->e_sender = $request->esender;
            $emailtemp->e_message = $request->emessage;
        }
        $em = $emailtemp->save();
        if ($em) {
            session()->flash('success', 'Updated Successfully!');
            return back();
        }else{
            session()->flash('alert', 'Problem With Updating');
            return back();
        }
    }

    public function smsSetting(){
        $item = GeneralSetting::first();
        return view('admin.website.smstemplate', compact('item'));
    }

    public function updateSmsSetting(Request $request){
        $smstemp = GeneralSetting::first();
        if($smstemp){
            $smstemp->sms_api = $request->smsapi;
        }else{
            $smstemp = new GeneralSetting();
            $smstemp->sms_api = $request->smsapi;
        }
        $sm = $smstemp->save();
        if ($sm) {
            session()->flash('success', 'Updated Successfully!');
            return back();
        }else{
            session()->flash('alert', 'Problem With Updating');
            return back();
        }
    }
}
