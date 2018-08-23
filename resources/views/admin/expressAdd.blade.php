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
       <h2 class="fl">快递公司添加</h2>
       <a class="fr top_rt_btn" href="{{ url('admin/expresslist') }}">返回快递公司列表</a>
      </div>
     <section>
      <form action="" method="post" id="form1" enctype="multipart/form-data">
        {!! csrf_field() !!}
      <ul class="ulColumn2">
       <li>
        <span class="item_name" style="width:120px;">快递名称：</span>
        <input type="text" class="textbox textbox_295" name="name" value="" placeholder="快递名称：..."/>
        <span class="errorTips">错误提示信息...</span>
       </li>
       <li>
        <span class="item_name" style="width:120px;">启用：</span>
        <label class="single_selection"><input type="radio" name="closed" value="1" checked />开启</label>
        <label class="single_selection"><input type="radio" name="closed" value="0" />关闭</label>
       </li>
       <li>
        <span class="item_name" style="width:120px;">上传头像：</span>
        <label class="uploadImg" style="width: 80px;height: 60px;">
         <input type="file" id="photo_file" name="photo_file" />
         <input type="hidden" id="picDis" name="e_img">
        </label>
        <img src="/wei.jpg" id="photo_img" style="width: 100px;height: 90px;">
       </li>
       <li>
        <span class="item_name" style="width:120px;">产品详情：</span>
        <script id="editor" type="text/plain" name="des" style="width:1024px;height:500px;margin-left:120px;margin-top:0;"></script>
       </li>
       <li>
        <span class="item_name" style="width:120px;"></span>
        <input type="submit" class="link_btn"/>
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

  $('#form1').submit(function () {
        var express  = $(':input[name=name]').val();
        if (express == '') {
           layer.msg('请填写快递名称！', {icon: 4});
           return false;
        }
        var formData = $(this).serializeArray();
       $.ajax({
           headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
           type: "POST",
           dataType:"json",
           url: '{{ url("admin/expressadd") }}',
           data: formData,
           success: function(data){
           if (data.status == 1) {
              layer.msg(data.message, {
              icon: 4,
              time:2000,
              end:function(){
              location.href="{{ url('admin/expresslist') }}";
             }});
            } else {
              layer.msg(data.message, {icon: 4, time:2000});
            }
          },
        });
        return false;
    });
    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');


    function isFocus(e){
        alert(UE.getEditor('editor').isFocus());
        UE.dom.domUtils.preventDefault(e)
    }
    function setblur(e){
        UE.getEditor('editor').blur();
        UE.dom.domUtils.preventDefault(e)
    }
    function insertHtml() {
        var value = prompt('插入html代码', '');
        UE.getEditor('editor').execCommand('insertHtml', value)
    }
    function createEditor() {
        enableBtn();
        UE.getEditor('editor');
    }
    function getAllHtml() {
        alert(UE.getEditor('editor').getAllHtml())
    }
    function getContent() {
        var arr = [];
        arr.push("使用editor.getContent()方法可以获得编辑器的内容");
        arr.push("内容为：");
        arr.push(UE.getEditor('editor').getContent());
        alert(arr.join("\n"));
    }
    function getPlainTxt() {
        var arr = [];
        arr.push("使用editor.getPlainTxt()方法可以获得编辑器的带格式的纯文本内容");
        arr.push("内容为：");
        arr.push(UE.getEditor('editor').getPlainTxt());
        alert(arr.join('\n'))
    }
    function setContent(isAppendTo) {
        var arr = [];
        arr.push("使用editor.setContent('欢迎使用ueditor')方法可以设置编辑器的内容");
        UE.getEditor('editor').setContent('欢迎使用ueditor', isAppendTo);
        alert(arr.join("\n"));
    }
    function setDisabled() {
        UE.getEditor('editor').setDisabled('fullscreen');
        disableBtn("enable");
    }

    function setEnabled() {
        UE.getEditor('editor').setEnabled();
        enableBtn();
    }

    function getText() {
        //当你点击按钮时编辑区域已经失去了焦点，如果直接用getText将不会得到内容，所以要在选回来，然后取得内容
        var range = UE.getEditor('editor').selection.getRange();
        range.select();
        var txt = UE.getEditor('editor').selection.getText();
        alert(txt)
    }

    function getContentTxt() {
        var arr = [];
        arr.push("使用editor.getContentTxt()方法可以获得编辑器的纯文本内容");
        arr.push("编辑器的纯文本内容为：");
        arr.push(UE.getEditor('editor').getContentTxt());
        alert(arr.join("\n"));
    }
    function hasContent() {
        var arr = [];
        arr.push("使用editor.hasContents()方法判断编辑器里是否有内容");
        arr.push("判断结果为：");
        arr.push(UE.getEditor('editor').hasContents());
        alert(arr.join("\n"));
    }
    function setFocus() {
        UE.getEditor('editor').focus();
    }
    function deleteEditor() {
        disableBtn();
        UE.getEditor('editor').destroy();
    }
    function disableBtn(str) {
        var div = document.getElementById('btns');
        var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            if (btn.id == str) {
                UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
            } else {
                btn.setAttribute("disabled", "true");
            }
        }
    }
    function enableBtn() {
        var div = document.getElementById('btns');
        var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
        }
    }

    function getLocalData () {
        alert(UE.getEditor('editor').execCommand( "getlocaldata" ));
    }

    function clearLocalData () {
        UE.getEditor('editor').execCommand( "clearlocaldata" );
        alert("已清空草稿箱")
    }
</script>
</body>
</html>
