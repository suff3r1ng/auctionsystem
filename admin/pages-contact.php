

<?php
include 'functions/db_con.php';
$qry = $conn->query("SELECT * from system_settings limit 1");
if($qry->num_rows > 0){
	foreach($qry->fetch_array() as $k => $val){
		$meta[$k] = $val;
	}
}

$login_id = $_SESSION['login_id'];
if (isset($_SESSION['login_id'])) {
	$qry = $conn->query("SELECT * FROM users where id= " . $login_id);
	foreach ($qry->fetch_array() as $k => $val) {
		$$k = $val;
	}
}
?>
<nav>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item active">Contact</li>
	</ol>
</nav>

<div class="container">
	<div class="row justify-content-center">
		<div class=" align-items-center justify-content-center">

			<div class="d-flex justify-content-center py-4">
				<a href="index.php" class="logo d-flex align-items-center w-auto">
					<img src="admin/assets/img/logo.png" alt="">
					<span class="d-none d-lg-block">Online Auction System</span>
				</a>
			</div>
			<div class="card col-lg-12">
				<div class="card-body">
					<form action="" id="manage-settings">
						<input type="hidden" name="user_id" value="<?php echo "$login_id" ?>">
						<div class="card-header form-group">
							Online Auction System
						</div>
						<div class="form-group">
							<label for="email" class="control-label">Email</label>
							<input type="email" class="form-control" id="email" name="email" value="<?php echo isset($emai) ? $email : '' ?>" required>
						</div>
						<div class="form-group">
							<label for="contact" class="control-label">Contact</label>
							<input type="text" class="form-control" id="contact" name="contact" value="<?php echo isset($contact) ? $contact : '' ?>" required>
						</div>
						<div class="form-group">
							<label for="about" class="control-label">About Content</label>
							<textarea name="about_content" class="text-jqte">Type Your Problems here. If you have any suggestions feel free to fill up this form this form and submit, this way we can reach you out.</textarea>

						</div>
						<div class="form-group">
							<label for="" class="control-label">Screen shot of your problem</label>
							<input type="file" class="form-control" name="img" onchange="displayImg(this,$(this))">
						</div>
						<div class="form-group">
							<img src="<?php echo isset($meta['cover_img']) ? 'assets/uploads/'.$meta['cover_img'] :'' ?>" alt="" id="cimg">
						</div>
						<center>
							<button class="btn btn-primary btn-primary btn-block col-md-2">Save</button>
						</center>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	img#cimg{
		max-height: 10vh;
		max-width: 6vw;
	}
</style>

<script>
	function displayImg(input,_this) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#cimg').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}
	$('.text-jqte').jqte();

	$('#manage-settings').submit(function(e){
		e.preventDefault()
		$.ajax({
			url:'admin/functions/ajax.php?action=save_settings',
			data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			error:err=>{
				console.log(err)
			},
			success:function(resp){
				console.log(resp);
				if(resp == 1){
					console.log(resp)
					const Toast = Swal.mixin({
						toast: true,
						position: 'center',
						showConfirmButton: false,
					})
					Toast.fire({
						icon: 'success',
						title: 'Your form has been submitted!'
					});
					setTimeout(function () {
						location.href = 'index.php';
					}, 1000);
				}else{
					console.log(resp)
					const Toast = Swal.mixin({
						toast: true,
						position: 'center',
						showConfirmButton: false,
					})
					Toast.fire({
						icon: 'error',
						title: 'An Error Occurred!'
					});

				}
			}
		})

	})
</script>




