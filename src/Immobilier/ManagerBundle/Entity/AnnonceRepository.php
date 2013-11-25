<?php

namespace Immobilier\ManagerBundle\Entity;

use Doctrine\ORM\EntityRepository;

class AnnonceRepository extends EntityRepository
{
    public function findAllOrderedByName($entity)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p.id FROM '.$entity.' p ORDER BY p.name ASC'
            )
            ->getResult();
    }

    public function filterAnnonces( $critere = array())
    {
        $query = "SELECT * FROM ImmobilierManagerBundle:Annonce a ";
        $cond = "WHERE 1=1 ";
        if(isset($critere['idLocalite']) && $critere['idLocalite'] !='' )
            $cond .= " AND 'idLocalite' = '".$critere['idLocalite']."'";
        elseif(isset($critere['idDelegation']) && $critere['idDelegation'] !='' )
            $cond .= " AND 'idDelegation' = '".$critere['idDelegation']."'";
        elseif(isset($critere['idGouvernorat']) && $critere['idGouvernorat'] !='' )
            $cond .= " AND 'idGouvernorat' = '".$critere['idGouvernorat']."'";
        elseif(isset($critere['idPays']) && $critere['idPays'] !='' )
            $cond .= " AND 'idPays' = '".$critere['idPays']."'";
        if(isset($critere['minArea']) && $critere['maxArea'] !='' )
            $cond .= " AND ('area' BETWEEN '".$critere['minArea']."' AND '".$critere['maxArea']."')";
        if(isset($critere['minPrice']) && $critere['maxPrice'] !='' )
            $cond .= " AND ('prix' BETWEEN '".$critere['minPice']."' AND '".$critere['maxPrice']."')";
        if(isset($critere['idType']) && $critere['idType'] !='' )
            $cond .= " AND 'idType' = '".$critere['minPice']."'";
        elseif(isset($critere['idNature']) && $critere['idNature'] !='' )
            $cond .= " AND 'idNature' = '".$critere['minNature']."'";
        elseif(isset($critere['idRubrique']) && $critere['idRubrique'] !='' )
            $cond .= " AND 'idRubrique' = '".$critere['idRubrique']."'";

        $query .= $cond;
        $query = $this->getEntityManager()
            ->createQuery($query);

        try {
            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
}

?>