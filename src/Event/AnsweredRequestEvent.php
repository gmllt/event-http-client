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

/**
 * @author Gilles MIRAILLET <g.miraillet@gmail.com>
 */
class AnsweredRequestEvent extends AbstractResponseEvent
{
    public const NAME = 'event_http_client.answered_request';
}