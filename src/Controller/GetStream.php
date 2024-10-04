<?php

declare(strict_types=1);

namespace ProjetNormandie\TwitchBundle\Controller;

use GuzzleHttp\Exception\GuzzleException;
use ProjetNormandie\TwitchBundle\DataProvider\TwitchItemDataProvider;
use ProjetNormandie\TwitchBundle\Entity\Twitch;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetStream extends AbstractController
{
    public function __construct(
        private readonly TwitchItemDataProvider $twitchItemDataProvider
    ) {
    }


    /**
     * @param Twitch $twitch
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function __invoke(Twitch $twitch): JsonResponse
    {
        $response = $this->twitchItemDataProvider->getStream($twitch->getChannel());
        return json_decode($response->getBody()->getContents());
    }
}
