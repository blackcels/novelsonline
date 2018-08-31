<?php
/**
 * Created by PhpStorm.
 * User: blacks
 * Date: 31/08/2018
 * Time: 19:18
 */

class Chapter
{
    protected $id = null;
    protected $chapter_number;
    protected $chapter_title;
    protected $chapter_body;
    protected $novels_id;
    protected $create_date;
    protected $modified_date;

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getChapterNumber()
    {
        return $this->chapter_number;
    }

    /**
     * @param mixed $chapter_number
     */
    public function setChapterNumber($chapter_number)
    {
        $this->chapter_number = $chapter_number;
    }

    /**
     * @return mixed
     */
    public function getChapterTitle()
    {
        return ucfirst(strtolower($this->chapter_title));
    }

    /**
     * @param mixed $chapter_title
     */
    public function setChapterTitle($chapter_title)
    {
        $this->chapter_title = $chapter_title;
    }

    /**
     * @return mixed
     */
    public function getChapterBody()
    {
        return $this->chapter_body;
    }

    /**
     * @param mixed $chapter_body
     */
    public function setChapterBody($chapter_body)
    {
        $this->chapter_body = $chapter_body;
    }

    /**
     * @return mixed
     */
    public function getNovelsId()
    {
        return $this->novels_id;
    }

    /**
     * @param mixed $novels_id
     */
    public function setNovelsId($novels_id)
    {
        $this->novels_id = $novels_id;
    }

    /**
     * @return mixed
     */
    public function getCreateDate()
    {
        return $this->create_date;
    }

    /**
     * @param mixed $create_date
     */
    public function setCreateDate($create_date)
    {
        $this->create_date = $create_date;
    }

    /**
     * @return mixed
     */
    public function getModifiedDate()
    {
        return $this->modified_date;
    }

    /**
     * @param mixed $modified_date
     */
    public function setModifiedDate($modified_date)
    {
        $this->modified_date = $modified_date;
    }

    public static function getRecentChapters()
    {
        $max = self::count();
        $recentChapters = self::getAllWithLimit(($max - 10), $max);
        return $recentChapters;
    }

    public static function geChaptersByNovels($idNovels)
    {
        $pdo = self::getIntancePdo();
        $request = "SELECT * FROM `chapter` WHERE novels_id = :idNovels";
        $query = $pdo->prepare($request);
        $query->execute(["idNovels"=>$idNovels]);
        return $query->fetchAll(PDO::FETCH_CLASS, get_class());
    }

    public static function getLastChapters()
    {
        $pdo = self::getIntancePdo();
        $request = "SELECT *
        FROM chapter
        WHERE id IN (
        SELECT MAX(id)
        FROM chapter
        GROUP BY novels_id)";
        $query = $pdo->prepare($request);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, get_class());
    }

}