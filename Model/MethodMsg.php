<?php

namespace Lernpad\ZApi\Model;

class MethodMsg extends CodeMsg
{
    const Auth = 1;
    const UserCreate = 14;
    const UserPassword = 18;
    const UserService = 29;
    const UserGet = 30;
    const EventsWebCalendar = 36;

    private static $methods = [
        self::Auth => 'Auth',
        self::UserCreate => 'UserCreate',
        self::UserPassword => 'UserPassword',
        self::UserService => 'UserService',
        self::UserGet => 'UserGet',
        self::EventsWebCalendar => 'EventsWebCalendar',
    ];

    public function __construct($code)
    {
        $this->setCode($code);
    }

    /**
     * Set code.
     *
     * @param int $code
     *
     * @return MethodMsg
     */
    public function setCode($code)
    {
        if (!in_array($code, $this->getAvailableMethods())) {
            throw new \InvalidArgumentException();
        }

        return parent::setCode($code);
    }

    /**
     * Название метода.
     *
     * @return string
     */
    public static function getName($method)
    {
        if (isset(self::$methods[$method])) {
            return self::$methods[$method];
        }

        return 'Unknown method '.$method;
    }

    /**
     * Pack code to binary string.
     *
     * @return string
     */
    public function pack()
    {
        return pack('C', $this->getCode());
    }

    /**
     * Unpack binary string to MethodMsg.
     *
     * @param string $bytes
     *
     * @return MethodMsg
     */
    public function unpack($bytes)
    {
        $data = unpack('Ccode', $bytes);
        $this->setCode($data['code']);

        return $this;
    }

    /**
     * Доступные коды.
     *
     * @return int[]
     */
    private function getAvailableMethods()
    {
        return array_keys(self::$methods);
    }
}
