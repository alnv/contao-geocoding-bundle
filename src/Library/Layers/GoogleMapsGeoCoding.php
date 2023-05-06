<?php

namespace Alnv\ContaoGeoCodingBundle\Library\Layers;

use Contao\Config;
use Contao\CoreBundle\Monolog\ContaoContext;
use Contao\System;
use Psr\Log\LogLevel;

class GoogleMapsGeoCoding extends Layer
{

    protected function generateGeoCoding($strAddress, $strLanguage)
    {

        $strAddress = urlencode($strAddress);
        $strGoogleApiKey = Config::get('googleMapsApiKey');
        $strRequest = sprintf('https://maps.googleapis.com/maps/api/geocode/json?address=%s&key=%s&language=%s&region=%s', $strAddress, $strGoogleApiKey, urlencode($strLanguage), urlencode($strLanguage));

        $arrGeoCoordinates = [];
        $objRequest = new Request();
        $objRequest->send($strRequest);

        if ($objRequest->hasError()) {

            System::getContainer()
                ->get('monolog.logger.contao')
                ->log(LogLevel::INFO, $objRequest->error, ['contao' => new ContaoContext(__CLASS__ . '::' . __FUNCTION__)]);

            return null;
        }

        $arrResponse = $objRequest->response ? json_decode($objRequest->response, true) : [];

        if (!is_array($arrResponse) || empty($arrResponse)) {
            return null;
        }

        if (isset($arrResponse['error_message']) && $arrResponse['error_message']) {

            System::getContainer()
                ->get('monolog.logger.contao')
                ->log(LogLevel::INFO, $arrResponse['error_message'], ['contao' => new ContaoContext(__CLASS__ . '::' . __FUNCTION__)]);

            return null;
        }

        if ($arrResponse['status'] !== 'OK') {

            System::getContainer()
                ->get('monolog.logger.contao')
                ->log(LogLevel::INFO, $arrResponse['status'], ['contao' => new ContaoContext(__CLASS__ . '::' . __FUNCTION__)]);

            return null;
        }

        $arrGeometry = $arrResponse['results'][0]['geometry'];
        $arrGeoCoordinates['latitude'] = $arrGeometry['location'] ? preg_replace('/,/', '.', (string)$arrGeometry['location']['lat']) : '0';
        $arrGeoCoordinates['longitude'] = $arrGeometry['location'] ? preg_replace('/,/', '.', (string)$arrGeometry['location']['lng']) : '0';

        $this->arrGeoCoordinates = $arrGeoCoordinates;
    }
}