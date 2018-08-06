<?php

namespace Platron\multicarta\tests\unit\mpi;

use Platron\multicarta\mpi\ProcessPaResRequest;

/*
	Пример запроса из документации
	<?xml version=”1.0” encoding=”UTF-8”?>
	<TKKPG>
		<Request>
			<Operation>ProcessPARes</Operation>
			<Order>
				<Merchant>CN</Merchant>
				<OrderID>OrderID</OrderID>
			</Order>
			<SessionID>SessionID</SessionID>
			<PARes></PARes>
			<PAN>PAN</PAN>
		</Request>
	</TKKPG>
*/
class ProcessPaResRequestTest extends RequestTest {

	const CORRECT_MERCHANT = 'Merchant';
	const CORRECT_PAN = '123456789';
	const CORRECT_ORDER_ID = 'OrderID';
	const CORRECT_SESSION_ID = 'SessionID';
	const CORRECT_PARES = 'PARes';

	public function testSuccess(){

		$request = new ProcessPaResRequest(
			self::CORRECT_MERCHANT,
			self::CORRECT_PAN,
			self::CORRECT_ORDER_ID,
			self::CORRECT_SESSION_ID,
			self::CORRECT_PARES
		);

		$expectedVersion = '1.0';
		$expectedEncoding = 'UTF-8';
		$xsdSchema = '<?xml version="1.0" encoding="UTF-8"?>
			<xs:schema xmlns:xs="http://www.w3.org/2001/XMLSchema">
				<xs:element name="TKKPG">
					<xs:complexType>
						<xs:all>
							<xs:element name="Request">
								<xs:complexType>
									<xs:all>
										<xs:element name="Operation" fixed="ProcessPARes"/>
										<xs:element name="SessionID" fixed="'.self::CORRECT_SESSION_ID.'"/>
										<xs:element name="PARes" fixed="'.self::CORRECT_PARES.'"/>
										<xs:element name="PAN" fixed="'.self::CORRECT_PAN.'"/>
										<xs:element name="Order">
											<xs:complexType>
												<xs:all>
													<xs:element name="Merchant" fixed="'.self::CORRECT_MERCHANT.'"/>
													<xs:element name="OrderID" fixed="'.self::CORRECT_ORDER_ID.'"/>
												</xs:all>
											</xs:complexType>
										</xs:element>
									</xs:all>
								</xs:complexType>
							</xs:element>
						</xs:all>
					</xs:complexType>
				</xs:element>
			</xs:schema>';

		$this->assertXmlHeader(
			$expectedVersion,
			$expectedEncoding,
			$request->asSimpleXml()->asXML()
		);
		$this->assertXmlContent(
			$xsdSchema,
			$request->asSimpleXml()->asXML()
		);
	}
}
