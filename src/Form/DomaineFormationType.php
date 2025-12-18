<?php

namespace App\Form;

use App\Entity\DomaineFormation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DomaineFormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom du domaine de formation <span class="text-danger">*</span>',
                'label_html' => true
            ])
            ->add('description', TextType::class, [
                'label' => "Description du domaine de formation <span class='text-danger'>*</span>",
                'label_html' => true,
                'required' => false,
                'attr' => [
                    'rows' => 5,
                    'class' => 'tinymce'
                ]
            ])
            ->add('couleur', ColorType::class, [
                'label' => 'Couleur associée <span class="text-danger">*</span>',
                'label_html' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DomaineFormation::class,
        ]);
    }
}
