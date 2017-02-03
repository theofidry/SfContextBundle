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

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use stdClass;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * @covers \Fidry\SfContextBundle\SfContext
 */
class SfContextTest extends TestCase
{
    /**
     * @inheritdoc
     */
    public function tearDown()
    {
        SfContext::shutdown();
    }

    public function test_it_cannot_get_the_container_if_is_not_booted()
    {
        try {
            SfContext::getContainer();
            static::fail('Expected exception to be thrown.');
        } catch (NotBootedContext $exception) {
            // Expected result
        }
    }

    public function test_it_can_give_the_container()
    {
        $containerProphecy = $this->prophesize(ContainerInterface::class);
        $containerProphecy->get(Argument::any())->shouldNotBeCalled();
        /** @var ContainerInterface $container */
        $container = $containerProphecy->reveal();

        SfContext::boot($container);

        static::assertSame($container, SfContext::getContainer());
    }

    public function test_it_can_boot_and_reset_the_context()
    {
        $containerProphecy = $this->prophesize(ContainerInterface::class);
        $containerProphecy->get(Argument::any())->shouldNotBeCalled();
        /** @var ContainerInterface $container */
        $container = $containerProphecy->reveal();

        SfContext::boot($container);
        SfContext::shutdown();

        try {
            SfContext::getContainer();
        } catch (NotBootedContext $exception) {
            // Expected result
        }
    }

    public function test_it_can_get_the_kernel()
    {
        $kernelProphecy = $this->prophesize(KernelInterface::class);
        $kernelProphecy->getEnvironment()->shouldNotBeCalled();
        /** @var KernelInterface $kernel */
        $kernel = $kernelProphecy->reveal();

        $containerProphecy = $this->prophesize(ContainerInterface::class);
        $containerProphecy->get('kernel')->willReturn($kernel);
        /** @var ContainerInterface $container */
        $container = $containerProphecy->reveal();

        SfContext::boot($container);

        static::assertSame($kernel, SfContext::getKernel());

        $containerProphecy->get(Argument::any())->shouldHaveBeenCalledTimes(1);
    }

    public function test_it_cannot_get_the_kernel_if_is_not_booted()
    {
        try {
            SfContext::getKernel();
            static::fail('Expected exception to be thrown.');
        } catch (NotBootedContext $exception) {
            // Expected result
        }
    }

    public function test_it_can_get_a_service()
    {
        $dummyService = new stdClass();

        $containerProphecy = $this->prophesize(ContainerInterface::class);
        $containerProphecy->get('dummy_service')->willReturn($dummyService);
        /** @var ContainerInterface $container */
        $container = $containerProphecy->reveal();

        SfContext::boot($container);

        static::assertSame($dummyService, SfContext::get('dummy_service'));

        $containerProphecy->get(Argument::any())->shouldHaveBeenCalledTimes(1);
    }

    public function test_it_cannot_get_a_service_if_is_not_booted()
    {
        try {
            SfContext::get('dummy_service');
            static::fail('Expected exception to be thrown.');
        } catch (NotBootedContext $exception) {
            // Expected result
        }
    }

    public function test_it_can_get_a_parameter()
    {
        $containerProphecy = $this->prophesize(ContainerInterface::class);
        $containerProphecy->getParameter('foo')->willReturn('bar');
        /** @var ContainerInterface $container */
        $container = $containerProphecy->reveal();

        SfContext::boot($container);

        static::assertSame('bar', SfContext::getParameter('foo'));

        $containerProphecy->getParameter(Argument::any())->shouldHaveBeenCalledTimes(1);
    }

    public function test_it_cannot_get_a_parameter_if_is_not_booted()
    {
        try {
            SfContext::getParameter('foo');
            static::fail('Expected exception to be thrown.');
        } catch (NotBootedContext $exception) {
            // Expected result
        }
    }
}
