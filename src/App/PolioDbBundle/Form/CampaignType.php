<?php

namespace App\PolioDbBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CampaignType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('campaignName', TextType::class, array('label'=>'Campaign Name'))
                ->add('campaignType', ChoiceType::class, array(
                    'choices' => array(
                        'NID' => 'NID',
                        'SNID' => 'SNID',
                        'LPD' => 'LPD',
                        'SR' => 'SR'
                    ),
                    'placeholder' => 'Select Campaign Type',
                    'label' => 'Campaign Type'
                ))
                ->add('campaignStartDate', DateType::class, array(
                    'label'=>'Campaign Start Date',
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                    ))
                ->add('campaignEndDate', DateType::class, array(
                    'label'=>'Campaign End Date',
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                ))
                ->add('campaignId', IntegerType::class, array('label'=> 'CampaignID'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\PolioDbBundle\Entity\Campaign'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_poliodbbundle_campaign';
    }


}
