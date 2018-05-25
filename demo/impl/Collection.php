<?php
/**
 * User: Tony Chen
 * Contact me: QQ329037122
 */

class Collection implements IteratorAggregate
{
    private $array = [];
    const TYPE_INDEXED     = 1;
    const TYPE_ASSOCIATIVE = 2;

    public function __construct(array $data, $type = self::TYPE_INDEXED)
    {
        reset($data);
        while (list($k, $v) = each($data))
        {
            $type == self::TYPE_INDEXED ?
                $this->array[] = $v :
                $this->array[$k] = $v;
        }
    }

    public function getIterator()
    {
        return new ArrayIterator($this->array);
    }
}

$obj = new myData(['one' => 'php', 'javascript', 'three' => 'c#', 'java',], /*TYPE 1 or 2*/ );

foreach ($obj as $key => $value)
{
    var_dump($key, $value);
    echo PHP_EOL;
}

// if TYPE == 1
#int(0)
#string(3) "php"
#int(1)
#string(10) "javascript"
#int(2)
#string(2) "c#"
#int(3)
#string(4) "java"

// if TYPE == 2
#string(3) "one"
#string(3) "php"
#int(0)
#string(10) "javascript"
#string(5) "three"
#string(2) "c#"
#int(1)
#string(4) "java"