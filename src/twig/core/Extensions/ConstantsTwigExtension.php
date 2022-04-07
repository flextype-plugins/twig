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
use Twig\Extension\GlobalsInterface;
use const PHP_VERSION;

class ConstantsTwigExtension extends AbstractExtension implements GlobalsInterface
{
    /**
     * Register Global variables in an extension
     */
    public function getGlobals() : array
    {
        return [
            'PATH_PROJECT' => PATH['project'],
            'PHP_VERSION' => PHP_VERSION,
        ];
    }
}
