<?php

declare(strict_types=1);

 /**
 * Flextype - Hybrid Content Management System with the freedom of a headless CMS 
 * and with the full functionality of a traditional CMS!
 * 
 * Copyright (c) Sergey Romanenko (https://awilum.github.io)
 *
 * Licensed under The MIT License.
 *
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 */

namespace Flextype\Plugin\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use function Flextype\imageFile;
use function Flextype\imageProcessFile;
use function Flextype\imageCanvas;
use function Flextype\imageCache;

class ImageTwigExtension extends AbstractExtension
{
    /**
     * Callback for twig.
     *
     * @return array
     */
    public function getFunctions() : array
    {
        return [
            new TwigFunction('imageProcessFile', '\Flextype\imageProcessFile'),
            new TwigFunction('imageFile', '\Flextype\imageFile'),
            new TwigFunction('imageCanvas', '\Flextype\imageCanvas'),
            new TwigFunction('imageCache', '\Flextype\imageCache'),
        ];
    }
}
