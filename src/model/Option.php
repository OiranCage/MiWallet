<?php


namespace oiran\walletlib\model;


class Option
{
	private string $fullPath;

	public function __construct(
		private int $warningLevel,
		private string $dataFileName,
		private string $folderPath
	) {
		$this->fullPath = $this->folderPath.$this->dataFileName;
	}

	public function getWarningLevel(): int {
		return $this->warningLevel;
	}

	public function getDataFileName(): string {
		return $this->dataFileName;
	}

	public function getFolderPath(): string {
		return $this->folderPath;
	}

	public function getFullPath(): string {
		return $this->fullPath;
	}
}