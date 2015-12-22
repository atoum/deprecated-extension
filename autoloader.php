<?php

namespace mageekguy\atoum\deprecated;

use mageekguy\atoum;

atoum\autoloader::get()
	->addNamespaceAlias('atoum\deprecated', __NAMESPACE__)
	->addDirectory(__NAMESPACE__, __DIR__ . DIRECTORY_SEPARATOR . 'classes');
;
