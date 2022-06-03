Symfony ffmpeg bundle
=====================

[![Latest Stable Version](https://poser.pugx.org/fmonts/ffmpeg-bundle/v/stable.svg)](https://packagist.org/packages/fmonts/ffmpeg-bundle) [![Total Downloads](https://poser.pugx.org/fmonts/ffmpeg-bundle/downloads.svg)](https://packagist.org/packages/fmonts/ffmpeg-bundle) [![Latest Unstable Version](https://poser.pugx.org/fmonts/ffmpeg-bundle/v/unstable.svg)](https://packagist.org/packages/fmonts/ffmpeg-bundle) [![License](https://poser.pugx.org/fmonts/ffmpeg-bundle/license.svg)](https://packagist.org/packages/fmonts/ffmpeg-bundle)

This bundle provides a simple wrapper for the [PHP_FFmpeg](https://github.com/alchemy-fr/PHP-FFmpeg) library,
exposing the library as a Symfony service.

#### This fork adds Symfony4 and Symfony5 support and drops legacy Symfony2 and PHP5 support ####

### Download FFmpegBundle using composer

Require the bundle with composer:

```bash
$ composer require fmonts/ffmpeg-bundle "^0.7"
```

Composer will install the bundle to your project's ``vendor/fmonts/ffmpeg-bundle`` directory.

### Enable the bundle

Enable the bundle in the kernel
> Note: In a default Symfony application that uses Symfony Flex, bundles are enabled/disabled automatically for you when installing/removing them, so you don't need to look at or edit this bundles.php file.

```php
<?php
// config/bundles.php

return [
    // ...
    Dubture\FFmpegBundle\DubtureFFmpegBundle::class => ['all' => true],
];
```

### Configuration

Configure which ffmpeg binary to use in `packages/dubture_f_fmpeg.yaml` or in your `parameters.yaml` file:

```yaml
dubture_f_fmpeg:
  ffmpeg_binary: /usr/bin/ffmpeg
  ffprobe_binary: /usr/bin/ffprobe
  binary_timeout: 300 # Use 0 for infinite
  threads_count: 4
  temporary_directory: /var/ffmpeg-tmp
```

> Note: The `temporary_directory` key is only used for writing [two-pass logs](https://ffmpeg.org/ffmpeg.html#Video-Options).

### Usage

```php
$ffmpeg = $this->get('dubture_ffmpeg.ffmpeg');

// Open video
$video = $ffmpeg->open('/your/source/folder/input.avi');

// Resize to 1280x720
$video
  ->filters()
  ->resize(new Dimension(1280, 720), ResizeFilter::RESIZEMODE_INSET)
  ->synchronize();

// Start transcoding and save video
$video->save(new X264(), '/your/target/folder/video.mp4');
```
