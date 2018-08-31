<?php
/*
    Contrôleur des vues 'Connecion', 'Inscription' , 'Mot de passe oublié' et 'Réinitialisation du mot de passe'
 */

class AuthController {

    //Par défaut , le route nous mène vers la page de connexion
    public function indexAction($param){

        /*On distingue si on va sur le formulaire(GET) ou si l'on a rempli
          le formulaire(POST) */
        //On récupère les données saisies dans le form
        $result = [];
        $isPost = $_SERVER['REQUEST_METHOD'] == "POST";
        $error = "";
        if($isPost){
                $email = isset($param["POST"]["email"]) ? $param["POST"]["email"] : "";
                $pass = isset($param["POST"]["password"]) ? $param["POST"]["password"] : "";

                $origin = isset($param["GET"]["origin"]) ? $param["GET"]["origin"] : "";

                $pass = Validate::checkPwd($pass) ? $pass : "";

                if(empty($origin)){
                    $origin = F_HOME;
                }

                //Appel du service d'Auth pour traiter l'email & le password
                $result = Auth::connectFront($email,$pass);

                if(!$result["connected"]) {
                    $error = $result["message"];
                }
                //print_r($result);
        }
        $view = new View("v_connexion","front");
        $view->assign("title","Connexion");
        $view->assign("error", $error);

        if ($isPost && !empty($result) && $result["connected"]) {
            HttpElement::redirect(HttpElement::$STATUS_301, $origin);
            return;
        }
    }

    /*Route vers l'Inscription
        Retourne la vue 'v_confirmation-registration' ou 'v_register' */
    public function registerAction($param){

      /*On distingue si on va sur le formulaire(GET) ou si l'on a rempli
        le formulaire(POST) */
        switch($_SERVER['REQUEST_METHOD']){

            case "POST":
            //On récupère les données saisies dans le form.
                $email = (isset($param["POST"]["email"])) ? $param["POST"]["email"] : "";
                $pass = (isset($param["POST"]["password"])) ? $param["POST"]["password"] : "";
                $pass2 = (isset($param["POST"]["confirmPass"]))? $param["POST"]["confirmPass"] :"";

                //Appel du service de validation pour parser le mail saisi
                $error = [];
                $email = Validate::checkEmail($email);
                $userExist = User::getUserByEmail($email);
                if ($email === FALSE){
                    $error = ["error"=>EMAIL_NOT_EXIST];
                }

                if ($userExist != null || !empty($userExist)) {
                    $error = ["error"=>"Mail déjà existant"];
                }

                //Parsage des password saisi
                $pass = Validate::checkPwd($pass)? $pass: "";
                $pass2 = Validate::checkPwd($pass2)? $pass2:"";

                //On affiche "les Champs saisient sont invalides"
                //Si ces données sont vides
                if(empty($email) || empty($pass) || empty($pass2)){
                    $error = ["error"=>ERROR_SYNTAX];
                }

                //On affiche "les Champs saisient sont invalides"
                //Si ces données sont vides
                if($pass2 !== $pass){
                    $error = ["error"=>ERROR_PASS];
                }
                if (empty($error)) {
                    //On peut ajouter l'utilisateur dans la BDD
                    $createdEventDate = new \DateTime('now', new \DateTimeZone('Europe/Paris'));
                    $user = new User();
                    $user->setEmail($email);
                    $user->setPassword($pass);
                    $user->setToken(Util::generateRandomString(32));
                    $user->setActived(false);
                    $user->setRegisterdate($createdEventDate->format('Y-m-d h:i:s'));
                    $user->setModifydate($createdEventDate->format('Y-m-d h:i:s'));
                    $user->save();

                    $linkActiveAccount = str_ireplace(["{token}", "{email}"], [$user->getToken(), $user->getEmail()], F_ACTIVE_ACCOUNT);
                    //echo $linkActiveAccount;
                    if (MODE_DEV) {
                        $linkActiveAccount = "http://localhost:8080".$linkActiveAccount;
                    } else {
                        $linkActiveAccount = "https://goout.fr".$linkActiveAccount;
                    }
                    $option = [
                        "subject" => "Activation de compte GoOut",
                        "data" => [
                            "{link}" => $linkActiveAccount,
                        ]
                    ];
                    //print_r($option["data"]["{link}"]);
                    //echo $user->getEmail();
                    Mailer::send($user->getEmail(), "active-accont", $option);
                    $viewP = new View("v_confirmation-registration");
                    $viewP->assign("title","Compte Créer");

                }else {
                    $viewG = new View("v_register");
                    $viewG->assign("title","Inscription");
                    $viewG->assign("error",$error);
                }
                return;
            case "GET":
                //On récupère les données saisies dans le form.
                $view = new View("v_register");
                $view->assign("title","Inscription");
                break;
        }


    }

