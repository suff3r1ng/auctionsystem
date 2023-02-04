<!DOCTYPE html>
<html lang="en">

<head>
  <title>Online Auction System</title>
<?php
  session_start();
  error_reporting(0);
  ini_set('display_errors', 0);
  include 'admin/functions/get.php'; 
  include 'includes/headers.php';
  if ($_SESSION['login_type'] == 1) {
    foreach ($_SESSION as $key => $value) {
      header('location: admin/index.php');
    }
  }

  if (!isset($_SESSION['login_id'])) {
   echo "<style>
   body.modal-open .blur {
    -webkit-filter: blur(4px);
    -moz-filter: blur(4px);
    -o-filter: blur(4px);
    -ms-filter: blur(4px);
    filter: blur(4px);

  }
  </style>"; 
}
?>

<style>


  .loader-wrapper {
    align-items: center;
    background: #FFF;
    display: flex;
    height: 100vh;
    justify-content: center;
    left: 0;
    position: fixed;
    top: 0;
    transition: opacity 0.2s linear;
    width: 100%;
    z-index: 9999;
    opacity: 1;
    transform: opacity 1s linear;
  }

  .loader {
    border: 5px solid #47c2fc;
    border-radius: 50%;
    border-top: 5px solid #1d46ea;
    width: 50px;
    height: 50px;
    -webkit-animation: spin .5s linear infinite;
    /* Safari */
    animation: spin .5s linear infinite;

  }

  .loader-inner {
    vertical-align: top;
    display: inline-block;
    width: 100%;
    background-color: #;
    animation: loader-inner 2s infinite ease-in;
  }

  @keyframes loader {
    0% {
      transform: rotate(0deg);
    }

    25% {
      transform: rotate(180deg);
    }

    50% {
      transform: rotate(180deg);
    }

    75% {
      transform: rotate(360deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }

  @keyframes loader-inner {
    0% {
      height: 0%;
    }

    25% {
      height: 0%;
    }

    50% {
      height: 100%;
    }

    75% {
      height: 100%;
    }

    100% {
      height: 0%;
    }
  }
</style>

</head>

<body>
 <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
 <div class="loader-wrapper">
  <span class="loader"><span class="loader-inner"></span></span>
</div>
<div class="blur">
  <?php include "includes/topbar.php"; ?>
  <?php include "includes/sidebar.php"; ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <h2>Dashboard</h2>
    </div>
    <div class="page">
      <?php $home = isset($_GET['page']) ? $_GET['page'] : 'home'; ?>
      <?php include $home . '.php' ?> 
    </div>
          <!-- a must have in every page
        <div class="pagetitle">

          <h1>Dashboard</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </nav>
        </div End Page Title -->

        

        <!-- Modal -->
        <div class="modal fade" id="create" role='dialog'>
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title"><b>Create Category</b></h5>
              </div>
              <div class="modal-body">
                <form action="" id="manage-category">
                  <div class="col-lg-12">
                    <div class="col-lg-6">
                      <input type="hidden" name="id">
                      <div class="form-group">
                        <label class="control-label">Name</label>
                        <input type="text" required="required" class="form-control" name="name">
                      </div>
                    </div>

                    <div class="card-footer m-3">
                      <div class="row">
                        <div class="col" style="width: 200px;">
                          <button class="btn btn-sm btn-primary col-sm-3 offset-md-3">Save</button>
                          <button class="btn btn-sm btn-default col-sm-3 " type="button" onclick="$('#manage-category').get(0).reset()">Cancel</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                <div id="delete_content"></div>
              </div>
              <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="confirm_modal" role='dialog'>
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
              </div>
              <div class="modal-body">
                <div id="delete_content"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="viewer_modal" role='dialog'>
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
            <img src="" alt="">
          </div>
        </div>
      </div>
      <div style="display: none;">
        <?php include "home.php"; ?>
      </div>
      <div style="display: none;">
        <?php include 'login.php'; ?>
      </div>
      <div style="display: none;">
        <?php include 'register.php'; ?>
      </div>
    </main><!-- End #main -->



    <?php 
    if(!isset($_SESSION['login_id']))
      echo '<script type="text/javascript">
    var get = document.getElementById("login-page");
    $(document).ready(function(){  
      $(".modal-body").html(get);
      $("#uni_modal").modal("show");
      });
      </script>';
      ?>


      <!-- includes for modal -->



      <!-- end includes -->



      <div>
        <?php include "includes/footer.php"; ?>
      </div>

      <!-- uni Modal -->

      <div class="modal fade" id="uni_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">

              <h5 class="modal-title"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              ...
            </div>

          </div>
        </div>
      </div>
      <script type="text/javascript">
        window.uni_modal = function($title = '', $url = '') {
          $.ajax({
            url: $url,
            error: err => {
              console.log(error)
              alert("An error occured")
            },
            success: function(resp) {
              if (resp) {
                $('#uni_modal .modal-title').html($title)
                $('#uni_modal .modal-body').html(resp)
                $('#uni_modal').modal('show')

              }
            }
          })
        }

      </script>
      <!-- end uni modal -->

    </body>

    </html>