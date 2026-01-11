<?php

/** @noinspection PhpParamsInspection,PhpMethodMayBeStaticInspection */

declare(strict_types=1);

class Container_syntax extends Nette\DI\Container
{
	protected array $tags = ['inject' => ['b2' => true], 't1' => ['d1' => true, 'd2' => 'foobar']];
	protected array $aliases = [];

	protected array $wiring = [
		'Nette\DI\Container' => [['container']],
		'TestClass' => [0 => ['a1', 'a2', 'a3', 'b2', 'd1', 'd2'], 2 => [3 => 'b1']],
		'TestClass2' => [
			0 => ['c1a', 'c1b', 'c2a', 'c2b', 'c3a', 'c3b', 'e1', 'e2', 'e3', 'e4', 'f5s', 'g1'],
			2 => [12 => 'g2'],
		],
		'ITestInterface' => [['f1', 'f2']],
		'ITestInterface2' => [['f3a', 'f3b']],
		'ITestInterface3' => [['f4a', 'f4b']],
		'ITestInterfaceGet' => [['f5']],
		'stdClass' => [['g5a', 'g5b', 'g5c', 'h1']],
	];


	public function __construct(array $params = [])
	{
		parent::__construct($params);
	}


	public function createServiceA1(): TestClass
	{
		return new TestClass;
	}


	public function createServiceA2(): TestClass
	{
		return new TestClass;
	}


	public function createServiceA3(): TestClass
	{
		return new TestClass;
	}


	public function createServiceB1(): TestClass
	{
		return new TestClass;
	}


	public function createServiceB2(): TestClass
	{
		return new TestClass;
	}


	public function createServiceC1a(): TestClass2
	{
		return new TestClass2(1, 2);
	}


	public function createServiceC1b(): TestClass2
	{
		return new TestClass2(1, 2);
	}


	public function createServiceC2a(): TestClass2
	{
		return new TestClass2(1);
	}


	public function createServiceC2b(): TestClass2
	{
		return new TestClass2(1);
	}


	public function createServiceC3a(): TestClass2
	{
		return new TestClass2(b: 2);
	}


	public function createServiceC3b(): TestClass2
	{
		return new TestClass2(b: 2);
	}


	public function createServiceContainer(): Nette\DI\Container
	{
		return $this;
	}


	public function createServiceD1(): TestClass
	{
		return new TestClass;
	}


	public function createServiceD2(): TestClass
	{
		return new TestClass;
	}


	public function createServiceE1(): TestClass2
	{
		return new TestClass2(1);
	}


	public function createServiceE2(): TestClass2
	{
		return new TestClass2(1, 2);
	}


	public function createServiceE3(): TestClass2
	{
		return new TestClass2(1);
	}


	public function createServiceE4(): TestClass2
	{
		return new TestClass2(b: 1);
	}


	public function createServiceF1(): ITestInterface
	{
		return new class ($this) implements ITestInterface {
			public function __construct(
				private Container_syntax $container,
			) {
			}


			public function create(): TestClass
			{
				return new TestClass;
			}
		};
	}


	public function createServiceF2(): ITestInterface
	{
		return new class ($this) implements ITestInterface {
			public function __construct(
				private Container_syntax $container,
			) {
			}


			public function create(): TestClass
			{
				return new TestClass;
			}
		};
	}


	public function createServiceF3a(): ITestInterface2
	{
		return new class ($this) implements ITestInterface2 {
			public function __construct(
				private Container_syntax $container,
			) {
			}


			public function create(): TestClass2
			{
				return new TestClass2(1, 2);
			}
		};
	}


	public function createServiceF3b(): ITestInterface2
	{
		return new class ($this) implements ITestInterface2 {
			public function __construct(
				private Container_syntax $container,
			) {
			}


			public function create(): TestClass2
			{
				return new TestClass2(b: 2);
			}
		};
	}


	public function createServiceF4a(): ITestInterface3
	{
		return new class ($this) implements ITestInterface3 {
			public function __construct(
				private Container_syntax $container,
			) {
			}


			public function create(string $a): TestClass2
			{
				return new TestClass2($a);
			}
		};
	}


	public function createServiceF4b(): ITestInterface3
	{
		return new class ($this) implements ITestInterface3 {
			public function __construct(
				private Container_syntax $container,
			) {
			}


			public function create(string $a): TestClass2
			{
				return new TestClass2($a);
			}
		};
	}


	public function createServiceF5(): ITestInterfaceGet
	{
		return new class ($this) implements ITestInterfaceGet {
			public function __construct(
				private Container_syntax $container,
			) {
			}


			public function get(): TestClass2
			{
				return $this->container->getService('f5s');
			}
		};
	}


	public function createServiceF5s(): TestClass2
	{
		return new TestClass2;
	}


	public function createServiceG1(): TestClass2
	{
		return new TestClass2(1, 2);
	}


	public function createServiceG2(): TestClass2
	{
		return $this->getService('g1');
	}


	public function createServiceG5a(): stdClass
	{
		return $this->getService('g1')->foo();
	}


	public function createServiceG5b(): stdClass
	{
		return $this->getService('g1')->foo(1);
	}


	public function createServiceG5c(): stdClass
	{
		return $this->getService('g1')->foo(1);
	}


	public function createServiceH1(): stdClass
	{
		$service = new stdClass;
		$service->a = 1;
		$service->a = 1;
		$service->a = 1;
		$service->foo(1);
		$service->foo(1);
		$service->foo(1);
		return $service;
	}


	public function initialize(): void
	{
		My\Tracy\Bar::init(1);
		My\Tracy\Bar::init(1, 2);
	}


	protected function getStaticParameters(): array
	{
		return [];
	}
}
