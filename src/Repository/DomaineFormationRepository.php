<?php

namespace App\Repository;

use App\Entity\DomaineFormation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DomaineFormation>
 *
 * @method DomaineFormation|null find($id, $lockMode = null, $lockVersion = null)
 * @method DomaineFormation|null findOneBy(array $criteria, array $orderBy = null)
 * @method DomaineFormation[]    findAll()
 * @method DomaineFormation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DomaineFormationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DomaineFormation::class);
    }

    /**
     * @return DomaineFormation[] Returns an array of DomaineFormation objects
     */
    public function findDomaineFormationWithFormation(): array
    {
        return $this->createQueryBuilder('df')
            ->join('df.thematiqueFormations', 'tf')
            ->join('tf.formations', 'f')
            ->orderBy('df.nom')
            ->getQuery()
            ->getResult();
    }

//    public function findOneBySomeField($value): ?DomaineFormation
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
