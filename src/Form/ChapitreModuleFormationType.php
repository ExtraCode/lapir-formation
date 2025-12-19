<?php

namespace App\Form;

use App\Entity\ChapitreModuleFormation;
use App\Entity\ModuleFormation;
use App\Repository\ModuleFormationRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChapitreModuleFormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom du chapitre de formation <span class="text-danger">*</span>',
                'label_html' => true
            ])
            ->add('moduleFormation', EntityType::class, [
                'class' => ModuleFormation::class,
                'choice_label' => 'nom',
                'label' => 'Module de formation <span class="text-danger">*</span>',
                'label_html' => true,
                'query_builder' => function (ModuleFormationRepository $er) {
                    return $er->createQueryBuilder('m')
                        ->orderBy('m.nom', 'ASC');
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ChapitreModuleFormation::class,
        ]);
    }
}
