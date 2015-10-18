<?php

use Nette\DI\Compiler;
use Nette\DI\ContainerLoader;

require_once  __DIR__ . '/../vendor/autoload.php';

class CustomContainerLoader extends ContainerLoader
{
    function __construct()
    {
        parent::__construct(__DIR__ . '/tmp', TRUE);
    }

    public function getClassName($key)
    {
        return 'Container_' . $key;
    }
}

$loader = new CustomContainerLoader();
$class = $loader->load('syntax', function (Compiler $compiler) {
    $compiler->addExtension('syntax', new SyntaxExtension());
});

$container = new $class;
