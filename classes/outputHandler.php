<?php

namespace mageekguy\atoum\deprecated;

use mageekguy\atoum\cli\colorizer;
use mageekguy\atoum\cli\prompt;
use mageekguy\atoum\deprecated\report\fields\runner\deprecations\cli;
use mageekguy\atoum\runner;

class outputHandler
{
	/**
	 * @param runner $runner
	 * @param rescorer $rescorer
	 */
	public function handle(runner $runner, rescorer $rescorer)
	{
		$cliReport = $this->getCliReport($runner);

		if (null === $cliReport) {
			return;
		}

		$defaultColorizer = new colorizer('1;36');
		$firstLevelPrompt = new prompt('> ');
		$secondLevelPrompt = new prompt('=> ', $defaultColorizer);

		$runnerOutputsField = new cli($rescorer);
		$runnerOutputsField->setTitlePrompt($firstLevelPrompt);
		$runnerOutputsField->setTitleColorizer($defaultColorizer);
		$runnerOutputsField->setMethodPrompt($secondLevelPrompt);

		$cliReport->addField($runnerOutputsField);
	}

	/**
	 * @param runner $runner
	 *
	 * @return atoum\reports\realtime\cli|null
	 */
	protected function getCliReport(runner $runner)
	{
		$cliReport = null;

		foreach ($runner->getReports() as $report) {
			if ($report instanceof \mageekguy\atoum\reports\realtime\cli) {
				$cliReport = $report;
			}
		}

		return $cliReport;
	}
}
