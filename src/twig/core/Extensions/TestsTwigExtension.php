<?php

declare(strict_types=1);

/**
 * Flextype (https://flextype.org)
 * Founded by Sergey Romanenko and maintained by Flextype Community.
 */

namespace Flextype\Plugin\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigTest;

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
            new TwigTest('instance of',  function ($obj, $class) { return $obj instanceof $class; }),
            new TwigTest('boolean',  function ($value) { return  is_bool($value); }),
            new TwigTest('string',  function ($value) { return  is_string($value); }),
            new TwigTest('array',  function ($value) { return  is_array($value); }),
            new TwigTest('float',  function ($value) { return  is_float($value); }),
            new TwigTest('int',  function ($value) { return  is_int($value); }),
            new TwigTest('null',  function ($value) { return  is_null($value); }),
            new TwigTest('numeric',  function ($value) { return  is_numeric($value); }),
            new TwigTest('object',  function ($value) { return  is_object($value); }),
            new TwigTest('scalar',  function ($value) { return  is_scalar($value); }),
        ];
    }
}
