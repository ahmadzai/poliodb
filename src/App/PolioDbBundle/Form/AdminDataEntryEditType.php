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

class AdminDataEntryEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
     public function buildForm(FormBuilderInterface $builder, array $options)
     {

       $builder
      //  ->add('clusterName', TextType::class)
      //  ->add('cluster', EntityType::class, array(
      //    'class' => 'AppPolioDbBundle:AdminData',
      //    'query_builder' => function (EntityRepository $er) {
      //      return $er->createQueryBuilder('u')
      //      ->orderBy('u.cluster', 'ASC');
      //    },
      //    'choice_label' => 'Cluster',
      //    ))
         ->add('cluster', TextType::class)
         ->add('subDistrictName', TextType::class)
         ->add('targetPopulation')
         ->add('receivedVials')
         ->add('usedVials')
         ->add('child011')
         ->add('child1259')
         ->add('regAbsent')
         ->add('vaccAbsent')
         // ->add('missed')
         ->add('regSleep')
         ->add('vaccSleep')
         // ->add('sleep')
         ->add('regRefusal')
         ->add('vaccRefusal')
         // ->add('refusal')
         ->add('newPolioCase')
         ->add('vaccDay', ChoiceType::class, array(
           'choices' => array(
             'VDay1' => 1,
             'VDay2' => 2,
             'VDay3' => 3,
             'VDay5' => 4,
           )
         ))
         // ->add('entryDate', DateTimeType::class, array(
         //     'label'=>'Entry Date',
         //     'widget' => 'single_text',
         //     'format' => 'yyyy-MM-dd',
         //     ))
         ->add('districtCode', 'entity', array(
           'class' => 'AppPolioDbBundle:District',
           'choice_label' => 'districtName',
           'choice_value' => 'districtName',
           'label' => 'District',
           //'placeholder' => 'District'
         ))
         ->add('campaign', 'entity', array(
           'class' => 'AppPolioDbBundle:Campaign',
           'choice_label' => 'CampaignName',
           'choice_value' => 'CampaignName',
           'label' => 'Campaign',
           //'placeholder' => 'Campaign'
         ));



       }

       /**
       * {@inheritdoc}
       */
       public function configureOptions(OptionsResolver $resolver)
       {
         $resolver->setDefaults(array(
           'data_class' => 'App\PolioDbBundle\Entity\AdminData'
         ));
       }

       /**
       * {@inheritdoc}
       */
       public function getBlockPrefix()
       {
         return 'app_poliodbbundle_admindataedit';
       }
     }
