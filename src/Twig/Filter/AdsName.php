<?php

namespace App\Twig\Filter;

use App\Ads\Ads;

class AdsName extends \Twig_Extension
{
    private $ads;

    /**
     * @param Ads $ads
     */
    public function __construct(Ads $ads)
    {
        $this->ads = $ads;
    }


    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter(
                'ad_name',
                [
                    $this,
                    'adName',
                ]
            ),
        ];
    }

    public function adName($id)
    {
        return $this->ads->getAdStatusName($id);
    }
}
