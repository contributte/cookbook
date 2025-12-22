<?php declare(strict_types=1);

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
		parent::__construct(TEMP_DIR, true);
	}

	public function getClassName($key)
	{
		return 'Container_' . $key;
	}
}

class CompareTest extends TestCase
{

	public function testCompare()
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

		// Access meta property

		$property = new ReflectionProperty('Nette\DI\Container', 'meta');
		$property->setAccessible(true);

		$meta1 = $property->getValue($container1);
		$meta2 = $property->getValue($container2);

		$this->assertAliases($meta1, $meta2);
		$this->assertServices($meta1, $meta2);
		$this->assertTags($meta1, $meta2);
		$this->assertTypes($meta1, $meta2);
		$this->assertMethods($container1, $container2);
	}

	protected function assertAliases(array $m1, array $m2): void
	{
		Assert::equal($m1['aliases'], $m2['aliases']);
	}

	protected function assertServices(array $m1, array $m2): void
	{
		Assert::equal($m1['services'], $m2['services']);
	}

	protected function assertTags(array $m1, array $m2): void
	{
		$tags1 = $m1['tags'];
		$tags2 = $m2['tags'];

		foreach ($tags1 as $k => $v) {
			Assert::equal($tags1[$k], $tags2[$k]);
		}
	}

	protected function assertTypes(array $m1, array $m2): void
	{
		$types1 = $m1['types'];
		$types2 = $m2['types'];

		foreach ($types1 as $class => $array) {
			if (isset($array[0])) {
				natsort($types1[$class][0]);
				natsort($types2[$class][0]);
				Assert::equal(array_values($types1[$class][0]), array_values($types2[$class][0]));
			}
			if (isset($array[1])) {
				natsort($types1[$class][1]);
				natsort($types2[$class][1]);
				Assert::equal(array_values($types1[$class][1]), array_values($types2[$class][1]));
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
