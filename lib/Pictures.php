<?php

/**
 * Description of Pictures
 *
 * @author Vojta Svoboda
 * @author Mira
 */
include "Picture.php";

class Pictures
{

    private $pictures;

    public function __construct()
    {

    }

    /**
     * Razeni podle autora
     *
     * @param $m
     * @param $n
     *
     * @return int
     */
    private function _cmpAscOwner($m, $n)
    {
        if ($m->getOwner() == $n->getOwner()) {
            return 0;
        }

        return ($m->getOwner() < $n->getOwner()) ? -1 : 1;
    }

    private function _cmpDescOwner($m, $n)
    {
        if ($m->getOwner() == $n->getOwner()) {
            return 0;
        }

        return ($m->getOwner() > $n->getOwner()) ? -1 : 1;
    }

    /**
     * Razeni podle popisku
     *
     * @param $m
     * @param $n
     *
     * @return int
     */
    private function _cmpAscTitle($m, $n)
    {
        if ($m->getTitle() == $n->getTitle()) {
            return 0;
        }

        return ($m->getTitle() < $n->getTitle()) ? -1 : 1;
    }

    private function _cmpDescTitle($m, $n)
    {
        if ($m->getTitle() == $n->getTitle()) {
            return 0;
        }

        return ($m->getTitle() > $n->getTitle()) ? -1 : 1;
    }

    /**
     * Razeni podle GPS
     *
     * @param $m
     * @param $n
     *
     * @return int
     */
    private function _cmpAscGPS($m, $n)
    {
        if ($m->getGPS() == $n->getGPS()) {
            return 0;
        }

        return ($m->getGPS() < $n->getGPS()) ? -1 : 1;
    }

    private function _cmpDescGPS($m, $n)
    {
        if ($m->getGPS() == $n->getGPS()) {
            return 0;
        }

        return ($m->getGPS() > $n->getGPS()) ? -1 : 1;
    }

    /**
     * Razeni podle velikosti
     *
     * @param $m
     * @param $n
     *
     * @return int
     */
    private function _cmpAscSize($m, $n)
    {
        if ($m->getSize() == $n->getSize()) {
            return 0;
        }

        return ($m->getSize() < $n->getSize()) ? -1 : 1;
    }

    private function _cmpDescSize($m, $n)
    {
        if ($m->getSize() == $n->getSize()) {
            return 0;
        }

        return ($m->getSize() > $n->getSize()) ? -1 : 1;
    }

    /**
     * Razeni podle ID
     *
     * @param $m
     * @param $n
     *
     * @return int
     */
    private function _cmpAscId($m, $n)
    {
        if ($m->getId() == $n->getId()) {
            return 0;
        }

        return ($m->getId() < $n->getId()) ? -1 : 1;
    }

    private function _cmpDescId($m, $n)
    {
        if ($m->getId() == $n->getId()) {
            return 0;
        }

        return ($m->getId() > $n->getId()) ? -1 : 1;
    }

    private function _cmpDescSimValue($m, $n)
    {
        if ($m->getSimValue() == $n->getSimValue()) {
            return 0;
        }

        return ($m->getSimValue() > $n->getSimValue()) ? -1 : 1;
    }

    public function addPictures($pics)
    {
        $this->pictures = $pics;
    }

    public function getPictures()
    {
        return $this->pictures;
    }

    public function sortById($desc = false)
    {
        if ($desc == false) {
            usort($this->pictures, array('Pictures', '_cmpAscId'));
        } else {
            usort($this->pictures, array('Pictures', '_cmpDescId'));
        }
    }

    public function sortByTitle($desc = false)
    {
        if ($desc == false) {
            usort($this->pictures, array('Pictures', '_cmpAscTitle'));
        } else {
            usort($this->pictures, array('Pictures', '_cmpDescTitle'));
        }
    }

    public function sortByGPS($desc = false)
    {
        if ($desc == false) {
            usort($this->pictures, array('Pictures', '_cmpAscGPS'));
        } else {
            usort($this->pictures, array('Pictures', '_cmpDescGPS'));
        }
    }

    public function sortByOwner($desc = false)
    {
        if ($desc == false) {
            usort($this->pictures, array('Pictures', '_cmpAscOwner'));
        } else {
            usort($this->pictures, array('Pictures', '_cmpDescOwner'));
        }
    }

    public function sortBySize($desc = false)
    {
        if ($desc == false) {
            usort($this->pictures, array('Pictures', '_cmpAscSize'));
        } else {
            usort($this->pictures, array('Pictures', '_cmpDescSize'));
        }
    }

    public function sortBySimilarAuthor($author)
    {
        foreach ($this->pictures as $picture) {
            $picture->setSimValue(similar_text($author, strtolower($picture->getOwner())));
        }
        usort($this->pictures, array('Pictures', '_cmpDescSimValue'));
    }


}
