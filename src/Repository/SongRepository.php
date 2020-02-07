<?php

namespace App\Repository;

use App\Entity\Song;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class SongRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Song::class);
    }

    public function searchSongByTitle($title){

       $this->createQueryBuilder('song')
        ->where('song.title =:title')
        ->setParameter('title', $title)
        ->getQuery();

        
    }
}