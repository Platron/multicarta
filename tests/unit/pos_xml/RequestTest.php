<?php

namespace Platron\multicarta\tests\unit\pos_xml;

use PHPUnit\Framework\TestCase;

abstract class RequestTest extends TestCase {

	/**
	 * @param array $expectedArrayRequest
	 * @param array $actualArrayRequest
	 */
	protected function assertArrayEquals(
		array $expectedArrayRequest,
		array $actualArrayRequest
	) {
		$this->assertEquals(
			$expectedArrayRequest,
			$actualArrayRequest
		);
	}
}
