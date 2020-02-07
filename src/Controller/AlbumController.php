<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\Artist;
use App\Form\AlbumType;
use App\Form\Type\ArtistType;
use App\Repository\AlbumRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;



class AlbumController extends AbstractController
{
    /**
     * @Route("/{id}/album", name="album_list")
     */
    public function listAlbum(Artist $artist)
    {
       
        return $this->render('album/album.html.twig', [
            'artist' => $artist
        ]);
    }

    /**
     * @Route("/album/{id}/create", name="album_create")
     */
    public function createAlbum(Request $request, Artist $artist)
    {
        $message = 'Album';
        $newAlbum = new Album();
        $newAlbum->setArtist($artist);
        $newAlbum->setDate(new DateTime());

        $form = $this->createForm(AlbumType::class, $newAlbum);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($newAlbum);
            $manager->flush();

            $this->addFlash("success", "L'album a bien été ajouté");
            return $this->redirectToRoute('album_list', ['id'=>$artist->getId()]);
        }

        return $this->render(
            "add.html.twig",
            [
                "formView" => $form->createView(),
                'message' => $message,
                'artist'=>$artist
            ]
        );
    }

    /**
     * @Route("/{id}/album/update", name="album_update")
     */
    public function updateAlbum(Request $request, Album $album)
    {
        $message = "album";

        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();
            return $this->redirectToRoute('album_list', ['id' => $album->getId()]);
        }
        return $this->render(
            "update.html.twig",
            [
                "formView" => $form->createView(),
                'message' => $message
            ]
        );
    }

    /**
     * @Route("/album/{id}/delete", name="album_delete")
     */
    public function deleteAlbum( Album $album)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($album);
        $entityManager->flush();

        return $this->redirectToRoute('artist_list');
    }
}
