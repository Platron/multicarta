<?php

namespace Platron\multicarta\tests\unit\pos_xml;

use PHPUnit\Framework\TestCase;

abstract class RequestBuilderTest extends TestCase {

	/**
	 * @param array $expectedRequest
	 * @param array $actualRequest
	 */
	protected function assertArrayEquals(array $expectedRequest, array $actualRequest) {
		$this->assertEquals($expectedRequest, $actualRequest);
	}
}
