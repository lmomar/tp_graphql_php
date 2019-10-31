<?php
namespace App\GraphQL\Resolver;

use App\Repository\ClientRepository;
use GraphQL\Type\Definition\ResolveInfo;
use Overblog\GraphQLBundle\Annotation\Arg;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class ClientsResolver implements ResolverInterface,AliasedInterface
{
    private $repo;

    public function __construct(ClientRepository $repository)
    {
        $this->repo = $repository;
    }

    public function resolve(Argument $args)
    {
        //var_dump($this->repo->findByFilters($args->getArrayCopy()));die('s');
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
        return ['resolve' => 'Clients'];
    }
}