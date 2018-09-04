<?php
/*
    Contrôleur des vues 'Connecion', 'Inscription' , 'Mot de passe oublié' et 'Réinitialisation du mot de passe'
 */

class BackController {
    public function indexAction($params){
        if (Auth::verifyBack($_SESSION["Admin"]["token"] ) == false){
            HttpElement::redirect(HttpElement::$STATUS_301, "/back/login");
        }
        else{
            HttpElement::redirect(HttpElement::$STATUS_301, "/back/home");
        }
    }

    public function loginAction($params){
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $id = isset($params["POST"]["login"]) ? $params["POST"]["login"] : "";
            $password = isset($params["POST"]["password"]) ? $params["POST"]["password"] : "";

            if ($id == "" or $password == "") {
                $_SESSION["ERREUR"]["AUTH"] = "Ientifiant ou mot de passe incorect";
                HttpElement::redirect(HttpElement::$STATUS_301, "/back/login");
            } else {
                $admin = Auth::connectBack($id, $password);
                if ($admin === false) {
                    $_SESSION["ERREUR"]["AUTH"] = "Ientifiant ou mot de passe incorect";
                    HttpElement::redirect(HttpElement::$STATUS_301, "/back/login");
                } else {
                    HttpElement::redirect(HttpElement::$STATUS_301, "/back/home");
                }
            }
        }
        else{
            new View("login", "back");
        }
    }

    public function homeAction($params){
        if (Auth::verifyBack($_SESSION["Admin"]["token"] ) == false){
            HttpElement::redirect(HttpElement::$STATUS_301, "/back/login");
        }
        $myNovels = Novels::getAll();
        $modelsData = new View("home", "back");

        $myHome = new HomeJson();

        if (!$myHome->getConfig()) {
            HttpElement::getView404();
        }
        $modelsData->assign("Novels", $myNovels);
        $modelsData->assign("Title", $myHome->getLogoTitle());
    }
    public function edit_chapterAction($params){
        if (Auth::verifyBack($_SESSION["Admin"]["token"] ) == false){
            HttpElement::redirect(HttpElement::$STATUS_301, "/back/login");
        }
        $title = htmlspecialchars($params["URL"][0]);
        $chapNumber = htmlspecialchars($params["URL"][1]);
        $myNovels = Novels::getNovelByTitle($title);
        $chapter = Chapter::geChapterFromNovel($myNovels->getId(),$chapNumber);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $title = isset($params["POST"]["Title"])? $params["POST"]["Title"]:"";
            $chapNumber = isset($params["POST"]["Number"])? $params["POST"]["Number"]:"";
            $chapBody = isset($params["POST"]["Body"])? $params["POST"]["Body"]:"";
            if ($title != "" && $chapBody != "" && $chapNumber != ""){
                $chapterNew = new Chapter();
                $chapterNew->setId($chapter[0]->getId());
                $chapterNew->setChapterTitle($title);
                $chapterNew->setChapterNumber($chapNumber);
                $chapterNew->setChapterBody($chapBody);
                $chapterNew->setNovelsId($myNovels->getId());
                $chapterNew->setNovelsName($myNovels->getTitle());
                $chapterNew->setCreateDate($chapter[0]->getCreateDate());
                $chapterNew->setModifiedDate($chapter[0]->getModifiedDate());
                if (Chapter::checkChapter($myNovels->getId(), $chapNumber)){
                    print_r($chapterNew->save());
                    $url = "/back/edit_chapter/" . str_replace(" ", "-",$myNovels->getTitle()) . "/" . $chapNumber . "/";
                    HttpElement::redirect(HttpElement::$STATUS_301, $url);
                }
                else{
                    $url = "/back/edit_chapter/" . str_replace(" ", "-",$myNovels->getTitle()) . "/" . $chapNumber . "/";
                    $_SESSION["ERREUR"]["BASE"] = "Chapitre déjà éxistant";
                    HttpElement::redirect(HttpElement::$STATUS_301, $url);

                }
            }
        }
        else{
            $modelsData = new View("edit_chapter", "back");

            $myHome = new HomeJson();

            if (!$myHome->getConfig()) {
                HttpElement::getView404();
            }
            $modelsData->assign("Novels", $myNovels);
            $modelsData->assign("Number", $chapNumber);
            $modelsData->assign("Body", $chapter[0]->getChapterBody());
            $modelsData->assign("ChapterTitle", $chapter[0]->getChapterTitle());
            $modelsData->assign("Title", $myHome->getLogoTitle());
        }
    }

    public function add_chapterAction($params){
        if (Auth::verifyBack($_SESSION["Admin"]["token"] ) == false){
            HttpElement::redirect(HttpElement::$STATUS_301, "/back/login");
        }
        $title = htmlspecialchars($params["GET"]["NovelList1"]);
        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            $title = htmlspecialchars($params["URL"][0]);
        }
        $myNovels = Novels::getNovelByTitle($title);
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $Chaptitle = isset($params["POST"]["Title"])? $params["POST"]["Title"]:"";
            $chapNumber = isset($params["POST"]["Number"])? $params["POST"]["Number"]:"";
            $chapBody = isset($params["POST"]["Body"])? $params["POST"]["Body"]:"";

            if ($Chaptitle != "" && $chapBody != "" && $chapNumber != ""){
                $chapterNew = new Chapter();
                $chapterNew->setChapterTitle($Chaptitle);
                $chapterNew->setChapterNumber($chapNumber);
                $chapterNew->setChapterBody($chapBody);
                $chapterNew->setNovelsId($myNovels->getId());
                $chapterNew->setNovelsName($myNovels->getTitle());
                date_default_timezone_set('UTC');
                $date = date("Y-m-d H:i:s");
                $chapterNew->setCreateDate($date);
                $chapterNew->setModifiedDate($date);
                if (!Chapter::checkChapter($myNovels->getId(), $chapNumber)){
                    $url = "/back/add_chapter/" . str_replace(" ", "-",$myNovels->getTitle()) . "/";
                    $chapterNew->save();
                    HttpElement::redirect(HttpElement::$STATUS_301, $url);
                }
                else{
                    $url = "/back/add_chapter/" . str_replace(" ", "-",$myNovels->getTitle()) . "/";
                    $_SESSION["ERREUR"]["AUTH"] = "Ientifiant où mot de passe incorect";
                    HttpElement::redirect(HttpElement::$STATUS_301, $url);
                }
            }
        }
        else {
            $modelsData = new View("add_chapter", "back");

            $myHome = new HomeJson();

            if (!$myHome->getConfig()) {
                HttpElement::getView404();
            }
            $modelsData->assign("Novels", $myNovels);
            $modelsData->assign("Title", $myHome->getLogoTitle());
            $modelsData->assign("Novelsname", str_replace("-", " ", $title));

        }
    }

    public function add_novelsAction($params){
        if (Auth::verifyBack($_SESSION["Admin"]["token"] ) == false){
            HttpElement::redirect(HttpElement::$STATUS_301, "/back/login");
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $title = isset($params["POST"]["Title"])? $params["POST"]["Title"]:"";
            $language = isset($params["POST"]["Language"])? $params["POST"]["Language"]:"";
            $status = isset($params["POST"]["Status"])? $params["POST"]["Status"]:"";
            $synopsis = isset($params["POST"]["Synopsis"])? $params["POST"]["Synopsis"]:"";
            $picture =  isset($_FILES["image_uploads"])? $_FILES["image_uploads"]: null;
            if ($title != "" && $language != "" && $synopsis != "" && $title != ""){
                $img = Util::uploadFile($picture, $title);
                $novels = new Novels();
                $novels->setLanguage($language);
                $novels->setPicture($img["path_file"]);
                $novels->setStatus($status);
                $novels->setSynopsis($synopsis);
                $novels->setTitle($title);
                date_default_timezone_set('UTC');
                $date = date("Y-m-d H:i:s");
                $novels->setCreateDate($date);
                $novels->setModifiedDate($date);
                $novels->save();
                $url = "/back/add_novels/";
                HttpElement::redirect(HttpElement::$STATUS_301, $url);
            }
        }
        else {

            $modelsData = new View("add_novels", "back");

            $myHome = new HomeJson();

            if (!$myHome->getConfig()) {
                HttpElement::getView404();
            }
            $modelsData->assign("Title", $myHome->getLogoTitle());
        }
    }

    public function edit_novelsAction($params){
        if (Auth::verifyBack($_SESSION["Admin"]["token"] ) == false){
            HttpElement::redirect(HttpElement::$STATUS_301, "/back/login");
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $title = htmlspecialchars($params["URL"][0]);
            $mynovels = Novels::getNovelByTitle($title);
            $title = isset($params["POST"]["Title"])? $params["POST"]["Title"]:"";
            $language = isset($params["POST"]["Language"])? $params["POST"]["Language"]:"";
            $status = isset($params["POST"]["Status"])? $params["POST"]["Status"]:"";
            $synopsis = isset($params["POST"]["Synopsis"])? $params["POST"]["Synopsis"]:"";
            $picture =  isset($_FILES["image_uploads"])? $_FILES["image_uploads"]: null;

            if ($title != "" && $language != "" && $synopsis != "" && $title != ""){
                $img = Util::uploadFile($picture, $title);
                $novels = new Novels();
                $novels->setId($mynovels->getId());
                $novels->setLanguage($language);
                $novels->setPicture($img["path_file"]);
                $novels->setStatus($status);
                $novels->setSynopsis($synopsis);
                $novels->setTitle($title);
                date_default_timezone_set('UTC');
                $date = date("Y-m-d H:i:s");
                $novels->setCreateDate($date);
                $novels->setModifiedDate($date);
                $novels->save();
                $url = "/back/add_novels/" . $novels->getTitle();
                HttpElement::redirect(HttpElement::$STATUS_301, $url);
            }
        }
        else {
            $title = htmlspecialchars($params["GET"]["NovelList3"]);
            $novels = Novels::getNovelByTitle($title);
            $modelsData = new View("edit_novels", "back");

            $myHome = new HomeJson();

            if (!$myHome->getConfig()) {
                HttpElement::getView404();
            }
            $modelsData->assign("Novels", $novels);
            $modelsData->assign("Title", $myHome->getLogoTitle());
        }
    }

    public function select_chapterAction($params){
        if (Auth::verifyBack($_SESSION["Admin"]["token"] ) == false){
            HttpElement::redirect(HttpElement::$STATUS_301, "/back/login");
        }
        $title = htmlspecialchars($params["GET"]["NovelList2"]);
        $myNovels = Novels::getNovelByTitle($title);
        $myChapters = Chapter::geChaptersByNovels($myNovels->getId());
        $modelsData = new View("select_chapter", "back");
        $myHome = new HomeJson();

        if (!$myHome->getConfig()) {
            HttpElement::getView404();
        }
        $modelsData->assign("Chapters", $myChapters);
        $modelsData->assign("Novels", $myNovels);
        $modelsData->assign("Title", $myHome->getLogoTitle());
    }

}
