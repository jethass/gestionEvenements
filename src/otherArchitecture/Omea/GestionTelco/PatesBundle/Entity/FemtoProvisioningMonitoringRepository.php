<?php
namespace Omea\GestionTelco\PatesBundle\Entity;

use Doctrine\ORM\EntityRepository;

class FemtoProvisioningMonitoringRepository extends EntityRepository
{
    /**
     * @param array $actions
     * @param int $limit
     * @return array
     */
    public function getQueueProvisioning(array $actions, $limit = 1)
    {
        $qb = $this->createQueryBuilder('fpm');
        $qb->where('fpm.step = :step')
            ->andWhere('fpm.typeAction IN (:action)')
            ->setParameter('step', FemtoProvisioningMonitoringStep::PENDING)
            ->setParameter('action', $actions)
            ->orderBy('fpm.dateDemande', 'ASC')
            ->setMaxResults($limit);

        return $qb->getQuery()->getResult();
    }

    /**
     * @param string $actions
     * @return array
     */
    public function getLastCallByActions($actions)
    {
        $qb = $this->createQueryBuilder('fpm');
        $qb->select('fpm')
            ->where($qb->expr()->in('fpm.step', ':step'))
            ->andWhere('fpm.typeAction IN (:action)')
            ->orderBy('fpm.sendAt', 'DESC')
            ->setFirstResult(0)
            ->setMaxResults(1)
            ->setParameter('step', array(FemtoProvisioningMonitoringStep::END, FemtoProvisioningMonitoringStep::CALL_GATEWAY))
            ->setParameter('action', $actions)
        ;

        $result = $qb->getQuery()->getResult();

        // Return the fpm object if there is a result
        if (null !== $result) {
            $result = $result[0];
        }

        return $result;
    }
}
