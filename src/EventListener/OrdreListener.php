<?php

namespace App\EventListener;

use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;

#[AsDoctrineListener(event: Events::prePersist)]
#[AsDoctrineListener(event: Events::postRemove)]
class OrdreListener
{
    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!method_exists($entity, 'getOrdre') || !method_exists($entity, 'setOrdre')) {
            return;
        }

        if ($entity->getOrdre() !== null) {
            return;
        }

        $em = $args->getObjectManager();
        $repo = $em->getRepository(get_class($entity));

        $maxOrdre = $repo->createQueryBuilder('e')
            ->select('MAX(e.ordre)')
            ->getQuery()
            ->getSingleScalarResult();

        $entity->setOrdre(($maxOrdre ?? 0) + 1);
    }

    public function postRemove(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!method_exists($entity, 'getOrdre')) {
            return;
        }

        $em = $args->getObjectManager();
        $repo = $em->getRepository(get_class($entity));

        $entities = $repo->createQueryBuilder('e')
            ->orderBy('e.ordre', 'ASC')
            ->getQuery()
            ->getResult();

        $ordre = 1;

        foreach ($entities as $item) {
            if ($item->getOrdre() !== $ordre) {
                $item->setOrdre($ordre);
            }
            $ordre++;
        }

        // Flush OK ici : on est après la suppression
        $em->flush();
    }
}
