<?php

namespace Platron\multicarta;

use MyCLabs\Enum\Enum;

class OrderStatus extends Enum {
	const APPROVED = 'APPROVED';
	const DECLINED = 'DECLINED';
}