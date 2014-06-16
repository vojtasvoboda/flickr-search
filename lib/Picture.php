<?php

class Picture
{

    private $id;
    private $owner;
    private $title;
    private $url;
    private $thumb;
    private $color;
    private $rgb;
    private $simValue = -1;

    public function __construct($id = "", $owner = "", $title = "", $url = "", $thumb = "", $color = "")
    {
        $this->setAtributes($id, $owner, $title, $url, $thumb, $color);
    }

    public function setAtributes($id, $owner, $title, $url, $thumb, $color)
    {
        $this->setId($id);
        $this->setOwner($owner);
        $this->setTitle($title);
        $this->setUrl($url);
        $this->setThumb($thumb);
        $this->setColor($color);
        // set rgb
        $red = $color[0][0]['r'];
        $green = $color[0][0]['g'];
        $blue = $color[0][0]['b'];
        $this->setRgb($red . "," . $green . "," . $blue);
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function setThumb($thumb)
    {
        $this->thumb = $thumb;
    }

    public function setColor($color)
    {
        $this->color = $color;
    }

    public function setRgb($rgb)
    {
        $this->rgb = $rgb;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getThumb()
    {
        return $this->thumb;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getExtract()
    {
        return $this->extract;
    }

    public function getRgb()
    {
        return $this->rgb;
    }

    public function setSimValue($value)
    {
        $this->simValue = $value;
    }

    public function getSimValue()
    {
        return $this->simValue;
    }
}
