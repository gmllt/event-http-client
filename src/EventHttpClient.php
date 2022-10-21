<?php

/**
 * This file is part of the gmllt/event-http-client package.
 *
 * (c) Gilles MIRAILLET <g.miraillet@gmail.com>
 *
 * For full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gmllt\EventHttpClient;

use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Symfony\Contracts\HttpClient\ResponseStreamInterface;

/**
 * @author Gilles MIRAILLET <g.miraillet@gmail.com>
 */
class EventHttpClient implements HttpClientInterface
{
    /**
     * @param HttpClientInterface $httpClient Http client
     * @param EventDispatcherInterface[] $dispatchers Dispatchers
     */
    public function __construct(
        protected HttpClientInterface $httpClient,
        protected array $dispatchers = []
    ) {
    }

    public function request(string $method, string $url, array $options = []): EventResponse
    {
        return new EventResponse($this->httpClient->request($method, $url, $options), $this->dispatchers);
    }

    public function stream(iterable|ResponseInterface $responses, float $timeout = null): ResponseStreamInterface
    {
        return $this->httpClient->stream($responses, $timeout);
    }

    public function withOptions(array $options): static
    {
        $this->httpClient->withOptions($options);
        return $this;
    }
}