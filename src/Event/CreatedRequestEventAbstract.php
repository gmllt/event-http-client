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

use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * @author Gilles MIRAILLET <g.miraillet@gmail.com>
 */
class CreatedRequestEventAbstract extends AbstractResponseEvent
{
    public const NAME = 'event_http_client.created_request';
}