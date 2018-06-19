<?php

namespace Platron\multicarta\pos_xml;

use MyCLabs\Enum\Enum;

class Mita extends Enum {
	const INITIATION_BY_MERCHANT = '1';
	const INITIATION_BY_CARDHOLDER = '2';
	const START_RECURRING = '4';
}