<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Artist;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;
use Tekstove\SiteBundle\Model\Artist\Artist;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\RequestException;

/**
 * @author po_taka <angel.koilov@gmail.com>
 */
class ArtistGateway extends AbstractGateway
{
    const GROUP_ALBUMS = 'Albums';
    const GROUP_ACL = 'Artist.Acl';
    
    protected function getRelativeUrl()
    {
        return '/artists/';
    }

    public function find()
    {
        $data = parent::find();
        $artists = [];
        foreach ($data['items'] as $artistData) {
            $artists[] = new Artist($artistData);
        }

        $data['items'] = $artists;
        return $data;
    }
    
    public function get($id)
    {
        $data = parent::get($id);
        $artist = new Artist($data['item']);
        return [
            'item' => $artist,
        ];
    }

    public function save(Artist $artist)
    {
        $changeSet = $artist->getChangeSet();
        $pathData = [];
        foreach ($changeSet as $property => $value) {
            $pathData[] = [
                'op' => 'replace',
                'path' => '/' . $property,
                'value' => $value,
            ];
        }

        try {
            $response = $this->getClient()
                            ->patch(
                                $this->getRelativeUrl() . $artist->getId(),
                                ['body' => json_encode($pathData)]
                            );
        } catch (RequestException $e) {
            if ($e->getCode() != 400) {
                throw $e;
            }

            $validationException = new TekstoveValidationException($e->getMessage(), 0, $e);
            $errors = json_decode($e->getBody(), true);
            $validationException->setValidationErrors($errors);
            throw $validationException;
        }

        $responseData = $this->decodeBody($response->getBody());
        return $responseData;
    }
}
