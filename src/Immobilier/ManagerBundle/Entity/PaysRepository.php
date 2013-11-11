<?php

namespace Immobilier\ManagerBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PaysRepository extends EntityRepository
{
    public function findAllOrderedByName($entity)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p.id FROM $entity p ORDER BY p.name ASC'
            )
            ->getResult();
    }
}

?>