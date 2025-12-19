<?php

namespace App\Form;

use App\Entity\Formation;
use App\Entity\NiveauFormation;
use App\Entity\ThematiqueFormation;
use App\Repository\NiveauFormationRepository;
use App\Repository\ThematiqueFormationRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de la formation <span class="text-danger">*</span>',
                'label_html' => true
            ])
            ->add('reference', TextType::class, [
                'label' => 'Code référence <span class="text-danger">*</span>',
                'label_html' => true
            ])
            ->add('courteDescription', TextareaType::class, [
                'label' => "Courte description <span class='text-danger'>*</span>",
                'label_html' => true,
                'attr' => [
                    'rows' => 5,
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => "Description <span class='text-danger'>*</span>",
                'label_html' => true,
                'required' => false,
                'attr' => [
                    'rows' => 5,
                    'class' => 'tinymce'
                ]
            ])
            ->add('eligibleCpf', CheckboxType::class, [
                'label' => "Eligible au CPF",
                'required' => false
            ])
            ->add('prixInter', NumberType::class, [
                'label' => "Prix inter",
                'required' => false
            ])
            ->add('prixIntra', NumberType::class, [
                'label' => "Prix intra",
                'required' => false
            ])
            ->add('nbApprenant', NumberType::class, [
                'label' => "Nombre d'apprenants maximum <span class='text-danger'>*</span>",
                'label_html' => true
            ])
            ->add('auTop', CheckboxType::class, [
                'label' => "Au top sur l'accueil",
                'required' => false

            ])
            ->add('nbJour', NumberType::class, [
                'label' => "Durée de la formation (jours) <span class='text-danger'>*</span>",
                'label_html' => true
            ])
            ->add('thematique', EntityType::class, [
                'class' => ThematiqueFormation::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true,
                'label' => "Thématiques <span class='text-danger'>*</span>",
                'label_html' => true,
                'query_builder' => function (ThematiqueFormationRepository $er) {
                    return $er->createQueryBuilder('t')
                        ->orderBy('t.nom', 'ASC');
                }

            ])
            ->add('niveau', EntityType::class, [
                'class' => NiveauFormation::class,
                'choice_label' => 'nom',
                'label' => "Niveau <span class='text-danger'>*</span>",
                'label_html' => true,
                'query_builder' => function (NiveauFormationRepository $er) {
                    return $er->createQueryBuilder('n')
                        ->orderBy('n.nom', 'ASC');
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
