<?php

namespace Alnv\ContaoGeoCodingBundle\Helpers;


class AddressBuilder {


    protected $strAddress = '';


    public function setZip( $strZip ) {

        $this->strAddress .= $strZip ? ' ' . $strZip : '';
    }


    public function setCity( $strCity ) {

        $this->strAddress .= $strCity ? ' ' . $strCity . ',' : ',';
    }


    public function setStreet( $strStreet ) {

        $this->strAddress .= $strStreet ?: '';
    }


    public function setStreetNumber( $strStreetNumber ) {

        $this->strAddress .= $strStreetNumber ? ' ' . $strStreetNumber . ',' : ',';
    }


    public function setCountry( $strCountry ) {

        $this->strAddress .= $strCountry ? ' ' . $strCountry : '';
    }


    public function setState( $strState ) {

        $this->strAddress .= $strState ? ' ' . $strState : '';
    }


    public function getAddress() {

        return trim( $this->strAddress );
    }
}