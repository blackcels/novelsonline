<?php
/**
 * Created by PhpStorm.
 * User: Brumax
 * Date: 30/01/2018
 * Time: 10:15
 */

class User extends BaseSql {

    protected $id = null;
    protected $firstname;
    protected $lastname;
    protected $password;
    protected $address;
    protected $zipcode;
    protected $city;
    protected $tel;
    protected $email;
    protected $registerdate;
    protected $modifiydate;
    protected $country;
    protected $actived;
    protected $token;

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = str_ireplace(" ", "-",ucfirst(strtolower($firstname)));
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = str_ireplace(" ", "-", strtoupper($lastname));
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
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param mixed $zipcode
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = str_ireplace(" ", "-",ucfirst(strtolower($city)));
    }

    /**
     * @return mixed
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param mixed $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getRegisterdate()
    {
        return $this->registerdate;
    }

    /**
     * @param mixed $registerdate
     */
    public function setRegisterdate($registerdate)
    {
        $this->registerdate = $registerdate;
    }

    /**
     * @return mixed
     */
    public function getModifydate()
    {
        return $this->modifiydate;
    }

    /**
     * @param mixed $modifydate
     */
    public function setModifydate($modifydate)
    {
        $this->modifiydate = $modifydate;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = str_ireplace(" ", "-",strtoupper($country));
    }

    /**
     * @return mixed
     */
    public function isActived()
    {
        if ($this->actived == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param mixed $actived
     */
    public function setActived($actived)
    {
        if ($actived) {
            $this->actived = 1;
        }else {
            $this->actived = 0;
        }
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }




    /****************** Modals ******************/

    public function configFormAdd(){

        return [
            "config"=>["method"=>"POST", "action"=>"", "submit"=>"S'inscrire"],
            "input"=>[
                "firstname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre prénom",
                    "required"=>true,
                    "maxString"=>100,
                    "minString"=>2
                ],
                "lastname"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre nom",
                    "required"=>true,
                    "maxString"=>100,
                    "minString"=>2
                ],
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email",
                    "required"=>true
                ],
                "emailConfirm"=>[
                    "type"=>"email",
                    "placeholder"=>"Confirmer votre email",
                    "required"=>true,
                    "confirm"=>"email"
                ],
                "pwd"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe",
                    "required"=>true
                ],
                "pwdConfirm"=>[
                    "type"=>"password",
                    "placeholder"=>"Confirmer votre mot de passe",
                    "required"=>true,
                    "confirm"=>"pwd"
                ],
                "age"=>[
                    "type"=>"number",
                    "placeholder"=>"Votre age",
                    "required"=>true,
                    "maxNum"=>100,
                    "minNum"=>18
                ]
            ]
        ];
    }

    //Le modal pour modifier les infos d'un utilisateur existant
    public function configFormUpdate($email){

      //1) On récupére les infos du User via son mail
      $user = User::getUserByEmail($email);

      //2) On retourne les attributs du formulaire en mettant certaines
      //données en placeholder
      return [
          "config"=>["method"=>"POST", "action"=>"", "submit"=>"S'inscrire"],
          "input"=>[
              "firstname"=>[
                  "type"=>"text",
                  "placeholder"=>"Prénom",
                  "maxString"=>100,
                  "minString"=>2
              ],
              "lastname"=>[
                  "type"=>"text",
                  "placeholder"=>"Nom",
                  "maxString"=>100,
                  "minString"=>2
              ],
              "email"=>[
                  "type"=>"email",
                  "placeholder"=>"E-mail",
              ],
              "pwd"=>[
                  "type"=>"password",
                  "placeholder"=>"Nouveau mot de passe de l'utilisateur",
                  "required"=>true
              ],
              "pwdConfirm"=>[
                  "type"=>"password",
                  "placeholder"=>"Mot de passe administrateur",
                  "required"=>true,
                  "confirm"=>"pwd"
              ]
          ]
      ];

    }

    /****************** End Modals ******************/

    /****************** Request SQL Specific ******************/
    /**
     * @param $email
     * @return mixed
     */
    public static function getUserByEmail($email){
        $pdo = self::getIntancePdo();
        $query = $pdo->prepare("SELECT * FROM user where email = :email");
        $query->execute(["email"=>$email]);
        return $query->fetchObject(get_class());
    }

    /****************** End Request SQL specific ******************/

}
