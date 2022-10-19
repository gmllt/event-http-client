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

use Gmllt\EventHttpClient\Event\AnsweredRequestEvent;
use Gmllt\EventHttpClient\Event\CanceledRequestEventAbstract;
use Gmllt\EventHttpClient\Event\CreatedRequestEventAbstract;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * @author Gilles Miraillet <g.miraillet@gmail.com>
 */
class Response implements ResponseInterface
{
    public function __construct(
        protected ResponseInterface $response,
        protected EventDispatcherInterface $dispatcher
    ) {
        $this->dispatcher->dispatch(new CreatedRequestEventAbstract($this->response));
    }

    public function cancel(): void
    {
        $this->dispatcher->dispatch(new CanceledRequestEventAbstract($this->response));
        $this->response->cancel();
    }

    public function getInfo(string $type = null): mixed
    {
        return $this->response->getInfo($type);
    }

    public function getStatusCode(): int
    {
        $this->dispatcher->dispatch(new AnsweredRequestEvent($this->response));
        return $this->response->getStatusCode();
    }

    public function getHeaders(bool $throw = true): array
    {
        $this->dispatcher->dispatch(new AnsweredRequestEvent($this->response));
        return $this->response->getHeaders($throw);
    }

    public function getContent(bool $throw = true): string
    {
        $this->dispatcher->dispatch(new AnsweredRequestEvent($this->response));
        return $this->response->getContent($throw);
    }

    public function toArray(bool $throw = true): array
    {
        $this->dispatcher->dispatch(new AnsweredRequestEvent($this->response));
        return $this->response->toArray($throw);
    }
}