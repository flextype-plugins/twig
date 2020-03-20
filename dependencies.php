<?php

declare(strict_types=1);

/**
 * @link http://digital.flextype.org
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Flextype;

use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Slim\Http\Environment;
use Slim\Http\Uri;
use Twig\Extension\DebugExtension;

/**
 * Add site controller to Flextype container
 */
$flextype['twig'] = static function ($container) {

    // Get twig settings
    $twigSettings = [
                     'auto_reload' => $container['registry']->get('plugins.twig.settings.auto_reload'),
                     'cache' => $container['registry']->get('plugins.twig.settings.cache') ? PATH['cache'] . '/twig' : false,
                     'debug' => $container['registry']->get('plugins.twig.settings.debug'),
                     'charset' => $container['registry']->get('plugins.twig.settings.charset')
                    ];

    // Create Twig View
    $twig = new Twig(PATH['site'], $twigSettings);

    // Instantiate
    $router = $container->get('router');
    $uri    = Uri::createFromEnvironment(new Environment($_SERVER));

    // Add Twig Extension
    $twig->addExtension(new TwigExtension($router, $uri));

    // Add Twig Debug Extension
    $twig->addExtension(new DebugExtension());

    // Load Flextype Twig extensions from directory /flextype/twig/ based on settings.twig.extensions array
    $twig_extensions = $container['registry']->get('plugins.twig.settings.extensions');

    foreach ($twig_extensions as $twig_extension) {
        $twig_extension_class_name = $twig_extension . 'TwigExtension';
        $twig_extension_class_name_with_namespace = 'Flextype\\' . $twig_extension . 'TwigExtension';

        if (file_exists(ROOT_DIR . '/site/plugins/twig/twig/' . $twig_extension_class_name . '.php')) {
            $twig->addExtension(new $twig_extension_class_name_with_namespace($container));
        }
    }

    // Return view
    return $twig;
};
