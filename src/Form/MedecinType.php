<?php

namespace App\Form;

use App\Entity\Medecin;
use App\Entity\Service;
use App\Entity\Specialite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use App\Repository\ServiceRepository;
use App\Repository\SpecialiteRepository;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedecinType extends AbstractType
{
    private $serviceRepo;
    private $speRepo; 

public function __construct(ServiceRepository $serviceRepo, SpecialiteRepository $speRepo)
{
 $this->serviceRepo = $serviceRepo;  
 $this->speRepo = $speRepo; 
}

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('telephone',NumberType::class,[])
            ->add('service',EntityType::class,[
                'class' => Service::class,
                'choices' => $this->serviceRepo->findAll()
            ])
            ->add('specialite', EntityType::class,[
                'class' => Specialite::class,
                'choices' => $this->speRepo->findAll(),
                'multiple' => true,
                'by_reference' => false
            ])
            ->getForm()  
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Medecin::class,
        ]);
    }
}
