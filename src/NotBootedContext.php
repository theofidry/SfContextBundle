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

use LogicException;

final class NotBootedContext extends LogicException
{
    /**
     * @inheritdoc
     */
    public function __construct()
    {
        parent::__construct(
            'Cannot use SfContext as it is not booted. Check if "SfContextBundle" is properly '
            .'registered or if the kernel is booted.'
        );
    }
}
