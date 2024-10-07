<?php

declare(strict_types=1);

namespace ProjetNormandie\TwitchBundle\Controller\Stream;

use Doctrine\ORM\NonUniqueResultException;
use ProjetNormandie\TwitchBundle\DataProvider\TwitchItemDataProvider;
use ProjetNormandie\TwitchBundle\Model\Twitch\Stream;
use ProjetNormandie\TwitchBundle\Repository\ChannelRepository;
use ProjetNormandie\TwitchBundle\Serializer\SerializerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetStreams extends AbstractController
{

    public function __construct(
        private readonly TwitchItemDataProvider $twitchItemDataProvider,
        private readonly ChannelRepository $channelRepository,
    ) {
    }

    /**
     * @return array
     * @throws NonUniqueResultException
     */
    public function __invoke(): array
    {
        $channels = $this->channelRepository->findAll();

        $streams = [];
        foreach ($channels as $channel) {
            $response = $this->twitchItemDataProvider->getStream($channel->getUsername());
            $data = json_decode($response->getBody()->getContents())->data;
            if (count($data) === 0) {
                continue;
            }

            $stream = $data[0];
            $serializer = SerializerRegistry::getSerializer();
            $serialized = $serializer->serialize($stream, 'json');
            $deserialized = $serializer->deserialize($serialized, Stream::class, 'json');
            $streams[] = $deserialized;
        }

        return $streams;
    }
}
