<?php

declare(strict_types=1);

/**
 * Flextype (https://flextype.org)
 * Founded by Sergey Romanenko and maintained by Flextype Community.
 */

namespace Flextype\Plugin\Twig\Twig;

use Atomastic\Arrays\Arrays;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class MediaTwigExtension extends AbstractExtension implements GlobalsInterface
{
    /**
     * Register Global variables in an extension
     */
    public function getGlobals(): array
    {
        return [
            'media_files' => new MediaFilesTwig(),
            'media_files_meta' => new MediaFilesMetaTwig(),
            'media_folders' => new MediaFoldersTwig(),
            'media_folders_meta' => new MediaFoldersMetaTwig(),
        ];
    }
}

class MediaFilesTwig
{
    public function fetchSingle(string $path, array $options = []): Arrays
    {
        return flextype('media_files')->fetchSingle($path, $options);
    }

    public function fetchCollection(string $path, array $options = []): Arrays
    {
        return flextype('media_files')->fetchCollection($path, $options);
    }

    public function has(string $path): bool
    {
        return flextype('media_files')->has($path);
    }

    public function getFileLocation(string $path): bool
    {
        return flextype('media_files')->getFileLocation($path);
    }
}

class MediaFilesMetaTwig
{
    public function getFileMetaLocation(string $path): bool
    {
        return flextype('media_files_meta')->getFileMetaLocation($path);
    }
}

class MediaFoldersTwig
{
    public function fetchSingle(string $path, array $options = []): Arrays
    {
        return flextype('media_folders')->fetchSingle($path, $options);
    }

    public function fetchCollection(string $path, array $options = []): Arrays
    {
        return flextype('media_folders')->fetchCollection($path, $options);
    }

    public function has(string $path): bool
    {
        return flextype('media_folders')->has($path);
    }

    public function getDirectoryLocation(string $path): bool
    {
        return flextype('media_folders')->getDirectoryLocation($path);
    }
}

class MediaFoldersMetaTwig
{
    public function getDirectoryMetaLocation(string $path): bool
    {
        return flextype('media_folders_meta')->getDirectoryMetaLocation($path);
    }
}
