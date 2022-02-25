<?php


namespace App\Repository;


class EvennementRepository  extends \Doctrine\ORM\EntityRepository
{
    public function findByTypeField($var)
    {
        return $this->createQueryBuilder('u')
            ->where('u.nomEvennement LIKE :title')
            ->setParameter("title","%$var%")
            ->getQuery()
            ->getResult();
    }
}