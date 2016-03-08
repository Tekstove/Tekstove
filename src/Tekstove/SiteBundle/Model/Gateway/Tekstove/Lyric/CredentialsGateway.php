<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;

/**
 * Description of CredentialsGateway
 *
 * @author po_taka
 */
class CredentialsGateway extends AbstractGateway
{    
    protected function getRelativeUrl()
    {
        $this->setGroups(['List']);
        return '/lyrics/credentials';
    }
}