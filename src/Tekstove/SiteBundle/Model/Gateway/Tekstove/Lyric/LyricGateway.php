<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;

use Tekstove\SiteBundle\Model\Lyric\Lyric;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\RequestException;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\TekstoveValidationException;

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
            'text' => $lyric->getText(),
            
            'videoYoutube' => $lyric->getVideoYoutube(),
            'videoVbox7' => $lyric->getVideoVbox7(),
        ];
        
        try {
            if ($lyric->getId()) {
                // @TODO fix request type to proper patch
                $response = $this->getClient()
                                    ->patch(
                                        $this->getRelativeUrl() . '/' . $lyric->getId(),
                                        ['body' => json_encode($data)]
                                    );
            } else {
                $response = $this->getClient()
                                    ->post(
                                        $this->getRelativeUrl(),
                                        ['body' => json_encode($data)]
                                    );
            }
            
            $responseData = $this->decodeBody($response->getBody());
            if (!$lyric->getId()) {
                $lyric->setId($responseData['item']['id']);
            }
            return $responseData;
        } catch (RequestException $e) {
            if ($e->getCode() != 400) {
                throw $e;
            }
            
            $validationException = new TekstoveValidationException($e->getMessage(), 0, $e);
            $errors = json_decode($e->getBody(), true);
            $validationException->setValidationErrors($errors);
            throw $validationException;
        }
    }
}
