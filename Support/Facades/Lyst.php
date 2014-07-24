<?php
/**
 * Created by PhpStorm.
 * User: Matthias
 * Date: 23.07.14
 * Time: 17:59
 */

namespace Gear\Lyst\Support\Facades;

use ArrayObject;
use \Gear\Lyst\Lyst as LystObject;
use \Gear\Lyst\ImmutableLyst as ImmutableLystObject;

/**
 * Class Lyst
 * @package Gear\Lyst\Support\Facades
 *
 * @method static LystObject slice($arrayOrArrayObject, $offset, $length = null, $preserveKeys = false)
 * @method static LystObject splice($arrayOrArrayObject, $offset, $length = null, $preserveKeys = false)
 * @method static string implode($arrayOrArrayObject, $delimiter = '')
 * @method static string join($arrayOrArrayObject, $delimiter = '')
 * @method static LystObject filter($arrayOrArrayObject, callable $callback)
 * @method static LystObject filterKeys($arrayOrArrayObject, callable $callback)
 * @method static LystObject diff($arrayOrArrayObject, $mixed)
 * @method static LystObject diffKeys($arrayOrArrayObject, $mixed)
 * @method static LystObject map($arrayOrArrayObject, callable $callback, $includeKeys = false)
 * @method static LystObject mapKeys($arrayOrArrayObject, callable $callback, $includeValues = false)
 * @method static LystObject intersect($arrayOrArrayObject, $mixed)
 * @method static LystObject intersectKeys($arrayOrArrayObject, $mixed)
 * @method static LystObject pop($arrayOrArrayObject)
 * @method static LystObject push($arrayOrArrayObject, $value)
 * @method static LystObject shift($arrayOrArrayObject)
 * @method static LystObject unShift($arrayOrArrayObject, $value)
 * @method static LystObject sum($arrayOrArrayObject)
 * @method static LystObject fill($arrayOrArrayObject, $startIndex, $length, $value)
 * @method static LystObject valueCombine($arrayOrArrayObject, $value)
 * @method static LystObject combine($arrayOrArrayObject, $values)
 * @method static LystObject column($arrayOrArrayObject, $column, $indexKey = null)
 *
 * @method static mixed get($arrayOrArrayObject, $key, $default = null)
 * @method static bool has($arrayOrArrayObject, $key)
 * @method static LystObject set($arrayOrArrayObject, $key, $value)
 * @method static LystObject remove($arrayOrArrayObject, $key)
 *
 * @method static LystObject multiSort($arrayOrArrayObject)
 *
 * @method static mixed call($arrayOrArrayObject, callable $callback)
 * @method static mixed callArray($arrayOrArrayObject, callable $callback)
 *
 * @method static string toJSON($arrayOrArrayObject)
 * @method static \Iterator toIterator($arrayOrArrayObject, $iteratorClass = "ArrayIterator")
 * @method static \SplQueue toQueue($arrayOrArrayObject, $queueClass = "SplQueue")
 * @method static \SplStack toStack($arrayOrArrayObject, $stackClass = "SplStack")
 * @method static ImmutableLystObject immutableCopy($arrayOrArrayObject)
 * @method static LystObject copy($arrayOrArrayObject)
 * @method static array toArray($arrayOrArrayObject)
 * @method static array keys($arrayOrArrayObject)
 * @method static array find($arrayOrArrayObject, $searchValue, $strict = false)
 *
 * @method static null append($arrayOrArrayObject, $value)
 * @method static null aSort($arrayOrArrayObject)
 * @method static null count($arrayOrArrayObject)
 * @method static array exchangeArray($arrayOrArrayObject, $input)
 * @method static array getArrayCopy($arrayOrArrayObject)
 * @method static int getFlags($arrayOrArrayObject)
 * @method static \ArrayIterator getIterator($arrayOrArrayObject)
 * @method static string getIteratorClass($arrayOrArrayObject)
 * @method static null kSort($arrayOrArrayObject)
 * @method static null natSort($arrayOrArrayObject)
 * @method static null natCaseSort($arrayOrArrayObject)
 * @method static bool offsetExists($arrayOrArrayObject, $index)
 * @method static mixed offsetGet($arrayOrArrayObject, $index)
 * @method static null offsetSet($arrayOrArrayObject, $index, $value)
 * @method static null offsetUnset($arrayOrArrayObject, $index)
 * @method static string serialize($arrayOrArrayObject)
 * @method static null setFlags($arrayOrArrayObject, int $flags)
 * @method static null setIteratorClass($arrayOrArrayObject, string $iterator_class)
 * @method static null uaSort($arrayOrArrayObject, callable $cmp_function)
 * @method static null ukSort($arrayOrArrayObject, callable $cmp_function)
 * @method static null unSerialize($arrayOrArrayObject, $serialized)
 */
final class Lyst {

    /**
     * @param $method
     * @param array $args
     * @return mixed
     * @throws \LogicException
     */
    public static function __callStatic($method, array $args)
    {
        if ( ! is_array($args[0]) && ! $args[0] instanceof ArrayObject ) {
            throw new \LogicException(
                'First argument must be an array or ArrayObject'
            );
        }

        $lyst = new LystObject(
            is_array($args[0])
                ? $args[0]
                : $args[0]->getArrayCopy()
        );

        if ( method_exists($lyst, $method) ) {
            return call_user_func_array(array($lyst, $method), array_slice($args, 1));
        }

        throw new \LogicException('Unknown method: '.$method);
    }

    /**
     * @param array|ArrayObject $mixed
     * @return ImmutableLystObject|LystObject
     */
    public static function create($mixed = array())
    {
        return LystObject::create($mixed);
    }

    /**
     * @param $mixed
     * @return static
     */
    public static function createImmutable($mixed)
    {
        return ImmutableLystObject::create($mixed);
    }
} 