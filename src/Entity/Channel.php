<?php

declare(strict_types=1);

namespace ProjetNormandie\TwitchBundle\Entity;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\ORM\Mapping as ORM;
use ProjetNormandie\TwitchBundle\Controller\Channel\GetStream;
use ProjetNormandie\TwitchBundle\Repository\ChannelRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name:'pnt_channel')]
#[ORM\Entity(repositoryClass: ChannelRepository::class)]
#[ApiResource(
    order: ['name' => 'ASC'],
    routePrefix: '/twitch',
    operations: [
        new GetCollection(),
        new Get(),
        new Get(
            uriTemplate: '/channels/{id}/get-stream',
            controller: GetStream::class,
        ),
    ],
    normalizationContext: ['groups' => ['twitch:read']
    ]
)]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'id' => 'exact',
        'isCommunity' => 'exact',
    ]
)]
#[ApiFilter(
    OrderFilter::class,
    properties: [
        'id' => 'ASC',
        'name' => 'ASC',
    ]
)]
class Channel
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private int $id;

    #[Groups(['twitch:read'])]
    #[Assert\Length(max: 255)]
    #[ORM\Column(length: 255, nullable: false)]
    private string $name;

    #[Groups(['twitch:read'])]
    #[Assert\Length(max: 255)]
    #[ORM\Column(length: 255, nullable: false, unique: true)]
    private string $username;

    #[Groups(['twitch:read'])]
    #[ORM\Column]
    private bool $isCommunity = false;

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

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    #[Groups(['twitch:read'])]
    public function getInitial(): string
    {
        return substr($this->name, 0, 1);
    }

    public function isCommunity(): bool
    {
        return $this->isCommunity;
    }

    public function setIsCommunity(bool $isCommunity): void
    {
        $this->isCommunity = $isCommunity;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
