<?php
/*
      Classe de traitement :
      - Générer une chaîne de char pour le TOKEN de l'utilisateur
      - Uploder un fichier
      - Valider le format d'un adresse mail
 */

class Util {

    //Générer une chaîne de char pour le TOKEN de l'utilisateur
    public static function generateRandomString($length = 10) {
        $charactersLength = "";
        $randomString = "";
        $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $charactersLength = strlen($characters);
        for ($i = 0; $i < $length+1; $i++) {
            $randomString .= $characters[rand(0, $charactersLength)];
        }
        return $randomString;
    }

    //Uploder un fichier
    public static function uploadFile($file, $path = "private/img/", $name="", $option = []){
        if (!isset($file)){
            return ["uploaded" => false, "message" => "file is empty"];
        }
        if ($file["error"] > 0) {
            return ["uploaded" => false, "message" => "Une erreur et survenu"];
        }

        if (isset($option["size"]) && $file["size"] > $option["size"]) {
            return ["uploaded" => false, "message" => "taille du fichier trop volumineux"];
        }

        $fileType = strrchr($file["name"], ".");

        if(empty($name)){
            $name = explode(".",$file["name"])[0];
        }

        $pathFile = $path.$name.$fileType;

        if (move_uploaded_file ($file["tmp_name"], $pathFile)) {
            return ["uploaded" => true, "path_file" => $pathFile];
        }

        return ["uploaded" => false];
    }

    //Valider le format d'un adresse mail
    public static function emailValide($email) {
        return filter_var(trim($email), FILTER_VALIDATE_EMAIL);
    }

}
