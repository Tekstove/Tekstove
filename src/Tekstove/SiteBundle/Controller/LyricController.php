<?php

namespace Tekstove\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric\LyricGateway;
use Tekstove\SiteBundle\Model\Lyric\Lyric;
use Tekstove\SiteBundle\Form\Type\LyricType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Tekstove\SiteBundle\Form\ErrorPopulator\ArrayErrorPopulator;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\NotFoundException;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\NotFoundRedirectException;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\TekstoveValidationException;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric\LyricPopularHistoryGateway;

/**
 * LyricController
 *
 * @Template()
 * @author po_taka <angel.koilov@gmail.com>
 */
class LyricController extends Controller
{
    /**
     * @Template()
     */
    public function viewAction($id)
    {
        $lyricGateway = $this->get('tesktove.gateway.lyric');
        /* @var $lyricGateway LyricGateway */
        $lyricGateway->setGroups(
            [
                LyricGateway::GROUP_DETAILS,
                LyricGateway::GROUP_ACL,
            ]
        );
        try {
            $lyricData = $lyricGateway->get($id);
        } catch (NotFoundRedirectException $e) {
            return $this->redirectToRoute(
                'lyricView',
                [
                    'id' => $e->getRedirectTo(),
                ],
                301
            );
        } catch (NotFoundException $e) {
            throw $this->createNotFoundException("Песента не съществува");
        }
        $lyric = $lyricData['item'];
        /* @var $lyric Lyric */
        
        $userGateway = $this->get('tekstove.gateway.user');
        /* @var $userGateway \Tekstove\SiteBundle\Model\Gateway\User\UserGateway */
        $userGateway->setGroups([LyricGateway::GROUP_LIST]);
        $userGateway->populateUsers([$lyric], 'getSendBy', 'setSendByUser');
        
        return [
            'lyric' => $lyric,
            'ads' => (int)!$lyric->isCensor(),
        ];
    }
    
    /**
     * Add new lyric
     */
    public function addAction(Request $request)
    {
        $lyric = new Lyric();
        
        $credentialsGateway = $this->get('tekstove.gateway.lyric.credentials');
        /* @var $credentialsGateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric\CredentialsGateway */
        $credentialsData = $credentialsGateway->find();
        $allowedFields = $credentialsData['item']['fields'];
        
        $form = $this->createCreateForm($lyric, $allowedFields);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $gateway = $this->get('tesktove.gateway.lyric');
            /* @var $gateway LyricGateway */
            try {
                $lyric->setTitle($form->get('title')->getData());
                $lyric->setText($form->get('text')->getData());
                $lyric->setVideoYoutube($form->get('videoYoutube')->getData());
                $lyric->setVideoVbox7($form->get('videoVbox7')->getData());
                $gateway->save($lyric);
                return $this->redirectToRoute('lyricView', ['id' => $lyric->getId()]);
            } catch (TekstoveValidationException $e) {
                $formErrorPopulator = new ArrayErrorPopulator();
                $formErrorPopulator->populateFormErrors($form, $e->getValidationErrors());
            }
        }
        return $this->render(
            'SiteBundle::Lyric/edit.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
    
    private function createBaseForm(Lyric $lyric, $allowedFields)
    {
        $form = $this->createForm(
            LyricType::class,
            $lyric,
            [
                'fields' => $allowedFields
            ]
        );
        
        return $form;
    }
    
    private function createCreateForm(Lyric $lyric, $allowedFields)
    {
        $form = $this->createBaseForm($lyric, $allowedFields);
        $form->add(
            'submit',
            SubmitType::class,
            [
                'label' => 'Send',
                'attr' => [
                    'class' => 'btn-success',
                ],
            ]
        );
        
        return $form;
    }
    
    private function createEditForm(Lyric $lyric, $allowedFields)
    {
        $form = $this->createBaseForm($lyric, $allowedFields);
        $form->add(
            'submit',
            SubmitType::class,
            [
                'label' => 'Save',
            ]
        );
        
        return $form;
    }
    
    /**
     * Edit existing lyric
     */
    public function editAction($id, Request $request)
    {
        $gateway = $this->get('tesktove.gateway.lyric');
        /* @var $gateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric\LyricGateway */
        $gateway->setGroups(
            [
                LyricGateway::GROUP_ACL,
                LyricGateway::GROUP_DETAILS,
            ]
        );
        $data = $gateway->get($id);
        $lyric = $data['item'];
        
        $credentialsGateway = $this->get('tekstove.gateway.lyric.credentials');
        /* @var $credentialsGateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric\CredentialsGateway */
        $credentialsData = $credentialsGateway->get($id);
        $allowedFields = $credentialsData['item']['fields'];
        
        $form = $this->createEditForm($lyric, $allowedFields);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $gateway = $this->get('tesktove.gateway.lyric');
            /* @var $gateway LyricGateway */
            try {
                if ($form->has('delete') && $form->get('delete')->getData()) {
                    $gateway->delete($lyric->getId());
                    return $this->redirect('/');
                }
                $gateway->save($lyric);
                return $this->redirectToRoute('lyricView', ['id' => $lyric->getId()]);
            } catch (TekstoveValidationException $e) {
                $formErrorPopulator = new ArrayErrorPopulator();
                $formErrorPopulator->populateFormErrors($form, $e->getValidationErrors());
            }
        }
        
        return [
            'form' => $form->createView(),
        ];
    }
    
