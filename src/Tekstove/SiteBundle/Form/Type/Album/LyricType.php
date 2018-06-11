<?php

namespace Tekstove\SiteBundle\Form\Type\Album;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * This is the album lyric collection.
 * It is either relation to lyric or string
 *
 * @author po_taka
 */
class LyricType extends \Symfony\Component\Form\AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'name',
            null,
            [
                'attr' => [
                    'autocomplete' => 'off',
                ],
            ]
        );

        $builder->add(
            'lyric',
            \Symfony\Component\Form\Extension\Core\Type\IntegerType::class,
            [
                'attr' => [
                    'autocomplete' => 'off',
                ],
                'label' => 'id',
            ]
        );

        $builder->get('lyric')
                    ->addModelTransformer(
                        new \Symfony\Component\Form\CallbackTransformer(
                            function ($lyric) {
                                if ($lyric instanceof \Tekstove\SiteBundle\Model\Lyric\Lyric) {
                                    return $lyric->getId();
                                }

                                return $lyric;
                            },
                            function ($lyric) {
                                return $lyric;
                            }
                        )
                    );

        $builder->get('lyric')
            ->addEventListener(
                \Symfony\Component\Form\FormEvents::POST_SUBMIT,
                function (\Symfony\Component\Form\FormEvent $event) {
                    $form = $event->getForm();
                    $album = $form->getParent() // album-lyric
                            ->getParent() // album-lyric collection
                                ->getParent()
                                    ->getData();
                    /* @var $album \Tekstove\SiteBundle\Model\Album\Album */
                    $album->markLyricsAsChanged();
                }
            );
    }

    /**
     * Configures the options for this type.
     *
     * @param OptionsResolver $resolver The resolver for the options.
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => \Tekstove\SiteBundle\Model\Album\AlbumLyric::class,
            'attr' => [
                'novalidate' => 'novalidate',
            ],
        ]);
    }
}
