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
       <h2 class="fl">添加/更新会员等级</h2>
      </div>
      <table class="table">
        <form action="" method="post">
          {!! csrf_field() !!}
       <tr>
        <td style="text-align:right;">会员等级：</td>
        <td>
         <input type="text" class="textbox" name="rankname" value="" placeholder="等级名称"/>
        </td>
        <td style="text-align:right;">享受折扣率：</td>
        <td>
         <input type="text" class="textbox" name="discount" value="" placeholder="0-100" />
         <span>%</span>
        </td>
        <td>
         <input type="submit" value="确认" style="line-height:58px" class="full_link_td"/>
        </td>
       </tr>
       </form>
      </table>
      <div class="page_title">
       <h2 class="fl">等级列表</h2>
      </div>
      <table class="table">
       <tr>
        <th>Id</th>
        <th>会员等级</th>
        <th>享受折扣率</th>
        <th>操作</th>
       </tr>
       @foreach($bate as $ba)
       <tr>
        <td class="center">{{ $ba->rank_id }}</td>
        <td class="center">{{ $ba->rank_name }}</td>
        <td class="center">{{ $ba->rebate }} &nbsp;%</td>
        <td class="center">
         <a href="{{ url('admin/rankdel', ['id' => $ba->rank_id]) }}" title="删除" class="link_icon">&#100;</a>
        </td>
       </tr>
       @endforeach
      </table>
     <!--  <aside class="paging">
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
  var prostatus = "{{ session('prostatus') }}";
  if (prostatus !='') {
    layer.msg(prostatus, {icon: 4, time:2000});
  }
</script>
</body>
</html>
