<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\CommonController as Common;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Validation\Validator;
use Gregwar\Captcha\CaptchaBuilder;
use Session;
use DB;

class LoginController extends Common
{
    public function login(Request $request)
    {
        /* 检测是否已登录 */
        if (session()->has('admin.account')) {
            return redirect()->action('admin\IndexController@index');
        }
    	if ($_POST) {
    		$data = $request->all();
	    	// 控制器  验证
	    	// :attribute 占位符 错误信息自定义
	    	/*$this->validate($request, [
	    		'account'  => 'min:5',
	    		'password' => 'required|max:10'
	    	], [
	    		'required' => ':attribute 为必填项',
	    		'min'	   => ':attribute 长度不符合要求'
	    	], [
	    		'account'  => '联系人' 
	    	]);*/
	    	$yzm = session()->get('milkcaptcha');//获取闪存的验证码
	    	if ($yzm != $data['yzm']) {
	    		return json_encode(array('status'=>'4', 'message'=>'验证码出错！'));
	    	}
            $admin = Db::table('admin')->select('password')->where('username', $data['account'])->first();
            if (empty($admin)) {
                return json_encode(array('status'=>'2', 'message'=>'没有该账号！'));
            } else {
               if (md5($data['password']) != $admin->password) {
                    return json_encode(array('status'=>'2', 'message'=>'密码错误!'));
                }
                $request->session()->push('admin.account', $data['account']);
                return json_encode(array('status'=>'1', 'message'=>'登录成功，跳转中...'));
            }
    	} else {
    		return view('admin/login', ['name' => '后台登录']);
    	}
    }

    public function loginOut()
    {
    	session()->forget('admin');
    	return redirect()->action('admin\LoginController@login');
    }

	public function captcha($tmp)
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 140, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        Session::flash('milkcaptcha', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }

}
