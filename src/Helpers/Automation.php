<?php

namespace Alnv\ContaoGeoCodingBundle\Helpers;


class Automation {


    public static function clearGeoCodingCacheByInterval( $intDays ) {

        $objDatabase = \Database::getInstance();
        $intTstamp = time() - ( ( ( 60 * 60 ) * 24 ) * $intDays );
        $objDatabase->prepare( 'DELETE FROM tl_geocoding_cache WHERE tstamp < ?' )->execute( $intTstamp );

        \System::log( 'Geocoding Cache has been deleted', __METHOD__, TL_GENERAL );
    }


    public static function clearGeoCodingCache() {

        $objDatabase = \Database::getInstance();
        $objDatabase->prepare( 'DELETE FROM tl_geocoding_cache' )->execute();

        \System::log( 'Geocoding Cache has been deleted', __METHOD__, TL_GENERAL );
    }
}