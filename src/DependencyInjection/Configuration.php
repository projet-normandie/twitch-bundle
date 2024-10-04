<?php

declare(strict_types=1);

namespace ProjetNormandie\TwitchBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('projet_normandie_twitch');
        $treeBuilder->getRootNode()
            ->children()
                ->scalarNode('client_id')->defaultValue(null)->end()
                ->scalarNode('client_secret')->defaultValue(null)->end()
            ->end();
        return $treeBuilder;
    }
}
