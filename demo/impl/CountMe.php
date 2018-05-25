<?php
/**
 * User: Tony Chen
 * Contact me: QQ329037122
 */

class CountMe implements Countable
{
    protected $_myCount = 3;

    public function count()
    {
        return $this->_myCount;
    }
}

$countable = new CountMe();
echo count($countable); //result is "3" as expected