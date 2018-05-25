<?php

namespace Platron\multicarta\pos_xml;

class PaymentResponseCode extends ResponseCode {
	const ACCOUNT_NOT_FOUND = '201'; // Счет не найден
	const INVALID_AMOUNT = '203'; // Неверная сумма
	const UNABLE_TO_PERFORM_AN_OPERATION = '204'; // Невозможно провести операцию
	const NO_FUNDS_ON_THE_ACCOUNT = '205'; // Нет средств на счете
	const INVALID_PAYMENT_INFORMATION = '206'; // Неверная информация о платеже
	const INVALID_TERMINAL_IDENTIFIER = '207'; // Неверный идентификатор терминала
	const CARD_EXPIRED = '301'; // Карта просрочена
	const REFUSAL_WITHOUT_EXPLANATION_OF_REASONS_FROM_THE_ISSUER = '302'; // Отказ без объяснения причин от эмитента
	const UNSUPPORTED_TRANSACTION = '303'; // Неподдерживаемая транзакция
	const TRANSACTION_IS_PROHIBITED_AT_THE_LEVEL_OF_THE_FINANCIAL_SYSTEM = '304'; // Транзакция запрещена на уровне финансового института
	const LOST_OR_STOLEN_CARD = '305'; // Потерянная или украденная карта
	const INVALID_CARD_STATUS = '306'; // Неверный статус карты
	const LIMITED_CARD = '307'; // Ограниченная карта
	const UNABLE_TO_AUTHORIZE = '308'; // Невозможно авторизовать
	const CARD_ACTIVITY_LIMIT_EXCEEDED = '309'; // Превышен лимит активности использования карты
	const EXCEEDED_THE_LIMIT_OF_THE_AMOUNT_OF_TRANSACTIONS_ON_THE_CARD = '310'; // Превышен лимит суммы операций по карте
	const NUMBER_OF_PIN_ATTEMPTS_EXCEEDED = '311'; // Превышено число попыток ввода PIN
	const CARD_NOT_SUPPORTED = '320'; // Карта не поддерживается
	const FORMAT_ERROR = '333'; // Ошибка формата
	const TIMEOUT_WHEN_MAKING_A_TRANSACTION = '334'; // Таймаут при совершении транзакции
	const SYSTEM_ERROR_396 = '396'; // Системная ошибка
	const YOU_NEED_TO_COMMUNICATE_WITH_THE_ISSUER = '401'; // Необходима связь с эмитентом (call issuer)
	const INVALID_DATA_VALUE_OF_THREE_D_SECURE = '410'; // Неверное значение данных 3D-Secure (CAVV)
	const INVALID_SECURE_CODE_VALUE = '411'; // Неверное значение CVV2/CVC2
	const CARD_EXPIRED_CARD_CAPTURE_REQUIRED = '501'; // Карта просрочена – необходим захват карты
	const REFUSAL_FROM_THE_ISSUER_YOU_NEED_TO_SEIZE_THE_CARD = '502'; // Отказ от эмитента – необходим захват карты
	const SYSTEM_ERROR_809 = '809'; // Системная ошибка

	// TODO need rename constant
}



























