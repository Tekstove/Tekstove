<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Album;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;

/**
 * Description of AlbumCredentialsGateway
 *
 * @author potaka
 */
class AlbumCredentialsGateway extends AbstractGateway
{
    protected function getRelativeUrl()
    {
        $this->setGroups(['List']);
        return '/albums/credentials';
    }
}
