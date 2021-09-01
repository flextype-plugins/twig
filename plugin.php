<?php

declare(strict_types=1);

/**
 * @link https://flextype.org
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Flextype\Plugin\Twig;

use function is_file;
use Slim\Http\Environment;
use Slim\Http\Uri;
use Slim\Csrf\Guard;
use Slim\Flash\Messages;
use Twig\Extension\DebugExtension;
use Twig\Extension\StringLoaderExtension;

/**
 * Ensure vendor libraries exist
 */
! is_file($twigAutoload = __DIR__ . '/vendor/autoload.php') and exit('Please run: <i>composer install</i> for twig plugin');

/**
 * Register The Auto Loader
 *
 * Composer provides a convenient, automatically generated class loader for
 * our application. We just need to utilize it! We'll simply require it
 * into the script here so that we don't have to worry about manual
 * loading any of our classes later on. It feels nice to relax.
 * Register The Auto Loader
 */
$twigLoader = require_once $twigAutoload;

/**
 * Add Twig service to Flextype container
 */
container()->set('twig', function () {

    // Create Twig View
    $twig = new Twig(PATH['project'],
                        ['auto_reload' => registry()->get('plugins.twig.settings.auto_reload'),
                         'cache' => registry()->get('plugins.twig.settings.cache') ? PATH['tmp'] . '/twig' : false,
                         'debug' => registry()->get('plugins.twig.settings.debug'),
                         'charset' => registry()->get('plugins.twig.settings.charset')]);

    // Add Twig Extensions
    $twig->addExtension(new DebugExtension());
    $twig->addExtension(new StringLoaderExtension());

    // Load Flextype Twig extensions from directory /flextype/twig/ based on settings.twig.extensions array
    $twigExtensions = registry()->get('plugins.twig.settings.extensions');

    foreach ($twigExtensions as $twigExtension) {
        $twigExtensionClassName = $twigExtension . 'TwigExtension';
        $twigExtensionClassNameWithNamespace = 'Flextype\\Plugin\\Twig\\Extension\\' . $twigExtension . 'TwigExtension';

        if (file_exists(ROOT_DIR . '/project/plugins/twig/src/twig/Extensions/' . $twigExtensionClassName . '.php')) {

            if ($twigExtension == 'Url') continue;

            if ($twigExtension == 'Flextype') {
                container()->set('flash', new Messages());
            }

            $twig->addExtension(new $twigExtensionClassNameWithNamespace());
        }
    }

    // Return view
    return $twig;
});