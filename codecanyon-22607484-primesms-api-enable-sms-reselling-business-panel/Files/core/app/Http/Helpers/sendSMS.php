<?php

use App\SmsGateway;
use App\GeneralSetting;
use Twilio\Rest\Client;
use Plivo\RestClient;
use Osms\Osms;
use Coreproc\Chikka\ChikkaClient;
use Coreproc\Chikka\Models\Sms;
use Coreproc\Chikka\Transporters\SmsTransporter;
use telesign\sdk\messaging\MessagingClient;
use Textmagic\Services\TextmagicRestClient;
use App\Lib\ViaNettSMS;
use SMSApi\Api\SmsFactory;
use SMSApi\Exception\SmsapiException;
use App\Lib\SmsBump;
use Clickatell\Api\ClickatellRest;

function sendSMS($to, $from, $message, $gateway)
{
    if ($gateway != 0) {
        $smsgateway = SmsGateway::findOrFail($gateway);
        $gnl = GeneralSetting::first();
        if ($smsgateway->status == 1) {
            switch ($gateway) {
                case '1':
                    $sid = $smsgateway->val1;
                    $token = $smsgateway->val2;
                    $twilio = new Client($sid, $token);
                    $send_to = $to;
                    $twilio->messages->create(
                        $send_to,
                        array(
                            'from' => $smsgateway->val3,
                            'body' => $message,
                        )
                    );
                    break;
                case '2':
                    $client = new infobip\api\client\SendSingleTextualSms(new infobip\api\configuration\BasicAuthConfiguration($smsgateway->val1, $smsgateway->val2));
                    $requestBody = new infobip\api\model\sms\mt\send\textual\SMSTextualRequest();
                    $requestBody->setFrom($from);
                    $requestBody->setTo($to);
                    $requestBody->setText($message);
                    $client->execute($requestBody);
                    break;
                case '3':
                    $apiKey = urlencode($smsgateway->val1);
                    $numbers = array($to);
                    $sender = urlencode($gnl->title);
                    $message = rawurlencode($message);
                    $numbers = implode(',', $numbers);
                    $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
                    $ch = curl_init('https://api.txtlocal.com/send/');
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_exec($ch);
                    curl_close($ch);
                    break;
                case '4':
                    $authKey = $smsgateway->val1;
                    $mobileNumber = urlencode($to);
                    $senderId = $smsgateway->val2;
                    $message = urlencode($message);
                    $route = "default";
                    $postData = array(
                        'authkey' => $authKey,
                        'mobiles' => $mobileNumber,
                        'message' => $message,
                        'sender' => $senderId,
                        'route' => $route
                    );
                    $url = "http://api.msg91.com/api/sendhttp.php";
                    $ch = curl_init();
                    curl_setopt_array($ch, array(
                        CURLOPT_URL => $url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_POST => true,
                        CURLOPT_POSTFIELDS => $postData
                    ));
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_exec($ch);
                    curl_close($ch);
                    break;
                case '5':
                    $auth_id = $smsgateway->val1;
                    $auth_token = $smsgateway->val2;
                    $client = new RestClient($auth_id, $auth_token);
                    $client->messages->create(
                        $smsgateway->val3,
                        $to,
                        $message
                    );
                    break;
                case '6':
                    $client = new Nexmo\Client(new Nexmo\Client\Credentials\Basic($smsgateway->val1, $smsgateway->val2));
                    $message = $client->message()->send([
                        'to' => $to,
                        'from' => $smsgateway->val3,
                        'text' => $message
                    ]);
                    break;
                case '7':
                    $config = array(
                        'clientId' => $smsgateway->val1,
                        'clientSecret' => $smsgateway->val2
                    );
                    $osms = new Osms($config);
                    $response = $osms->getTokenFromConsumerKey();
                    if (!empty($response['access_token'])) {
                        $senderAddress = $smsgateway->val3;
                        $receiverAddress = $to;
                        $message = $message;
                        $senderName = $gnl->title;

                        $osms->sendSMS($senderAddress, $receiverAddress, $message, $senderName);
                    }
                    break;
                case '8':
                    $url = "https://semysms.net/api/3/sms.php"; //Url address for sending SMS
                    $phone = $to; // Phone number
                    $msg = $message;  // Message
                    $device = $smsgateway->val2;  //  Device code
                    $token = $smsgateway->val1;  //  Your token (secret)

                    $data = array(
                        "phone" => $phone,
                        "msg" => $msg,
                        "device" => $device,
                        "token" => $token
                    );

                    $curl = curl_init($url);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                    curl_exec($curl);
                    curl_close($curl);
                    break;
                case '9':
                    $chikkaClient = new ChikkaClient($smsgateway->val1, $smsgateway->val2, $smsgateway->val3);
                    $msgid = rand(1, 100);
                    $sms = new Sms($msgid, $to, $message);
                    $smsTransporter = new SmsTransporter($chikkaClient, $sms);
                    $smsTransporter->send();
                    break;
                case '10':
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_URL => 'http://api.nusasms.com/api/v3/sendsms/plain',
                        CURLOPT_POST => true,
                        CURLOPT_POSTFIELDS => array(
                            'user' => $smsgateway->val1,
                            'password' => $smsgateway->val2,
                            'SMSText' => $message,
                            'GSM' => $to
                        )
                    ));
                    curl_exec($curl);
                    break;
                case '11':
                    $customer_id = $smsgateway->val1;
                    $api_key = $smsgateway->val2;

                    $phone_number = $to;
                    $message = $message;
                    $message_type = "ARN";

                    $messaging_client = new MessagingClient($customer_id, $api_key);
                    $messaging_client->message($phone_number, $message, $message_type);
                    break;
                case '12':
                    $apiUrl = "https://mapi.moreify.com/api/v1/sendSms";
                    $postParams = array(
                        'project' => $smsgateway->val1,
                        'password' => $smsgateway->val2,
                        'phonenumber' => $to,
                        'message' => $message,
                        'tag' => 'sms'
                    );

                    $curl = curl_init($apiUrl);
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $postParams);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
                    curl_exec($curl);
                    break;
                case '13':
                    $client = new TextmagicRestClient($smsgateway->val1, $smsgateway->val2);
                    $client->messages->create(
                        array(
                            'text' => $message,
                            'phones' => $to
                        )
                    );
                    break;
                case '14':
                    $username = trim($smsgateway->val1);
                    $password = trim($smsgateway->val2);
                    $destinationAddress = urlencode($to);
                    $message = urlencode($message);
                    $url = "http://smsc.vianett.no/ActiveServer/MT/?username=".$username."&password=".$password."&destinationaddr=".$destinationAddress."&message=".$message."&refno=1";
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_exec($ch);
                    curl_close($ch);
                    break;
                case '15':
                    $client = new \SMSApi\Client($smsgateway->val1);
                    $client->setPasswordHash($smsgateway->val2);

                    $smsapi = new SmsFactory;
                    $smsapi->setClient($client);

                    $actionSend = $smsapi->actionSend();
                    $actionSend->setTo($to);
                    $actionSend->setText($message);
                    $actionSend->setSender($gnl->title);
                    $actionSend->execute();
                    break;
                case '16':
                    SmsBump::sendMessage(array(
                        'APIKey' => $smsgateway->val1,
                        'to' => $to,
                        'message' => $message,
                        'callback' => 'on_send'
                    ));
                    break;
                case '17':
                    $username = $smsgateway->val1;
                    $password = $smsgateway->val2;
                    $destination = $to; //Multiple numbers can be entered, separated by a comma
                    $source = $gnl->title;
                    $text = $message;
                    $ref = $gnl->title;

                    $content = 'username=' . rawurlencode($username) .
                        '&password=' . rawurlencode($password) .
                        '&to=' . rawurlencode($destination) .
                        '&from=' . rawurlencode($source) .
                        '&message=' . rawurlencode($text) .
                        '&ref=' . rawurlencode($ref);

                    $ch = curl_init('https://www.smsbroadcast.com.au/api-adv.php');
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_exec($ch);
                    curl_close($ch);
                    break;
                case '18':
                    $sms = new \Descom\Sms\Sms(new \Descom\Sms\Auth\AuthUser($smsgateway->val1, $smsgateway->val2));

                    $message = new \Descom\Sms\Message();

                    $message->addTo($to)->setText($message);

                    $sms->addMessage($message)
                        ->setDryrun(true)
                        ->send();
                    break;
                case '19':
                    $clockwork = new \mediaburst\ClockworkSMS\Clockwork($smsgateway->val1);
                    $message = array('to' => $to, 'message' => $message);
                    $clockwork->send($message);
                    break;
                case '20':
                    $apikey = $smsgateway->val1;
                    $apisender = $smsgateway->val2;
                    $msg = $message;
                    $num = $to;    // MULTIPLE NUMBER VARIABLE PUT HERE...!
                    $ms = rawurlencode($msg);   //This for encode your message content
                    $url = 'https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=' . $apikey . '&senderid=' . $apisender . '&channel=2&DCS=0&flashsms=0&number=' . $num . '&text=' . $ms . '&route=1';
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, "");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 2);
                    curl_exec($ch);
                    break;
                case '21':
                    $username = $smsgateway->val1;
                    $password = $smsgateway->val2;
                    $to = $to;
                    $from = $from;
                    $message = $message;
                    $url = "http://Lifetimesms.com/plain?username=".$username."&password=" .$password.
                        "&to=" .$to. "&from=" .urlencode($from)."&message=" .urlencode($message)."";
                    $ch = curl_init();
                    $timeout = 30;
                    curl_setopt ($ch,CURLOPT_URL, $url) ;
                    curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT, $timeout) ;
                    curl_exec($ch) ;
                    curl_close($ch) ;
                    break;
                case '22':
                    $username = $smsgateway->val1; //ConnectMedia Username
                    $password = $smsgateway->val2; //ConnectMedia Password
                    $sender = $smsgateway->val3; //Sender ID of the message
                    $action = 'send';//Required action(send -> sending message) (balance -> balance) (history -> sent history)
                    $to = $to; //Destination Number
                    $message = $message; //Message Text
                    $url = "http://www.connectmedia.co.ke/user-board/?api"; //Please don’t change
                    $post = [
                        'action' => "$action", //Please don’t change
                        'to' => "$to", //Please don’t change
                        'username' => "$username", //Please don’t change
                        'password' => "$password", //Please don’t change
                        'sender' => "$sender", //Please don’t change
                        'message' => urlencode("$message"),//Please don’t change
                    ];
                    $ch = curl_init("$url"); //Please don’t change
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post); //Please don’t change
                    $response = curl_exec($ch);
                    curl_close($ch);

                    break;
                case '23':
                    $clickatell = new ClickatellRest($smsgateway->val1);
                    $clickatell->sendMessage(array($to), $message);
                    break;
                case '24':
                    $MessageBird = new \MessageBird\Client($smsgateway->val1);
                    $Message             = new \MessageBird\Objects\Message();
                    $Message->originator = $from;
                    $Message->recipients = array($to);
                    $Message->body       = $message;
                    $MessageBird->messages->create($Message);
                    break;
            }
        } else {
            session()->flash('alert', 'Your SMS Gateway is not active');
        }
    } else {
        session()->flash('alert', 'To send SMS you have to buy sms credit first. Please Contact with site Admin.');
    }
    return back();
}