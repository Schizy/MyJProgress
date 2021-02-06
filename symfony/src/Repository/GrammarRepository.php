<?php

namespace App\Repository;

use App\Entity\Example;
use App\Entity\Grammar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class GrammarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Grammar::class);
    }

    /**
     * For ParamConverter purpose
     */
    public function findById($id, $lockMode = null, $lockVersion = null)
    {
        return $this->getQueryBuilder()
            ->andWhere('g.id = :id')->setParameter('id', $id)
            ->getQuery()->getOneOrNullResult();
    }

    public function list()
    {
        return $this->createQueryBuilder('g')
            ->orderBy('g.createdAt', 'DESC')
            ->getQuery()->getResult();
    }

    private function getQueryBuilder()
    {
        return $this->createQueryBuilder('g')
            ->innerJoin('g.examples', 'e')->addSelect('e')
            ->andWhere('e.state = :state')->setParameter('state', Example::PUBLISHED);
    }
}
