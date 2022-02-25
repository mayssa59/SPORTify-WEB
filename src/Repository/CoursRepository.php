<?php

namespace App\Repository;

use Doctrine\DBAL\DBALException;

/**
 * CoursRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CoursRepository extends \Doctrine\ORM\EntityRepository
{

    public function findByIDField($var)
    {
        return $this->createQueryBuilder('u')
            ->where('u.idCours LIKE :title')
            ->setParameter("title","%$var%")
            ->getQuery()
            ->getResult();
    }

}
