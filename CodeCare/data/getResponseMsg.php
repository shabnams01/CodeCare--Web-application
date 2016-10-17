<?php
/* ------------------------------------------------------------- */
/*  Author : Shabnam Suresh                                      */
/*  Website: http://projects.thecdm.ca/codecare/responseMsg.php  */
/* ------------------------------------------------------------- */
$eMsg = json_decode(file_get_contents('php://input'));
$fromContact = $eMsg->fromContactNo;

require_once 'twilio-php-master/Twilio/autoload.php'; // Loads the library
use Twilio\Rest\Client;

// Your Account Sid and Auth Token from twilio.com/user/account
$sid = "AC0152da9ba94a9e02596223f3dc7c5131";
$token = "54ebf818e93201710e68fa1a8101c5ba";
$client = new Client($sid, $token);

if(strcmp($fromContact, 'ALL') == 0)
{
	foreach ($client->messages->read() as $message) {

			if(strcmp($message->to, '+17782007116') == 0)
			{
		    echo "-------------------------------------"."\n";
		    echo "From:".$message->from."\n";
		    echo "Message:".$message->body."\n";
		    echo "-------------------------------------"."\n";
	  	}

	}
}
else
{
	foreach ($client->messages->read() as $message) {

			if((strcmp($message->to, '+17782007116') == 0 ) && (strcmp($message->from, $fromContact) == 0 )){
	    echo "-------------------------------------"."\n";
	    echo "From:".$message->from."\n";
	    echo "Message:".$message->body."\n";
	    echo "-------------------------------------"."\n";
	  }

	}
}
?>
