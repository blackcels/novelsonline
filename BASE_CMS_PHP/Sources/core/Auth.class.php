<?php
/*
    Serives web eb PHP dédié à l'authentification d'un utilisateur
 */

class Auth {

    /**
     * @param $urlCallBack
     * @param $login
     * @param $pass
     * @param $token
     * @return array
     */
    public static function connectBack($login, $pass){
        $admin = new AdminUserJson();
        $admin->getConfig();
        if ($login == $admin->getIdentifiant() && password_verify($pass, $admin->getPassword())) {
            $admin->setToken(Util::generateRandomString(32));
            $admin->save();
            return ["status"=>true,"user"=>$admin];

        }
        return ["status"=>false];

    }

    /*
        Vérifit s'il s'agit bien de l'administrateur
        On y retourne boolean
     */
    public static function verifyBack($token){
        $admin = new AdminUserJson();
        $admin->getConfig();
        if ($admin->getToken() == $token) {
            $admin->setToken(Util::generateRandomString(32));
            $_SESSION["Admin"]["token"] = $admin->getToken();
            $admin->save();
            return ["status"=>true];
        }
        return ["status"=>false];
    }

    /*
        Vérifit si l'email & le mot de passe récupéré dans
        le form. de connexion sont bien correctes
     */
    public static function connectFront($email, $password){
        //Sont-ils 'null' ?
        if ($email == null || $password == null) {
            return ["connected" => false, "message" => EMPTY_FIELDS, "null" => null];
        }

        //Les variables sont-elles vides ?
        if (empty($email) || empty($password)) {
            return ["connected" => false, "message" => EMPTY_FIELDS, "empty"=>"empty"];
        }

        //Récupération des infos de l'utilisateur
        $userOnConnect = User::getUserByEmail($email);

        //Ce dernier existe bien
        /*echo "<pre>";
        print_r($userOnConnect);
        echo "</pre>";*/
        if ($userOnConnect != null && !empty($userOnConnect)) {
            //Son compte a-t-il été activé?
            if(!$userOnConnect->isActived()){
                return ["connected" => false, "message" => VERIFY_YOUR_MAILBOX];
            }
            //print_r($password);
            //print_r($userOnConnect->getPassword());
            if (password_verify($password, $userOnConnect->getPassword())) {
                $userOnConnect->setToken(Util::generateRandomString(32));
                $_SESSION["user"]["id"] = $userOnConnect->getId();
                $_SESSION["user"]["token"] = $userOnConnect->getToken();
                $_SESSION["user"]["account"] = str_ireplace("{idUser}", $userOnConnect->getId(), F_ACCOUNT);
                $userOnConnect->save();
                return ["connected" => true, "message" => null];
            }
        }
        //Si les test faits sont faux , on retournera un 'false' pour réfuser la connexion
        return ["connected" => false, "message" => EMPTY_FIELDS];
    }

    /*
      Vérification de la validité de l'id & du token de la personne connecte
      Utilisé en étant traité depuis les valeurs des sessions
      On y retourne un boolean
    */
    public static function verify($userId, $token){

        if ($userId == null || $token == null) {
            return false;
        }

        if (empty($userId) || empty($token)) {
            return false;
        }

        $userOnConnect = User::getById($userId,"user");

        //On récupére l'id & le token de l'utilisateur si ces derniers sont null
        if ($userOnConnect != null && !empty($userOnConnect)) {
            if($token == $userOnConnect->getToken()) {
                $userOnConnect->setToken(Util::generateRandomString(32));
                $_SESSION["user"]["id"] = $userOnConnect->getId();
                $_SESSION["user"]["token"] = $userOnConnect->getToken();
                $userOnConnect->save();
                return true;
            }

        }
        return false;
    }

    /*
      Définit un nouveau token en cas de mot de passe oublié
    */
    public static function forgotPassword($email){

        if($email == null || empty($email)){
            return ["valid" => false, "message" => EMPTY_FIELDS];
        }

        //On vérifit quand même que l'utilisateur existe avant de redéfinir un token
        $userOnConneted = User::getUserByEmail($email);

        //Si c'est le cas , alors on génére un token.
        if($userOnConneted != null && !empty($userOnConneted)){
            $userOnConneted->setToken(Util::generateRandomString(32));
            $url = str_ireplace("{token}",$userOnConneted->getToken(),F_FORGOT_PASS);
            return ["valid"=> true, "message"=> EMAIL_VALID, "urlGenerated" => $url];
        }

        return ["valid" => false, "message" => EMAIL_NOT_EXIST];
      }

}
