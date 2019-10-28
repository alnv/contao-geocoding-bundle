<?php

namespace Alnv\ContaoGeoCodingBundle\Helpers;


class Toolkit {


    public static function generateAddress( $arrGeoSettings, $arrRecord ) {

        $objAddress = new AddressBuilder();

        if ( $arrGeoSettings['street'] ) {

            $objAddress->setStreet( $arrRecord[ $arrGeoSettings['street'] ] );
        }

        if ( $arrGeoSettings['streetNumber'] ) {

            $objAddress->setStreetNumber( $arrRecord[ $arrGeoSettings['streetNumber'] ] );
        }

        if ( $arrGeoSettings['zip'] ) {

            $objAddress->setZip( $arrRecord[ $arrGeoSettings['zip'] ] );
        }

        if ( $arrGeoSettings['city'] ) {

            $objAddress->setCity( $arrRecord[ $arrGeoSettings['city'] ] );
        }

        if ( $arrGeoSettings['state'] ) {

            $objAddress->setState( $arrRecord[ $arrGeoSettings['state'] ] );
        }

        if ( $arrGeoSettings['country'] ) {

            $objAddress->setCountry( $arrRecord[ $arrGeoSettings['country'] ] );
        }

        return $objAddress->getAddress();
    }
}