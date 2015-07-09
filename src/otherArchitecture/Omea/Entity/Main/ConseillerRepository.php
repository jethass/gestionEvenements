<?php
namespace Omea\Entity\Main;

use Doctrine\ORM\EntityRepository;

class ConseillerRepository extends EntityRepository
{

    public function getValidConseiller($conseillerId)
    {
        return $this->findOneBy(array(
            'id' => $conseillerId,
            'actif' => true,
            'deleted' => false
        ));
    }
}
