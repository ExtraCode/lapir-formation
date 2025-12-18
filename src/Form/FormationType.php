<?php

namespace App\Form;

use App\Entity\Formation;
use App\Entity\NiveauFormation;
use App\Entity\ThematiqueFormation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('reference')
            ->add('courteDescription')
            ->add('description')
            ->add('eligibleCpf')
            ->add('prixInter')
            ->add('prixIntra')
            ->add('nbApprenant')
            ->add('auTop')
            ->add('nbJour')
            ->add('slug')
            ->add('thematique', EntityType::class, [
                'class' => ThematiqueFormation::class,
                'choice_label' => 'id',
            ])
            ->add('niveau', EntityType::class, [
                'class' => NiveauFormation::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
