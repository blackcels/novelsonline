<?php
/*
  Element JSON pour les paramètres de connexion BDD
  Hérité du factory dédié à la manipulation des fichier JSON(core/ConfigJsonFile)
  - Utilisé dans le moteur de requête SQL(core/BaseSql.class.php), le settingDelegate et le TestControlleur
 */
class DatabaseJson extends ConfigJsonFile {
    protected $dbUser;
    protected $dbPwd;
    protected $dbHost;
    protected $dbName;
    protected $dbPort;
    public function __construct(){
        parent::__construct(JSON."database.json");
    }
    /**
     * @return mixed
     */
    public function getDbUser()
    {
        return $this->dbUser;
    }
    /**
     * @param mixed $dbUser
     */
    public function setDbUser($dbUser)
    {
        $this->dbUser = $dbUser;
    }
    /**
     * @return mixed
     */
    public function getDbPwd()
    {
        return $this->dbPwd;
    }
    /**
     * @param mixed $dbPwd
     */
    public function setDbPwd($dbPwd)
    {
        $this->dbPwd = $dbPwd;
    }
    /**
     * @return mixed
     */
    public function getDbHost()
    {
        return $this->dbHost;
    }
    /**
     * @param mixed $dbHost
     */
    public function setDbHost($dbHost)
    {
        $this->dbHost = $dbHost;
    }
    /**
     * @return mixed
     */
    public function getDbName()
    {
        return $this->dbName;
    }
    /**
     * @param mixed $dbName
     */
    public function setDbName($dbName)
    {
        $this->dbName = $dbName;
    }
    /**
     * @return mixed
     */
    public function getDbPort()
    {
        return $this->dbPort;
    }
    /**
     * @param mixed $dbPort
     */
    public function setDbPort($dbPort)
    {
        $this->dbPort = $dbPort;
    }
}