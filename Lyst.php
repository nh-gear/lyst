<?php
/**
 * Created by PhpStorm.
 * User: Matthias
 * Date: 23.07.14
 * Time: 17:55
 */

namespace Gear\Lyst;

use ArrayObject;

/**
 * Class Lyst
 * @package Gear\Lyst
 */
class Lyst extends ArrayObject implements LystInterface {

    /**
     * Constructor
     * Accepts an Array, ArrayObject Object, ImmutableLyst Object or Lyst Object.
     *
     * @param null|Array|Lyst|ImmutableLyst|ArrayObject $mixed
     * @throws \LogicException
     */
    public function __construct($mixed = null)
    {
        if ( ! is_null($mixed) ) {
            if ( $mixed instanceof ArrayObject ) {
                parent::__construct($mixed->getArrayCopy());
            }
            else if ( is_array($mixed) ) {
                parent::__construct($mixed);
            }
            else {
                throw new \LogicException(
                    'Unknown format given, constructor may only receive an instance of Lyst, '.
                    'ImmutableLyst, ArrayObject or an Array'
                );
            }
        }
    }

    /**
     * slice()
     *
     * Slices the current data with the given arguments and stores the result into this object.
     *
     * @param $offset
     * @param null $length
     * @param bool $preserveKeys
     * @return $this
     */
    public function slice($offset, $length = null, $preserveKeys = false)
    {
        if ( $length === null ) {
            $length = $this->count() - $offset + 1;
        }

        $this->exchangeArray(array_slice($this->getArrayCopy(), $offset, $length, $preserveKeys));

        return $this;
    }

    /**
     * splice()
     *
     * forces an parcial replacement to the current set of data and stores the result into this object.
     *
     * @param $offset
     * @param null $length
     * @param null $replacement
     * @return $this
     */
    public function splice($offset, $length = null, $replacement = null)
    {
        if ( $length === null ) {
            $length = $this->count() - $offset + 1;
        }

        $this->exchangeArray(array_slice($this->getArrayCopy(), $offset, $length, $replacement));

        return $this;
    }

    /**
     * implode()
     *
     * implodes the current data set to a string with the given delimiter.
     *
     * @param string $delimiter
     * @return string
     */
    public function implode($delimiter = '')
    {
        return implode($delimiter, $this->getArrayCopy());
    }

    /**
     * join()
     *
     * For php inter-compatibility: this method is a alias for ::implode().
     *
     * @param string $delimiter
     * @return string
     */
    public function join($delimiter = '')
    {
        return $this->implode($delimiter);
    }

    /**
     * filter()
     *
     * filters the current data set and stores the result into this object.
     *
     * @param callable $callback
     * @return $this
     */
    public function filter(callable $callback)
    {
        $this->exchangeArray(array_filter($this->getArrayCopy(), $callback));

        return $this;
    }

    /**
     * filterKeys()
     *
     * filters the keys of this data set and stores the result into this object.
     *
     * @param callable $callback
     * @return $this
     */
    public function filterKeys(callable $callback)
    {
        $this->exchangeArray(
            array_intersect_key(
                $this->storage,
                array_filter(
                    array_keys($this->getArrayCopy()),
                    $callback
                )
            )
        );

        return $this;
    }

    /**
     * diff()
     *
     * creates a diff represented by an equal instance source of the current data set of a given resource.
     * $mixed can be an array, or any kind of ArrayObject.
     *
     * @param $mixed
     * @return static
     * @throws \LogicException
     */
    public function diff($mixed)
    {
        if ( $mixed instanceof ArrayObject ) {
            $mixed = $mixed->getArrayCopy();
        }

        if ( ! is_array($mixed) ) {
            throw new \LogicException('Unknown format: '.gettype($mixed));
        }

        return new static(array_diff($this->getArrayCopy(), $mixed));
    }

