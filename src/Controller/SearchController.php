<?php

namespace App\Controller;


use App\Entity\Song;
use App\Form\Type\SearchSongType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/search")
 */
class SearchController extends AbstractController
{

    /**
     * @Route("/song", name="search_song")
     */
    public function searchSong(Request $request)
    {

        $message = 'titre';
        $song = new Song();
        $form = $this->createForm(SearchSongType::class, $song);
       
        $form->handleRequest($request);
        $title = $request->get('search_song');
        $song = $this->getDoctrine()->getRepository(Song::class)->findOneBy(['title' => $title]);

        if ($form->isSubmitted() && $form->isValid()) {
            $albumId=$song->getAlbum()->getId();
            return $this->redirectToRoute('song_list', ['id' => $albumId]);
        }
        return $this->render(
            "search.html.twig",
            [
                "formView" => $form->createView(),
                'message' => $message
            ]
        );
    }
}
