<?php

namespace Tekstove\SiteBundle\Form\Type\Artist;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Tekstove\SiteBundle\Form\Field\ArtistsType;

/**
 * Actually this is event listener for FormEvents::PRE_SET_DATA
 *
 * @author po_taka
 */
class ArtistCollectionType
{
    private $request;
    private $gateway;

    public function __construct(Request $requst, $gateway)
    {
        $this->request = $requst;
        // @TODO check gateway type?
        $this->gateway = $gateway;
    }

    public function __invoke(FormEvent $event) 
    {
        $posts = $this->request->request->all();
        $it = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($posts));
        $potentialArtistIds = [];
        foreach ($it as $key => $v) {
            if (is_int($key)) {
                $potentialArtistIds[$v] = $v;
            }
        }

        $form = $event->getForm();
        $album = $event->getData();
        foreach ($album->getArtists() as $album) {
            $potentialArtistIds[] = $album->getId();
        }

        if (!empty($potentialArtistIds)) {
            $this->gateway->addFilter('id', $potentialArtistIds, 'in');
        }
        $this->gateway->setGroups(['List']);
        $artistsData = $this->gateway->find();

        $form->add(
            'artists',
            ArtistsType::class,
            [
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'entry_type' => ChoiceType::class,
                'entry_options' => [
                    'required' => true,
                    'choice_label' => 'name',
                    'choice_value' => 'id',
                    'choices' => $artistsData['items'],
                    'label' => 'Artist',
                ],
            ]
        );
    }
}
