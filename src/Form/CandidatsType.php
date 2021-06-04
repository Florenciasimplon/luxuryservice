<?php

namespace App\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Candidats;
use App\Entity\Experience;
use App\Entity\Gender;
use App\Entity\JobCategory;
use PhpParser\Node\Scalar\MagicConst\File;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidatsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('country')
            ->add('cv',FileType::class,[
                'mapped'=>false,
                'required'=>false,
            ])
            ->add('picture',FileType::class,[
                'mapped'=>false,
                'required'=>false,
            ])
            ->add('current_location')
            ->add('adress', TextType::class,[
                'required'=>true,
                'empty_data'=>''
            ])
            ->add('availability')
            ->add('short_description')
            ->add('active')
            ->add('passport',FileType::class,[
                
                'mapped'=> false,
                'required'=> false,
            ])
            ->add('job_candidat', EntityType::class, [
                'class' => JobCategory::class,
                // 'mapped'=>false,
            ])
            ->add('experience', EntityType::class, [
                'class' => Experience::class,
                // 'mapped'=>false,
            ])
            ->add('gender', EntityType::class, [
                'class' => Gender::class,
                // 'mapped'=>false,
            ])
            ->add('nationality')
            ->add('birthdate', DateType::class,[
                'widget' => 'single_text',
                'format'=> 'yyyy-MM-dd'
            ])
            ->add('birthplace')
            ->add('user',UserType::class,[
                'mapped'=> false,
                'required'=> false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Candidats::class,
        ]);
    }
}
