<?php

namespace IgniteYourProject\ApiAuthenticationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('iyp_api_authentication');

        $this->addAllowedUsersSection($rootNode);
        return $treeBuilder;
    }

    /**
     * Add Allowed Users section to configuration tree
     *
     * @param ArrayNodeDefinition $node
     */
    private function addAllowedUsersSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('allowed_users')
                        ->prototype('array')
                        ->children()
                            ->scalarNode('name')->isRequired()->end()
                        ->end()
                        ->children()
                            ->scalarNode('token')->isRequired()->end()
                        ->end()
                ->end()
            ->end()
        ;
    }
}
