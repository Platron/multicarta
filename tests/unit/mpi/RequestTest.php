<?php

namespace Platron\multicarta\tests\unit\mpi;

use PHPUnit\Framework\TestCase;
use DOMDocument;
use SimpleXMLElement;

abstract class RequestTest extends TestCase {

	/**
	 * @param string $xsdSchema
	 * @param string $actualXml
	 */
	protected function assertXmlContent(
		string $xsdSchema,
		string $actualXml
	) {
		$domDocument = new DOMDocument();
		$domDocument->loadXML($actualXml);
		$this->assertTrue(
			$domDocument->schemaValidateSource($xsdSchema)
		);
	}

	/**
	 * @param string $expectedVersion
	 * @param string $expectedEncoding
	 * @param string $actualXml
	 */
	protected function assertXmlHeader(
		string $expectedVersion,
		string $expectedEncoding,
		string $actualXml
	) {
		$domDocument = new DOMDocument();
		$domDocument->loadXML($actualXml);
		$this->assertEquals($expectedVersion, $domDocument->xmlVersion);
		$this->assertEquals($expectedEncoding, $domDocument->xmlEncoding);
	}
}
