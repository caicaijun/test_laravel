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
       <h2 class="fl">会员资金变动</h2>
       <a href="javascript:history.back(-1);" class="fr top_rt_btn">返回</a>
      </div>
      <table class="table">
       <tr>
        <td style="text-align:right;">当前余额：</td>
        <td>
         <span>{{ $balance->balance }} &nbsp;元</span>
        </td>
        <td style="text-align:right;">冻结：</td>
        <td>
         <span>{{ $freeze[0]->freeze ? $freeze[0]->freeze : 0 }} &nbsp;元</span>
        </td>
        <td rowspan="2">
         <a class="full_link_td" style="line-height:117px;">确认</a>
        </td>
       </tr>
       <tr>
        <td style="text-align:right;">增加：</td>
        <td>
         <input type="text" class="textbox" value="0.00"/>
         <span>元</span>
        </td>
        <td style="text-align:right;">减少：</td>
        <td>
          <input type="text" class="textbox" value="0.00"/>
          <span>元</span>
        </td>
        </tr>
      </table>
      <div class="page_title">
       <h2 class="fl">资金变动记录</h2>
      </div>
      <table class="table" style="text-align: center;">
       <tr>
        <th>类型</th>
        <th>时间</th>
        <th>资金变动额</th>
       </tr>
       @foreach($funding as $fd)
       <tr>
        <td>{{ $fd->type_name }}</td>
        <td><time>{{ date('Y-m-d H:i:s', $fd->create_time) }}</time></td>
        <td>@if ($fd->type == 1 || $fd->type == 2 || $fd->type == 4) 增加 @else 减少 @endif<strong class="rmb_icon">{{ $fd->money_change }}</strong></td>
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
</body>
</html>
