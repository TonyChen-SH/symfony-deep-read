<?php
/**
 * User: Tony Chen
 * Contact me: QQ329037122
 */

class ObjSerialize implements Serializable
{
    private $data;
    public function __construct() {
        $this->data = "My private data";
    }
    public function serialize() {
        return serialize($this->data);
    }
    public function unserialize($data) {
        $this->data = unserialize($data);
    }
    public function getData() {
        return $this->data;
    }
}


$obj = new ObjSerialize;
$ser = serialize($obj);

$newobj = unserialize($ser);

var_dump($newobj->getData());

// 输出结果
// string(15) "My private data"