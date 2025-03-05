<!DOCTYPE html>
<html>
<head>
  <base href="/">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="ad_assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="ad_assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="ad_assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://fontawesome.com/icons/eye?f=classic&s=solid">
@yield('css')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="ad_assets/index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="ad_assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ auth()->user()->name }}</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="ad_assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ auth()->user()->name }}</p>
          <a href="{{ route('admin.logout') }}"><i class="fa fa-circle text-success"></i> Logout</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li>
            <a href="\admin">
              <i class="fa fa-home"></i> <span>Dashboard</span>
            </a>
          </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-list"></i> <span>Categories</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('category.index') }}"><i class="fa fa-circle-o"></i> List</a></li>
            <li><a href="{{ route('category.create') }}"><i class="fa fa-circle-o"></i> Add new</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
          <i class="fa fa-product-hunt"></i> <span>Products</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('product.index') }}"><i class="fa fa-circle-o"></i> List</a></li>
            <li><a href="{{ route('product.create') }}"><i class="fa fa-circle-o"></i> Add new</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-shopping-cart"></i> <span>Orders</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('order.index') }}"><i class="fa fa-circle-o"></i> List</a></li>
            <li><a href="{{ route('order.index') }}?status=%0"><i class="fa fa-circle-o"></i> Chờ xác nhận</a></li>
            <li><a href="{{ route('order.index') }}?status=2"><i class="fa fa-circle-o"></i> Đã giao hàng</a></li>
            <li><a href="{{ route('order.index') }}?status=3"><i class="fa fa-circle-o"></i> Đã hủy</a></li>
          </ul>
        </li>
          @can('admin')
        <li class="treeview">
          <a href="#">
          <i class="fa fa-user"></i> <span>User</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('user.index') }}"><i class="fa fa-circle-o"></i> List</a></li>
            <li><a href="{{ route('user.create') }}"><i class="fa fa-circle-o"></i> Add new</a></li>
          </ul>
        </li>
        @endcan
        <li class="treeview">
          <a href="#">
          <i class="fa fa-th"></i> <span>Baner</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('banner.index') }}"><i class="fa fa-circle-o"></i> List</a></li>
            <li><a href="{{ route('banner.create') }}"><i class="fa fa-circle-o"></i> Add new</a></li>
          </ul>
        </li>
        @canany(['admin', 'editor'])
        <li class="treeview">
          <a href="#">
          <i class="fa fa-user"></i> <span>Customer</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('customer.index') }}"><i class="fa fa-circle-o"></i> List</a></li>
            <li><a href="{{ route('customer.create') }}"><i class="fa fa-circle-o"></i> Add new</a></li>
          </ul>
        </li>
        @endcanany
        <li class="treeview">
          <a href="#">
          <i class="fa fa-comment"></i> <span>Comment</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('comment.index') }}"><i class="fa fa-circle-o"></i> List</a></li>
          </ul>
        </li>
        @can('admin')
        <li class="treeview">
          <a href="#">
          <i class="fa fa-comment"></i> <span>Contact</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('contact.index') }}"><i class="fa fa-circle-o"></i> List</a></li>
          </ul>
        </li>
        @endcan
        <li class="treeview">
          <a href="#">
          <i class="fa fa-list"></i> <span>Blog</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('blog.index') }}"><i class="fa fa-circle-o"></i> List</a></li>
            <li><a href="{{ route('blog.create') }}"><i class="fa fa-circle-o"></i> Add new</a></li>
          </ul>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('title')
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-body">
        @if (Session::has('ok'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('ok') }}
          </div>
        @endif
        @if (Session::has('no'))
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{ Session::get('no') }}
            </div>
        @endif
            @yield('main')
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.3
    </div>
    <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>
</div>
<script src="ad_assets/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<script src="ad_assets/bootstrap/js/bootstrap.min.js"></script>
<script src="ad_assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="ad_assets/plugins/fastclick/fastclick.js"></script>
<script src="ad_assets/dist/js/app.min.js"></script>
<script src="ad_assets/dist/js/demo.js"></script>
@yield('js')
</body>
</html>
