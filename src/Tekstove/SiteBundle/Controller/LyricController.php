<?php

namespace Tekstove\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric\LyricGateway;
use Tekstove\SiteBundle\Model\Lyric\Lyric;
use Tekstove\SiteBundle\Form\Type\LyricType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\TekstoveValidationException;

/**
 * LyricController
 *
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
        /* @var $lyricGateway \Tekstove\SiteBundle\Model\Gateway\Lyric\LyricGateway */
        $lyricGateway->setGroups(
            [
                LyricGateway::GROUP_DETAILS,
                LyricGateway::GROUP_ACL,
            ]
        );
        $lyricData = $lyricGateway->get($id);
        $lyric = $lyricData['item'];
        
        $userGateway = $this->get('tekstove.gateway.user');
        /* @var $userGateway \Tekstove\SiteBundle\Model\Gateway\User\UserGateway */
        $userGateway->setGroups([LyricGateway::GROUP_LIST]);
        $userGateway->populateUsers([$lyric], 'getSendBy', 'setSendByUser');
        
        return [
            'lyric' => $lyric,
        ];
    }
    
    /**
     * @Template()
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
                // @TODO use matcher!
                foreach ($e->getValidationErrors() as $error) {
                    $formError = new \Symfony\Component\Form\FormError($error['message']);
                    $formErrorMatched = false;
                    foreach ($form as $formElement) {
                        /* @var $formElement forme \Symfony\Component\Form\FormInterface */
                        if ($formElement->getName() == $error['element']) {
                            $formElement->addError($formError);
                            $formErrorMatched = true;
                            break;
                        }
                    }
                    
                    if (!$formErrorMatched) {
                        $form->addError($formError);
                    }
                }
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
     * @Template()
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
        $credentialsData = $credentialsGateway->find();
        $allowedFields = $credentialsData['item']['fields'];
        
        $form = $this->createEditForm($lyric, $allowedFields);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $gateway = $this->get('tesktove.gateway.lyric');
            /* @var $gateway LyricGateway */
            try {
                $gateway->save($lyric);
                return $this->redirectToRoute('lyricView', ['id' => $lyric->getId()]);
            } catch (TekstoveValidationException $e) {
                // @TODO use matcher!
                foreach ($e->getValidationErrors() as $error) {
                    $formError = new \Symfony\Component\Form\FormError($error['message']);
                    $formErrorMatched = false;
                    foreach ($form as $formElement) {
                        /* @var $formElement forme \Symfony\Component\Form\FormInterface */
                        if ($formElement->getName() == $error['element']) {
                            $formElement->addError($formError);
                            $formErrorMatched = true;
                            break;
                        }
                    }
                    
                    if (!$formErrorMatched) {
                        $form->addError($formError);
                    }
                }
            }
        }
        
        return [
            'form' => $form->createView(),
        ];
    }
}
