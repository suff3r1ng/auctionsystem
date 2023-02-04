<?php include 'functions/db_con.php' ;

$path = $_SERVER['QUERY_STRING'];
?>
<?php if ($path == ("page=create-category")) {
	unset($id);
}else{
	isset($id);
}
?>
<?php
if (isset($_SESSION['login_id'])) : ?>
	<?php
	$login_id = $_SESSION['login_id'];
	if (isset($_GET['id'])) {
		$qry = $conn->query("SELECT * FROM products where id= " . $_GET['id']);
		foreach ($qry->fetch_array() as $k => $val) {
			$$k = $val;
		}
	}
	?>

	<style>
		.jqte_editor {
			min-height: 30vh !important
		}

		#drop {
			min-height: 15vh;
			max-height: 30vh;
			overflow: auto;
			width: calc(100%);
			border: 5px solid #929292;
			margin: 10px;
			border-style: dashed;
			padding: 10px;
			display: flex;
			align-items: center;
			flex-wrap: wrap;
		}

		#uploads {
			min-height: 15vh;
			width: calc(100%);
			margin: 10px;
			padding: 10px;
			display: flex;
			align-items: center;
			flex-wrap: wrap;
		}

		#uploads .img-holder {
			position: relative;
			margin: 1em;
			cursor: pointer;
		}

		#uploads .img-holder:hover {
			background: #0095ff1f;
		}

		#uploads .img-holder .form-check {
			display: none;
		}

		#uploads .img-holder.checked .form-check {
			display: block;
		}

		#uploads .img-holder.checked {
			background: #0095ff1f;
		}

		#uploads .img-holder img {
			height: 39vh;
			width: 22vw;
			margin: .5em;
		}

		#uploads .img-holder span {
			position: absolute;
			top: -.5em;
			left: -.5em;
		}

		#dname {
			margin: auto
		}

		img.imgDropped {
			height: 16vh;
			width: 7vw;
			margin: 1em;
		}

		.imgF {
			border: 1px solid #0000ffa1;
			border-style: dashed;
			position: relative;
			margin: 1em;
		}

		span.rem.badge.badge-primary {
			position: absolute;
			top: -.5em;
			left: -.5em;
			cursor: pointer;
		}

		label[for="chooseFile"] {
			color: #0000ff94;
			cursor: pointer;
		}

		label[for="chooseFile"]:hover {
			color: #0000ffba;
		}

		.opts {
			position: absolute;
			top: 0;
			right: 0;
			background: #00000094;
			width: calc(100%);
			height: calc(100%);
			justify-items: center;
			display: flex;
			opacity: 0;
			transition: all .5s ease;
		}

		.img-holder:hover .opts {
			opacity: 1;

		}

		input[type=checkbox] {
			/* Double-sized Checkboxes */
			-ms-transform: scale(1.5);
			/* IE */
			-moz-transform: scale(1.5);
			/* FF */
			-webkit-transform: scale(1.5);
			/* Safari and Chrome */
			-o-transform: scale(1.5);
			/* Opera */
			transform: scale(1.5);
			padding: 10px;
		}

		button.btn.btn-sm.btn-rounded.btn-sm.btn-dark {
			margin: auto;
		}

		img#img_path-field {
			max-height: 15vh;
			max-width: 8vw;
		}
	</style>
	<?php echo("<script>console.log('PHP: " . $id . "');</script>"); ?>
	<div class="container-fluid text-center d-flex justify-content-center" id="create_pro">

		<div class="col-lg-12">

			<form action="" id="manage-product">
				<form action="" id="manage-product" class="card">
					<input type="hidden" name="id"value="<?php  echo isset($id) ? $id : '' ?>">
					

					<input type="hidden" name="user_id" value="<?php echo "$login_id"?>">

					<h2 class="m-3">
						<b><?php if ($path == ("page=create-category")) {
							echo 'New Product';
						} else {
							echo 'Manage Product';
						} ?>

					</b>
				</h2>
				<div class="container-fluid">
					<div class="row d-flex justify-content-center">
						<div class="col-md-5">
							<label for="" class="control-label">Product Image</label>
							<input type="file" class="form-control" name="img" onchange="displayImg2(this,$(this))">
						</div>
						<script type="text/javascript">
							function displayImg2(input, _this) {
								if (input.files && input.files[0]) {
									var reader = new FileReader();
									reader.onload = function(e) {
										$('#img_path-field').attr('src', e.target.result);
									}

									reader.readAsDataURL(input.files[0]);
								}
							}
						</script>
						<div class="col-md-5">
							<label for="" class="control-label ">Product Preview</label>
							<div class="container justify-conten-center">
								<img src="<?php echo isset($img_fname) ? 'uploads/' . $img_fname : '' ?>" alt="" id="img_path-field">
							</div>
						</div>
					</div>

					<div class="row d-flex justify-content-center">
						<!-- name -->
						<div class="col-md-4 h-25 m-3  ">
							<div class="col m-2 justify-content-md-center">
								<label for="" class="control-label m-2">Name</label>
								<input type="text" class="form-control w-100" name="name" value="<?php echo isset($name) ? $name : '' ?>" required>
							</div>
						</div>
						<!-- end name -->
						<div class="col-md-4 h-10 m-3 ">
							<div class="col m-2 justify-content-md-center">

							</div>
							<label for="" class="control-label m-2">Category</label>
							<div class="col-md-4 w-100">
								<center>
									<select class="form-control form-select" name="category_id">
										<option selected></option>
										<?php
										$qry = $conn->query("SELECT * FROM categories order by name asc");
										while ($row = $qry->fetch_assoc()) :
											?>
											<option value="<?php echo $row['id'] ?>" <?php echo isset($category_id) && $category_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
										<?php endwhile; ?>
									</select>

								</center>
							</div>

						</div>


					</div>

					<div class="form-group row">
						<div class="col-md m-3">
							<label for="" class="control-label">Description</label>
							<textarea name="description" id="description" class="form-control m-2" cols="30" rows="5" required><?php echo isset($description) ? html_entity_decode($description) : '' ?></textarea>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-md-5 m-2">
							<label for="" class="control-label m-1">Regular Price</label>
							<input type="number" class="form-control text-right" name="regular_price" value="<?php echo isset($regular_price) ? $regular_price : 0 ?>">
						</div>
						<div class="col md-5 m-2">
							<label for="" class="control-label m-1">Starting Bidding Amount</label>
							<input type="number" class="form-control text-right" name="start_bid" value="<?php echo isset($start_bid) ? $start_bid : 0 ?>">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-5 m-2">
							<label for="" class="control-label">Bidding End Date/Time</label>
							<input type="text" class="form-control datetimepicker" name="bid_end_datetime" value="<?php echo isset($bid_end_datetime) && strtotime($bid_end_datetime) > 0 ? date("Y-m-d H:i", strtotime($bid_end_datetime)) : '' ?>">
						</div>
					</div>

					<div class="row">
						<div class="col m-5">
							<button class="btn btn-primary w-100"> Save</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div class="imgF" style="display: none " id="img-clone">
		<span class="rem badge badge-primary" onclick="rem_func($(this))"><i class="fa fa-times"></i></span>
	</div>
	<script>
		window.onload = function() {

			$('#payment_status').on('change keypress keyup', function() {
				if ($(this).prop('checked') == true) {
					$('#amount').closest('.form-group').hide()
				} else {
					$('#amount').closest('.form-group').show()
				}
			})
			$('.jqte').jqte();
			// updating the view with notifications using ajax
			function load_unseen_notification(view = '') {
				$.ajax({
					url: "functions/fetch.php",
					method: "POST",
					data: {
						view: view
					},
					dataType: "json",
					success: function(data) {
						$('.available').html(data.notification);
						if (data.unseen_notification > 0) {
							$('.count').html(data.unseen_notification);
						}
					}
				});
			}

			load_unseen_notification();
			$('#manage-product').submit(function(e) {
				e.preventDefault()

				$('#msg').html('')
				$.ajax({
					url: 'functions/ajax.php?action=save_product',
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
								title: 'Saved!'
							})
							setTimeout(function() {
								window.location(history.go(-1));
							}, 3000);
						} else if (resp == 2) {
							const Toast = Swal.mixin({
								toast: true,
								position: 'center',
								showConfirmButton: false,
								timer: 3000,
								timerProgressBar: true,

							})

							Toast.fire({
								icon: 'success',
								title: 'Saved!'
							})
							setTimeout(function() {
								window.location(history.go(-1));
							}, 3000);
						}
					}
				})
			})
			if (window.FileReader) {
				var drop;
				addproductHandler(window, 'load', function() {
					var status = document.getElementById('status');
					drop = document.getElementById('drop');
					var dname = document.getElementById('dname');
					var list = document.getElementById('list');

					function cancel(e) {
						if (e.preventDefault) {
							e.preventDefault();
						}
						return false;
					}

					// Tells the browser that we *can* drop on this target
					addproductHandler(drop, 'dragover', cancel);
					addproductHandler(drop, 'dragenter', cancel);

					addproductHandler(drop, 'drop', function(e) {
						e = e || window.product; // get window.product if e argument missing (in IE)   
						if (e.preventDefault) {
							e.preventDefault();
						} // stops the browser from redirecting off to the image.
						$('#dname').remove();
						var dt = e.dataTransfer;
						var files = dt.files;
						for (var i = 0; i < files.length; i++) {
							var file = files[i];
							var reader = new FileReader();

							//attach product handlers here...

							reader.readAsDataURL(file);
							addproductHandler(reader, 'loadend', function(e, file) {
								var bin = this.result;
								var imgF = document.getElementById('img-clone');
								imgF = imgF.cloneNode(true);
								imgF.removeAttribute('id')
								imgF.removeAttribute('style')

								var img = document.createElement("img");
								var fileinput = document.createElement("input");
								var fileinputName = document.createElement("input");
								fileinput.setAttribute('type', 'hidden')
								fileinputName.setAttribute('type', 'hidden')
								fileinput.setAttribute('name', 'img[]')
								fileinputName.setAttribute('name', 'imgName[]')
								fileinput.value = bin
								fileinputName.value = file.name
								img.classList.add("imgDropped")
								img.file = file;
								img.src = bin;
								imgF.appendChild(fileinput);
								imgF.appendChild(fileinputName);
								imgF.appendChild(img);
								drop.appendChild(imgF)
							}.bindToproductHandler(file));
						}
						return false;

					});

					Function.prototype.bindToproductHandler = function bindToproductHandler() {
						var handler = this;
						var boundParameters = Array.prototype.slice.call(arguments);
						return function(e) {
							e = e || window.product; // get window.product if e argument missing (in IE)   
							boundParameters.unshift(e);
							handler.apply(this, boundParameters);
						}
					};
				});
			} else {
				document.getElementById('status').innerHTML = 'Your browser does not support the HTML5 FileReader.';
			}

			function addproductHandler(obj, evt, handler) {
				if (obj.addproductListener) {
					// W3C method
					obj.addproductListener(evt, handler, false);
				} else if (obj.attachproduct) {
					// IE method.
					obj.attachproduct('on' + evt, handler);
				} else {
					// Old school method.
					obj['on' + evt] = handler;
				}
			}

			function displayIMG(input) {

				if (input.files) {
					if ($('#dname').length > 0)
						$('#dname').remove();

					Object.keys(input.files).map(function(k) {
						var reader = new FileReader();
						reader.onload = function(e) {
							// $('#cimg').attr('src', e.target.result);
							var bin = e.target.result;
							var fname = input.files[k].name;
							var imgF = document.getElementById('img-clone');
							imgF = imgF.cloneNode(true);
							imgF.removeAttribute('id')
							imgF.removeAttribute('style')
							var img = document.createElement("img");
							var fileinput = document.createElement("input");
							var fileinputName = document.createElement("input");
							fileinput.setAttribute('type', 'hidden')
							fileinputName.setAttribute('type', 'hidden')
							fileinput.setAttribute('name', 'img[]')
							fileinputName.setAttribute('name', 'imgName[]')
							fileinput.value = bin
							fileinputName.value = fname
							img.classList.add("imgDropped")
							img.src = bin;
							imgF.appendChild(fileinput);
							imgF.appendChild(fileinputName);
							imgF.appendChild(img);
							drop.appendChild(imgF)
						}
						reader.readAsDataURL(input.files[k]);
					})

					rem_func()

				}
			}

			function rem_func(_this) {
				_this.closest('.imgF').remove()
				if ($('#drop .imgF').length <= 0) {
					$('#drop').append('<span id="dname" class="text-center">Drop Files Here</label></span>')
				}
			}

		};
	</script>
</div>
<?php else : ?>


	<?php
	if (getcwd() == dirname(__FILE__)) {
		require('pages-error-403.php');
	}

	?>

	<?php endif; ?>