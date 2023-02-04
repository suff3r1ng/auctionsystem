<?php 
$index = $_SERVER['REQUEST_URI'];
$index = $_SERVER['REQUEST_URI'];
$active = str_replace('', '', $index);
include 'functions/db_con.php';
?> 
<?php
$login_id = $_SESSION['login_id'];
if (isset($_SESSION['login_id'])) {
  $qry = $conn->query("SELECT * FROM users where id= " . $login_id);
  foreach ($qry->fetch_array() as $k => $val) {
    $$k = $val;
  }
}
?>
<?php echo("<script>console.log('PHP: " . $login_id . "');</script>"); ?>
<div class="pagetitle">
  <h1>Profile</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item">Users</li>
      <li class="breadcrumb-item active">Profile</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section profile">
  <div class="row">
    <div class="col-xl-4">

      <div class="card">
        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
          <img src="<?php echo isset($img) ? '../' . $img : ''; ?>" alt="Profile" class="rounded-circle">
          <h2><?php echo ucwords(isset($name) ? $name : '' )?></h2>

          <div class="social-links mt-2">
            <!-- will add soon -->
          </div>
        </div>
      </div>

    </div>

    <div class="col-xl-8">

      <div class="card">
        <div class="card-body pt-3">
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered">

            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
            </li>

            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
            </li>

          </ul>
          <div class="tab-content pt-2">

            <div class="tab-pane fade show active profile-overview" id="profile-overview">


              <h5 class="card-title">Profile Details</h5>

              <div class="row">
                <div class="col-lg-3 col-md-4 label ">Full Name</div>
                <div class="col-lg-9 col-md-8"><?php echo ucwords(isset($name) ? $name : '' )?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Address</div>
                <div class="col-lg-9 col-md-8"><?php echo ucwords(isset($address) ? $address : '' )?></div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-md-4 label">Phone</div>
                <div class="col-lg-9 col-md-8">+63<?php echo isset($contact) ? $contact : '' ?></div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Email</div>
                <div class="col-lg-9 col-md-8"><?php echo isset($email) ? $email : '' ?></div>
              </div>

            </div>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

              <!-- Profile Edit Form -->
              <form class="row g-3 needs-validation mt-5" runat="server" action="" id="edit-frm">
                <div class="row mb-3">
                  <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                  <div class="col-md-8 col-lg-9">
                    <img src="<?php echo isset($img) ? '../' . $img : '' ?>" alt="" id="img_path-field">
                    <div class="pt-2">
                      <a href="#" type="file" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i>
                       <input type="file"  id="img" name="profile" onchange="displayImg2(this,$(this))">
                     </a>
                   </div>
                   <script type="text/javascript">
                    function displayImg2(input, _this) {
                      if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                          $('#img_path-field').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                      }
                    }
                  </script>
                </div>
              </div>

              <div class="row mb-3">
                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                <div class="col-md-8 col-lg-9">
                  <input name="name" type="text" class="form-control" id="fullName" value="<?php echo ucwords(isset($name) ? $name : '' )?>">
                </div>
              </div>

              <div class="row mb-3">
                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Username</label>
                <div class="col-md-8 col-lg-9">
                  <input name="username" type="text" class="form-control" id="fullName" value="<?php echo ucwords(isset($username) ? $username : '' )?>">
                </div>
              </div>

              <div class="row mb-3">
                <label for="company" class="col-md-4 col-lg-3 col-form-label">Email</label>
                <div class="col-md-8 col-lg-9">
                  <input name="email" type="text" class="form-control" id="company" value="<?php echo isset($email) ? $email : '' ?>">
                </div>
              </div>



              <div class="row mb-3">
                <label for="Country" class="col-md-4 col-lg-3 col-form-label">Address</label>
                <div class="col-md-8 col-lg-9">
                  <input name="address" type="text" class="form-control" id="address" value="<?php echo ucwords(isset($address) ? $address : '' )?>">
                </div>
              </div>


              <div class="row mb-3">
                <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                <div class="col-md-8 col-lg-9  ">
                  <div class="input-group">
                   <span class="input-group-text" id="inputGroupPrepend">+63</span>
                   <input name="contact" type="number" class="form-control" id="address" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10"value="<?php echo isset($contact) ? $contact : ''?>">

                   <!-- <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                     type = "number" maxlength="10" name="contact" class="form-control" id="yourContact" required="required"> -->
                   </div>
                 </div>
               </div>


               <div class="text-center">
                <button type="submit" class="btn btn-primary" id="submit">Save Changes</button>
              </div>
            </form><!-- End Profile Edit Form -->

          </div>

          <div class="tab-pane fade pt-3" id="profile-settings">


          </div>

          <div class="tab-pane fade pt-3" id="profile-change-password">
            <!-- Change Password Form -->
            <form action="" id="change_pass">

              <div class="row mb-3">
                <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                <div class="col-md-8 col-lg-9">
                  <input name="password" type="password" class="form-control" id="currentPassword">
                </div>
              </div>

              <div class="row mb-3">
                <label for="newpassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                <div class="col-md-8 col-lg-9">
                  <input name="newpassword" type="password" class="form-control" id="newPassword">
                </div>
              </div>

              <div class="row mb-3">
                <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                <div class="col-md-8 col-lg-9">
                  <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                </div>
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-primary">Change Password</button>
              </div>
            </form><!-- End Change Password Form -->

          </div>

        </div><!-- End Bordered Tabs -->

      </div>
    </div>

  </div>
