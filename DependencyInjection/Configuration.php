<?php

namespace Dubture\FFmpegBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('dubture_f_fmpeg');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode('ffmpeg_binary')->isRequired()->end()
                ->scalarNode('ffprobe_binary')->isRequired()->end()
                ->scalarNode('binary_timeout')->defaultValue(60)->end()
                ->scalarNode('threads_count')->defaultValue(4)->end()
                ->scalarNode('temporary_directory')->defaultValue('')->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}
