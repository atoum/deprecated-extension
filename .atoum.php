<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'autoloader.php';

use mageekguy\atoum\deprecated;

$runner->addExtension(new deprecated\extension($script));
