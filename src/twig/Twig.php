<?php

namespace Flextype\Plugin\Twig;

use ArrayAccess;
use Psr\Http\Message\ResponseInterface;
use Twig\Environment;

class Twig implements ArrayAccess
{
    /**
     * Twig loader
     *
     * @var \Twig\Loader\LoaderInterface
     */
    protected $loader;

    /**
     * Twig environment
     *
     * @var \Twig\Environment
     */
    protected $environment;

    /**
     * Default view variables
     *
     * @var array
     */
    protected $defaultVariables = [];

    /**
     * Create new Twig view
     *
     * @param string|array $path     Path(s) to templates directory.
     * @param array        $settings Twig environment settings
     */
    public function __construct($path, array $settings = [])
    {
        $this->loader      = $this->createLoader(is_string($path) ? [$path] : $path);
        $this->environment = new Environment($this->loader, $settings);
    }

    /**
     * @param ServerRequestInterface $request
     * @param string                 $attributeName
     *
     * @return Twig
     */
    public static function fromRequest(ServerRequestInterface $request, string $attributeName = 'view'): self
    {
        $twig = $request->getAttribute($attributeName);

        if ($twig === null || !($twig instanceof self)) {
            throw new RuntimeException(
                'Twig could not be found in the server request attributes using the key "'. $attributeName .'".'
            );
        }

        return $twig;
    }

    /********************************************************************************
     * Methods
     *******************************************************************************/

    /**
     * Proxy method to add an extension to the Twig environment
     *
     * @param \Twig\Extension\ExtensionInterface $extension A single extension instance or an array of instances
     */
    public function addExtension(\Twig\Extension\ExtensionInterface $extension)
    {
        $this->environment->addExtension($extension);
    }

    public function addFunction(\Twig\TwigFunction $function)
    {
        $this->environment->addFunction($function);
    }

    public function addFilter(\Twig\TwigFilter $filter)
    {
        $this->environment->addFilter($filter);
    }

    public function addGlobal(string $name, $value)
    {
        $this->environment->addGlobal($name, $value);
    }

    /**
     * Fetch rendered template
     *
     * @param  string $template Template pathname relative to templates directory
     * @param  array  $data     Associative array of template variables
     *
     * @throws \Twig\Error\LoaderError  When the template cannot be found
     * @throws \Twig_Error\SyntaxError  When an error occurred during compilation
     * @throws \Twig_Error\RuntimeError When an error occurred during rendering
     *
     * @return string
     */
    public function fetch($template, $data = [])
    {
        $start = microtime(true);
        $data = array_merge($this->defaultVariables, $data);
        echo "Fetch: " . sprintf(" %01.4f", microtime(true) - $start) . " ";
        return $this->environment->render($template, $data);
    }

    /**
     * Fetch rendered block
     *
     * @param  string $template Template pathname relative to templates directory
     * @param  string $block    Name of the block within the template
     * @param  array  $data     Associative array of template variables
     *
     * @return string
     */
    public function fetchBlock($template, $block, $data = [])
    {
        $data = array_merge($this->defaultVariables, $data);

        return $this->environment->load($template)->renderBlock($block, $data);
    }

    /**
     * Fetch rendered string
     *
     * @param  string $string String
     * @param  array  $data   Associative array of template variables
     *
     * @return string
     */
    public function fetchFromString($string ="", $data = [])
    {
        $start = microtime(true);
        $data = array_merge($this->defaultVariables, $data);
        echo "fetchFromString: " . sprintf(" %01.4f", microtime(true) - $start) . " ";
        return $this->environment->createTemplate($string)->render($data);
    }

    /**
     * Output rendered template
     *
     * @param ResponseInterface $response
     * @param  string $template Template pathname relative to templates directory
     * @param  array $data Associative array of template variables
     * @return ResponseInterface
     */
    public function render(ResponseInterface $response, $template, $data = [])
    {
        $start = microtime(true);
         $response->getBody()->write($this->fetch($template, $data));
         echo "render: " . sprintf(" %01.4f", microtime(true) - $start) . " ";
         return $response;
    }

    /**
     * Create a loader with the given path
     *
     * @param array $paths
     * @return \Twig\Loader\FilesystemLoader
     */
    private function createLoader(array $paths)
    {
        $loader = new \Twig\Loader\FilesystemLoader();

        foreach ($paths as $namespace => $path) {
            if (is_string($namespace)) {
                $loader->setPaths($path, $namespace);
            } else {
                $loader->addPath($path);
            }
        }

        return $loader;
    }

    /********************************************************************************
     * Accessors
     *******************************************************************************/

    /**
     * Return Twig loader
     *
     * @return \Twig\Loader\LoaderInterface
     */
    public function getLoader()
    {
        return $this->loader;
    }

    /**
     * Return Twig environment
     *
     * @return \Twig\Environment
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /********************************************************************************
     * ArrayAccess interface
     *******************************************************************************/

    /**
     * Does this collection have a given key?
     *
     * @param  string $key The data key
     *
     * @return bool
     */
    public function offsetExists($key)
    {
        return array_key_exists($key, $this->defaultVariables);
    }

    /**
     * Get collection item for key
     *
     * @param string $key The data key
     *
     * @return mixed The key's value, or the default value
     */
    public function offsetGet($key)
    {
        return $this->defaultVariables[$key];
    }

    /**
     * Set collection item
     *
     * @param string $key   The data key
     * @param mixed  $value The data value
     */
    public function offsetSet($key, $value)
    {
        $this->defaultVariables[$key] = $value;
    }

    /**
     * Remove item from collection
     *
     * @param string $key The data key
     */
    public function offsetUnset($key)
    {
        unset($this->defaultVariables[$key]);
    }

    /********************************************************************************
     * Countable interface
     *******************************************************************************/

    /**
     * Get number of items in collection
     *
     * @return int
     */
    public function count()
    {
        return count($this->defaultVariables);
    }

    /********************************************************************************
     * IteratorAggregate interface
     *******************************************************************************/

    /**
     * Get collection iterator
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->defaultVariables);
    }
}