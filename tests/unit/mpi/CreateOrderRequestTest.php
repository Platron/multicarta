<?php

namespace Platron\multicarta\tests\unit\mpi;

use Platron\multicarta\mpi\CreateOrderRequest;
use Platron\multicarta\CurrencyCode;
use Platron\multicarta\mpi\InterfaceLanguage;

/*
	Пример запроса из документации
	<?xml version="1.0" encoding="UTF-8"?>
	<TKKPG>
		<Request>
			<Operation>CreateOrder</Operation>
			<Language>LANG</Language>
			<Order>
				<Merchant>CN</Merchant>
				<Amount>TrxAmt</Amount>
				<Currency>TrxCur</Currency>
				<Description>TextOrderDescription</Description>
				<OrderType>3DSOnly</OrderType>
				<AddParams>
					<TDSVendorMerID>MerchantID</TDSVendorMerID>
					<TDSVendorName>MerchantName</TDSVendorName>
				</AddParams>
			</Order>
		</Request>
	</TKKPG>
*/
class CreateOrderRequestTest extends RequestTest {

	const CORRECT_LANGUAGE = 'RU';
	const CORRECT_MERCHANT = 'Merchant';
	const CORRECT_AMOUNT = 100;
	const CORRECT_CURRENCY = '643';
	const CORRECT_DESCRIPTION = 'Description';
	const CORRECT_TDS_VENDORMER_ID = 'TDSVendorMerID';
	const CORRECT_TDS_VENDOR_NAME = 'TDSVendorName';

	public function testSuccessRequest(){

		$request = new CreateOrderRequest(
			self::CORRECT_MERCHANT,
			self::CORRECT_AMOUNT,
			self::CORRECT_DESCRIPTION,
			new CurrencyCode(self::CORRECT_CURRENCY),
			new InterfaceLanguage(self::CORRECT_LANGUAGE),
			self::CORRECT_TDS_VENDORMER_ID,
			self::CORRECT_TDS_VENDOR_NAME
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
										<xs:element name="Operation" fixed="CreateOrder"/>
										<xs:element name="Language" fixed="'.self::CORRECT_LANGUAGE.'"/>
										<xs:element name="Order">
											<xs:complexType>
												<xs:all>
													<xs:element name="Merchant" fixed="'.self::CORRECT_MERCHANT.'"/>
													<xs:element name="Amount" fixed="'.self::CORRECT_AMOUNT.'"/>
													<xs:element name="Currency" fixed="'.self::CORRECT_CURRENCY.'"/>
													<xs:element name="Description" fixed="'.self::CORRECT_DESCRIPTION.'"/>
													<xs:element name="OrderType" fixed="3DSOnly"/>
													<xs:element name="AddParams">
														<xs:complexType>
															<xs:all>
																<xs:element name="TDSVendorMerID" fixed="'.self::CORRECT_TDS_VENDORMER_ID.'"/>
																<xs:element name="TDSVendorName" fixed="'.self::CORRECT_TDS_VENDOR_NAME.'"/>
															</xs:all>
														</xs:complexType>
													</xs:element>
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
