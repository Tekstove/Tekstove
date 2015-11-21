<?php

namespace Tekstove\TekstoveBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class ArtistController extends Controller
{

    /**
     * @Template()
     */
    public function browseAction($id) {
        $lyricRepo = $this->getDoctrine()->getRepository('TekstoveBundle:Lyric');
        // @TODO
        $lyrics = $lyricRepo->find(5);
        return [
            'lyrics' => $lyrics,
        ];
    }

    /**
     * 
     * @Template()
     */
    public function listAction($letter, Request $request) {
        $artistRepo = $this->get('tekstove.model.artist.query');
        $artistQuery = $artistRepo->create();
        /* @var $artistQuery \Tekstove\TekstoveBundle\Model\ArtistQuery */
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $artistQuery,
            $request->query->getInt('page', 1) /* page number */,
            30 /* limit per page */
        );

        return [
            'artists' => $pagination,
            'pagination' => $pagination,
        ];
    }

}
