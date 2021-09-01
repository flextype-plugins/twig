<?php

declare(strict_types=1);

/**
 * Flextype (https://flextype.org)
 * Founded by Sergey Romanenko and maintained by Flextype Community.
 */

namespace Flextype\Plugin\Twig\Extension;

use Twig\Extension\AbstractExtension;

class TestsTwigExtension extends AbstractExtension
{
    /**
     * Callback for twig.
     *
     * @return array
     */
    public function getTests() : array
    {
        return [
            new \Twig\TwigTest('string',  function ($value) { return  is_string($value); }),
            new \Twig\TwigTest('array',  function ($value) { return  is_array($value); }),
            new \Twig\TwigTest('float',  function ($value) { return  is_float($value); }),
            new \Twig\TwigTest('int',  function ($value) { return  is_int($value); }),
            new \Twig\TwigTest('null',  function ($value) { return  is_null($value); }),
            new \Twig\TwigTest('numeric',  function ($value) { return  is_numeric($value); }),
            new \Twig\TwigTest('object',  function ($value) { return  is_object($value); }),
            new \Twig\TwigTest('scalar',  function ($value) { return  is_scalar($value); }),
        ];
    }
}
