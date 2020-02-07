<?php

namespace App\Controller;


use App\Entity\Song;
use App\Entity\Album;
use App\Form\Type\SongType;
use App\Repository\SongRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class SongController extends AbstractController
{

    /**
     * @Route("/{id}/song", name="song_list")
     */
    public function listSong($id)
    {
        /** @var SongRepository */

        $songs = $this->getDoctrine()->getRepository(Song::class)->findBy(array('album' => $id));
        $album = $this->getDoctrine()->getRepository(Album::class)->find($id);


        return $this->render('song/song.html.twig', [
            'songs' => $songs,
            'album'=>$album
        ]);
    }


    /**
     * @Route("/{id}/song/create", name="song_create")
     */
    public function createAlbum(Request $request, Album $album)
    {
        
        $message = 'titre';
        $newSong = new Song();

        $newSong->setAlbum($album);
        $form = $this->createForm(SongType::class, $newSong);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($newSong);
            $manager->flush();

            $albumId=$album->getId();
            $this->addFlash("success", "Le titre a bien été ajouté");
            return $this->redirectToRoute('song_list', ['id'=>$albumId]);
        }

        return $this->render(
            "add.html.twig",
            [
                "formView" => $form->createView(),
                'message' => $message
            ]
        );
    }
}
