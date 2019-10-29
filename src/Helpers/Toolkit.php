<?php

namespace Alnv\ContaoGeoCodingBundle\Helpers;


class Toolkit {


    public static function generateAddress( $arrGeoSettings, $arrRecord ) {

        $arrAddress = [];

        foreach ( $arrGeoSettings as $strGeoField ) {

            $arrAddress[ $strGeoField ] = $arrRecord[ $arrGeoSettings['street'] ];
        }

        $objAddress = new AddressBuilder( $arrAddress );

        return $objAddress->getAddress();
    }
}