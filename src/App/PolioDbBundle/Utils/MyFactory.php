<?php
/**
 * Created by PhpStorm.
 * User: wakhan
 * Date: 11/12/2016
 * Time: 8:28 PM
 */

namespace App\PolioDbBundle\Utils;


use Doctrine\ORM\EntityManager;

class MyFactory
{
    public static function createChart($s)
    {
        $chart = new Charts($s);
        return $chart;
    }

    public static function initSettings($em)
    {
        $settings = new Settings($em);
        return $settings;
    }


}