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

use Symfony\Component\HttpKernel\Bundle\Bundle;

final class SfContextBundle extends Bundle
{
    /**
     * @inheritdoc
     */
    public function boot()
    {
        parent::boot();

        SfContext::boot($this->container);
    }

}
