
<?php
include 'db_con.php';  
$id = $_SESSION['login_id'];
$query = "select * from users where id = '$id' limit 1";

$result = mysqli_query($conn,$query);
if($result && mysqli_num_rows($result) > 0)
{

	$user_data = mysqli_fetch_assoc($result);
	return $user_data;
}

?>