    /**
     * diffKeys()
     *
     * creates a key-based diff represented by an equal instance source of the current data set of a given resource.
     * $mixed can be an array, or any kind of ArrayObject.
     *
     * @param $mixed
     * @return static
     * @throws \LogicException
     */
    public function diffKeys($mixed)
    {
        if ( $mixed instanceof ArrayObject ) {
            $mixed = $mixed->getArrayCopy();
        }

        if ( ! is_array($mixed) ) {
            throw new \LogicException('Unknown format: '.gettype($mixed));
        }

        return new static(
            array_intersect_key(
                $this->storage,
                array_combine(
                    array_diff(
                        array_keys($this->getArrayCopy()),
                        array_values($mixed)
                    ),
                    array_diff(
                        array_keys($this->getArrayCopy()),
                        array_values($mixed)
                    )
                )
            )
        );
    }

    /**
     * map()
     *
     * maps the current data set on a callback. The result will be stored into the current object.
     *
     * @param callable $callback
     * @param bool $includeKeys
     * @return $this
     */
    public function map(callable $callback, $includeKeys = false)
    {
        if ( $includeKeys ) {
            $this->exchangeArray(array_map($callback, $this->getArrayCopy(), array_keys($this->getArrayCopy())));
        }
        else {
            $this->exchangeArray(array_map($callback, $this->getArrayCopy()));
        }

        return $this;
    }

    /**
     * mapKeys()
     *
     * key based mapping of the current data set on a callback. The result will be stored into the current object.
     *
     * @param callable $callback
     * @param bool $includeValues
     * @return $this
     */
    public function mapKeys(callable $callback, $includeValues = false)
    {
        $keys = array_keys($this->getArrayCopy());
        if ( $includeValues ) {
            $renamedKeys = array_map($callback, $keys, array_values($this->getArrayCopy()));
        }
        else {
            $renamedKeys = array_map($callback, $keys);
        }
        $this->exchangeArray(array_combine($renamedKeys, $this->getArrayCopy()));

        return $this;
    }

    /**
     * intersect()
     *
     * intersects the current data set with a given data set and stores the result into the current object.
     *
     * @param $mixed
     * @throws \LogicException
     */
    public function intersect($mixed)
    {
        if ( $mixed instanceof ArrayObject ) {
            $mixed = $mixed->getArrayCopy();
        }

        if ( ! is_array($mixed) ) {
            throw new \LogicException('Unknown format: '.gettype($mixed));
        }

        $this->exchangeArray(array_intersect($this->getArrayCopy(), $mixed));
    }

    /**
     * intersectKeys()
     *
     * key-based intersection of the current data set with a given data set and stores the result into the current object.
     *
     * @param $mixed
     * @throws \LogicException
     */
    public function intersectKeys($mixed)
    {
        if ( $mixed instanceof ArrayObject ) {
            $mixed = $mixed->getArrayCopy();
        }

        if ( ! is_array($mixed) ) {
            throw new \LogicException('Unknown format: '.gettype($mixed));
        }

        $this->exchangeArray(array_intersect_key($this->getArrayCopy(), $mixed));
    }

    /**
     * pop()
     *
     * wrapped functionality of PHP's array_pop based on this object.
     *
     * @return mixed
     */
    public function pop()
    {
        $array = $this->getArrayCopy();
        $return = array_pop($array);
        $this->exchangeArray($array);
        return $return;
    }

    /**
     * push()
     *
     * wrapped functionality of PHP's array_push based on this object.
     *
     * @param $value
     * @return $this
     */
    public function push($value)
    {
        $array = $this->getArrayCopy();
        array_pop($value);
        $this->exchangeArray($array);
        return $this;
    }

    /**
     * shift()
     *
     * wrapped functionality of PHP's array_shift() based on this object.
     *
     * @return mixed
     */
    public function shift()
    {
        $array = $this->getArrayCopy();
        $return = array_shift($array);
        $this->exchangeArray($array);
        return $return;
    }

