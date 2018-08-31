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
    protected $admin;
    protected $modo;
    protected $lastname;
    protected $firstname;
    protected $address;
    protected $zipcode;
    protected $city;
    protected $country;
    protected $email;
    protected $siret;
    protected $company;
    protected $companyType;
    protected $hostName;
    protected $hostIpAddress;
    protected $cnil;
    protected $cguUrl;
    protected $cgvUrl;

    public function __construct(){
        parent::__construct(JSON."admin.json");
        $this->token = Util::generateRandomString(32);
    }

    /**
     * @return mixed
     */
    public function getIdentifiant()
    {
        return $this->login;
    }

    /**
     * @param mixed $identifiant
     */
    public function setIdentifiant($identifiant)
    {
        $this->login = $identifiant;
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

    /**
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->admin;
    }

    /**
     * @param boolean $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
        $this->modo = $admin;
    }

    /**
     * @return boolean
     */
    public function isModo()
    {
        return $this->modo;
    }

    /**
     * @param boolean $modo
     */
    public function setModo($modo)
    {
        $this->modo = $modo;
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
        $this->lastname = strtoupper($lastname);
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
        $this->firstname = ucfirst($firstname);
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
        $this->city = ucfirst(strtolower($city));
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
        $this->country = ucfirst($country);
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
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * @param mixed $siret
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return mixed
     */
    public function getHostName()
    {
        return $this->hostName;
    }

    /**
     * @param mixed $hostName
     */
    public function setHostName($hostName)
    {
        $this->hostName = $hostName;
    }

    /**
     * @return mixed
     */
    public function getHostIpAddress()
    {
        return $this->hostIpAddress;
    }

    /**
     * @param mixed $hostIpAddress
     */
    public function setHostIpAddress($hostIpAddress)
    {
        $this->hostIpAddress = $hostIpAddress;
    }

    /**
     * @return mixed
     */
    public function getCompanyType()
    {
        return $this->companyType;
    }

    /**
     * @param mixed $companyType
     */
    public function setCompanyType($companyType)
    {
        $this->companyType = $companyType;
    }

    /**
     * @return mixed
     */
    public function getCnil()
    {
        return $this->cnil;
    }

    /**
     * @param mixed $cnil
     */
    public function setCnil($cnil)
    {
        $this->cnil = $cnil;
    }

    /**
     * @return mixed
     */
    public function getCguUrl()
    {
        return $this->cguUrl;
    }

    /**
     * @param mixed $cguUrl
     */
    public function setCguUrl($cguUrl)
    {
        $this->cguUrl = $cguUrl;
    }

    /**
     * @return mixed
     */
    public function getCgvUrl()
    {
        return $this->cgvUrl;
    }

    /**
     * @param mixed $cgvUrl
     */
    public function setCgvUrl($cgvUrl)
    {
        $this->cgvUrl = $cgvUrl;
    }

}
