<?php

namespace App\Repository;

use App\Entity\ThematiqueFormation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ThematiqueFormation>
 *
 * @method ThematiqueFormation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ThematiqueFormation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ThematiqueFormation[]    findAll()
 * @method ThematiqueFormation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThematiqueFormationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ThematiqueFormation::class);
    }

//    /**
//     * @return ThematiqueFormation[] Returns an array of ThematiqueFormation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ThematiqueFormation
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
