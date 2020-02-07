<?php

namespace App\Controller;

use App\Entity\Song;
use App\Entity\Album;
use App\Entity\Artist;
use App\Form\AlbumType;
use App\Form\Type\ArtistType;
use App\Repository\SongRepository;
use App\Repository\ArtistRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/artist")
 */
class ArtistController extends AbstractController
{
    /**
     * @Route("/create", name="artist_create")
     */
    public function createArtist(Request $request)
    {
        $message = 'Artist';
        $newArtist = new Artist();

        $form = $this->createForm(ArtistType::class, $newArtist);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($newArtist);
            $manager->flush();

            $this->addFlash("success", "L'artiste a bien été ajouté");
            return $this->redirectToRoute('artist_list');
        }

        return $this->render(
            "add.html.twig",
            [
                "formView" => $form->createView(),
                'message' => $message
            ]
        );
    }

    /**
     * @Route("/list", name="artist_list")
     */
    public function listArtists()
    {
        /** @var ArtistRepository */
        $artistRepository = $this->getDoctrine()->getRepository(Artist::class);

        $artists = $artistRepository->findAll();

        return $this->render(
            'artist/list.html.twig',
            [
                'artists' => $artists
            ]
        );
    }
}
