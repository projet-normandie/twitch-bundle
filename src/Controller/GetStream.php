<?php

declare(strict_types=1);

namespace ProjetNormandie\TwitchBundle\Controller;

use ProjetNormandie\TwitchBundle\DataProvider\TwitchItemDataProvider;
use ProjetNormandie\TwitchBundle\Entity\Channel;
use ProjetNormandie\TwitchBundle\Model\Twitch\Stream;
use ProjetNormandie\TwitchBundle\Serializer\SerializerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetStream extends AbstractController
{
    public function __construct(
        private readonly TwitchItemDataProvider $twitchItemDataProvider
    ) {
    }


    /**
     * @param Channel $twitch
     * @return JsonResponse
     */
    public function __invoke(Channel $twitch): JsonResponse
    {
        $response = $this->twitchItemDataProvider->getStream($twitch->getUsername());
        $data = json_decode($response->getBody()->getContents())->data;
        if (count($data) === 0) {
            return new JsonResponse(new Stream());
        }

        $stream = $data[0];
        $serializer = SerializerRegistry::getSerializer();
        $serialized = $serializer->serialize($stream, 'json');
        $deserialized = $serializer->deserialize($serialized, Stream::class, 'json');

        return new JsonResponse($deserialized);
    }
}
