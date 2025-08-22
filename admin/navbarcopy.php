<nav class="navbar navbar-expand-lg bg-body-tertiary border border-dark rounded p-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="logoImage/logo.jfif" style="width: 80px; height:80px;" class="img-responsi"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <?php if(isset($_SESSION['loginSuccess']))
          {
          ?>
        <li class="nav-item">
          <a class="nav-link" href="viewProduct.php">View Product</a>
        </li>
        <li class="nav-item">
          <?php echo "<p class = 'nav-link disabled'>$_SESSION[email]</p>" ?>
        </li>
        <li class="nav-item">
          <a href="logout.php" class="nav-link">Logout</a>
        </li>
      </ul>
      <form class="d-flex" role="search" method="get" action="viewProduct.php">
        <input name="tsearch" class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
        <button name="bsearch" class="btn btn-outline-success" type="submit">Search</button>
      </form>
      <?php  }  ?>
    </div>
  </div>
</nav>