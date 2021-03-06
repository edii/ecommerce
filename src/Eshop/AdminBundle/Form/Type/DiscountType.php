<?php

namespace Eshop\AdminBundle\Form\Type;

use Eshop\ShopBundle\Entity\Discount;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('amount',
                IntegerType::class,
                [
                    'attr' => [
                        'translateLabel' => 'Amount'
                    ]
                ])
            ->add('type',
                ChoiceType::class,
                [
                    'label' => 'Type',
                    'choices' => [
                        Discount::DISCOUNT_PERCENT => Discount::DISCOUNT_PERCENT,
                        Discount::DISCOUNT_CASH => Discount::DISCOUNT_CASH
                    ],
                    'attr' => [
                        'translateLabel' => 'type'
                    ]
                ])
            ->add('validFrom',
                DateTimeType::class,
                [
                    'widget' => 'single_text',
                    'date_format' => 'MM-dd-yyyy', // HH:mm
                    'placeholder' => array(
                        'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                        'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
                    )
                ])
            ->add('validTo',
                DateTimeType::class,
                [
                    'widget' => 'single_text',
                    'date_format' => 'MM-dd-yyyy', // HH:mm
                    'placeholder' => array(
                        'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                        'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
                    )
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
