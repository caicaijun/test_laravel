@include('admin.common.top')
<body>
<!--header-->
@include('admin.common.header')
<!--aside nav-->
<!--aside nav-->
@include('admin.common.leftnav')

<section class="rt_wrap content mCustomScrollbar">
 <div class="rt_content">
     <form method="post" action='' enctype="multipart/form-data" id="form1">
        {!! csrf_field() !!}
      <div class="page_title">
       <h2 class="fl">商品详情示例</h2>
       <a class="fr top_rt_btn">返回产品列表</a>
      </div>
     <section>
      <ul class="ulColumn2">
        <li>
        <span class="item_name" style="width:120px;">商家选择：</span>
        <input type="text" class="textbox textbox_295" name="shop_id" value="{{ $details->shop_id }}" placeholder="商家选择"/>
        <span class="errorTips">错误提示信息...</span>
       </li>
       <li>
        <span class="item_name" style="width:120px;">商品名称：</span>
        <input type="text" class="textbox textbox_295" name="title" value="{{ $details->title }}" placeholder="商品名称..."/>
        <span class="errorTips">错误提示信息...</span>
       </li>
       <li>
        <span class="item_name" style="width:120px;">品牌：</span>
        <select class="select" id="brandId" name="brandId">
        @foreach($brand as $br)
         <option value="{{ $br->brand_id }}" @if ($details->brand_id == $br->brand_id) selected @endif>{{ $br->brand_name }}</option>
        @endforeach
        </select>
        <span class="errorTips">错误提示信息...</span>
       </li>
       <li>
        <span class="item_name" style="width:120px;">分类：</span>
        <select class="select" id="cateId" name="cateId">
         <option value="{{ $details->cate_id }}">请选择分类</option>
         @foreach($cate as $ca)
         <option value="{{ $details->cate_id }}" @if ($details->cate_id == $ca->cate_id) selected @endif>{{ $ca->cate_name }}</option>
         @endforeach
        </select>
        <span class="errorTips">错误提示信息...</span>
       </li>
       <li>
        <span class="item_name" style="width:120px;">价格：</span>
        <input type="text" class="textbox" name="price" value="{{ $details->price }}" placeholder="商品价格"/>
        <span class="errorTips">错误提示信息...</span>
       </li>
       <li>
        <span class="item_name" style="width:120px;">结算价格：</span>
        <input type="text" class="textbox" value="{{ $details->settlement_price }}" name="set_price" placeholder="商品结算价格"/>
        <span class="errorTips">错误提示信息...</span>
       </li>
       <li>
        <span class="item_name" style="width:120px;">推荐：</span>
        <label class="single_selection"><input type="radio" name="recommends" value="1" />是否精品</label>
        <label class="single_selection"><input type="radio" name="recommends" value="2"/>是否热销</label>
        <label class="single_selection"><input type="radio" name="recommends" value="3" checked/>是否新品</label>
       </li>
       <li>
        <span class="item_name" style="width:120px;">上传图片：</span>
        <label class="uploadImg" style="height: 100px;">
         <input type="file" name="photo_file" id="photo_file" class="picture"/>
         <input type="hidden" class="picDis" value="{{ $details->photo }}" name="picture">
         <!-- <span>上传图片</span> -->
        </label>
        <img src="{{ $RPUBLIC }}{{ $details->photo }}" id="photo_img" style="width: 150px;height: 150px;top: 50%;">
       </li>
       <li>
        <span class="item_name" style="width:120px;">产品详情：</span>
        <script id="editor" type="text/plain" name="details" style="width:1024px;height:500px;margin-left:120px;margin-top:0;">{{ $details->details }}</script>
       </li>
       <li>
        <span class="item_name" style="width:120px;"></span>
        <input type="submit" class="link_btn" id="link_btn"/>
       </li>
      </ul>
     </section>
 </form>
 </div>
</section>
<script src="{{ URL::asset('admin/js/ueditor.config.js') }}"></script>
<script src="{{ URL::asset('admin/js/ueditor.all.min.js') }}"> </script>
<script src="{{ URL::asset('uploadify/jquery.uploadify.min.js') }}"> </script>
<script type="text/javascript">
  // 图片上传有问题，ajax 后台获取不到图片
    $("#photo_file").uploadify({ 
        'swf': "{{ URL::asset('uploadify/uploadify.swf') }}",
        'uploader': "{{ url('admin/uploads') }}",
        'cancelImg': "{{ URL::asset('uploadify/uploadify-cancel.png') }}",
        //flash
        'buttonText': '上传缩略图',
        fileObjName: 'photo_file', //上传参数名称
        'fileTypeExts': '*.gif;*.jpg;*.jpeg;*.png',
        'width': '85',
        'height': '50',
        'queueSizeLimit': 1,
        formData: {'_token': '{{csrf_token()}}'},
        'onUploadSuccess': function (file, data, response) {
            $(".picDis").val(data);
            $("#photo_img").attr('src', "{{ URL::asset('uploads') }}/" + data).show();
        }
    });
    $('#form1').submit(function () {
        var formData = $(this).serializeArray();
        var brandId = $('#brandId').val();
        var cateId  = $('#cateId').val();
        if (brandId == 0) {
              layer.msg('请选择品牌！', {icon: 4});
              return false;
        }
        if (cateId == 0) {
              layer.msg('请选择分类！', {icon: 4});
              return false;
        }
       $.ajax({
           headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
           type: "POST",
           dataType:"json",
           url: '{{ url("admin/proedit/$goodsId") }}',
           data: formData,
           success: function(data){
           if (data.status == 1) {
              layer.msg(data.message, {
              icon: 4,
              time:2000,
              end:function(){
              location.href="{{ url('admin/prolist') }}";
             }});
            } else {
              layer.msg(data.message, {icon: 4, time:2000});
              yzmimg();
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
