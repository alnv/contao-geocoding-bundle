<?php

namespace Alnv\ContaoGeoCodingBundle\Library\Layers;

use Contao\System;
use Contao\Database;
use Contao\StringUtil;

abstract class Layer
{

    protected $strHash = null;

    protected $strAddress = null;

    protected $strLanguage = null;

    protected $arrGeoCoordinates = null;


    public function __construct($strAddress, $strLanguage = '')
    {

        $this->strLanguage = $strLanguage ?: System::getContainer()->get('request_stack')->getCurrentRequest()->getLocale();
        $this->strHash = md5($strAddress);
        $this->strAddress = $strAddress;
    }


    public function getGeoCoordinates()
    {
        return $this->getGeoCoordinatesFromCache();
    }


    protected function setGeoCoordinatesCache()
    {

        if (!$this->arrGeoCoordinates) {
            return null;
        }

        $objDatabase = Database::getInstance();
        $objEntity = $objDatabase->prepare('SELECT * FROM tl_geocoding_cache WHERE hash = ?')->limit(1)->execute($this->strHash);

        if (!$objEntity->numRows) {

            $objDatabase->prepare("INSERT INTO tl_geocoding_cache %s")->set([
                'tstamp' => time(),
                'hash' => $this->strHash,
                'result' => serialize($this->arrGeoCoordinates)
            ])->execute();
        }
    }


    protected function getGeoCoordinatesFromCache()
    {

        $objDatabase = Database::getInstance();
        $objCache = $objDatabase->prepare('SELECT * FROM tl_geocoding_cache WHERE hash = ?')->limit(1)->execute($this->strHash);

        if ($objCache->numRows) {
            return StringUtil::deserialize($objCache->result, true);
        }

        $this->generateGeoCoding($this->strAddress, $this->strLanguage);
        $this->setGeoCoordinatesCache();

        return $this->arrGeoCoordinates;
    }


    abstract protected function generateGeoCoding($strAddress, $strLanguage);
}