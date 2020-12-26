<?php

declare(strict_types=1);

/**
 * Flextype (https://flextype.org)
 * Founded by Sergey Romanenko and maintained by Flextype Community.
 */

namespace Flextype\Plugin\Twig\Twig;

use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Atomastic\Macroable\Macroable;
use Atomastic\Arrays\Arrays;

class FlextypeTwigExtension extends AbstractExtension implements GlobalsInterface
{
    /**
     * Register Global variables in an extension
     */
    public function getGlobals() : array
    {
        return [
            'flextype' => new FlextypeTwig(),
        ];
    }
}

class FlextypeTwig
{
    use Macroable;

    public function entries()
    {
        return new FlextypeEntriesTwig();
    }

    public function media()
    {
        return new FlextypeMediaTwig();
    }

    public function registry()
    {
        return flextype('registry');
    }

    public function parsers()
    {
        return flextype('parsers');
    }

    public function serializers()
    {
        return flextype('serializers');
    }

    public function cache()
    {
        return flextype('cache');
    }

    public function emitter()
    {
        return flextype('emitter');
    }

    public function slugify()
    {
        return flextype('slugify');
    }
}

class FlextypeEntriesTwig
{
    use Macroable;

    /**
     * Fetch.
     *
     * @param string $id      Unique identifier of the entry.
     * @param array  $options Options array.
     *
     * @access public
     *
     * @return self Returns instance of The Arrays class.
     */
    public function fetch(string $id, array $options = []): Arrays
    {
        return flextype('entries')->fetch($id, $options);
    }
}

class FlextypeMediaTwig
{
    use Macroable;

    /**
     * Create a Media Files instance.
     */
    public function files(): FlextypeMediaTwigFiles
    {
        return new FlextypeMediaTwigFiles();
    }

    /**
     * Create a Media Files instance.
     */
    public function folders(): FlextypeMediaTwigFolders
    {
        return new FlextypeMediaTwigFolders();
    }
}

class FlextypeMediaTwigFiles
{
    use Macroable;

    /**
     * Create a Media Files Meta instance.
     */
    public function meta(): FlextypeMediaTwigFilesMeta
    {
        return new FlextypeMediaTwigFilesMeta();
    }

    /**
     * Fetch.
     *
     * @param string $id      The path to file.
     * @param array  $options Options array.
     *
     * @return self Returns instance of The Arrays class.
     *
     * @access public
     */
    public function fetch(string $id, array $options = []): Arrays
    {
        return flextype('media')->files()->fetch($id, $options);
    }

    /**
     * Check whether a file exists.
     *
     * @param string $id Unique identifier of the file.
     *
     * @return bool True on success, false on failure.
     *
     * @access public
     */
    public function has(string $id): bool
    {
        return flextype('media')->files()->has($id);
    }

    /**
     * Get file location
     *
     * @param string $id Unique identifier of the file.
     *
     * @return string entry file location
     *
     * @access public
     */
    public function getFileLocation(string $id): bool
    {
        return flextype('media')->files()->getFileLocation($id);
    }
}

class FlextypeMediaTwigFilesMeta
{
    use Macroable;

    /**
     * Get file meta location
     *
     * @param string $id Unique identifier of the file.
     *
     * @return string entry file location
     *
     * @access public
     */
    public function getFileMetaLocation(string $id): bool
    {
        return flextype('media')->files()->meta()->getFileMetaLocation($id);
    }
}

class FlextypeMediaTwigFolders
{
    use Macroable;

    /**
     * Create a Media Folders Meta instance.
     */
    public function meta(): FlextypeMediaTwigFoldersMeta
    {
        return new FlextypeMediaTwigFoldersMeta();
    }

    /**
     * Fetch.
     *
     * @param string $id      The path to folder.
     * @param array  $options Options array.
     *
     * @return self Returns instance of The Arrays class.
     *
     * @access public
     */
    public function fetch(string $id, array $options = []): Arrays
    {
        return flextype('media')->folders()->fetch($id, $options);
    }

    /**
     * Get files directory location
     *
     * @param string $id Unique identifier of the folder.
     *
     * @return string entry directory location
     *
     * @access public
     */
    public function getDirectoryLocation(string $id): string
    {
        return flextype('media')->folders()->getDirectoryLocation($id);
    }
}

class FlextypeMediaTwigFoldersMeta
{
    use Macroable;

    /**
     * Get files directory meta location
     *
     * @param string $id Unique identifier of the folder.
     *
     * @return string entry directory location
     *
     * @access public
     */
    public function getDirectoryMetaLocation(string $id): string
    {
        return flextype('media')->folders()->meta()->getDirectoryMetaLocation($id);
    }
}
