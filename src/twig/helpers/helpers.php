<?php

declare(strict_types=1);

/**
 * Flextype (https://flextype.org)
 * Founded by Sergey Romanenko and maintained by Flextype Community.
 */

if (! function_exists('twig')) {
    /**
     * Get Flextype Twig Service.
     */
    function twig()
    {
        return container()->get('twig');
    }
}

if (! function_exists('flash')) {
    /**
     * Get Flextype Flash Service.
     */
    function flash()
    {
        return container()->get('flash');
    }
}