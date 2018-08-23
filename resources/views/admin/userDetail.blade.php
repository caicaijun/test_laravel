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
       <a href="{{ url('admin/userfunding', ['uid' => $detail->user_id]) }}" class="fr top_rt_btn money_icon">资金管理</a>
      </div>
      <ul class="ulColumn2">
       <li>
        <span class="item_name" style="width:120px;">上传头像：</span>
        <label class="uploadImg">
         <input type="file"/>
         <span>上传头像</span>
        </label>
       </li>
       <li>
        <span class="item_name" style="width:120px;">会员名称：</span>
        <input type="text" class="textbox textbox_225" value="{{ $detail->nickname }}" placeholder="会员账号..."/>
        <span class="errorTips">错误提示信息...</span>
       </li>
       <li>
        <span class="item_name" style="width:120px;">登陆密码：</span>
        <input type="password" class="textbox textbox_225" value="{{ $detail->password }}" placeholder="会员密码..."/>
        <span class="errorTips">错误提示信息...</span>
       </li>
       <li>
        <span class="item_name" style="width:120px;">会员等级：</span>
        <select class="select">
         <option>会员等级</option>
         <option>普通会员</option>
         <option>高级会员</option>
        </select>
       </li>
       <li>
        <span class="item_name" style="width:120px;">电子邮箱：</span>
        <input type="email" class="textbox textbox_225" value="{{ $detail->email }}" placeholder="电子邮件地址..."/>
        <span class="errorTips">错误提示信息...</span>
       </li>
       <li>
        <span class="item_name" style="width:120px;">手机号码：</span>
        <input type="tel" class="textbox textbox_225" value="{{ $detail->mobile }}" placeholder="手机号码..."/>
        <span class="errorTips">错误提示信息...</span>
       </li>
       <li>
        <span class="item_name" style="width:120px;">可用资金：</span>
        <input type="text" class="textbox textbox_225" value="{{ $detail->balance }}" placeholder="可用资金（单位：元）..." readonly/>
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

       </li>
       <li>
        <span class="item_name" style="width:120px;">详细地址：</span>
        <input type="text" class="textbox textbox_295" value="陕西省西安市未央区凤城五路旺景国际大厦" placeholder="详细地址..."/>
        <span class="errorTips">错误提示信息...</span>
       </li>
       <li>
        <span class="item_name" style="width:120px;"></span>
        <input type="submit" class="link_btn" value="更新/保存"/>
       </li>
      </ul>
 </div>
</section>
</body>
</html>
