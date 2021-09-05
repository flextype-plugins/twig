<?php

declare(strict_types=1);

/**
 * Flextype (https://flextype.org)
 * Founded by Sergey Romanenko and maintained by Flextype Community.
 */

namespace Flextype\Plugin\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Atomastic\Arrays\Arrays;
use Twig\TwigFunction;

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
            new TwigFunction('arrays', 'arrays'),
            new TwigFunction('arraysFromJson', 'arraysFromJson'),
            new TwigFunction('arraysFromString', 'arraysFromString'),
            new TwigFunction('arraysWithRange', 'arraysWithRange')
        ];
    }
}
