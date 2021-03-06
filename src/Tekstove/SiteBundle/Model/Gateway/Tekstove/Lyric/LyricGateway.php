<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Lyric;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;

use Tekstove\SiteBundle\Model\Lyric\Lyric;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\RequestException;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\TekstoveValidationException;

/**
 * LyricGateway
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class LyricGateway extends AbstractGateway
{
    const FIELD_POPULARITY = 'popularity';
    const FIELD_VIEWS = 'views';
    
    const GROUP_POPULARITY = 'Popularity';
    const GROUP_VIEWS = 'Views';
    const GROUP_MANUAL_CENSOR = 'ManualCensor';
    const GROUP_SEND_BY = 'lyric.sendBy';

    private $relativeUrl ='/lyrics/';

    protected function getRelativeUrl()
    {
        return $this->relativeUrl;
    }

    /**
     * @param string $relativeUrl
     */
    public function setRelativeUrlToV4()
    {
        $this->relativeUrl = '/v4' . $this->relativeUrl;
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
        $changeSet = $lyric->getChangeSet();

        try {
            if ($lyric->getId()) {
                $pathData = [];
                foreach ($changeSet as $property => $value) {
                    $pathData[] = [
                        'op' => 'replace',
                        'path' => '/' . $property,
                        'value' => $value,
                    ];
                }
                
                $response = $this->getClient()
                                    ->patch(
                                        $this->getRelativeUrl() . $lyric->getId(),
                                        ['body' => json_encode($pathData)]
                                    );
            } else {
                $response = $this->getClient()
                                    ->post(
                                        $this->getRelativeUrl(),
                                        ['body' => json_encode($changeSet)]
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
