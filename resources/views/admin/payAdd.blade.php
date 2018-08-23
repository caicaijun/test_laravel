@extends('admin.common.detail')
@section('top_rt_btn')
<a class="{{ url('admin/paylist') }}" href="">返回{{ $name }}列表</a>
@endsection

@section('form')
<form method="post" action='' enctype="multipart/form-data" id="form1">
<ul class="ulColumn2">
     <li>
      <span class="item_name" style="width:120px;">支付名称：</span>
      <input type="text" class="textbox textbox_295" name="name" placeholder="商品名称..."/>
      <span class="errorTips">错误提示信息...</span>
    </li>
    <li>
      <span class="item_name" style="width:120px;">上传logo：</span>
        <label class="uploadImg" style="width: 80px;height: 60px;">
         <input type="file" id="photo_file" name="photo_file" />
         <input type="hidden" id="picDis" name="logo">
        </label>
        <img src="/wei.jpg" id="photo_img" style="width: 100px;height: 90px;">
   </li>
   <li>
        <span class="item_name" style="width:120px;">是否启用：</span>
        <label class="single_selection"><input type="radio" name="open" value="1" checked />开启</label>
        <label class="single_selection"><input type="radio" name="open" value="0" />关闭</label>
       </li>
   <li>
    <span class="item_name" style="width:120px;">支付描述：</span>
    <script id="editor" type="text/plain" name="contents" style="width:1024px;height:500px;margin-left:120px;margin-top:0;"></script>
    <!--ueditor可删除下列信息-->
  </li>
  <li>
    <span class="item_name" style="width:120px;"></span>
    <input type="submit" class="link_btn"/>
  </li>
</ul>
</form>
@endsection

@section('javascript')
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
        var account  = $(':input[name=name]').val();
        if (account == '') {
           layer.msg('支付方式名称不能为空！', {icon: 4});
           return false;
        }
        var formData = $(this).serializeArray();
       $.ajax({
           headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
           type: "POST",
           dataType:"json",
           url: '{{ url("admin/payadd") }}',
           data: formData,
           success: function(data){
           if (data.status == 1) {
              layer.msg(data.message, {
              icon: 4,
              time:2000,
              end:function(){
              location.href="{{ url('admin/paylist') }}";
             }});
            } else {
              layer.msg(data.message, {icon: 4, time:2000});
            }
          },
        });
        return false;
    });
</script>
@endsection