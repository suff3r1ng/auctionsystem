<?php
include "functions/db_con.php";
$login_id = $_SESSION['login_id'];
if (isset($_SESSION['login_id'])) {
  $qry = $conn->query("SELECT * FROM users where id= " . $login_id);
  foreach ($qry->fetch_array() as $k => $val) {
    $$k = $val;
  }
}
?>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="index.php" class="logo nav-link d-flex align-items-center">
      <img src="assets/img/logo.png" alt="">
      <span class="d-none d-lg-block">Online Auction System</span>
    </a>
    <?php if (isset($_SESSION['login_id'])) echo '<i class="bi bi-list toggle-sidebar-btn"></i>'; else echo ""; ?>
  </div><!-- End Logo -->

  <div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
      <input type="text" name="query" id="search" placeholder="Search" title="Enter search keyword">
      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
  </div><!-- End Search Bar -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle " href="#">
          <i class="bi bi-search"></i>
        </a>
      </li><!-- End Search Icon-->

      <li class="nav-item dropdown pe-3">
        <!--   start profile image hide if not logged in -->
        
        <?php if(isset($_SESSION['login_id'])): ?>
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?php echo isset($img) ? '../' . $img : '' ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"></span>
          </a><!-- End Profile Iamge Icon -->

          <?php else: ?>
           <a class="nav-link nav-profile d-flex nav-icon pe-0"  href="#" data-bs-toggle="dropdown">

            <!-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
            <i class="bi bi-person bi-4x rounded-circle"></i>

            <span class="d-none d-md-block dropdown-toggle ps-2"></span>
          </a>
        <?php endif; ?>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

          <?php if(isset($_SESSION['login_id'])): ?>
           <li>

            <li class="nav-item dropdown-item d-flex justify-content-center">
              <b><?php echo ucwords("Welcome ".$_SESSION['login_name']) ?> </b>
            </li>
            <hr class="dropdown-divider">
            <li>
              <a class="dropdown-item d-flex align-items-center" href="index.php?page=users-profile">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="index.php?page=users-profile">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <?php else: ?>

              <li>
                <a class="dropdown-item d-flex align-items-center nav-link login_now js-scroll-trigger" href="javascript:void(0)" data-id="loginas">
                  <i class="ri-login-box-line" ></i>
                  <span>Login</span>
                </a>
                
              </li>
            <?php endif; ?>

            <li>
              <hr class="dropdown-divider">
            </li>

            <?php if(isset($_SESSION['login_id'])): ?>
              <li>
                <hr class="dropdown-divider">
              </li>

              <li onclick="confirm()" class="dropdown-item d-flex align-items-center">


                <i class="ri-logout-box-line"></i>
                <a class="nav-link" href="#">
                  <span>Sign Out</span>
                </a>


                <?php else: ?>

                <?php endif; ?>
              </li>

            </ul><!-- End Profile Dropdown Items -->
          </li><!-- End Profile Nav -->

        </ul>
      </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->



