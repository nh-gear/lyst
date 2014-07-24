<?php
/**
 * Created by PhpStorm.
 * User: Matthias
 * Date: 23.07.14
 * Time: 17:55
 */

namespace Gear\Lyst;


interface LystInterface extends \ArrayAccess, \JsonSerializable {
    public function slice($offset, $length = null, $preserveKeys = false);
    public function splice($offset, $length = null, $replacement = null);
    public function implode($delimiter = '');
    public function join($delimiter = '');
    public function filter(callable $callback);
    public function filterKeys(callable $callback);
    public function diff($mixed);
    public function diffKeys($mixed);
    public function map(callable $callback, $includeKeys = false);
    public function mapKeys(callable $callback, $includeValues = false);
    public function intersect($mixed);
    public function intersectKeys($mixed);
    public function pop();
    public function push($value);
    public function shift();
    public function unShift($value);
    public function sum();
    public function fill($startIndex, $length, $value);
    public function valueCombine($value);
    public function combine($values);
    public function column($column, $indexKey = null);

    // container behaviour
    public function get($key, $default = null);
    public function has($key);
    public function set($key, $value);
    public function remove($key);

    // sorting
    public function multiSort(/* args */);

    // actors
    public function call(callable $callback);
    public function callArray(callable $callback);

    // exports
    public function toJSON();
    public function toIterator($iteratorClass = "ArrayIterator");
    public function toQueue($queueClass = "SplQueue");
    public function toStack($stackClass = "SplStack");
    public function immutableCopy();
    public function copy();
    public function toArray();
    public function keys();
    public function find($searchValue, $strict = false);

    public static function create($mixed = array());
    public static function createImmutable($mixed);
} 