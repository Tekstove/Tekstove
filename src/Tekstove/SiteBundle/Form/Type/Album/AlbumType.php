<?php

namespace Tekstove\SiteBundle\Form\Type\Album;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Tekstove\SiteBundle\Form\Type\Artist\ArtistCollectionType;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Artist\ArtistGateway;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Description of AlbumType
 *
 * @author potaka
 */
class AlbumType extends \Symfony\Component\Form\AbstractType
{
    /**
     * @var RequestStack
     */
    private $request;

    /**
     * @var ArtistGateway
     */
    private $artistGateway;

    public function __construct(RequestStack $requestStack, ArtistGateway $artistGateway)
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->artistGateway = $artistGateway;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $fields = $options['fields'];

        if (in_array('name', $fields)) {
            $builder->add(
                'name',
                null,
                [
                    'empty_data' => '',
                ]
            );
        }

        if (in_array('year', $fields)) {
            $builder->add(
                'year',
                IntegerType::class,
                [
                    'label' => 'Release date',
                    'attr' => [
                        'placeholder' => 2010,
                    ],
                ]
            );
        }

        if (in_array('artists', $fields)) {
            $artistCollectionType = new ArtistCollectionType(
                $this->request,
                $this->artistGateway
            );

            $builder->addEventListener(
                FormEvents::PRE_SET_DATA,
                $artistCollectionType
            );
        }

        if (in_array('image', $fields)) {
            $builder->add(
                'image',
                TextType::class,
                [
                    'attr' => [
                        'placeholder' => 'https://en.wikipedia.org/wiki/50_Cent#/media/File:50-cent-face.png',
                    ],
                ]
            );
        }

        if (in_array('lyrics', $fields)) {
            $builder->add(
                'lyrics',
                CollectionType::class,
                [
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'entry_options' => [
                        'label' => false,
                    ],
                    'entry_type' => LyricType::class,
                ]
            );
        }
    }

    /**
     * Configures the options for this type.
     *
     * @param OptionsResolver $resolver The resolver for the options.
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('fields');

        $resolver->setDefaults([
            'attr' => [
                'novalidate' => 'novalidate',
            ],
        ]);
    }
}
