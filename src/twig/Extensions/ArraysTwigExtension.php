<?php

declare(strict_types=1);

/**
 * Flextype (https://flextype.org)
 * Founded by Sergey Romanenko and maintained by Flextype Community.
 */

namespace Flextype\Plugin\Twig\Extension;

use Twig\Extension\AbstractExtension;

use Atomastic\Arrays\Arrays;

class ArraysTwigExtension extends AbstractExtension
{
    /**
     * Callback for twig.
     *
     * @return array
     */
    public function getFunctions() : array
    {
        return [
            new \Twig\TwigFunction('arrays', 'arrays'),
            new \Twig\TwigFunction('arraysFromJson', 'arraysFromJson'),
            new \Twig\TwigFunction('arraysFromString', 'arraysFromString'),
            new \Twig\TwigFunction('arraysWithRange', 'arraysWithRange')
        ];
    }
}