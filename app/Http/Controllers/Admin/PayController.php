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

class PayController extends Common
{
	public function payList()
	{
		$payList = Db::table('payment')->select('payment_id', 'logo', 'name', 'contents')->get();
		return view('admin/paylist', [
			'name' => '支付列表',
			'list' => $payList
		]);
	}

	public function payAdd(Request $request)
	{
		if ($_POST) {
			$data   = $request->all();
			$insert = [
				'name' 		=> $data['name'],
				'logo' 		=> $data['logo'],
				'contents'	=> $data['contents'],
				'is_open'	=> $data['open']
			];
			if (Db::table('payment')->insert($insert)) {
				return json_encode(['status' => '1', 'message' => '添加成功!']);
    		} else {
    			return json_encode(['status' => '2', 'message' => '添加失败!']);
    		}
		}
		return view('admin/payadd', [
			'name' => '添加支付'
		]);
	}

	public function payEdit()
	{}

	public function payDel($id)
	{
		/* 未做图片匹配删除 */
		if(Db::table('payment')->where('payment_id', $id)->delete()){
			return redirect('admin/paylist')->with('status', 'update successfully!');
		} else {
			return redirect('admin/paylist')->with('status', 'Update failed!');
		}
	}
}