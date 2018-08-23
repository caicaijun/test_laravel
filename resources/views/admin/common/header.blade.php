<header>
 <h1><img src="{{URL::asset('admin/images/admin_logo.png')}}"/></h1>
 <ul class="rt_nav">
  <li><a href="{{ url('home/index') }}" target="_blank" class="website_icon">站点首页</a></li>
  <li><a href="#" class="clear_icon">清除缓存</a></li>
  <li><a href="#" class="admin_icon">{{ Session::get('admin.account')[0] }}</a></li>
  <li><a href="#" class="set_icon">账号设置</a></li>
  <li><a href="{{ url('admin/loginout') }}" class="quit_icon">安全退出</a></li>
 </ul>
</header>