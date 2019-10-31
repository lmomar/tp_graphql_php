<?php
namespace App\GraphQL\Type;

use Exception;
use GraphQL\Error\Error;
use GraphQL\Language\AST\Node;
use GraphQL\Type\Definition\ScalarType;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;

class DecimalType extends ScalarType implements AliasedInterface
{

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
        return ['Decimal'];
    }


    /**
     * Serializes an internal value to include in a response.
     *
     * @param mixed $value
     *
     * @return mixed
     *
     * @throws Error
     */
    public function serialize($value)
    {
        return $value;
    }

    /**
     * Parses an externally provided value (query variable) to use as an input
     *
     * In the case of an invalid value this method must throw an Exception
     *
     * @param mixed $value
     *
     * @return mixed
     *
     * @throws Error
     */
    public function parseValue($value)
    {
        // TODO: Implement parseValue() method.
    }

    /**
     * Parses an externally provided literal value (hardcoded in GraphQL query) to use as an input
     *
     * In the case of an invalid node or value this method must throw an Exception
     *
     * @param Node $valueNode
     * @param mixed[]|null $variables
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function parseLiteral($valueNode, ?array $variables = null)
    {
        // TODO: Implement parseLiteral() method.
    }
}