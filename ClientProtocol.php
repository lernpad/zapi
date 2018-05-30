<?php

namespace Lernpad\ZApi;

use Lernpad\ZApi\Model\CredentialMsg;
use Lernpad\ZApi\Model\EventMsg;
use Lernpad\ZApi\Model\MethodMsg;
use Lernpad\ZApi\Model\NumberMsg;
use Lernpad\ZApi\Model\StatusMsg;
use Lernpad\ZApi\Model\UserMsg;
use Symfony\Component\Validator\Exception\ValidatorException;

class ClientProtocol
{
    private $host;
    private $port;
    private $pw;
    private $timeout;

    public function __construct($timeout = 1000)
    {
        $this->timeout = $timeout;
    }

    /**
     * @param type    $host
     * @param type    $port
     * @param UserMsg $authUser
     *
     * @todo cal Login to get full authUser
     */
    public function connect($host, $port, UserMsg &$authUser)
    {
        $this->host = $host;
        $this->port = $port;
        //---
        $cred = new CredentialMsg();
        $cred->setLogin($authUser->getLogin())->setPassword($authUser->getPassword());
        $this->pw = $cred;
    }

    public function userCreate(UserMsg $user)
    {
        return $this->doUser($user, MethodMsg::UserCreate);
    }

    /**
     * @throws \ZMQSocketException
     * @throws ValidatorException
     */
    private function doUser(UserMsg $user, $cmd)
    {
        //--- проверки
        if (!$this->pw->isValid() || !$user->isValid()) {
            return StatusMsg::statusError;
        }

        $socket = new Socket(\ZMQ::SOCKET_REQ, $this->timeout);
        $socket->connect($this->host, $this->port);
        $socket->sendMsg(new MethodMsg($cmd), \ZMQ::MODE_SNDMORE);
        $socket->sendMsg($this->pw, \ZMQ::MODE_SNDMORE);
        $socket->sendMsg($user);

        /* @var $status StatusMsg */
        $status = $socket->recvMsg(StatusMsg::class);
        //---
        return $status->getCode();
    }

    /**
     * @throws \ZMQSocketException
     * @throws ValidatorException
     */
    public function eventsGet()
    {
        //--- проверки
        if (!$this->pw->isValid()) {
            return StatusMsg::statusError;
        }

        $socket = new Socket(\ZMQ::SOCKET_REQ, $this->timeout);
        $socket->connect($this->host, $this->port);
        $socket->sendMsg(new MethodMsg(MethodMsg::EventsGetCalendar), \ZMQ::MODE_SNDMORE);
        $socket->sendMsg($this->pw);

        /* @var $status StatusMsg */
        $status = $socket->recvMsg(StatusMsg::class);
        if (StatusMsg::statusOk !== $status->getCode()) {
            return $status->getStatus();
        }

        /* @var $count NumberMsg */
        $count = $socket->recvMsg(NumberMsg::class);

        $events = [];

        for ($i = 0; $i < $count->getNumber(); ++$i) {
            /* @var $event EventMsg */
            $event = $socket->recvMsg(EventMsg::class);
            if ($event->isValid()) {
                $events[] = $event;
            }
        }

        /* @var $count NumberMsg */
        $socket->recvMsg(NumberMsg::class);
        //---
        return $events;
    }

    /**
     * @throws \ZMQSocketException
     * @throws ValidatorException
     */
    public function userPassword($login, $newPassword)
    {
        $userPw = new CredentialMsg();
        $userPw->setLogin($login);
        $userPw->setPassword($newPassword);

        //--- проверки
        if (!$userPw->isValid()) {
            return StatusMsg::statusError;
        }

        $socket = new Socket(\ZMQ::SOCKET_REQ, $this->timeout);
        $socket->connect($this->host, $this->port);

        $socket->sendMsg(new MethodMsg(MethodMsg::UserPassword), \ZMQ::MODE_SNDMORE);
        $socket->sendMsg($this->pw, \ZMQ::MODE_SNDMORE);
        $socket->sendMsg($userPw);

        /* @var $status StatusMsg */
        $status = $socket->recvMsg(StatusMsg::class);

        return $status->getCode();
    }

    /**
     * @param int $login
     *
     * @throws \ZMQSocketException
     * @throws ValidatorException
     */
    public function userGet($login, UserMsg &$user)
    {
        $socket = new Socket(\ZMQ::SOCKET_REQ, $this->timeout);
        $socket->connect($this->host, $this->port);

        $socket->sendMsg(new MethodMsg(MethodMsg::UserGet), \ZMQ::MODE_SNDMORE);
        $socket->sendMsg($this->pw, \ZMQ::MODE_SNDMORE);
        $message = new NumberMsg();
        $message->setNumber($login);
        $socket->sendMsg($message);

        /* @var $status StatusMsg */
        $status = $socket->recvMsg(StatusMsg::class);
        /* @var $tmp UserMsg */
        $user = $socket->recvMsg(UserMsg::class);

        return $status->getCode();
    }

    /**
     * @param int       $login
     * @param \DateTime $valid_till
     *
     * @throws \ZMQSocketException
     * @throws ValidatorException
     */
    public function userService($login, \DateTime $valid_till)
    {
        $socket = new Socket(\ZMQ::SOCKET_REQ, $this->timeout);
        $socket->connect($this->host, $this->port);

        $socket->sendMsg(new MethodMsg(MethodMsg::UserService), \ZMQ::MODE_SNDMORE);
        $socket->sendMsg($this->pw, \ZMQ::MODE_SNDMORE);

        $loginMsg = new NumberMsg();
        $loginMsg->setNumber($login);
        $socket->sendMsg($loginMsg, \ZMQ::MODE_SNDMORE);

        $timestampMsg = new NumberMsg();
        $timestampMsg->setNumber($valid_till->getTimestamp());
        $socket->sendMsg($timestampMsg);

        /* @var $status StatusMsg */
        $status = $socket->recvMsg(StatusMsg::class);

        return $status->getCode();
    }
}
