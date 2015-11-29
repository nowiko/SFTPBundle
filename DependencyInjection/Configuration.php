<?php

namespace SF2Helpers\SFTPBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;


class Configuration implements ConfigurationInterface
{
    /**
     * Generate the configuration tree.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sleepness_uber_translation');
        $rootNode
            ->children()
                ->arrayNode('memcached')
                    ->children()
                        ->scalarNode('host')->end()
                        ->integerNode('port')->end()
                    ->end()
                ->end()
                ->arrayNode('supported_locales')
                    ->defaultValue(array('en'))
                    ->prototype('scalar')
                ->end()
        ;

        return $treeBuilder;
    }
}
