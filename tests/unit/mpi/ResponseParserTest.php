<?php

namespace Platron\multicarta\tests\unit\mpi;

use PHPUnit\Framework\TestCase;
use SimpleXMLElement;

abstract class ResponseParserTest extends TestCase {

	public function createResponse(string $xml) {
		$response = new SimpleXMLElement($xml);
		return $response;
	}
}
