<?php

declare(strict_types=1);

/**
 * Flextype (https://flextype.org)
 * Founded by Sergey Romanenko and maintained by Flextype Community.
 */

namespace Flextype\Plugin\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Atomastic\Macroable\Macroable;

class EntriesTwigExtension extends AbstractExtension
{
    /**
     * Callback for twig.
     *
     * @return array
     */
    public function getFunctions() : array
    {
        return [
            new TwigFunction('entries', function() { return new EntriesTwig(); })
        ];
    }
}

class EntriesTwig
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