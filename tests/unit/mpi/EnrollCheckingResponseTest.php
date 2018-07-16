<?php

namespace Platron\multicarta\tests\unit\mpi;

use Platron\multicarta\mpi\EnrollCheckingResponse;

/*
	Пример ответа из документации
	<?xml version="1.0" encoding="UTF-8"?>
	<TKKPG>
		<Response>
			<Operation>Check3DSEnrolled</Operation>
			<Status>NN</Status>
			<VERes>
				<ThreeDSecure>
					<Message id="VeReq_">
						<VERes>
							<version>1.0.2</version>
							<CH>
								<enrolled>Y</enrolled>
								<acctID>5#1911744</acctID>
							</CH>
							<url>URL ACS</url>
							<protocol>ThreeDSecure</protocol>
						</VERes>
					</Message>
				</ThreeDSecure>
			</VERes>
		</Response>
	</TKKPG>

	<?xml version="1.0" encoding="UTF-8"?>
	<TKKPG>
		<Response>
			<Operation>Check3DSEnrolled</Operation>
			<Status>NN</Status>
			<VERes>
				<ThreeDSecure>
					<Message id="VeReq_">
						<Error>
							<version>1.0.2</version>
							<errorCode>NN</errorCode>
							<errorMessage>Error Description</errorMessage>
							<errorDetail>Error Detail</errorDetail>
						</Error>
					</Message>
				</ThreeDSecure>
			</VERes>
			<POSECI></POSECI>
		</Response>
	</TKKPG>
*/
class EnrollCheckingResponseTest extends ResponseTest {

	const CORRECT_STATUS = '00';
	const CORRECT_OPERATION = 'Check3DSEnrolled';

	const CORRECT_ENROLLED = 'Y';
	const CORRECT_ACCT_ID = '5#1911744';
	const CORRECT_URL = 'url';
	const CORRECT_VERSION = '1.0.2';
	const CORRECT_ERROR_CODE = 'errorCode';
	const CORRECT_ERROR_MESSAGE = 'errorMessage';
	const CORRECT_ERROR_DETAIL = 'errorDetail';
	const CORRECT_PROTOCOL = 'ThreeDSecure';

	public function testSuccessResponse(){

		$Status = self::CORRECT_STATUS;
		$Operation = self::CORRECT_OPERATION;

		$enrolled = self::CORRECT_ENROLLED;
		$acctID = self::CORRECT_ACCT_ID;
		$url = self::CORRECT_URL;
		$version = self::CORRECT_VERSION;
		$protocol = self::CORRECT_PROTOCOL;

		$xml = '<?xml version="1.0" encoding="UTF-8"?>
			<TKKPG>
				<Response>
					<Operation>'.$Operation.'</Operation>
					<Status>'.$Status.'</Status>
					<VERes>
						<ThreeDSecure>
							<Message id="VeReq_">
								<VERes>
									<version>'.$version.'</version>
									<CH>
										<enrolled>'.$enrolled.'</enrolled>
										<acctID>'.$acctID.'</acctID>
									</CH>
									<url>'.$url.'</url>
									<protocol>'.$protocol.'</protocol>
								</VERes>
							</Message>
						</ThreeDSecure>
					</VERes>
				</Response>
			</TKKPG>';

		$response = new EnrollCheckingResponse($this->createSimpleXml($xml));

		$this->assertTrue($response->isValid());
		$this->assertTrue($response->isSuccess());
		$this->assertEquals($Status, $response->getStatus());
		$this->assertEquals($Operation, $response->getOperation());

		$this->assertFalse($response->hasError());

		$this->assertEquals($enrolled, $response->getEnrolled());
		$this->assertEquals($acctID, $response->getAcctID());
		$this->assertEquals($url, $response->getUrl());
		$this->assertEquals($version, $response->getVersion());
	}

	public function testError(){

		$Status = self::CORRECT_STATUS;
		$Operation = self::CORRECT_OPERATION;

		$version = self::CORRECT_VERSION;
		$errorCode = self::CORRECT_ERROR_CODE;
		$errorMessage = self::CORRECT_ERROR_MESSAGE;
		$errorDetail = self::CORRECT_ERROR_DETAIL;

		$xml = '<?xml version="1.0" encoding="UTF-8"?>
			<TKKPG>
				<Response>
					<Operation>'.$Operation.'</Operation>
					<Status>'.$Status.'</Status>
					<VERes>
						<ThreeDSecure>
							<Message id="VeReq_">
								<Error>
									<version>'.$version.'</version>
									<errorCode>'.$errorCode.'</errorCode>
									<errorMessage>'.$errorMessage.'</errorMessage>
									<errorDetail>'.$errorDetail.'</errorDetail>
								</Error>
							</Message>
						</ThreeDSecure>
					</VERes>
					<POSECI></POSECI>
				</Response>
			</TKKPG>';

		$response = new EnrollCheckingResponse($this->createSimpleXml($xml));

		$this->assertTrue($response->isValid());
		$this->assertFalse($response->isSuccess());
		$this->assertEquals($Status, $response->getStatus());
		$this->assertEquals($Operation, $response->getOperation());

		$this->assertTrue($response->hasError());

		$this->assertEquals($errorCode, $response->getErrorCode());
		$this->assertEquals($errorMessage, $response->getErrorMessage());
		$this->assertEquals($errorDetail, $response->getErrorDetail());
		$this->assertEquals($version, $response->getVersion());
	}
}
