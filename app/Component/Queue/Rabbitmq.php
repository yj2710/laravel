<?php
/**
 * Created by PhpStorm.
 * UserQO: ABM
 * Date: 2019/10/30
 * Time: 10:50
 */

namespace App\Component\Queue;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Rabbitmq
{
    /**
     * mq连接实例
     * @var AMQPStreamConnection
     * @author tom
     */
    protected $connection;

    /**
     * mq信道实例
     * @var \PhpAmqpLib\Channel\AMQPChannel
     * @author tom
     */
    protected $channel;

    /**
     * 配置信息
     * @var string
     * @author tom
     */
    protected $config;

    /**
     * 是否开启事务
     * @var integer
     * @author tom
     */
    protected $transaction = 0;

    /**
     * Rabbitmq constructor.
     * @param array $config
     * @throws \Exception
     */
    public function __construct($config = [])
    {
        if (empty($config)) {
            throw new \Exception('rabbitmq配置无效');
        }
//        dd($config['host']);
        //新建mq连接
        $this->connection = new AMQPStreamConnection(
            $config['host'], $config['port'], $config['login'], $config['password'], $config['vhost']
        );
        $this->config = $config;
    }

    public function __destruct() {
        //关闭连接
        $this->connection->close();
    }

    /**
     * 生产
     * @param string $queue 队列名
     * @param mixed $data 数据
     * @param bool $durable 持久化
     * @return void
     * @author tom
     */
    public function product($queue, $data, $durable = false)
    {
        if (!$queue) {
            $queue = $this->config['queue'];
        }
        $data = json_encode($data);
        //打开信道
        if ($this->transaction == 1) {
            $channel = $this->channel;
        } else {
            $channel = $this->connection->channel();
            $log = app('log');
            //异步回调消息确认 - 成功
            $channel->set_ack_handler(
                function (AMQPMessage $message) use ($log) {
                    $log->debug('message pub success: ' . $message->body);
                }
            );
            //异步回调消息确认 - 失败
            $channel->set_nack_handler(
                function (AMQPMessage $message) use ($log) {
                    $log->error('message pub fail: ' . $message->body);
                }
            );
            //设为confirm模式
            $channel->confirm_select();
        }
        //声明队列
        $channel->queue_declare(
            $queue,
            $this->config['options']['queue']['passive'],
            $this->config['options']['queue']['durable'],
            $this->config['options']['queue']['exclusive'],
            $this->config['options']['queue']['auto_delete']
        );
        //打包数据
        $properties = [
            'delivery_mode' => $durable ? AMQPMessage::DELIVERY_MODE_PERSISTENT : AMQPMessage::DELIVERY_MODE_NON_PERSISTENT,
        ];
        $msg = new AMQPMessage($data, $properties);
        //推送
        $channel->basic_publish($msg, '', $queue);
        if ($this->transaction != 1) {
            //阻塞等待消息确认
            $channel->wait_for_pending_acks();
            //关闭信道
            $channel->close();
        }
    }

    /**
     * 消费
     * @param string $queue 队列名
     * @param mixed $callback 闭包函数
     * @return void
     * @author tom
     */
    public function consumer($queue, \closure $callback)
    {
        if (strlen($queue) == 0) {
            $queue = $this->config['queue'];
        }
        //打开信道
        $channel = $this->connection->channel();
        //声明队列
        $channel->queue_declare(
            $queue,
            $this->config['options']['queue']['passive'],
            $this->config['options']['queue']['durable'],
            $this->config['options']['queue']['exclusive'],
            $this->config['options']['queue']['auto_delete']
        );
        //流量控制
        $channel->basic_qos(null, 10, null);
        //消费
        $channel->basic_consume($queue, '', false, false, false, false, $callback);
        while(count($channel->callbacks)) {
            $channel->wait();
        }
        //关闭信道
        $channel->close();
    }

    /**
     * 发布
     * @param string $exchage 交换机
     * @param mixed $data 数据
     * @param bool $durable 持久化
     * @param string $routekey 路由
     * @return void
     * @author tom
     * @throws \Exception
     */
    public function publish($exchage, $data, $durable = false, $routekey = '')
    {
        if (strlen($exchage) == 0) {
            throw new \Exception('未指定交换机名');
        }
        $data = json_encode($data);
        //打开信道
        if ($this->transaction == 1) {
            $channel = $this->channel;
        } else {
            $channel = $this->connection->channel();
            $log = app('log');
            //异步回调消息确认 - 成功
            $channel->set_ack_handler(
                function (AMQPMessage $message) use ($log) {
                    $log->debug('message pub success: ' . $message->body);
                }
            );
            //异步回调消息确认 - 失败
            $channel->set_nack_handler(
                function (AMQPMessage $message) use ($log) {
                    $log->error('message pub fail: ' . $message->body);
                }
            );
            //设为confirm模式
            $channel->confirm_select();
        }
        //声明交换机
        $channel->exchange_declare(
            $exchage,
            'topic',
            $this->config['options']['exchange']['passive'],
            $this->config['options']['exchange']['durable'],
            $this->config['options']['exchange']['auto_delete']
        );
        //打包数据
        $properties = [
            'delivery_mode' => $durable ? AMQPMessage::DELIVERY_MODE_PERSISTENT : AMQPMessage::DELIVERY_MODE_NON_PERSISTENT,
        ];
        $msg = new AMQPMessage($data, $properties);
        //发布
        $channel->basic_publish($msg, $exchage, $routekey);
        if ($this->transaction != 1) {
            //阻塞等待消息确认
            $channel->wait_for_pending_acks();
            //关闭信道
            $channel->close();
        }
    }
}