<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlbumRepository")
 */
class Album
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Artist", inversedBy="albums")
     */
    private $artist;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Song", mappedBy="album", cascade={"remove"})
     */
    private $songs;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Style", inversedBy="albums")
     */
    private $styles;


    public function __construct()
    {
        $this->songs = new ArrayCollection();
        $this->styles = new ArrayCollection();
    }


    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of artist
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set the value of artist
     *
     * @return  self
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get the value of songs
     */
    public function getSongs()
    {
        return $this->songs;
    }

    /**
     * Get the value of styles
     */
    public function getStyles()
    {
        return $this->styles;
    }
}
