<?php
/*
    //TODO Contrôleur dédié aux Flux RSS à intégrer dans la billeterie
 */

class RssController {

    private $rss;

    public function __construct(){
        $this->rss = new RssFluxGenerate();
    }

    public function indexAction($param){
        $this->rss->updateRss($param);
        header(HttpElement::$CONTENT_XML);
        echo $this->rss->readFile(false);
    }
}
