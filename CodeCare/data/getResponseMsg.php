<?php
/* ------------------------------------------------------------- */
/*  Author : Shabnam Suresh                                      */
/*  Website: http://projects.thecdm.ca/codecare/responseMsg.php  */
/* ------------------------------------------------------------- */
//$date = json_decode(file_get_contents('php://input'));

//$currDate = $_POST['currDate'];
//$currDate = $date;
//$fromContact = $_POST['fromContact'];
$fromContact = 'ALL';

// http://www.twilio.com/docs/libraries/
//require_once ("inc/Services/Twilio.php");
require_once 'twilio-php-master/Twilio/autoload.php';
use twilio-php-master\Twilio\Rest\Client;

// set our AccountSid and AuthToken - from www.twilio.com/user/account
$AccountSid = "AC9f07cc196e1aa62ce0da9e6c8851e222";
$AuthToken = "565d38e6c6f603492f359b17175502ce";

//$client = new Services_Twilio($AccountSid, $AuthToken);
$client = new Client($AccountSid, $AuthToken);

$aryResponse = array();
$row = 0;

if(strpos($fromContact, 'ALL') !== false)
{
	foreach ($client->account->sms_messages->getIterator(0, 50, array(
		//'DateSent' => $currDate,
		//'From' => '+17075551234', // **Optional** filter by 'From'...
		'To' => '+17782007176', // ...or by 'To'
	)) as $sms)
	{
		echo "Date:".$sms->date_sent." From:".$sms->from." Msg:".$sms->body."<br>";
		$aryResponse[$row]["Date"] = $sms->date_sent;
		$aryResponse[$row]["From"] = $sms->from;
		$aryResponse[$row]["Msg"] = $sms->body;
		$row += 1;
	}

}
else
{
	foreach ($client->account->sms_messages->getIterator(0, 50, array(
		'DateSent' => $currDate,
		'From' => $fromContact,
		'To' => '+17782007176', // ...or by 'To'
	)) as $sms)
	{
		echo "Date:".$sms->date_sent." From:".$sms->from." Msg:".$sms->body."<br>";
		$aryResponse[$row]["Date"] = $sms->date_sent;
		$aryResponse[$row]["From"] = $sms->from;
		$aryResponse[$row]["Msg"] = $sms->body;
		$row += 1;
	}

}
?>
