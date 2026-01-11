<?php declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Nette\DI\Compiler;
use Nette\DI\ContainerLoader;

class GeneratorLoader extends ContainerLoader
{
	public function __construct()
	{
		parent::__construct(sys_get_temp_dir(), true);
	}

	public function generate(string $class, callable $generator): array
	{
		return parent::generate($class, $generator);
	}
}

$loader = new GeneratorLoader();

[$code] = $loader->generate('Container_syntax', function (Compiler $compiler) {
	$compiler->addExtension('test', new SyntaxExtension());
});

@mkdir(__DIR__ . '/../container', 0755, true);
file_put_contents(__DIR__ . '/../container/Container_syntax.php', $code);

echo "Generated container/Container_syntax.php\n";
