<?php

namespace Lernpad\ZApi\Model;

class VersionMsg extends AbstractMsg
{
    /**
     * @var int id
     */
    private $id;

    /**
     * @var int product id
     */
    private $productId;

    /**
     * @var int major version
     */
    private $major;

    /**
     * @var int minor version
     */
    private $minor;

    /**
     * @var int patch number
     */
    private $patch;

    /**
     * @var string
     */
    private $prerelease;

    /**
     * @var string
     */
    private $build;

    /**
     * @var string
     */
    private $link;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @return int
     */
    public function getMajor()
    {
        return $this->major;
    }

    /**
     * @return int
     */
    public function getMinor()
    {
        return $this->minor;
    }

    /**
     * @return int
     */
    public function getPatch()
    {
        return $this->patch;
    }

    /**
     * @return string
     */
    public function getPrerelease()
    {
        return $this->prerelease;
    }

    /**
     * @return string
     */
    public function getBuild()
    {
        return $this->build;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    public function pack()
    {
        return null;
    }

    public function unpack($bytes)
    {
        $data = unpack('iid/iproduct_id/imajor/iminor/ipatch'
                .'/a32prerelease/a32build/a256link'
                .'/i6reserved', $bytes);

        $this->id = $data['id'];
        $this->productId = $data['product_id'];
        $this->major = $data['major'];
        $this->minor = $data['minor'];
        $this->patch = $data['patch'];
        $this->prerelease = $data['prerelease'];
        $this->build = $data['build'];
        $this->link = $data['link'];
    }
}
