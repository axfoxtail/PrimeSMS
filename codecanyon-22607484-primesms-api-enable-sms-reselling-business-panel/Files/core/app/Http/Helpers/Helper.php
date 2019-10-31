<?php

use App\GeneralSetting;

if (! function_exists('send_email')) {
    
    function send_email( $to, $name, $subject, $message)
    {
        $settings = GeneralSetting::first();
        $template = $settings->e_message;
        $from = $settings->e_sender;
		if($settings->email_notification == 1)
		{

			$headers = "From: $settings->title <$from> \r\n";
			$headers .= "Reply-To: $settings->title <$from> \r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

			$mm = str_replace("{{name}}", $name, $template);
			$message = str_replace("{{message}}", $message, $mm);

			if (mail($to, $subject, $message, $headers)) {
			  // echo 'Your message has been sent.';
			} else {
			 //echo 'There was a problem sending the email.';
			}

		}

    }
}

if (! function_exists('send_sms'))
{
    function send_sms( $to, $message)
    {
        $settings = GeneralSetting::first();
        if($settings->sms_notification == 1)
        {
            $sendtext = urlencode("$message");
            $appi = $settings->sms_api;
            $appi = str_replace("{{number}}",$to,$appi);
            $appi = str_replace("{{message}}",$sendtext,$appi);
            $result = file_get_contents($appi);
        }

    }
}
