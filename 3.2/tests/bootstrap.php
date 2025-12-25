<?php declare(strict_types=1);

use Contributte\Tester\Environment;

if (@!include __DIR__ . '/../vendor/autoload.php') {
	echo 'Install Nette Tester using `composer update --dev`';
	exit(1);
}

// Configure environment
Environment::setupTester();
Environment::setupTimezone('Europe/Prague');

// Setup variables
define('TEMP_DIR', __DIR__ . '/tmp/' . getmypid());
@mkdir(TEMP_DIR, 0777, true);
