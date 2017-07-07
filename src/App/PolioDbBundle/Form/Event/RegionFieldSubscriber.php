<?php

/**
 * Created by PhpStorm.
 * User: wakhan
 * Date: 6/27/2017
 * Time: 10:51 AM
 */

namespace App\PolioDbBundle\Form\Event;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\PolioDbBundle\Entity\Province;
use Symfony\Component\PropertyAccess\PropertyAccess;

class RegionFieldSubscriber implements EventSubscriberInterface
{
    private $pathToDistrict;

    public function __construct($pathToDistrict)
    {
        $this-> pathToDistrict = $pathToDistrict;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT => 'preSubmit'
        );
    }

    private function addRegionForm($form, $region = null)
    {
        $formOptions = array(

            'class' => 'AppPolioDbBundle:Province',
            'empty_value' => 'Region',
            'attr' => array(
                'class' => 'multiselect',
            ),
            'query_builder' => function(EntityManager $entityManager) use ($region) {
                $db = $entityManager->createQuery("SELECT DISTINCT r.provinceRegion as RegionValue, r.provinceRegion as RegionLabel FROM AppPolioDbBundle:Province r 
                                                  ORDER BY r.provinceRegion ASC ");
                return $db;
            }
        );

        if($region) {
            $formOptions['data'] = $region;
        }

        $form -> add('RegionValue', 'entity', $formOptions);

    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if($data === null)
            return;

        $accessor = PropertyAccess::createPropertyAccessor();
        $district = $accessor->getValue($data, $this->pathToDistrict);
        $region = ($district) ? $district->getProvinceCode()->getProvinceRegion(): null;

        $this->addRegionForm($form, $region);
    }

    public function preSubmit(FormEvent $event)
    {
        //$data = $event->getData();
        $form = $event->getForm();

        //$region = array_key_exists('provinceRegion', $data) ? $data['provinceRegion'] : null;

        $this->addRegionForm($form);
    }
}