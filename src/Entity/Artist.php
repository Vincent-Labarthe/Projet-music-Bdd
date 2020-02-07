<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtistRepository")
 */
class Artist
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @Assert\Length(max=255)
     */
    private $realName;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @Assert\Length(max=255)
     */
    private $artistName;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotNull
     */
    private $birthDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $deathDate;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @Assert\Choice({"male", "female"})
     */
    private $gender;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Album", mappedBy="artist")
     */
    private $albums;


    public function __construct()
    {
        $this->albums = new ArrayCollection();
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get the value of realName
     */
    public function getRealName()
    {
        return $this->realName;
    }

    /**
     * Set the value of realName
     *
     * @return  self
     */
    public function setRealName($realName)
    {
        $this->realName = $realName;

        return $this;
    }

    /**
     * Get the value of artistName
     */
    public function getArtistName()
    {
        return $this->artistName;
    }

    /**
     * Set the value of artistName
     *
     * @return  self
     */
    public function setArtistName($artistName)
    {
        $this->artistName = $artistName;

        return $this;
    }

    /**
     * Get the value of birthDate
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set the value of birthDate
     *
     * @return  self
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get the value of deathDate
     */
    public function getDeathDate()
    {
        return $this->deathDate;
    }

    /**
     * Set the value of deathDate
     *
     * @return  self
     */
    public function setDeathDate($deathDate)
    {
        $this->deathDate = $deathDate;

        return $this;
    }

    /**
     * Get the value of gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of albums
     */
    public function getAlbums()
    {
        return $this->albums;
    }
}
