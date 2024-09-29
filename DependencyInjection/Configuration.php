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
                ->scalarNode('ffmpeg_binary')
                    ->defaultValue('/usr/bin/ffmpeg')
                    ->info('Path to the ffmpeg binary')
                ->end()

                ->scalarNode('ffprobe_binary')
                    ->defaultValue('/usr/bin/ffprobe')
                    ->info('Path to the ffprobe binary')
                ->end()

                ->integerNode('binary_timeout')
                    ->defaultValue(300)
                    ->info('Maximum execution time for ffmpeg/ffprobe binaries. Use 0 for infinite.')
                ->end()

                ->integerNode('threads_count')
                    ->defaultValue(4)
                    ->info('Number of threads used by ffmpeg')
                ->end()

                ->scalarNode('temporary_directory')
                    ->defaultValue('%kernel.cache_dir%/ffmpeg')
                    ->info('Temporary directory used by ffmpeg')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
