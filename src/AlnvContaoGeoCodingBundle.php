<?php

namespace Alnv\ContaoGeoCodingBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AlnvContaoGeoCodingBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}