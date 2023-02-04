<?php if (isset($_SESSION['login_id'])) : ?>

	<div class="pagetitle">

<h1>List of Accounts</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item">Manage Users</li>
			</ol>
		</nav>
	</div End Page Title -->

	<div class="card row g-3">
		<table class="table table-borderless datatable table-hover">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Name</th>
					<th class="text-center">Username</th>
					<th class="text-center">Email</th>
					<th class="text-center">Type</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				include 'functions/db_con.php';
				$type = array("", "Admin", "User", "Alumnus/Alumna");
				$users = $conn->query("SELECT * FROM users order by name asc");
				$i = 1;
				while ($row = $users->fetch_assoc()) :
				?>
					<tr>
						<td class="text-center col-sm m-2">
							<?php echo $i++ ?>
						</td>
						<td class="text-center col-sm m-2">
							<?php echo ucwords($row['name']) ?>
						</td>

						<td class="text-center">
							<?php echo $row['username'] ?>
						</td>
						<td class="text-center col-sm m-2">
							<?php echo $row['email'] ?>
						</td>
						<td class="text-center text-center col-sm m-2 ">
							<?php echo $type[$row['type']] ?>
						</td>
						<td class="text-center col-sm-2">

							<button class="btn btn-outline-primary edit_user" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'><i class="fa fa-pen"></i></button>

							<button class="btn btn-outline-danger delete_user" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'><i class="fa fa-trash"></i></button>


							<!-- <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<span class="sr-only">Toggle Dropdown</span>
												</button>
												<div class="dropdown-menu">
													<a class="dropdown-item edit_user" href="#" data-id = '<?php echo $row['id'] ?>'>Edit</a>
													<div class="dropdown-divider"></div>
													<a class="dropdown-item delete_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Delete</a>
												</div> -->

						</td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>

	</div>


	<script>
		$('#new_user').click(function() {
			uni_modal('New User', 'edit_user.php')
		});
		$('.edit_user').click(function() {
			uni_modal('Edit User', 'edit_user.php?id=' + $(this).attr('data-id'))
		})

		$('.delete_user').click(function() {
			_conf("Are you sure to delete this user?", "delete_user", [$(this).attr('data-id')])
		})

		function delete_user($id) {
			$.ajax({
				url: 'functions/ajax.php?action=delete_user',
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
							title: 'Successfully Deleted!'
						})
						setTimeout(function() {
							location.reload()
						}, 1500)

					}
				}
			})
		}
	</script>

<?php else : ?>


	<?php if (getcwd() == dirname(__FILE__)) {
		require('pages-error-403.php');
	} ?>

<?php endif; ?>