<?php
namespace App\PolioDbBundle\Admin;

use Symfony\Bundle\DoctrineBundle\Registry;

class ProvinceListBuilder {
    /** @var \Symfony\Bundle\DoctrineBundle\Registry */
    private $orm;
    public  function __construct($orm)
    {
        $this->orm = $orm;
    }
    public function getProvinceList()
    {
        $repo = $this->orm->getRepository('AppPolioDbBundle:Province');
        $items = $repo->findAll();
        $ret = array();
        foreach($items as $item)
        {
            $ret[$item->getProvinceCode()] = $item->getProvinceName();
        }
        return $ret;
    }
}
