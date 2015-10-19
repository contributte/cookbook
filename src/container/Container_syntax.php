<?php
class Container_syntax extends Nette\DI\Container
{
	protected $meta = array(
		'types' => array(
			'TestClass' => array(
				1 => array(
					'a1',
					'a2',
					'a3',
					'b2',
					'd1',
					'd2',
					'f6s',
				),
				0 => array('b1'),
			),
			'TestClass2' => array(
				1 => array(
					'c1a',
					'c1b',
					'c2a',
					'c2b',
					'c3a',
					'c3b',
					'e1',
					'e2',
					'e3',
					'e4',
					'f5s',
					'f7s',
					'g1',
				),
				0 => array('g2', 'g3', 'g4'),
			),
			'ITestInterface' => array(1 => array('f1', 'f2', 'f6')),
			'ITestInterface2' => array(1 => array('f3a', 'f3b')),
			'ITestInterface3' => array(1 => array('f4a', 'f4b', 'f7')),
			'ITestInterfaceGet' => array(1 => array('f5')),
			'stdClass' => array(
				1 => array('g5a', 'g5b', 'g5c', 'g5d', 'h1', 'h2'),
			),
			'Nette\Object' => array(1 => array('container')),
			'Nette\DI\Container' => array(1 => array('container')),
		),
		'services' => array(
			'a1' => 'TestClass',
			'a2' => 'TestClass',
			'a3' => 'TestClass',
			'b1' => 'TestClass',
			'b2' => 'TestClass',
			'c1a' => 'TestClass2',
			'c1b' => 'TestClass2',
			'c2a' => 'TestClass2',
			'c2b' => 'TestClass2',
			'c3a' => 'TestClass2',
			'c3b' => 'TestClass2',
			'container' => 'Nette\DI\Container',
			'd1' => 'TestClass',
			'd2' => 'TestClass',
			'e1' => 'TestClass2',
			'e2' => 'TestClass2',
			'e3' => 'TestClass2',
			'e4' => 'TestClass2',
			'f1' => 'TestClass',
			'f2' => 'stdClass',
			'f3a' => 'TestClass2',
			'f3b' => 'TestClass2',
			'f4a' => 'TestClass2',
			'f4b' => 'TestClass2',
			'f5' => 'TestClass2',
			'f5s' => 'TestClass2',
			'f6' => 'TestClass',
			'f6s' => 'TestClass',
			'f7' => 'TestClass2',
			'f7s' => 'TestClass2',
			'g1' => 'TestClass2',
			'g2' => 'TestClass2',
			'g3' => 'TestClass2',
			'g4' => 'TestClass2',
			'g5a' => 'stdClass',
			'g5b' => 'stdClass',
			'g5c' => 'stdClass',
			'g5d' => 'stdClass',
			'h1' => 'stdClass',
			'h2' => 'stdClass',
		),
		'tags' => array(
			'inject' => array('b2' => TRUE),
			't1' => array('d1' => TRUE, 'd2' => 'foobar'),
		),
		'aliases' => array(),
	);


	public function __construct()
	{
		parent::__construct(array());
	}


	/**
	 * @return TestClass
	 */
	public function createServiceA1()
	{
		$service = new TestClass;
		return $service;
	}


	/**
	 * @return TestClass
	 */
	public function createServiceA2()
	{
		$service = new TestClass;
		return $service;
	}


	/**
	 * @return TestClass
	 */
	public function createServiceA3()
	{
		$service = new TestClass;
		return $service;
	}


	/**
	 * @return TestClass
	 */
	public function createServiceB1()
	{
		$service = new TestClass;
		return $service;
	}


	/**
	 * @return TestClass
	 */
	public function createServiceB2()
	{
		$service = new TestClass;
		return $service;
	}


	/**
	 * @return TestClass2
	 */
	public function createServiceC1a()
	{
		$service = new TestClass2(1, 2);
		return $service;
	}


	/**
	 * @return TestClass2
	 */
	public function createServiceC1b()
	{
		$service = new TestClass2(1, 2);
		return $service;
	}


