<?php include('functions/db_con.php'); ?>
<?php if (isset($_SESSION['login_id'])) : ?>
	<div class="pagetitle">
<h1>Product & Category</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php?page=pages-home">Home</a></li>
				<li class="breadcrumb-item">Create</li>
				<li class="breadcrumb-item active">Category</li>
			</ol>
		</nav>
	</div><!-- End Page Title -->


	<div class="container-fluid text-center">
		<div class="col-lg-12">
			<div class="row">

				<div class="col-md-12">
					<div class="row">
						<!-- top -->
						<div class="row d-flex justify-content-center">
							<!-- FORM Panel -->
							<div class="col-md-5 h-10 m-3 ">
								<form action="" id="manage-category">
									<div class="card">
										<div class="card-title">
											<b>Manage Category Form</b>
										</div>
										<div class="card-body">
											<input type="hidden" name="id">
											<div class="form-group">
												<label class="control-label">Name</label>
												<input type="text" required="required" class="form-control" name="name">
											</div>
										</div>

										<div class="card-footer">
											<div class="row">
												<div class="col" style="width: 200px;">
													<button class="btn btn-sm btn-primary col-sm-3 offset-md-3">Save</button>
													<button class="btn btn-sm btn-default col-sm-3 " type="button" onclick="$('#manage-category').get(0).reset()">Cancel</button>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
							<!-- FORM Panel -->

							<!-- Product form panel -->
							<div class="col-md-4 h-20 m-3">
								<div class="card">
									<div class="card-body">
										<div class="card-title">
											<b>Create Product Entry</b>
										</div>
										<span class="col-sm-3">
											<a class="btn btn-primary  justify-content-center create_pro">
												<i class="fa fa-plus w-1 m-1"></i> New Entry
											</a>
										</span>

									</div>
								</div>
							</div>
						</div>
						<div style="display: none;">
							<?php include "product_management.php" ?>
						</div>

						<!-- Table Panel -->
						<div class="col-md-12" style="margin: 5px; padding: 20px;">
							<div class="card">
								<div class="card-title">
									<b>Category Lists</b>
								</div>
								<div class="card-body">
									<table class="table table-borderless datatable table-hover">
										<thead>
											<tr>
												<th class="text-center">#</th>
												<th class="text-center">Category</th>
												<th class="text-center">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$i = 1;
											$category = $conn->query("SELECT * FROM categories order by id asc");
											while ($row = $category->fetch_assoc()) :
											?>
												<tr>
													<td class="text-center"><?php echo $i++ ?></td>
													<td class="">
														<p><b><?php echo $row['name'] ?></b></p>
													</td>
													<td class="text-center">
														<button class="btn btn-sm btn-primary edit_category" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['name'] ?>"><i class="fa fa-pen"></i></button>
														<button class="btn btn-sm btn-danger delete_category" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash"></i></button>
													</td>
												</tr>
											<?php endwhile; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- Table Panel -->
					</div>


				</div>

			</div>


		</div>
	</div>

	<style>
		td {
			vertical-align: middle !important;
		}
	</style>



	<script>
		$('#manage-category').submit(function(e) {
			e.preventDefault()
			$.ajax({
				url: 'functions/ajax.php?action=save_category',
				data: new FormData($(this)[0]),
				cache: false,
				contentType: false,
				processData: false,
				method: 'POST',
				type: 'POST',
				success: function(resp) {
					if (resp == 1) {
						const Toast = Swal.mixin({
							toast: true,
							position: 'center',
							showConfirmButton: false,
							timer: 3000,
							timerProgressBar: true,

						})

						Toast.fire({
							icon: 'success',
							title: 'Successfully Saved!'
						})
						setTimeout(function() {
							window.location.reload();
						}, 3000);

					} else if (resp == 2) {


						Swal.fire({
							icon: 'success',
							showConfirmButton: false,
							title: 'updated!'
						});

					}
				}
			});
		});
		$('.edit_category').click(function() {
			var cat = $('#manage-category')
			cat.get(0).reset()
			cat.find("[name='id']").val($(this).attr('data-id'))
			cat.find("[name='name']").val($(this).attr('data-name'))
			cat.find("[name='description']").val($(this).attr('data-description'))

		})
		$('.delete_category').click(function() {
			_conf("Are you sure to delete this category?", "delete_category", [$(this).attr('data-id')])
		})

		function delete_category($id) {

			$.ajax({
				url: 'functions/ajax.php?action=delete_category',
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
							timer: 3000,
							timerProgressBar: true,

						})

						Toast.fire({
							icon: 'success',
							title: 'Deleted!'
						})
						setTimeout(function() {
							window.location.reload();
						}, 3000);

					} else {
						console.log(resp)
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