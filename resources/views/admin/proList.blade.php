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
       <h2 class="fl">商品列表示例</h2>
       <a href="{{ url('admin/prodetail') }}" class="fr top_rt_btn add_icon">添加商品</a>
      </div>
      <section class="mtb">
       <select class="select">
        <option>下拉菜单</option>
        <option>菜单1</option>
       </select>
       <input type="text" class="textbox textbox_225" placeholder="输入产品关键词或产品货号..."/>
       <input type="button" value="查询" class="group_btn"/>
      </section>
      <table class="table">
       <tr>
        <th>缩略图</th>
        <th>产品名称</th>
        <th>产品ID</th>
        <th>品牌</th>
        <th>类型</th>
        <th>审核</th>
        <th>操作</th>
       </tr>
       @foreach ($goods as $pro)
       <tr>
        <td class="center"><img src="{{ $RPUBLIC }}{{ $pro->photo }}" width="50" height="50"/></td>
        <td style="text-align: center;">{{ $pro->title }}</td>
        <td class="center">{{ $pro->goods_id }}</td>
        <td class="center">{{ $pro->brand_id }}</td>
        <td class="center">{{ $pro->cate_id }}</td>
        <td class="center">{{ $pro->audit }}</td>
        <td class="center">
         <a href="{{ url('admin/proedit', ['goods_id' => $pro->goods_id]) }}" title="编辑" class="link_icon">&#101;</a>
         <a href="{{ url('admin/prodelet', ['goods_id' => $pro->goods_id]) }}" title="删除" class="link_icon">&#100;</a>
        </td>
       </tr>
       @endforeach
      </table>
      <aside class="paging">
        {{ $goods->links() }}
      </aside>
 </div>
</section>
<script type="text/javascript">
  var prostatus = "{{ session('prostatus') }}";
  if (prostatus !='') {
    layer.msg(prostatus, {icon: 4, time:2000});
  }
</script>
</body>
</html>