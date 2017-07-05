<?php

namespace App\PolioDbBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DistrictType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

//        $builder->add('id', IntegerType::class, array('label'=>'ID'));
        $builder->add('provinceCode', 'entity', array(
            'class' => 'AppPolioDbBundle:Province',
            'choice_label' => 'provinceName',
            'choice_value' => 'provinceCode',
            'label' => 'Province',
            'placeholder' => 'Select province'
        ));
        $builder->add('districtCode', IntegerType::class, array('label'=>'District Code'));
        $builder->add('districtName', TextType::class, array('label'=>'District Name'))
            ->add('districtNameAlt', TextType::class, array('label'=>'Alternative Name', 'required'=>false))
            ->add('districtNamePashtu', TextType::class, array('label'=>'Pashto Name', 'required'=>false))
            ->add('districtNameDari', TextType::class, array('label'=>'Dari Name', 'required'=>false))
            ->add('districtRiskStatus', ChoiceType::class, array(
                'choices' => array(
                    'Non-HR' => null,
                    'HR' => 'HR',
                    'VHR' => 'VHR'
                ),
                'label' => 'VHR Status'
            ))->add('districtIcnStatus', ChoiceType::class, array(
                    'choices' => array(
                        'Non-ICN' => null,
                        'Full-time' => 'full-time',
                        'Campaign-based' => 'campaign-based'
                    ),
                    'label' => 'ICN Status'
                )
            );

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\PolioDbBundle\Entity\District'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_poliodbbundle_district';
    }


}
