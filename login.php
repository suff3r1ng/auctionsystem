<?php include "admin/functions/db_con.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>

	<div class="container" id="login-page">
		<div class="row justify-content-center">
			<div class=" align-items-center justify-content-center">

				<div class="d-flex justify-content-center py-4">
					<a href="index.php" class="logo d-flex align-items-center w-auto">
						<img src="admin/assets/img/logo.png" alt="">
						<span class="d-none d-lg-block">Online Auction System</span>
					</a>
				</div><!-- End Logo -->

				<div class="card mb-3">

					<div class="card-body">

						<div class="pt-4 pb-2">
							<h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
							<p class="text-center small">Enter your email & password to login</p>
						</div>

						<form action="" id="login-frm">

							<div class="col-12">
								<label for="yourEmail" class="form-label">Email</label>
								<div class="input-group has-validation">
									<span class="input-group-text" id="inputGroupPrepend">@</span>
									<input type="text" name="email" id="email" class="form-control" id="yourEmail" required>
									<div class="invalid-feedback">Please enter your username.</div>
								</div>
							</div>

							<div class="col-12">
								<label for="yourPassword" class="form-label">Password</label>
								<input type="password" name="password" class="form-control" id="yourPassword" required>
								<div class="invalid-feedback">Please enter your password!</div>
							</div>

							<div class="col-12">
								<div class="form-check">
									<!-- <input class="form-check-input" type="checkbox" name="remember" value="lsRememberMe"
										id="rememberMe"> -->
										<input class="form-check-input" type="checkbox" value="lsRememberMe" id="rememberMe"> 
										<label class="form-check-label" for="rememberMe">Remember me</label>
									</div>
								</div>
								<div class="col-12">
									<input type="submit" class="btn btn-primary w-100" name="submit" value="Login" onclick="lsRememberMe()">
								</div>
								<div class="col-12">
									<p class="small mb-0 create">Don't have account?
										<a href="register.php">
											Create an account
										</a>
									</p>
								</div>

							</form>

						</div>
					</div>

				</div>
			</div>
			

			<script>
				

				$('#login-frm').submit(function (e) {
					e.preventDefault()

					if ($(this).find('.alert-danger').length > 0)
						$(this).find('.alert-danger').remove();
					$.ajax({
						url: 'admin/functions/ajax.php?action=login',
						method: 'POST',
						data: $(this).serialize(),
						error: err => {
							console.log(err)
							end_load()

						},
						success: function (resp) {
							if (resp == 1) {
								const Toast = Swal.mixin({
									toast: true,
									position: 'center',
									showConfirmButton: false,
								})
								Toast.fire({
									icon: 'success',
									title: 'Signed in successfully'
								});
								setTimeout(function () {
									location.href = '<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'admin/index.php' ?>';
								}, 1000);

							} else if (resp == 2) {
								console.log(resp)
								const Toast = Swal.mixin({
									toast: true,
									position: 'center',
									showConfirmButton: false,

								})
								Toast.fire({
									icon: 'success',
									title: 'Signed in successfully'
								});
								setTimeout(function () {
									location.href = '<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php' ?>';
								}, 1000);

							} else {
								
								const Toast = Swal.mixin({
									toast: true,
									position: 'center',
									showConfirmButton: false,
									timer: 1500

								})
								Toast.fire({
									icon: 'error',
									title: 'Wrong Email or Password'
								});
							}
						}
					})
				})
				const rmCheck = document.getElementById("rememberMe"),
				emailInput = document.getElementById("email");

				if (localStorage.checkbox && localStorage.checkbox !== "") {
					rmCheck.setAttribute("checked", "checked");
					emailInput.value = localStorage.username;
				} else {
					rmCheck.removeAttribute("checked");
					emailInput.value = "";
				}

				function lsRememberMe() {
					if (rmCheck.checked && emailInput.value !== "") {
						localStorage.username = emailInput.value;
						localStorage.checkbox = rmCheck.value;
					} else {
						localStorage.username = "";
						localStorage.checkbox = "";
					}
				}
			</script>
		</div>
	</body>

	</html>