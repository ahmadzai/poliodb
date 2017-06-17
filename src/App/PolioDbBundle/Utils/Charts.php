<?php
namespace App\PolioDbBundle\Utils;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;

/**
 * Created by PhpStorm.
 * User: wakhan
 * Date: 11/12/2016
 * Time: 6:44 PM
 */

class Charts
{


    protected $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param $entity Entity Class Name (within the current bundle)
     * @param $function function in that entity
     * @param $parameters parameters for that function
     * @return mixed
     */
    public function chartData($entity, $function, $parameters) {
        $data = $this->em->getRepository('AppPolioDbBundle:'.$entity)
            ->callMe($function, $parameters);
        return $data;
    }

    /***
     * @param $months array of months
     * @return order_months
     */
    function orderMonths($months) {
        $order_months = array();
        if(is_array($months) && count($months) > 0) {
            $temp = array();
            foreach($months as $month) {
                $m = date_parse($month);
                $temp[$m['month']] = $month;
            }
            ksort($temp);
            $order_months = $temp;
        }

        return $order_months;
    }

    /***
     * @param $cat1 top level category string name, where together with d_ it should be a column name
     * @param $cat2 second level category
     * @param $indicators string array indicators
     * @param $data
     * @return $r_data  formated array
     */
    function chartData2Categories($cat1, $cat2, $indicators, $data) {

        if(count($data) > 0) {
            $tmp_top_cat = array();
            $tmp_second_cat = array();
            foreach($data as $temp_d) {
                $tmp_top_cat[] = $temp_d[$cat1];
                $tmp_second_cat[] = $temp_d[$cat2];
            }

            $top_cat = array_unique($tmp_top_cat);
            $second_cat = array_unique($tmp_second_cat);
            $second_cat = sort($second_cat);
            if($cat2 == 'd_cMonth' || $cat2 == 'd_month' || $cat2 == 'CMonth')
                $second_cat = $this->orderMonths($tmp_second_cat);

            $r_data = array();
            //$cat = array();
            $data_indicators = array();
            $temp_cat = array();
            foreach ($top_cat as $t_c) {
                $sub_cat = array();
                foreach ($second_cat as $s_c) {
                    //$sub_cat = array();
                    foreach ($data as $val) {
                        if ($val[$cat1] === $t_c && $val[$cat2] === $s_c) {
                            $sub_cat[] = $s_c;
                            foreach($indicators as $indicator) {
                                $data_indicators[$indicator][] = $val[$indicator] == 'null' ? null : (int)$val[$indicator];
                            }

                        }

                    }
                }
                $temp_cat[] = array('name' => $t_c, 'categories' => $sub_cat);
            }
            //$cat['categories'] = $temp_cat;
            $r_data['categories'] = $temp_cat;
//            $data['series'] = array(array('name'=>'Refusal', 'data' => $refusal),
//                array('name'=>'Sleep_NewBorn', 'data'=>$sleep),
//                array('name'=>'Missed', 'data' => $remaining));
            $ser = array();
            foreach ($indicators as $key=>$ind) {
                $ser[] = array('name'=>ucfirst($key), 'data' => $data_indicators[$ind]);
            }

            $r_data['series'] = $ser;

            return $r_data;
        }

        else
            return ['data'=>null];
    }

    /***
 * @param $cat1 top level category string name, where together with d_ it should be a column name
 * @param $indicators string array indicators
 * @param $data
 * @return $r_data  formated array
 */
    function chartData1Category($cat1, $indicators, $data) {

        if(count($data) > 0) {
            $tmp_top_cat = array();
            foreach($data as $temp_d) {
                $tmp_top_cat[] = $temp_d[$cat1];
            }

            $top_cat = array_unique($tmp_top_cat);

            $r_data = array();
            //$cat = array();
            $data_indicators = array();
            $temp_cat = array();
            foreach ($top_cat as $t_c) {


                //$sub_cat = array();
                foreach ($data as $val) {
                    if ($val[$cat1] === $t_c) {

                        foreach($indicators as $indicator) {
                            $data_indicators[$indicator][] = $val[$indicator] == 'null' ? null : (int)$val[$indicator];
                        }

                    }

                }

                $temp_cat[] = $t_c;
            }
            //$cat['categories'] = $temp_cat;
            $r_data['categories'] = $temp_cat;
            $ser = array();
            foreach ($indicators as $key=>$ind) {
                $ser[] = array('name'=>ucfirst($key), 'data' => $data_indicators[$ind]);
            }

            $r_data['series'] = $ser;

            return $r_data;
        }

        else
            return ['data'=>null];
    }


    /***
     * @param $cat1 top level category string name, where together with d_ it should be a column name
     * @param $indicator string array indicators
     * @param $data
     * @return $r_data  formated array
     */
    function pieData1Category($cat1, $indicator, $substitute, $data) {

        if(count($data) > 0) {
            $tmp_top_cat = array();
            foreach($data as $temp_d) {
                $tmp_top_cat[] = $temp_d[$cat1];
            }

            $top_cat = array_unique($tmp_top_cat);

            $r_data = array();
            $data_indicators = array();
            foreach ($top_cat as $t_c) {


                //$sub_cat = array();
                foreach ($data as $val) {
                    if ($val[$cat1] === $t_c) {

                        //foreach($indicators as $indicator) {
                            $data_indicators[] = array('name'=>$t_c, 'y'=>$val[$indicator] == 'null' ? null : (int)$val[$indicator]);
                        //}

                    }

                }

                //$temp_cat[] = $t_c;
            }
            //$cat['categories'] = $temp_cat;
            //$r_data['categories'] = $temp_cat;
            $ser[] = array('type'=>'pie', 'name'=>ucfirst($substitute), 'data' => $data_indicators);

            $r_data['series'] = $ser;

            return $r_data;
        }

        else
            return ['data'=>null];
    }



}