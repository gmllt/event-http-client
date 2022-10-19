<?php

/**
 * This file is part of the gmllt/event-http-client package.
 *
 * (c) Gilles Miraillet <g.miraillet@gmail.com>
 *
 * For full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gmllt\EventHttpClient\Event;

use Symfony\Contracts\EventDispatcher\Event;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * @author Gilles Miraillet <g.miraillet@gmail.com>
 */
abstract class AbstractResponseEvent extends Event
{
    public function __construct(
        protected ResponseInterface $response
    ) {
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}