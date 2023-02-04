<?php if (isset($_SESSION['login_id'])) : ?>
  <?php 
  include 'admin/functions/db_con.php'; 
  $user_id = $_SESSION['login_id'];


  $qry = 'SELECT (DATE_FORMAT(date_created,"%M")) AS "Month", (DATE_FORMAT(date_created,"%d")) AS "Day", COUNT(*) AS id FROM bids WHERE year(date_created)= year(CURRENT_DATE) GROUP BY (DATE_FORMAT(date_created,"%d")) ORDER BY "Month" ASC';
  $result = mysqli_query($conn,$qry);
  while ($row = mysqli_fetch_row($result)){
   $month = $row [0];
   $data1[] = $row[2];
   $date[] = $row[1];


  print_r($month);
}

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
<div class="col-lg-12">
  <div class="card">
    <div class="card-body">

      <h5 class="card-title text-center">Biddings</h5>



      <p style="align:center;"><canvas  id="chartjs_bar"></canvas></p>

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
    view_modal('View Product','view_prod.php?id='+$(this).attr('data-id'))
  });
  Chart.defaults.font.size = 16;
  var ctx = document.getElementById("chartjs_bar").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels:<?php echo json_encode($date) ?>,
      datasets: [{
        backgroundColor: [
        "#0040ff",
        "#00bfff",
        "#0080ff",
        "#ffc750"
        ],
        data:<?php echo json_encode($data1); ?>,
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Number of Users Bid',
            font: {weight: 'bold'},
            color:"#012964",
          },
        },
        x: {
          beginAtZero: true,
          title: {
            display: true,
            text: <?php echo json_encode ($month) ?>,
            font: {weight: 'bold'},
            color:"#012964",
          },
        },
      },
      legend: {
        text: 'Biddings on this Dates',
        display: true,
        position: 'bottom',
        labels: {
          fontColor: '#71748d',
          fontFamily: 'Circular Std Book',
          fontSize: 14,

        }
      },
    }
  });


</script>
<!-- End Line Chart -->

<?php else : ?>


  <?php if (getcwd() == dirname(__FILE__)) {
    require('admin/pages-error-403.php');
  } ?>

  <?php endif; ?>