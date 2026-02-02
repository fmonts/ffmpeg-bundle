Symfony FFmpeg bundle
=====================

[![Latest Stable Version](https://poser.pugx.org/fmonts/ffmpeg-bundle/v/stable.svg)](https://packagist.org/packages/fmonts/ffmpeg-bundle) [![Total Downloads](https://poser.pugx.org/fmonts/ffmpeg-bundle/downloads.svg)](https://packagist.org/packages/fmonts/ffmpeg-bundle) [![Latest Unstable Version](https://poser.pugx.org/fmonts/ffmpeg-bundle/v/unstable.svg)](https://packagist.org/packages/fmonts/ffmpeg-bundle) [![License](https://poser.pugx.org/fmonts/ffmpeg-bundle/license.svg)](https://packagist.org/packages/fmonts/ffmpeg-bundle)

This bundle provides a simple wrapper for the [PHP_FFmpeg](https://github.com/alchemy-fr/PHP-FFmpeg) library,
exposing the library as a Symfony service.

#### This fork adds Symfony5, Symfony6, Symfony7, and Symfony8 support and drops legacy Symfony and PHP support ####

### Set up the bundle

#### 0. Install FFmpeg and Find the Binary Paths

To use this bundle, you need FFmpeg installed on your system. Find out where the binaries (ffmpeg and ffprobe) are located.

#### Ubuntu/Debian:

```bash
$ sudo apt install ffmpeg
$ whereis ffmpeg
# outputs: ffmpeg: /usr/bin/ffmpeg
$ whereis ffprobe
# outputs: ffmpeg: /usr/bin/ffprobe
```

#### macOS (Apple Silicon):

```bash
$ brew install ffmpeg
$ which ffmpeg
# outputs: /opt/homebrew/bin/ffmpeg
$ which ffprobe
# outputs: /opt/homebrew/bin/ffprobe
```

#### Windows:

Download FFmpeg from [ffmpeg.org](https://ffmpeg.org/download.html).
Extract the binaries to a folder and note their location, e.g.:

```yaml
  ffmpeg_binary: 'C:\Program Files\FFMpeg\ffmpeg.exe'
  ffprobe_binary: 'C:\Program Files\FFMpeg\ffprobe.exe'
```

1. Create the required configuration in `config/packages/dubture_f_fmpeg.yaml` (or rename it if using a different setup):

```yaml
dubture_f_fmpeg:
  ffmpeg_binary: /usr/bin/ffmpeg
  ffprobe_binary: /usr/bin/ffprobe
  binary_timeout: 300 # Use 0 for infinite
  threads_count: 4
  temporary_directory: "%kernel.cache_dir%/ffmpeg"
```

2. Install the Bundle via Composer:

```bash
$ composer require fmonts/ffmpeg-bundle
```

3. Register the FFmpeg Service

Add the FFmpeg service in `services.yaml` under the `services` section:

```
FFMpeg\FFMpeg: '@dubture_ffmpeg.ffmpeg'
```

### Usage example

Once set up, you can use FFmpeg in your controllers for video manipulation. Below is a sample controller action:

```php
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Filters\Video\ResizeFilter;
use FFMpeg\Format\Video\X264;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

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

### Supported Symfony and PHP Versions

- Symfony Versions: 5.4, 6.x, 7.x, and 8.x
- PHP Versions: 8.0 and higher 

For further documentation, visit the official [PHP-FFmpeg](https://github.com/alchemy-fr/PHP-FFmpeg) library to explore more options and features.
