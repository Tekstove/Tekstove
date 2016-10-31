<?php

namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\User;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;
use Tekstove\SiteBundle\Model\User\Pm;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\TekstoveValidationException;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Client\Exception\RequestException;

/**
 * Description of PmGateway
 *
 * @author potaka
 */
class PmGateway extends AbstractGateway
{
    protected function getRelativeUrl()
    {
        return 'users/pm';
    }
    
    public function find()
    {
        $data = parent::find();
        foreach ($data['items'] as &$pmData) {
            $pmData = new Pm($pmData);
        }
        unset($pmData);
        
        return $data;
    }
    
    public function get($id)
    {
        $data = parent::get($id);
        $pm = new Pm($data['item']);
        return [
            'item' => $pm,
        ];
    }
    
    public function save(Pm $pm)
    {
        $changeSet = $pm->getChangeSet();

        try {
            if ($pm->getId()) {
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
                                        $this->getRelativeUrl() . '/' . $pm->getId(),
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
            if (!$pm->getId()) {
                $pm->setId($responseData['item']['id']);
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
