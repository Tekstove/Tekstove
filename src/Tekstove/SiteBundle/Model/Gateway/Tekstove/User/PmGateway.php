<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\User;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;
use Tekstove\SiteBundle\Model\User\Pm;

/**
 * Description of PmGateway
 *
 * @author potaka
 */
class PmGateway extends AbstractGateway
{
    protected function getRelativeUrl()
    {
        return 'users/pm';
    }
    
    public function find()
    {
        $data = parent::find();
        foreach ($data['items'] as &$pmData) {
            $pmData = new Pm($pmData);
        }
        unset($pmData);
        
        return $data;
    }
}
