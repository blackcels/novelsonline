<?php
/**
 * Created by PhpStorm.
 * User: blacks
 * Date: 31/08/2018
 * Time: 18:56
 */

class NovelsController
{
    public function indexAction($params){
        $modelsData = new View("novels");
        $recentChapters = Chapter::getRecentChapters();
        $myNovels = Novels::getAll();
        $myHome = new HomeJson();

        if (!$myHome->getConfig()) {
            HttpElement::getView404();
        }

        $modelsData->assign("novels", $myNovels);
        $modelsData->assign("recentChapters", $recentChapters);
        $modelsData->assign("Title", $myHome->getLogoTitle());
    }
}