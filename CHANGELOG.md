## 0.8.6
- Fix Symfony 7.1 deprecation of `Symfony\Component\HttpKernel\DependencyInjection\Extension`
- Add option defaults to prevent error on `composer require` when `config/packages/dubture_f_fmpeg.yaml` is not present

## 0.8.5
- Add support for Symfony7 in composer.json

## 0.8.4
- Add support for any PHP version >= 8.0

## 0.8.3
- Add return type declaration to `DubtureFFmpegExtension::load()`, to fix the deprecation message `Method ExtensionInterface::load()" might add "void" as a native return type declaration in the future.`

## 0.8.2
- Add `temporary_directory` option for two-pass logging, 
related to [PR 855 PHP-FFMpeg](https://github.com/PHP-FFMpeg/PHP-FFMpeg/pull/855).
Thanks to @ToshY

## 0.8.1
- Fixed deprecation message in Symfony: 'Method "Symfony\Component\Config\Definition\ConfigurationInterface::getConfigTreeBuilder()" might add "TreeBuilder" as a native return type declaration in the future. Do the same in implementation "Dubture\FFmpegBundle\DependencyInjection\Configuration" now to avoid errors or add an explicit @return annotation to suppress this message.'
- Fixed errors in test classes about method declarations not compatible with parents

## 0.8.0
- Add support for PHP 8.0 and 8.1
- Add support for Symfony6
- Drop support for EOL PHP and Symfony versions
- Update dependency requirements to include their latest versions

## 0.7.0
- This version supports Symfony 4.2
- Fixed deprecated constructing a TreeBuilder without passing root node information (https://github.com/symfony/symfony/blob/master/UPGRADE-4.2.md#config)

## 0.2.3

- Added thread_count parameter - by [micronax](https://github.com/micronax)

## 0.2.2

- Updated service.xml to reflect the changes to the latest php-ffpmpg factory pattern.

