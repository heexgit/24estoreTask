<?php
namespace TwentyTwoEstore\Libs;

final class ErrorHandlersRegister
{
	public static function init()
	{
		self::registerErrorHandler();
		self::registerOrphanErrorHandler();
	}

	private static function registerErrorHandler ()
	{
		// converts a PHP error to the ErrorException
		set_error_handler(function($errno, $errstr, $errfile, $errline) {
			throw new \ErrorException($errstr, $errno, null, $errfile, $errline);
		}, E_ALL & ~E_NOTICE);
	}

	private static function registerOrphanErrorHandler ()
	{
		register_shutdown_function(function() {
			$error = error_get_last();
			// save a log info if there was an error left
			if (isset($error) && ($error['type'] & (\E_ERROR | \E_PARSE)) > 0) {
				Logger::Instance()->LogException(new \ErrorException($error['message'], $error['type'], null, $error['file'], $error['line']));
			}
		});
	}
}
