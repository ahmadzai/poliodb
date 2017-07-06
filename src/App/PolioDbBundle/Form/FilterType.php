<?php
/**
 * Created by PhpStorm.
 * User: wakhan
 * Date: 6/27/2017
 * Time: 10:34 AM
 */

namespace App\PolioDbBundle\Form;


use App\PolioDbBundle\Form\Event\DistrictFieldSubscriber;
use App\PolioDbBundle\Form\Event\ProvinceFieldSubscriber;
use App\PolioDbBundle\Form\Event\RegionFieldSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $pathToDistrict = 'District';

        $builder -> addEventSubscriber(new DistrictFieldSubscriber($pathToDistrict))
                 -> addEventSubscriber(new ProvinceFieldSubscriber($pathToDistrict))
                 -> addEventSubscriber(new RegionFieldSubscriber($pathToDistrict));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {

    }

}