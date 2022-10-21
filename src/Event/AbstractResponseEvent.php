<?php

/**
 * This file is part of the gmllt/event-http-client package.
 *
 * (c) Gilles MIRAILLET <g.miraillet@gmail.com>
 *
 * For full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gmllt\EventHttpClient\Event;

use Psr\EventDispatcher\StoppableEventInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * @author Gilles MIRAILLET <g.miraillet@gmail.com>
 */
abstract class AbstractResponseEvent implements StoppableEventInterface
{
    protected bool $propagationStopped = false;

    /**
     * {@inheritdoc}
     */
    public function isPropagationStopped(): bool
    {
        return $this->propagationStopped;
    }

    /**
     * Stops the propagation of the event to further event listeners.
     *
     * If multiple event listeners are connected to the same event, no
     * further event listener will be triggered once any trigger calls
     * stopPropagation().
     */
    public function stopPropagation(): void
    {
        $this->propagationStopped = true;
    }

    public function __construct(
        protected ResponseInterface $response
    ) {
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}