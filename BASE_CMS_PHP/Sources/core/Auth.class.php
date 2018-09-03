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
        if ($login == $admin->getlogin() && password_verify($pass, $admin->getPassword())) {
            $admin->setToken(Util::generateRandomString(32));
            $_SESSION["Admin"]["token"] = $admin->getToken();
            $admin->save();
            return $admin;

        }
        return false;

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
            return true;
        }
        return false;
    }

}
