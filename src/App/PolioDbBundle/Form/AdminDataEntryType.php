<?php

namespace App\PolioDbBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminDataEntryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('clusterName')
                ->add('cluster')
                ->add('clusterNo')
                ->add('subDistrictName')
                ->add('targetPopulation')
                ->add('receivedVials')
                ->add('usedVials')
                ->add('child011')
                ->add('child1259')
                ->add('regAbsent')
                ->add('vaccAbsent')
                ->add('missed')
                ->add('regSleep')
                ->add('vaccSleep')
                ->add('sleep')
                ->add('regRefusal')
                ->add('vaccRefusal')
                ->add('refusal')
                ->add('newPolioCase')
                ->add('vaccDay')
                // ->add('entryDate', DateType::class, array(
                //     'label'=>'Entry Date',
                //     'widget' => 'single_text',
                //     'format' => 'yyyy-MM-dd',
                //     ))
                ->add('districtCode', 'entity', array(
                    'class' => 'AppPolioDbBundle:District',
                    'choice_label' => 'districtName',
                    'choice_value' => 'districtName',
                    'label' => 'District',
                    'placeholder' => 'Select District'
                ))
                ->add('campaign', 'entity', array(
                    'class' => 'AppPolioDbBundle:Campaign',
                    'choice_label' => 'CampaignName',
                    'choice_value' => 'CampaignName',
                    'label' => 'Campaign',
                    'placeholder' => 'Select Campaign'
                ));



    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\PolioDbBundle\Entity\AdminData', 'attr' => array(
            'class' => 'form-horizontal row-border'
        )
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_poliodbbundle_admindata';
    }


}
