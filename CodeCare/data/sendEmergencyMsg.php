<?php
/* ------------------------------------------------------- */
/*  Author : Shabnam Suresh                                */
/*  Website: http://projects.thecdm.ca/codecare/index.html */
/* ------------------------------------------------------- */


$eMsg = json_decode(file_get_contents('php://input'));
$toContactNo = $eMsg->toContactNo;
$msgBody = $eMsg->msgtxt;
$code = $eMsg->code;
$codeImgPath = "";

require_once 'twilio-php-master/Twilio/autoload.php'; // Loads the library
use Twilio\Rest\Client;

// Your Account Sid and Auth Token from twilio.com/user/account
$sid = "AC0152da9ba94a9e02596223f3dc7c5131";
$token = "54ebf818e93201710e68fa1a8101c5ba";
$client = new Client($sid, $token);

//Set the image based on the chosen code
switch ($code) {
  case "RED":
  $codeImgPath = "http://projects.thecdm.ca/codecare/images/codes/RED.png";
  break;
  case "BLACK":
  $codeImgPath = "http://projects.thecdm.ca/codecare/images/codes/BLACK.png";
  break;
  case "PURPLE":
  $codeImgPath = "http://projects.thecdm.ca/codecare/images/codes/PURPLE.png";
  break;
  case "WHITE":
  $codeImgPath = "http://projects.thecdm.ca/codecare/images/codes/WHITE.png";
  break;
  case "BROWN":
  $codeImgPath = "http://projects.thecdm.ca/codecare/images/codes/BROWN.png";
  break;
  case "GREY":
  $codeImgPath = "http://projects.thecdm.ca/codecare/images/codes/GREY.png";
  break;
  case "ORANGE":
  $codeImgPath = "http://projects.thecdm.ca/codecare/images/codes/ORANGE.png";
  break;
  case "BLUE":
  $codeImgPath = "http://projects.thecdm.ca/codecare/images/codes/BLUE.png";
  break;
  case "GREEN":
  $codeImgPath = "http://projects.thecdm.ca/codecare/images/codes/GREEN.png";
  break;
  case "YELLOW":
  $codeImgPath = "http://projects.thecdm.ca/codecare/images/codes/YELLOW.png";
  break;
  default:
  $codeImgPath = "";
}

if(strcmp($toContactNo, 'ALL') == 0){

  /* database connection details*/
  $db_name     = 'codecare';
  $db_user     = 'codecare';
  $db_password = 'eTH@#R';
  $server_url  = 'localhost';

  $con = mysqli_connect("localhost",$db_user, $db_password, $db_name);

  if (mysqli_connect_errno())
  {
    print 'Unable to connect to the database';
  }
  else
  {
    $sql = "SELECT contact_no FROM emergencyContact";
    $result = $con->query($sql);

    if ($result->num_rows > 0)
    {
      // output data of each row
      while($row = $result->fetch_assoc())
      {
        // Send a new outgoinging SMS by POSTing to the SMS resource */
        $client->messages->create(
        $row["contact_no"],
        array(
          'from' => '+17782007116',
          'body' => $msgBody,
          'mediaUrl' => $codeImgPath,
          )
        );
      }
    }
    else
    {
      print 'Error: No Contact numbers found';
    }
    print 'Message sent to '.$result->num_rows.' Contacts';
    mysqli_close($con);
  }
}
else {
  $client->messages->create(
  $toContactNo,
  array(
    'from' => '+17782007116',
    'body' => $msgBody,
    'mediaUrl' => $codeImgPath,
    )
  );

  print 'Message sent to '.$toContactNo.' Successfully';
}

?>