    /**
     * unShift()
     *
     * wrapped functionality of PHP's array_unshift() based on this object.
     *
     * @param $value
     * @return $this
     */
    public function unShift($value)
    {
        $array = $this->getArrayCopy();
        array_unshift($array, $value);
        $this->exchangeArray($array);
        return $this;
    }

    /**
     * sum()
     *
     * wrapped functionality of PHP's array_sum() based on this object.
     *
     * @return number
     */
    public function sum()
    {
        return array_sum($this->getArrayCopy());
    }

    /**
     * fill()
     *
     * fills an value aggregation into this object. previously engaged data will be replaced.
     *
     * @param $startIndex
     * @param $length
     * @param $value
     * @return $this
     */
    public function fill($startIndex, $length, $value)
    {
        $array = array_fill($startIndex, $length, $value);
        $this->exchangeArray($array);
        return $this;
    }

    /**
     * valueCombine()
     *
     * sets a given value to each actually existing key of the current data set. previously engaged values are overwritten.
     *
     * @param $value
     * @return $this
     */
    public function valueCombine($value)
    {
        $keys = array_values($this->getArrayCopy());
        $values = array_fill(0, count($keys), $value);
        $this->exchangeArray(array_combine($keys, $values));
        return $this;
    }

    /**
     * combine()
     *
     * wrapped functionality of PHP's array_combine() based on this object.
     *
     * @param $values
     * @return $this
     * @throws \LogicException
     */
    public function combine($values)
    {
        if ( $values instanceof ArrayObject ) {
            $values = $values->getArrayCopy();
        }

        if ( ! is_array($values) ) {
            throw new \LogicException('Unknown format: '.gettype($values));
        }

        $this->exchangeArray(array_combine($this->storage, $values));
        return $this;
    }

    /**
     * column()
     *
     * wrapped functionality of PHP's array_column() based on this object.
     *
     * @param $column
     * @param null $indexKey
     * @return $this
     */
    public function column($column, $indexKey = null)
    {
        $this->exchangeArray(array_column($this->getArrayCopy(), $column, $indexKey));
        return $this;
    }

    /**
     * get()
     *
     * Container aware alias for offsetGet(), if the called key was not found $default's value will be returned.
     *
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        if ( ! $this->offsetExists($key) ) {
            return $default;
        }

        return $this->offsetGet($key);
    }

    /**
     * has()
     *
     * Container aware alias of offsetExists().
     *
     * @param $key
     * @return bool
     */
    public function has($key)
    {
        return $this->offsetExists($key);
    }

    /**
     * set()
     *
     * Container aware alias of offsetSet().
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value)
    {
        $this->offsetSet($key, $value);
        return $this;
    }

    /**
     * remove()
     *
     * Container aware alias of offsetUnset().
     *
     * @param $key
     * @return $this
     */
    public function remove($key)
    {
        $this->offsetUnset($key);
        return $this;
    }

    /**
     * multiSort()
     *
     * wrapped functionality of PHP's array_multisort based on this object.
     *
     * @return $this
     */
    public function multiSort(/* args */)
    {
        $array = $this->getArrayCopy();
        array_multisort($array, func_get_args());
        $this->exchangeArray($array);
        return $this;
    }

    /**
     * call()
     *
     * calls a given callback with a array copy of the entire data set as the first parameter.
     *
     * @param callable $callback
     * @return mixed
     */
    public function call(callable $callback)
    {
        return call_user_func($callback, $this->getArrayCopy());
    }

    /**
     * callArray()
     *
     * calls a given callback with a array copy of the entire data set as parameters (variadic call).
     * @param callable $callback
     * @return mixed
     */
    public function callArray(callable $callback)
    {
        return call_user_func_array($callback, $this->getArrayCopy());
    }

    /**
     * toJSON()
     *
     * wrapped functionality of PHP's json_encode() based on the data set of this object.
     *
     * @param int $options
     * @param int $depth
     * @return string
     */
    public function toJSON($options = 0, $depth = 512)
    {
        return json_encode($this->getArrayCopy(), $options, $depth);
    }

