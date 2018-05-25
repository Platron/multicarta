<?php

namespace Platron\multicarta\pos_xml;

use MyCLabs\Enum\Enum;

class ResponseCode extends Enum {
	const SUCCESS = '000'; // Обработка завершена успешно
	const UNSUPPORTED_VERSION = '001'; // Неподдерживаемая версия
	const UNSUPPORTED_LANGUAGE = '002'; // Неподдерживаемый язык
	const UNSUPPORTED_COMMAND = '003'; // Неподдерживаемая команда
	const AUTHENTICATION_FAILED = '004'; // Ошибка аутентификации (неверный сертификат)
	const PARSE_ERROR = '005'; // Ошибка разбора сообщения
	const SYSTEM_ERROR = '006'; // Системная ошибка
	const CRYPTOGRAPHY_ERROR = '007'; // Ошибка криптографии
	const TIMEOUT = '008'; // Таймаут
	const PARAMETER_COUNT_ERROR = '009'; // Неверное число параметров
	const ZERO_TRANSACTION_AMOUNT = '010'; // Нулевая сумма операции
	const ORIGINAL_TRANSACTION_NOT_FOUND = '011'; // Оригинальная транзакция не найдена
	const DUPLICATE_UNIQUE_TRANSACTION_NUMBER = '012'; // Дубликат уникального номера операции (INVOICE)
}