</div>
</section>

</main><!-- End #main -->

<script type="text/javascript">
  $(document).ready(function(){
    $('#change_pass').submit(function(e){
      e.preventDefault()
      $('#msg').html('')
      $.ajax({
        url: 'functions/ajax.php?action=update_password',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function(resp) {
          console.log(resp)
          if (resp == 1) {
            console.log(resp)
            const Toast = Swal.mixin({
              toast: true,
              position: 'center',
              showConfirmButton: false,
              timer: 1500,
              timerProgressBar: true,

            })

            Toast.fire({
              icon: 'error',
              title: 'Old password required!!'
            });

          }
          if (resp == 2) {
            console.log(resp)
            const Toast = Swal.mixin({
              toast: true,
              position: 'center',
              showConfirmButton: false,
              timer: 1500,
              timerProgressBar: true,

            })

            Toast.fire({
              icon: 'error',
              title: 'New password required!!'
            });

          }if (resp == 3) {
            console.log(resp)
            const Toast = Swal.mixin({
              toast: true,
              position: 'center',
              showConfirmButton: false,
              timer: 1500,
              timerProgressBar: true,

            })

            Toast.fire({
              icon: 'error',
              title: "The confirmation password does not match!!"
            });

          }if (resp == 4) {
            console.log(resp)
            const Toast = Swal.mixin({
              toast: true,
              position: 'center',
              showConfirmButton: false,
              timer: 1500,
              timerProgressBar: true,

            })

            Toast.fire({
              icon: 'error',
              title: 'Please enter password !'
            });

          }if (resp == 4) {
            const Toast = Swal.mixin({
              toast: true,
              position: 'center',
              showConfirmButton: false,
              timer: 1500,
              timerProgressBar: true,

            })

            Toast.fire({
              icon: 'success',
              title: 'Password Changed !'
            });
            setTimeout(function() {
              location.reload();
            }, 1000);
          }if (resp == 5) {
            const Toast = Swal.mixin({
              toast: true,
              position: 'center',
              showConfirmButton: false,
              timer: 1500,
              timerProgressBar: true,

            })

            Toast.fire({
              icon: 'error',
              title: 'Incorrect Password!'
            });
            setTimeout(function() {
            }, 1500);
          }if (resp == 6) {
            console.log(resp)
            const Toast = Swal.mixin({
              toast: true,
              position: 'center',
              showConfirmButton: false,
              timer: 1500,
              timerProgressBar: true,

            })

            Toast.fire({
              icon: 'error',
              title: "New password cannot be the same as old password!"
            });

          }
        }
      })

    })

    $('#edit-frm').submit(function(e) {
      e.preventDefault()
      console.log()
      $('#msg').html('')
      $.ajax({
        url: 'functions/ajax.php?action=update_user',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function(resp) {
          console.log(resp)
          if (resp == 1) {
            console.log(resp)
            const Toast = Swal.mixin({
              toast: true,
              position: 'center',
              showConfirmButton: false,
              timer: 1500,
              timerProgressBar: true,

            })

            Toast.fire({
              icon: 'success',
              title: 'Saved!'
            })
            setTimeout(function() {
              window.location(history.go(-1));
            }, 1500);
          } 
        }
      })
    })

  })
</script>