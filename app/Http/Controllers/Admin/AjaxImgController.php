<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\CommonController as Common;
use Illuminate\Http\Request;

use DB;
use Storage;
use Mail;

class AjaxImgController extends Common
{
    public function mall()
    {
        /*发送原始字符串*/
        Mail::raw('邮件内容测试', function($message) {
            $message->from('cangfangs@163.com', 'laravel测试');
            $message->subject('邮件主题测试');
            $message->to('5566903@qq.com');
        });
    }

	public function uploads(Request $request)
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

    public function city(Request $request)
    {
        $provinceId = $request->all();
        $city = Db::table('area')->select('area_id', 'area_name')->where('city_id', $provinceId['cid'])->get();
        if (!empty($city)) {
            return json_encode(array('status' => 1, 'message' => $city));
        } else {
             return json_encode(array('status' => 2, 'message' => '没有城市了！'));
        }
    }
}