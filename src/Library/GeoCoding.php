<?php

namespace Contao\GeoCoding\Library;

use Contao\GeoCoding\Library\Layers\GoogleMaps as GoogleMaps;

class GeoCoding {


    protected $strType;
    protected $objCache = null;


    public function __construct( $strType = 'google-maps' ) {

        $this->strType = $strType;
        $this->objCache = new Cache();
    }


    public function getGeoCodingByAddress( $strAddress, $strLanguage = 'en' ) {

        if ( !$strAddress ) {

            // throw error
        }

        $arrCachedResults = $this->objCache->get( $this->strType, $strAddress );

        if ( $arrCachedResults !== null ) {

            return $arrCachedResults;
        }

        switch ( $this->strType ) {

            case 'google-maps':

                $objGoogleMap = new GoogleMaps( $strLanguage );
                $arrResult = $objGoogleMap->generateGeoCoding( $strAddress );
                $this->objCache->set( $this->strType, $strAddress, $arrResult );

                return $arrResult;

                break;

            default:

                // throw error

                break;
        }

        return null;
    }
}