<?php

namespace Alnv\ContaoGeoCodingBundle\Helpers;

use Contao\Database;

class Automation
{

    public static function clearGeoCodingCacheByInterval($intDays): void
    {

        $objDatabase = Database::getInstance();
        $intTstamp = time() - (((60 * 60) * 24) * $intDays);
        $objDatabase->prepare('DELETE FROM tl_geocoding_cache WHERE tstamp < ?')->execute($intTstamp);
    }

    public static function clearGeoCodingCache(): void
    {

        $objDatabase = Database::getInstance();
        $objDatabase->prepare('DELETE FROM tl_geocoding_cache')->execute();
    }
}