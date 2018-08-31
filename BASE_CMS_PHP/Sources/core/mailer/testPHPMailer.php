<?php
/*
    Créer dans le but de testé l'envoi d'email avec $_POST['']
*/

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 4;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'contact.goout@gmail.com';                 // SMTP username
    $mail->Password = 'T0cguN@12';                           // SMTP password
    // Ne fonctionne pas avec la ligne ci-dessous:
    //$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted

    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );


    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('contact.goout@gmail.com');
    $mail->addAddress($_POST['email']);

    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
/*
    Add attachments :
    $mail->addAttachment('/var/tmp/file.tar.gz');
    Optional name:
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');
*/
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Confirmation de votre inscription';
    $mail->Body    = 'Bonjour '. $_POST['email'] . ' Vous venez de vous inscrire sur le site <a href="http://goout.fr">GoOut</a>. <br>
    Nous vous invitons à valider votre adresse email pour finaliser votre inscription et pouvoir poursuivre sur notre site en cliquant <a href="http://goout.fr">ici</a>' ; // url à remplacer par url avec $id et $token
    $mail->AltBody = 'Email de confirmation suite à votre inscription sur notre site';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
