<div id="header">
    <div class="wrapper">
        <a href="/" class="logo">
            <img src="/style/images/logo.png" width="289" height="100" alt="传媒之家-最专业的传媒领域招聘平台" />
        </a>
        <ul class="reset" id="navheader">
            <li class="current"><a href="/">首页</a></li>
            <li class="current"><a href="/company/show/{{$user->company['id']}}" >我的公司</a></li>
            <li class="current"><a href="/profession/publish" >新职业发布</a></li>
            <li class="current"><a href="/profession/onLine" >招聘管理</a></li>
            @if($user->company['state'] != 1)
            <li class="current"><a href="/check" >公司认证</a></li>
            @endif
        </ul>
        <ul class="loginTop">
            <li><a href="/update/password" >{{$user->name}}</a></li>
            <li>|</li>
            <li><a href="/auth/logout">退出</a></li>
        </ul>
    </div>
</div><!-- end #header -->

