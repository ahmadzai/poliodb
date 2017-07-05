<?php

/**
 * Created by PhpStorm.
 * User: wakhan
 * Date: 6/27/2017
 * Time: 10:51 AM
 */

namespace App\PolioDbBundle\Form\Event;


use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\PolioDbBundle\Entity\District;
use Symfony\Component\PropertyAccess\PropertyAccess;

class DistrictFieldSubscriber implements EventSubscriberInterface
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

    private function addDistrictForm($form, $province_id)
    {
        $formOptions = array(

            'class' => 'AppPolioDbBundle:District',
            'empty_value' => 'District',
            'attr' => array(
                'class' => 'multiselect',
            ),
            'query_builder' => function(EntityRepository $entityRepository) use ($province_id) {
                $db = $entityRepository->createQueryBuilder('district')
                    ->innerJoin('district.provinceCode', 'province')
                    ->where('province.provinceCode = :province')
                    ->setParameter('province', $province_id);
                return $db;
            }
        );

        $form -> add($this->pathToDistrict, 'entity', $formOptions);

    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if($data === null)
            return;

        $accessor = PropertyAccess::createPropertyAccessor();
        $district = $accessor->getValue($data, $this->pathToDistrict);
        $province_id = ($district) ? $district->getProvinceCode()->getProvinceCode(): null;

        $this->addDistrictForm($form, $province_id);
    }

    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        $province_id = array_key_exists('provinceCode', $data) ? $data['provinceCode'] : null;

        $this->addDistrictForm($form, $province_id);
    }
}