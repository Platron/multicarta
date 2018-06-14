<?php

namespace Platron\multicarta\pos_xml;

class PaymentResponseCode extends ResponseCode {
	const PAYMENT_ACCOUNT_NOT_FOUND = '201'; // Счет не найден
	const PAYMENT_INVALID_AMOUNT = '203'; // Неверная сумма
	const PAYMENT_UNABLE_TO_PERFORM_AN_OPERATION = '204'; // Невозможно провести операцию
	const PAYMENT_NO_FUNDS_ON_THE_ACCOUNT = '205'; // Нет средств на счете
	const PAYMENT_INVALID_PAYMENT_INFORMATION = '206'; // Неверная информация о платеже
	const PAYMENT_INVALID_TERMINAL_IDENTIFIER = '207'; // Неверный идентификатор терминала
	const PAYMENT_CARD_EXPIRED = '301'; // Карта просрочена
	const PAYMENT_REFUSAL_WITHOUT_EXPLANATION_OF_REASONS_FROM_THE_ISSUER = '302'; // Отказ без объяснения причин от эмитента
	const PAYMENT_UNSUPPORTED_TRANSACTION = '303'; // Неподдерживаемая транзакция
	const PAYMENT_TRANSACTION_IS_PROHIBITED_AT_THE_LEVEL_OF_THE_FINANCIAL_SYSTEM = '304'; // Транзакция запрещена на уровне финансового института
	const PAYMENT_LOST_OR_STOLEN_CARD = '305'; // Потерянная или украденная карта
	const PAYMENT_INVALID_CARD_STATUS = '306'; // Неверный статус карты
	const PAYMENT_LIMITED_CARD = '307'; // Ограниченная карта
	const PAYMENT_UNABLE_TO_AUTHORIZE = '308'; // Невозможно авторизовать
	const PAYMENT_CARD_ACTIVITY_LIMIT_EXCEEDED = '309'; // Превышен лимит активности использования карты
	const PAYMENT_EXCEEDED_THE_LIMIT_OF_THE_AMOUNT_OF_TRANSACTIONS_ON_THE_CARD = '310'; // Превышен лимит суммы операций по карте
	const PAYMENT_NUMBER_OF_PIN_ATTEMPTS_EXCEEDED = '311'; // Превышено число попыток ввода PIN
	const PAYMENT_CARD_NOT_SUPPORTED = '320'; // Карта не поддерживается
	const PAYMENT_FORMAT_ERROR = '333'; // Ошибка формата
	const PAYMENT_TIMEOUT_WHEN_MAKING_A_TRANSACTION = '334'; // Таймаут при совершении транзакции
	const PAYMENT_SYSTEM_ERROR_FIRST = '396'; // Системная ошибка
	const PAYMENT_YOU_NEED_TO_COMMUNICATE_WITH_THE_ISSUER = '401'; // Необходима связь с эмитентом (call issuer)
	const PAYMENT_INVALID_DATA_VALUE_OF_THREE_D_SECURE = '410'; // Неверное значение данных 3D-Secure (CAVV)
	const PAYMENT_INVALID_SECURE_CODE_VALUE = '411'; // Неверное значение CVV2/CVC2
	const PAYMENT_CARD_EXPIRED_NEED_WITHDRAWAL = '501'; // Карта просрочена – необходим захват карты
	const PAYMENT_REFUSAL_FROM_THE_ISSUER_NEED_WITHDRAWAL = '502'; // Отказ от эмитента – необходим захват карты
	const PAYMENT_SYSTEM_ERROR_SECOND = '809'; // Системная ошибка
}
