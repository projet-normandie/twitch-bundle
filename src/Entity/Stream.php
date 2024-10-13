<?php

declare(strict_types=1);

namespace ProjetNormandie\TwitchBundle\Entity;

use ApiPlatform\Metadata\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use ProjetNormandie\TwitchBundle\Repository\StreamRepository;

#[ORM\Table(name: 'pnt_stream')]
#[ORM\Entity(repositoryClass: StreamRepository::class)]
class Stream
{
    #[ApiProperty(identifier: true)]
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    protected ?int $id = null;

    #[ORM\Column(length: 20, unique: true)]
    protected string $externalId;

    #[ORM\ManyToOne(targetEntity: Game::class, inversedBy: 'streams')]
    #[ORM\JoinColumn(name:'game_id', referencedColumnName:'id', nullable:true)]
    private ?Game $game;

    #[ORM\ManyToOne(targetEntity: Channel::class, inversedBy: 'streams')]
    #[ORM\JoinColumn(name:'channel_id', referencedColumnName:'id', nullable:false)]
    private Channel $channel;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $startedAt = null;

    #[ORM\Column(length: 255, nullable: false)]
    protected string $title;

    #[ORM\Column(length: 50, nullable: true)]
    protected ?string $type;

    #[ORM\Column(nullable: false)]
    protected int $viewerCount;

    #[ORM\Column(length: 10, nullable: false)]
    protected string $language;

    /**
     * @var array<string>
     */
    #[ORM\Column(type: 'array', nullable: false)]
    private array $tags = [];

    private bool $isMature = false;

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): void
    {
        $this->game = $game;
    }

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

    public function getChannel(): Channel
    {
        return $this->channel;
    }

    public function setChannel(Channel $channel): void
    {
        $this->channel = $channel;
    }

    public function getStartedAt(): ?\DateTime
    {
        return $this->startedAt;
    }

    public function setStartedAt(?\DateTime $startedAt): void
    {
        $this->startedAt = $startedAt;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public function getViewerCount(): int
    {
        return $this->viewerCount;
    }

    public function setViewerCount(int $viewerCount): void
    {
        $this->viewerCount = $viewerCount;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    public function isMature(): bool
    {
        return $this->isMature;
    }

    public function setIsMature(bool $isMature): void
    {
        $this->isMature = $isMature;
    }

    public function __toString(): string
    {
        return sprintf('Stream [%d]', $this->id);
    }
}

