<?php

namespace mageekguy\atoum\deprecated\tests\units;

use
	mageekguy\atoum,
	mageekguy\atoum\deprecated\rescorer as testedClass
;

class rescorer extends atoum\test
{
	public function testSimpleRescore()
	{
		$failedAssertion = array(
			'id' => 1,
			'case' => NULL,
			'dataSetKey' => NULL,
			'dataSetProvider' => NULL,
			'class' => 'titi\\tests\\units\\foo',
			'method' => 'testBar',
			'file' => '/home/agallou/tests/test-atoum-deprecated/test.php',
			'line' => 28,
			'asserter' => 'mageekguy\\atoum\\asserters\\phpString()',
			'fail' => 'strings are not equal
-Expected
+Actual
@@ -1 +1 @@
-string(3) "bar"
+string(4) "bara"',
		);

		$error = array(
			'case' => NULL,
			'dataSetKey' => NULL,
			'dataSetProvider' => NULL,
			'class' => 'titi\\tests\\units\\foo',
			'method' => 'testBar',
			'file' => '/home/agallou/tests/test-atoum-deprecated/test.php',
			'line' => 27,
			'type' => 16384,
			'message' => 'Deprecated since 2.0. use ->bar instead',
			'errorFile' => '/home/agallou/tests/test-atoum-deprecated/test.php',
			'errorLine' => 10,
		);

		$score = new \mageekguy\atoum\test\score();
		$score->addFail($failedAssertion['file'], $failedAssertion['class'], $failedAssertion['method'], $failedAssertion['line'], $failedAssertion['asserter'], null, $failedAssertion['case'], $failedAssertion['dataSetKey'], $failedAssertion['dataSetProvider']);
		$score->addError($error['file'], $error['class'], $error['method'], $error['line'], $error['type'], $error['message'], $error['errorFile'], $error['errorLine'], $error['case'], $error['dataSetKey'], $error['dataSetProvider']);


		$this
			->given($testedClass = new testedClass)
				->and($score)
			->if($testedClass->rescore($score))
			->then
				->array($score->getErrors())
					->isEmpty()
				->array($score->getFailAssertions())
					->hasSize(1)
				->array($score->getOutputs())
					->hasSize(1)
					->array[0]
						->isEquaLTo(array(
							'class' => 'titi\tests\units\foo',
							'method' => 'testBar',
							'value' => 'Deprecated since 2.0. use ->bar instead',
						))

		;
	}
}



