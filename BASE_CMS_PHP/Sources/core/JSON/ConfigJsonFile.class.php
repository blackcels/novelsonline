<?php
/*
  Factory dédié à la manipulation des fichier JSON
  Hérite de notre gestionnaire de fichier en PHP 'CrudFileAbstract'
 */

class ConfigJsonFile extends CrudFileAbstract{

    protected $attributes;//Les attributs dans le fichier JSON récupéré

    /**
     * ConfigJsonFile constructor.
     */
    public function __construct($pathFile) {
        parent::__construct($pathFile);
    }

    //Créer la liste des attributs de l'objet JSON
    protected function toArrayAttributeClass(){
        $attributesExluded = get_class_vars(get_class());
        $this->attributes = array_diff_key(get_object_vars($this),$attributesExluded );
    }

    public function save(){
        $this->toArrayAttributeClass();
        if (!$this->writeFile(json_encode($this->attributes))) {
            return ["write" => "false"];
        }
    }

    //Récupére les attributs de l'objet JSON et vérifie si ces derniers sont bien définis
    public function getConfig(){
        $contentJson = $this->readFile();
        if($contentJson == null || empty($contentJson)){
            return false;
        }
        foreach ($contentJson as $key => $value) {
                $this->$key = $value;
        }
        return true;
    }

    //Retourne la liste des attributs
    public function __toString(){
        header(HttpElement::$CONTENT_JSON);
        $this->toArrayAttributeClass();
        return json_encode($this->attributes);
    }
}
