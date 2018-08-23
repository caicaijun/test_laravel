<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Users extends Model
{
	protected $table 	  = 'users';	//设置表名
	protected $primaryKey = 'user_id';	// 设置主键
	public    $timestamps = false;		// 去掉默认的两个字段

    /*
		余额冻结金额处理
		收入类型冻结一天
		将冻结资金加入余额并修改状态
		@oarame $uid 用户id
	*/
	public static function moneyBalance($uid)
	{
		// 检查该用户即将解冻日期的总金额
		$money = Db::table('user_money_logs')
		->where('u_id', '=', $uid)
		->where('balance_status', '=', 0)
		->where('type', '=', 4)
		->where('freeze_time', '<', time())
		->sum('money_change');
		if (isset($money)) {
			// 修改该用户解冻资金状态
			Db::table('user_money_logs')
			->where('u_id', '=', $uid)
			->where('balance_status', '=', 0)
			->where('type', '=', 4)
			->where('freeze_time', '<', time())
			->update(['balance_status' => 1]);
			// 将该用户解冻资金加入账户余额
			Db::update("update bao_users set balance = balance + " . $money . " where user_id = " . $uid);
		}
	}
}