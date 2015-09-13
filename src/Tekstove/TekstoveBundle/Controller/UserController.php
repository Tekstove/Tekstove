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
    
    protected function createRegisterForm()
    {
        $form = $this->createForm(
            new \Tekstove\TekstoveBundle\Form\UserType(),
            null,
            [
                'action' => $this->generateUrl('register'),
            ]
        );
        
        $recaptchaOptions = [
            'mapped'      => false,
            'constraints' => [
                new \EWZ\Bundle\RecaptchaBundle\Validator\Constraints\True,
            ],
        ];
        $form->add('recaptcha', 'ewz_recaptcha', $recaptchaOptions);
        $form->add('register', 'submit');
        
        return $form;
    }
    
    public function registerAction(Request $request)
    {
        $form = $this->createRegisterForm();
        
            $form->handleRequest($request);
            if ($form->isValid()) {
                $lyric = $form->getData();
                $this->getDoctrine()->getManager()->persist($lyric);
                $this->getDoctrine()->getManager()->flush();
                return $this->redirect('login');
            }
            
        return [
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
