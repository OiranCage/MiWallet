<?php


namespace oiran;


use Exception;
use oiran\model\Option;
use oiran\storage\OptionStorage;

class WalletLib
{
	private static ?WalletLib $instance = null;

	/**
	 * @param string $dataFileName
	 * @param string $dataFilePath
	 * @param int $warningLevel
	 */
	public static function init(
		string $dataFileName,
		string $dataFilePath,
		int $warningLevel = WarningLevel::RETURN_FAILED_RESULT
	) {
		OptionStorage::init(new Option($warningLevel, $dataFileName));

		$dataFileName .= ".json";
		if(!file_exists($fullPath = $dataFilePath.$dataFileName)) {
			file_put_contents($fullPath, "{}");
		}
	}

	/**
	 * @return WalletLib
	 * @throws Exception
	 */
	public static function getInstance(): WalletLib {
		return self::$instance ?? throw new Exception("library not initialized.");
	}

	private function __construct() {}
}