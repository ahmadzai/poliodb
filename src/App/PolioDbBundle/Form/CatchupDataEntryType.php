<?php

namespace App\PolioDbBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class CatchupDataEntryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
     public function buildForm(FormBuilderInterface $builder, array $options)
     {

       $builder
         ->add('clusterName')
         ->add('clusterNo', HiddenType::class)
         ->add('subDistrictName', TextType::class)
         ->add('regAbsent')
         ->add('vaccAbsent')
         ->add('regSleep')
         ->add('vaccSleep')
         ->add('regRefusal')
         ->add('vaccRefusal')
         ->add('newMissed')
         ->add('newVaccinated')
         ->add('newRemaining')

         ->add('campaign', 'entity', array(
           'class' => 'AppPolioDbBundle:Campaign',
           'choice_label' => 'CampaignName',
           'choice_value' => 'CampaignName',
           'label' => 'Campaign',
           'placeholder' => 'Campaign'
         ))
         ->add('districtCode', HiddenType::class);

       }

       /**
       * {@inheritdoc}
       */
       public function configureOptions(OptionsResolver $resolver)
       {
         $resolver->setDefaults(array(
           'data_class' => 'App\PolioDbBundle\Entity\CatchupData'
         ));
       }

       /**
       * {@inheritdoc}
       */
       public function getBlockPrefix()
       {
         return 'app_poliodbbundle_catchupdata';
       }


     }
