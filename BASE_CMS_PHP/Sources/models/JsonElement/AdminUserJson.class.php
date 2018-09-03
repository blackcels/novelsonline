<?php
/*
  Modèle de données de l'ADMINISTRATEUR DU BACK-OFFICE
  Hérité du factory dédié à la manipulation des fichier JSON(core/ConfigJsonFile)
  - Utilisé dans les delegate et les contrôleurs. 
 */

class AdminUserJson extends ConfigJsonFile {

    protected $login;
    protected $password;
    protected $token;

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    public function __construct(){
        parent::__construct(JSON."admin.json");
        $this->token = Util::generateRandomString(32);
    }



}
