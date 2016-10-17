<?php

namespace Eshop\ShopBundle\Twig;

use Eshop\ShopBundle\Entity\Discount;

class DiscountExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('discount', array($this, 'discountFilter')),
        );
    }

    public function discountFilter($type)
    {
        return ($type == Discount::DISCOUNT_PERCENT)?'%':'грн.';
    }

    public function getName()
    {
        return 'discount_extension';
    }
}
