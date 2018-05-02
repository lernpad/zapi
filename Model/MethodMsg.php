<?php

namespace Lernpad\ZApi\Model;

class MethodMsg extends CodeMsg
{

    const Auth                      = 1;
    const EventsGetActual           = 10;
    const EventsGetCalendar         = 11;
    const EventsGetAll              = 12;
    const EventsGetActive           = 13;
    const UserCreate                = 14;
    const UserPassword              = 18;
    const UserService               = 29;
    const UserGet                   = 30;

    static private $methods = [
        self::Auth => 'Auth',
        self::EventsGetActual => 'EventsGetActual',
        self::EventsGetCalendar => 'EventsGetCalendar',
        self::EventsGetAll => 'EventsGetAll',
        self::EventsGetActive => 'EventsGetActive',
        self::UserCreate => 'UserCreate',
        self::UserPassword => 'UserPassword',
        self::UserService => 'UserService',
        self::UserGet => 'UserGet'
    ];

    public function __construct($code)
    {
        $this->setCode($code);
    }

    /**
     * Set code
     *
     * @param int $code
     *
     * @return MethodMsg
     */
    public function setCode($code)
    {
        if (!in_array($code, $this->getAvailableMethods())) {
            throw new \InvalidArgumentExceptionxception();
        }

        return parent::setCode($code);
    }

    /**
     * Название метода.
     *
     * @return string
     */
    static public function getName($method)
    {
        if (isset(self::$methods[$method])) {
            return self::$methods[$method];
        }

        return 'Unknown method '.$method;
    }

    /**
     * Pack code to binary string
     *
     * @return string
     */
    public function pack()
    {
        return pack('C', $this->getCode());
    }

    /**
     * Unpack binary string to MethodMsg
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
