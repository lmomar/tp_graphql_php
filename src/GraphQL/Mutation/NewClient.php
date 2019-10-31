<?php
namespace App\GraphQL\Mutation;

use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class NewClient implements MutationInterface,AliasedInterface
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function addClient(Array $input): Client
    {
        //dump($input);die('trtr');
        $client = new Client();
        $client->setFullName($input['fullName']);
        $client->setEmail($input['email']);
        $client->setLogin($input['login']);
        $this->em->persist($client);
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
        return ['addClient' => 'newClient'];
    }
}