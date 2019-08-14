<?php

namespace App\Form;

use App\Entity\Licitatie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
Use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LicitatieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('pretLicitat', NumberType::class)
            
             ->add('save', SubmitType::class);
//                        ['label' => 'Liciteaza produs'
//                            ]);
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Licitatie::class,
        ]);
    }
}
