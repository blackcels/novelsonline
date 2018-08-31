<?php
/*
  Service de gestionnaire de fichier sous forme de classe abstraite
  Utilisé pour manipuler le fichiers contenant des fichiers privés

 */

abstract class CrudFileAbstract{

    protected $pathFile;

    /**
     * CrudFile constructor.
     * @param $pathFile
     */
    public function __construct($pathFile){
        if(is_string($pathFile)) {
            $this->pathFile = $pathFile;
        }
    }


    /**
     * @param $content
     * @return bool
     * Récupère le fichier pour y mettre en contenu
     * Utilisé nulle part
     */
    private function write($content){
        if(file_exists($this->pathFile)) {
            if (file_put_contents($this->pathFile, $content)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return bool|string
     * Retourne le contenu du fichier
     */
    private function read(){
        if(file_exists($this->pathFile)) {
            return file_get_contents($this->pathFile);
        }
        return false;
    }

    /**
     * @return bool|string
     * Retourne les données présents dans le fichiers json
     */
    public function readFile($json = true){
        $data=$this->read();
        if(!$data){
            return false;
        }
        if ($json)
            return json_decode($data);
        else
            return $data;
    }

    /**
     * @param $content
     * @return bool
     *
     */
    public function writeFile($content){
        if($this->write($content)){
            return true;
        }
        return false;
    }


}
