<?php
/*
    Moteur de requête SQL
    Il s'agit d'une classe mère car ce sera les modèles qui communiquera avec la Base de données.
 */

class BaseSql
{

    protected $table; //
    private $attributes = [];
    protected $pdo;

    /**
     * BaseSql constructor.
     */
    public function __construct(){
        $this->table = strtolower(get_called_class());
        $this->pdo = self::getIntancePdo();
    }

    /*
      Créer un tableau des attributs d'un modèle pour pointer les champs de sa
      table respectif
     */
    private function diffAttributes(){
        $attributesExluded = get_class_vars(get_class());
        $this->attributes = array_diff_key(get_object_vars($this),$attributesExluded );
    }

    //Pour insérer/mettre une occurence dans la BDD
    public function save(){
        $this->diffAttributes();
        // Si l'entité existe , alors on l'insère en BDD
        try {
            if ($this->id) {
                $querySting = [];
                foreach ($this->attributes as $key => $value) {
                    $querySting[] = $key . "=:" . $key;
                }

                //echo ("UPDATE ".$this->table." SET ".$querySting." WHERE id = :id");
                $query = $this->pdo->prepare("UPDATE " . $this->table . " SET " . implode(",", $querySting) . " WHERE id = :id");
                //echo $query->queryString;
                $query->execute($this->attributes);
            } else {
                // Si l'entité existe , alors on le met en jour

                //$database = new DatabaseJson();
                //$database->getConfig();
                //$this->pdo = new PDO("mysql:host=".$database->getDbHost().";dbname=".$database->getDbName().";port=".$database->getDbPort(), $database->getDbUser(),$database->getDbPwd());
                $query = $this->pdo->prepare('INSERT INTO ' . $this->table . ' (' . implode(",", array_keys($this->attributes)) . ') VALUES
            (:' . implode(",:", array_keys($this->attributes)) . ')');
                //echo $query->queryString;
                $query->execute($this->attributes);
            }
        }catch (Exception $e){
            HttpElement::redirect(HttpElement::$STATUS_301, B_HOME);
            return $e;
        }
    }

    //Récupèrer une ligne de données d'une table via son ID
    public static function getById($id, $table=""){
        $pdo = self::getIntancePdo();
        if($pdo){
            $query = $pdo->prepare("SELECT * FROM ".strtolower(get_called_class())." WHERE id = :id");
            $query->execute(["id"=>$id]);
            return $query->fetchObject(get_called_class());
        }
    }

    /**
     * @return array
     * Récupérer toutes les lignes d'une table
     */
    public static function getAll($table=""){
        $pdo = self::getIntancePdo();
        if($pdo){
            $query = $pdo->prepare("SELECT * FROM " . strtolower(get_called_class()));
            $query->execute();
            return $query->fetchAll(PDO::FETCH_CLASS, get_called_class());
        }
    }

    /**
     * @return array
     * Récupérer toutes les lignes d'une table en limitant le nombre de sorties
     */
    public static function getAllWithLimit($begin, $count, $table=""){
        $pdo = self::getIntancePdo();
        if($pdo){
            $query = $pdo->prepare("SELECT * FROM " . strtolower(get_called_class()) . " LIMIT(:begin, :count)");
            $query->execute(["begin" => $begin, "count" => $count]);
            return $query->fetchAll(PDO::FETCH_CLASS, get_called_class());
        }
    }

    //Récupèrer le nombre de ligne dans une table
    public static function count($table=""){
        $pdo = self::getIntancePdo();
        if($pdo){
            $query = $pdo->prepare("SELECT COUNT(*) FROM ".strtolower(get_called_class()));
            return $query->rowCount();
        }
    }

    //Générer une instance PDO pour se connecter à la BDD
    protected static function getIntancePdo(){
        $pdo = null;
        try{
            //On récupère les infos relatives à la BDD via l'élément JSON Database
            $database = new DatabaseJson();
            if($database->getConfig()){
                $pdo = new PDO("mysql:host=".$database->getDbHost().";dbname=".$database->getDbName().";port=".$database->getDbPort(), $database->getDbUser(),$database->getDbPwd(), array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            }
        }catch (Exception $e){//Cas d'erreur à gérer
            $e->getMessage();
            return null;
        }
        return $pdo;
    }


}
