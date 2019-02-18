<?php

namespace App\Gateway\Tekstove\Lyric;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric\LyricGateway;

class LyricGatewayV4 extends LyricGateway
{
    protected function getRelativeUrl()
    {
        return '/v4/lyrics/';
    }
}
