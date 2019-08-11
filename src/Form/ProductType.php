<?php
namespace App\Form;
use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface; 
use Symfony\Component\OptionsResolver\OptionsResolver; 
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
Use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\File;


class ProductType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            
            ->add('productTitle', TextType::class)
           
                    
                
                
                
            
                 
            ->add('productDescription', TextType::class)
                    
            ->add('photoA', FileType::class, 
                    ['label' => 'poza 1',
                      'data_class' => null
                        ])          
            ->add('photoB', FileType::class,
                    ['label' => 'poza 2',
                        'required' => false,
                         'data_class' => null
                        ])
                        
                        
            ->add('photoC', FileType::class, 
                    ['label' => 'poza 3',
                        'required' => false,
                         'data_class' => null
                        
                        ])
            ->add('photoD', FileType::class, 
                    ['label' => 'poza 4',
                        'required' => false,
                         'data_class' => null
                        
                        ])
            ->add('photoE', FileType::class, 
                    ['label' => 'poza 5',
                        'required' => false,
                         'data_class' => null
                        
                        ])
            ->add('photoF', FileType::class,
                    ['label' => 'poza 6',
                        'required' => false,
                         'data_class' => null
                        
                        
                        ])
            ->add('category', ChoiceType::class, [
                    'choices'  => [
                    'autovehicole' =>  'autovehicole',
                    'mobilier' => 'mobilier' ,
                    'electronice' => 'electronice',
                    'altele'=> 'altele'
    ]
                ]);
//             ->add('save', SubmitType::class, 
//                        ['label' => 'adauga produs'
//                            ]);
    
    }
    public function configureOptions(OptionsResolver $resolver)
    {
   
        $resolver->setDefaults([
                
           'data_class' => Product::class,
            
        ]);
    }
}
