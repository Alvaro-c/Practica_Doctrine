<?php

namespace App\Repository;

use App\Entity\Presidente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Presidente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Presidente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Presidente[]    findAll()
 * @method Presidente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PresidenteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Presidente::class);
    }

    // /**
    //  * @return Presidente[] Returns an array of Presidente objects
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
    public function findOneBySomeField($value): ?Presidente
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
