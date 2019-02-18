<?php

namespace App\Ads;

class Ads
{
    const NOT_ALLOWED = 0;
    const ALLOWED = 1;
    const ALLOWED_ONLY_NOT_SAFE = 3;

    const ADS_NAME = [
        self::NOT_ALLOWED => 'not allowed',
        self::ALLOWED => 'allowed',
        self::ALLOWED_ONLY_NOT_SAFE => 'allowed only not safe',
    ];

    /**
     * @param int $id
     * @return string
     */
    public function getAdStatusName($id)
    {
        if (isset(self::ADS_NAME[$id])) {
            return self::ADS_NAME[$id];
        }

        return 'Unknown ad status: ' . $id;
    }
}
