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

<div class="card">
  <div class="card-header d-flex justify-content-center">
   <h4>Biddings of Products</h4>
 </div>
 <div class="card-body">
  <div class="row m-4">

    <?php

    $cat = $conn->query("SELECT * FROM products");
    if($cat->num_rows <= 0){
      echo "<center><h4><i>No biddings yet.</i></h4></center>";
    } 
    while($row=$cat->fetch_assoc()):
      $prod_id = $row['id'];

      
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
            <p><b>Start Bid:</b> <?php echo $row['start_bid']; ?></p>
            <p><b>Bid End Time:</b> <?php echo $row['bid_end_datetime']; ?></p>
            <p class="truncate"><b>Description:</b> <?php echo $row['description'] ?></p>
            <button class="btn btn-primary btn-sm w-100 view_bids" type="button" data-id="<?php echo $prod_id; ?>">View Bids</button>
          </div>
        </div>
      </div>
      <?php 
      
      echo("<script>console.log('PHP: " . $prod_id . "');</script>"); ?>
    <?php endwhile; ?>
  </div>
</div>
</div>

<script>

  $('.view_bids').click(function() {
    uni_modal("<i class='fa fa-id-card' aria-hidden='true'></i>Bidder Details", "view_bid-lists.php?id=" + $(this).attr('data-id'));
    
  })
  

  window.uni_modal = function($title = '', $url = '') {
    $.ajax({
      url: $url,
      error: err => {
        console.log(err)
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
