<?php

namespace App\Gateway\Tekstove\V4\Lyric;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric\LyricGateway as BaseGateway;

class LyricGateway extends BaseGateway
{
    protected function getRelativeUrl()
    {
        return '/v4/lyrics/';
    }
}
