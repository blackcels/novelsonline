<?php
/**
 * Created by PhpStorm.
 * User: Brumax
 * Date: 02/07/2018
 * Time: 10:16
 */

class UrlHelper {

    public static function getHost(){
        if (MODE_DEV){
            return "http://localhost:8080";
        } else {
            return "http://localhost/";
        }
    }

}