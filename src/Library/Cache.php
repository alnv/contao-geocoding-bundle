<?php

namespace Contao\GeoCoding\Library;


class Cache {


    protected $objDatabase = null;


    public function __construct() {

        if ( $this->objDatabase == null ) {

            $this->objDatabase = \Database::getInstance();
        }
    }


    public function get( $strType, $strRequest ) {

        $strHash = md5( $strRequest );
        $objCache = $this->objDatabase->prepare('SELECT * FROM tl_geocoding_cache WHERE hash = ? AND type = ?')->limit(1)->execute( $strHash, $strType );

        if ( $objCache->numRows ) {

            return \StringUtil::deserialize( $objCache->result, true );
        }

        return null;
    }


    public function set( $strType, $strRequest, $arrResult ) {

        $strHash = md5( $strRequest );

        $objCache = $this->objDatabase->prepare( "INSERT INTO tl_geocoding_cache %s" )->set([
            'tstamp' => time(),
            'type' => $strType,
            'hash' => $strHash,
            'result' => serialize( $arrResult )
        ])->execute();

        return $objCache->insertId;
    }
}