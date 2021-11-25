<?php


namespace oiran\model;


class Option
{
	public function __construct(
		private int $warningLevel,
		private string $dataFileName
	) {}

	public function getWarningLevel(): int {
		return $this->warningLevel;
	}

	public function getDataFileName(): string {
		return $this->dataFileName;
	}
}