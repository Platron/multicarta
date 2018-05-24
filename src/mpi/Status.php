<?php

namespace Platron\multicarta\mpi;

use MyCLabs\Enum\Enum;

class Status extends Enum {
	const SUCCESS = '00';
	const INVALID_MESSAGE_FORMAT = '30';
	const ACCESS_DENIED = '10';
	const INVALID_OPERATION = '54';
	const PARSE_ERROR = '60';
	const SYSTEM_ERROR = '96';
}