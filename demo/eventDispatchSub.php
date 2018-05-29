<?php
/**
 * User: Tony Chen
 * Contact me: QQ329037122
 */
// symfony 事件系统使用demo

require '../start.php';

use Phalcon\Dispatcher;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class OrderCount
{
    public function onAdd(Event $event, $eventName, EventDispatcher $dispatcher)
    {
        echo '新增一个订单了,加入统计系统.';
    }
}

class OrderNewEvent extends Event
{
    public function __construct(Order $order)
    {

    }

    public const name = 'order.new'; // 新增订单事件
}

class Order
{
    private $dispatcher;
    private $no;

    // 新增一个订单
    public function create()
    {
        $this->dispatcher->dispatch(OrderNewEvent::name, new OrderNewEvent($this));
    }

    public function setDispatcher(EventDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

}


// 声明一个事件调度器(中介者)
$dispatcher = new EventDispatcher();
// 把同事类声明为回调类型，加入到中介者中
$dispatcher->addListener(OrderNewEvent::name, [new OrderCount(), 'onAdd']);

$order = new Order();
$order->setDispatcher($dispatcher);
$order->create();

// 实现事件订阅器
class StoreSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        //[
        //  [$eventName=>param]
        //]
        // param 是本类中(订阅器)的方法
        return [
            KernelEvents::RESPONSE => [
                ['onKernelResponsePre', 10],
                ['onKernelResponsePost', -10],
            ],
            OrderPlacedEvent::NAME => 'onStoreOrder',
        ];
    }

    public function onKernelResponsePre(FilterResponseEvent $event)
    {
        // ...
    }

    public function onKernelResponsePost(FilterResponseEvent $event)
    {
        // ...
    }

    public function onStoreOrder(OrderPlacedEvent $event)
    {
        // ...
    }
}

$dispatcher2 = new EventDispatcher();
$subscriber  = new StoreSubscriber();
$dispatcher2->addSubscriber($subscriber);
$dispatcher2->dispatch();








