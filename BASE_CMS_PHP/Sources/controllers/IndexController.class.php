<?php

class IndexController {


    public function indexAction($params)
    {
        $modelsData = new View("v_index.view.php");
        $myHome = new HomeJson();
        if (!$myHome->getConfig()) {
            HttpElement::getView404();
        }
        $recentChapters = Chapter::getRecentChapters();


        $modelsData->assign("Description", $myHome->getDescription());
        $modelsData->assign("recentChapters", $recentChapters);
        $modelsData->assign("Title", $myHome->getLogoTitle());
    }
}