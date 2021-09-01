<?php

declare(strict_types=1);

/**
 * Flextype (https://flextype.org)
 * Founded by Sergey Romanenko and maintained by Flextype Community.
 */

namespace Flextype\Plugin\Twig\Extension;

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

    private $entries = null;
    private $parsers = null;
    private $serializers = null;
    private $cache = null;
    private $emitter = null;
    private $slugify = null;
    private $flash = null;
    private $csrf = null;
    private $registry = null;

    public function __construct()
    {
        $this->registry = registry();
        $this->entries = new EntriesTwig();
        $this->parsers = parsers();
        $this->serializers = serializers();
        $this->cache = cache();
        $this->emitter = emitter();
        $this->slugify = slugify();
        $this->flash = flash();
        $this->csrf = csrf();
    }

    public function entries()
    {
        return $this->entries;
    }

    public function registry()
    {
        return $this->registry;
    }

    public function parsers()
    {
        return $this->parsers;
    }

    public function serializers()
    {
        return $this->serializers;
    }

    public function cache()
    {
        return $this->cache;
    }

    public function emitter()
    {
        return $this->emitter;
    }

    public function slugify()
    {
        return $this->slugify;
    }

    public function flash()
    {
        return $this->flash;
    }

    public function csrf()
    {
        return $this->csrf;
    }
}

class EntriesTwig
{
    use Macroable;

    private $entries = null;

    public function __construct()
    {
        $this->entries = entries();
    }

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
        return $this->entries->fetch($id, $options);
    }

    /**
     * Check whether entry exists
     *
     * @param string $id Unique identifier of the entry(entries).
     *
     * @return bool True on success, false on failure.
     *
     * @access public
     */
    public function has(string $id): bool
    {
        return $this->entries->has($id);
    }
}