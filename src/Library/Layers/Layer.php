<?php

namespace Contao\GeoCoding\Library\Layers;


abstract class Layer {


    protected $strLanguage;


    public function __construct( $strLanguage = 'en' ) {

        $this->strLanguage = $strLanguage;
    }


    public function generateGeoCoding( $strAddress ) {

        return [ 'latitude' => '0', 'longitude' => '0' ];
    }
}