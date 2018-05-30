<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Album;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;
use Tekstove\SiteBundle\Model\Album\Album;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\RequestException;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\TekstoveValidationException;

/**
 * Description of AlbumGateway
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class AlbumGateway extends AbstractGateway
{
    const GROUP_DETAILS = 'Album.Details';

    protected function getRelativeUrl()
    {
        return '/albums/';
    }

    public function find()
    {
        $data = parent::find();
        $albums = [];
        foreach ($data['items'] as $lyricData) {
            $albums[] = new Album($lyricData);
        }

        $data['items'] = $albums;
        return $data;
    }

    public function get($id)
    {
        $data = parent::get($id);
        $album = new Album($data['item']);
        return [
            'item' => $album,
        ];
    }

    public function save(Album $album)
    {
        $changeSet = $album->getChangeSet();

        if ($album->getId()) {
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
                                        $this->getRelativeUrl() . $album->getId(),
                                        [
                                            'body' => json_encode($pathData),
                                        ]
                                    );
        } else {
            try {
                $response = $this->getClient()
                                    ->post(
                                        $this->getRelativeUrl(),
                                        [
                                            'body' => json_encode($changeSet),
                                        ]
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
            $parsedResponse = json_decode($response->getBody(), true);
            $album->setId($parsedResponse['item']['id']);
        }

        return $album;
    }
}
