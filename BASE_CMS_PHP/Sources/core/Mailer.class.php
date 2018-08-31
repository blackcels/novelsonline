<?php
/*
    Notre service de mail via la librairie PHPMailer.
    utilisé principalement pour l'inscription d'un visiteur lorsque celui-ci
    doit recevoir un mail de confirmation ou encore s'il a oublié son mot de passe
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'mailer/vendor/autoload.php';

class Mailer {

    /*
        L'envoi du mail
        Retourne true (si le mail est bien envoyé) ou false
        Utilisé dans le contrôleur Auth et Test
     */
    public static function send($mailDest, $template, $option=[]) {
        //1) Appel et instanciation de librairie & l'élément JSON dédié au mail en php
        $mail = new PHPMailer(true);
        $mailJson = new MailJson();
        $mailJson->getConfig();
        try {
            // Pour gérer les erreurs
            $mail->isSMTP();
            $mail->Host = $mailJson->getMailHost();
            $mail->SMTPAuth = true;
            $mail->Username = $mailJson->getMail();
            $mail->Password = $mailJson->getMailPwd();
            $mail->Port = 587;

            //2) La validité d'un mail se fait via un protocole SSL qu'il faut paramêtrer
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            //3) On peut alors dire qui est l'expéditeur(getName) et son message(getMail)
            //Pour affecter un destinataire , on doit savoir s'il est bien défini et qu'il est
            //conforme au regex
            $mail->setFrom($mailJson->getMail(),$mailJson->getName());
            if ($mailDest && !empty($mailDest) && (Util::emailValide($mailDest) !== FALSE)) {
                $mail->addAddress(trim($mailDest));
            } else {
                return false;
            }

            //4) Utilisation d'un template HTML pour y mettre le mail
            $mail->isHTML(true);
            $mail->Subject = isset($option["subject"])? $option["subject"] : "";
            $content = self::getTemplateAndReplace($template, isset($option["data"])? $option["data"] : []);
            if ($content !== FALSE){
                $mail->Body = $content;
            } else {
                return false;
            }

            //Puisque tout les test précédents sont ok , alors on envoit le mail
            $mail->send();

        } catch ( Exception $ex) {
            //TODO retourner l'erreur dans une vue pour savoir ce qui se passe
            return false;
        }
        return true;
    }

    /**
     * Inclut une vue dans le mail php
     *  - Retourne un false(si la vue n'existe pas) ou un template
     * @param $template
     * @param $data
     * @return bool|mixed
     */
    private static function getTemplateAndReplace($template, $data){
        $templatePath = "views/mail/".$template.".html";
        $contentMail = null;

        //Récupération du template définit plus haut si celui existe
        if (file_exists($templatePath)) {
             $contentMail = file_get_contents($templatePath);
        } else {
            return false;
        }

        //Puis on retourne les données utiles au mail + le template choisi
        if ($contentMail != null && !empty($contentMail)) {
            if (!empty($data)){
                $keyData = array_keys($data);
                $valueData = array_values($data);
                $contentMail = str_ireplace($keyData,$valueData, $contentMail);
            }
            return $contentMail;
        }

        return false;
    }

}
