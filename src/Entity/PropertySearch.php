<?php

namespace App\Entity ;



class PropertySearch
{
    /**
     * @var string|null
     */
    private $titre ;

    /**
     * @var int|null
     */
    private $maxprix ;

    /**
     * @return string|null
     */
    public function getTitre():?string
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     * @return PropertySearch
     */
    public function setTitre(string $titre): PropertySearch
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMaxprix():?int
    {
        return $this->maxprix;
    }

    /**
     * @param int $maxprix
     * @return PropertySearch
     */
    public function setMaxprix( int $maxprix): PropertySearch
    {
        $this->maxprix = $maxprix;
        return $this;
    }

}