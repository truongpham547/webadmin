<?php
  include "android/connect.php";
  require('android/jwt.php');
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  if(isset($_COOKIE['admin']))
  {
    setcookie('admin', $_COOKIE['admin'], time() + 7200);
    $today=date('Y-m-d');
    $token=$_COOKIE['admin'];
    try{
        $auth=JWT::decode($token, "truong pham", true);
    } catch(Exception $e){}

    if($auth=='admin')
    {
      $search_code="";
      $date_code="";
      $sort_code=" order by id desc ";
      $subsort_code="";
      if(isset($_GET['user']))
      {
        $sql="select user_table.username,DATE_FORMAT(ngaytao, '%d/%m/%Y') ngaytao,slbai,
            hoten,DATE_FORMAT(ngaysinh, '%d/%m/%Y') ngaysinh,sdt,ava from user_table 
            left join (select username,count(*) slbai from review_table group by username) as a 
            on user_table.username=a.username";
      } else
      {
        if(isset($_GET['date']))
        {
          $date=$_GET['date'];
          $date_code=" where date_add(ngaydang,INTERVAL $date day)>=curdate() ";
        }

        if(isset($_GET['sort']))
        {
          $sort=$_GET['sort'];
          if($sort=="newpost")
            $sort_code=" order by id desc ";
          else if($sort=="oldpost")
            $sort_code=" order by id asc ";
          else
          {
            $subsort_code=" left join (select idreview,count(*) soluong from rate_table group by idreview) a
            on id=idreview  ";
            $sort_code=" order by soluong desc,id desc ";
          }
        }

        if(isset($_GET['search']))
        {
          $keyword=$_GET['search'];
          if($keyword!=null) 
            $search_code=" and MATCH(tieude,diachi) AGAINST('$keyword') ";
        }

        $sql="SELECT id,username,DATE_FORMAT(ngaydang, '%d/%m/%Y') ngaydang,tieude,noidung,diachi,hinhanh,rating 
        FROM review_table ".$subsort_code.$date_code.$search_code.$sort_code;
      }
      
      $data=$conn->query($sql); 
    }
  } else 
  {
    header("Location: login.php");
  };
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>City Food</title>
    <!-- Icons-->
    <link rel="icon" type="image/ico" href="./img/favicon.ico" sizes="any" />
    <link href="node_modules/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
    <link href="node_modules/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link href="node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="node_modules/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="css/style.css" rel="stylesheet">
    <link href="vendors/pace-progress/css/pace.min.css" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      // Shared ID
      gtag('config', 'UA-118965717-3');
      // Bootstrap ID
      gtag('config', 'UA-118965717-5');
    </script>
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <header class="app-header navbar">
      <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">
        <img class="navbar-brand-full" src="img/brand/logo.svg" width="89" height="25" alt="CoreUI Logo">
        <img class="navbar-brand-minimized" src="img/brand/sygnet.svg" width="30" height="30" alt="CoreUI Logo">
      </a>
      <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
      </button>
      <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img class="img-avatar" src="android/avatar/admin.jpg" style="width:40px;height:40px;" alt="admin@bootstrapmaster.com">
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header text-center">
              <strong>Admin</strong>
            </div>
            <a class="dropdown-item" href="#">
              <i class="fa fa-user"></i> Profile</a>
            <a class="dropdown-item" href="#">
              <i class="fa fa-wrench"></i> Settings</a>
            <a class="dropdown-item" href="#">
              <i class="fa fa-file"></i> Projects
              <span class="badge badge-primary"></span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout.php">
              <i class="fa fa-lock"></i> Logout</a>
          </div>
        </li>
      </ul>
    </header>
    <div class="app-body">
      <div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="index.php">
                <i class="nav-icon icon-speedometer"></i> Dashboard
                <span class="badge badge-primary"></span>
              </a>
              <a class="nav-link" href="index.php?user">
                <i class="nav-icon icon-user"></i> User
                <span class="badge badge-primary"></span>
              </a>
            </li>
          </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
      </div>
      <main class="main">
        <!-- Breadcrumb-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <?php if(isset($_GET['user'])){ ?>
          <li class="breadcrumb-item active">User</li>
          <?php } else {?>
          <li class="breadcrumb-item active">Dashboard</li>
          <?php }?>
          <!-- Breadcrumb Menu-->
        </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-primary">
                  <div class="card-body pb-0">
                    <div class="btn-group float-right">
                      <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-settings"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                    <div class="text-value">9.823</div>
                    <div>Members online</div>
                  </div>
                  <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart1" height="70"></canvas>
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-info">
                  <div class="card-body pb-0">
                    <button class="btn btn-transparent p-0 float-right" type="button">
                      <i class="icon-location-pin"></i>
                    </button>
                    <div class="text-value">9.823</div>
                    <div>Members online</div>
                  </div>
                  <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart2" height="70"></canvas>
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-warning">
                  <div class="card-body pb-0">
                    <div class="btn-group float-right">
                      <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-settings"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                    <div class="text-value">9.823</div>
                    <div>Members online</div>
                  </div>
                  <div class="chart-wrapper mt-3" style="height:70px;">
                    <canvas class="chart" id="card-chart3" height="70"></canvas>
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-6 col-lg-3">
                <div class="card text-white bg-danger">
                  <div class="card-body pb-0">
                    <div class="btn-group float-right">
                      <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-settings"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                      </div>
                    </div>
                    <div class="text-value">9.823</div>
                    <div>Members online</div>
                  </div>
                  <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart4" height="70"></canvas>
                  </div>
                </div>
              </div>
              <!-- /.col-->
            </div>
            <!-- /.row-->
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-5">
                    <h4 class="card-title mb-0">Traffic</h4>
                    <div class="small text-muted">November 2017</div>
                  </div>
                  <!-- /.col-->
                  <div class="col-sm-7 d-none d-md-block">
                    <button class="btn btn-primary float-right" type="button">
                      <i class="icon-cloud-download"></i>
                    </button>
                    <div class="btn-group btn-group-toggle float-right mr-3" data-toggle="buttons">
                      <label class="btn btn-outline-secondary">
                        <input id="option1" type="radio" name="options" autocomplete="off"> Day
                      </label>
                      <label class="btn btn-outline-secondary active">
                        <input id="option2" type="radio" name="options" autocomplete="off" checked=""> Month
                      </label>
                      <label class="btn btn-outline-secondary">
                        <input id="option3" type="radio" name="options" autocomplete="off"> Year
                      </label>
                    </div>
                  </div>
                  <!-- /.col-->
                </div>
                <!-- /.row-->
                <div class="chart-wrapper" style="height:300px;margin-top:40px;">
                  <canvas class="chart" id="main-chart" height="300"></canvas>
                </div>
              </div>
              <div class="card-footer">
                <div class="row text-center">
                  <div class="col-sm-12 col-md mb-sm-2 mb-0">
                    <div class="text-muted">Visits</div>
                    <strong>29.703 Users (40%)</strong>
                    <div class="progress progress-xs mt-2">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md mb-sm-2 mb-0">
                    <div class="text-muted">Unique</div>
                    <strong>24.093 Users (20%)</strong>
                    <div class="progress progress-xs mt-2">
                      <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md mb-sm-2 mb-0">
                    <div class="text-muted">Pageviews</div>
                    <strong>78.706 Views (60%)</strong>
                    <div class="progress progress-xs mt-2">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md mb-sm-2 mb-0">
                    <div class="text-muted">New Users</div>
                    <strong>22.123 Users (80%)</strong>
                    <div class="progress progress-xs mt-2">
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md mb-sm-2 mb-0">
                    <div class="text-muted">Bounce Rate</div>
                    <strong>40.15%</strong>
                    <div class="progress progress-xs mt-2">
                      <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-->
            <div class="row">
              <div class="col-sm-6 col-lg-3">
                <div class="brand-card">
                  <div class="brand-card-header bg-facebook">
                    <i class="fa fa-facebook"></i>
                    <div class="chart-wrapper">
                      <canvas id="social-box-chart-1" height="90"></canvas>
                    </div>
                  </div>
                  <div class="brand-card-body">
                    <div>
                      <div class="text-value">89k</div>
                      <div class="text-uppercase text-muted small">friends</div>
                    </div>
                    <div>
                      <div class="text-value">459</div>
                      <div class="text-uppercase text-muted small">feeds</div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-6 col-lg-3">
                <div class="brand-card">
                  <div class="brand-card-header bg-twitter">
                    <i class="fa fa-twitter"></i>
                    <div class="chart-wrapper">
                      <canvas id="social-box-chart-2" height="90"></canvas>
                    </div>
                  </div>
                  <div class="brand-card-body">
                    <div>
                      <div class="text-value">973k</div>
                      <div class="text-uppercase text-muted small">followers</div>
                    </div>
                    <div>
                      <div class="text-value">1.792</div>
                      <div class="text-uppercase text-muted small">tweets</div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-6 col-lg-3">
                <div class="brand-card">
                  <div class="brand-card-header bg-linkedin">
                    <i class="fa fa-linkedin"></i>
                    <div class="chart-wrapper">
                      <canvas id="social-box-chart-3" height="90"></canvas>
                    </div>
                  </div>
                  <div class="brand-card-body">
                    <div>
                      <div class="text-value">500+</div>
                      <div class="text-uppercase text-muted small">contacts</div>
                    </div>
                    <div>
                      <div class="text-value">292</div>
                      <div class="text-uppercase text-muted small">feeds</div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-6 col-lg-3">
                <div class="brand-card">
                  <div class="brand-card-header bg-google-plus">
                    <i class="fa fa-google-plus"></i>
                    <div class="chart-wrapper">
                      <canvas id="social-box-chart-4" height="90"></canvas>
                    </div>
                  </div>
                  <div class="brand-card-body">
                    <div>
                      <div class="text-value">894</div>
                      <div class="text-uppercase text-muted small">followers</div>
                    </div>
                    <div>
                      <div class="text-value">92</div>
                      <div class="text-uppercase text-muted small">circles</div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.col-->
            </div>
            <!-- /.row-->
            <div class="row">
              <div class="col-md-12">
                    <!-- /.row-->


  <!-- Danh Sách bài review-->
   <?php
    if(isset($_GET['user'])) include 'user.php';
    else include 'listreview.php' ;
   ?>


 <!--Modal Delete result-->
    <div class="modal fade" id="DelOK" role="dialog">
              <div class="modal-dialog">
              
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Đã xóa thành công một bài viết</h4>
                  </div>
                  <div class="modal-body" align="center">
                    <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                  </div>
                </div>
                
              </div>
    </div>

    <div class="modal fade" id="DelFail" role="dialog">
              <div class="modal-dialog">
              
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Không thể xóa được</h4>
                  </div>
                  <div class="modal-body" align="center">
                    <button  type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                  </div>
                </div>
                
              </div>
    </div>










                  </div>
              </div>
              <!-- /.col-->
            </div>
            <!-- /.row-->
          </div>
        </div>
      </main>
    </div>
    <footer class="app-footer">
      <div>
        <a href="#">City Food</a>
      </div>
    </footer>
    <!-- CoreUI and necessary plugins-->
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/pace-progress/pace.min.js"></script>
    <script src="node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
    <script src="node_modules/@coreui/coreui/dist/js/coreui.min.js"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="node_modules/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js"></script>
    <script src="js/main.js"></script>
    
  <?php
  if(isset($_COOKIE['admin']))
  {
    if(isset($_GET['del']))
    {
      $delstatus=$_GET['del'];
      if($delstatus==1)
      {
        ?>
          <script type="text/javascript">
            $(window).on('load',function(){
            $('#DelOK').modal('show');
            });
          </script>
        <?php
      }
      else{
        ?>
          <script type="text/javascript">
            $(window).on('load',function(){
            $('#DelFail').modal('show');
            });
          </script>
        <?php
      }
      
    }
  }
?>

  </body>
</html>
