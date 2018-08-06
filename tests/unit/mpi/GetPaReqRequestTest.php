<?php

namespace Platron\multicarta\tests\unit\mpi;

use Platron\multicarta\mpi\GetPaReqRequest;
use DateTime;

/*
	Пример запроса из документации
	<?xml version=”1.0” encoding=”UTF-8”?>
	<TKKPG>
		<Request>
			<Operation>GetPAReqForm</Operation>
			<Order>
				<Merchant>CN</Merchant>
				<OrderID>OrderID</OrderID>
			</Order>
			<SessionID>SessionI </SessionID>
			<PAN>PAN</PAN>
			<ExpDate>YYMM</ExpDate>
			<EncodedPAReq>true</EncodedPAReq>
		</Request>
	</TKKPG>
*/
class GetPaReqRequestTest extends RequestTest {

	const CORRECT_MERCHANT = 'Merchant';
	const CORRECT_PAN = '123456789';
	const CORRECT_ORDER_ID = 'OrderID';
	const CORRECT_SESSION_ID = 'SessionID';
	const CORRECT_EXP_DATE = '1901';

	public function testSuccess(){

		$request = new GetPaReqRequest(
			self::CORRECT_MERCHANT,
			self::CORRECT_PAN,
			self::CORRECT_ORDER_ID,
			self::CORRECT_SESSION_ID,
			DateTime::createFromFormat('ym', self::CORRECT_EXP_DATE)
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
										<xs:element name="EncodedPAReq" fixed="true"/>
										<xs:element name="Operation" fixed="GetPAReqForm"/>
										<xs:element name="SessionID" fixed="'.self::CORRECT_SESSION_ID.'"/>
										<xs:element name="PAN" fixed="'.self::CORRECT_PAN.'"/>
										<xs:element name="ExpDate" fixed="'.self::CORRECT_EXP_DATE.'"/>
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
