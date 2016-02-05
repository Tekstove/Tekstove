<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;

use Tekstove\SiteBundle\Model\Lyric\Lyric;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\RequestException;

/**
 * Description of LyricGateway
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class LyricGateway extends AbstractGateway
{
    protected function getRelativeUrl()
    {
        return '/lyrics';
    }
    
    public function find()
    {
        $data = parent::find();
        $lyrics = [];
        foreach ($data['items'] as $lyricData) {
            $lyrics[] = new Lyric($lyricData);
        }

        $data['items'] = $lyrics;
        return $data;
    }
    
    public function get($id)
    {
        $data = parent::get($id);
        $lyric = new Lyric($data['item']);
        return [
            'item' => $lyric,
        ];
    }
    
    public function save(Lyric $lyric)
    {
        // @TODO fix
        $data = [
            'id' => $lyric->getId(),
            'title' => $lyric->getTitle(),
        ];
        
        try {
            $response = $this->getClient()
                                ->post($this->getRelativeUrl(), $data);
        } catch (RequestException $e) {
            if ($e->getCode() != 400) {
                throw $e;
            }
            
            throw new \Exception('@FIXME')
        }
    }
}
