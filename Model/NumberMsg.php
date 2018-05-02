<?php

namespace Lernpad\ZApi\Model;

class NumberMsg extends AbstractMsg
{

    private $number;

    /**
     * Get number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set number
     *
     * @param int $number
     *
     * @return NumberMsg
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Pack number to binary string
     *
     * @return string
     */
    public function pack()
    {
        return pack('i', $this->getNumber());
    }

    /**
     * Unpack binary string to NumberMsg
     *
     * @param string $bytes
     *
     * @return NumberMsg
     */
    public function unpack($bytes)
    {
        $data = unpack('inumber', $bytes);
        $this->setNumber($data['number']);

        return $this;
    }
}

