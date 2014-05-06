<?php
class esms{
	private $_api = 'BCDC8DDFFA397B303902A8505A93F8';
	private $_secret = '61715A87DC1A58F7C095CC44EFCEFA';
	function sendsms($YourPhone,$content){
		$APIKey=$this->_api;
		$SecretKey=$this->_secret;
		$ch = curl_init();
		$SampleXml = "<RQST>"
		. "<APIKEY>". $APIKey ."</APIKEY>"
		. "<SECRETKEY>". $SecretKey ."</SECRETKEY>"                                    
		. "<ISFLASH>0</ISFLASH>"
		. "<UNICODE>1</UNICODE>"
		. "<CONTENT>". $content ."</CONTENT>"
		. "<CONTACTS>"
		. "<CUSTOMER>"
		. "<PHONE>". $YourPhone ."</PHONE>"
		. "</CUSTOMER>"                               
		. "</CONTACTS>"
		. "</RQST>";	   
		curl_setopt($ch, CURLOPT_URL,"http://api.esms.vn/MainService.svc/xml/SendMultipleMessage_V2/" );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt($ch, CURLOPT_POST,           1 );
		curl_setopt($ch, CURLOPT_POSTFIELDS,     $SampleXml ); 
		curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: text/plain')); 
		$result=curl_exec ($ch);		
		$xml = simplexml_load_string($result);

		if($xml === false){
			die('Error parsing XML');   
		}
		return $xml->CodeResult;   		
	}
}
?>