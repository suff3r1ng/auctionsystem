<?php if (isset($_SESSION['login_id'])) : ?>
  <?php 
  include 'admin/functions/db_con.php'; 
  $user_id = $_SESSION['login_id'];
  ?>
  <style>
    #cat-list li{
      cursor: pointer;
    }
    #cat-list li:hover {
      color: white;
      background: #007bff8f;
    }
    .prod-item p{ 
      margin: unset;
    }
    .bid-tag {
      position: absolute;
      right: .5em;
    }
  </style>
  <?php 
  $cid = isset($_GET['category_id']) ? $_GET['category_id'] : 0;
  ?>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
  <div class="contain-fluid">
    <div class="col-lg-12">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              List of items
            </div>
            <div class="card-body">
              <div class="row m-4">
                <?php 
                $cat = $conn->query("SELECT * FROM products WHERE user_id != '$user_id'order by name asc");
                if($cat->num_rows <= 0){
                  echo "<center><h4><i>No Available Product.</i></h4></center>";
                } 
                while($row=$cat->fetch_assoc()):
                 ?>
                 <div class="col-md-4">
                   <div class="card">
                    <div class="float-right align-top bid-tag">
                     <span class="badge badge-pill badge-primary text-white"><i class="fa fa-tag"></i> <?php echo number_format($row['start_bid']) ?></span>
                   </div>
                   <img class="card-img-top" src="admin/uploads/<?php echo $row['img_fname'] ?>" alt="Card image cap">
                   <div class="float-right align-top d-flex">
                     <span class="badge badge-pill badge-warning text-white"><i class="fa fa-hourglass-half"></i> <?php echo date("M d,Y h:i A",strtotime($row['bid_end_datetime'])) ?></span>
                   </div>
                   <div class="card-body prod-item">
                     <p><b>Item Name:</b> <?php echo $row['name'] ?></p>
                     <p class="truncate"><b>Description:</b> <?php echo $row['description'] ?></p>
                     <button class="btn btn-primary btn-sm w-100 view_prod" type="button" data-id="<?php echo $row['id'] ?>"> View</button>
                   </div>
                 </div>
               </div>
             <?php endwhile; ?>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
<div class="modal fade" id="view_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

<script>
  window.view_modal = function($title = '', $url = '' ) {

    $.ajax({
      url: $url,
      error: err => {
        console.log(error)
        alert("An error occured")
      },
      success: function(resp) {
        if (resp) {
          $('#view_modal .modal-title').html($title)
          $('#view_modal .modal-body').html(resp)
          $('#view_modal').modal('show')

        }
      }
    })
  }

  $('#cat-list li').click(function(){
    location.href = $(this).attr('data-href')
  })
  $('#cat-list li').each(function(){
    var id = '<?php echo $cid > 0 ? $cid : 'all' ?>';
    if(id == $(this).attr('data-id')){
      $(this).addClass('active')
    }
  })

  $('.view_prod').click(function(){
    var data = ($(this).data('id'))
    view_modal('Product View','view_prod.php?id='+$(this).attr('data-id'))
  })
  /*('View Product','view_prod.php?id='+$(this).attr('data-id'))*/
</script>


<?php else : ?>


  <?php if (getcwd() == dirname(__FILE__)) {
    require('admin/pages-error-403.php');
  } ?>

  <?php endif; ?>