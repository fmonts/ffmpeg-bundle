Symfony FFmpeg bundle
=====================

[![Latest Stable Version](https://poser.pugx.org/fmonts/ffmpeg-bundle/v/stable.svg)](https://packagist.org/packages/fmonts/ffmpeg-bundle) [![Total Downloads](https://poser.pugx.org/fmonts/ffmpeg-bundle/downloads.svg)](https://packagist.org/packages/fmonts/ffmpeg-bundle) [![Latest Unstable Version](https://poser.pugx.org/fmonts/ffmpeg-bundle/v/unstable.svg)](https://packagist.org/packages/fmonts/ffmpeg-bundle) [![License](https://poser.pugx.org/fmonts/ffmpeg-bundle/license.svg)](https://packagist.org/packages/fmonts/ffmpeg-bundle)

This bundle provides a simple wrapper for the [PHP_FFmpeg](https://github.com/alchemy-fr/PHP-FFmpeg) library,
exposing the library as a Symfony service.

#### This fork adds Symfony5, Symfony6 and Symfony7 support and drops legacy Symfony and PHP support ####

### Set up the bundle

0. Install FFmpeg and find out where the binaries are located. Example on Ubuntu/Debian:

```bash
$ sudo apt install ffmpeg
$ whereis ffmpeg
# outputs: ffmpeg: /usr/bin/ffmpeg
$ whereis ffprobe
# outputs: ffmpeg: /usr/bin/ffprobe
```

1. Create the required configuration in a yaml file, such as `config/packages/dubture_f_fmpeg.yaml`:

```yaml
dubture_f_fmpeg:
  ffmpeg_binary: /usr/bin/ffmpeg
  ffprobe_binary: /usr/bin/ffprobe
  binary_timeout: 300 # Use 0 for infinite
  threads_count: 4
  temporary_directory: /var/ffmpeg-tmp
```

> Note: The `temporary_directory` key is only used for writing [two-pass logs](https://ffmpeg.org/ffmpeg.html#Video-Options).

2. Require the bundle with composer:

```bash
$ composer require fmonts/ffmpeg-bundle
```

3. Add, in services.yaml, under `services`:

```
FFMpeg\FFMpeg: '@dubture_ffmpeg.ffmpeg'
```

### Usage

```php
class VideoController extends AbstractController
{
    public function resize(FFMpeg $FFMpeg): Response
    {
        // Open video
        $video = $FFMpeg->open('/your/source/folder/input.avi');
        
        // Resize to 1280x720
        $video
          ->filters()
          ->resize(new Dimension(1280, 720), ResizeFilter::RESIZEMODE_INSET)
          ->synchronize();
        
        // Start transcoding and save video
        $video->save(new X264(), '/your/target/folder/video.mp4');
    }
}
```
