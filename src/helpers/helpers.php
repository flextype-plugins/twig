<?php

declare(strict_types=1);

/**
 * Flextype (https://flextype.org)
 * Founded by Sergey Romanenko and maintained by Flextype Community.
 */

if (! function_exists('twig')) {
    function twig()
    {
        return container()->get('twig');
    }
}

if (! function_exists('flash')) {
    function flash()
    {
        return container()->get('flash');
    }
}