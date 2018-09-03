<?php
/**
 * Created by PhpStorm.
 * User: blacks
 * Date: 02/09/2018
 * Time: 14:29
 */

class UpdateController
{
    private $lastChaptersList = [];

    public function indexAction($params)
    {
        $title = htmlspecialchars($params["URL"][0]);
        $modelsData = new View("updates");
        $lastChapters = Chapter::getLastChapters();
        $myNovels = Novels::getNovelByTitle($title);
        createTab($myNovels, $lastChapters);
        $myHome = new HomeJson();

        if (!$myHome->getConfig()) {
            HttpElement::getView404();
        }

        $modelsData->assign("listChapters", $this->lastChaptersList);
        $modelsData->assign("Title", $myHome->getLogoTitle());
    }

    private function createTab($novels, $lastChapters){
        foreach ($novels as $novel) {
            foreach ($lastChapters as $chapter) {
                if ($novel->getId() == $chapter->getNovelsId()) {
                    $this->lastChaptersList[$novel->getTitle] = $chapter;
                }
            }
        }
        ksort($this->lastChaptersList);
    }

}