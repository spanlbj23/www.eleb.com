<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">饿了吧订餐平台</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">主页 <span class="sr-only">(current)</span></a></li>
                <li class="dropdown">
                    <a href="{{route('activity.index')}}"  >商铺活动 <span ></span></a>

                </li>
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜品分类管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('menucategory.index')}}">菜品分类详细</a></li>
                    </ul>
                </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜品管理 <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('menu.index')}}">菜品管理详细</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">订单管理 <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('order.index')}}"><span style="color: #e38d13;">总</span>订单统计报表</a></li>
                            <li><a href="{{route('order.indexd')}}"><span style="color: #0066cc;">今日</span>订单统计报表</a></li>
                            <li><a href="{{route('order.indexm')}}"><span style="color: #e38d13;">月</span>订单统计报表</a></li>
                        </ul>
                    </li>
                    @endauth
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="">
                </div>
                <button type="submit" class="btn btn-default"><img src="" alt="" class="glyphicon glyphicon-zoom-in">搜索</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                @guest
                    <li><a href="{{ route('register') }}">注册</a></li>
                    <li><a href="{{ route('login') }}">登录</a></li>
                @endguest
                @auth
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>{{ auth()->user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">个人中心</a></li>
                            <li><a href="#">修改密码</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('logout') }}">退出</a></li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>