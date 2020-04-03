<?php

declare(strict_types=1);

/**
 * Flextype (http://flextype.org)
 * Founded by Sergey Romanenko and maintained by Flextype Community.
 */

namespace Flextype;

use Twig_Extension;
use Twig_Extension_GlobalsInterface;
use const PHP_VERSION;

class GlobalVarsTwigExtension extends Twig_Extension implements Twig_Extension_GlobalsInterface
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
     * Register Global variables in an extension
     */
    public function getGlobals()
    {
        return [
            'PATH_SITE' => PATH['site'],
            'PATH_PLUGINS' => PATH['plugins'],
            'PATH_TOKENS' => PATH['tokens'],
            'PATH_ENTRIES' => PATH['entries'],
            'PATH_CONFIG_DEFAULT' => PATH['config']['default'],
            'PATH_CONFIG_SITE' => PATH['config']['site'],
            'PATH_CACHE' => PATH['cache'],
            'PATH_LOGS' => PATH['logs'],
            'PHP_VERSION' => PHP_VERSION
        ];
    }
}