    public function recoverAction($param){
        $messages = [];
        $result = [];
        $post = $_SERVER['REQUEST_METHOD'] == "POST";
        if ($post){
                $email = isset($param["POST"]["email"])? $param["POST"]["email"] :"";
                $email = Validate::checkEmail($email)? $email: "";

                if(empty($email)) {
                    $messages = ["recover" => false, "message" => EMAIL_NOT_EXIST];
                }

                $user = User::getUserByEmail($email);
                if($user == null || empty($user)){
                    $messages = ["recover"=>false, "message"=>EMAIL_NOT_EXIST];
                }

                if (empty($messages)) {
                    $token = Util::generateRandomString(32);
                    $user->setToken($token);
                    $user->save();

                    $urlGenerated = str_replace(["{token}","{email}"], [$token,$email], F_RESET_PASS);
                    $urlGenerated = UrlHelper::getHost().$urlGenerated;
                    $option["subject"]= "Mot de passe Oublier GoOut";
                    $option["data"] = [
                        "{email_forgot}" => $urlGenerated,
                    ];
                    $result = Mailer::send($user->getEmail(),"forgotPass", $option);
                }
                $messages = ["recover"=>$result, "message"=>VERIFY_YOUR_MAILBOX];
        }
        $view = new View("v_recover-pass","front");
        $view->assign("title","Mot de passe oublier !");
        $view->assign("messages", $messages);

        if($post && $messages["recover"]) {
            //sleep(10);
            HttpElement::redirect(HttpElement::$STATUS_301, F_HOME);
            return;
        }
    }

    // Activation du compte de l'utilisateur après avoir cliqué sur le lien dans le mail
    public function activeAction($param){
        
        $email = (isset($param["GET"]["email"])? $param["GET"]["email"] : "");
        $token = (isset($param["GET"]["token"])? $param["GET"]["token"] : "");

        $email = Validate::checkEmail($email);
        if ($email === FALSE){
            return ["actived"=>false, "message"=>ACTIVE_KO];
        }

        if(empty($email) || empty($token)){
            return ["actived"=>false, "message"=>ACTIVE_KO];
        }

        $user = User::getUserByEmail($email);
        if($user == null || empty($user)){
            echo "no user";
            return ["actived"=>false, "message"=>EMAIL_NOT_EXIST];
        }
        if ($user->getToken() !== $token){
            echo "token different";
            return ["actived"=>false, "message"=>EMAIL_NOT_EXIST];
        }
        $user->setToken(Util::generateRandomString(32));
        $user->setActived(true);
        $user->save();

        $options = [
            "subject" => "Confirmation Inscription",
            "data" => []
        ];

        Mailer::send($user->getEmail(), "confirm-actived", $options);
        HttpElement::redirect(HttpElement::$STATUS_301, F_SIGN_IN);
    }

    /*
        Réinitialisation du mot de passe de l'utilisateur
        return : Ne retourne rien mais défini des messages de success/fail
     */
    public function resetAction($param){
        $isPost = false;

        if($_SERVER['REQUEST_METHOD'] == "POST"){//Si les infos ont été soumises
            $email = (isset($param["GET"]["email"])? $param["GET"]["email"] : "");
            $token = (isset($param["GET"]["token"])? $param["GET"]["token"] : "");
            $pass = (isset($param["POST"]["pass"])? $param["POST"]["pass"] : "");
            $confirmPass = (isset($param["POST"]["confirmPass"])? $param["POST"]["comfirmPass"] : "");

            //Comme toujours , on parse le mail & Vérifit que le mot de passe est conforme au regex
            $pass = Validate::checkPwd($pass) ? $pass : "";
            $confirmPass = Validate::checkPwd($confirmPass) ? $confirmPass : "";

            $user = User::getUserByEmail($email);

            $messages = [];
            //Le mail est-il bien défini?
            if(empty($user)){
                $messages = ["recover"=>false, "message"=>EMAIL_NOT_EXIST];
            }

            //Les 2 mot de passes sont-ils bien définis et identiques ?
            if (($pass != false && "") && ($confirmPass != false && "")){
                if($pass !== $confirmPass){
                    $messages = ["recover"=>false, "message"=>ERROR_PASS];
                }
            }else {
                $messages = ["recover"=>false, "message"=>ERROR_PASS];
            }

            //Est-ce toujours le bon token?
            if ($token !== $user->getToken()){
                $messages = ["recover"=>false, "message"=>ERROR_PASS];
            }

            $isPost = true;

            $user->setPassword($pass);
            $user->setToken(Util::generateRandomString(32));
            $user->save();
        }//FIN SI les infos ont été soumises

        //Retour vers la même page avec un message d'erreur/de success
        $view = new View("v_reset-pass");
        $view->assign("title","Modifier mon mot de passe !");
        $view->assign("message", $messages);

        if($isPost){
            //On est alors redirigé vers le formulaire de connexion
            //sleep(10);
            HttpElement::redirect(HttpElement::$STATUS_301, F_SIGN_IN);
        }
    }

    public function logoutAction($param){
        $_SESSION["user"]["id"] = null;
        $_SESSION["user"]["token"] = null;
        HttpElement::redirect(HttpElement::$STATUS_301, F_HOME);
        return;
    }

}
