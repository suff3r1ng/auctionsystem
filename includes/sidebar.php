  <?php
  $page = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
  $path = $_SERVER['QUERY_STRING'];
  $index = $_SERVER['REQUEST_URI'];
  $active = str_replace('', '', $index)
  ?>
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link <?php if ($page == ("index.php")) {
          echo 'active';
          } else {
            echo 'collapsed';
          } ?>" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>

        </a>

      </li><!-- End Dashboard Nav -->

      <!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link available <?php if ($path == ("page=create_prod")) {
          echo 'active';
          } else {
            echo 'collapsed';
          } ?>" href="index.php?page=create_prod">

          <i class="bi bi-journal-text "></i>
          <span>
            Create Product
          </span>

        </a>

      </li><!-- End Forms Nav -->

      <!-- products nav -->

      <li class="nav-item">
        <a class="nav-link <?php if ($path == ("page=products")) {
          echo 'active';
          } else {
            echo 'collapsed';
          } ?>" href="index.php?page=products">
          <i class="ri-product-hunt-fill"></i></i><span>Products</span>
        </a>

      </li><!-- End Forms Nav -->
      <!-- end products -->
      <li class="nav-item">
        <a class="nav-link <?php if ($path == ("page=manage_user-prod")) {
          echo 'active';
          } else {
            echo 'collapsed';
          } ?>" href="index.php?page=manage_user-prod">
          <i class="ri-product-hunt-line"></i><span>Manage Your Product</span>
        </a>

      </li><!-- End Forms Nav -->

      
      <li class="nav-item">
        <a class="nav-link <?php if ($path == ("page=userbid")) {
          echo 'show';
          } else {
            echo 'collapsed';
          } ?>" href="index.php?page=userbid">
          <i class="bi bi-menu-button-wide"></i><span>Biddings</span>
        </a>

      </li>
    </aside>