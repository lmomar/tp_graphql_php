<?php

namespace App\Repository;

use App\Entity\Client;
use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function findByFilters($args){
        $qb = $this->createQueryBuilder('o');
        foreach ($args as $key => $val){
            //$qb->select('o.' . $key);
            if($key === 'client'){
                $qb->andWhere('o.client = :client')
                    ->setParameter('client',$args['client']);
            }else {
                $qb->andWhere('o.' . $key . ' LIKE ' . ':' . $key)
                    ->setParameter($key, '%' . $val . '%');
            }
        }
        /*$qb->select(['o.id','o.price','o.created_at']);
        $qb->addSelect(['c.id','c.fullName','c.email','c.login','c.enabled','c.deleted','c.created_at','c.deleted_at']);*/
        $qb->innerJoin(Client::class,'c','WITH','c.id = o.client');
        //$qb->select(['o','c']);
        //dump($qb->getQuery()->getResult());die('dd');
        return $qb->getQuery()->getResult();
    }

    // /**
    //  * @return Order[] Returns an array of Order objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Order
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
