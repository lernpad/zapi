<?php

namespace Lernpad\ZApi;

use Lernpad\ZApi\Exception\TimeoutException;
use Lernpad\ZApi\Model\AbstractMsg;
use Symfony\Component\Validator\Exception\ValidatorException;

class Socket
{
    private $dsn;
    private $raw;
    private $timeout;

    public function __construct($type, $timeout)
    {
        $this->timeout = $timeout;
        $this->raw = new \ZMQSocket(new \ZMQContext(), $type);
        if ($timeout) {
            $this->setLinger(0);
        }
    }

    public function connect($host, $port)
    {
        $this->dsn = 'tcp://'.$host.':'.$port;
        $endpoints = $this->raw->getEndpoints();
        if (!in_array($this->dsn, $endpoints['connect'])) {
            $this->raw->connect($this->dsn);
        }
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    public function disconnect()
    {
        $this->raw->disconnect($this->dsn);
    }

    public function setLinger($linger = 0)
    {
        $this->raw->setSockOpt(\ZMQ::SOCKOPT_LINGER, $linger);
    }

    /**
     * @throws ValidatorException
     * @throws \ZMQSocketException
     * @throws TimeoutException
     */
    public function recvMsg($class)
    {
        $read = $write = [];
        $poll = new \ZMQPoll();
        $poll->add($this->raw, \ZMQ::POLL_IN);
        $events = $poll->poll($read, $write, $this->timeout);

        if ($events > 0) {
            if (is_subclass_of($class, AbstractMsg::class)) {
                $bytes = $this->raw->recv();
                /* @var $message AbstractMsg */
                $message = new $class();
                $message->unpack($bytes);
                $message->validate();

                return $message;
            }
            throw new \InvalidArgumentException();
        }
        throw new TimeoutException();
    }

    /**
     * @throws ValidatorException
     * @throws \ZMQSocketException
     */
    public function sendMsg(AbstractMsg $message, $mode = 0)
    {
        $message->validate();
        $this->raw->send($message->pack(), $mode);
    }
}
