<?php
/**
 * User: Tony Chen
 * Contact me: QQ329037122
 */

class ObjArray implements ArrayAccess
{
    private $container = [];

    public function __construct()
    {
        $this->container = [
            'one'   => 1,
            'two'   => 2,
            'three' => 3,
        ];
    }

    public function offsetSet($offset, $value)
    {
        if (null === $offset)
        {
            $this->container[] = $value;
        } else
        {
            $this->container[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }
}

$obj = new ObjArray();

var_dump(isset($obj["two"]));
var_dump($obj["two"]);
unset($obj["two"]);
var_dump(isset($obj["two"]));
$obj["two"] = "A value";
var_dump($obj["two"]);
$obj[] = 'Append 1';
$obj[] = 'Append 2';
$obj[] = 'Append 3';
print_r($obj);