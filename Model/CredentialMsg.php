<?php

namespace Lernpad\ZApi\Model;

class CredentialMsg extends AbstractMsg
{

    /**
     *
     * @var int login
     */
    private $login;

    /**
     *
     * @var string
     */
    private $password;

    /**
     *
     * @return int
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     *
     * @param int $login
     * @return Credential
     */
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     *
     * @return Credential
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     *
     */
    public function pack()
    {
        return pack("i", $this->login).
                pack('a16', $this->password)
        ;
    }

    public function unpack($bytes)
    {
        return null;
    }

}
