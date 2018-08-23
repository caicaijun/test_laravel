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

class OrderController extends Common
{
	/*
		delivery配送方式表
		order订单信息表
		order_goods 订单商品表
	*/
	private $orderStatus = array(0 => '未付款', 1 => '取消订单', 2 => '待确认', 3 => '配送中', 4 => '交易成功');

	public function orderList()
	{
		$data 	  = Db::table('order')
		->leftJoin('delivery', 'order.mode', '=', 'delivery.id')
		->orderBy('order.create_time', 'DESC')->get();
		return view('admin/orderlist', [
			'name' 			=> '订单列表',
			'orderstatus'	=> $this->orderStatus,
			'orders' 		=> $data
		]);
	}

	/*
	*	生成24位唯一订单号码
	*	格式：YYYY-MMDD-HHII-SS-NNNN,NNNN-CC
	*	其中：YYYY=年份，MM=月份，DD=日期，HH=24格式小时，II=分，SS=秒，NNNNNNNN=随机数，CC=检查码
	*/
	public function orderNumber()
	{
		@date_default_timezone_set("PRC");
		//订购日期
		$order_date = date('Y-m-d');
		//订单号码主体（YYYYMMDDHHIISSNNNNNNNN）
		$order_id_main = date('YmdHis') . rand(10000000,99999999);
		//订单号码主体长度
		$order_id_len = strlen($order_id_main);
		$order_id_sum = 0;
		for ($i=0; $i<$order_id_len; $i++) {
			$order_id_sum += (int)(substr($order_id_main,$i,1));
		}
		//唯一订单号码（YYYYMMDDHHIISSNNNNNNNNCC）
		$order_id = $order_id_main . str_pad((100 - $order_id_sum % 100) % 100,2,'0',STR_PAD_LEFT);
		return $order_id;
	}

	public function orderDetail(Request $requst, $id)
	{
		$orderInfo = Db::table('order')->where('order_id', $id)->first();
		$data 	   = Db::table('order_goods')->where('order_id', $id)->get();
		return view('admin/orderdetail', [
			'name' => '订单详情',
			'info' => $orderInfo,
			'goods' => $data
		]);
	}

	public function orderDel($id)
	{
		/* 未做图片删除 */
    	if (Db::table('order')->where('order_id', $Id)->delete()) {
    		//未做订单商品表删除
    		return redirect('admin/orderlist')->with('status', '删除成功!');
    	} else {
    		return redirect('admin/orderlist')->with('status', '删除失败!');
    	}
	}

	/* 物理快递模块开始 order_express 物流表*/
	public function expressList()
	{
		$data = Db::table('order_express')->get();
		return view('admin/expresslist', [
			'express' => $data,
			'name' 	  => '快递公司列表'
		]);
	}

	public function expressAdd(Request $requst)
	{
		if ($_POST) {
			$data   = $requst->all();
			$insert = [
				'e_name' => $data['name'],
				'e_img'  => $data['e_img'],
				'closed' => $data['closed'],
				'e_des'  => strip_tags($data['des'])
			];
			if (Db::table('order_express')->insert($insert)) {
    			return json_encode(['status' => '1', 'message' => '添加成功!']);
    		} else {
    			return json_encode(['status' => '2', 'message' => '添加失败!']);
    		}
		} else {
			return view('admin/expressadd', [
			'name' => '快递公司添加'
			]);
		}
	}

	public function expressEdit()
	{

	}

	public function expressDel($express_id)
	{
		if (Db::table('order_express')->where('express_id', $express_id)->delete()) {
			return redirect('admin/expresslist')->with('status', '删除成功!');
    	} else {
    		return redirect('admin/expresslist')->with('status', '删除失败!');
    	}
	}
}