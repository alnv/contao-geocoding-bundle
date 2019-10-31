<?php

$GLOBALS['TL_CRON']['monthly'][] = [ 'Alnv\ContaoGeoCodingBundle\Cronjobs\Monthly', 'clearGeoCodingCache' ];