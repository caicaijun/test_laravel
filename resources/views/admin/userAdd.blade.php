<!-- 顶部开始 -->
@include('admin.common.top')
<!-- 顶部开始 -->
<body>
<!--header-->
@include('admin.common.header')
<!--aside nav-->
<!--aside nav-->
@include('admin.common.leftnav')

<section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
      <div class="page_title">
       <h2 class="fl">会员详情</h2>
       <a href="adjust_funding.html" class="fr top_rt_btn money_icon">资金管理</a>
      </div>
      <form id="form1" action="" method="post" enctype="multipart/form-data">
      {!! csrf_field() !!}
      <ul class="ulColumn2">
       <li>
        <span class="item_name" style="width:120px;">上传头像：</span>
        <label class="uploadImg" style="width: 80px;height: 60px;">
         <input type="file" id="photo_file" name="photo_file" />
         <input type="hidden" id="picDis" name="face_file">
        </label>
        <img src="/wei.jpg" id="photo_img" style="width: 100px;height: 90px;">
       </li>
       <li>
        <span class="item_name" style="width:120px;">会员账号：</span>
        <input type="text" name="account" class="textbox textbox_225" value="" placeholder="会员账号..."/>
       </li>
       <li>
        <span class="item_name" style="width:120px;">登陆密码：</span>
        <input type="password" name="password" class="textbox textbox_225" value="" placeholder="会员密码..."/>
       </li>
       <li>
        <span class="item_name" style="width:120px;">确认密码：</span>
        <input type="password" name="password2" class="textbox textbox_225" value="" placeholder="二次确认密码..."/>
       </li>
       <li>
        <span class="item_name" style="width:120px;">会员昵称：</span>
        <input type="text" name="nickname" class="textbox textbox_225" value="" placeholder="会员昵称..."/>
       </li>
       <li>
        <span class="item_name" style="width:120px;">会员等级：</span>
        <select class="select" name="rank_id">
         <option>会员等级</option>
         <option>普通会员</option>
         <option>高级会员</option>
        </select>
       </li>
       <li>
        <span class="item_name" style="width:120px;">电子邮箱：</span>
        <input type="email" name="email" class="textbox textbox_225" value="" placeholder="电子邮件地址..."/>
       </li>
       <li>
        <span class="item_name" style="width:120px;">手机号码：</span>
        <input type="tel" name="mobile" class="textbox textbox_225" value="" placeholder="手机号码..."/>
       </li>
       <li>
        <span class="item_name" style="width:120px;">可用资金：</span>
        <input type="text" name="balance" class="textbox textbox_225" value="0" placeholder="可用资金（单位：元）..." readonly/>
        <span>元</span>
       </li>
       <li>
        <span class="item_name" style="width:120px;">收货地址：</span>
        <select class="select">
         <option>选择省份</option>
         <option>陕西省</option>
         <option>山西省</option>
        </select>
        <select class="select">
         <option>选择城市</option>
         <option>西安市</option>
         <option>大同市</option>
        </select>
        <select class="select">
         <option>选择区/县</option>
         <option>长安县</option>
         <option>不晓得</option>
        </select>
       </li>
       <li>
        <span class="item_name" style="width:120px;">详细地址：</span>
        <input type="text" class="textbox textbox_295" value="" placeholder="详细地址..."/>
       </li>
       <li>
        <span class="item_name" style="width:120px;"></span>
        <input type="submit" class="link_btn" value="添加会员"/>
       </li>
      </ul>
      </form>
 </div>
</section>
<script src="{{ URL::asset('admin/js/ueditor.config.js') }}"></script>
<script src="{{ URL::asset('admin/js/ueditor.all.min.js') }}"> </script>
<script src="{{ URL::asset('uploadify/jquery.uploadify.min.js') }}"> </script>
<script type="text/javascript">
  $("#photo_file").uploadify({ 
        'swf': "{{ URL::asset('uploadify/uploadify.swf') }}",
        'uploader': "{{ url('admin/ajaxuploads') }}",
        'cancelImg': "{{ URL::asset('uploadify/uploadify-cancel.png') }}",
        //flash
        'buttonText': '上传头像',
        fileObjName: 'photo_file', //上传参数名称
        'fileTypeExts': '*.gif;*.jpg;*.jpeg;*.png',
        'width': '75',
        'height': '35',
        'queueSizeLimit': 1,
        formData: {'_token': '{{csrf_token()}}'},
        'onUploadSuccess': function (file, data, response) {
            $("#picDis").val(data);
            $("#photo_img").attr('src', "{{ URL::asset('uploads') }}/" + data).show();
        }
    });

 $('#form1').submit(function () {
        var account  = $(':input[name=account]').val();
        if (account == '') {
           layer.msg('请填写账号！', {icon: 4});
           return false;
        }
        var password = $(':input[name=password]').val();
        if (password == '') {
           layer.msg('请填写密码！', {icon: 4});
           return false;
        }
        var password2 = $(':input[name=password2]').val();
        if (password2 != password) {
           layer.msg('两次密码不一样！', {icon: 4});
           return false;
        }
        var mobile = $(':input[name=mobile]').val();
        if (mobile == '') {
           layer.msg('请填写手机号！', {icon: 4});
           return false;
        }
        var formData = $(this).serializeArray();
       $.ajax({
           headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
           type: "POST",
           dataType:"json",
           url: '{{ url("admin/useradd") }}',
           data: formData,
           success: function(data){
           if (data.status == 1) {
              layer.msg(data.message, {
              icon: 4,
              time:2000,
              end:function(){
              location.href="{{ url('admin/userlist') }}";
             }});
            } else {
              layer.msg(data.message, {icon: 4, time:2000});
            }
          },
        });
        return false;
    });
</script>
</body>
</html>
