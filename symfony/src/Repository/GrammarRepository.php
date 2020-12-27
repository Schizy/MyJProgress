<?php

namespace App\Repository;

use App\Entity\Example;
use Doctrine\ORM\EntityRepository;

class GrammarRepository extends EntityRepository
{
    /**
     * For ParamConverter purpose
     */
    public function find($id, $lockMode = null, $lockVersion = null)
    {
        return $this->getQueryBuilder()
            ->andWhere('g.id = :id')->setParameter('id', $id)
            ->getQuery()->getOneOrNullResult();
    }

    public function list()
    {
        return $this->getQueryBuilder()
            ->orderBy('g.createdAt', 'DESC')
            ->getQuery()->getResult();
    }

    private function getQueryBuilder()
    {
        return $this->createQueryBuilder('g')
            ->innerJoin('g.examples', 'e')->addSelect('e')
            ->andWhere('e.state = :state')->setParameter('state', Example::SUBMITTED);
    }
}
