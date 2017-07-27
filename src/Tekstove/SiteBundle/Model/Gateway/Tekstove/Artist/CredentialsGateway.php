<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Artist;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;

/**
 * Description of CredentialsGateway
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class CredentialsGateway extends AbstractGateway
{
    protected function getRelativeUrl()
    {
        $this->setGroups(['List']);
        return '/artists/credentials/';
    }
}
