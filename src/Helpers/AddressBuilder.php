<?php

namespace Alnv\ContaoGeoCodingBundle\Helpers;


class AddressBuilder {


    protected $arrAddressFields = ['street','streetNumber','zip','city','state','country'];
    protected $arrAddress = ['address' => [], 'city' => [], 'state' => [], 'country' => []];


    public function __construct( $arrAddress ) {

        foreach ( $this->arrAddressFields as $strField ) {

            if ( isset( $arrAddress[ $strField ] ) && $arrAddress[ $strField ] !== '' ) {

                $strMethod = 'set' . ucfirst( $strField );
                $this->{$strMethod}( $arrAddress[ $strField ] );
            }
        }
    }


    protected function setZip( $strZip ) {

        if ( $strZip === '' || $strZip === null ) {

            return null;
        }

        $this->arrAddress['city'][] = $strZip;
    }


    protected function setCity( $strCity ) {

        if ( $strCity === '' || $strCity === null ) {

            return null;
        }

        $this->arrAddress['city'][] = $strCity;
    }


    protected function setStreet( $strStreet ) {

        if ( $strStreet === '' || $strStreet === null ) {

            return null;
        }

        $this->arrAddress['address'][] = $strStreet;
    }


    protected function setStreetNumber( $strStreetNumber ) {

        if ( $strStreetNumber === '' || $strStreetNumber === null ) {

            return null;
        }

        $this->arrAddress['address'][] = $strStreetNumber;
    }


    protected function setCountry( $strCountry ) {

        if ( $strCountry === '' || $strCountry === null ) {

            return null;
        }

        $this->arrAddress['country'][] = $strCountry;
    }


    protected function setState( $strState ) {

        if ( $strState === '' || $strState === null ) {

            return null;
        }

        $this->arrAddress['state'][] = $strState;
    }


    public function getAddress() {

        $arrAddress = [];

        foreach ( $this->arrAddress as $arrBlock ) {

            if ( empty( $arrBlock ) ) {

                continue;
            }

            $arrAddress[] = implode( ', ', $arrBlock );
        }

        return implode( ', ', $arrAddress );
    }
}