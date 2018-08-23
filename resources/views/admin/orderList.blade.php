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
       <h2 class="fl">订单列表示例</h2>
       <a class="fr top_rt_btn add_icon">添加商品</a>
      </div>
      <section class="mtb">
       <select class="select">
        <option>订单状态</option>
        <option>待付款</option>
        <option>待发货</option>
        <option>待评价</option>
       </select>
       <input type="text" class="textbox textbox_225" placeholder="输入订单编号或收件人姓名/电话..."/>
       <input type="button" value="查询" class="group_btn"/>
      </section>
      <table class="table">
       <tr>
        <th style="width: 25%;">订单编号</th>
        <th style="width: 7%;">收件人</th>
        <th style="width: 12%;">联系电话</th>
        <th>收件人地址</th>
        <th style="width: 10%;">订单金额</th>
        <th style="width: 10%;">配送方式</th>
        <th style="width: 10%;">操作</th>
       </tr>
      @foreach($orders as $order)
       <tr>
        <td class="center">{{ $order->order_sn }}</td>
        <td class="center">{{ $order->username }}</td>
        <td class="center">{{ $order->mobile_fan }}</td>
        <td class="center">
         <address>{{ $order->addr }}</address>
        </td>
        <td class="center"><strong class="rmb_icon">{{ $order->total_price }}</strong></td>
        <td class="center">{{ $order->name }}</td>
        <td class="center">
         <a href="{{ url('admin/orderdetail', ['order_id' => $order->order_id]) }}" title="查看订单" class="link_icon" target="_blank">&#118;</a>
         <a href="{{ url('admin/orderDel', ['order_id' => $order->order_id]) }}" title="删除" class="link_icon">&#100;</a>
        </td>
       </tr>
      @endforeach
      </table>
      <aside class="paging">
       <a>第一页</a>
       <a>1</a>
       <a>2</a>
       <a>3</a>
       <a>…</a>
       <a>1004</a>
       <a>最后一页</a>
      </aside>
 </div>
</section>
<script type="text/javascript">
  var status = "{{ session('status') }}";
  if (status !='') {
    layer.msg(status, {icon: 4, time:2000});
  }
</script>
</body>
</html>
