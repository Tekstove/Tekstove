<?php


namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\User;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\RequestException;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\TekstoveValidationException;

use Symfony\Component\HttpFoundation\Request;
use Tekstove\SiteBundle\Model\User\User;

/**
 * Description of Register
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class RegisterGateway extends AbstractGateway
{
    protected function getRelativeUrl()
    {
        return '/users/register/';
    }
    
    /**
     * @param Request $request
     * @param User $user
     */
    public function save(Request $request, User $user)
    {
        $client = $this->getClient();
        try {
            $response = $client->post(
                $this->getRelativeUrl(),
                [
                    'body' => json_encode(
                        [
                            'recaptcha' => [
                                'g-recaptcha-response' => $request->get('g-recaptcha-response'),
                            ],
                            'user' => [
                                'username' => $user->getUsername(),
                                'mail' => $user->getMail(),
                                'password' => $user->getPassword(),
                                'termsAccepted' => $user->getTermsAccepted(),
                            ],
                        ]
                    )
                ]
            );

            $responseData = $this->decodeBody($response->getBody());
            return $responseData;
        } catch (RequestException $e) {
            if ($e->getCode() != 400) {
                throw $e;
            }
            
            $validationException = new TekstoveValidationException($e->getMessage(), 0, $e);
            $errors = json_decode($e->getBody(), true);
            $validationException->setValidationErrors($errors);
            throw $validationException;
        }
    }
}
