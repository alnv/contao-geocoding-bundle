<?php

namespace Alnv\ContaoGeoCodingBundle\Cronjobs;

use Alnv\ContaoGeoCodingBundle\Helpers\Automation;

class Monthly
{

    public function clearGeoCodingCache()
    {

        Automation::clearGeoCodingCacheByInterval(14);
    }
}