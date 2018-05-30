<?php

namespace Platron\multicarta\pos_xml;

class RefundResponseCode extends ResponseCode {
	REFUND_INVALID_TERMINAL_IDENTIFIER = '207'; // Неверный идентификатор терминала
	REFUND_ORIGINAL_OPERATION_NOT_FOUND = '208'; // Оригинальная операция не найдена
	REFUND_UNABLE_TO_PERFORM_AN_OPERATION = '209'; // Невозможно провести операцию
	REFUND_SYSTEM_ERROR = '809'; // Системная ошибка
	REFUND_INVALID_SESSION_NUMBER = '888'; // Неверный номер сессии

	// TODO need to rename constant
}
