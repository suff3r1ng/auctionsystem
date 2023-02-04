<?php
include('functions/db_con.php');


?>
<?php if (isset($_SESSION['login_id'])) : ?>


	<div class="pagetitle">


		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>

				<li class="breadcrumb-item">Available Items</li>

			</ol>
		</nav>
	</div End Page Title -->

	<div class="card row g-3">
		<div class="card-title text-center">List of Available Items</div>
		<table class="table table-condensed table-hover">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Img</th>
					<th class="text-center">Category</th>
					<th class="text-center">Product</th>
					<th class="text-center">Other Info</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 1;
				$cat = array();
				$cat[] = '';
				$qry = $conn->query("SELECT * FROM categories ");
				while ($row = $qry->fetch_assoc()) {
					$cat[$row['id']] = $row['name'];
				}
				$products = $conn->query("SELECT * FROM products order by name asc ");
				while ($row = $products->fetch_assoc()) :
					$get = $conn->query("SELECT * FROM bids where product_id = {$row['id']} order by bid_amount desc limit 1 ");
					$bid = $get->num_rows > 0 ? $get->fetch_array()['bid_amount'] : 0;
					$tbid = $conn->query("SELECT distinct(user_id) FROM bids where product_id = {$row['id']} ")->num_rows;
				?>
					<tr data-id='<?php echo $row['id'] ?>'>
						<td class="text-center"><?php echo $i++ ?></td>
						<td class="text-center">
							<div class="row justify-content-center" style="height: 100px; width: 100px;">
								<img src="<?php echo 'uploads/' . $row['img_fname'] ?>" alt="">
							</div>
						</td>
						<td>
							<p> <b><?php echo ucwords($cat[$row['category_id']]) ?></b></p>
						</td>
						<td class="">
							<p>Name: <b><?php echo ucwords($row['name']) ?></b></p>
							<p><small>Description: <b><?php echo $row['description'] ?></b></small></p>
						</td>
						<td>
							<p><small>Regular Price: <b><?php echo number_format($row['regular_price'], 2) ?></b></small></p>
							<p><small>Start Price: <b><?php echo number_format($row['start_bid'], 2) ?></b></small></p>
							<p><small>End Date/Time: <b><?php echo date("M d,Y h:i A", strtotime($row['bid_end_datetime'])) ?></b></small></p>
							<p><small>Highest Bid: <b class="highest_bid"><?php echo number_format($bid, 2) ?></b></small></p>
							<p><small>Total Bids: <b class="total_bid"><?php echo $tbid ?> user/s</b></small></p>
						</td>
						<td class="text-center col-sm-2">
							<button class="btn btn-sm btn-outline-primary edit_product" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-pen"></i></button>

							<button class="btn btn-sm btn-outline-danger delete_product" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash"></i></button>
						</td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>

	<style>
		td {
			vertical-align: middle !important;
		}

		td p {
			margin: unset
		}

		table td img {
			max-width: 100px;
			max-height: :150px;
		}

		img {
			max-width: 100px;
			max-height: :150px;
		}
	</style>
	<script>
		$('.view_product').click(function() {
			uni_modal("product Details", "view_product.php?id=" + $(this).attr('data-id'), 'mid-large')

		})

		$('.edit_product').click(function() {
			location.href = "index.php?page=product_management&id=" + $(this).attr('data-id')

		})
		$('.delete_product').click(function() {
			_conf("Are you sure to delete this product?", "delete_product", [$(this).attr('data-id')])
		})

		function delete_product($id) {
			$.ajax({
				url: 'functions/ajax.php?action=delete_product',
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
						}, 3000);

					}
				}
			})
		}
	</script>

<?php else : ?>
	<?php
	if (getcwd() == dirname(__FILE__)) {
		require('pages-error-403.php');
	}

	?>



<?php endif; ?>