<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class ExampleRepository extends EntityRepository
{
    public function getByState($state, $limit = null)
    {
        $qb = $this->createQueryBuilder('e')
            ->andWhere('e.state = :state')->setParameter('state', $state)
            ->orderBy('e.id');

        if ($limit) {
            $qb->setMaxResults($limit);
        }

        return $qb->getQuery()->getResult();
    }
}
