<?php

declare(strict_types=1);

namespace ProjetNormandie\TwitchBundle\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\ORM\Mapping as ORM;
use ProjetNormandie\TwitchBundle\Controller\GetStream;
use ProjetNormandie\TwitchBundle\Repository\TwitchRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name:'pnt_twitch')]
#[ORM\Entity(repositoryClass: TwitchRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
        new Get(
            uriTemplate: '/twitches/{id}/get-stream',
            controller: GetStream::class,
        ),
    ],
    normalizationContext: ['groups' => ['twitch:read']
    ]
)]
class Twitch
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private int $id;

    #[Groups(['twitch:read'])]
    #[Assert\Length(max: 255)]
    #[ORM\Column(length: 255, nullable: false)]
    private string $name;

    #[Groups(['twitch:read'])]
    #[Assert\Length(max: 255)]
    #[ORM\Column(length: 255, nullable: false)]
    private string $channel;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getChannel(): string
    {
        return $this->channel;
    }

    public function setChannel(string $channel): void
    {
        $this->channel = $channel;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
