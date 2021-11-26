<?php


namespace oiran\walletlib\lib;


class WarningLevel
{
	// It will not alert you when the Wallet::moneyAmount changes.
	public const NONE = 0;

	// Throws an exception if the value of Wallet::moneyAmount is invalid.
	public const THROW_EXCEPTION = 1;

	// If the value of Wallet::moneyAmount is invalid, the method will return false.
	public const DO_NOT_PROCESS = 2;

	private function __construct() {}
}