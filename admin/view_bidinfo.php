<?php include 'functions/db_con.php' ?>
<?php
if(isset($_GET['id'])){
$qry = $conn->query("SELECT * FROM users where id= ".$_GET['id']);
foreach($qry->fetch_array() as $k => $val){
	$$k=$val;
}
}
?>
<style type="text/css">
	
	.avatar {
	    max-width: calc(100%);
	    max-height: 27vh;
	    align-items: center;
	    justify-content: center;
	    padding: 5px;
	}
	.avatar img {
	    max-width: calc(100%);
	    max-height: 27vh;
	}
	p{
		margin:unset;
	}
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: block
	}
</style>
<div class="container-field">
	<div class="position-absolute" >
		<img style="width: 180px; height: 125px; margin-left: 75px; margin-top: 9px;"src="<?php echo "../$img" ?>" alt="img">
	</div>
	<div class="col m-3">
		<div class="d-flex flex-row-reverse">
			<div class="col-md-6">
				<p>Name: <b><?php echo $name ?></b></p>
				<p>Email: <b><?php echo $email ?></b></p>
				<p>Contact: <b><?php echo $contact ?></b></p>
				<p>Address: <b><?php echo $address ?></b></p>
			</div>
		</div>
	</div>
</div>
<div class="modal-footer display">
	<div class="row">
		<div class="col-lg-12">
			<button class="btn float-right btn-secondary w-100 m-3" type="button" data-bs-dismiss="modal">Close</button>
		</div>
	</div>
</div>
<script>
	
</script>
