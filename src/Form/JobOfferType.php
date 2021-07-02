<?php

namespace App\Form;

use App\Entity\Clients;
use App\Entity\JobOffer;
use App\Entity\JobTypes;
use App\Entity\JobCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobOfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', TextType::class,[
                'required' => false,
                'empty_data' => '',
            ])
            ->add('note', TextType::class,[
                'required' => false,
                'empty_data' => '',
            ])
            ->add('title', TextType::class,[
                'required' => false,
                'empty_data' => '',
            ])
            ->add('location', TextType::class,[
                'required' => false,
                'empty_data' => '',
            ])
            ->add('closing_date', DateType::class, [
                'required'=>false,
                'widget'=> 'single_text',
                //this is actually the default format for single_text
                'format'=>'yyyy-MM-dd',
            ])
            ->add('salary')
            
            ->add('client', EntityType::class, [
                'class'=> Clients::class,
            ])
            ->add('job_category', EntityType::class, [
                'class'=> JobCategory::class,
            ])
            ->add('job_type', EntityType::class, [
                'class'=> JobTypes::class,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => JobOffer::class,
        ]);
    }
}
