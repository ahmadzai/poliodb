<?php
namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\EntityRepository;

class SubmissionsRepository extends EntityRepository {
    /***
     * @return array
     * The Array should contain three keys:
     * legend: will have legend information
     * xAxis: should have xAxis values
     * yAxis: should have yAxis values
     */
    public function countAllSubmissions() {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT s.form as legend, s.month as xAxis, COUNT(s.id) as yAxis 
                 FROM AppPolioDbBundle:Submissions s GROUP BY s.form, s.month ORDER BY s.date"
            )
            ->getResult();
    }

    public function count2MonthsSubmissions($month1, $month2) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT s.form as legend, s.month as xAxis, COUNT(s.id) as yAxis FROM AppPolioDbBundle:Submissions s 
                 WHERE (s.month = :month1 OR s.month = :month2)
                 GROUP BY s.form, s.month ORDER BY s.date"
            ) ->setParameters(['month1'=>$month1, 'month2'=>$month2])
            ->getResult();
    }

    public function countAllSubmissionsBy($type) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT s.$type as legend, COUNT(s.id) as total FROM AppPolioDbBundle:Submissions s 
                 GROUP BY s.$type"
            ) ->getResult();
    }
}