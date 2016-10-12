<?php

namespace Eshop\ShopBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Eshop\ShopBundle\RepositoryTraits\RepositoryTrait;
use Eshop\ShopBundle\RepositoryTraits\CountableTrait;

class DiscountRepository extends EntityRepository
{
    use RepositoryTrait, CountableTrait;
}
