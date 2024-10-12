<?php

declare(strict_types=1);

namespace ProjetNormandie\TwitchBundle\Entity;

use ApiPlatform\Metadata\ApiProperty;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use ProjetNormandie\TwitchBundle\Repository\GameRepository;

#[ORM\Table(name:'pnt_game')]
#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ApiProperty(identifier: true)]
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    protected ?int $id = null;

    #[ORM\Column(length: 20, unique: true)]
    protected string $externalId;

    #[ORM\Column(length: 255, nullable: false)]
    private string $name = '';

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $url = null;

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
