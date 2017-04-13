<?php

require("PHPMailerAutoload.php");

function validateInput($data, $fieldName) {
     global $errorCount;
     if (empty($data)) {
          echo "\"$fieldName\" is a required field.";
          ++$errorCount;
          $retval = "";
     } else { // Only clean up the input if it isn't empty
          $retval = trim($data);
          $retval = stripslashes($retval);
     }
     return($retval);
}

function sendMail($sender,$email,$subject,$message) {

$mail = new PHPMailer;

$mail->isSMTP();   
$mail->Host = 'tls://smtp.gmail.com:587';
$mail->SMTPAuth = true;                 
$mail->Username = 'temporarytesting4@gmail.com';
$mail->Password = '123azerty';
$mail->Port = 587;
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->setFrom('temporarytesting4@gmail.com', 'Mailer');
$mail->addAddress($email, $sender);
$mail->addAddress('jimalexmorris@gmail.com', 'Jim Morris');
$mail->isHTML(true);              

$mail->Subject = $subject;
$prepend = "<p>Thank you for your message. Here is a copy. ";
$prepend .= "We will reply as quickly as possible.</p>";
$message = $prepend . "<p>" . $message . "</p>";
$mail->Body    = $message;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo ' :)';
}

}

$requestJson = file_get_contents('php://input');

$requestPhp = json_decode($requestJson, true);

$postlike = [];

for ($i = 0; $i < count($requestPhp); $i++) {
	$postLike[$requestPhp[$i]['name']] = $requestPhp[$i]['value'];
}

$errorCount = 0;
$sender = "";
$email = "";
$subject = "";
$message = "";
if ($postLike['operation'] == "sendEmail") {
     $sender = validateInput($postLike['name'],"name");
     $email = $postLike['email'];
     $subject = validateInput($postLike['subject'], "subject");
     $message = validateInput($postLike['message'], "message");
}

if ($errorCount>0) {
	echo "Please re-enter the form information below.";
}

else {
	echo "Your message has been sent";
	sendMail($sender, $email, $subject, $message);
}

?>
