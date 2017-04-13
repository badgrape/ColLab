<?php

require 'PHPMailerAutoload.php';

function validateInput($data, $fieldName) {
     global $errorCount;
     if (empty($data)) {
          echo "\"$fieldName\" is a required field.<br 
/>\n";
          ++$errorCount;
          $retval = "";
     } else { // Only clean up the input if it isn't empty
          $retval = trim($data);
          $retval = stripslashes($retval);
     }
     return($retval);
}

function sendMail($Sender,$Email,$Subject,$Message) {

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
$mail->addAddress($Email, $Sender);
$mail->isHTML(true);              

$mail->Subject = $Subject;
$mail->Body    = $Message;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

}

$errorCount = 0;
$Sender = "";
$Email = "";
$Subject = "";
$Message = "";
if (isset($_POST['Submit'])) {
     $Sender =  validateInput($_POST['Sender'],"Your Name");
     $Email = $_POST['Email'];    // we need different method to validate an email input
     $Subject = validateInput($_POST['Subject'],"Subject");
     $Message = validateInput($_POST['Message'],"Message");
     if ($errorCount==0)
          $ShowForm = FALSE;
     else
          $ShowForm = TRUE;
}
if ($ShowForm == TRUE) {
     if ($errorCount>0) // if there were errors
          echo "<p>Please re-enter the form information
               below.</p>\n";
     displayForm($Sender, $Email, $Subject, $Message);
} 
else {
         echo "Your message will be send shortly.";
    
        sendMail($Sender,$Email,$Subject,$Message);

     }

?>

</body>
</html>

