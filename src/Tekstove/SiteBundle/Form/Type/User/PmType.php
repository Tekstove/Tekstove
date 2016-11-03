<?php

namespace Tekstove\SiteBundle\Form\Type\User;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Tekstove\SiteBundle\Model\User\Pm;
use Tekstove\SiteBundle\Model\User\User;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * Description of PmType
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class PmType extends \Symfony\Component\Form\AbstractType
{
    protected $options = array(
        'data_class' => Pm::class,
    );

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title');
        $builder->add('text', TextareaType::class);
        
        $builder->add(
            'userTo',
            HiddenType::class
        );
        $builder->get('userTo')
                    ->addModelTransformer(
                        new \Symfony\Component\Form\CallbackTransformer(
                            function (User $user) {
                                return $user->getId();
                            },
                            function ($id) {
                                return new User(['id' => (int) $id]);
                            }
                        )
                    );
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
