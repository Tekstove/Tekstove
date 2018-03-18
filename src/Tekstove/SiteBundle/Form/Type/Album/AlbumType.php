<?php

namespace Tekstove\SiteBundle\Form\Type\Album;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Tekstove\SiteBundle\Form\Field\ArtistsType;

use Symfony\Component\HttpFoundation\RequestStack;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Artist\ArtistGateway;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

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

//        $request = $this->request;
//        $artistGateway = $this->artistGateway;

        if (in_array('name', $fields)) {
            $builder->add('name');
        }

        if (in_array('year', $fields)) {
            $builder->add('year', IntegerType::class);
        }

        if (in_array('artists', $fields)) {

            $request = $this->request;
            $artistGateway = $this->artistGateway;

            $builder->addEventListener(
                FormEvents::PRE_SET_DATA,
                function (FormEvent $event) use ($request, $artistGateway) {
                    $posts = $request->request->all();
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
                        $artistGateway->addFilter('id', $potentialArtistIds, 'in');
                    }
                    $artistGateway->setGroups(['List']);
                    $artistsData = $artistGateway->find();

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

        $resolver->setDefaults(
            array(
                'attr' => [
                    'novalidate' => 'novalidate',
                ]
            )
        );
    }
}
