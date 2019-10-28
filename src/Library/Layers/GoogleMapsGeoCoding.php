<?php

namespace Alnv\ContaoGeoCodingBundle\Library\Layers;


class GoogleMapsGeoCoding extends Layer {


    protected function generateGeoCoding( $strAddress, $strLanguage ) {

        $strAddress = urlencode( $strAddress );
        $strGoogleApiKey = \Config::get('googleMapsApiKey');
        $strRequest = sprintf( 'https://maps.googleapis.com/maps/api/geocode/json?address=%s&key=%s&language=%s&region=%s', $strAddress, $strGoogleApiKey, urlencode( $strLanguage ), urlencode( $strLanguage ) );

        $arrGeoCoordinates = [];
        $objRequest = new \Request();
        $objRequest->send( $strRequest );

        if ( $objRequest->hasError() ) {

            \System::log( $objRequest->error, __METHOD__, TL_GENERAL );

            return null;
        }

        $arrResponse = $objRequest->response ? json_decode( $objRequest->response, true ) : [];

        if( !is_array( $arrResponse ) || empty( $arrResponse ) ) {

            return null;
        }

        if ( isset( $arrResponse['error_message'] ) && $arrResponse['error_message'] ) {

            \System::log( $arrResponse['error_message'], __METHOD__, TL_ERROR );

            return null;
        }

        if ( $arrResponse['status'] !== 'OK' ) {

            \System::log( $arrResponse['status'], __METHOD__, TL_ERROR );

            return null;
        }

        $arrGeometry = $arrResponse['results'][0]['geometry'];
        $arrGeoCoordinates['latitude'] = $arrGeometry['location'] ? preg_replace( '/,/', '.', (string) $arrGeometry['location']['lat'] ) : '0';
        $arrGeoCoordinates['longitude'] = $arrGeometry['location'] ? preg_replace( '/,/', '.', (string) $arrGeometry['location']['lng'] ) : '0';

        $this->arrGeoCoordinates = $arrGeoCoordinates;
    }
}