<?php

namespace Contao\GeoCoding\Library\Layers;


class GoogleMaps extends Layer {


    public function generateGeoCoding( $strAddress ) {

        $strAddress = urlencode( $strAddress );
        $strGoogleApiKey = \Config::get('geoCodingGoogleMapsApiKey');
        $strRequest = sprintf( 'https://maps.googleapis.com/maps/api/geocode/json?address=%s&key=%s&language=%s&region=%s', $strAddress, $strGoogleApiKey, urlencode( $this->strLanguage ), urlencode( $this->strLanguage ) );

        $objRequest = new \Request();
        $objRequest->send( $strRequest );
        $arrReturn = parent::generateGeoCoding( $strAddress );

        if ( $objRequest->hasError() ) {

            \System::log( $objRequest->error, __METHOD__, TL_GENERAL );

            return $arrReturn;
        }

        $arrResponse = $objRequest->response ? json_decode( $objRequest->response, true ) : [];

        if ( isset( $arrResponse['error_message'] ) && $arrResponse['error_message'] ) {

            \System::log( $arrResponse['error_message'], __METHOD__, TL_ERROR );

            return $arrReturn;
        }

        if( !empty( $arrResponse ) && is_array( $arrResponse ) ) {

            $arrGeometry = $arrResponse['results'][0]['geometry'];

            $arrReturn['latitude'] = $arrGeometry['location'] ? preg_replace( '/,/', '.', (string) $arrGeometry['location']['lat'] ) : '0';
            $arrReturn['longitude'] = $arrGeometry['location'] ? preg_replace( '/,/', '.', (string) $arrGeometry['location']['lng'] ) : '0';

            return $arrReturn;
        }

        return $arrReturn;
    }
}