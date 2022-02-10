<?php

namespace App\Repository;

use App\Entity\Equipobidireccional;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Equipobidireccional|null find($id, $lockMode = null, $lockVersion = null)
 * @method Equipobidireccional|null findOneBy(array $criteria, array $orderBy = null)
 * @method Equipobidireccional[]    findAll()
 * @method Equipobidireccional[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquipobidireccionalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Equipobidireccional::class);
    }

    // /**
    //  * @return Equipo[] Returns an array of Equipo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Equipo
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
