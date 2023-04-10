<nav class="navbar navbar-inverse">
  <div class="container-fluid container">
    <div class="navbar-header">
      <a class="navbar-brand logo" href="#">LTP</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="<?=BASE_URL_PATH . 'qlhocsinh.php'?>">Quản lý học sinh</a></li>
      <li><a href="<?=BASE_URL_PATH . 'qlgiaovien.php'?>">Quản lý giáo viên</a></li>
      <li class="active"><a href="<?=BASE_URL_PATH . 'qllophoc.php'?>">Quản lý lớp học</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li>
        <a href="#" class="btn btn-secondary"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['quantri'] ?></a>
      </li>
      <li><a href="<?=BASE_URL_PATH . 'loginquantri.php' ?>"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>


        
        