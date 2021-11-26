<?php


namespace oiran\walletlib\usecase;



use oiran\walletlib\storage\OptionStorage;

class OutputWalletDataUseCase
{
	public static function execute(): array {
		$option = OptionStorage::getOption();
		return json_decode($option->getFullPath(), true);
	}
}