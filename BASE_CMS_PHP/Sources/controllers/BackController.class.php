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
            $id = isset($params["POST"]["login"]) ? $params["POST"]["lastname"] : "";
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

    public function add_chapterAction($params){
        if (Auth::verifyBack($_SESSION["Admin"]["token"] ) == false){
            HttpElement::redirect(HttpElement::$STATUS_301, "/back/login");
        }
        $title = htmlspecialchars($params["URL"][0]);
        $myNovels = Novels::getNovelByTitle($title);

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $title = isset($param["POST"]["Title"])? $params["POST"]["Title"]:"";
            $chapNumber = isset($param["POST"]["Number"])? $params["POST"]["Number"]:"";
            $chapBody = isset($param["POST"]["Body"])? $params["POST"]["Body"]:"";

            if ($title != "" && $chapBody != "" && $chapNumber != ""){
                $chapter = new Chapter();
                $chapter->setChapterTitle($title);
                $chapter->setChapterNumber($chapNumber);
                $chapter->setChapterBody($chapBody);
                $chapter->setNovelsId($myNovels->getId());
                $chapter->setNovelsName(str_replace("-", " ", $title));
                if (Chapter::checkChapter($myNovels->getId(), $chapNumber)){
                    $chapter->save();
                }
                else{
                    $url = "/back/add_chapter/" . $title . "/";
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
            $title = isset($param["POST"]["Title"])? $params["POST"]["Title"]:"";
            $language = isset($param["POST"]["Language"])? $params["POST"]["Language"]:"";
            $status = isset($param["POST"]["Status"])? $params["POST"]["Status"]:"";
            $synopsis = isset($param["POST"]["Synopsis"])? $params["POST"]["Synopsis"]:"";
            $picture =  isset($_FILES["image_uploads"])? $_FILES["image_uploads"]: null;

            if ($title != "" && $language != "" && $synopsis != "" && $title != "" && $picture != ""){
                $img = Util::uploadFile($picture, $title);
                $novels = new Novels();
                $novels->setLanguage($language);
                $novels->setPicture($img["path_file"]);
                $novels->setStatus($status);
                $novels->setSynopsis($synopsis);
                $novels->setTitle($title);
                $novels->save();
            }
        }
        else {
            $title = htmlspecialchars($params["URL"][0]);
            $novels = Novels::getNovelByTitle($title);
            $modelsData = new View("add_novels", "back");

            $myHome = new HomeJson();

            if (!$myHome->getConfig()) {
                HttpElement::getView404();
            }
            $modelsData->assign("Novels", $novels);
            $modelsData->assign("Title", $myHome->getLogoTitle());
        }
    }

    public function edit_novelsAction($params){
        if (Auth::verifyBack($_SESSION["Admin"]["token"] ) == false){
            HttpElement::redirect(HttpElement::$STATUS_301, "/back/login");
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $title = isset($param["POST"]["Title"])? $params["POST"]["Title"]:"";
            $language = isset($param["POST"]["Language"])? $params["POST"]["Language"]:"";
            $status = isset($param["POST"]["Status"])? $params["POST"]["Status"]:"";
            $synopsis = isset($param["POST"]["Synopsis"])? $params["POST"]["Synopsis"]:"";
            $picture =  isset($_FILES["image_uploads"])? $_FILES["image_uploads"]: null;

            if ($title != "" && $language != "" && $synopsis != "" && $title != "" && $picture != ""){
                $img = Util::uploadFile($picture, $title);
                $novels = new Novels();
                $novels->setLanguage($language);
                $novels->setPicture($img["path_file"]);
                $novels->setStatus($status);
                $novels->setSynopsis($synopsis);
                $novels->setTitle($title);
                $novels->save();
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

    public function select_chapterAction($params){
        if (Auth::verifyBack($_SESSION["Admin"]["token"] ) == false){
            HttpElement::redirect(HttpElement::$STATUS_301, "/back/login");
        }
        $title = htmlspecialchars($params["URL"][0]);
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

    public function edit_chapterAction($params){
        if (Auth::verifyBack($_SESSION["Admin"]["token"] ) == false){
            HttpElement::redirect(HttpElement::$STATUS_301, "/back/login");
        }
        $title = htmlspecialchars($params["URL"][0]);
        $chapNumber = htmlspecialchars($params["URL"][1]);
        $myNovels = Novels::getNovelByTitle($title);
        $chapter = Chapter::geChapterFromNovel($myNovels->getId(),$chapNumber);

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $title = isset($param["POST"]["Title"])? $params["POST"]["Title"]:"";
            $chapNumber = isset($param["POST"]["Number"])? $params["POST"]["Number"]:"";
            $chapBody = isset($param["POST"]["Body"])? $params["POST"]["Body"]:"";

            if ($title != "" && $chapBody != "" && $chapNumber != ""){
                $chapter = new Chapter();
                $chapter->setChapterTitle($title);
                $chapter->setChapterNumber($chapNumber);
                $chapter->setChapterBody($chapBody);
                $chapter->setNovelsId($myNovels->getId());
                if (Chapter::checkChapter($myNovels->getId(), $chapNumber)){
                    $chapter->save();
                }
                else{
                    $url = "/back/edit_chapter/" . $title . "/" . $chapNumber . "/";
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
            $modelsData->assign("Body", $chapter->getChapterBody());
            $modelsData->assign("Title", $myHome->getLogoTitle());
        }
    }
}
