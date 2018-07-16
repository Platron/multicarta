<?php

namespace Platron\multicarta\tests\unit\mpi;

use PHPUnit\Framework\TestCase;
use SimpleXMLElement;

abstract class ResponseTest extends TestCase {

	public function createSimpleXml(string $xml) {
		$response = new SimpleXMLElement($xml);
		return $response;
	}
}