	/**
	 * @return TestClass2
	 */
	public function createServiceC2a()
	{
		$service = new TestClass2(1);
		return $service;
	}


	/**
	 * @return TestClass2
	 */
	public function createServiceC2b()
	{
		$service = new TestClass2(1);
		return $service;
	}


	/**
	 * @return TestClass2
	 */
	public function createServiceC3a()
	{
		$service = new TestClass2(NULL, 2);
		return $service;
	}


	/**
	 * @return TestClass2
	 */
	public function createServiceC3b()
	{
		$service = new TestClass2(NULL, 2);
		return $service;
	}


	/**
	 * @return Nette\DI\Container
	 */
	public function createServiceContainer()
	{
		return $this;
	}


	/**
	 * @return TestClass
	 */
	public function createServiceD1()
	{
		$service = new TestClass;
		return $service;
	}


	/**
	 * @return TestClass
	 */
	public function createServiceD2()
	{
		$service = new TestClass;
		return $service;
	}


	/**
	 * @return TestClass2
	 */
	public function createServiceE1($a)
	{
		$service = new TestClass2($a);
		return $service;
	}


	/**
	 * @return TestClass2
	 */
	public function createServiceE2($a = NULL, $b = 1)
	{
		$service = new TestClass2($a, $b);
		return $service;
	}


	/**
	 * @return TestClass2
	 */
	public function createServiceE3($a)
	{
		$service = new TestClass2($a);
		return $service;
	}


	/**
	 * @return TestClass2
	 */
	public function createServiceE4($a)
	{
		$service = new TestClass2(NULL, $a);
		return $service;
	}


	/**
	 * @return ITestInterface
	 */
	public function createServiceF1()
	{
		return new Container_syntax_ITestInterfaceImpl_f1($this);
	}


	/**
	 * @return ITestInterface
	 */
	public function createServiceF2()
	{
		return new Container_syntax_ITestInterfaceImpl_f2($this);
	}


	/**
	 * @return ITestInterface2
	 */
	public function createServiceF3a()
	{
		return new Container_syntax_ITestInterface2Impl_f3a($this);
	}


	/**
	 * @return ITestInterface2
	 */
	public function createServiceF3b()
	{
		return new Container_syntax_ITestInterface2Impl_f3b($this);
	}


	/**
	 * @return ITestInterface3
	 */
	public function createServiceF4a()
	{
		return new Container_syntax_ITestInterface3Impl_f4a($this);
	}


	/**
	 * @return ITestInterface3
	 */
	public function createServiceF4b()
	{
		return new Container_syntax_ITestInterface3Impl_f4b($this);
	}


	/**
	 * @return ITestInterfaceGet
	 */
	public function createServiceF5()
	{
		return new Container_syntax_ITestInterfaceGetImpl_f5($this);
	}


	/**
	 * @return TestClass2
	 */
	public function createServiceF5s()
	{
		$service = new TestClass2;
		return $service;
	}


	/**
	 * @return ITestInterface
	 */
	public function createServiceF6()
	{
		return new Container_syntax_ITestInterfaceImpl_f6($this);
	}


	/**
	 * @return TestClass
	 */
	public function createServiceF6s()
	{
		$service = new TestClass;
		return $service;
	}


	/**
	 * @return ITestInterface3
	 */
	public function createServiceF7()
	{
		return new Container_syntax_ITestInterface3Impl_f7($this);
	}


	/**
	 * @return TestClass2
	 */
	public function createServiceF7s()
	{
		$service = new TestClass2;
		return $service;
	}


	/**
	 * @return TestClass2
	 */
	public function createServiceG1($a = NULL, $b = NULL)
	{
		$service = new TestClass2($a, $b);
		return $service;
	}


	/**
	 * @return TestClass2
	 */
	public function createServiceG2()
	{
		$service = $this->getService('g1');
		return $service;
	}


	/**
	 * @return TestClass2
	 */
	public function createServiceG3()
	{
		$service = $this->createServiceG1(1);
		return $service;
	}


	/**
	 * @return TestClass2
	 */
	public function createServiceG4($b)
	{
		$service = $this->createServiceG1(NULL, $b);
		return $service;
	}


