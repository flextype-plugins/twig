<?php

declare(strict_types=1);

/**
 * Flextype (https://flextype.org)
 * Founded by Sergey Romanenko and maintained by Flextype Community.
 */

namespace Flextype\Plugin\Twig\Twig;

use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class EntriesTwigExtension extends AbstractExtension implements GlobalsInterface
{
    /**
     * Register Global variables in an extension
     */
    public function getGlobals() : array
    {
        return [
            'entries' => new EntriesTwig(),
        ];
    }
}

class EntriesTwig
{
    /**
     * Flextype Application
     */


    /**
     * Constructor
     */
    public function __construct()
    {

    }

    /**
     * Fetch entry(entries)
     */
    public function fetch(string $path, bool $collection = false, array $filter = []) : array
    {
        return flextype('entries')->fetch($path, $collection, $filter);
    }

    /**
     * Fetch single entry
     */
    public function fetchSingle(string $path) : array
    {
        return flextype('entries')->fetch($path);
    }

    /**
     * Fetch entries collection
     */
    public function fetchCollection(string $path, array $filter = []) : array
    {
        return flextype('entries')->fetchCollection($path, $filter);
    }
}
