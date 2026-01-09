<?php

use Nette\DI\CompilerExtension;
use Nette\DI\Definitions\ServiceDefinition;
use Nette\DI\Definitions\Statement;
use Nette\PhpGenerator\ClassType;

final class SyntaxExtension extends CompilerExtension
{

	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();

		// SIMPLE ================================

		$builder->addDefinition('a1')
			->setType('TestClass');

		$builder->addDefinition('a2')
			->setType('TestClass');

		$builder->addDefinition('a3')
			->setFactory('TestClass');

		// OPTIONS ===============================

		$builder->addDefinition('b1')
			->setType('TestClass')
			->setAutowired(false);

		$builder->addDefinition('b2')
			->setType('TestClass')
			->addTag('inject');

		// ARGUMENTS =============================

		$builder->addDefinition('c1a')
			->setType('TestClass2')
			->setArguments([1, 2]);

		$builder->addDefinition('c1b')
			->setFactory('TestClass2', [1, 2]);

		$builder->addDefinition('c2a')
			->setType('TestClass2')
			->setArguments([1]);

		$builder->addDefinition('c2b')
			->setFactory('TestClass2', [1]);

		$builder->addDefinition('c3a')
			->setType('TestClass2')
			->setArguments(['b' => 2]);

		$builder->addDefinition('c3b')
			->setFactory('TestClass2', ['b' => 2]);

		// TAGS ==================================

		$builder->addDefinition('d1')
			->setType('TestClass')
			->addTag('t1');

		$builder->addDefinition('d2')
			->setType('TestClass')
			->setTags(['t1' => 'foobar']);

		// ARGUMENTS + PARAMETERS ================

		// $->setType()->setArguments() <==> $->setFactory()

		$builder->addDefinition('e1')
			->setType('TestClass2')
			->setArguments([1]);

		$builder->addDefinition('e2')
			->setFactory('TestClass2', [1, 2]);

		$builder->addDefinition('e3')
			->setType('TestClass2')
			->setArguments([1]);

		$builder->addDefinition('e4')
			->setType('TestClass2')
			->setArguments(['b' => 1]);

		// IMPLEMENTS (INTERFACES) ===============

		$builder->addFactoryDefinition('f1')
			->setImplement('ITestInterface');

		$builder->addFactoryDefinition('f2')
			->setResultDefinition(new ServiceDefinition())
			->setImplement('ITestInterface')
			->getResultDefinition()
			->setType('TestClass');

		$builder->addFactoryDefinition('f3a')
			->setImplement('ITestInterface2')
			->getResultDefinition()
			->setArguments([1, 2]);

		$builder->addFactoryDefinition('f3b')
			->setImplement('ITestInterface2')
			->getResultDefinition()
			->setArguments(['b' => 2]);

		$builder->addFactoryDefinition('f4a')
			->setImplement('ITestInterface3')
			->getResultDefinition()
			->setArguments([1]);

		$builder->addFactoryDefinition('f4b')
			->setImplement('ITestInterface3')
			->getResultDefinition()
			->setArguments([1]);

		$builder->addDefinition('f5s')
			->setType('TestClass2');

		$builder->addAccessorDefinition('f5')
			->setImplement('ITestInterfaceGet')
			->setReference('@f5s');

		// REFERENCES ============================

		$builder->addDefinition('g1')
			->setType('TestClass2')
			->setArguments([1, 2]);

		$builder->addDefinition('g2')
			->setFactory('@g1');

		$builder->addDefinition('g5a')
			->setType('stdClass')
			->setFactory('@g1::foo');

		$builder->addDefinition('g5b')
			->setType('stdClass')
			->setFactory('@g1::foo')
			->setArguments([1]);

		$builder->addDefinition('g5c')
			->setType('stdClass')
			->setFactory('@g1::foo', [1]);

		// SETUP =================================

		$builder->addDefinition('h1')
			->setType('stdClass')
			->addSetup('$a', [1])
			->addSetup(new Statement(['@self', '$a'], [1]))
			->addSetup('@self::$a', [1])
			->addSetup('foo', [1])
			->addSetup(new Statement(['@self', 'foo'], [1]))
			->addSetup('@self::foo', [1]);
	}

	public function afterCompile(ClassType $class): void
	{
		$initialize = $class->getMethod('initialize');

		$initialize->addBody('My\\Tracy\\Bar::init(?);', [1]);
		$initialize->addBody('My\\Tracy\\Bar::init(?*);', [[1, 2]]);
	}

}