    /**
     * toIterator()
     *
     * creates an instance of a given iterator class with a array copy of the current data set as the first
     * constructor parameter.
     *
     * Note: Iterator classes must implement the ArrayIterator interface of PHP.
     *
     * @param string $iteratorClass
     * @return object
     * @throws \LogicException
     */
    public function toIterator($iteratorClass = "ArrayIterator")
    {
        $reflection = new \ReflectionClass($iteratorClass);

        if ( ! $reflection->implementsInterface('Iterator') ) {
            throw new \LogicException('Target class must implement iterator interface');
        }

        return $reflection->newInstance($this->getArrayCopy());
    }

    /**
     * toQueue()
     *
     * creates an instance of a given queue class with a array copy of the current data set as its content. Keys will be
     * naturally ignored by queues, only values are enqueued to the queue.
     *
     * Note: Queue classes must be a subclass of PHP's SplQueue class.
     *
     * @param string $queueClass
     * @return object
     * @throws \LogicException
     */
    public function toQueue($queueClass = "SplQueue")
    {
        $reflection = new \ReflectionClass($queueClass);

        if ( ! $reflection->isSubclassOf('SplQueue') ) {
            throw new \LogicException('Target class must be a subclass of SplQueue');
        }

        $instance = $reflection->newInstance();
        array_map(array($instance,'enqueue'), $this->getArrayCopy());
        return $instance;
    }

    /**
     * toStack()
     *
     * creates an instance of a given stack class with a array copy of the current data set as its content. Keys will be
     * naturally ignored by stacks, only values are added to the stack.
     *
     * Note: Stack classes must be a subclass of PHP's SplStack class.
     *
     * @param string $stackClass
     * @return object
     * @throws \LogicException
     */
    public function toStack($stackClass = "SplStack")
    {
        $reflection = new \ReflectionClass($stackClass);

        if ( ! $reflection->isSubclassOf('SplStack') ) {
            throw new \LogicException('Target class must be a subclass of SplStack');
        }

        $instance = $reflection->newInstance();
        array_map(array($instance, 'add'), array_keys($this->getArrayCopy()), $this->getArrayCopy());
        return $instance;
    }

    /**
     * immutableCopy()
     *
     * creates an ImmutableLyst instance filled with the actual data set.
     *
     * @return ImmutableLyst
     */
    public function immutableCopy()
    {
        return new ImmutableLyst($this);
    }

    /**
     * copy()
     *
     * creates an Lyst instance filled with the actual data set.
     *
     * @return Lyst
     */
    public function copy()
    {
        return new Lyst($this);
    }

    /**
     * toArray()
     *
     * returns a array copy of the actual data set.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->getArrayCopy();
    }

    /**
     * keys()
     *
     * returns an array filled with the keys of the actual data set.
     *
     * @return array
     */
    public function keys()
    {
        return array_keys($this->getArrayCopy());
    }


    /**
     * find()
     *
     * returns an array limited to the content of $searchValue with the keys of the described part of the actual data set.
     * $searchValue can be an array, integer or string and will be used to search along all keys.
     *
     * @param $searchValue
     * @param bool $strict
     * @return array
     */
    public function find($searchValue, $strict = false)
    {
        return array_keys($this->getArrayCopy(), $searchValue, (bool) $strict);
    }

    /**
     * jsonSerialize()
     *
     * Implementation of PHP's jsonSerialize Interface
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->getArrayCopy();
    }

    /**
     * ::create() - static
     *
     * factory method.
     *
     * @param $mixed
     * @return static
     */
    public static function create($mixed = array())
    {
        return new static($mixed);
    }

    /**
     * ::createImmutable() - static
     *
     * factory method for immutable lysts.
     *
     * @param $mixed
     * @return ImmutableLyst
     */
    public static function createImmutable($mixed)
    {
        return new ImmutableLyst($mixed);
    }

}