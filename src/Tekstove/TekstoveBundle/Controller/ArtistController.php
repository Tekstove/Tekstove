<?php

namespace Tekstove\TekstoveBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class ArtistController extends Controller
{

    /**
     * @return \Tekstove\TekstoveBundle\Entity\ArtistRepository
     */
    private function getDefaultRepo() {
        $repo = $this->getDoctrine()->getRepository('TekstoveBundle:Artist');
        return $repo;
    }

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
        $repo = $this->getDefaultRepo();
        $queryBuilder = $repo->createQueryBuilder('a');
        $queryBuilder->andWhere('a.name LIKE :letter');
        $queryBuilder->setParameter('letter', $letter . '%');

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1) /* page number */,
                20 /* limit per page */
        );

        return [
            'artists' => $pagination,
            'pagination' => $pagination,
        ];
    }

}
