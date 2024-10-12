<?php

declare(strict_types=1);

namespace ProjetNormandie\TwitchBundle\Scheduler\Handler;

use DateMalformedStringException;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use ProjetNormandie\TwitchBundle\DataProvider\TwitchItemDataProvider;
use ProjetNormandie\TwitchBundle\Entity\Channel;
use ProjetNormandie\TwitchBundle\Entity\Game;
use ProjetNormandie\TwitchBundle\Entity\Stream;
use ProjetNormandie\TwitchBundle\Scheduler\Message\UpdateStream;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;


#[AsMessageHandler]
readonly class UpdateStreamHandler
{
    public function __construct(
        private EntityManagerInterface $em,
        private TwitchItemDataProvider $twitchItemDataProvider,
    ) {
    }

    /**
     * @throws DateMalformedStringException
     */
    public function __invoke(UpdateStream $message): void
    {
        $channels = $this->em->getRepository(Channel::class)->findAll();

        $usernames = [];
        foreach ($channels as $channel) {
            $usernames[] = $channel->getUsername();
        }

        $response = $this->twitchItemDataProvider->getStreams($usernames);
        $data = json_decode($response->getBody()->getContents())->data;
        if (count($data) === 0) {
            return;
        }

        foreach ($data as $twicthStream) {
            $findStream = $this->em->getRepository(Stream::class)->findOneBy(['externalId' => $twicthStream->id]);


            if ($findStream) {
                if ($twicthStream->viewer_count > $findStream->getViewerCount()) {
                    $findStream->setViewerCount((int) $twicthStream->viewer_count);
                    $this->em->flush();
                }
                continue;
            }

            // Game
            $game = $this->em->getRepository(Game::class)->findOneBy(['externalId' => $twicthStream->game_id]);
            if (null == $game) {
                $game = new Game();
                $game->setExternalId($twicthStream->game_id);
                $game->setName($twicthStream->game_name);
                $this->em->persist($game);
            }
            $game->setLastStreamAt(new DateTime());
            $this->em->flush();

            $entityStream = new Stream();
            $entityStream->setGame($game);
            $entityStream->setChannel($this->em->getRepository(Channel::class)->findOneBy(['username' => $twicthStream->user_login]));
            $entityStream->setExternalId($twicthStream->id);
            $entityStream->setTitle($twicthStream->title);
            $entityStream->setType($twicthStream->type);
            $entityStream->setStartedAt(new DateTime($twicthStream->started_at));
            $entityStream->setViewerCount((int) $twicthStream->viewer_count);
            $entityStream->setLanguage($twicthStream->language);
            $entityStream->setTags($twicthStream->tags);
            $entityStream->setIsMature($twicthStream->is_mature);
            $this->em->persist($entityStream);
            $this->em->flush();
        }
    }
}
