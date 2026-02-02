<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services->set('dubture_ffmpeg.ffmpeg', 'FFMpeg\\FFMpeg')
        ->lazy()
        ->factory(['FFMpeg\\FFMpeg', 'create'])
        ->args([
            [
                'ffmpeg.binaries' => '%dubture_ffmpeg.binary%',
                'ffprobe.binaries' => '%dubture_ffprobe.binary%',
                'timeout' => '%dubture_ffmpeg.binary_timeout%',
                'ffmpeg.threads' => '%dubture_ffmpeg.threads_count%',
                'temporary_directory' => '%dubture_ffmpeg.temporary_directory%',
            ],
            new Reference('logger'),
        ]);

    $services->set('dubture_ffmpeg.ffprobe', 'FFMpeg\\FFProbe')
        ->lazy()
        ->factory(['FFMpeg\\FFProbe', 'create'])
        ->args([
            [
                'ffmpeg.binaries' => '%dubture_ffmpeg.binary%',
                'ffprobe.binaries' => '%dubture_ffprobe.binary%',
            ],
            new Reference('logger'),
        ]);
};