	/**
	 * @return stdClass
	 */
	public function createServiceG5a()
	{
		$service = $this->getService('g1')->foo();
		if (!$service instanceof stdClass) {
			throw new Nette\UnexpectedValueException('Unable to create service \'g5a\', value returned by factory is not stdClass type.');
		}
		return $service;
	}


	/**
	 * @return stdClass
	 */
	public function createServiceG5b($bar)
	{
		$service = $this->getService('g1')->foo($bar);
		if (!$service instanceof stdClass) {
			throw new Nette\UnexpectedValueException('Unable to create service \'g5b\', value returned by factory is not stdClass type.');
		}
		return $service;
	}


	/**
	 * @return stdClass
	 */
	public function createServiceG5c($bar)
	{
		$service = $this->getService('g1')->foo($bar);
		if (!$service instanceof stdClass) {
			throw new Nette\UnexpectedValueException('Unable to create service \'g5c\', value returned by factory is not stdClass type.');
		}
		return $service;
	}


	/**
	 * @return stdClass
	 */
	public function createServiceG5d($bar1, $bar2)
	{
		$service = $this->createServiceG1($bar1)->foo($bar2);
		if (!$service instanceof stdClass) {
			throw new Nette\UnexpectedValueException('Unable to create service \'g5d\', value returned by factory is not stdClass type.');
		}
		return $service;
	}


	/**
	 * @return stdClass
	 */
	public function createServiceH1()
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


	/**
	 * @return stdClass
	 */
	public function createServiceH2()
	{
		$service = new stdClass;
		$service->hello($this->getService('h1'));
		$service->hi($this);
		My\Tracy\Bar::init($service);
		return $service;
	}


	public function initialize()
	{
		My\Tracy\Bar::init(1);
		My\Tracy\Bar::init(1, 2);
	}

}



final class Container_syntax_ITestInterfaceImpl_f1 implements ITestInterface
{
	private $container;


	public function __construct(Container_syntax $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = new TestClass;
		return $service;
	}

}



final class Container_syntax_ITestInterfaceImpl_f2 implements ITestInterface
{
	private $container;


	public function __construct(Container_syntax $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = new stdClass;
		return $service;
	}

}



final class Container_syntax_ITestInterface2Impl_f3a implements ITestInterface2
{
	private $container;


	public function __construct(Container_syntax $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = new TestClass2(1, 2);
		return $service;
	}

}



final class Container_syntax_ITestInterface2Impl_f3b implements ITestInterface2
{
	private $container;


	public function __construct(Container_syntax $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = new TestClass2(NULL, 2);
		return $service;
	}

}



final class Container_syntax_ITestInterface3Impl_f4a implements ITestInterface3
{
	private $container;


	public function __construct(Container_syntax $container)
	{
		$this->container = $container;
	}


	public function create($c)
	{
		$service = new TestClass2($c);
		return $service;
	}

}



final class Container_syntax_ITestInterface3Impl_f4b implements ITestInterface3
{
	private $container;


	public function __construct(Container_syntax $container)
	{
		$this->container = $container;
	}


	public function create($c)
	{
		$service = new TestClass2(1);
		return $service;
	}

}



final class Container_syntax_ITestInterfaceGetImpl_f5 implements ITestInterfaceGet
{
	private $container;


	public function __construct(Container_syntax $container)
	{
		$this->container = $container;
	}


	public function get()
	{
		$service = $this->container->getService('f5s');
		return $service;
	}

}



final class Container_syntax_ITestInterfaceImpl_f6 implements ITestInterface
{
	private $container;


	public function __construct(Container_syntax $container)
	{
		$this->container = $container;
	}


	public function create()
	{
		$service = $this->container->createServiceF6s();
		return $service;
	}

}



final class Container_syntax_ITestInterface3Impl_f7 implements ITestInterface3
{
	private $container;


	public function __construct(Container_syntax $container)
	{
		$this->container = $container;
	}


	public function create($c = 1)
	{
		$service = $this->container->createServiceF7s($c);
		return $service;
	}

}
