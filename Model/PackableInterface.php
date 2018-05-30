<?php

namespace Lernpad\ZApi\Model;

interface PackableInterface
{
    public function pack();

    public function unpack($bytes);
}
