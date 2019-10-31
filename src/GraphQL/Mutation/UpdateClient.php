<?php


namespace App\GraphQL\Mutation;


use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class UpdateClient implements MutationInterface,AliasedInterface
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function updateClient(Argument $argument)
    {
        $input = $argument->getArrayCopy()['client'];
        $id = $argument->getArrayCopy()['id'];
        $client = $this->em->getRepository(Client::class)->find($id);
        if(!is_object($client)){
            return false;
        }
        foreach ($input as $key => $value){
            call_user_func(array($client,'set' . ucfirst($key)),$value);
        }
        //dump($client);die('tt');
        $this->em->flush();
        return $client;

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
        return ['updateClient' => 'client_update'];
    }
}