<?php

namespace App\Repository;

use App\Entity\Client;
use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\AbstractQuery;

/**
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    // /**
    //  * @return Client[] Returns an array of Client objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Client
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByFilters($args)
    {
        $qb = $this->createQueryBuilder('c');
        foreach ($args as $key => $value) {
        //dump($key);die('args');
            $qb->andWhere('c.' . $key . ' LIKE :' . $key)
                ->setParameter($key, '%' . $value . '%');
        }
        $qb->select(['c.id','c.fullName','c.email','c.login','c.enabled','c.deleted','c.created_at','c.deleted_at']);
        $qb->addSelect('count(o) as orderCount');
        $qb->leftJoin(Order::class,'o','WITH','o.client = c.id');
        $qb->addGroupBy('c.id');
        /*dump($qb->getQuery()->getSQL());
        die('tt');*/
        //return $qb->getQuery()->getArrayResult();
        return $qb->getQuery()->getScalarResult();
    }
}
