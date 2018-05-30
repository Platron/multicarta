<?php

namespace Platron\multicarta\pos_xml;

class RefundResponseCode extends ResponseCode {
	const REFUND_INVALID_TERMINAL_IDENTIFIER = '207'; // Неверный идентификатор терминала
	const REFUND_ORIGINAL_OPERATION_NOT_FOUND = '208'; // Оригинальная операция не найдена
	const REFUND_UNABLE_TO_PERFORM_AN_OPERATION = '209'; // Невозможно провести операцию
	const REFUND_SYSTEM_ERROR = '809'; // Системная ошибка
	const REFUND_INVALID_SESSION_NUMBER = '888'; // Неверный номер сессии

	// TODO need to rename constant
}
