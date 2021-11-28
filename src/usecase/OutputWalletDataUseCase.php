<?php


namespace oiran\walletlib\usecase;


use oiran\walletlib\pool\OptionPool;

class OutputWalletDataUseCase
{
	public static function execute(): array {
		$option = OptionPool::getOption();
		return json_decode(file_get_contents($option->getFullPath()), true);
	}
}