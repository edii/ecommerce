<?php

namespace Eshop\ShopBundle\Twig;

use Eshop\ShopBundle\Traits\EnableableTrait;

class EnabledExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('enabled', array($this, 'enabledFilter')),
        );
    }

    public function enabledFilter($enabled)
    {
        return EnableableTrait::getEnabledStatus($enabled);
    }

    public function getName()
    {
        return 'enabled_extension';
    }
}
