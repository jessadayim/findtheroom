<?php

namespace FTR\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\QueryException;
/**
 * ZoneRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ZoneRepository extends EntityRepository
{
    /*
     * Get data zone
     */
    public function getDataZone($limit, $offset, $textSearch, &$count, $orderBy){
        $sql = "
            SELECT
              z
            FROM FTRWebBundle:Zone z
            WHERE z.deleted = 0
        ";
        if (!empty($textSearch) && $textSearch != ''){
            $sql = "
                $sql
                AND z.id LIKE '%$textSearch%'
                OR z.zonename LIKE '%$textSearch%'
                OR z.latitude LIKE '%$textSearch%'
                OR z.longitude LIKE '%$textSearch%'
            ";

            //นับจำนวนใหม่
            $count = count($this -> getEntityManager() -> createQuery($sql)-> getResult());
        }
        $sql = "
                $sql
                ORDER BY z.$orderBy
            ";
        return $this -> getEntityManager() -> createQuery($sql) -> setFirstResult($offset) -> setMaxResults($limit) -> getResult();

    }

}