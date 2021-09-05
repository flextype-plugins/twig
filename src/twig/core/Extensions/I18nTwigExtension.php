<?php

declare(strict_types=1);

/**
 * Flextype (https://flextype.org)
 * Founded by Sergey Romanenko and maintained by Flextype Community.
 */

namespace Flextype\Plugin\Twig\Extension;

use Flextype\Component\I18n\I18n;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Twig\TwigFilter;

class I18nTwigExtension extends AbstractExtension
{
    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array
     */
    public function getFunctions() : array
    {
        return [
            new TwigFunction('tr', [$this, 'tr']),
            new TwigFunction('__', [$this, 'tr']),
        ];
    }

    /**
     * Returns a list of filters to add to the existing list.
     *
     * @return array
     */
    public function getFilters() : array
    {
        return [
            new TwigFilter('tr', [$this, 'tr'])
        ];
    }

    /**
     * Translate string
     */
    public function tr(string $translate, array $values = [], ?string $locale = null) : string
    {
        return I18n::find($translate, $values, $locale);
    }
}
