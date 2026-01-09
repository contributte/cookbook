<?php declare(strict_types=1);

use Contributte\Tester\Environment;
use Nette\DI\Compiler;
use Nette\DI\Container;
use Nette\DI\ContainerLoader;
use Tester\Assert;
use Tester\TestCase;

require __DIR__ . '/../bootstrap.php';

class CompareLoader extends ContainerLoader
{
	function __construct()
	{
		parent::__construct(Environment::getTmpDir(), true);
	}

	public function getClassName(mixed $key): string
	{
		return 'Container_' . $key;
	}
}

class CompareTest extends TestCase
{

	public function testCompare(): void
	{
		// Create container based on extension
		$loader = new CompareLoader();
		$class = $loader->load(function (Compiler $compiler) {
			$compiler->addExtension('test', new SyntaxExtension());
		}, '1');

		$container1 = new $class;

		// Create container based on neon config
		$class = $loader->load(function (Compiler $compiler) {
			$compiler->loadConfig(__DIR__ . '/../../syntax/neon/syntax.neon');
		}, '2');

		$container2 = new $class;

		// Access container properties via reflection
		$aliasesProperty = new ReflectionProperty('Nette\DI\Container', 'aliases');
		$aliasesProperty->setAccessible(true);

		$tagsProperty = new ReflectionProperty('Nette\DI\Container', 'tags');
		$tagsProperty->setAccessible(true);

		$wiringProperty = new ReflectionProperty('Nette\DI\Container', 'wiring');
		$wiringProperty->setAccessible(true);

		$this->assertAliases($aliasesProperty->getValue($container1), $aliasesProperty->getValue($container2));
		$this->assertTags($tagsProperty->getValue($container1), $tagsProperty->getValue($container2));
		$this->assertTypes($wiringProperty->getValue($container1), $wiringProperty->getValue($container2));
		$this->assertMethods($container1, $container2);
	}

	protected function assertAliases(array $aliases1, array $aliases2): void
	{
		Assert::equal($aliases1, $aliases2);
	}

	protected function assertTags(array $tags1, array $tags2): void
	{
		foreach ($tags1 as $k => $v) {
			if (isset($tags2[$k])) {
				Assert::equal($tags1[$k], $tags2[$k]);
			}
		}
	}

	protected function assertTypes(array $wiring1, array $wiring2): void
	{
		foreach ($wiring1 as $class => $array) {
			if (isset($array[0])) {
				$arr1 = $wiring1[$class][0];
				$arr2 = $wiring2[$class][0];
				natsort($arr1);
				natsort($arr2);
				Assert::equal(array_values($arr1), array_values($arr2));
			}
			if (isset($array[1])) {
				$arr1 = $wiring1[$class][1];
				$arr2 = $wiring2[$class][1];
				natsort($arr1);
				natsort($arr2);
				Assert::equal(array_values($arr1), array_values($arr2));
			}
		}
	}

	protected function assertMethods(Container $container1, Container $container2): void
	{
		$rc1 = new ReflectionClass($container1);
		$rc2 = new ReflectionClass($container2);

		$methods1 = $rc1->getMethods();
		$methods2 = $rc2->getMethods();

		// Assert methods count
		Assert::equal(count($methods1), count($methods2));

		foreach ($methods1 as $k => $m1) {
			Assert::equal($m1->getParameters(), $methods2[$k]->getParameters());
			Assert::equal($m1->getDocComment(), $methods2[$k]->getDocComment());
		}
	}
}

(new CompareTest())->run();
