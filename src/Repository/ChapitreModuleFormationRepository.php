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

    /*
     * Retourne les chapitres de formation triés par formation, modules et par ordre
     */
    public function findAllOrderByFormationAndModuleAndOrdre()
    {
        return $this->createQueryBuilder('c')
            ->join('c.moduleFormation', 'm')
            ->join('m.formation', 'f')
            ->orderBy('f.nom', 'ASC')
            ->addOrderBy('m.ordre', 'ASC')
            ->addOrderBy('c.ordre', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
