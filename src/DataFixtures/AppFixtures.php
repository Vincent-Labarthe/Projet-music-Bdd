<?php

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Song;
use App\Entity\Style;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $artist1 = new Artist();
        $artist1->setArtistName("Aretha Franklin");
        $artist1->setRealName("Aretha Louise Franklin");
        $artist1->setBirthDate(new DateTime("1942-03-25"));
        $artist1->setDeathDate(new DateTime("2018-06-16"));
        $artist1->setGender("female");
        $manager->persist($artist1);

        $artist2 = new Artist();
        $artist2->setArtistName("Ben Harper");
        $artist2->setRealName("Benjamin Chase Harper");
        $artist2->setBirthDate(new DateTime("1969-10-28"));
        $artist2->setGender("male");
        $manager->persist($artist2);

        $style1 = new Style();
        $style1->setLabel("Blues");
        $manager->persist($style1);

        $style2 = new Style();
        $style2->setLabel("Gospel");
        $manager->persist($style2);

        $style3 = new Style();
        $style3->setLabel("Rock");
        $manager->persist($style3);

        $style4 = new Style();
        $style4->setLabel("Soul");
        $manager->persist($style4);

        $album1 = new Album();
        $album1->setArtist($artist1);
        $album1->setDate(new DateTime("1968-01-22"));
        $album1->setTitle("Lady Soul");
        $album1->getStyles()->add($style2);
        $album1->getStyles()->add($style4);
        $manager->persist($album1);

        $album2 = new Album();
        $album2->setArtist($artist2);
        $album2->setDate(new DateTime("1995-04-13"));
        $album2->setTitle("Fight for Your Mind");
        $album2->getStyles()->add($style1);
        $manager->persist($album2);

        $album3 = new Album();
        $album3->setArtist($artist2);
        $album3->setDate(new DateTime("1999-09-21"));
        $album3->setTitle("Burn to Shine");
        $album3->getStyles()->add($style2);
        $album3->getStyles()->add($style3);
        $manager->persist($album3);

        

        $song1 = new Song();
        $song1->setArtist($artist1);
        $song1->setTitle("Chain of Fools");
        $song1->setAlbum($album1);
        $manager->persist($song1);

        $song2 = new Song();
        $song2->setArtist($artist1);
        $song2->setTitle("People Get Ready");
        $song2->setAlbum($album1);
        $manager->persist($song2);

        $song3 = new Song();
        $song3->setArtist($artist2);
        $song3->setTitle("Oppression");
        $song3->setAlbum($album2);
        $manager->persist($song3);

        $song4 = new Song();
        $song4->setArtist($artist2);
        $song4->setTitle("Ground on Down");
        $song4->setAlbum($album2);
        $manager->persist($song4);

        $song5 = new Song();
        $song5->setArtist($artist2);
        $song5->setTitle("Another Lonely Day");
        $song5->setAlbum($album2);
        $manager->persist($song5);

        $song6 = new Song();
        $song6->setArtist($artist2);
        $song6->setTitle("Alone");
        $song6->setAlbum($album3);
        $manager->persist($song6);

        $manager->flush();
    }
}
