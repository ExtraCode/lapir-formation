<?php

namespace App\EventListener;

use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;
use ReflectionClass;

readonly class SlugListener
{
    public function __construct(
        private SluggerInterface $slugger
    )
    {
    }

    /* =====================
       CRÉATION
       ===================== */
    public function prePersist(PrePersistEventArgs $args): void
    {
        $this->handleSlug($args->getObject(), $args->getObjectManager());
    }

    /* =====================
       MISE À JOUR
       ===================== */
    public function preUpdate(PreUpdateEventArgs $args): void
    {
        // 👉 on ne régénère le slug QUE si le champ source change
        if (
            !$args->hasChangedField('nom')
            && !$args->hasChangedField('titre')
        ) {
            return;
        }

        $this->handleSlug($args->getObject(), $args->getObjectManager());

        // 🔴 OBLIGATOIRE en preUpdate
        $args->getObjectManager()
            ->getUnitOfWork()
            ->recomputeSingleEntityChangeSet(
                $args->getObjectManager()->getClassMetadata(get_class($args->getObject())),
                $args->getObject()
            );
    }

    /* =====================
       LOGIQUE COMMUNE
       ===================== */
    private function handleSlug(object $entity, $em): void
    {
        $reflection = new ReflectionClass($entity);

        if (!$reflection->hasProperty('slug')) {
            return;
        }

        $slugProperty = $reflection->getProperty('slug');
        $slugProperty->setAccessible(true);

        foreach (['nom', 'titre', 'name', 'label'] as $field) {
            if (!$reflection->hasProperty($field)) {
                continue;
            }

            $sourceProperty = $reflection->getProperty($field);
            $sourceProperty->setAccessible(true);
            $source = $sourceProperty->getValue($entity);

            if (empty($source)) {
                continue;
            }

            $repo = $em->getRepository(get_class($entity));

            $baseSlug = $this->slugger->slug($source)->lower();
            $slug = $baseSlug;
            $i = 1;

            while ($repo->findOneBy(['slug' => $slug])) {
                $slug = $baseSlug . '-' . $i;
                $i++;
            }

            $slugProperty->setValue($entity, $slug);
            return;
        }
    }
}
