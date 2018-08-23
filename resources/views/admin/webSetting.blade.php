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
       <h2 class="fl">站点基础设置</h2>
      </div>
     <section>
      <h2 style="color: red;">更新提示：
        @if (session('status'))
          {{ session('status') }}
        @else
          未更新
        @endif
      </h2>
      <form action="" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
      <ul class="ulColumn2">
       <li>
        <span class="item_name" style="width:120px;">站点名称：</span>
        <input type="text" class="textbox textbox_225" name="name" value="{{ $web->name }}" placeholder="站点名称..."/>
        <span class="errorTips">一般不超过80个字符</span>
       </li>
       <li>
        <span class="item_name" style="width:120px;">上传logo：</span>
        <label class="uploadImg" style="width: 80px;height: 60px;">
         <input type="file" id="photo_file" name="photo_file" />
         <input type="hidden" id="picDis" name="logo">
        </label>
        @if ($web->logo)
        <img src="{{ $RPUBLIC }}{{ $web->logo }}" id="photo_img" style="width: 100px;height: 90px;">
        @else
        <img src="/wei.jpg" id="photo_img" style="width: 100px;height: 90px;">
        @endif
       </li>
       <li>
        <span class="item_name" style="width:120px;">站点描述：</span>
        <input type="text" class="textbox textbox_295" name="describe" value="{{ $web->describe }}" placeholder="站点描述..."/>
        <span class="errorTips">一般不超过200个字符</span>
       </li>
       <li>
        <span class="item_name" style="width:120px;">关键词：</span>
        <input type="text" name="keyword" value="{{ $web->keyword }}" class="textbox textbox_295" placeholder="多个关键词用”,“或”|“隔开..."/>
        <span class="errorTips">一般不超过100个字符</span>
       </li>
       <li>
        <span class="item_name" style="width:120px;">公司地址：</span>
        <select class="select" name="province" id="prov">
         <option value="">选择省份</option>
         @foreach($prov as $pr)
         @if($web->province_id == $pr->city_id)
         <option value="{{ $pr->city_id }}" style="text-align: center;" selected>{{ $pr->name }}</option>
         @else
         <option value="{{ $pr->city_id }}" style="text-align: center;">{{ $pr->name }}</option>
         @endif
         @endforeach
        </select>
        @if($web->city_id)
        <select class="select" name="city" id="citys" style="width: 80px;">
         @foreach($citys as $ci)
         @if($web->city_id == $ci->area_id)
         <option value="{{ $ci->area_id }}" style="text-align: center;" selected>{{ $ci->area_name }}</option>
         @else
          <option value="{{ $ci->area_id }}" style="text-align: center;">{{ $ci->area_name }}</option>
         @endif
         @endforeach
        </select>
        @else
        <select class="select" name="city" id="citys" style="width: 80px;" hidden="hidden">
         
        </select>
        @endif
       </li>
       <li>
        <span class="item_name" style="width:120px;">详细地址：</span>
        <input type="text" name="addr" value="{{ $web->addr }}" class="textbox textbox_295" placeholder="详细地址..."/>
       </li>
       <li>
        <span class="item_name" style="width:120px;"></span>
        <input type="submit" class="link_btn" value="保存"/>
       </li>
      </ul>
      </form>
     </section>
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

  $('#prov').change(function () {
    var proId = $('#prov').val();
    $.ajax({
     headers:{'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
     type: "POST",
     url: "{{ url('admin/city') }}",
     dataType: "json",
     data: {cid:proId},
     success: function(msg){
      if (msg.status == 1) {
        $('#citys').removeAttr("hidden");
        $("#citys").empty();
        for (var i=0, clen = msg.message.length; i < clen; i++) {
          $('#citys').append('<option value="' + msg.message[i].area_id + '">' + msg.message[i].area_name + '</option>');
        }
      }
     }
    });
  });
</script>
</body>
</html>
