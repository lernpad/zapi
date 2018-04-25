<?php

namespace Lernpad\ZApi;

use Lernpad\ZApi\Status;
use Lernpad\ZApi\Method;
use Lernpad\ZApi\Model\CredentialMsg;
use Lernpad\ZApi\Model\UserMsg;

class ClientProtocol
{

    private $dsn;
    private $pw;

    /**
     *
     * @param type $host
     * @param type $port
     * @param UserMsg $authUser
     * @todo cal Login to get full authUser
     */
    public function connect($host, $port, UserMsg &$authUser)
    {
        $this->dsn = "tcp://" . $host . ":" . $port;
        $cred = new CredentialMsg();
        $cred->setLogin($authUser->getLogin())->setPassword($authUser->getPassword());
        $this->pw = $cred;
    }

    public function userCreate(UserMsg $user)
    {
	return $this->doUser($user, Method::UserCreate);
    }

    /**
     * @throws ZMQSocketException
     */
    private function doUser(UserMsg $user, $cmd)
    {
        //--- проверки
        $this->pw->isValid();
        $user->isValid();

	//---
	$rc = Status::statusError;	//--- код ошибки

	//---
	$context = new \ZMQContext();
        $socket = $context->getSocket(\ZMQ::SOCKET_REQ);
        // Получить список подключённых конечных точек
        $endpoints = $socket->getEndpoints();
        // Проверить, подключён ли сокет
        if (!in_array($this->dsn, $endpoints['connect'])) {
            $socket->connect($this->dsn);
        }

        $socket->send(pack("C", $cmd), \ZMQ::MODE_SNDMORE);
        $socket->send($this->pw->pack(), \ZMQ::MODE_SNDMORE);
        $socket->send($user->pack());

        $code = $socket->recv();
        $unpacked = unpack("C", $code);
        $rc = $unpacked[1];
        $socket->disconnect($this->dsn);
	//---
	return($rc);
    }
}
?>