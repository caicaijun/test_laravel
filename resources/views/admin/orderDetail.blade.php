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
       <h2 class="fl">订单详情示例</h2>
      </div>
      <table class="table">
       <tr>
        <td>收件人：{{ $info->username }}</td>
        <td>联系电话：{{ $info->mobile_fan }}</td>
        <td>收件地址：{{ $info->addr }}</td>
        <td>付款时间：{{ date('Y-m-d H:i:s', $info->money_time) }}</td>
       </tr>
       <tr>
        <td>下单时间：{{ date('Y-m-d H:i:s', $info->create_time) }}</td>
        <td>付款时间：{{ date('Y-m-d H:i:s', $info->money_time) }}</td>
        <td>确认时间：{{ date('Y-m-d H:i:s', $info->shop_time) }}</td>
        <td>评价时间时间：{{ date('Y-m-d H:i:s', $info->user_time) }}</td>
       </tr>
       <tr>
        <td>订单状态：<a>{{ $info->status }}</a></td>
        <td colspan="3">订单备注：<mark>{{ $info->remark }}</mark></td>
        </tr>
      </table>
      <table class="table">
       @foreach($goods as $good)
       <tr>
        <td class="center"><img src="{{ $RPUBLIC }}/{{ $good->goods_photo }}" width="50" height="50"/></td>
        <td>{{ $good->goods_name }}</td>
        <td class="center">{{ $good->goods_cate }}</td>
        <td class="center"><strong class="rmb_icon">{{ $good->price }}</strong></td>
        <td class="center">
         <p>颜色：蓝色</p>
         <p>尺码：XXL码</p>
        </td>
        <td class="center"><strong>{{ $good->num }}</strong></td>
        <td class="center"><strong class="rmb_icon">{{ $good->total_price }}</strong></td>
        <td class="center">包</td>
       </tr>
       @endforeach
      </table>
      <aside class="mtb" style="text-align:right;">
       <label>管理员操作：</label>
       <input type="text" class="textbox textbox_295" placeholder="管理员操作备注"/>
       <input type="button" value="打印订单" class="group_btn"/>
   <!--     <input type="button" value="确认订单" class="group_btn"/>
       <input type="button" value="付款" class="group_btn"/>
       <input type="button" value="配货" class="group_btn"/>
       <input type="button" value="发货" class="group_btn"/>
       <input type="button" value="确认收货" class="group_btn"/> -->
      </aside>
 </div>
</section>
</body>
</html>
