<?php

declare(strict_types=1);

/*
 * This file is part of [package name].
 *
 * (c) John Doe
 *
 * @license LGPL-3.0-or-later
 */

namespace Petersku\ContaoSubnavigationBundle\Tests;

use Petersku\ContaoSubnavigationBundle\ContaoSubnavigationBundle;
use PHPUnit\Framework\TestCase;

class ContaoSubnavigationBundleTest extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        $bundle = new ContaoSubnavigationBundle();

        $this->assertInstanceOf('Petersku\ContaoSubnavigationBundle\ContaoSubnavigationBundle', $bundle);
    }
}
