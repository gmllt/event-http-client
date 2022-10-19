<?php

/**
 * This file is part of the gmllt/event-http-client package.
 *
 * (c) Gilles Miraillet <g.miraillet@gmail.com>
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
 * @author Gilles Miraillet <g.miraillet@gmail.com>
 */
class HttpClient implements HttpClientInterface
{
    public function __construct(
        protected HttpClientInterface $client,
        protected EventDispatcherInterface $dispatcher
    ) {
    }

    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
        return new Response($this->client->request($method, $url, $options), $this->dispatcher);
    }

    public function stream(iterable|ResponseInterface $responses, float $timeout = null): ResponseStreamInterface
    {
        $this->client->stream($responses, $timeout);
    }

    public function withOptions(array $options): static
    {
        $this->client->withOptions($options);
    }
}