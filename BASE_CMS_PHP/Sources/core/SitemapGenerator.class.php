<?php
/*
      Générateur de site map
      //TODO à commenter
 */

class SitemapGenerator extends CrudFileAbstract{

    private $sitemap;

    private $url;

    /**
     * SitemapGenerator constructor.
     * @param $sitemap
     */
    public function __construct()
    {
        $this->url = UrlHelper::getHost();
        $this->pathFile = "sitemap.xml";
    }

    private function startSiteMap(){

        $this->sitemap = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $this->sitemap .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
        $this->addUrlOnSiteMap($this->url);
        $this->addUrlOnSiteMap($this->url."/");
        $this->addUrlOnSiteMap($this->url.F_HOME);
        $this->addUrlOnSiteMap($this->url.F_CONTACT);
        $this->addUrlOnSiteMap($this->url.F_HELP);
        $this->addUrlOnSiteMap($this->url.F_CG);
        $this->addUrlOnSiteMap($this->url.F_CG);
        $this->addUrlOnSiteMap($this->url.F_LEGAL);
        $this->addUrlOnSiteMap($this->url.F_OWNER);
        $this->addUrlOnSiteMap($this->url.F_SIGN_IN);
        $this->addUrlOnSiteMap($this->url.F_SITE_MAP);
    }

    private function endSiteMap(){

        $this->sitemap .= "</urlset>";

    }

    private function addUrlOnSiteMap($url){

        $this->sitemap .= "\t<url>\n";
        $this->sitemap .= "\t\t<loc>".$url."</loc>\n";
        $this->sitemap .= "\t</url>\n";
    }

    public function generateSiteMap(){

        $events = Event::getAll("event");

        $this->startSiteMap();

        foreach ($events as $event){
            $url = str_ireplace("{idEvent}", $event->getId(), $event->getUrl());
            $this->addUrlOnSiteMap($this->url.$url);
        }

        $this->endSiteMap();

        $this->writeFile($this->sitemap);

    }

}
