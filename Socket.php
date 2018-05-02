<?php

namespace Lernpad\ZApi;

use Lernpad\ZApi\Model\AbstractMsg;
use Symfony\Component\Validator\Exception\ValidatorException;

class Socket
{

    private $dsn;
    private $raw;

    public function __construct($type, $timeout = 0, $name = 0)
    {
        $this->raw = new \ZMQSocket(new \ZMQContext(), $type);
    }

    public function connect($host, $port)
    {
        $this->dsn = "tcp://".$host.":".$port;
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

    public function setLinger()
    {

    }

    /**
     * @throws ValidatorException
     * @todo Timeout
     */
    public function recvMsg($class)
    {
        if (is_subclass_of($class, AbstractMsg::class)) {
            $bytes = $this->raw->recv();
            /* @var $message AbstractMsg */
            $message = new $class;
            $message->unpack($bytes);
            $message->validate();
            return $message;
        } else {
            throw new \InvalidArgumentException();
        }
    }

    /**
     * @throws ValidatorException
     */
    public function sendMsg(AbstractMsg $message, $mode = 0)
    {
        $message->validate();
        $this->raw->send($message->pack(), $mode);
    }

}
