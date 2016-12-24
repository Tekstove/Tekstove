<?php

namespace Tekstove\SiteBundle\Form\Type\User;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Tekstove\SiteBundle\Model\User\User;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * Description of UserType
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class UserType extends \Symfony\Component\Form\AbstractType
{
    protected $options = array(
        'data_class' => User::class,
    );

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('about', TextareaType::class);
    }
    
    /**
     * Configures the options for this type.
     *
     * @param OptionsResolver $resolver The resolver for the options.
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}
