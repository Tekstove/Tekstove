<?php

namespace Tekstove\SiteBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Tekstove\SiteBundle\Form\Field\ArtistsType;

use Symfony\Component\HttpFoundation\RequestStack;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Artist\ArtistGateway;
use Tekstove\SiteBundle\Model\Gateway\Tekstove\Language\LanguageGateway;

class LyricType extends \Symfony\Component\Form\AbstractType
{
    private $request;
    private $artistGateway;
    private $languageGateway;
    
    public function __construct(RequestStack $requestStack, ArtistGateway $artistGateway, LanguageGateway $languagegateway)
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->artistGateway = $artistGateway;
        $this->languageGateway = $languagegateway;
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
                'label' => 'Translation',
            ]
        );
        
        // @TODO check permissions
        $builder->add('videoYoutube', TextType::class, []);
        $builder->add('videoVbox7', TextType::class, []);
        
        // @TODO check permissions
        $builder->add('extraInfo', TextType::class, []);
        
        if (in_array('download', $fields)) {
            $builder->add('download', TextType::class, []);
        }
        
        
        $builder->add(
            'languages',
            ChoiceType::class,
            [
                'choice_label' => 'name',
                'multiple' => true,
                'attr' => [
                    'class' => 't-selectSmart',
                ],
                'choices' => $this->getLanguages(),
                'choice_value' => 'id',
            ]
        );
        
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
    
    private function getLanguages()
    {
        $this->languageGateway->setGroups('List');
        $languagesData = $this->languageGateway->find();
        $languages = $languagesData['items'];
        return $languages;
    }
}
