<?php

namespace App\Gateway\Tekstove\V4\Publisher;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;
use Tekstove\SiteBundle\Model\Publisher\Publisher;

class PublisherGateway extends AbstractGateway
{
    private $relativeUrl ='/v4/publishers/';

    protected function getRelativeUrl()
    {
        return $this->relativeUrl;
    }

    public function get($id)
    {
        $data = parent::get($id);
        $publisher = new Publisher($data['item']);
        return [
            'item' => $publisher,
        ];
    }
}
