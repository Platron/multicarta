<?php

namespace Platron\multicarta\tests\unit;

use Platron\multicarta\mpi\EnrollCheckingResponseParser;

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
class EnrollCheckingResponseParserTest extends ResponseParserTest {

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

		$parser = new EnrollCheckingResponseParser($this->createResponse($xml));

		$this->assertTrue($parser->isValid());
		$this->assertTrue($parser->isSuccess());
		$this->assertEquals($parser->getStatus(), $Status);
		$this->assertEquals($parser->getOperation(), $Operation);

		$this->assertFalse($parser->hasError());

		$this->assertEquals($enrolled, $parser->getEnrolled());
		$this->assertEquals($acctID, $parser->getAcctID());
		$this->assertEquals($url, $parser->getUrl());
		$this->assertEquals($version, $parser->getVersion());
	}

	public function testFailStatus(){

		$Status = '30';
		$Operation = self::CORRECT_OPERATION;

		$xml = '<?xml version="1.0" encoding="UTF-8"?>
			<TKKPG>
				<Response>
					<Operation>'.$Operation.'</Operation>
					<Status>'.$Status.'</Status>
				</Response>
			</TKKPG>';

		$parser = new EnrollCheckingResponseParser($this->createResponse($xml));

		$this->assertTrue($parser->isValid());
		$this->assertFalse($parser->isSuccess());
		$this->assertEquals($parser->getStatus(), $Status);
		$this->assertEquals($parser->getOperation(), $Operation);
	}

	public function testInvalidResponse(){

		$Status = self::CORRECT_STATUS;
		$Operation = 'Operation';

		$xml = '<?xml version="1.0" encoding="UTF-8"?>
			<TKKPG>
				<Response>
					<Operation>'.$Operation.'</Operation>
					<Status>'.$Status.'</Status>
				</Response>
			</TKKPG>';
		$parser = new EnrollCheckingResponseParser($this->createResponse($xml));

		$this->assertFalse($parser->isValid());
		$this->assertEquals($parser->getOperation(), $Operation);
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

		$parser = new EnrollCheckingResponseParser($this->createResponse($xml));

		$this->assertTrue($parser->isValid());
		$this->assertFalse($parser->isSuccess());
		$this->assertEquals($parser->getStatus(), $Status);
		$this->assertEquals($parser->getOperation(), $Operation);

		$this->assertTrue($parser->hasError());

		$this->assertEquals($errorCode, $parser->getErrorCode());
		$this->assertEquals($errorMessage, $parser->getErrorMessage());
		$this->assertEquals($errorDetail, $parser->getErrorDetail());
		$this->assertEquals($version, $parser->getVersion());
	}

	public function testFailEnrollment(){

		$Status = self::CORRECT_STATUS;
		$Operation = self::CORRECT_OPERATION;

		$enrolled = 'N';
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
									</CH>
									<protocol>'.$protocol.'</protocol>
								</VERes>
							</Message>
						</ThreeDSecure>
					</VERes>
				</Response>
			</TKKPG>';

		$parser = new EnrollCheckingResponseParser($this->createResponse($xml));

		$this->assertTrue($parser->isValid());
		$this->assertTrue($parser->isSuccess());
		$this->assertEquals($parser->getStatus(), $Status);
		$this->assertEquals($parser->getOperation(), $Operation);

		$this->assertFalse($parser->hasError());

		$this->assertFalse($parser->isEnrolled());

		$this->assertEquals($enrolled, $parser->getEnrolled());
		$this->assertEquals($version, $parser->getVersion());
	}

	public function testSuccessEnrollment(){

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

		$parser = new EnrollCheckingResponseParser($this->createResponse($xml));

		$this->assertTrue($parser->isValid());
		$this->assertTrue($parser->isSuccess());
		$this->assertEquals($parser->getStatus(), $Status);
		$this->assertEquals($parser->getOperation(), $Operation);

		$this->assertFalse($parser->hasError());

		$this->assertEquals($enrolled, $parser->getEnrolled());
		$this->assertEquals($acctID, $parser->getAcctID());
		$this->assertEquals($url, $parser->getUrl());
		$this->assertEquals($version, $parser->getVersion());
		
		$this->assertTrue($parser->isEnrolled());
	}
}
