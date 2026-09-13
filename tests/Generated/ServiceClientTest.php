<?php

declare(strict_types=1);

namespace Ondewo\T2s\Tests\Generated;

use Grpc\BaseStub;
use Grpc\ChannelCredentials;
use Ondewo\T2s\Auth\BearerTokenAuthenticator;
use Ondewo\T2s\Text2SpeechClient;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;

/**
 * Constructs the generated service stubs against a dummy target. gRPC channels connect lazily, so
 * nothing here touches the network - but the stub, its channel options and its method surface are
 * all real.
 *
 * PRODUCT-SPECIFIC: ondewo-t2s-api declares a single service, `ondewo.t2s.Text2Speech`, so
 * Text2SpeechClient carries every RPC listed below.
 */
final class ServiceClientTest extends TestCase
{
    private const DUMMY_TARGET = 'localhost:50051';

    /**
     * Every RPC of ondewo.t2s.Text2Speech except the bidirectional StreamingSynthesize, which is
     * asserted separately because its generated signature differs.
     */
    private const UNARY_METHOD_COUNT = 18;

    /**
     * @var list<BaseStub>
     */
    private array $openClients = [];

    protected function tearDown(): void
    {
        foreach ($this->openClients as $client) {
            $client->close();
        }
        $this->openClients = [];

        parent::tearDown();
    }

    public function testAServiceClientIsConstructedAgainstAnInsecureChannel(): void
    {
        $client = $this->open(new Text2SpeechClient(self::DUMMY_TARGET, [
            'credentials' => ChannelCredentials::createInsecure(),
        ]));

        self::assertInstanceOf(BaseStub::class, $client);
        // Contains, not equals: gRPC canonicalises the target (`dns:///localhost:50051`) in some
        // core versions.
        self::assertStringContainsString(self::DUMMY_TARGET, $client->getTarget());
    }

    public function testAServiceClientAcceptsTheHandWrittenBearerAuthenticator(): void
    {
        $authenticator = new BearerTokenAuthenticator('a-token');

        // The point of the hand-written auth surface: its output IS a valid `$opts` array for a
        // generated stub. \Grpc\BaseStub rejects a missing `credentials` key and a non-callable
        // `update_metadata`, so constructing successfully proves both.
        $client = $this->open(new Text2SpeechClient(self::DUMMY_TARGET, $authenticator->channelOptions()));

        self::assertStringContainsString(self::DUMMY_TARGET, $client->getTarget());
    }

    #[DataProvider('unaryMethods')]
    public function testTheExpectedUnaryMethodsExist(string $method): void
    {
        self::assertTrue(
            method_exists(Text2SpeechClient::class, $method),
            Text2SpeechClient::class . '::' . $method . '() is missing from the generated stub'
        );

        $reflected = new ReflectionMethod(Text2SpeechClient::class, $method);
        self::assertTrue($reflected->isPublic());
        // <request message>, array $metadata = [], array $options = []
        self::assertSame(3, $reflected->getNumberOfParameters());
        self::assertSame(1, $reflected->getNumberOfRequiredParameters());
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function unaryMethods(): iterable
    {
        foreach ([
            'Synthesize',
            'BatchSynthesize',
            'NormalizeText',
            'VoiceCloning',
            'GetT2sPipeline',
            'CreateT2sPipeline',
            'DeleteT2sPipeline',
            'UpdateT2sPipeline',
            'ListT2sPipelines',
            'ListT2sLanguages',
            'ListT2sDomains',
            'ListT2sNormalizationPipelines',
            'GetCustomPhonemizer',
            'CreateCustomPhonemizer',
            'DeleteCustomPhonemizer',
            'UpdateCustomPhonemizer',
            'ListCustomPhonemizer',
            'GetServiceInfo',
        ] as $method) {
            yield $method => [$method];
        }
    }

    public function testABidirectionalStreamingMethodIsGenerated(): void
    {
        self::assertTrue(method_exists(Text2SpeechClient::class, 'StreamingSynthesize'));

        $reflected = new ReflectionMethod(Text2SpeechClient::class, 'StreamingSynthesize');
        // A bidi stream takes no request message - only $metadata and $options.
        self::assertSame(0, $reflected->getNumberOfRequiredParameters());
        self::assertSame(2, $reflected->getNumberOfParameters());
    }

    public function testTheGeneratedMethodSurfaceIsNotEmpty(): void
    {
        $methods = get_class_methods(Text2SpeechClient::class);

        self::assertContains('Synthesize', $methods);
        self::assertContains('StreamingSynthesize', $methods);
        // The unary RPCs, the streaming one and the constructor - plus whatever \Grpc\BaseStub
        // contributes, which is why this is a lower bound rather than an equality.
        self::assertGreaterThanOrEqual(
            self::UNARY_METHOD_COUNT + 2,
            count($methods),
            'Text2SpeechClient exposes fewer methods than ondewo.t2s.Text2Speech declares RPCs'
            . ' - the service proto may not have been compiled'
        );
    }

    private function open(BaseStub $client): BaseStub
    {
        $this->openClients[] = $client;

        return $client;
    }
}
