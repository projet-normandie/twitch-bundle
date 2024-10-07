<?php

declare(strict_types=1);

namespace ProjetNormandie\TwitchBundle\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ProjetNormandie\TwitchBundle\Controller\Stream\GetStreams;

#[ApiResource(
    routePrefix: '/twitch',
    operations: [
        new Get(
            uriTemplate: '/get-streams',
            controller: GetStreams::class,
            read: false,
        )
    ],
)]

class Stream
{
}
