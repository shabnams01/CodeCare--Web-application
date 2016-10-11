<?php

// ==== Control Vars =======
$strFromNumber = "+17782007176";
//$strToNumber = "+17789294947";
//$strMsg = "REDDDD";

$strToNumber = $_POST['strToNumber'];
$strMsg = $_POST['strMsg'];

	//$aryResponse = array();


    // include the Twilio PHP library - download from
    // http://www.twilio.com/docs/libraries/
    require_once ("inc/Services/Twilio.php");

    // set our AccountSid and AuthToken - from www.twilio.com/user/account
    $AccountSid = "AC9f07cc196e1aa62ce0da9e6c8851e222";
    $AuthToken = "565d38e6c6f603492f359b17175502ce";

    // ini a new Twilio Rest Client
    $objConnection = new Services_Twilio($AccountSid, $AuthToken);


    // Send a new outgoinging SMS by POSTing to the SMS resource */
    $bSuccess = $objConnection->account->sms_messages->create(

        $strFromNumber, 	// number we are sending From
        $strToNumber,           // number we are sending To
        $strMsg			// the sms body
    );


    //$aryResponse["SentMsg"] = $strMsg;
    //$aryResponse["Success"] = true;


    //echo json_encode($aryResponse);
	echo '{"success":1}';

?>
