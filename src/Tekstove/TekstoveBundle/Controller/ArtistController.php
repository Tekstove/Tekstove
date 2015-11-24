<?php

namespace Tekstove\TekstoveBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Tekstove\TekstoveBundle\Model\ArtistQuery;

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
        $artistQuery = new ArtistQuery();
        $artistQuery->filterByName($letter . '%', \Propel\Runtime\ActiveQuery\Criteria::LIKE);
        $paginator = $this->get('knp_paginator');
        /* @var $paginator \Knp\Component\Pager\Paginator */
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
