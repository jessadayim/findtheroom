<?php

namespace FTR\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * User_ownerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class User_ownerRepository extends EntityRepository
{
    public function getDataOwner($limit, $offset, $textSearch, &$count, $orderBy){
        $sql = "
            SELECT
              o
            FROM FTRWebBundle:User_owner o
            WHERE o.deleted = 0
        ";
        if (!empty($textSearch) && $textSearch != ''){
            $sql = "
                $sql
                AND o.username LIKE '%$textSearch%'
                OR o.firstname LIKE '%$textSearch%'
            ";

            //นับจำนวนใหม่
            $count = count($this -> getEntityManager() -> createQuery($sql)-> getResult());
        }
        $sql = "
                $sql
                ORDER BY o.$orderBy
            ";
        return $this -> getEntityManager() -> createQuery($sql) -> setFirstResult($offset) -> setMaxResults($limit) -> getResult();
    }
}