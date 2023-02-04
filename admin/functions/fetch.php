<?php
include('db_con.php');
if(isset($_POST['view'])){

if($_POST["view"] != '')
{
   $update_query = "UPDATE products SET alert_stat = 1 WHERE alert_stat=0";
   mysqli_query($conn, $update_query);
}
$query = "SELECT * FROM products ORDER BY id DESC LIMIT 5";
$result = mysqli_query($conn, $query);

$status_query = "SELECT * FROM products WHERE alert_stat=0";
$result_query = mysqli_query($conn, $status_query);
$count = mysqli_num_rows($result_query);
$data = array(

   'unseen_notification'  => $count
);
echo json_encode($data);
}
?>