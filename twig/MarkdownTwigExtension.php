<?php

declare(strict_types=1);

/**
 * Flextype (https://flextype.org)
 * Founded by Sergey Romanenko and maintained by Flextype Community.
 */

namespace Flextype\Plugin\Twig\Twig;

use Twig_Extension;
use Twig_SimpleFilter;

class MarkdownTwigExtension extends Twig_Extension
{
    /**
     * Flextype Dependency Container
     */
    private $flextype;

    /**
     * Constructor
     */
    public function __construct($flextype)
    {
        $this->flextype = $flextype;
    }

    /**
     * Returns a list of filters to add to the existing list.
     *
     * @return array
     */
    public function getFilters() : array
    {
        return [
            new Twig_SimpleFilter('markdown', [$this, 'markdown']),
        ];
    }

    /**
     * Markdown process
     */
    public function markdown($input, bool $cache = true) : string
    {
        if (!empty($input)) {
            return $this->flextype['markdown']->parse($input, $cache);
        }

        return '';
    }
}
