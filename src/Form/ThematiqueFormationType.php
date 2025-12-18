<?php

namespace App\Form;

use App\Entity\DomaineFormation;
use App\Entity\ThematiqueFormation;
use App\Repository\DomaineFormationRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ThematiqueFormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de la thématique <span class="text-danger">*</span>',
                'label_html' => true
            ])
            ->add('description', TextType::class, [
                'label' => "Description de la thématique <span class='text-danger'>*</span>",
                'label_html' => true,
                'required' => false,
                'attr' => [
                    'rows' => 5,
                    'class' => 'tinymce'
                ]
            ])
            ->add('domaine', EntityType::class, [
                'class' => DomaineFormation::class,
                'choice_label' => 'nom',
                'label' => 'Domaine de formation <span class="text-danger">*</span>',
                'label_html' => true,
                'query_builder' => function (DomaineFormationRepository $er) {
                    return $er->createQueryBuilder('f')
                        ->orderBy('f.nom', 'ASC');
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ThematiqueFormation::class,
        ]);
    }
}
