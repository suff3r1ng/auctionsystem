<?php include 'admin/functions/db_con.php' ?>

<?php
session_start();
include 'admin/functions/get.php';

?>
<?php if(isset($_GET['id']))
$prod = $_GET['id'];
$qry = $conn->query("SELECT * from products Where id = '$prod'");
$name = $qry->fetch_assoc();

$bids = $conn->query("SELECT * from bids");
?>
<?php if($bids->num_rows <= 0): ?>
	<?php echo "<h1 class='text-center'><b>No Biddings</b></h1>"; ?>
	<?php else : ?>
		<h4 class="text-center">Bid Lists of <?php echo  ucwords($name['name'])?></h2>
			<div class="card">
				<div class="card-header">
					<table class="table table-condensed table-hover">
						<thead>
							<tr>

								<th class="text-center">#</th>
								<th class="">Name</th>
								<th class="">Amount</th>
								<th class="">Status</th>
								<th class="">Details</th>	
							</tr>
						</thead>
						<?php $prod = $_GET['id'];
						$i = 1;
						$cat = array();
						$cat[] = '';
						$books = $conn->query("SELECT b.*, u.name as uname,p.name,p.bid_end_datetime bdt FROM bids b inner join users u on u.id = b.user_id inner join products p on p.id = b.product_id where product_id = '$prod'");
						while ($row = $books->fetch_assoc()) :
							$get = $conn->query("SELECT * FROM bids where product_id = {$row['product_id']} order by bid_amount desc limit 1 ");
							$uid = $get->num_rows > 0 ? $get->fetch_array()['user_id'] : 0;


							?>

							<tr>
								

								<td class="text-center">
									<?php echo $i++ ?>
								</td>
								<td class="">
									<p> <b>

										<?php echo ucwords($row['uname']) ?>
									</b></p>
								</td>
								<td class="text-right">
									<p> <b>
										<?php echo number_format($row['bid_amount'], 2) ?>
									</b></p>
								</td>
								<td class="text-center">
									<?php if ($row['status'] == 1) : ?>
										<?php if (strtotime(date('Y-m-d H:i')) < strtotime($row['bdt'])) : ?>
										<span class="badge bg-secondary">Bidding Stage</span>
										<?php else : ?>
											<?php if ($uid == $row['user_id']) : ?>
												<span class="badge bg-success">Wins in Bidding</span>
												<?php else : ?>
													<span class="badge bg-secondary">Lost in Bidding</span>
												<?php endif; ?>
											<?php endif; ?>
											<?php elseif ($row['status'] == 2) : ?>
												<span class="badge bg-primary">Confirmed</span>
												<?php else : ?>
													<span class="bg badge-danger">Canceled</span>
												<?php endif; ?>
											</td>
											<td class="text-center" >
												<a class="info" data-id="<?php echo($row['user_id']) ?>" href="javascript:void(0)"><i class="fa fa-info-circle" aria-hidden="true" style="color: blue;"></i>
												</a>
											</td>
										<?php endwhile; ?>
									</tr>
								</table>
							</div>
						</div>
					<?php endif ; ?>

					<script type="text/javascript">
						$(".info").click(function(){
							uni_modal ("Details of Bid", "view_bid.php?id=" + $(this).attr('data-id'));
						
						})
					</script>