<?php

namespace Tekstove\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\TekstoveValidationException;

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
    
    public function registerAction(Request $request)
    {
        $formBuilder = $this->createFormBuilder();
        $formBuilder->add('username');
        $formBuilder->add('password', PasswordType::class);
        $formBuilder->add('email');
        $formBuilder->add('submit', SubmitType::class);
        $formBuilder->setMapped('POST');
        $form = $formBuilder->getForm();
        
        $gateway = $this->get('tekstove.gateway.user.register');
        /* @var $gateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\User\RegisterGateway */
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = new \Tekstove\SiteBundle\Model\User\User(
                [
                    'username' => $form->get('username')->getData(),
                    'password' => $form->get('password')->getData(),
                    'email' => $form->get('email')->getData(),
                ]
            );
            try {
                $result = $gateway->save($request, $user);
            } catch (TekstoveValidationException $e) {
                // @TODO use matcher!
                foreach ($e->getValidationErrors() as $error) {
                    $formError = new \Symfony\Component\Form\FormError($error['message']);
                    $form->addError($formError);
                }
            }
        }
        
        $gateway->setGroups(['Register']);
        $data = $gateway->find();
        $recaptchaKey = $data['item']['recaptcha']['key'];
        
        return [
            'form' => $form->createView(),
            'recpatchaKey' => $recaptchaKey,
        ];
    }
}
