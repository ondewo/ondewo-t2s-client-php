<?php

declare(strict_types=1);

namespace Ondewo\T2s\Tests\Generated;

use Ondewo\T2s\ListT2sPipelinesRequest;
use Ondewo\T2s\Qwen3TtsBase;
use Ondewo\T2s\RequestConfig;
use Ondewo\T2s\SynthesizeResponse;
use Ondewo\T2s\UpdateCustomPhonemizerRequest;
use Ondewo\T2s\UpdateCustomPhonemizerRequest\UpdateMethod;
use PHPUnit\Framework\TestCase;
use UnexpectedValueException;

/**
 * Wire-level exercise of the generated messages. These are the assertions that catch a broken
 * generator: a field that is declared but never written, a presence field that silently drops its
 * zero value, an enum whose zero constant moved.
 *
 * PRODUCT-SPECIFIC: the message and enum names below come from ondewo-t2s-api.
 */
final class MessageSerializationTest extends TestCase
{
    public function testAMessageSurvivesABinaryRoundTrip(): void
    {
        // Every float literal here is exactly representable in the 32-bit `float` the protos
        // declare, so the round trip is lossless and assertSame() on a float is legitimate.
        $config = new RequestConfig();
        $config->setT2SPipelineId('default_de');

        $response = new SynthesizeResponse();
        $response->setAudioUuid('6b2c8e5a-audio');
        $response->setAudio("RIFF\x00\x01\x02WAVE");
        $response->setGenerationTime(0.5);
        $response->setAudioLength(1.25);
        $response->setSampleRate(22050.0);
        $response->setText('hallo welt');
        $response->setNormalizedText('hallo welt');
        $response->setConfig($config);

        $bytes = $response->serializeToString();
        self::assertNotSame('', $bytes, 'a populated message serialised to zero bytes');

        $parsed = new SynthesizeResponse();
        $parsed->mergeFromString($bytes);

        self::assertSame('6b2c8e5a-audio', $parsed->getAudioUuid());
        // bytes is binary-safe and must survive unchanged.
        self::assertSame("RIFF\x00\x01\x02WAVE", $parsed->getAudio());
        self::assertSame(0.5, $parsed->getGenerationTime());
        self::assertSame(1.25, $parsed->getAudioLength());
        self::assertSame(22050.0, $parsed->getSampleRate());
        self::assertSame('hallo welt', $parsed->getText());
        self::assertSame('hallo welt', $parsed->getNormalizedText());

        self::assertTrue($parsed->hasConfig());
        self::assertSame('default_de', $parsed->getConfig()->getT2SPipelineId());

        // Byte-for-byte stability, which field-by-field getters alone would not prove.
        self::assertSame($bytes, $parsed->serializeToString());
    }

    public function testAnUnsetSubMessageStaysUnset(): void
    {
        $response = new SynthesizeResponse();
        $response->setText('no-config');

        self::assertFalse($response->hasConfig());
        self::assertNull($response->getConfig());

        $response->setConfig(new RequestConfig());
        self::assertTrue($response->hasConfig());

        $response->clearConfig();
        self::assertFalse($response->hasConfig());
    }

    public function testAProto3OptionalFieldKeepsItsZeroValueOnTheWire(): void
    {
        // The failure this guards against is the one that bit the Angular target: an explicit
        // presence field whose ZERO value is indistinguishable from "unset" and is therefore
        // never written, so a client cannot clear a string or send `0`.
        //
        // `RequestConfig.instruction` is the one proto3 `optional` scalar ondewo-t2s-api declares;
        // the neighbouring length_scale / sample_rate / use_cache fields get their presence from
        // real `oneof` wrappers instead, and are asserted below for the same zero-value bug.
        $config = new RequestConfig();
        $config->setT2SPipelineId('default_de');
        $config->setInstruction('');
        $config->setSampleRate(0);
        $config->setUseCache(false);

        self::assertTrue($config->hasInstruction());
        self::assertTrue($config->hasSampleRate());
        self::assertTrue($config->hasUseCache());

        $parsed = new RequestConfig();
        $parsed->mergeFromString($config->serializeToString());

        self::assertTrue($parsed->hasInstruction(), 'an explicitly set empty string was dropped on the wire');
        self::assertSame('', $parsed->getInstruction());
        self::assertTrue($parsed->hasSampleRate(), 'an explicitly set 0 was dropped on the wire');
        self::assertSame(0, $parsed->getSampleRate());
        self::assertTrue($parsed->hasUseCache(), 'an explicitly set false was dropped on the wire');
        self::assertFalse($parsed->getUseCache());

        // ... and an untouched presence field must stay absent.
        $untouched = new RequestConfig();
        self::assertFalse($untouched->hasInstruction());
        $reparsed = new RequestConfig();
        $reparsed->mergeFromString($untouched->serializeToString());
        self::assertFalse($reparsed->hasInstruction());
    }

    public function testAMessageSurvivesAJsonRoundTrip(): void
    {
        $request = new ListT2sPipelinesRequest();
        $request->setLanguages(['de', 'en']);
        $request->setSpeakerSexes(['female']);
        $request->setDomains(['medical']);

        $json = $request->serializeToJsonString();
        self::assertJson($json);

        $parsed = new ListT2sPipelinesRequest();
        $parsed->mergeFromJsonString($json);

        self::assertSame(['de', 'en'], iterator_to_array($parsed->getLanguages()));
        self::assertSame(['female'], iterator_to_array($parsed->getSpeakerSexes()));
        self::assertSame(['medical'], iterator_to_array($parsed->getDomains()));
    }

    public function testAnIntegerFieldSurvivesAJsonRoundTrip(): void
    {
        // Its own case because google/protobuf's PURE-PHP JSON parser range-checks every integer
        // with bccomp(): without ext-bcmath this dies with "Call to undefined function
        // Google\Protobuf\Internal\bccomp()" on the first int field it meets. The extension is a
        // `suggest` of google/protobuf, not a `require`, so nothing else would surface that.
        $base = new Qwen3TtsBase();
        $base->setModelName('qwen3-tts');
        $base->setLanguage('de');
        $base->setQwen3TtsServerHost('localhost');
        $base->setQwen3TtsServerPort(8080);

        $parsed = new Qwen3TtsBase();
        $parsed->mergeFromJsonString($base->serializeToJsonString());

        self::assertSame('qwen3-tts', $parsed->getModelName());
        self::assertSame('de', $parsed->getLanguage());
        self::assertSame('localhost', $parsed->getQwen3TtsServerHost());
        self::assertSame(8080, $parsed->getQwen3TtsServerPort());
    }

    public function testTheEnumZeroValueIsTheDefaultOfAFieldTypedByIt(): void
    {
        self::assertSame(0, UpdateMethod::extend_hard);
        self::assertSame('extend_hard', UpdateMethod::name(UpdateMethod::extend_hard));

        // The zero value must be requestable, i.e. it must be the DEFAULT of a field typed by it.
        self::assertSame(UpdateMethod::extend_hard, (new UpdateCustomPhonemizerRequest())->getUpdateMethod());

        // ... and a non-zero member must still survive the wire.
        $request = new UpdateCustomPhonemizerRequest();
        $request->setId('phonemizer-1');
        $request->setUpdateMethod(UpdateMethod::replace);

        $parsed = new UpdateCustomPhonemizerRequest();
        $parsed->mergeFromString($request->serializeToString());
        self::assertSame(UpdateMethod::replace, $parsed->getUpdateMethod());
    }

    public function testAnUnknownEnumMemberIsRejected(): void
    {
        $this->expectException(UnexpectedValueException::class);

        UpdateMethod::name(4242);
    }
}
