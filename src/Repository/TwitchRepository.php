<?php

declare(strict_types=1);

namespace ProjetNormandie\TwitchBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use ProjetNormandie\TwitchBundle\Entity\Twitch;

class TwitchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Twitch::class);
    }
}
