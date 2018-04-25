<?php


namespace Lernpad\ZApi\Model;

class UserMsg extends AbstractMsg
{
    /**
     *
     * @var int
     */
    private $login;

    /**
     *
     * @var int
     */
    private $group;

    /**
     *
     * @var string
     */
    private $password;

    /**
     *
     * @var bool
     */
    private $enabled;

    /**
     *
     * @var string
     */
    private $name;

    private $country;

    private $city;

    private $phone;

    private $email;

    private $office;

    private $extra1;

    private $extra2;

    private $last_ip;

    private $connected_at;

    private $paid_at;

    private $valid_till;

    private $created_at;

    private $updated_at;


    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    public function getGroup()
    {
        return $this->group;
    }

    public function setGroup($group)
    {
        $this->group = $group;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getOffice()
    {
        return $this->office;
    }

    public function setOffice($office)
    {
        $this->office = $office;
        return $this;
    }

    public function getExtra1()
    {
        return $this->extra1;
    }

    public function setExtra1($extra1)
    {
        $this->extra1 = $extra1;
        return $this;
    }

    public function getExtra2()
    {
        return $this->extra2;
    }

    public function setExtra2($extra2)
    {
        $this->extra2 = $extra2;
        return $this;
    }

    public function getLastIp()
    {
        return $this->last_ip;
    }

    public function setLastIp($lastIp)
    {
        $this->last_ip = $lastIp;
        return $this;
    }

    public function getConnectedAt()
    {
        return $this->connected_at;
    }

    public function setConnectedAt($connectedAt)
    {
        $this->connected_at = $connectedAt;
        return $this;
    }

    public function getPaidAt()
    {
        return $this->paid_at;
    }

    public function setPaidAt($paidAt)
    {
        $this->paid_at = $paidAt;
        return $this;
    }


    public function getValidTill()
    {
        return $this->valid_till;
    }

     public function setValidTill($validTill)
    {
        $this->valid_till = $validTill;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function pack()
    {
        return  pack('i',    $this->getLogin()) .
                pack('i',    $this->getGroup()) .
                pack('a16',  $this->getPassword()) .
                pack('i',    $this->isEnabled()) .
                pack('a128', $this->getName()) .
                pack('a32',  $this->getCountry()) .
                pack('a32',  $this->getCity()) .
                pack('a32',  $this->getPhone()) .
                pack('a32',  $this->getEmail()) .
                pack('a32',  $this->getOffice()) .
                pack('a32',  $this->getExtra1()) .
                pack('a32',  $this->getExtra2()) .
                pack('i',    $this->getLastIp()) .
                pack('i',    $this->getConnectedAt()) .
                pack('i',    $this->getPaidAt()) .
                pack('i',    $this->getValidTill()) .
                pack('i',    $this->getCreatedAt()) .
                pack('i',    $this->getUpdatedAt())
        ;
    }

    public function unpack($bytes)
    {

    }
}

