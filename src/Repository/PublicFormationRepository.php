<?php

namespace App\Repository;

use App\Entity\PublicFormation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PublicFormation>
 *
 * @method PublicFormation|null find($id, $lockMode = null, $lockVersion = null)
 * @method PublicFormation|null findOneBy(array $criteria, array $orderBy = null)
 * @method PublicFormation[]    findAll()
 * @method PublicFormation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PublicFormationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PublicFormation::class);
    }

//    /**
//     * @return PublicFormatique[] Returns an array of PublicFormatique objects
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

//    public function findOneBySomeField($value): ?PublicFormatique
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
