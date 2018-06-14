<?php

namespace Platron\multicarta\pos_xml;

class ReversalResponseCode extends ResponseCode {
	const REVERSAL_INVALID_TERMINAL_IDENTIFIER = '207'; // Неверный идентификатор терминала
	const REVERSAL_ORIGINAL_OPERATION_NOT_FOUND = '208'; // Оригинальная операция не найдена
	const REVERSAL_UNABLE_TO_PERFORM_AN_OPERATION = '209'; // Невозможно провести операцию
	const REVERSAL_SYSTEM_ERROR = '809'; // Системная ошибка
	const REVERSAL_INVALID_SESSION_NUMBER = '888'; // Неверный номер сессии
}
