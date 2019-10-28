<?php

namespace Alnv\ContaoGeoCodingBundle\Library;

use Alnv\ContaoGeoCodingBundle\Library\Layers\GoogleMapsGeoCoding;


class GeoCoding {


    public function getGeoCodingByAddress( $strType, $strAddress, $strLanguage = '' ) {

        switch ( $strType ) {

            case 'google-geocoding':

                $objGoogleMap = new GoogleMapsGeoCoding( $strAddress, $strLanguage );

                return $objGoogleMap->getGeoCoordinates();

                break;
        }

        return null;
    }
}