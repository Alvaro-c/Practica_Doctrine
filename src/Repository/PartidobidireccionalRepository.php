<?php

namespace App\Repository;

use App\Entity\Partidobidireccional;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Partidobidireccional|null find($id, $lockMode = null, $lockVersion = null)
 * @method Partidobidireccional|null findOneBy(array $criteria, array $orderBy = null)
 * @method Partidobidireccional[]    findAll()
 * @method Partidobidireccional[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartidobidireccionalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Partidobidireccional::class);
    }

    // /**
    //  * @return Partidobidireccional[] Returns an array of Partidobidireccional objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Partidobidireccional
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
