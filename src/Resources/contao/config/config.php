<?php

use Alnv\ContaoGeoCodingBundle\Cronjobs\Monthly;

$GLOBALS['TL_CRON']['monthly'][] = [Monthly::class, 'clearGeoCodingCache'];