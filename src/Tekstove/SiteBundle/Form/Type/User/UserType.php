<?php

namespace Tekstove\SiteBundle\Form\Type\User;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Tekstove\SiteBundle\Model\User\User;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Description of UserType
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class UserType extends \Symfony\Component\Form\AbstractType
{
    protected $options = [
        'data_class' => User::class,
    ];

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $allowedFields = $options['fields'];

        if (isset($allowedFields['about'])) {
            $builder->add(
                'about',
                TextareaType::class,
                [
                    'label' => 'About me',
                ]
            );
        }

        if (isset($allowedFields['avatar'])) {
            $builder->add('avatar', TextType::class);
        }

        if (isset($allowedFields['termsAccepted'])) {
            $builder->add(
                'termsAccepted',
                \Symfony\Component\Form\Extension\Core\Type\CheckboxType::class,
                [
                    'label' => 'I agree to terms',
                    'required' => false,
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
        $resolver->setDefaults(
            [
                'attr' => [
                    'id' => 'user-edit-form',
                ],
            ]
        );
    }
}
