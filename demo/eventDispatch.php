<?php
/**
 * User: Tony Chen
 * Contact me: QQ329037122
 */
// symfony 事件系统使用demo

require '../start.php';

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;

class OrderCount
{
    public function onAdd(Event $event, $eventName, EventDispatcher $dispatcher)
    {
        echo '新增一个订单了,加入统计系统.';
    }
}

class OrderNewEvent extends Event
{
    public const name = 'order.new'; // 新增订单事件
}


$dispatcher = new EventDispatcher();
// 加入事件
$dispatcher->addListener(OrderNewEvent::name, [new OrderCount(), 'onAdd']);

// 触发指定事件
$dispatcher->dispatch(OrderNewEvent::name, new OrderNewEvent());

// $order = new Order();
// $event = new OrderPlacedEvent($order);
// $dispatcher->dispatch(OrderPlacedEvent::NAME, $event);