    /**
     * Search for lyrics
     */
    public function searchAction(Request $request)
    {
        $formBuilder = $this->createFormBuilder(null, ['csrf_protection' => false]);
        $formBuilder->setMethod('GET');
        $formBuilder->add(
            'title',
            \Symfony\Component\Form\Extension\Core\Type\SearchType::class,
            [
                'required' => false,
            ]
        );
        
        $artistGateway = $this->get('tekstove.gateway.artist');
        $formBuilder->addEventListener(
            \Symfony\Component\Form\FormEvents::PRE_SET_DATA,
            function (\Symfony\Component\Form\FormEvent $event) use ($request, $artistGateway) {
                $posts = $request->query->all();
                $it = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($posts));
                $potentialArtistIds = [];
                foreach ($it as $key => $v) {
                    if (is_int($key)) {
                        $potentialArtistIds[$v] = $v;
                    }
                }
                
                if (!empty($potentialArtistIds)) {
                    $artistGateway->addFilter('id', $potentialArtistIds, 'in');
                }
                $artistGateway->setGroups(['List']);
                $artistsData = $artistGateway->find();

                $form = $event->getForm();
                $form->add(
                    'artists',
                    \Tekstove\SiteBundle\Form\Field\ArtistsType::class,
                    [
                        'allow_add' => true,
                        'allow_delete' => true,
                        'by_reference' => false,
                        'entry_type' => \Symfony\Component\Form\Extension\Core\Type\ChoiceType::class,

                        'entry_options' => [
                            'required' => true,
                            'choice_label' => 'name',
                            'choice_value' => 'id',
                            'choices' => $artistsData['items'],
                            'label' => 'Artist',
                        ]
                    ]
                );
            }
        );
        
        $formBuilder->add(
            'text',
            \Symfony\Component\Form\Extension\Core\Type\SearchType::class,
            [
                'required' => false,
            ]
        );
        
        $formBuilder->add(
            's',
            SubmitType::class,
            [
                'label' => 'Search',
            ]
        );
        $form = $formBuilder->getForm();
        /* @var $form \Symfony\Component\Form\Form */
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $lyricGateway = $this->get('tesktove.gateway.lyric');
            /* @var $lyricGateway LyricGateway */
            $lyricGateway->setGroups([LyricGateway::GROUP_LIST]);
            $lyricGateway->addOrder('id', LyricGateway::ORDER_DESC);
            
            $title = $form->get('title');
            $titleData = $title->getData();
            if ($titleData !== '') {
                $titleSearchData = preg_replace('/\s/', '%', $titleData);
                $lyricGateway->addFilter('title', "%{$titleSearchData}%", LyricGateway::FILTER_LIKE);
            }
            
