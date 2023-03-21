<?php

namespace App\Repository;

use App\Entity\BillingPeriod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BillingPeriod>
 *
 * @method BillingPeriod|null find($id, $lockMode = null, $lockVersion = null)
 * @method BillingPeriod|null findOneBy(array $criteria, array $orderBy = null)
 * @method BillingPeriod[]    findAll()
 * @method BillingPeriod[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BillingPeriodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BillingPeriod::class);
    }

    public function save(BillingPeriod $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BillingPeriod $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
