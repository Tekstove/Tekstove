<?php

namespace Tekstove\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;
use Symfony\Component\HttpFoundation\Request;

use Tekstove\SiteBundle\Model\Album\Album;
use Tekstove\SiteBundle\Form\Type\Album\AlbumType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\TekstoveValidationException;
use Tekstove\SiteBundle\Form\ErrorPopulator\ArrayErrorPopulator;

/**
 * Description of AlbumController
 *
 * @author po_taka <angel.koilov@gmail.com>
 * @Template()
 */
class AlbumController extends Controller
{
    public function viewAction($id)
    {
        $albumGateway = $this->get('tekstove.gateway.album');
        /* @var $albumGateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\Album\AlbumGateway */
        $albumGateway->setGroups(
            [
                AbstractGateway::GROUP_DETAILS,
                AbstractGateway::GROUP_ACL,
                \Tekstove\SiteBundle\Model\Gateway\Tekstove\Album\AlbumGateway::GROUP_DETAILS,
            ]
        );
        $albumData = $albumGateway->get($id);
        
        return [
            'album' => $albumData['item'],
            
            'ads' => true,
        ];
    }

    public function addAction(Request $request)
    {
        $album = new Album(
            [
                'artists' => [],
            ]
        );

        $credentialsGateway = $this->get('tekstove.gateway.album.credentials');
        /* @var $credentialsGateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric\CredentialsGateway */
        $credentialsData = $credentialsGateway->find();
        $allowedFields = $credentialsData['item']['fields'];

        // @FIXME remove dumps
        dump($allowedFields);
//        die;

        $form = $this->createCreateForm($album, $allowedFields);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gateway = $this->get('tekstove.gateway.album');
            /* @var $gateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\Album\AlbumGateway */
            try {
                $gateway->save($album);
                return $this->redirectToRoute('tekstove_site_album_view', ['id' => $album->getId()]);
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

        private function createBaseForm(Album $album, $allowedFields)
    {
        $form = $this->createForm(
            AlbumType::class,
            $album,
            [
                'fields' => $allowedFields
            ]
        );

        return $form;
    }

    private function createCreateForm(Album $album, $allowedFields)
    {
        $form = $this->createBaseForm($album, $allowedFields);
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
}
