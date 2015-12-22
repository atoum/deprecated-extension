<?php

namespace mageekguy\atoum\deprecated;

use mageekguy\atoum;
use mageekguy\atoum\observable;
use mageekguy\atoum\runner;
use mageekguy\atoum\test;

class extension implements atoum\extension
{
	protected $rescorer;

	public function __construct(atoum\configurator $configurator = null)
	{
		if ($configurator)
		{
			$parser = $configurator->getScript()->getArgumentsParser();

			$handler = function($script, $argument, $values) {
				$script->getRunner()->addTestsFromDirectory(dirname(__DIR__) . '/tests/units/classes');
			};

			$parser
				->addHandler($handler, array('--test-ext'))
				->addHandler($handler, array('--test-it'))
			;
		}

		$this->rescorer = new rescorer();
	}

	public function setRunner(runner $runner)
	{
		return $this;
	}

	/**
	 * @param test $test
	 *
	 * @return $this
	 */
	public function setTest(test $test)
	{
		return $this;
	}

	/**
	 * @param string $event
	 * @param observable $observable
	 */
	public function handleEvent($event, observable $observable)
	{
		if ($event == atoum\test::beforeTearDown && $observable instanceof \mageekguy\atoum\test) {
			$this->rescorer->rescore($observable->getScore());
		}
	}
}
