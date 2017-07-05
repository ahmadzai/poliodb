<?php

namespace App\PolioDbBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TablesManagerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('tableName')->add('tableLongName')->add('tableType')->add('source')->add('dashboard')->add('uploadForm')->add('entryForm')->add('downloadForm')->add('dataLevel')->add('sort_no')->add('enabled')->add('entryDate')        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\PolioDbBundle\Entity\TablesManager'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_poliodbbundle_tablesmanager';
    }


}
