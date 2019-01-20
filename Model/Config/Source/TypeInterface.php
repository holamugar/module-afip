<?php

namespace Mugar\Afip\Model\Config\Source;

interface TypeInterface
{
    public function getAfipCode($code);
}