<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @include('layouts.header')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">


    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>Y</b>C</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Global Wheels</b>CRM</span>
        </a>
        <!-- Errors Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{url('')}}/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
@php if(isset(Auth::user()->name)){ @endphp
                            <span class="hidden-xs">{{ ucfirst( Auth::user()->name) }}</span>
                            @php } @endphp
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{url('')}}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                <p>
                                    @php if(isset(Auth::user()->name)){ @endphp
                                    {{auth::user()->name}}
                                    <small>Member since <b> {{ date('d-M-Y',strtotime(auth::user()->created_at))}}</b>
                                    </small>
                                    @php } @endphp
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href={{route('logout')}} class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{url('')}}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    @php if(isset(Auth::user()->name)){ @endphp
                    <p>  {{ ucfirst(auth::user()->name)}}</p>
                    @php } @endphp
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <li class="active treeview">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>User</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{route('default')}}"><i class="fa fa-circle-o"></i>User
                                Creation</a></li>

                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>State</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{route('country')}}"><i class="fa fa-circle-o"></i>Country</a></li>
                        <li class="active"><a href="{{route('state')}}"><i class="fa fa-circle-o"></i>State</a></li>
                        <li class="active"><a href="{{route('city')}}"><i class="fa fa-circle-o"></i>City</a></li>

                    </ul>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                @if(isset($bread))
                    {{$bread}}
                @endif
            </h1>
            <ol class="breadcrumb">
                <li><a href="#">
                        <i class="fa fa-dashboard"></i>
                        @if(isset($module))
                            {{$module}}
                            @endif</a></li>
                <li class="active">  @if(isset($bread))
                        {{$bread}}
                    @endif</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <!-- Input addon -->
            <div class="box box-info">
                <!-- /.box-header -->
                <div class="box-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif


                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @yield('content')

                </div>
                <!-- /.box-body -->

                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <!-- /.row -->
            <!-- Main row -->

            <!-- /.row (main row) -->

        </section>
    </div>


    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <!--<b>Version</b> 2.4.18-->
        </div>
        <strong>Copyright &copy; 2019-2020 <a href="">YouChug.com</a>.</strong> All rights
        reserved.
    </footer>
</div>
</body>
@include('layouts.footer')
</html>
