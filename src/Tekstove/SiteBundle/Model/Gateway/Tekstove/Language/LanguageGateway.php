<?php


namespace Tekstove\SiteBundle\Model\Gateway\Tekstove\Language;

use Tekstove\SiteBundle\Model\Gateway\Tekstove\AbstractGateway;

use Tekstove\SiteBundle\Model\Language;

/**
 * Description of LanguageGateway
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class LanguageGateway extends AbstractGateway
{
    protected function getRelativeUrl()
    {
        return '/languages';
    }
    
    public function find()
    {
        $data = parent::find();
        $languages = [];
        foreach ($data['items'] as $languageData) {
            $languages[] = new Language($languageData);
        }

        $data['items'] = $languages;
        return $data;
    }
    
    public function get($id)
    {
        throw new \Exception('not implemented');
    }
}
