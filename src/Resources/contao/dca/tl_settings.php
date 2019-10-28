<?php

$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{geocoding_settings:hide},googleMapsApiKey';

$GLOBALS['TL_DCA']['tl_settings']['fields']['googleMapsApiKey'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['googleMapsApiKey'],
    'inputType' => 'text',
    'eval' => [
        'tl_class' => 'w50'
    ]
];