<?php
	
/*
 * This file is part of contao article classes bundle.
 *
 * (c) Petersku
 *
 * @license LGPL-3.0-or-later
 */
 
namespace Petersku\ContaoSubnavigationBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Petersku\ContaoSubnavigationBundle\ContaoSubnavigationBundle;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(ContaoSubnavigationBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}