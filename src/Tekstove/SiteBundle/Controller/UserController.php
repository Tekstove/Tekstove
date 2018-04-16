<?php

namespace Tekstove\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Tekstove\SiteBundle\Form\ErrorPopulator\ArrayErrorPopulator;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\TekstoveValidationException;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\User\UserGateway;
use Tekstove\SiteBundle\Model\User\User;

use Tekstove\SiteBundle\Form\Type\User\UserType;

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
        if ($error) {
            // fuck! Using api error is always
            // user not found
            $error = 'Грешни данни за вход';
        }
        
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
        /* @var $userGateway UserGateway */
        $userGateway->setGroups([UserGateway::GROUP_DETAILS, UserGateway::GROUP_PERMISSION_GROUPS]);
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
        $formBuilder->add('mail', EmailType::class);
        $formBuilder->add(
            'termsAccepted',
            CheckboxType::class,
            [
                'label' => 'Приемам правилата и условията',
            ]
        );
        $formBuilder->add(
            'Регистрация',
            SubmitType::class,
            [
                'attr' => [
                    'class' => 'btn-success',
                ]
            ]
        );
        $formBuilder->setMapped('POST');
        $form = $formBuilder->getForm();
        /* @var $form \Symfony\Component\Form\Form */
        
        $gateway = $this->get('tekstove.gateway.user.register');
        /* @var $gateway \Tekstove\SiteBundle\Model\Gateway\Tekstove\User\RegisterGateway */
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = new User(
                [
                    'username' => $form->get('username')->getData(),
                    'password' => $form->get('password')->getData(),
                    'mail' => $form->get('mail')->getData(),
                    'termsAccepted' => true,
                ]
            );
            try {
                $gateway->save($request, $user);

                return $this->redirectToRoute('login');
            } catch (TekstoveValidationException $e) {
                $erroMatcher = new ArrayErrorPopulator();
                $erroMatcher->populateFormErrors($form, $e->getValidationErrors());
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

    public function passwordResetRequestAction(Request $request)
    {
        $formBuilder = $this->createFormBuilder();
        $formBuilder->add(
            'mail',
            EmailType::class,
            [
                'attr' => [
                    "autocomplete" => "off",
                ],
            ]
        );
        $formBuilder->add(
            'submit',
            SubmitType::class,
            [
                'label' => 'Искам нова парола',
            ]
        );
        $form = $formBuilder->getForm();

        $form->handleRequest($request);
        $message = '';
        if ($form->isSubmitted() && $form->isValid()) {

            $gateway = $this->get('tekstove.gateway.user');
            /* @var $userGateway UserGateway */

            try {
                $gateway->passwordResetRequest(
                    $form->get('mail')->getData(),
                    $this->generateUrl(
                        'tekstove_site.user.password_reset.confirm',
                        ['key' => '::key::'],
                        \Symfony\Component\Routing\Generator\UrlGeneratorInterface::ABSOLUTE_URL
                    )
                );

                $message = 'Изпратихме ти писмо за потвърждение, провери пощата моля!';
            } catch (TekstoveValidationException $e) {
                $formErrorPopulator = new ArrayErrorPopulator();
                $formErrorPopulator->populateFormErrors($form, $e->getValidationErrors());
            }
        }

        return [
            'form' => $form->createView(),
            'message' => $message,
        ];
    }

    public function passwordResetConfirmAction($key)
    {
        $gateway = $this->get('tekstove.gateway.user');
        /* @var $userGateway UserGateway */

        $errors = [];

        try {
            $gateway->passwordResetConfirm($key);
        } catch (TekstoveValidationException $e) {
            foreach ($e->getValidationErrors() as $error) {
                $errors[] = $error['message'];
            }
        }

        return [
            'errors' => $errors,
        ];
    }

    public function editAction(Request $request, $id)
    {
        $userGateway = $this->get('tekstove.gateway.user');
        /* @var $userGateway UserGateway */
        $userGateway->setGroups(
            [
                UserGateway::GROUP_DETAILS,
                UserGateway::GROUP_PERMISSION_GROUPS,
                UserGateway::GROUP_EDITABLE_FIELDS,
            ]
        );

        $data = $userGateway->get($id);

        $user = $data['item'];
        /* @var $user \Tekstove\SiteBundle\Model\User\User */

        $form = $this->createForm(
            UserType::class,
            $user,
            [
                'fields' => $user->getEditableFields(),
            ]
        );

        $form->add('submit', SubmitType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $userGateway->save($user);
                return $this->redirectToRoute('userView', ['id' => $user->getId()]);
            } catch (TekstoveValidationException $e) {
                $formErrorPopulator = new ArrayErrorPopulator();
                $formErrorPopulator->populateFormErrors($form, $e->getValidationErrors());
            }
        }

        return [
            'user' => $user,
            'form' => $form->createView(),
        ];
    }
}
