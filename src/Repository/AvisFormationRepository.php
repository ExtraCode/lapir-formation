<?php

namespace App\Repository;

use App\Entity\AvisFormation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AvisFormation>
 *
 * @method AvisFormation|null find($id, $lockMode = null, $lockVersion = null)
 * @method AvisFormation|null findOneBy(array $criteria, array $orderBy = null)
 * @method AvisFormation[]    findAll()
 * @method AvisFormation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvisFormationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AvisFormation::class);
    }

//    /**
//     * @return AvisFormation[] Returns an array of AvisFormation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AvisFormation
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
