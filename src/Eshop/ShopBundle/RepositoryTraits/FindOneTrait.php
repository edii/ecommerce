<?php

namespace Eshop\ShopBundle\RepositoryTraits;

trait FindOneTrait
{
    public function findOneByResult($where = []) {
        $queryBuilder = $this->createQueryBuilder('REPO')
            ->select('REPO');

        if (count($where)) {
            $queryBuilder->where($where);
        }

        return $queryBuilder->getQuery()
            ->getOneOrNullResult();
    }
}