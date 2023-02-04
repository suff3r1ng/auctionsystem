<?php 
if(!isset($_SESSION['login_id']))
  echo '<script type="text/javascript">
var get = document.getElementById("login-page");
console.log(get)
$(document).ready(function(){  
  $(".modal-body").html(get);
  $("#uni_modal").modal("show");
  });
  </script>';
  ?>
  <script>
    $(document).ready(function(){

      function myFunction() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
          a = li[i].getElementsByTagName("a")[0];
          txtValue = a.textContent || a.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
          } else {
            li[i].style.display = "none";
          }
        }
      }
// updating the view with notifications using ajax
function load_unseen_notification(view = '')
{
  $.ajax({
    url:"functions/fetch.php",
    method:"POST",
    data:{view:view},
    dataType:"json",
    success:function(data)
    {
      $('.available').html(data.notification);
      if(data.unseen_notification > 0)
      {
        $('.count').html(data.unseen_notification);
      }
    }
  });
}


// load new notifications
$(document).on('click', '.notif', function(){
  $('.count').html('');
  load_unseen_notification('yes');
});
setInterval(function(){
  load_unseen_notification();;
}, 5000);
});



    $('.datetimepicker').datetimepicker({
      format:'Y/m/d H:i',
      startDate: '+3d'
    })

    window._conf = function($msg='',$func='',$params = []){
     $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
     $('#confirm_modal .modal-body').html($msg)
     $('#confirm_modal').modal('show')
   }
   var createp = document.getElementById('create_pro');

   $('.create_pro').click(function(){
    $('.modal-body').html(createp)
    $('#uni_modal').modal('show')
  });

   window.start_load = function(){
    $('body').prepend('<div class="loader-wrapper"></div>')
  }


  function confirm(){

    Swal.fire({
      title: 'Are you sure you want to log out?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Log out!',

    }).then((result) => {
      if (result.isConfirmed == true) {
       const Toast = Swal.mixin({
        toast: true,
        position: 'center',
        showConfirmButton: false,
        timer: 1500

      })
       Toast.fire({
        icon: 'success',
        title: 'Logged out!'
      });
       setTimeout(function() {
        window.location="functions/ajax.php?action=logout";
      }, 1200);
     }
   })
  }

</script>



<!-- Bootstrap core JS-->

<!-- Core theme JS-->
<!-- Template Main JS File -->
<script async src="assets/js/main.js"></script>


<!-- ======= Footer ======= -->
<footer id="footer" class="footer fixed-bottom" style="background-color: #d0e3f5; height: 75px;" >
  <div class="copyright">
    &copy; Copyright <strong><span>Group Esubasta</span></strong>. All Rights Reserved
  </div>
  <div class="credits">
    <!-- All the links in the footer should remain intact. -->
    <!-- You can delete the links only if you purchased the pro version. -->
    <!-- Licensing information: https://bootstrapmade.com/license/ -->
    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
    <a href="index.php?page=pages-faq"> Designed by Group Esubasta(Online Auction System)</a> 
  </div>
  </footer><!-- End Footer -->