<?php

namespace ProjetNormandie\TwitchBundle\State;

use ProjetNormandie\TwitchBundle\Entity\Twitch;
use ApiPlatform\State\ProviderInterface;
use ApiPlatform\Metadata\Operation;

final class TwitchGetProvider implements ProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = [])
    {
        return new Twitch($uriVariables['id']);
    }
}