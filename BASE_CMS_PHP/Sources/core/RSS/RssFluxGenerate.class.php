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
    private static $TITLE_ACTU = "Update of your favorites novels";
    private static $DESCRIPTION = "You'll see every new chapters'publication of all novels";

    /**
     * RssFluxGenerate constructor.
     */
    public function __construct(){
        parent::__construct("public/fluxRss.xml");
    }

    private function debutDoc(){
        $this->contentFile = '<?xml version="1.0" encoding="UTF-8"?>';
        $this->contentFile .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">';
        $this->contentFile .= '<atom:link href="https://novelonline.ovh/fluxRss.rss" rel="self" type="application/rss+xml" />';
        $this->contentFile .= '<channel>';
        $this->contentFile .= ' <title>'.self::$TITLE_ACTU.'</title>';
        $this->contentFile .= ' <link>https://novelonline.ovh/</link>';
        $this->contentFile .= ' <description>'.self::$DESCRIPTION.'</description>';
        $this->contentFile .= ' <language>en</language>';
        $this->contentFile .= ' <copyright>novelonline.ovh</copyright>';
        $this->contentFile .= ' <managingEditor>novelonline@gmail.com</managingEditor>';
        $this->contentFile .= ' <category>Translations</category>';
        $this->contentFile .= ' <generator>Auto</generator>';
        $this->contentFile .= ' <docs>http://www.rssboard.org</docs>';
    }

    private function finDoc(){
        $this->contentFile .= '</channel>';
        $this->contentFile .= '</rss>';
    }


    private function addItems($title, $link, $date){
        $this->contentFile .= '<item>';
        $this->contentFile .= '<title>'.$title.'</title>';
        $this->contentFile .= '<link>'.$link.'</link>';
        $this->contentFile .= '<guid>'.$link.'</guid>';
        $this->contentFile .= '<pubDate>'.$date->format('D, d M Y H:i:s O').'</pubDate>';
        $this->contentFile .= '</item>';
    }

    public function updateRss($param){
        $recentChapters = Chapter::getLastChapters();
        $this->debutDoc();
        foreach ($recentChapters as $chapter) {
            $this->addItems($chapter->getNovelsName() . " chapter " . $chapter->getChapterNumber() . " : ". $chapter->getChapterTitle(),
                "https://novelonline.ovh/chapter/" . str_replace(" ", "-", $chapter->getNovelsName()) . "/" . $chapter->getChapterNumber() . "/",
                new DateTime($chapter->getCreateDate(), new \DateTimeZone( 'Europe/Paris' )));
        }
        $this->finDoc();
        $this->writeFile($this->contentFile);
    }
}