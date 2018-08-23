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
       <h2 class="fl">会员列表</h2>
       <a href="{{ url('admin/useradd') }}" class="fr top_rt_btn add_icon">添加新会员</a>
      </div>
      <section class="mtb">
       <select class="select">
        <option>会员等级</option>
        <option>普通会员</option>
        <option>高级会员</option>
       </select>
       <input type="text" class="textbox textbox_225" placeholder="输入会员号/手机/电子邮件查询..."/>
       <input type="button" value="查询" class="group_btn"/>
      </section>
      <table class="table">
       <tr>
        <th style="width: 5%;">Id</th>
        <th>会员头像</th>
        <th>会员账号</th>
        <th>手机号码</th>
        <th>电子邮件</th>
        <th>昵称</th>
        <th>验证</th>
        <th style="width: 7%;">会员等级</th>
        <th>账户余额</th>
        <th>冻结资金</th>
        <th>操作</th>
       </tr>
       @foreach($users as $user)
       <tr>
        <td class="center" >{{ $user->user_id }}</td>
        <td class="center"><img src="upload/user_002.png" width="50" height="50"/></td>
        <td>{{ $user->account }}</td>
        <td class="center">{{ $user->mobile }}</td>
        <td class="center">{{ $user->email }}</td>
        <td class="center">{{ $user->email }}</td>
        <td class="center"><a title="已验证" class="link_icon">&#89;</a></td>
        <td class="center">{{ $user->rank_id }}</td>
        <td class="center">
         <strong class="rmb_icon">{{ $user->balance }}</strong>
        </td>
        <td class="center">
         <strong class="rmb_icon">0</strong>
        </td>
        <td class="center">
         <a href="{{ url('admin/userdetail', ['id' => $user->user_id]) }}" title="编辑" class="link_icon">&#101;</a>
         <a href="{{ url('admin/uclosed', ['user_id' => $user->user_id, 'closed' => 1]) }}" title="删除" class="link_icon">&#100;</a>
        </td>
       </tr>
       @endforeach
      </table>
      <aside class="paging">
       {{ $users->links() }}
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
