<?php
namespace App\PolioDbBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class AdminData4Repository extends EntityRepository {
    /***
     * @return array
     */
    public function selectAllAdminData4() {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d FROM AppPolioDbBundle:AdminData4 d"
            )
            ->getResult(Query::HYDRATE_SCALAR);
    }

    public function selectAdminData4ByProvinceDistrict($province, $district) {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT d FROM AppPolioDbBundle:AdminData4 d WHERE d.province = :prov AND d.district = :dist"
            ) ->setParameters(['prov'=>$province, 'dist'=>$district])
            ->getResult(Query::HYDRATE_SCALAR);
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