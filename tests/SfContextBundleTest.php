<?php

/*
 * This file is part of the SfContextBundle package.
 *
 * (c) Théo FIDRY <theo.fidry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fidry\SfContextBundle;

use Fidry\SfContextBundle\Functional\AppKernel;
use PHPUnit\Framework\TestCase;

/**
 * @coversNothing
 */
class SfContextBundleTest extends TestCase
{
    public function test_it_boots_the_context_on_kernel_booting()
    {
        $kernel = new AppKernel('test', true);
        $kernel->boot();

        static::assertSame($kernel, SfContext::getKernel());

        $kernel->shutdown();
    }
}
