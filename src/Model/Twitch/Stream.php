<?php

declare(strict_types=1);

namespace ProjetNormandie\TwitchBundle\Model\Twitch;

use DateTime;

class Stream implements \JsonSerializable
{
    private ?string $id = null;
    private string $username = '';
    private string $gameId = '';
    private string $gameName = '';
    private string $type = '';
    private string $title = '';
    private string $viewerCount = '';
    private ?DateTime $startedAt = null;
    private string $language = 'en';
    private string $thumnailUrl = '';
    private array $tagIds = [];
    private array $tags = [];
    private bool $isMature = true;

    public function getGameName(): string
    {
        return $this->gameName;
    }

    public function setGameName(string $gameName): void
    {
        $this->gameName = $gameName;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getGameId(): string
    {
        return $this->gameId;
    }

    public function setGameId(string $gameId): void
    {
        $this->gameId = $gameId;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getViewerCount(): string
    {
        return $this->viewerCount;
    }

    public function setViewerCount(string $viewerCount): void
    {
        $this->viewerCount = $viewerCount;
    }

    public function getStartedAt(): ?DateTime
    {
        return $this->startedAt;
    }

    public function setStartedAt(mixed $startedAt): void
    {

        if (is_string($startedAt)) {
            $this->startedAt = new DateTime($startedAt);
        } else {
            $this->startedAt = $startedAt;
        }
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    public function getThumnailUrl(): string
    {
        return $this->thumnailUrl;
    }

    public function setThumnailUrl(string $thumnailUrl): void
    {
        $this->thumnailUrl = $thumnailUrl;
    }

    public function getTagIds(): array
    {
        return $this->tagIds;
    }

    public function setTagIds(array $tagIds): void
    {
        $this->tagIds = $tagIds;
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


    /**
     * @return array<mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'user_name' => $this->username,
            'game_id' => $this->gameId,
            'game_name' => $this->gameName,
            'type' => $this->type,
            'title' => $this->title,
            'viewer_count' => $this->viewerCount,
            'started_at' => $this->startedAt !== null ?? $this->startedAt->format('Y-m-d H:i:s'),
            'language' => $this->language,
            'thumnail_url' => $this->thumnailUrl,
            'tag_ids' => $this->tagIds,
            'tags' => $this->tags,
            'is_mature' => $this->isMature,
        ];
    }
}