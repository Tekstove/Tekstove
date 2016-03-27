<?php

namespace Tekstove\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;
use Tekstove\SiteBundle\Model\Lyric\Lyric;
use Tekstove\SiteBundle\Form\Type\LyricType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\TekstoveValidationException;

/**
 * Description of LyricController
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
        $lyricGateway->setGroups([AbstractGateway::GROUP_DETAILS]);
        $lyricData = $lyricGateway->get($id);
        $lyric = $lyricData['item'];
        
        if (false === $this->get('security.authorization_checker')->isGranted('view', $lyric)) {
            throw new \Exception('Unauthorised access!');
        }

        $userGateway = $this->get('tekstove.gateway.user');
        /* @var $userGateway \Tekstove\SiteBundle\Model\Gateway\User\UserGateway */
        $userGateway->setGroups([AbstractGateway::GROUP_LIST]);
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
            /* @var $gateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric\LyricGateway */
            try {
                $lyric->setTitle($form->get('title')->getData());
                $lyric->setText($form->get('text')->getData());
                $lyric->setVideoYoutube($form->get('videoYoutube')->getData());
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
    
    private function createCreateForm(Lyric $lyric, $allowedFields)
    {
        $form = $this->createForm(LyricType::class, $lyric, ['fields' => $allowedFields]);
        $form->add('submit', SubmitType::class);
        
        return $form;
    }
    
    private function createEditForm(Lyric $lyric)
    {
        $formType = new LyricType();
        $form = $this->createForm($formType, $lyric);
        $form->add('submit', 'submit');
        
        return $form;
    }
    
    /**
     * @Template()
     */
    public function editAction($id, Request $request)
    {
        // @TODO
    }
}
