<?php

/*
    Contrôleur dédié à la vue 'Mon compte' de l'utilisateur du front-office
 */

class AccountController {

    //L'action par défaut sur l'uri /about/
    public function indexAction($param){

        //Vérif. si la session est défini (via le token)
        if(!isset($_SESSION["user"]["id"]) || !isset($_SESSION["user"]["token"])){
            HttpElement::redirect(HttpElement::$STATUS_301, F_SIGN_IN);
        }

        //Même vérification de façpn factorisé via une classe dédié à la notion d'authentification
        $result = Auth::verify($_SESSION["user"]["id"], $_SESSION["user"]["token"]);
        if(!$result){
            HttpElement::redirect(HttpElement::$STATUS_301, F_SIGN_IN);
        }

        $idUser = $_SESSION["user"]["id"];
        $account = User::getById($idUser, "user");
        /*Dans la table 'utilisateur',on récupérer celui
        avec l'id $idUser */

        //Si l'utilisateur
        if($account == null || empty($account)){
            new View("500","front",true);
            return;
        }

        $this->completeAction($param, $account);

        //Redirection vers 'Mon compte' côté front
        $view = new View("v_account_user");
        $view->assign("title", "Mon Compte");
        $view->assign("account",$account);
    }

    private function completeAction($param, $account){
        if ($_SERVER['REQUEST_METHOD'] != "POST"){
            return;
        }

        $lastname = isset($param["POST"]["lastname"])? $param["POST"]["lastname"]: "";
        $fistname = isset($param["POST"]["firstname"])? $param["POST"]["firstname"]: "";
        $address = isset($param["POST"]["address"])? $param["POST"]["address"]: "";
        $zipcode = isset($param["POST"]["zipcode"])? $param["POST"]["zipcode"]: "";
        $city = isset($param["POST"]["city"])? $param["POST"]["city"]: "";
        $country = isset($param["POST"]["country"])? $param["POST"]["country"]: "";
        $mail = isset($param["POST"]["mail"])? $param["POST"]["mail"]: "";
        $password = isset($param["POST"]["password"])? $param["POST"]["password"]: "";
        $confirmPassword= isset($param["POST"]["confirm-password"])? $param["POST"]["confirm-password"]: "";
        $tel = isset($param["POST"]["tel"])? $param["POST"]["tel"]: "";
        $account->setLastname($lastname);
        $account->setFirstname($fistname);
        $account->setAddress($address);
        $account->setZipcode($zipcode);
        $account->setCity($city);
        $account->setCountry($country);
        $account->setEmail($mail);

        if (!empty($password) && !empty($confirmPassword)) {
            $password = Validate::checkPwd($password)? $password:"";
            $confirmPassword = Validate::checkPwd($confirmPassword)? $confirmPassword:"";
            if ($password === $confirmPassword){
                $account->setPassword($password);
            }
        }
        $account->setTel(Validate::checkPhoneNmber($tel));

        $account->save();
    }

}
