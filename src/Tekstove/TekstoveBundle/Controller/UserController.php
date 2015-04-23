<?php

namespace Tekstove\TekstoveBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
/**
 * Description of UserController
 *
 * @Template()
 */
class UserController extends Controller
{
    public function loginAction(Request $request)
    {
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $errorTranslated = $this->get('translator')->trans($error->getMessage());
        } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $errorTranslated = $this->get('translator')->trans($error->getMessage());
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $errorTranslated = null;
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);

        return 
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $errorTranslated,
            );
    }
    
    public function registerAction(Request $request)
    {
        $error = null;
        
        $formBuilder = $this->createFormBuilder([]);
        $formBuilder->add('username', 'text');
        $formBuilder->add('password', 'password');
        $formBuilder->add('password2', 'password');
        $formBuilder->add('mail', 'email');
        $recaptchaOptions = [
            'mapped'      => false,
            'constraints' => [
                new \EWZ\Bundle\RecaptchaBundle\Validator\Constraints\True,
            ],
        ];
        $formBuilder->add('recaptcha', 'ewz_recaptcha', $recaptchaOptions);
        $formBuilder->add('register', 'submit');
        
        $form = $formBuilder->getForm();
        /* @var $form \Symfony\Component\Form\Form */
        
        if ($request->getMethod() === 'POST') {
            $form->handleRequest($request);
            if (false === $form->isValid()) {
                $form->getErrors();
            }
            $userManager = $this->get('tekstoveUsersManager');
            /* @var $userManager \Tekstove\TekstoveBundle\Model\User\Manager */
            try {
                $requestData = $request->request->all();
                $user = $userManager->register($requestData['form']);
                return $this->redirect('login');
            } catch (\Tekstove\TekstoveBundle\Model\User\Exception\Validation $e) {
                $error = $e->getMessage();
            }
            
        }
        
        return [
            'error' => $error,
            'form' => $form->createView(),
        ];
    }
    
    public function viewAction($id)
    {
        $userManager = $this->get('tekstoveUsersManager');
        $user = $userManager->findById($id);
        return [
            'user' => $user,
        ];
    }
}
