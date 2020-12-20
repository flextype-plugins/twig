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
    public function getGlobals(): array
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
     * Fetch.
     */
    public function fetch(string $id, array $options = [])
    {
        return flextype('entries')->fetch($id, $options);
    }
}
