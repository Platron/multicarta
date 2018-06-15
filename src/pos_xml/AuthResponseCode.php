<?php

namespace Platron\multicarta\pos_xml;

abstract class AuthResponseCode extends ResponseCode {
	const AUTH_ACCOUNT_NOT_FOUND = '201'; // Счет не найден
	const AUTH_INVALID_AMOUNT = '203'; // Неверная сумма
	const AUTH_UNABLE_TO_PERFORM_AN_OPERATION = '204'; // Невозможно провести операцию
	const AUTH_NO_FUNDS_ON_THE_ACCOUNT = '205'; // Нет средств на счете
	const AUTH_INVALID_PAYMENT_INFORMATION = '206'; // Неверная информация о платеже
	const AUTH_INVALID_TERMINAL_IDENTIFIER = '207'; // Неверный идентификатор терминала
	const AUTH_CARD_EXPIRED = '301'; // Карта просрочена
	const AUTH_REFUSAL_WITHOUT_EXPLANATION_OF_REASONS_FROM_THE_ISSUER = '302'; // Отказ без объяснения причин от эмитента
	const AUTH_UNSUPPORTED_TRANSACTION = '303'; // Неподдерживаемая транзакция
	const AUTH_TRANSACTION_IS_PROHIBITED_AT_THE_LEVEL_OF_THE_FINANCIAL_SYSTEM = '304'; // Транзакция запрещена на уровне финансового института
	const AUTH_LOST_OR_STOLEN_CARD = '305'; // Потерянная или украденная карта
	const AUTH_INVALID_CARD_STATUS = '306'; // Неверный статус карты
	const AUTH_LIMITED_CARD = '307'; // Ограниченная карта
	const AUTH_UNABLE_TO_AUTHORIZE = '308'; // Невозможно авторизовать
	const AUTH_CARD_ACTIVITY_LIMIT_EXCEEDED = '309'; // Превышен лимит активности использования карты
	const AUTH_EXCEEDED_THE_LIMIT_OF_THE_AMOUNT_OF_TRANSACTIONS_ON_THE_CARD = '310'; // Превышен лимит суммы операций по карте
	const AUTH_NUMBER_OF_PIN_ATTEMPTS_EXCEEDED = '311'; // Превышено число попыток ввода PIN
	const AUTH_CARD_NOT_SUPPORTED = '320'; // Карта не поддерживается
	const AUTH_FORMAT_ERROR = '333'; // Ошибка формата
	const AUTH_TIMEOUT_WHEN_MAKING_A_TRANSACTION = '334'; // Таймаут при совершении транзакции
	const AUTH_SYSTEM_ERROR_FIRST = '396'; // Системная ошибка
	const AUTH_YOU_NEED_TO_COMMUNICATE_WITH_THE_ISSUER = '401'; // Необходима связь с эмитентом (call issuer)
	const AUTH_INVALID_DATA_VALUE_OF_THREE_D_SECURE = '410'; // Неверное значение данных 3D-Secure (CAVV)
	const AUTH_INVALID_SECURE_CODE_VALUE = '411'; // Неверное значение CVV2/CVC2
	const AUTH_CARD_EXPIRED_NEED_WITHDRAWAL = '501'; // Карта просрочена – необходим захват карты
	const AUTH_REFUSAL_FROM_THE_ISSUER_NEED_WITHDRAWAL = '502'; // Отказ от эмитента – необходим захват карты
	const AUTH_SYSTEM_ERROR_SECOND = '809'; // Системная ошибка
}
