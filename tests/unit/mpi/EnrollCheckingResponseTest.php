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

		$xml = '<?xml version="1.0" encoding="UTF-8"?>
			<TKKPG>
				<Response>
					<Operation>'.self::CORRECT_OPERATION.'</Operation>
					<Status>'.self::CORRECT_STATUS.'</Status>
					<VERes>
						<ThreeDSecure>
							<Message id="VeReq_">
								<VERes>
									<version>'.self::CORRECT_VERSION.'</version>
									<CH>
										<enrolled>'.self::CORRECT_ENROLLED.'</enrolled>
										<acctID>'.self::CORRECT_ACCT_ID.'</acctID>
									</CH>
									<url>'.self::CORRECT_URL.'</url>
									<protocol>'.self::CORRECT_PROTOCOL.'</protocol>
								</VERes>
							</Message>
						</ThreeDSecure>
					</VERes>
				</Response>
			</TKKPG>';

		$response = new EnrollCheckingResponse($this->createSimpleXml($xml));

		$this->assertTrue($response->isValid());
		$this->assertTrue($response->isSuccess());
		$this->assertEquals(self::CORRECT_STATUS, $response->getStatus());
		$this->assertEquals(self::CORRECT_OPERATION, $response->getOperation());

		$this->assertFalse($response->hasError());

		$this->assertEquals(self::CORRECT_ENROLLED, $response->getEnrolled());
		$this->assertEquals(self::CORRECT_ACCT_ID, $response->getAcctID());
		$this->assertEquals(self::CORRECT_URL, $response->getUrl());
		$this->assertEquals(self::CORRECT_VERSION, $response->getVersion());
	}

	public function testError(){

		$xml = '<?xml version="1.0" encoding="UTF-8"?>
			<TKKPG>
				<Response>
					<Operation>'.self::CORRECT_OPERATION.'</Operation>
					<Status>'.self::CORRECT_STATUS.'</Status>
					<VERes>
						<ThreeDSecure>
							<Message id="VeReq_">
								<Error>
									<version>'.self::CORRECT_VERSION.'</version>
									<errorCode>'.self::CORRECT_ERROR_CODE.'</errorCode>
									<errorMessage>'.self::CORRECT_ERROR_MESSAGE.'</errorMessage>
									<errorDetail>'.self::CORRECT_ERROR_DETAIL.'</errorDetail>
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
		$this->assertEquals(self::CORRECT_STATUS, $response->getStatus());
		$this->assertEquals(self::CORRECT_OPERATION, $response->getOperation());

		$this->assertTrue($response->hasError());

		$this->assertEquals(self::CORRECT_ERROR_CODE, $response->getErrorCode());
		$this->assertEquals(self::CORRECT_ERROR_MESSAGE, $response->getErrorMessage());
		$this->assertEquals(self::CORRECT_ERROR_DETAIL, $response->getErrorDetail());
		$this->assertEquals(self::CORRECT_VERSION, $response->getVersion());
	}
}
