<?php
/* ------------------------------------------------------- */
/*  Author : Shabnam Suresh                                */
/*  Website: http://projects.thecdm.ca/codecare/index.html */
/* ------------------------------------------------------- */

$eMsg = json_decode(file_get_contents('php://input')); //to get user details from json headers

if($eMsg->toContactNo && $eMsg->data)
{

  $strFromNumber = "+17782007176";

  // include the Twilio PHP library - download from
  // http://www.twilio.com/docs/libraries/
  //require_once ("/inc/Services/Twilio.php");
  require_once 'twilio-php-master/Twilio/autoload.php';
  use twilio-php-master\Twilio\Rest\Client;

  // set our AccountSid and AuthToken - from www.twilio.com/user/account
  $AccountSid = "AC9f07cc196e1aa62ce0da9e6c8851e222";
  $AuthToken = "565d38e6c6f603492f359b17175502ce";

  // ini a new Twilio Rest Client
  //$objConnection = new Services_Twilio($AccountSid, $AuthToken);
  $objConnection = new Client($AccountSid, $AuthToken);

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
        $bSuccess = $objConnection->account->messages->create(

        $strFromNumber, 	         // number we are sending From
        $row["contact_no"],
        $eMsg->data
      );
    }
  }
  else
  {
    print 'Error: No Contact numbers found';
  }

  print 'Message sent to '.$result->num_rows.' Contact';
  mysqli_close($con);

}
?>
