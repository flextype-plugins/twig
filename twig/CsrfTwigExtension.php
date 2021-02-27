<?php

declare(strict_types=1);

/**
 * Flextype (https://flextype.org)
 * Founded by Sergey Romanenko and maintained by Flextype Community.
 */

namespace Flextype\Plugin\Twig\Twig;

use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class CsrfTwigExtension extends AbstractExtension
{
    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array
     */
    public function getFunctions() : array
    {
        return [
            new \Twig\TwigFunction('csrf', [$this, 'csrf'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * CSRF
     */
    public function csrf() : string
    {
        return '<input type="hidden" name="' . flextype('csrf')->getTokenName() . '" value="' . flextype('csrf')->getTokenValue() . '">';
    }
}
