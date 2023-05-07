<?php

namespace Alnv\ContaoGeoCodingBundle\ContaoManager;

use Alnv\ContaoGeoCodingBundle\AlnvContaoGeoCodingBundle;
use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

class Plugin implements BundlePluginInterface
{

    public function getBundles(ParserInterface $parser)
    {

        return [
            BundleConfig::create(AlnvContaoGeoCodingBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class])
                ->setReplace(['contao-geocoding-bundle'])
        ];
    }
}