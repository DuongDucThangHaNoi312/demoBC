<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin  @yield('title')</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins	folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.3/icheck.min.js"></script>
  <script src="https://cdn.rawgit.com/bantikyan/icheck-bootstrap/master/icheck-bootstrap.min.css"></script>
  <link rel="stylesheet" href="https://cdn.rawgit.com/bantikyan/icheck-bootstrap/master/icheck-bootstrap.min.css">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" /> -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <link rel="stylesheet" href="/plugins/select2/select2.min.css">

  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../../plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../../plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">

  <!-- Jasny Bootstrap -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">


</head>
<body class="hold-transition skin-blue sidebar-mini">

  <!-- mở 1 -->
  <div class="wrapper">




    <header class="main-header">

     <a href="{{route('admin')}}" class="logo">
      <span class="logo-lg"><b>Trang chủ</b></span>
    </a>


    <nav class="navbar navbar-static-top">

      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
       <span class="sr-only">Toggle navigation</span>
       {{$mytime->toDayDateTimeString()}}
     </a>

     <div class="navbar-custom-menu">
       <ul class="nav navbar-nav">
        @if (Auth::check())
        <li class="dropdown user user-menu">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <!-- <img src="{{Auth::user()->avatar}}" class="user-image" alt="User Image"> -->
          <span class="hidden-xs">{{Auth::user()->name}}</span>
        </a>
      </li>
      @endif
    </ul>
  </div>
</nav>
</header>





<aside class="main-sidebar">
 <section class="sidebar">
 <!--  @if (Auth::check())
  <div class="user-panel">
   <div class="pull-left image">
    <img src="{{Auth::user()->avatar}}" style="height: 40px; width: 40px; border-radius: 50%"  class="img-circle" alt="User Image">
  </div>
  <div class="pull-left info">
    <p>{{Auth::user()->name}}</p>
    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
  </div>
</div>
@endif -->


<form action="#" method="get" class="sidebar-form">
 <div class="input-group">
  <input type="text" name="q" class="form-control" placeholder="Search...">
  <span class="input-group-btn">
   <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
   </button>
 </span>
</div>
</form>

<ul class="sidebar-menu">

  <li class=" treeview">
    <a href="{{route('admin')}}">
      <i class="fa fa-dashboard"></i> <span> <i class="fas fa-home"></i> | Home</span> 
    </a>
  </li>

<!--   <li class="active treeview">
    <a href="#">
      <i class="fa fa-dashboard"></i> <span> <i class="fas fa-user"></i> | Người dùng </span> <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
      <li class="active"><a href=""><i class="fa fa-circle-o"></i> Role </a></li>
      <li><a href=""><i class="fa fa-circle-o"></i> Permission</a></li>
      <li><a href=""><i class="fa fa-circle-o"></i> User</a></li>
    </ul>
  </li> -->
  <li class=" treeview">
    <a href="{{route('showNews')}}">
     <i class="fa fa-dashboard"></i> <span> <i class="fas fa-tasks"></i> | Quản lí tin </span> 
   </a>
 </li> 
 <li class=" treeview">
  <a href="{{route('showCategory')}}">
    <i class="fa fa-dashboard"></i> <span> <i class="fas fa-newspaper"></i> | Quản lí danh mục tin</span> 
  </a>
</li>
<li class=" treeview">
  <a href="{{ route('elfinder.ckeditor') }}">
    <i class="fa fa-dashboard"></i> <span> <i class="fas fa-file"></i> | File server </span> 
  </a>
</li>
<li class=" treeview">
  <a href="{{route('admin')}}">
    <i class="fa fa-dashboard"></i> <span> <i class="fas fa-users"></i> | Khách hàng</span> 
  </a>
</li>
<li class=" treeview">
  <a href="{{route('admin')}}">
    <i class="fa fa-dashboard"></i> <span> <i class="fas fa-cogs"></i> | Cài đặt </span>
  </a>
</li>
</ul>


</section>
</aside>


<div class="content-wrapper">
 <section class="content">
  <div class="row">
   <div class="col-md-12">
    <div class="box">
     <div class="box-header with-border">
      <div > 
       @yield('content')

     </div>
   </div>
 </div>
</div>
</div>
</section>
</div>

<footer class="main-footer">
  <strong>Copyright &copy; 2021-2022 <a href="http://facebook.com">Dương Đức Thắng</a>.</strong> All rights
  reserved.
</footer>



</div>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script>

  CKEDITOR.replace( 'editor1', {
    filebrowserBrowseUrl: '/elfinder/ckeditor',
    filebrowserImageBrowseUrl: '/elfinder/ckeditor',

    // filebrowserImageUploadUrl: '/elfinder/ckeditor',
    // filebrowserUploadUrl: '/elfinder/ckeditor',



  });


</script>


<script src="/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="/plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>

<!-- ./wrapper -->
<script src="../../plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../../plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page script -->

<!-- Jasny Bootstrap -->
<!-- Latest compiled and minified JavaScript -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
    {
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate: moment()
    },
    function (start, end) {
      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>

</body>
</html>
