<?php

declare(strict_types=1);

namespace OqqTest\Broetchen\Middleware;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Oqq\Broetchen\Middleware\PingMiddleware;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\LinkGenerator;
use Zend\Expressive\Hal\Metadata\MetadataMap;
use Zend\Expressive\Hal\ResourceGenerator;

/**
 * @covers \Oqq\Broetchen\Middleware\PingMiddleware
 */
class PingMiddlewareTest extends TestCase
{
    private $metadataMap;
    private $hydrators;
    private $linkGenerator;

    /** @var ResourceGenerator */
    private $resourceGenerator;

    /** @var HalResponseFactory */
    private $responseFactory;

    /** @var PingMiddleware */
    private $middleware;

    public function setUp(): void
    {
        $this->metadataMap = $this->prophesize(MetadataMap::class);
        $this->hydrators = $this->prophesize(ContainerInterface::class);
        $this->linkGenerator = $this->prophesize(LinkGenerator::class);

        $this->resourceGenerator = new ResourceGenerator(
            $this->metadataMap->reveal(),
            $this->hydrators->reveal(),
            $this->linkGenerator->reveal()
        );

        $this->responseFactory = new HalResponseFactory();

        $this->middleware = new PingMiddleware($this->resourceGenerator, $this->responseFactory);
    }

    /**
     * @test
     */
    public function it_response_json_with_acknowledge_if_not_accept_header_present(): void
    {
        $request = ServerRequestFactory::fromGlobals();

        $response = $this->middleware->process(
            $request,
            $this->prophesize(DelegateInterface::class)->reveal()
        );

        self::assertInstanceOf(ResponseInterface::class, $response);
        self::assertContains('application/hal+json', $response->getHeaderLine('Content-Type'));

        $responseBody = (string) $response->getBody();

        self::assertJson($responseBody);
    }

    /**
     * @test
     */
    public function it_response_json_with_acknowledge_if_accept_header_matches_json(): void
    {
        $request = ServerRequestFactory::fromGlobals(['HTTP_ACCEPT' => 'application/json']);

        $response = $this->middleware->process(
            $request,
            $this->prophesize(DelegateInterface::class)->reveal()
        );

        self::assertInstanceOf(ResponseInterface::class, $response);
        self::assertContains('application/hal+json', $response->getHeaderLine('Content-Type'));

        $responseBody = (string) $response->getBody();

        self::assertJson($responseBody);
    }

    /**
     * @test
     */
    public function it_response_xml_with_acknowledge_if_accept_header_matches_xml(): void
    {
        $request = ServerRequestFactory::fromGlobals(['HTTP_ACCEPT' => 'application/xml']);

        $response = $this->middleware->process(
            $request,
            $this->prophesize(DelegateInterface::class)->reveal()
        );

        self::assertInstanceOf(ResponseInterface::class, $response);
        self::assertContains('application/hal+xml', $response->getHeaderLine('Content-Type'));
    }
}
