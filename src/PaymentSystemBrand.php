<?php

namespace Platron\multicarta;

use MyCLabs\Enum\Enum;

class PaymentSystemBrand extends Enum {
	const VISA = 'VISA';
	const MASTERCARD = 'MC';
	const MIR = 'MIR';
}