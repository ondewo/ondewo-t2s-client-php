<?php
// GENERATED CODE -- DO NOT EDIT!

// Original file comments:
// Copyright 2020 ONDEWO GmbH
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//     http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.
//
namespace Ondewo\T2s;

/**
 * <p>Text2Speech service provides endpoints for text-to-speech generation.</p>
 */
class Text2SpeechClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * <p>Synthesizes a specific text sent in the request with the provided configuration requirements
     * and retrieves a response that includes the synthesized text as audio and the requested configuration.</p>
     * @param \Ondewo\T2s\SynthesizeRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function Synthesize(\Ondewo\T2s\SynthesizeRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/ondewo.t2s.Text2Speech/Synthesize',
        $argument,
        ['\Ondewo\T2s\SynthesizeResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * <p>Performs batch synthesis by accepting a batch of synthesis requests and returning a batch response.
     * This can be more efficient for generating predictions on the AI model in bulk.</p>
     * @param \Ondewo\T2s\BatchSynthesizeRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function BatchSynthesize(\Ondewo\T2s\BatchSynthesizeRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/ondewo.t2s.Text2Speech/BatchSynthesize',
        $argument,
        ['\Ondewo\T2s\BatchSynthesizeResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * <p>Performs streaming synthesis by accepting stream of input text and returning a stream of generated audio.</p>
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\BidiStreamingCall
     */
    public function StreamingSynthesize($metadata = [], $options = []) {
        return $this->_bidiRequest('/ondewo.t2s.Text2Speech/StreamingSynthesize',
        ['\Ondewo\T2s\StreamingSynthesizeResponse','decode'],
        $metadata, $options);
    }

    /**
     * <p>Normalizes a text according to the specific pipeline&apos;s normalization rules.</p>
     * @param \Ondewo\T2s\NormalizeTextRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function NormalizeText(\Ondewo\T2s\NormalizeTextRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/ondewo.t2s.Text2Speech/NormalizeText',
        $argument,
        ['\Ondewo\T2s\NormalizeTextResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * <p>Retrieves the configuration of the specified text-to-speech pipeline.</p>
     * @param \Ondewo\T2s\T2sPipelineId $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function GetT2sPipeline(\Ondewo\T2s\T2sPipelineId $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/ondewo.t2s.Text2Speech/GetT2sPipeline',
        $argument,
        ['\Ondewo\T2s\Text2SpeechConfig', 'decode'],
        $metadata, $options);
    }

    /**
     * <p>Creates a new text-to-speech pipeline with the provided configuration and returns its pipeline ID.</p>
     * @param \Ondewo\T2s\Text2SpeechConfig $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function CreateT2sPipeline(\Ondewo\T2s\Text2SpeechConfig $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/ondewo.t2s.Text2Speech/CreateT2sPipeline',
        $argument,
        ['\Ondewo\T2s\T2sPipelineId', 'decode'],
        $metadata, $options);
    }

    /**
     * <p>Deletes the specified text-to-speech pipeline.</p>
     * @param \Ondewo\T2s\T2sPipelineId $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function DeleteT2sPipeline(\Ondewo\T2s\T2sPipelineId $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/ondewo.t2s.Text2Speech/DeleteT2sPipeline',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * <p>Updates the specified text-to-speech pipeline with the given configuration.</p>
     * @param \Ondewo\T2s\Text2SpeechConfig $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function UpdateT2sPipeline(\Ondewo\T2s\Text2SpeechConfig $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/ondewo.t2s.Text2Speech/UpdateT2sPipeline',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * <p>Retrieves a list of text-to-speech pipelines based on specific requirements.</p>
     * @param \Ondewo\T2s\ListT2sPipelinesRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function ListT2sPipelines(\Ondewo\T2s\ListT2sPipelinesRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/ondewo.t2s.Text2Speech/ListT2sPipelines',
        $argument,
        ['\Ondewo\T2s\ListT2sPipelinesResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * <p>Retrieves a list of languages available based on specific configuration requirements.</p>
     * @param \Ondewo\T2s\ListT2sLanguagesRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function ListT2sLanguages(\Ondewo\T2s\ListT2sLanguagesRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/ondewo.t2s.Text2Speech/ListT2sLanguages',
        $argument,
        ['\Ondewo\T2s\ListT2sLanguagesResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * <p>Retrieves a list of domains available based on specific configuration requirements.</p>
     * @param \Ondewo\T2s\ListT2sDomainsRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function ListT2sDomains(\Ondewo\T2s\ListT2sDomainsRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/ondewo.t2s.Text2Speech/ListT2sDomains',
        $argument,
        ['\Ondewo\T2s\ListT2sDomainsResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * <p>Retrieves a list of normalization pipelines based on specific requirements.</p>
     * @param \Ondewo\T2s\ListT2sNormalizationPipelinesRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function ListT2sNormalizationPipelines(\Ondewo\T2s\ListT2sNormalizationPipelinesRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/ondewo.t2s.Text2Speech/ListT2sNormalizationPipelines',
        $argument,
        ['\Ondewo\T2s\ListT2sNormalizationPipelinesResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * <p>Retrieves the version information of the running text-to-speech server.</p>
     * @param \Google\Protobuf\GPBEmpty $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function GetServiceInfo(\Google\Protobuf\GPBEmpty $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/ondewo.t2s.Text2Speech/GetServiceInfo',
        $argument,
        ['\Ondewo\T2s\T2SGetServiceInfoResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * <p>Retrieves a custom phonemizer based on the provided PhonemizerId.</p>
     * @param \Ondewo\T2s\PhonemizerId $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function GetCustomPhonemizer(\Ondewo\T2s\PhonemizerId $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/ondewo.t2s.Text2Speech/GetCustomPhonemizer',
        $argument,
        ['\Ondewo\T2s\CustomPhonemizerProto', 'decode'],
        $metadata, $options);
    }

    /**
     * <p>Creates a custom phonemizer based on the provided CreateCustomPhonemizerRequest.
     * Returns the PhonemizerId associated with the created custom phonemizer.</p>
     * @param \Ondewo\T2s\CreateCustomPhonemizerRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function CreateCustomPhonemizer(\Ondewo\T2s\CreateCustomPhonemizerRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/ondewo.t2s.Text2Speech/CreateCustomPhonemizer',
        $argument,
        ['\Ondewo\T2s\PhonemizerId', 'decode'],
        $metadata, $options);
    }

    /**
     * <p>Deletes a custom phonemizer based on the provided PhonemizerId.
     * Returns an Empty response upon successful deletion.</p>
     * @param \Ondewo\T2s\PhonemizerId $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function DeleteCustomPhonemizer(\Ondewo\T2s\PhonemizerId $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/ondewo.t2s.Text2Speech/DeleteCustomPhonemizer',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * <p>Updates the specified custom phonemizer with the provided configuration.</p>
     * @param \Ondewo\T2s\UpdateCustomPhonemizerRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function UpdateCustomPhonemizer(\Ondewo\T2s\UpdateCustomPhonemizerRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/ondewo.t2s.Text2Speech/UpdateCustomPhonemizer',
        $argument,
        ['\Ondewo\T2s\CustomPhonemizerProto', 'decode'],
        $metadata, $options);
    }

    /**
     * <p>Retrieves a list of custom phonemizers based on specific requirements.</p>
     * @param \Ondewo\T2s\ListCustomPhonemizerRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function ListCustomPhonemizer(\Ondewo\T2s\ListCustomPhonemizerRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/ondewo.t2s.Text2Speech/ListCustomPhonemizer',
        $argument,
        ['\Ondewo\T2s\ListCustomPhonemizerResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * <p>Clones a voice based on a sample audio of the speaker and its transcription.
     * The cloned voice can afterwards be used for synthesis by referencing the given speaker name.</p>
     * @param \Ondewo\T2s\VoiceCloningRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function VoiceCloning(\Ondewo\T2s\VoiceCloningRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/ondewo.t2s.Text2Speech/VoiceCloning',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

}
