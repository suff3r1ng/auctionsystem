
  <script>
   
    /*
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
      console.log(data)
      $('.available').html(data.notification);
      if(data.unseen_notification > 0)
      {
        $('.count').html(data.unseen_notification);
      }
    }
  });
}*/


// load new notifications
/*$(document).on('click', '.notif', function(){
  $('.count').html('');
  load_unseen_notification('yes');
});
setInterval(function(){
  load_unseen_notification();;
}, 5000);
*/



$('.datetimepicker').datetimepicker({
  format:'Y/m/d H:i',
  startDate: '+3d'
});
window.categ = function($msg=''){
 $('#create .modal-body').html($msg)
 $('#create').modal('show')
}
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


</script>



<!-- Bootstrap core JS-->

<!-- Core theme JS-->
<!-- Template Main JS File -->



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
    <a href="index.php?page=admin/pages-faq"> Designed by Group Esubasta(Online Auction System)</a> 
  </div>
  </footer><!-- End Footer -->