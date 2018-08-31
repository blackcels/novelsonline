<?php
/**
 * Created by PhpStorm.
 * User: Brumax
 * Date: 28/11/2017
 * Time: 10:53
 */


define("JSON","private/json/");
define("DS", strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'? "/" : DIRECTORY_SEPARATOR);
$scriptname = (dirname($_SERVER["SCRIPT_NAME"]) === "/") ? "" : dirname($_SERVER["SCRIPT_NAME"]);
define("DIRNAME",$scriptname.DS);
define("DIRNAME2",$_SERVER["SCRIPT_NAME"].DS);
define("MODE_DEV",false);

