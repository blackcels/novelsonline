<?php
/**
 * Created by PhpStorm.
 * User: blacks
 * Date: 02/09/2018
 * Time: 14:29
 */

class UpdateController
{

    public function indexAction($params)
    {
        $modelsData = new View("updates");
        $lastChapters = Chapter::getLastChapters();
        $myHome = new HomeJson();

        if (!$myHome->getConfig()) {
            HttpElement::getView404();
        }

        $modelsData->assign("listChapters", $lastChapters);
        $modelsData->assign("Title", $myHome->getLogoTitle());
    }

}