<?php
namespace App\GraphQL\Mutation;


use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class DeleteClient implements MutationInterface,AliasedInterface
{

    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function deleteClient(int $id)
    {
         $client = $this->em->getRepository(Client::class)->find($id);
         if(is_object($client)){
             $this->em->remove($client);
             $this->em->flush();
             return true;
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
        return ['deleteClient' => 'client_delete'];
    }
}