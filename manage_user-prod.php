<?php 
include 'admin/functions/db_con.php'; 
?>
<nav>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item active">Manage Your Product</li>
	</ol>
</nav>
<div class="card">
	<div class="card-header d-flex justify-content-center">
		Your Products
	</div>
	<div class="card-body">
		<div class="row m-4">

			<?php
			$where = "";
			$id = $_SESSION['login_id'];
			$cat = $conn->query("SELECT * FROM products where user_id = '$id'");
			if($cat->num_rows <= 0){
				echo "<center><h4><i>You have no product. Create Product <a href='index.php?page=create_prod'>here.</a></i></h4></center>";
			} 
			while($row=$cat->fetch_assoc()):
				?>
				<div class="col-md-4">
					<div class="card">
						<div class="position-absolute m-2">
							<a href="javascript:void(0)"class="delete" type="button" data-id="<?php echo $row['id'] ?>"> 
								
								<i class='fa fa-trash' style='color: blue;'></i>
							</a>
						</div>
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
							<button class="btn btn-primary btn-sm w-100 edit_prod" type="button" data-id="<?php echo $row['id'] ?>"> Edit</button>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('.edit_prod').click(function() {
		location.href = "index.php?page=create_prod&id=" + $(this).attr('data-id')
	});
	function delete_product($id) {
		$.ajax({
			url: 'admin/functions/ajax.php?action=delete_product',
			method: 'POST',
			data: {
				id: $id
			},
			success: function(resp) {
				if (resp == 1) {
					const Toast = Swal.mixin({
						toast: true,
						position: 'center',
						showConfirmButton: false,
						timer: 1500,
						timerProgressBar: true,

					})

					Toast.fire({
						icon: 'success',
						title: 'Deleted!'
					})
					setTimeout(function() {
						window.location.reload();
					}, 1500);

				}
			}
		})
	}

	$('.delete').on("click", function(){
		console.log($(this).data('id'))

		_conf("Are you sure to delete this product?", "delete_product", [$(this).attr('data-id')])




		/*
		
		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed == true) {
				Swal.fire(
					'Deleted!',
					'Your Product has been deleted.',
					'success'
					)
				setTimeout(function() {
					window.location='admin/functions/ajax.php?action=delete_product'
				}, 1000);

			}else if(resp == 1){
				console.log(resp)
			}
		})*/
	})
</script>