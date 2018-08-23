<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\CommonController as Common;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use DB;

class IndexController extends Common
{
    /*订单状态未建表*/
    private $orderStatus = array(0 => '未付款', 1 => '取消订单', 2 => '待确认', 3 => '配送中', 4 => '交易成功');

    public function index()
    {
    	//var_dump(session()->get('admin'));
        /* 首页订单列表显示  */
    	$order = DB::table('order')->select('order_sn', 'username', 'mobile_fan', 'addr', 'total_price', 'status')->orderBy('create_time', 'DESC')->get();
    	return view('admin/index', [
            'name'        => '后台管理系统',
            'order'       => $order,
            'orderStatus' => $this->orderStatus
        ]);
    }

    public function webSetting(Request $request)
    {
    	if ($_POST) {
            $data = $request->all();
            $update = [
                'name'        => $data['name'],
                'logo'        => $data['logo'],
                'describe'    => $data['describe'],
                'keyword'     => $data['keyword'],
                'province_id' => $data['province'],
                'city_id'     => $data['city'],
                'addr'        => $data['addr']
            ];
            if (Db::table('websetting')->update($update)) {
                return redirect('admin/websetting')->with('status', 'update succeed!');
            } else {
                return redirect('admin/websetting')->with('status', 'Update failed!');
            }
    	}
        $data = Db::table('websetting')->first();
    	$pro = Db::table('city')->select('city_id', 'name')->get();
        if ($data->province_id) {
            $city = Db::table('area')->select('area_id', 'area_name')->where('city_id', $data->province_id)->get();
        }
    	return view('admin/websetting', [
    		'name' => '网站设置',
    		'prov' => $pro,
    		'citys' => $city,
    		'web'  => $data	
    	]);
    }
}


