<nav class="navbar navbar-inverse">
  <div class="container-fluid container">
    <div class="navbar-header">
      <a class="navbar-brand logo" href="#">LTP</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="<?=BASE_URL_PATH . 'lopphutrach.php' ?>">Lớp phụ trách</a></li>
      <li class="active"><a href="<?=BASE_URL_PATH . 'lopchunhiem.php' ?>">Lớp chủ nhiệm</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li>
        <a href="#" class="btn btn-secondary" data-toggle="tooltip" data-html="true" data-placement="bottom"
          title="<p>Họ tên: <?php echo $_SESSION['hoten'] ?></p><p>MSGV: <?php echo $_SESSION['msgv'] ?></p><p> Chuyên Môn: <?php echo $_SESSION['tenmon'] ?></p>"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['hoten'] ?></a>
      </li>
      <li><a href="<?=BASE_URL_PATH . 'index.php' ?>"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>


        
        