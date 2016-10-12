<?php

namespace Eshop\AdminBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Router;

class DiscountType extends AbstractType
{
    /**
     * @var Router
     */
    protected $router;

    /**
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id',
                HiddenType::class,
                [
                    'mapped' => false,
                    'attr' => [
                        'translateLabel' => 'id',
                        'class' => 'hidden',
                    ],
                ])
            ->add('relationId',
                HiddenType::class,
                [
                    'attr' => [
                        'translateLabel' => 'relationId',
                        'class' => 'hidden',
                    ],
                ])
            ->add('number',
                IntegerType::class,
                [
                    'attr' => [
                        'translateLabel' => 'number'
                    ]
                ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'action' => $this->router->generate('admin_discount_edit_ajax'),
            'data_class' => 'Eshop\ShopBundle\Entity\Discount',
            'allow_extra_fields' => true,
            'csrf_protection' => false,
        ));
    }
}
