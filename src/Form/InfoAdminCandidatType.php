<?php

namespace App\Form;

use App\Entity\InfoAdminCandidat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfoAdminCandidatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date_create')
            ->add('date_undated')
            ->add('date_deleted')
            ->add('files')
            ->add('candidat')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InfoAdminCandidat::class,
        ]);
    }
}
