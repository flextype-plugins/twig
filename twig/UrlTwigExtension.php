<?php

declare(strict_types=1);

/**
 * Flextype (https://flextype.org)
 * Founded by Sergey Romanenko and maintained by Flextype Community.
 */

namespace Flextype;

use Twig_Extension;
use Twig_SimpleFunction;
use Slim\Http\Environment;
use Slim\Http\Uri;

class UrlTwigExtension extends Twig_Extension
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
     * Callback for twig.
     *
     * @return array
     */
    public function getFunctions() : array
    {
        return [
            new Twig_SimpleFunction('url', [$this, 'url'], ['is_safe' => ['html']])
        ];
    }

    /**
     * Get Site URL
     */
    public function url() : string
    {
        if ($this->flextype->registry->has('flextype.settings.url') && $this->flextype->registry->get('flextype.settings.url') != '') {
            return $this->flextype->registry->get('flextype.settings.url');
        } else {
            return Uri::createFromEnvironment(new Environment($_SERVER))->getBaseUrl();
        }
    }
}
