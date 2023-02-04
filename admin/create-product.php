 <?php if(isset($_SESSION['login_id'])): ?>
  <div class="pagetitle">

    <nav>
      <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="index.php?page=pages-home">Home</a></li>
       <li class="breadcrumb-item">Create</li>
       <li class="breadcrumb-item active">Product</li>
     </ol>
   </nav>
 </div><!-- End Page Title -->

 <section class="section">
   <div class="row justify-content-center">
    <div class="col-lg-6">
     <div class="card">
      <div class="card-body">
       <h5 class="card-title">Create New Product</h5>
       <span class="float:right">
        <a class="btn btn-primary m-1 justify-content-center create_pro">
          <i class="fa fa-plus w-100"></i> New Entry
        </a>
      </span>

    </div>
  </div>

</div>
</div>
<div style="display: none;">
 <?php include "product_management.php" ?>
</div>

</section>


<?php else: ?>


  <?php 
  if(getcwd() == dirname(__FILE__)) {
    require('pages-error-403.php');
  }

  ?>

<?php endif; ?>
