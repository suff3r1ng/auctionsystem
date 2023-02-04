<?php
$page = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
$path = $_SERVER['QUERY_STRING'];
$index = $_SERVER['REQUEST_URI'];
$active = str_replace('', '', $index)
?>
<aside id="sidebar" class="sidebar" style="display: <?php if (empty($_SESSION['login_id'])) echo "none";
                                                    else echo " "; ?>;">

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

    <li class="nav-item ">
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Create</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content <?php if ($path == ("page=create-category") || $path == ("page=create-product")) {
                                                    echo 'show';
                                                  } else {
                                                    echo 'collapse';
                                                  } ?> " data-bs-parent="#sidebar-nav">
        <li>

          <a class="<?php if ($path == ("page=create-category")) {
                      echo 'active';
                    } else {
                      echo 'noactive';
                    } ?>" href="index.php?page=create-category">
            <i class="bi bi-circle"></i><span>Product & Category</span>
          </a>
        </li>

        <li>

      </ul>
    </li><!-- End Components Nav -->

    <li class="nav-item notif">
      <a class="nav-link available <?php if ($path == ("page=available-items")) {
                                      echo 'active';
                                    } else {
                                      echo 'collapsed';
                                    } ?>" href="index.php?page=available-items">

        <i class="bi bi-journal-text "></i>
        <span>
          Available Items
        </span>

        <span class="badge bg-danger badge-number m-3 top-0 start-100 translate-middle count"></span>
      </a>

    </li><!-- End Forms Nav -->

    <li class="nav-item">
      <a class="nav-link <?php if ($path == ("page=manage-users")) {
                            echo 'active';
                          } else {
                            echo 'collapsed';
                          } ?>" href="index.php?page=manage-users">
        <i class="ri-map-pin-user-fill"></i><span>Manage Users</span>
      </a>

    </li><!-- End Forms Nav -->

  </ul>

</aside>