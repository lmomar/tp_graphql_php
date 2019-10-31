<?php
namespace App\GraphQL\Mutation;


use App\Entity\Order;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class NewOrder implements MutationInterface, AliasedInterface
{

    private $em;
    private $clRepo;

    public function __construct(EntityManagerInterface $entityManager,ClientRepository $repository)
    {
        $this->em = $entityManager;
        $this->clRepo = $repository;
    }

    public function addOrder(Array $input)
    {
        $client = $this->clRepo->find($input['client']);
        //dump($input);die('tt');
        if(is_object($client)){
            $order = new Order();
            $order->setClient($client);
            $order->setPrice($input['price']);
            $this->em->persist($order);
            $this->em->flush();
            return $order;
        }
        return false;
    }

    /**
     * Returns methods aliases.
     *
     * For instance:
     * array('myMethod' => 'myAlias')
     *
     * @return array
     */
    public static function getAliases(): array
    {
        return ['addOrder' => 'newOrder'];
    }
}