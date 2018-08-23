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

class ProductController extends Common
{
    public function proList()
    {
    	$goods = Db::table('goods')
    	->select('goods_id', 'title', 'photo', 'audit', 'cate_id', 'brand_id')
    	->orderBy('create_time', 'DESC')
    	->paginate(10);
    	return view('admin/prolist', [
    		'name'  => '后台-商品列表',
    		'goods' => $goods
    	]);
    }

    public function proDelet($goodsId)
    {
    	/* 未做图片删除 */
    	if (Db::table('goods')->where('goods_id', $goodsId)->delete()) {
    		return redirect('admin/prolist')->with('prostatus', '删除成功!');
    	} else {
    		return redirect('admin/prolist')->with('prostatus', '删除失败!');
    	}
    	
    }

    public function upload(Request $request)
    {
            $file = $request->file('photo_file');
            // var_dump($file);exit();
            // 文件是否上传成功
            if(!$request->hasFile('photo_file'))
            {
                exit('上传的文件不存在！');
            }
            if ($file->isValid()) {
                // 获取文件相关信息
                $originalName = $file->getClientOriginalName(); // 文件原名
                $ext = $file->getClientOriginalExtension();     // 扩展名
                $realPath = $file->getRealPath();   //临时文件的绝对路径
                $type = $file->getClientMimeType();     // image/jpeg
                // 上传文件
                $filename = date('Y-m-d') . '-' . uniqid() . '.' . $ext; //拼接文件名
                // 将文件存入指定的目录
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
                return $filename;
            }
    }
    
    public function proDetail(Request $request)
    {
    	if ($_POST) {
			$data = $request->all();
			if (!$data['price']) {
    			return json_encode(['status' => '3', 'message' => '请上传图片!']);
    		}
			$insert = [
				'title' 		   => $data['title'],
				'cate_id'		   => $data['cateId'],	//类型
				'brand_id'		   => $data['brandId'],	//品牌类
				'shop_id'		   => $data['shop_id'],
				'photo'			   => $data['picture'],
				'recommends' 	   => $data['recommends'], //推荐类
				'price'			   => $data['price'],	//预设价
				'settlement_price' => $data['set_price'], //结算价
				'details'		   => strip_tags($data['details']),
				'create_time'	   => $_SERVER['REQUEST_TIME']
			];
    		if (Db::table('goods')->insert($insert)) {
    			return json_encode(['status' => '1', 'message' => '添加成功!']);
    		} else {
    			return json_encode(['status' => '2', 'message' => '添加失败!']);
    		}
    	} else {
    		/* 虚拟品牌 */
    		$brand = [ 1 => array('brand_id' => 1, 'brand_name' => '阿迪达斯'), 2 => array('brand_id' => 2, 'brand_name' => '耐克'), 3 => array('brand_id' => 3, 'brand_name' => '贵人鸟'), 4 => array('brand_id' => 4, 'brand_name' => '美特斯邦威')];
    		$cate  = Db::table('goods_cate')
    		->select('cate_id', 'cate_name')
    		->orderBy('cate_id', 'ASC')
    		->get();
    		return view('admin/prodetail', [
    		'name' 		=> '后台-商品详情',
    		'brand'		=> $brand,
    		'cate'		=> $cate
    		]);
    	}
    }

    public function stringHtml($content)
    {

    }
	/*
	*	产品修改
	*/
    public function proEdit(Request $request, $goodsId)
    {
    	if ($_POST) {
    		$data    = $request->all();
			$update = [
				'title' 		   => $data['title'],
				'cate_id'		   => $data['cateId'],	//类型
				'brand_id'		   => $data['brandId'],	//品牌类
				'shop_id'		   => $data['shop_id'],
				'photo'			   => $data['picture'],
				'recommends' 	   => $data['recommends'], //推荐类
				'price'			   => $data['price'],	//预设价
				'settlement_price' => $data['set_price'], //结算价
				'details'		   => strip_tags($data['details']),
				'create_time'	   => $_SERVER['REQUEST_TIME']
			];
    		if (Db::table('goods')->where('goods_id', $goodsId)->update($update)) {
    			return json_encode(['status' => '1', 'message' => '修改成功!']);
    		} else {
    			return json_encode(['status' => '2', 'message' => '修改失败!']);
    		}
    	} else {
    		$details = Db::table('goods')->where('goods_id', $goodsId)->first();
    		$brand   = Db::table('goods_brand')->get();
    		$cate  = Db::table('goods_cate')
    		->select('cate_id', 'cate_name')
    		->orderBy('cate_id', 'ASC')
    		->get();
    		return view('admin/proedit', [
    		'name' 		=> '后台-商品详情',
    		'brand'		=> $brand,
    		'cate'		=> $cate,
    		'goodsId'	=> $goodsId,
    		'details'	=> $details
    		]);
    	}
    }
}


