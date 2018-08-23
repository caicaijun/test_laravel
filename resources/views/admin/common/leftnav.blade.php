<aside class="lt_aside_nav content mCustomScrollbar">
 <h2><a href="{{ url('admin/index') }}">起始页</a></h2>
 <ul>
  <li>
   <dl>
    <dt>常用布局示例</dt>
    <!--当前链接则添加class:active-->
    <dd><a href="{{ url('admin/prolist') }}" @if(strstr($_SERVER['REQUEST_URI'], 'admin/prolist')) class="active" @endif>商品列表示例</a></dd>
   </dl>
  </li>
  <li>
   <dl>
    <dt>订单信息</dt>
    <dd><a href="{{ url('admin/orderlist') }}" @if(strstr($_SERVER['REQUEST_URI'], 'admin/orderlist')) class="active" @endif>订单列表示例</a></dd>
   </dl>
  </li>
  <li>
   <dl>
    <dt>会员管理</dt>
    <dd><a href="{{ url('admin/userlist') }}" @if(strstr($_SERVER['REQUEST_URI'], 'admin/userlist')) class="active" @endif>会员列表</a></dd>
    <dd><a href="{{ url('admin/userrank') }}" @if(strstr($_SERVER['REQUEST_URI'], 'admin/userrank')) class="active" @endif>会员等级</a></dd>
   </dl>
  </li>
  <li>
   <dl>
    <dt>基础设置</dt>
    <dd><a href="{{ url('admin/websetting') }}"  @if(strstr($_SERVER['REQUEST_URI'], 'admin/websetting')) class="active" @endif>站点基础设置</a></dd>
   </dl>
  </li>
  <li>
   <dl>
    <dt>配送与支付设置</dt>
    <dd><a href="{{ url('admin/expresslist') }}" @if(strstr($_SERVER['REQUEST_URI'], 'admin/expresslist')) class="active" @endif>配送方式</a></dd>
    <dd><a href="{{ url('admin/paylist') }}" @if(strstr($_SERVER['REQUEST_URI'], 'admin/paylist')) class="active" @endif>支付方式</a></dd>
   </dl>
  </li>
  <li>
   <dl>
    <dt>在线统计</dt>
    <dd><a href="discharge_statistic.html">流量统计</a></dd>
    <dd><a href="sales_volume.html">销售额统计</a></dd>
   </dl>
  </li>
  <li>
   <p class="btm_infor">© caicaijun 版权所有</p>
  </li>
 </ul>
</aside>