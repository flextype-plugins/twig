<?php

declare(strict_types=1);

/**
 * Flextype (https://flextype.org)
 * Founded by Sergey Romanenko and maintained by Flextype Community.
 */

namespace Flextype\Plugin\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigExtension extends AbstractExtension
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'slim';
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('urlFor', [TwigRuntimeExtension::class, 'urlFor']),
            new TwigFunction('fullUrlFor', [TwigRuntimeExtension::class, 'fullUrlFor']),
            new TwigFunction('isCurrentUrl', [TwigRuntimeExtension::class, 'isCurrentUrl']),
            new TwigFunction('currentUrl', [TwigRuntimeExtension::class, 'getCurrentUrl']),
            new TwigFunction('getUri', [TwigRuntimeExtension::class, 'getUri']),
            new TwigFunction('getBaseUrl', [TwigRuntimeExtension::class, 'getBaseUrl']),
            new TwigFunction('getAbsoluteUrl', [TwigRuntimeExtension::class, 'getAbsoluteUrl']),
        ];
    }
}
