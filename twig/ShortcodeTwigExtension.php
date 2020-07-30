<?php

declare(strict_types=1);

/**
 * Flextype (http://flextype.org)
 * Founded by Sergey Romanenko and maintained by Flextype Community.
 */

namespace Flextype\Plugin\Twig\Twig;

use Twig_Extension;
use Twig_SimpleFilter;

class ShortcodeTwigExtension extends Twig_Extension
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
            new Twig_SimpleFilter('shortcode', [$this, 'shortcode']),
        ];
    }

    /**
     * Shorcode process
     */
    public function shortcode($value) : string
    {
        if (!empty($value)) {
            return $this->flextype['shortcode']->parse($value);
        }

        return '';
    }
}
