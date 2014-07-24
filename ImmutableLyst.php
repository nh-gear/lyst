<?php
/**
 * Created by PhpStorm.
 * User: Matthias
 * Date: 23.07.14
 * Time: 17:56
 */

namespace Gear\Lyst;

/**
 * Class ImmutableLyst
 * @package Gear\Lyst
 */
class ImmutableLyst extends Lyst {

    /**
     * slice()
     *
     * Slices the current data with the given arguments and stores the result into a new immutable object.
     *
     * @param $offset
     * @param null $length
     * @param bool $preserveKeys
     * @return ImmutableLyst
     */
    public function slice($offset, $length = null, $preserveKeys = false)
    {
        return $this->immutableParentcall(__FUNCTION__, func_get_args());
    }

    /**
     * splice()
     *
     * forces an parcial replacement to the current set of data and stores the result into a new immutable object.
     *
     * @param $offset
     * @param null $length
     * @param null $replacement
     * @return ImmutableLyst
     */
    public function splice($offset, $length = null, $replacement = null)
    {
        return $this->immutableParentcall(__FUNCTION__, func_get_args());
    }

    /**
     * filter()
     *
     * filters the current data set and stores the result into a new immutable object.
     *
     * @param callable $callback
     * @return ImmutableLyst
     */
    public function filter(callable $callback)
    {
        return $this->immutableParentcall(__FUNCTION__, func_get_args());
    }

    /**
     * filterKeys()
     *
     * filters the keys of this data set and stores the result into a new immutable object.
     *
     * @param callable $callback
     * @return ImmutableLyst
     */
    public function filterKeys(callable $callback)
    {
        return $this->immutableParentcall(__FUNCTION__, func_get_args());
    }

    /**
     * map()
     *
     * maps the current data set on a callback. The result will be stored into a new immutable object.
     *
     * @param callable $callback
     * @param bool $includeKeys
     * @return $this
     */
    public function map(callable $callback, $includeKeys = false)
    {
        return $this->immutableParentcall(__FUNCTION__, func_get_args());
    }

    /**
     * mapKeys()
     *
     * key based mapping of the current data set on a callback. The result will be stored into a new immutable object.
     *
     * @param callable $callback
     * @param bool $includeValues
     * @return ImmutableLyst
     */
    public function mapKeys(callable $callback, $includeValues = false)
    {
        return $this->immutableParentcall(__FUNCTION__, func_get_args());
    }

    /**
     * intersect()
     *
     * intersects the current data set with a given data set and stores the result into a new immutable object.
     *
     * @param $mixed
     * @return ImmutableLyst
     */
    public function intersect($mixed)
    {
        return $this->immutableParentcall(__FUNCTION__, func_get_args());
    }

    /**
     * intersectKeys()
     *
     * key-based intersection of the current data set with a given data set and stores the result into a new immutable object.
     *
     * @param $mixed
     * @return ImmutableLyst
     */
    public function intersectKeys($mixed)
    {
        return $this->immutableParentcall(__FUNCTION__, func_get_args());
    }

    /**
     * pop()
     *
     * wrapped functionality of PHP's array_pop based on this object, results will be stored into a new immutable object.
     *
     * @return mixed
     */
    public function pop()
    {
        return $this->immutableParentcall(__FUNCTION__, func_get_args());
    }

    /**
     * push()
     *
     * wrapped functionality of PHP's array_push based on this object, results will be stored into a new immutable object.
     *
     * @param $value
     * @return $this
     */
    public function push($value)
    {
        return $this->immutableParentcall(__FUNCTION__, func_get_args());
    }

    /**
     * shift()
     *
     * wrapped functionality of PHP's array_shift() based on this object, results will be stored into a new immutable object.
     *
     * @return mixed
     */
    public function shift()
    {
        return $this->immutableParentcall(__FUNCTION__, func_get_args());
    }

    /**
     * unShift()
     *
     * wrapped functionality of PHP's array_unshift() based on this object, results will be stored into a new immutable object.
     *
     * @param $value
     * @return $this
     */
    public function unShift($value)
    {
        return $this->immutableParentcall(__FUNCTION__, func_get_args());
    }

    /**
     * fill()
     *
     * fills an value aggregation into a new immutable object.
     *
     * @param $startIndex
     * @param $length
     * @param $value
     * @return $this
     */
    public function fill($startIndex, $length, $value)
    {
        return $this->immutableParentcall(__FUNCTION__, func_get_args());
    }

    /**
     * valueCombine()
     *
     * sets a given value to each actually existing key of the current data set, results will be stored into a new immutable object.
     *
     * @param $value
     * @return $this
     */
    public function valueCombine($value)
    {
        return $this->immutableParentcall(__FUNCTION__, func_get_args());
    }

    /**
     * combine()
     *
     * wrapped functionality of PHP's array_combine() based on this object, results will be stored into a new immutable object.
     *
     * @param $values
     * @return $this
     * @throws \LogicException
     */
    public function combine($values)
    {
        return $this->immutableParentcall(__FUNCTION__, func_get_args());
    }

    /**
     * column()
     *
     * wrapped functionality of PHP's array_column() based on this object, results will be stored into a new immutable object.
     *
     * @param $column
     * @param null $indexKey
     * @return $this
     */
    public function column($column, $indexKey = null)
    {
        return $this->immutableParentcall(__FUNCTION__, func_get_args());
    }

    /**
     * set()
     *
     * Container aware alias of offsetSet(), results will be stored into a new immutable object.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value)
    {
        return $this->immutableParentcall(__FUNCTION__, func_get_args());
    }

    /**
     * remove()
     *
     * Container aware alias of offsetUnset(), results will be stored into a new immutable object.
     *
     * @param $key
     * @return $this
     */
    public function remove($key)
    {
        return $this->immutableParentcall(__FUNCTION__, func_get_args());
    }

    /**
     * multiSort()
     *
     * wrapped functionality of PHP's array_multisort based on this object, results will be stored into a new immutable object.
     *
     * @return $this
     */
    public function multiSort(/* args */)
    {
        return $this->immutableParentcall(__FUNCTION__, func_get_args());
    }


    /**
     * ::immutableParentCall()
     *
     * calls the parent methods and throws changes of this object into a new instance.
     *
     * @param $method
     * @param array $args
     * @return ImmutableLyst
     */
    private function immutableParentCall($method, array $args)
    {
        $current = $this->getArrayCopy();

        call_user_func_array('parent::'.$method, $args);
        $return = new ImmutableLyst($this->getArrayCopy());
        call_user_func('parent::exchangeArray', $current);

        return $return;
    }

}