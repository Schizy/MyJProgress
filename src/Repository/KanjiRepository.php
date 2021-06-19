<?php

namespace App\Repository;

use App\Entity\Kanji;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Kanji|null find($id, $lockMode = null, $lockVersion = null)
 * @method Kanji|null findOneBy(array $criteria, array $orderBy = null)
 * @method Kanji[]    findAll()
 * @method Kanji[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KanjiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Kanji::class);
    }

    /**
     * @param int $limit
     * @return int|mixed|string
     */
    public function findNullCommonStat(int $limit = 50)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.commonStat is null')
            ->setMaxResults($limit)
            ->getQuery()->getResult();
    }

    /**
     * @param int $limit
     * @return int|mixed|string
     */
    public function findNoReadings(int $limit = 50)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.kunyomi is null')
            ->andWhere('k.onyomi is null')
            ->setMaxResults($limit)
            ->getQuery()->getResult();
    }
}
