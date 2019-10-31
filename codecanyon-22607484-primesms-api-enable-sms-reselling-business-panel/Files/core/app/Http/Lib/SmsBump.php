<?php
namespace App\Lib;

class SmsBump {
	private $APIKey = '';
	private $from = '';
	private $to = '';
	
	public static function getAPIUrl($method, $APIKey) {
		return "http://api.smsbump.com/{$method}/{$APIKey}.json";
	}
	
	public static function sendBulk($APIKey, $from, $to, $message, $type, $callback = NULL) {
		foreach ($to as $toNumber) {
			SmsBump::sendSingle($APIKey, $from, $toNumber, $message, $type, $callback);
		}
	}
	
	public static function sendSingle($APIKey, $from, $to, $message, $type, $callback = NULL) {
		$postData = array(
			'from' => $from,
			'to' => $to,
			'message' => $message,
			'type' => $type
		);
		$postString = http_build_query($postData);
		
		$ch = curl_init(SmsBump::getAPIUrl('send', $APIKey));
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POST, count($postData));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
		
		$result = curl_exec($ch);
		curl_close($ch);
		
		if (is_callable($callback)) {
			call_user_func($callback, json_decode($result, true));
		}
	}
	
	public static function sendStatic_1($args) {
		if (!empty($args['APIKey']) && !empty($args['to']) && !empty($args['message'])) {
			$APIKey = $args['APIKey'];
			$from = !empty($args['from']) ? $args['from'] : '';
			$to = $args['to'];
			$message = $args['message'];
			$type = !empty($args['type']) ? $args['type'] : 'sms';
			$callback = !empty($args['callback']) ? $args['callback'] : NULL;
			SmsBump::sendStatic($APIKey, $from, $to, $message, $type, $callback);
		}
	}
	
	public static function sendStatic_6($APIKey, $from, $to, $message, $type, $callback = NULL) {
		SmsBump::sendStatic($APIKey, $from, $to, $message, $type, $callback);
	}
	
	public static function sendStatic($APIKey, $from, $to, $message, $type, $callback = NULL) {
		if (!is_array($to)) {
			SmsBump::sendSingle($APIKey, $from, $to, $message, $type, $callback);
		} else {
			SmsBump::sendBulk($APIKey, $from, $to, $message, $type, $callback);
		}
		return true;
	}
	
	public static function sendMessage() {
		$args = func_get_args();
		$argsCount = count($args);
		if (in_array($argsCount, array(1,6))) {
			$name = 'sendStatic_'.$argsCount;
			call_user_func_array(array('SmsBump', $name), $args);
		}
	}
	
	public function __construct($APIKey) {
		$this->APIKey = $APIKey;
	}
	
	public function setAPIKey($APIKey) {
		$this->APIKey = $APIKey;
	}
	
	public function setFrom($from) {
		$this->from = $from;
	}
	
	public function setTo($to) {
		$this->to = $to;
	}
	
	public function send() {
		$args = func_get_args();
		$argsCount = count($args);
		if (in_array($argsCount, array(1,3,6))) {
			$name = 'send_'.$argsCount;
			call_user_func_array(array($this, $name), $args);
		}	
	}
	
	public function send_1($args) {
		if (!empty($args['APIKey']) && !empty($args['to']) && !empty($args['message'])) {
			$APIKey = $args['APIKey'];
			$from = !empty($args['from']) ? $args['from'] : '';
			$to = $args['to'];
			$message = $args['message'];
			$type = !empty($args['type']) ? $args['type'] : 'sms';
			$callback = !empty($args['callback']) ? $args['callback'] : NULL;
			SmsBump::sendStatic($APIKey, $from, $to, $message, $type, $callback);
		}
	}
	
	public function send_3($message, $type, $callback = NULL) {
		SmsBump::sendStatic($this->APIKey, $this->from, $this->to, $message, $type, $callback);
	}
	
	public function send_6($APIKey, $from, $to, $message, $type, $callback = NULL) {
		SmsBump::sendStatic($APIKey, $from, $to, $message, $type, $callback);
	}
}