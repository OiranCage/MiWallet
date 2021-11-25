<?php


namespace oiran;


use Exception;

class WalletLib
{
	private static ?WalletLib $instance = null;

	public static function init() {
	}

	/**
	 * @return WalletLib
	 * @throws Exception
	 */
	public static function getInstance(): WalletLib {
		return self::$instance ?? throw new Exception("library not initialized.");
	}
}