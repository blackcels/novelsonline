<?php
/**
 * Created by PhpStorm.
 * User: Brumax
 * Date: 19/03/2018
 * Time: 08:32
 */

    spl_autoload_register("loadClass");

    session_start();

    include "conf.inc.php";

    $inBlack = false;
    $action = "";
    $URI = $_SERVER["REQUEST_URI"]; // uri =>/user/add?id=5
    $URI = explode("?", $URI); // uri1 => /user/add, uri2 => id=5
    $URI = str_ireplace(DIRNAME2, "", urldecode($URI[0])); // uri => /user/add

    $uriExplode = "";
    // on explore la chaine pour obtenir le controller et l'action
    $uriExplode = explode(DS, $URI);


    //on initialise le controller et l'action
    $controller = (empty($uriExplode[1]))?"index":$uriExplode[1]; // controller => user
    if ( $controller == "back") {
        $inBlack= true;
        $action = (empty($uriExplode[2])) ? "index" : $uriExplode[2]; // action => add
    }

    //on retire les index 0 -> 2
    unset($uriExplode[0]);
    unset($uriExplode[1]);
    if ($inBlack)
        unset($uriExplode[2]);


    //on reformalise le nom du controller et de l'action
    $controller = ucfirst(strtolower($controller))."Controller";
    if ($inBlack)
        $action = strtolower($action)."Action";

    //on creer un tablaux de paramtre avec les variable super global et remise a 0 des index du tableau uriexploded
    $params = [ "POST" => $_POST, "GET" => $_GET, "URL" => array_values($uriExplode)];

    //echo $controller ." > ".$action;

    // initialisation de la classe dynamiquement
    $controllerPath = "controllers/".$controller.".class.php";
    if(!file_exists($controllerPath)){
        if(MODE_DEV){
            die("le fichier controller ".$controllerPath." n'existe pas!");
        }else{
            HttpElement::getView404();
        }
    }


    include($controllerPath);
    if(!class_exists($controller)){
        if(MODE_DEV){
            die("le controller ".$controller." n'existe pas!");
        }else{
            HttpElement::getView404();
        }
    }


    //initialisation du controller dynamiquement
    $object = new $controller($params);
    if($inBlack && !method_exists( $object, $action)){
        if(MODE_DEV){
            die("l'action ".$action." du controller ".$controller." n'existe pas!");
        }else{
            HttpElement::getView404();
        }
    }

    //appel de l'action dynamiquement
    if (!$inBlack)
        $object->indexAction($params);
    else
        $object->$action($params);


    function loadClass($class){
        $class = $class.".class.php";
        if (file_exists("core/".$class)) {
            include "core/".$class;
        } else if (file_exists("core/RSS/".$class)) {
            include "core/RSS/".$class;
        } else if (file_exists("core/JSON/".$class)) {
            include "core/JSON/".$class;
        } else if (file_exists("models/".$class)) {
            include "models/".$class;
        } else if (file_exists("models/jsonElement/".$class)) {
            include "models/jsonElement/".$class;
        } else {
            echo $class."n'existe pas";
        }
    }
