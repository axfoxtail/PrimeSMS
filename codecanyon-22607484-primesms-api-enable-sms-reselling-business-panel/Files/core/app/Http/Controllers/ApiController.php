<?php

namespace App\Http\Controllers;

use App\GeneralSetting;
use App\SmsLog;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function sms(Request $request)
    {
        if (!isset($request->action)) {
            $data['error'] = 'Action should not be empty';
            return $data['error'];
        }
        if ($request->action === 'balance') {
            if (!isset($request->key)) {
                $data['error'] = 'Api Key should not be empty';
                return $data['error'];
            }
            $user = User::where('api_key', $request->key)->where('status', 1)->latest()->first();
            if (empty($user) || $user->status == 0) {
                $data['error'] = 'Invalid Api key';
                return $data['error'];
            }
            $final_user = User::select('name', 'username', 'sms')->findOrFail($user->id);
            return $final_user;

        } elseif ($request->action === 'send') {
            if (!isset($request->key)) {
                $data['error'] = 'Api Key should not be empty';
                return $data['error'];
            } elseif (!isset($request->from)) {
                $data['error'] = 'from should not be empty';
                return $data['error'];
            } elseif (!isset($request->to)) {
                $data['error'] = 'to should not be empty';
                return $data['error'];
            } elseif (!isset($request->message)) {
                $data['error'] = 'message should not be empty';
                return $data['error'];
            }
            $user = User::where('api_key', $request->key)->where('status', 1)->latest()->first();
            if (empty($user) || $user->status == 0) {
                $data['error'] = 'Invalid Api key';
                return $data['error'];
            }
            $recipients = explode(';', $request->to);
            $gnl = GeneralSetting::first();
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
                    sendSMS($to, $request->from, $request->message, $user->gateway);
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
                    $data['success'] = 'Message Sent';
                } else {
                    $data['error'] = 'Insufficient Balance';
                    return $data['error'];
                }
            }
            return $data['success'];
        } else {
            $data['error'] = 'Invalid Action';
            return $data['error'];
        }
    }
}
