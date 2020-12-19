<?php

/**
 * This file is part of Cxz
 *
 * (c) Cxz 2020 <https://github.com/flaravel/cxz>
 *
 */

namespace App\Traits;

trait MigrateTrait {
	/**
	 * 表注释生成
	 *
	 * @param string $tableName 表名称
	 * @param string $comment   表注释
	 */
	public function createTableName(string $tableName, string $comment = '') {
		$prefix = config('database.connections.mysql.prefix');
		\Illuminate\Support\Facades\DB::statement("ALTER TABLE `{$prefix}{$tableName}` comment '{$comment}'");
	}
}
