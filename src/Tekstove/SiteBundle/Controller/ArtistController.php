<?php

namespace Tekstove\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Artist\ArtistGateway;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric\LyricGateway;
use Tekstove\SiteBundle\Model\Artist\Artist;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\TekstoveValidationException;
use Tekstove\SiteBundle\Form\ErrorPopulator\ArrayErrorPopulator;

/**
 * @Template()
 */
class ArtistController extends Controller
{
    public function browseAction(Request $request, $id)
    {
        $artistGateway = $this->get("tekstove.gateway.artist");
        /* @var $artistGateway ArtistGateway */
        $artistGateway->setGroups(
            [
                ArtistGateway::GROUP_DETAILS,
                ArtistGateway::GROUP_ALBUMS,
                ArtistGateway::GROUP_ACL,
            ]
        );
        $artistData = $artistGateway->get($id);
        $artist = $artistData['item'];
        $lyricGateway = $this->get("tesktove.gateway.lyric");
        /* @var $lyricGateway LyricGateway */
        $lyricGateway->setGroups([LyricGateway::GROUP_LIST]);
        $lyricGateway->addFilter('artist', $artist->getId());
        $lyricGateway->addOrder('title', 'ASC');
        $paginator = $this->get('knp_paginator');
        /* @var $paginator \Knp\Component\Pager\Paginator */
        $lyrics = $paginator->paginate(
            $lyricGateway,
            $request->query->getInt('lyricsPage', 1),
            30,
            [
                'pageParameterName' => 'lyricsPage',
            ]
        );
        return [
            'artist' => $artist,
            'lyrics' => $lyrics,
        ];
    }

    /**
     * @Template()
     */
    public function listAction($letter, Request $request)
    {
        $artistGateway = $this->get("tekstove.gateway.artist");
        /* @var $artistGateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\Artist\ArtistGateway */
        $artistGateway->setGroups([AbstractGateway::GROUP_LIST]);
        $artistGateway->addFilter('name', "{$letter}%", AbstractGateway::FILTER_LIKE);
        $artistGateway->addOrder('name', 'ASC');
        $artistGateway->setLimit(30);
        $paginator = $this->get('knp_paginator');
        /* @var $paginator \Knp\Component\Pager\Paginator */
        $pagination = $paginator->paginate(
            $artistGateway,
            $request->query->getInt('page', 1) /* page number */,
            30 /* limit per page */
        );

        return [
            'pagination' => $pagination,
        ];
    }

    public function editAction($id, Request $request)
    {
        $artistGateway = $this->get("tekstove.gateway.artist");
        /* @var $artistGateway ArtistGateway */
        
        $artistGateway->setGroups(
            [
                ArtistGateway::GROUP_DETAILS,
                ArtistGateway::GROUP_ACL,
            ]
        );
        $artistData = $artistGateway->get($id);
        $artist = $artistData['item'];

        $credentialsGateway = $this->get('tekstove.gateway.artist.credentials');
        /* @var $credentialsGateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\Artist\CredentialsGateway */
        $credentials = $credentialsGateway->get($artist->getId());

        $form = $this->createArtistForm(
            $artist,
            $credentials['item']['fields']
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $artistGateway->save($artist);
                return $this->redirectToRoute('artistBrowse', ['id' => $artist->getId()]);
            } catch (TekstoveValidationException $e) {
                $formErrorPopulator = new ArrayErrorPopulator();
                $formErrorPopulator->populateFormErrors($form, $e->getValidationErrors());
            }
        }

        return [
            'form' => $form->createView(),
        ];
    }

    protected function createArtistForm(Artist $artist, $allowedFields)
    {
        $form = $this->createForm(
            \Tekstove\SiteBundle\Form\Type\Artist\ArtistType::class,
            $artist,
            [
                'fields' => $allowedFields
            ]
        );

        $form->add(
            'submit',
            \Symfony\Component\Form\Extension\Core\Type\SubmitType::class,
            [
                'label' => 'Save',
                'attr' => [
                    'class' => 'btn-success',
                ],
            ]
        );

        return $form;
    }
}
