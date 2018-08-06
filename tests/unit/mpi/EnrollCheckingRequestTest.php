<?php

namespace Platron\multicarta\tests\unit\mpi;

use Platron\multicarta\mpi\EnrollCheckingRequest;

/*
	Пример запроса из документации
	<?xml version=”1.0” encoding=”UTF-8”?>
	<TKKPG>
		<Request>
			<Operation>Check3DSEnrolled</Operation>
			<SessionID>SessionID</SessionID>
			<Order>
				<Merchant>CN</Merchant>
				<OrderID>OrderID</OrderID>
			</Order>
			<PAN>PAN</PAN>
		</Request>
	</TKKPG>
*/
class EnrollCheckingRequestTest extends RequestTest {

	const CORRECT_MERCHANT = 'Merchant';
	const CORRECT_PAN = '123456789';
	const CORRECT_ORDER_ID = 'OrderID';
	const CORRECT_SESSION_ID = 'SessionID';

	public function testSuccess(){

		$request = new EnrollCheckingRequest(
			self::CORRECT_MERCHANT,
			self::CORRECT_PAN,
			self::CORRECT_ORDER_ID,
			self::CORRECT_SESSION_ID
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
										<xs:element name="Operation" fixed="Check3DSEnrolled"/>
										<xs:element name="SessionID" fixed="'.self::CORRECT_SESSION_ID.'"/>
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
