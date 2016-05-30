<?php

namespace Tekstove\SiteBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\HttpFoundation\RequestStack;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Artist\ArtistGateway;

class LyricType extends \Symfony\Component\Form\AbstractType
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
                $lyric = $event->getData();
                foreach ($lyric->getArtists() as $artist) {
                    $potentialArtistIds[] = $artist->getId();
                }
                
                if (!empty($potentialArtistIds)) {
                    $artistGateway->addFilter('id', $potentialArtistIds, 'in');
                }
                $artistGateway->setGroups(['List']);
                $artistsData = $artistGateway->find();
                
                $form->add(
                    'artists',
                    CollectionType::class,
                    [
                        'allow_add' => true,
                        'allow_delete' => true,
                        'by_reference' => false,
                        'entry_type' => ChoiceType::class,

                        'entry_options' => [
                            'choice_label' => 'name',
                            'choice_value' => 'id',
                            'choices' => $artistsData['items'],
                        ]
                    ]
                );
                
            }
        );
        
        if (in_array('title', $fields)) {
            $builder->add('title');
        }
        
        if (in_array('text', $fields)) {
            $builder->add('text', TextareaType::class);
        }
        
        $builder->add(
            'textBg',
            TextareaType::class,
            [
                'label' => 'Translation'
            ]
        );
        
        $builder->add('videoYoutube', TextType::class, []);
        $builder->add('videoVbox7', TextType::class, []);
        
        $builder->add('extraInfo', TextType::class, []);
        
        if (in_array('download', $fields)) {
            $builder->add('download', TextType::class, []);
        }
//        $builder->add(
//            'languages',
//            null
//            [
//                'choice_label' => 'name',
//                'attr' => [
//                    'class' => 't-selectSmart',
//                ],
//            ]
//        );
        
//        $builder->add('videoYoutube');
//        $builder->add('videoVbox7');
//        $builder->add('videoMetacafe');
//        
//        $builder->add(
//            'download',
//            null,
//            [
//                'label' => 'Download link',
//            ]
//        );
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
