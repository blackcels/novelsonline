<?php
/**
 * Created by PhpStorm.
 * User: mtrembley
 * Date: 24/01/2018
 * Time: 14:00
 */

class RssFluxGenerate extends CrudFileAbstract
{

    protected $contentFile;
    private static $TITLE_ACTU = "Actualité de Goout sur les événement ! ";
    private static $DESCRIPTION = "Via cette abonnement RSS vous allez être au nouvelle sur les événement";

    /**
     * RssFluxGenerate constructor.
     */
    public function __construct(){
        parent::__construct("public/fluxRss.xml");
    }

    private function debutDoc(){
        $this->contentFile = '<?xml version="1.0" encoding="UTF-8"?>';
        $this->contentFile .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">';
        $this->contentFile .= '<atom:link href="'.UrlHelper::getHost().'/public/fluxRss.xml" rel="self" type="application/rss+xml" />';
        $this->contentFile .= '<channel>';
        $this->contentFile .= ' <title>'.self::$TITLE_ACTU.'</title>';
        $this->contentFile .= ' <link>'.UrlHelper::getHost().'</link>';
        $this->contentFile .= ' <description>'.self::$DESCRIPTION.'</description>';
        $this->contentFile .= ' <language>fr</language>';
        $this->contentFile .= ' <copyright>goout.fr</copyright>';
        $this->contentFile .= ' <managingEditor>contact.goout@gmail.com (GoOut Contact)</managingEditor>';
        $this->contentFile .= ' <category>événement</category>';
        $this->contentFile .= ' <generator>Auto</generator>';
        $this->contentFile .= ' <docs>http://www.rssboard.org</docs>';
    }

    private function finDoc(){
        $this->contentFile .= '</channel>';
        $this->contentFile .= '</rss>';
    }


    private function addItems($title, $link, $description, $date){
        $this->contentFile .= '<item>';
        $this->contentFile .= '<title>'.$title.'</title>';
        $this->contentFile .= '<link>'.$link.'</link>';
        $this->contentFile .= '<guid>'.$link.'</guid>';
        $this->contentFile .= '<pubDate>'.$date->format('D, d M Y H:i:s O').'</pubDate>';
        $this->contentFile .= '<description>'.$description.'</description>';
        $this->contentFile .= '</item>';
    }

    public function updateRss($param){

        $events = Event::getAllOrderByDateStart();
        $this->debutDoc();
        foreach ($events as $event) {
            $link = UrlHelper::getHost().str_ireplace("{idEvent}",$event->getId(), $event->getUrl());
            $this->addItems($event->getName(),$link,$event->getDescription(),new DateTime($event->getStartdate(), new \DateTimeZone( 'Europe/Paris' )));
        }
        $this->finDoc();
        $this->writeFile($this->contentFile);
    }
}