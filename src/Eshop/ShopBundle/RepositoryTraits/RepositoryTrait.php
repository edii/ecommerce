<?php

namespace Eshop\ShopBundle\RepositoryTraits;

use Doctrine\DBAL\Exception;

trait RepositoryTrait
{
    /**
     * Delete entities
     *
     * @param array $idx
     */
    public function delete(array $idx)
    {
        $qb = $this->createQueryBuilder('REPO');

        $qb->delete()
            ->andWhere($qb->expr()->in('REPO.id', ':idx'))
            ->setParameter('idx', $idx)
            ->getQuery()
            ->execute();
    }

    /**
     * Update enable/disable field
     *
     * @param array $idx
     * @param mixed $state
     */
    public function updateEnabled(array $idx, $state)
    {
        $qb = $this->createQueryBuilder('REPO');

        $qb->update()
            ->set('REPO.enabled', ':state')
            ->andWhere($qb->expr()->in('REPO.id', ':idx'))
            ->setParameter('state', $state)
            ->setParameter('idx', $idx)
            ->getQuery()
            ->execute();
    }

    /**
     * Return Locale Query Builder without any conditions
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilder()
    {
        return $this->createQueryBuilder('REPO');
    }

    /**
     * Get entity names
     * @param string|bool $where
     * @param array $fields
     * @return array
     */
    public function getArray(array $fields = [], $where = false)
    {
        $result = [];

        $fieldsQuery = [];
        if (count($fields)) {
            foreach ($fields as $key => $field) {
                $fieldsQuery[] = 'REPO.'.$field;
            }
        }

        try {
            $queryBuilder = $this->createQueryBuilder('REPO')
                ->select((count($fieldsQuery))?implode($fieldsQuery, ','):'REPO.name, REPO.id');

            if (!empty($where)) {
                if (is_array($where)) {
                    foreach ($where as $field => $value) {
                        $queryBuilder->andWhere('REPO.'.$field.$value['symbol'].$value['param']);
                    }
                } else {
                    $queryBuilder->where($where);
                }
            }

            $result = $queryBuilder->getQuery()->getArrayResult();
        } catch (Exception $e) {
            $result['error'] = 'Can\'t get properties of class';
        }

        return $result;
    }
}
