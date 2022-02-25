<?php


namespace App\Repository;

use Doctrine\DBAL\DBALException;


class AbonnementRepository extends \Doctrine\ORM\EntityRepository
{

    public function findByTypeField($var)
    {
        return $this->createQueryBuilder('u')
            ->where('u.typeAbonnement LIKE :title')
            ->setParameter("title","%$var%")
            ->getQuery()
            ->getResult();
    }

}