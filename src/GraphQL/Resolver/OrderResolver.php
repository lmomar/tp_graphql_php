<?php


namespace App\GraphQL\Resolver;


use App\Repository\OrderRepository;
use GraphQL\Type\Definition\ResolveInfo;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class OrderResolver implements ResolverInterface,AliasedInterface
{

    private $repo;

    public function __construct(OrderRepository $repository)
    {
        $this->repo = $repository;
    }

    public function resolve(Int $id)
    {
        return $this->repo->find($id);
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
        return ['resolve' => 'Order'];
    }
}