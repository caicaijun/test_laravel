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
       <h2 class="fl">支付方式</h2>
       <a href="{{ url('admin/payadd') }}" class="fr top_rt_btn add_icon">添加支付方式</a>
      </div>
      <table class="table">
       <tr>
        <th>缩略图</th>
        <th>支付名称</th>
        <th>支付描述</th>
        <th>操作</th>
       </tr>
       @foreach($list as $list)
       <tr>
        <td class="center"><img src="{{ $RPUBLIC }}{{ $list->logo }}" width="165" height="65"/></td>
        <td>{{ $list->name }}</td>
        <td>{{ $list->contents }}</td>
        <td class="center">
         <!-- <a href="product_detail.html" title="编辑" class="link_icon">&#101;</a> -->
         <a href="{{ url('admin/paydel', ['id' => $list->payment_id]) }}" title="删除" class="link_icon">&#100;</a>
        </td>
       </tr>
       @endforeach
      </table>
      <!-- <aside class="paging">
       <a>第一页</a>
       <a>1</a>
       <a>2</a>
       <a>3</a>
       <a>…</a>
       <a>1004</a>
       <a>最后一页</a>
      </aside> -->
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