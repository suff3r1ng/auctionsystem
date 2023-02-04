 <?php if (empty($_SESSION['login_id'])) : ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <?php include"includes/headers.php" ?>
   

  </head>
  <body>

    
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <div class="container" id="register">

     <section class="section register min-vh-2 d-flex flex-column align-items-center justify-content-center py-4">
       <div class="container">
         <div class="row justify-content-center">
           <div class="col-lg col-md d-flex flex-column align-items-center justify-content-center">

             <div class="d-flex justify-content-center py-4">
               <a href="index.html" class="logo d-flex align-items-center w-auto">
                 <img src="admin/assets/img/logo.png" alt="">
                 <span class="d-none d-lg-block">Online Auction System</span>
               </a>
             </div><!-- End Logo -->

             <div class="card lg-4">

               <div class="card-body">

                 <div class="pt-4 pb-2">
                   <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                   <p class="text-center small">Enter your personal details to create account</p>
                 </div>

                 <form action="" id="signup-frm" runat="server" class="row">
                   <div class="container justify-content-center col md-3 w-25 m-3" style="height: 100px;">
                     <center>
                       <label for="blah" class="control-label  m-2">Profile Preview</label>

                       <img class="row" style=" width: 100px; height: 100px; border-radius: 100px; border-style: solid;" id="blah" />


                     </center>
                   </div>

                   <div class="col-12">
                     <label for="file" class="form-label mt-4"><b>Upload Profile Image</b></label>
                     <div class="input-group justify-content-center">
                       <span class="input-group-text bi bi-upload" id="inputGroupPrepend"></span>
                       <input type='file' required="required" name="profile" id="imgInp" />
                     </div>

                   </div>



                     <div class="col-12">
                       <label for="yourName" class="form-label">Your Name</label>
                       <input type="text" required="required" name="name" class="form-control" id="yourName" >
                       <div class="invalid-feedback">Please, enter your name!</div>
                     </div>

                     <div class="col-12">
                       <label for="yourEmail" class="form-label">Your Email</label>
                       <input type="email" required="required" name="email" class="form-control" id="yourEmail" >
                       <div class="invalid-feedback">Please enter a valid Email address!</div>
                     </div>
                     <div class="col-6">
                       <label for="yourContact" class="form-label">Your Contact Number</label>
                       <div class="input-group has-validation">
                         <span class="input-group-text" id="inputGroupPrepend">+63</span>
                         <input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                         type = "number" maxlength="10" name="contact" class="form-control" id="yourContact" required="required">
                         <div class="invalid-feedback">Please enter your contact number!</div>
                       </div>
                     </div>
                     <div class="col-12">
                       <label for="yourContact" class="form-label">Your Address
                       </label>
                       <input type="text" name="address" class="form-control" id="yourContact" required="required">
                       <div class="invalid-feedback">Please enter your address!
                       </div>
                     </div>
                     <div class="col-12">
                       <label for="yourUsername" class="form-label">Username</label>
                       <div class="input-group has-validation">
                         <span class="input-group-text" id="inputGroupPrepend">@</span>
                         <input type="text" name="username" class="form-control" id="yourUsername" required="required">
                         <div class="invalid-feedback">Please choose a username.</div>
                       </div>
                     </div>

                     <div class="col-12">
                       <label for="yourPassword" class="form-label">Password</label>
                       <input type="password" name="password" class="form-control" id="yourPassword" required="required">
                       <div class="invalid-feedback">Please enter your password!</div>
                     </div>

                     <div class="col-12 d-flex mt-3">
                       <input type="submit" name="submit" class="btn btn-primary w-100" value="Create Account">
                     </div>
                     <div class="col-12">
                       <p class="small mb-0">Already have an account? <a href="index.php">Log in</a></p>
                     </div>
                   </form>

                 </div>
               </div>

               <div class="credits">
                 Online Auction System
               </div>

             </div>
           </div>
         </div>

       </section>

     </div>
     <script src="admin/assets/js/main.js"></script>

     <style>
       #uni_modal .modal-footer {
         display: none;
       }
     </style>
     <script>
       $('#signup-frm').submit(function(e) {
         e.preventDefault()
         console.log[new FormData($(this)[0])]
         
         $('#msg').html('')
         $.ajax({
           url: 'admin/functions/ajax.php?action=signup',
           data: new FormData($(this)[0]),
           cache: false,
           contentType: false,
           processData: false,
           method: 'POST',
           type: 'POST',
           error: err => {
             console.log(err)


           },
           success: function(resp) {
            console.log(resp)
             if (resp == 1) {
              const Toast = Swal.mixin({
                toast: true,
                position: 'center',
                showConfirmButton: false,
              })
              Toast.fire({
                icon: 'success',
                title: 'Registered successfully'
              });
              setTimeout(function () {
                location.href = 'index.php';
              }, 1000);

            }else if (resp == 2) {
             const Toast = Swal.mixin({
              toast: true,
              position: 'center',
              timer: 1500,
              showConfirmButton: false,
            })
             Toast.fire({
              icon: 'error',
              title: 'Email Already Exist'
            });
             
           }else if (resp == 3){
            const Toast = Swal.mixin({
              toast: true,
              position: 'center',
              timer: 1500,
              showConfirmButton: false,
            })
             Toast.fire({
              icon: 'error',
              title: 'User Already Exist'
            });
           }

         }
       })
       })

       function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
        }
      }

      $("#imgInp").change(function(){
        readURL(this);
      });

    </script>
  </body>
  </html>

  <?php else : ?>

   <?php
   if (getcwd() == dirname(__FILE__)) {
    require('admin/pages-error-404.php');
  }

  ?>

<?php endif; ?>
