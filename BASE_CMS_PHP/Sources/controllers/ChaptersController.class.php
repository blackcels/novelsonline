<?php
/**
 * Created by PhpStorm.
 * User: blacks
 * Date: 31/08/2018
 * Time: 21:26
 */

class ChaptersController
{
    public function indexAction($params)
    {
        if (count($params["URL"]) == 2){
            $title = htmlspecialchars($params["URL"][0]);
            $modelsData = new View("chapters");
            $recentChapters = Chapter::getRecentChapters();
            $myNovels = Novels::getNovelByTitle($title);
            $chapter = chapter::geChaptersByNovels($myNovels->getId());
            $myHome = new HomeJson();

            if (!$myHome->getConfig()) {
                HttpElement::getView404();
            }

            $modelsData->assign("novel", $myNovels);
            $modelsData->assign("recentChapters", $recentChapters);
            $modelsData->assign("chapters", $chapter);
            $modelsData->assign("Title", $myHome->getLogoTitle());
        }
        else if (count($params["URL"]) == 3){
            $modelsData = new View("viewingChapters");
            $title = htmlspecialchars($params["URL"][0]);
            $chapNumber = htmlspecialchars($params["URL"][1]);
            $recentChapters = Chapter::getRecentChapters();
            $myNovel = Novels::getNovelByTitle($title);
            $id = $myNovel->getId();
            $chapter = chapter::geChapterFromNovel($id, $chapNumber);
            $myHome = new HomeJson();

            if (!$myHome->getConfig()) {
                HttpElement::getView404();
            }

            $modelsData->assign("novel", $myNovel);
            $modelsData->assign("recentChapters", $recentChapters);
            $modelsData->assign("chapter", $chapter[0]);
            $modelsData->assign("Title", $myHome->getLogoTitle());
        }
        else{
            HttpElement::getView404();
        }
    }
}