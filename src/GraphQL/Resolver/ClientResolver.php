<?php
namespace App\GraphQL\Resolver;

use App\Repository\ClientRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

class ClientResolver implements ResolverInterface,AliasedInterface
{
    private $repo;

    public function __construct(ClientRepository $repository)
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
        return ['resolve' => 'Client'];
    }
}