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

		$Merchant = self::CORRECT_MERCHANT;
		$PAN = self::CORRECT_PAN;
		$OrderID = self::CORRECT_ORDER_ID;
		$SessionID = self::CORRECT_SESSION_ID;

		$request = new EnrollCheckingRequest(
			$Merchant,
			$PAN,
			$OrderID,
			$SessionID
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
										<xs:element name="SessionID" fixed="'.$SessionID.'"/>
										<xs:element name="PAN" fixed="'.$PAN.'"/>
										<xs:element name="Order">
											<xs:complexType>
												<xs:all>
													<xs:element name="Merchant" fixed="'.$Merchant.'"/>
													<xs:element name="OrderID" fixed="'.$OrderID.'"/>
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
