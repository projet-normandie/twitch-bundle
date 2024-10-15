<?php

declare(strict_types=1);

namespace ProjetNormandie\TwitchBundle\Entity;


use ApiPlatform\Doctrine\Orm\Filter\ExistsFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use ProjetNormandie\TwitchBundle\Repository\GameRepository;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Table(name:'pnt_game')]
#[ORM\Entity(repositoryClass: GameRepository::class)]
#[ApiResource(
    routePrefix: '/twitch',
    operations: [
        new GetCollection(),
        new Get()
    ],
    normalizationContext: ['groups' => ['game:read']]
)]
#[ApiFilter(
    OrderFilter::class,
    properties: [
        'lastStreamAt' => 'DESC',
    ]
)]
#[ApiFilter(ExistsFilter::class, properties: ['picture'])]
class Game
{
    #[ApiProperty(identifier: true)]
    #[Groups(['game:read'])]
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    protected ?int $id = null;

    #[ORM\Column(length: 20, unique: true)]
    protected string $externalId;

    #[Groups(['game:read'])]
    #[ORM\Column(length: 255, nullable: false)]
    private string $name = '';

    #[Groups(['game:read'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[Groups(['game:read'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $url = null;

    #[Groups(['game:read'])]
    #[ORM\Column(nullable: false)]
    private DateTime $lastStreamAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }

    public function setExternalId(string $externalId): void
    {
        $this->externalId = $externalId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): void
    {
        $this->picture = $picture;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    public function getLastStreamAt(): DateTime
    {
        return $this->lastStreamAt;
    }

    public function setLastStreamAt(DateTime $lastStreamAt): void
    {
        $this->lastStreamAt = $lastStreamAt;
    }

    public function __toString()
    {
        return sprintf('%s (%d)', $this->getName(), $this->getId());
    }
}
