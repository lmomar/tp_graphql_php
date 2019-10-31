<?php


namespace App\GraphQL\Resolver;


use App\Repository\OrderRepository;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class OrdersResolver implements ResolverInterface,AliasedInterface
{

    private $repo;

    public function __construct(OrderRepository $repository)
    {
        $this->repo = $repository;
    }

    public function resolve(Argument $args)
    {
        //dump($this->repo->findByFilters($args->getArrayCopy()));die('tt');
        return $this->repo->findByFilters($args->getArrayCopy());
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
        return ['resolve' => 'Orders'];
    }
}