<?php

namespace Dubture\FFmpegBundle\Tests\Unit\DependencyInjection;

use Dubture\FFmpegBundle\DependencyInjection\Configuration;
use Dubture\FFmpegBundle\DependencyInjection\DubtureFFmpegExtension;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionConfigurationTestCase;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

/**
 * Test the configuration parsed from YAML.
 *
 * @author Patrik Karisch <patrik@karisch.guru>
 */
class ConfigurationTest extends AbstractExtensionConfigurationTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function getContainerExtension(): ExtensionInterface
    {
        return new DubtureFFmpegExtension();
    }

    /**
     * {@inheritDoc}
     */
    protected function getConfiguration(): ConfigurationInterface
    {
        return new Configuration();
    }

    public function testProcessedMinimumConfigurationContainsAllValues()
    {
        $expectedConfiguration = array(
            'ffmpeg_binary' => '/usr/local/bin/ffmpeg',
            'ffprobe_binary' => '/usr/local/bin/ffprobe',
            'binary_timeout' => 300,
            'threads_count' => 4,
            'temporary_directory' => '%kernel.cache_dir%/ffmpeg'
        );

        $sources = array(
            __DIR__.'/../../Fixtures/minimum.yml',
        );

        $this->assertProcessedConfigurationEquals(
            $expectedConfiguration,
            $sources
        );
    }

    public function testProcessedAllConfigurationContainsAllValues()
    {
        $expectedConfiguration = array(
            'ffmpeg_binary' => '/usr/local/bin/ffmpeg',
            'ffprobe_binary' => '/usr/local/bin/ffprobe',
            'binary_timeout' => 300,
            'threads_count' => 2,
            'temporary_directory' => '/var/ffmpeg-tmp'
        );

        $sources = array(
            __DIR__.'/../../Fixtures/all.yml',
        );

        $this->assertProcessedConfigurationEquals($expectedConfiguration, $sources);
    }
}
