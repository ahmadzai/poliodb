<?php

namespace App\PolioDbBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityRepository;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname')
                ->add('lastname')
                ->add('title')
                ->add('joblevel', ChoiceType::class, array('choices' => array('National' => 'National', 'Region' => 'Region', 'Province' => 'Province')))
                ->add('region', EntityType::class, array(
                'class'       => 'AppPolioDbBundle:Province',
                'choice_label' => 'provinceRegion',
                'query_builder' => function (EntityRepository $er) {
                  return $er->createQueryBuilder('u')
                  ->groupBy('u.provinceRegion');
         },

                ))
                //  ->add('region')
                ->add('province')
                ->add('phone');
                ;
                $formModifier = function (FormInterface $form, Province $province = null) {
                  $provinces = null === $province ? array() : $province->getAvailablePositions();

                  $form->add('province', EntityType::class, array(
                    'class'       => 'AppPolioDbBundle:District',
                    'placeholder' => '',
                    'choices'     => $provinces,
            ));
        };


        $builder->addEventListener(
          FormEvents::PRE_SET_DATA,
          function (FormEvent $event) use ($formModifier) {
            // this would be your entity, i.e. SportMeetup
            $data = $event->getData();

            //$formModifier($event->getForm(), $data->getProvinceName());
          }
        );

        $builder->get('region')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $region = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $region);
            }
        );
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
