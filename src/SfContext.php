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

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

final class SfContext
{
    /** @var ContainerInterface */
    private static $container;

    public static function boot(ContainerInterface $container)
    {
        self::$container = $container;
    }

    public static function shutdown()
    {
        self::$container = null;
    }

    /**
     * @return ContainerInterface
     */
    public static function getContainer()
    {
        self::checkIsBooted();

        return self::$container;
    }

    /**
     * @return KernelInterface
     */
    public static function getKernel()
    {
        self::checkIsBooted();

        return self::$container->get('kernel');
    }

    /**
     * @param string $id
     *
     * @return object
     */
    public static function get($id)
    {
        self::checkIsBooted();

        return self::$container->get($id);
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public static function getParameter($name)
    {
        self::checkIsBooted();

        return self::$container->getParameter($name);
    }

    private static function checkIsBooted()
    {
        if (null === self::$container) {
            throw new NotBootedContext();
        }
    }

    private function __construct()
    {
    }
}
