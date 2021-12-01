<?php


namespace oiran\walletlib\pool;


use pocketmine\scheduler\AsyncPool;
use pocketmine\scheduler\AsyncTask;

class ThreadPool
{
	private static AsyncPool $pool;

	public static function init(AsyncPool $pool) {
		self::$pool = $pool;
	}

	public static function submit(AsyncTask $task) {
		self::$pool->submitTask($task);
	}
}