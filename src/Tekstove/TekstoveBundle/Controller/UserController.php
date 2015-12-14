<?php

namespace Tekstove\TekstoveBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;

use Tekstove\TekstoveBundle\Model\User;
use Tekstove\TekstoveBundle\Model\UserQuery;

/**
 * Description of UserController
 *
 * @Template()
 */
class UserController extends Controller
{
    
    private function getDefaultRepo()
    {
        $repo = $this->getDoctrine()->getRepository('TekstoveBundle:User');
        return $repo;
    }
    
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

        return array(
            // last username entered by the user
            'last_username' => $lastUsername,
            'error'         => $errorTranslated,
        );
    }
    
    protected function createRegisterForm(User $user)
    {
        $form = $this->createForm(
            new \Tekstove\TekstoveBundle\Form\Type\User\RegisterType(),
            $user,
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
        $user = new User();
        $form = $this->createRegisterForm($user);
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            $plainPasswordValue = $form->get('password')->getData();
            $hashedPassword = md5($plainPasswordValue);
            $user->setPassword($hashedPassword);

            try {
                $user->save();
                return $this->redirect('login');
            } catch (\Exception $e) {
                // @TODO handle validation for prepersist listeners
                throw $e;
            }
        }
            
        return [
            'form' => $form->createView(),
        ];
    }
    
    public function viewAction($id)
    {
        $userQuery = new \Tekstove\TekstoveBundle\Model\UserQuery();
        $user = $userQuery->findOneById($id);
        return [
            'user' => $user,
        ];
    }
}
