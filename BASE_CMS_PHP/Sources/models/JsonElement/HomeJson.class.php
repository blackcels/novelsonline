<?php
/**
 * Created by PhpStorm.
 * User: blacks
 * Date: 31/08/2018
 * Time: 19:23
 */

class HomeJson extends ConfigJsonFile
{
        protected $description;
        protected $logoTitle;

    public function __construct(){
        parent::__construct(JSON."home.json");
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getLogoTitle()
    {
        return $this->logoTitle;
    }

    /**
     * @param mixed $logoTitle
     */
    public function setLogoTitle($logoTitle)
    {
        $this->logoTitle = $logoTitle;
    }
}