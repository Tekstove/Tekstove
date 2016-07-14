<?php


namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\User;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;

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
        return '/users/register';
    }
}
