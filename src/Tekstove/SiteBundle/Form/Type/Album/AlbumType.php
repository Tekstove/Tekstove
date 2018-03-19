<?php

namespace Tekstove\SiteBundle\Form\Type\Album;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Tekstove\SiteBundle\Form\Type\Artist\ArtistCollectionType;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Artist\ArtistGateway;

/**
 * Description of AlbumType
 *
 * @author potaka
 */
class AlbumType extends \Symfony\Component\Form\AbstractType
{
    private $request;
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
            $builder->add('name');
        }

        if (in_array('year', $fields)) {
            $builder->add('year', IntegerType::class);
        }

        if (in_array('artists', $fields)) {

            $request = $this->request;
            $artistGateway = $this->artistGateway;

            $artistCollectionType = new ArtistCollectionType($request, $artistGateway);

            $builder->addEventListener(
                FormEvents::PRE_SET_DATA,
                $artistCollectionType
            );
        }

        if (in_array('image', $fields)) {
            $builder->add('image');
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

        $resolver->setDefaults(
            array(
                'attr' => [
                    'novalidate' => 'novalidate',
                ]
            )
        );
    }
}
