<?php

namespace Eshop\ShopBundle\Repository;

use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityRepository;

class CurrencyRepository extends EntityRepository
{
    /**
     * return products for admin
     *
     * @return QueryBuilder
     */
    public function getAllCurrenciesAdminQB()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select(array('c'))
            ->from('ShopBundle:Currency', 'c');

        return $qb;
    }
}
