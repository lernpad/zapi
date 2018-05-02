<?php

namespace Lernpad\ZApi\Model;

class EventMsg extends AbstractMsg
{
    /**
     *
     * @var int
     */
    private $id;

    /**
     *
     * @var int
     */
    private $datetime;

    /**
     *
     * @var string
     */
    private $title;

    /**
     *
     * @var string
     */
    private $country;

    /**
     *
     * @var string
     */
    private $currency1;

    /**
     *
     * @var string
     */
    private $currency2;

    /**
     *
     * @var string
     */
    private $trigger_buy;

    /**
     *
     * @var string
     */
    private $trigger_sell;

    /**
     *
     * @var int
     */
    private $moving;

    /**
     *
     * @var boolean
     */
    private $is_conflict;

    /**
     *
     * @var boolean
     */
    private $is_public;

    /**
     *
     * @var boolean
     */
    private $is_active;

    /**
     *
     * @var string
     */
    private $comment;

    /**
     *
     * @var int
     */
    private $created_at;

    /**
     *
     * @var int
     */
    private $updated_at;

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param int $id
     *
     * @return EventMsg
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set datetime
     *
     * @param int $datetime
     *
     * @return EventMsg
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return int
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return EventMsg
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return EventMsg
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set currency1
     *
     * @param string $currency1
     *
     * @return EventMsg
     */
    public function setCurrency1($currency1)
    {
        $this->currency1 = $currency1;

        return $this;
    }

    /**
     * Get currency1
     *
     * @return string
     */
    public function getCurrency1()
    {
        return $this->currency1;
    }

    /**
     * Set currency2
     *
     * @param string $currency2
     *
     * @return EventMsg
     */
    public function setCurrency2($currency2)
    {
        $this->currency2 = $currency2;

        return $this;
    }

    /**
     * Get currency2
     *
     * @return string
     */
    public function getCurrency2()
    {
        return $this->currency2;
    }

    /**
     * Set triggerBuy
     *
     * @param string $triggerBuy
     *
     * @return EventMsg
     */
    public function setTriggerBuy($triggerBuy)
    {
        $this->trigger_buy = $triggerBuy;

        return $this;
    }

    /**
     * Get triggerBuy
     *
     * @return string
     */
    public function getTriggerBuy()
    {
        return $this->trigger_buy;
    }

    /**
     * Set triggerSell
     *
     * @param string $triggerSell
     *
     * @return EventMsg
     */
    public function setTriggerSell($triggerSell)
    {
        $this->trigger_sell = $triggerSell;

        return $this;
    }

    /**
     * Get triggerSell
     *
     * @return string
     */
    public function getTriggerSell()
    {
        return $this->trigger_sell;
    }

    /**
     * Set moving
     *
     * @param int $moving
     *
     * @return EventMsg
     */
    public function setMoving($moving)
    {
        $this->moving = $moving;

        return $this;
    }

    /**
     * Get moving
     *
     * @return int
     */
    public function getMoving()
    {
        return $this->moving;
    }

    /**
     * Set isConflict
     *
     * @param boolean $isConflict
     *
     * @return EventMsg
     */
    public function setConflict($isConflict)
    {
        $this->is_conflict = $isConflict;

        return $this;
    }

    /**
     * Get isConflict
     *
     * @return boolean
     */
    public function isConflict()
    {
        return $this->is_conflict;
    }

    /**
     * Set isPublic
     *
     * @param boolean $isPublic
     *
     * @return EventMsg
     */
    public function setPublic($isPublic)
    {
        $this->is_public = $isPublic;

        return $this;
    }

    /**
     * Get isPublic
     *
     * @return boolean
     */
    public function isPublic()
    {
        return $this->is_public;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return EventMsg
     */
    public function setActive($isActive)
    {
        $this->is_active = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function isActive()
    {
        return $this->is_active;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return EventMsg
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Get date of creation
     *
     * @return int
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Get date of last update
     *
     * @return int
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function pack()
    {
        return  pack('i',    $this->getId()) .
                pack('i',    $this->getDatetime()) .
                pack('a50',  $this->getTitle()) .
                pack('a32',  $this->getCountry()) .
                pack('a12',  $this->getCurrency1()) .
                pack('a12',  $this->getCurrency2()) .
                pack('a32',  $this->getTriggerBuy()) .
                pack('a32',  $this->getTriggerSell()) .
                pack('i',  $this->getMoving()) .
                pack('i',  $this->isConflict()) .
                pack('i',  $this->isPublic()) .
                pack('i',  $this->isActive()) .
                pack('a256',  $this->getComment()) .
                pack('i',    $this->getCreatedAt()) .
                pack('i',    $this->getUpdatedAt())
        ;
    }

    public function unpack($bytes)
    {
        $data = unpack('iid/idate/a50title/a32country/a12currency1/a12currency2'
                . '/a32trigger_buy/a32trigger_sell/imoving/iis_conflict/iis_public'
                . '/iis_active/a256comment/icreated_at/iupdated_at', $bytes);
        //
        $this->setDatetime($data['date']);
        $this->setTitle($data['title']);
        $this->setCountry($data['country']);
        $this->setCurrency1($data['currency1']);
        $this->setCurrency2($data['currency2']);
        $this->setTriggerBuy($data['trigger_buy']);
        $this->setTriggerSell($data['trigger_sell']);
        $this->setMoving($data['moving']);
        $this->setConflict($data['is_conflict']);
        $this->setPublic($data['is_public']);
        $this->setActive($data['is_active']);
        //---
        $this->id = $data['id'];
        $this->created_at = $data['created_at'];
        $this->updated_at = $data['updated_at'];
    }
}
