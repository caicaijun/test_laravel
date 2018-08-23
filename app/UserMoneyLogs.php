<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class UserMoneyLogs extends Model
{
	protected $table 	  = 'user_money_logs';	//设置表名
	protected $primaryKey = 'id';	// 设置主键
	public    $timestamps = false;		// 去掉默认的两个字段


}