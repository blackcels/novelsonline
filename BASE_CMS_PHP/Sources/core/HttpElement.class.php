<?php
/*
  Le gestionnaire de statut HTTP
  - nous permet d'utiliser les réponse du serveur HTTP pour communiquer avec le client.
  - utilisé dans la plupart des contrôleurs lors des conditions.
 */

class HttpElement{

    public static $HTTP_VERSION_1_0 = "HTTP/1.0";
    public static $HTTP_VERSION_1_1 = "HTTP/1.1";

    //OK
    public static $STATUS_200 = 200;

    //redirect
    public static $STATUS_301 = 301;
    public static $STATUS_302 = 302;

    //not Found
    public static $STATUS_404 = "404 Not Found";
    public static $STATUS_410 = "410 Gone";

    //Error Server
    public static $STATUS_500 = "500 No Record Found";
    public static $STATUS_501 = "501 Not Implemented";
    public static $STATUS_502 = "502 Bad Gateway";

    /**
     * Server en maintenance
     */
    public static $STATUS_503 = "503 Service Unavailable";

    //Content Type
    public static $CONTENT_XML = "Content-Type:application/xml";
    public static $CONTENT_JSON = "Content-Type:application/json";
    public static $CONTENT_HTML = "Content-Type:text/html";
    public static $CONTENT_RSS = "Content-Type:application/rss+xml";
    public static $CONTENT_IMAGE_SVG = "Content-Type:image/svg+xml";
    public static $CONTENT_IMAGE_JPG = "Content-Type:image/jpg";
    public static $CONTENT_IMAGE_PNG = "Content-Type:image/png";
    public static $CONTENT_IMAGE_JPEG = "Content-Type:image/jpeg";



    public static function redirect($status, $url){
        header("Location: ".$url,true,$status);
    }

    public static function headerStatus($version, $status){
        header($version."".$status);
    }

    public static function headerContent($contentType){
        header($contentType);
    }

    public static function NotFound404(){
        header("HTTP/1.0 404 Not Found");
    }

    public static function getView404($template="front"){
        self::NotFound404();
        $view = new View("404",$template,true);
        $view->assign("title", "Page non trouvé");
        $view->assign("content",ERROR_404);
        die();
    }


}
