<?php

namespace Lernpad\ZApi\Model;

class StatusMsg extends CodeMsg
{
    const 	statusOk = 0;
    const 	statusNotExists = 1;
    const 	statusError = 2;
    const 	statusFatal = 3;
    const  	statusLoginInvalid = 4;
    const  	statusLoginDisabled = 5;
    const 	statusAccessDenied = 6;

    private static $statuses = [
        self::statusOk => 'OK',
        self::statusNotExists => 'Not Exists',
        self::statusError => 'Common Error',
        self::statusFatal => 'Fatal Error',
        self::statusLoginInvalid => 'Login Invalid',
        self::statusLoginDisabled => 'Login Disabled',
        self::statusAccessDenied => 'Access Denied',
    ];

    public function __construct()
    {
        $this->code = self::statusError;
    }

    /**
     * Set status.
     *
     * @override
     *
     * @param int $status
     *
     * @return StatusMsg
     */
    public function setCode($code)
    {
        if (!in_array($code, $this->getAvailableStatuses())) {
            throw new \InvalidArgumentException();
        }

        return parent::setCode($code);
    }

    /**
     * Название статуса.
     *
     * @return string
     */
    public static function getName($code)
    {
        if (isset(self::$statuses[$code])) {
            return self::$statuses[$code];
        }

        return 'Unknown status code '.$code;
    }

    /**
     * Pack status to binary string.
     *
     * @return string
     */
    public function pack()
    {
        return pack('C', $this->getCode());
    }

    /**
     * Unpack binary string to StatusMsg.
     *
     * @param string $bytes
     *
     * @return StatusMsg
     */
    public function unpack($bytes)
    {
        $data = unpack('Cstatus', $bytes);
        $this->setCode($data['status']);

        return $this;
    }

    private function getAvailableStatuses()
    {
        return array_keys(self::$statuses);
    }
}
