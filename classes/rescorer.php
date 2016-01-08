<?php

namespace mageekguy\atoum\deprecated;

class rescorer
{

	protected $errors = array();

	/**
	 * @param \mageekguy\atoum\test\score $score
	 *
	 * @return \mageekguy\atoum\test\score
	 */
	public function rescore(\mageekguy\atoum\test\score $score)
	{
		foreach ($score->getErrors() as $key => $error) {
			if (!($error['type'] & E_USER_DEPRECATED)) {
				continue;
			}
			$score->deleteError($key);

			$this->errors[] = $error;
		}
	}

	/**
	 * @return array
	 */
	public function getErrors()
	{
		return $this->errors;
	}
}
