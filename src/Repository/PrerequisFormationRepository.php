<?php

namespace App\Repository;

use App\Entity\PrerequisFormation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PrerequisFormation>
 *
 * @method PrerequisFormation|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrerequisFormation|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrerequisFormation[]    findAll()
 * @method PrerequisFormation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrerequisFormationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrerequisFormation::class);
    }

//    /**
//     * @return PrerequisFormation[] Returns an array of PrerequisFormation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PrerequisFormation
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
