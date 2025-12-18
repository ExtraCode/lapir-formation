<?php

namespace App\Repository;

use App\Entity\ChapitreModuleFormation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ChapitreModuleFormation>
 *
 * @method ChapitreModuleFormation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChapitreModuleFormation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChapitreModuleFormation[]    findAll()
 * @method ChapitreModuleFormation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChapitreModuleFormationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChapitreModuleFormation::class);
    }

//    /**
//     * @return ModuleChapitreFormation[] Returns an array of ModuleChapitreFormation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ModuleChapitreFormation
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
