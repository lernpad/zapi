<?php

namespace Lernpad\ZApi\Model;

class CodeMsg extends AbstractMsg
{

    private $code;

    /**
     * Get code
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
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
        $this->code = $code;

        return $this;
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
}

