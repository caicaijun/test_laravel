<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <title>{{$name}}</title>
  <meta name="author" content="DeathGhost" />
  <meta name="_token" content="{{ csrf_token() }}"/>
  <link rel="stylesheet" type="text/css" href="{{URL::asset('admin/css/style.css')}}" />
  <style>
  body{height:100%;background:#16a085;overflow:hidden;}
  canvas{z-index:-1;position:absolute;}
</style>
<script src="{{URL::asset('admin/js/jquery.js')}}"></script>
<script src="{{URL::asset('admin/js/verificationNumbers.js')}}"></script>
<script src="{{URL::asset('admin/js/Particleground.js')}}"></script>
<script src="{{URL::asset('layer/layer.js')}}"></script>
<script>
  $(document).ready(function() {
  //粒子背景特效
  $('body').particleground({
    dotColor: '#5cbdaa',
    lineColor: '#5cbdaa'
  });
  //验证码
  createCode();
  //测试提交，对接程序删除即可
  $(".submit_btn").click(function(){
	 // location.href="index.html";
 });
});
</script>
</head>
<body>
  <dl class="admin_login">
   <dt>
    <strong>站点后台管理系统</strong>
    <em>Management System</em>
  </dt>
  <form action="" method="post">

   <dd class="user_icon">
    <input type="text" name="account" placeholder="账号" id="account" class="login_txtbx" value="{{ old('account') }}" />
  </dd>
  <dd class="pwd_icon">
    <input type="password" name="password" placeholder="密码" id="pass" class="login_txtbx"/>
  </dd>
  <dd class="val_icon">
    <div class="checkcode" style="width: 300px;background:#5cbdaa;">
      <input type="text" name="yzm" id="J_codetext" placeholder="验证码" class="login_txtbx" style="width: 150px;">
       <img src="{{ URL('index/captcha/1') }}"  alt="验证码" title="刷新图片" width="140" height="40" id="c2c98f0de5a04167a9e427d883690ff6" border="0">
    </div>

      <!-- <canvas class="J_codeimg" id="myCanvas" onclick="createCode()">对不起，您的浏览器不支持canvas，请下载最新版浏览器!</canvas>
    </div>
    <input type="button" value="验证码核验" class="ver_btn" onClick="validate();"> -->
  </dd>
  <dd>
    {!! csrf_field() !!}
    <input type="submit" value="立即登录" class="submit_btn"/>
  </dd>
</form>
<dd>
  <p>© 2015-2016 DeathGhost 版权所有</p>
  <p>陕B2-20080224-1</p>
</dd>
</dl>

<script type="text/javascript">
  function yzmimg(){
        $url = "{{ URL('index/captcha') }}";
        $url = $url + "/" + Math.random();
        document.getElementById('c2c98f0de5a04167a9e427d883690ff6').src=$url;
  }
  // 验证码
  $("#c2c98f0de5a04167a9e427d883690ff6").click(function (){
        $url = "{{ URL('index/captcha') }}";
        $url = $url + "/" + Math.random();
        document.getElementById('c2c98f0de5a04167a9e427d883690ff6').src=$url;
  });
  $("form").submit( function () {
      var acc = $('#account').val();
      var pas = $('#pass').val();
      var yzm = $('#J_codetext').val();
      if (acc == '') {
        layer.msg('请填写账号！', {icon: 4});
        return false;
      }
      if (pas == '') {
         layer.msg('请输入密码！', {icon: 4});
         return false;
      }
      if (yzm == '') {
         layer.msg('请输入验证码！', {icon: 4});
         return false;
      }
      $.ajax({
       headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
       type: "POST",
       dataType:"json",
       url: "{{ url('admin/login') }}",
       data: {account:acc,password:pas,yzm:yzm},
       success: function(data){
        if (data.status == 1) {
          layer.msg(data.message, {
          icon: 4,
          time:2000,
          end:function(){
          location.href="{{ url('admin/index') }}";

         }});
        } else {
          layer.msg(data.message, {icon: 4, time:2000});
          yzmimg();
        }
      },
    });
     return false;
  });
</script>


</body>
</html>