<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\CommonController as Common;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;

use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;

use Storage;
use DB;

//数据模型
use App\Users;
use App\UserMoneyLogs;

class UserController extends Common
{
	public function userList()
	{
		$data = Db::table('users')->select('user_id', 'account', 'face', 'nickname', 'mobile', 'balance', 'email', 'rank_id')->where(['audit' => 1, 'closed' => 0])->paginate(15);
		//未关联会员等级表
		return view('admin/userlist', [
			'name' => '用户列表',
			'users'=> $data
		]);
	}

	// 会员关闭
	public function userClosed($uid, $closed)
	{
		/* 软关闭操作 */
		if ($closed == 1) {
			if (Db::table('users')->where('user_id', $uid)->update(['closed' => 1])) {
    			return redirect('admin/userlist')->with('status', '关闭成功!');
	    	} else {
	    		return redirect('admin/userlist')->with('status', '关闭失败!');
			}
		} elseif ($closed == 0) {
			if (Db::table('users')->where('user_id', $uid)->update(['closed' => 0])) {
    			return redirect('admin/userlist')->with('status', '开启成功!');
	    	} else {
	    		return redirect('admin/userlist')->with('status', '开启失败!');
			}
		} else {
			return redirect('admin/userlist')->with('status', '出错了，请刷新!');
		}
		
	}

	// 会员添加
	public function userAdd(Request $request)
	{
		if ($_POST) {
			$data = $request->all();
			if (!$data['face_file']) {
    			return json_encode(['status' => '3', 'message' => '请上传图片!']);
    		}
			$insert = [
				'account' 		   => $data['account'],
				'password'		   => md5($data['password']),
				'face'		   	   => $data['face_file'],
				'nickname'		   => $data['nickname'],
				'mobile'		   => $data['mobile'],
				'balance'		   => $data['balance'],
				'email' 		   => $data['email'],
				'rank_id'		   => 1, //会员等级 默认1级
				'audit'			   => 0,
				'reg_time'	   	   => $_SERVER['REQUEST_TIME']
			];
    		if (Db::table('users')->insert($insert)) {
    			return json_encode(['status' => '1', 'message' => '添加成功!']);
    		} else {
    			return json_encode(['status' => '2', 'message' => '添加失败!']);
    		}
		} else {
			return view('admin/userAdd', [
				'name' => '添加用户'
			]);
		}
	}

	// 会员详情
	public function userDetail($id)
	{
		if ($_POST) {

		} else {
			$detail = Db::table('users')->where('user_id', $id)->first();
			// 未设置副表
			return view('admin/userdetail', [
				'name' => '用户详情',
				'detail'=> $detail
			]);
		}
	}

	// 会员等级 
	public function userRank(Request $request)
	{
		if ($_POST) {
			$data = $request->all();
			$insert = [
				'rank_name' => $data['rankname'],
				'rebate'	=> $data['discount']
			];
			if (Db::table('user_rank')->insert($insert)) {
				echo '<script>alert("添加成功！")</script>';
			} else {
				echo '<script>alert("添加失败！")</script>';
			}
		}
		$rebate = Db::table('user_rank')->get();
		return view('admin/userrank', [
				'name' => '会员等级',
				'bate' => $rebate
			]);
	}

	// 会员等级删除
	public function rankDel($id)
	{
		if (Db::table('user_rank')->where('rank_id', $id)->delete()) {
			return redirect('admin/userrank')->with('prostatus', '删除成功!');
    	} else {
    		return redirect('admin/userrank')->with('prostatus', '删除失败!');
    	}
	}

	// 会员资金列表
	public function userFunding($uid)
	{
		// 余额与冻结资金的处理
		Users::moneyBalance($uid);
		// 账户余额
		$balance = Users::select('balance')->where('user_id', $uid)->first();
		//查询冻结资金
		$freeze = UserMoneyLogs::where('type', 4)->where('balance_status', '<>', 1)->where('u_id', $uid)->sum('money_change');
		var_dump($freeze);
		/*用户资金变动列表*/
		$funding = Db::table('user_money_logs')
		->leftJoin('user_money_type', 'user_money_logs.type', '=', 'user_money_type.type_id')
		->where('u_id', $uid)
		->orderBy('create_time', 'DESC')
		->get();
		return view('admin/userfunding', [
			'name' 		=> '用户资金管理',
			'balance'	=> $balance,		//账户余额
			'freeze'	=> $freeze,			//冻结资金
			'funding'	=> $funding
		]);
	}
}