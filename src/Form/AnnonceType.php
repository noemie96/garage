<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AnnonceType extends AbstractType
{
    private function getConfiguration($label,$placeholder){
        return [
            'label'=>$label,
            'attr'=> [
            'placeholder'=>$placeholder
            ]
        ];
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brand', TextType::class,[
                'label'=> "Marque",
                'attr' =>[
                    'placeholder'=>'Marque de la voiture de l\'annonce'
                ]
            ])
            ->add('model', TextType::class, $this->getConfiguration('modèle','Le modèle de la voiture'))
            ->add('image',UrlType::class, $this->getConfiguration('image','Url de votre image'))
            ->add('km',NumberType::class, $this->getConfiguration('KM','indiquer le nombre de kilomètre de votre voiture'))
            ->add('price',MoneyType::class, $this->getConfiguration('Prix de la voiture','Donner le prix de la voiture'))
            ->add('numberOfOwners',NumberType::class, $this->getConfiguration('Nombre de propriétaire connu','Indiquer le nombre de propriétaire connu'))
            ->add('displacement',NumberType::class, $this->getConfiguration('Cylindrée','nombre de cylindrée, je sais pas '))
            ->add('power',NumberType::class, $this->getConfiguration('Puissance','Indiquer la puissance du véhicule'))
            ->add('fuel',TextType::class, $this->getConfiguration('Carburant','Quel carburant utilise-t-elle'))
            ->add('circulationYear',DateTimeType::class, $this->getConfiguration('Année de circulation','Année de la mise en circulation'))
            ->add('transmission',TextType::class, $this->getConfiguration('Transmission','Quelle est sa transmission'))
            ->add('description',TextType::class, $this->getConfiguration('Description','Description de la voiture'))
            ->add('othersOption',TextType::class, $this->getConfiguration('Autres options','Options supplèmentaire de la voiture'))
            ->add('slug',TextType::class, $this->getConfiguration('slug','Adress web(automatique)'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