            $artists = $form->get('artists');
            $artistsData = $artists->getData();
            if (!empty($artistsData)) {
                $artistIds = [];
                foreach ($artistsData as $artist) {
                    /* @var $artist \Tekstove\SiteBundle\Model\Artist\Artist */
                    $artistIds[$artist->getId()] = $artist->getId();
                }
                
                $lyricGateway->addFilter('ArtistId', $artistIds, LyricGateway::FILTER_IN);
            }
            
            $text = $form->get('text')->getData();
            if ($text !== '') {
                $textExploded = explode(' ', $text);
                foreach ($textExploded as $wordToSearch) {
                    $lyricGateway->addFilter('text', "%{$wordToSearch}%", LyricGateway::FILTER_LIKE);
                }
            }
            
            $paginator = $this->get('knp_paginator');
            /* @var $paginator \Knp\Component\Pager\Paginator */
            $lyricPaginate = $paginator->paginate(
                $lyricGateway,
                $request->query->getInt('p', 1),
                30,
                [
                    'pageParameterName' => 'p',
                ]
            );
        } else {
            $lyricPaginate = false;
        }
        
        
        return [
            'form' => $form->createView(),
            'lyricPaginate' => $lyricPaginate,
        ];
    }
    
    /**
     * Top100 stats
     */
    public function topAction($sort)
    {
        $lyricGatewayGroups = [
            LyricGateway::GROUP_LIST,
        ];
        switch ($sort) {
            case 'popular':
                $sortField = LyricGateway::FIELD_POPULARITY;
                $viewTitle = 'Популярни песни | Топ 100';
                $viewH1 = 'Топ 100 Популярни песни';
                $viewSortTableRow = 'Популярност';
                $viewLyricGetter = 'popularity';
                $lyricGatewayGroups[] = LyricGateway::GROUP_POPULARITY;
                break;
            case 'viewed':
                $sortField = LyricGateway::FIELD_VIEWS;
                $viewTitle = 'Най-преглеждани песни | Топ 100';
                $viewH1 = 'Топ 100 Най-преглеждани песни';
                $viewSortTableRow = 'Видяна';
                $viewLyricGetter = 'views';
                $lyricGatewayGroups[] = LyricGateway::GROUP_VIEWS;
                break;
            default:
                throw $this->createNotFoundException("Top 100 by `{$sort}` do not exists");
        }
        
        $lyricGateway = $this->get('tesktove.gateway.lyric');
        /* @var $lyricGateway LyricGateway */
        $lyricGateway->setGroups($lyricGatewayGroups);
        
        $lyricGateway->setLimit(100);
        
        $lyricGateway->addOrder($sortField, LyricGateway::ORDER_DESC);
       
        $lyricData = $lyricGateway->find();
        $lyrics = $lyricData['items'];
        /* @var $lyric Lyric */
        
        return [
            'lyrics' => $lyrics,
            'title' => $viewTitle,
            'tableSortName' => $viewSortTableRow,
            'lyricGetter' => $viewLyricGetter,
            'h1' => $viewH1,
            'ads' => true,
        ];
    }

    /**
     * History of top popular lyrics
     *
     * @param type $year
     * @param type $month
     */
    public function popularHistoryAction($year, $month)
    {
        $datetime = \DateTime::createFromFormat('Y-M', "{$year}-{$month}");
        if ($datetime === false) {
            throw new \InvalidArgumentException("{$year}-{$month} can't be converted to datetime");
        }

        $gateway = $this->get('tekstove.gateway.lyric.popularity.history');
        /* @var $gateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric\LyricPopularHistoryGateway */
        $gateway->addOrder('id', LyricPopularHistoryGateway::ORDER_DESC);
        $gateway->addFilter(
            'date',
            [
                'min' => $datetime->format('Y-M-01'),
                'max' => $datetime->format('Y-M-t'),
            ],
            LyricPopularHistoryGateway::FILTER_RANGE
        );
        $gateway->setGroups([LyricPopularHistoryGateway::GROUP_LIST]);
        $data = $gateway->find();

        dump($datetime);

        return [
            'lyricsHistory' => $data['items'],
        ];
    }
}
