<?php

namespace Tekstove\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Description of UserController
 *
 * @Template()
 */
class UserController extends Controller
{
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return array(
            'last_username' => $lastUsername,
            'error'         => $error,
        );
    }
    
    public function viewAction($id)
    {
        $userGateway = $this->get('tekstove.gateway.user');
        /* @var $userGateway \Tekstove\SiteBundle\Model\Gateway\User\UserGateway */
        $userGateway->setGroups(['Details']);
        $user = $userGateway->get($id)['item'];
        return [
            'user' => $user,
        ];
    }
    
    public function registerAction()
    {
        $formBuilder = $this->createFormBuilder();
        $formBuilder->add('username');
        $formBuilder->add('password');
        $formBuilder->add('email');
        $formBuilder->add('submit', SubmitType::class);
        
        $form = $formBuilder->getForm();
        
        $gateway = $this->get('tekstove.gateway.user.register');
        /* @var $gateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\User\RegisterGateway */
        $gateway->setGroups(['Register']);
        $data = $gateway->find();
        $recaptchaKey = $data['item']['recaptcha']['key'];
        
        return [
            'form' => $form->createView(),
            'recpatchaKey' => $recaptchaKey,
        ];
    }
}
