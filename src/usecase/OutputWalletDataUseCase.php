<?php


namespace oiran\walletlib\usecase;


use oiran\storage\OptionStorage;

class OutputWalletDataUseCase
{
	public static function execute(): array {
		$option = OptionStorage::getOption();
		return json_decode($option->getFullPath(), true);
	}
}