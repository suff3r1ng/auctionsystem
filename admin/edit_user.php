<?php 
include('functions/db_con.php');
session_start();
if(isset($_GET['id'])){
	$user = $conn->query("SELECT * FROM users where id =".$_GET['id']);
	foreach($user->fetch_array() as $k =>$v){
		$meta[$k] = $v;
	}
}
?>
<div class="container-fluid">
	<div id="msg"></div>
	
	<form action="" id="manage-user">	
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" name="name" id="name" class="form-control" value="<?php echo isset($meta['name']) ? $meta['name']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" name="email" id="email" class="form-control" value="<?php echo isset($meta['email']) ? $meta['email']: '' ?>" required >
		</div>
		<div class="form-group">
			<label for="contact">Contact Number</label>
			<input type="text" name="contact" id="contact" class="form-control" value="<?php echo isset($meta['contact']) ? $meta['contact']: '' ?>" required >
		</div>
		<div class="form-group">
			<label for="address">Address</label>
			<input type="text" name="address" id="address" class="form-control" value="<?php echo isset($meta['address']) ? $meta['address']: '' ?>" required  >
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
			<?php if(isset($meta['id'])): ?>
				<small><i>Leave this blank if you dont want to change the password.</i></small>
			<?php endif; ?>
		</div>
		<?php if(isset($meta['type']) && $meta['type'] == 3): ?>
			<input type="hidden" name="type" value="3">
			<?php else: ?>
				<?php if(!isset($_GET['mtype'])): ?>
					<div class="form-group">
						<label for="type">User Type</label>
						<select name="type" id="type" class="custom-select">
							<option value="2" <?php echo isset($meta['type']) && $meta['type'] == 2 ? 'selected': '' ?>>Staff</option>
							<option value="1" <?php echo isset($meta['type']) && $meta['type'] == 1 ? 'selected': '' ?>>Admin</option>
						</select>
					</div>
				<?php endif; ?>
			<?php endif; ?>
			<div class="col-12 m-2 p-1">
				<input type="submit" class="btn btn-primary w-100" name="submit" value="save">
			</div>

		</form>
	</div>
	<script>

		$('#manage-user').submit(function(e){
			e.preventDefault();
			
			$.ajax({
				url:'functions/ajax.php?action=save_user',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log()
					alert("faiL?")
				},
				success:function(resp){
					if(resp==1){
						const Toast = Swal.mixin({
							toast: true,
							position: 'center',
							showConfirmButton: false,
							timer: 3000,
							timerProgressBar: true,
						})

						Toast.fire({
							icon: 'success',
							title: 'Registered!'
						})
						setTimeout(function(){
							window.location.reload();
						}, 3000);
					}if (resp==2){
						console.log(resp)
						const Toast = Swal.mixin({
							toast: true,
							position: 'center',
							showConfirmButton: false,
							timer: 3000,
							timerProgressBar: true,
						})

						Toast.fire({
							icon: 'success',
							title: 'Account Updated!'
						})
						setTimeout(function(){
							window.location.reload();
						}, 3000);

					}
					if (resp==3){
						console.log(resp)
						Swal.fire({
							icon: 'error',
							title: 'Username Already Exist',
						})
						
					}
				}
			})
		})

	</script>