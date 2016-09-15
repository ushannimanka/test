<?php
   
class sms {
    
    try{

    $smsReceiver  =  json_decode(file_get_contents('php://input'), true);
        
         $address = $smsReceiver['sourceAddress'];
         $requestId = $smsReceiver['requestId'];
         $applicationId = $smsReceiver['applicationId'];
         $message = $smsReceiver['message'];
         $encoding = $smsReceiver['encoding'];
         $version = $smsReceiver['version'];
        
        
         $password = 'fhasfhadfjdshfjdshfsdjfhdsfdshfds'; //Enter your App password here 
        

	if ($message!="") {

        $response = this->SendSms($applicationId,$message,$address,$password);

        }

    else{

		$response=$sender->sms("invalid keyword", $address);

	}

}catch(SMSServiceException $e){
	$logger->WriteLog($e->getErrorCode().' '.$e->getErrorMessage());
}
 
    public function SendSms($applicationId,$message,$address,$password)
    {
        $arrayField = array(
            "message" => $message,
            "destinationAddresses" => $number,
            "applicationId" => $applicationId,
            "password" => $password,
            );

        $jsonObjectFields = json_encode($arrayField);
        return $this->sendRequest($jsonObjectFields);
    }

    private function sendRequest($jsonObjectFields)
    {
        $ch = curl_init('https://api.dialog.lk/sms/send');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonObjectFields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        curl_close($ch);
        return $this->handleResponse($res);
    }
    private function handleResponse($resp){
        if ($resp == "") {
            return "";
        } else {
            return $resp;
        }
    }
    
    
}
    
    ?>