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
        if (count($params["URL"]) == 1){
            $title = htmlspecialchars($params["URL"][0]);
            $modelsData = new View("chapters");
            $recentChapters = Chapter::getRecentChapters();
            $myNovels = Novels::getNovelByTitle($title);
            $chapter = chapter::geChaptersByNovels($myNovels->getId());
            $myHome = new HomeJson();

            if (!$myHome->getConfig()) {
                HttpElement::getView404();
            }

            $modelsData->assign("novels", $myNovels);
            $modelsData->assign("recentChapters", $recentChapters);
            $modelsData->assign("Chapters", $chapter);
            $modelsData->assign("Title", $myHome->getLogoTitle());
        }
        else if (count($params["URL"]) == 2){
            $title = htmlspecialchars($params["URL"][0]);
            $recentChapters = Chapter::getRecentChapters();
            $chapNumber = htmlspecialchars($params["URL"][1]);
            $modelsData = new View("viewingChapters");
            $myNovel = Novels::getNovelByTitle($title);
            $chapter = chapter::geChapterFromNovel($myNovel->getId(), $chapNumber);
            $myHome = new HomeJson();

            if (!$myHome->getConfig()) {
                HttpElement::getView404();
            }
            $modelsData->assign("novels", $myNovel);
            $modelsData->assign("recentChapters", $recentChapters);
            $modelsData->assign("Chapter", $chapter);
            $modelsData->assign("Title", $myHome->getLogoTitle());
        }
        else{
            HttpElement::getView404();
        }
    }
}