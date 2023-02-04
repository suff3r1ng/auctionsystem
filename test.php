<?php 
$arr1 = array ('2018-01-01', '2018-02-04', '2018-02-15', '2018-04-06', '2018-04-12', '2018-04-19', '2018-04-27', '2018-07-08', '2018-08-12', '2018-08-11', '2018-08-21', '2018-10-12', '2018-10-13', '2018-10-14', '2018-10-15', '2018-11-06', '2018-12-12', '2018-12-28');
$arr2 = array(4, 2, 3, 2, 2, 9, 7, 8, 12, 21, 1, 2, 13, 4, 15, 6, 2, 8);


$count1 = count($arr1);
$count2 = count($arr2);

$new_arr = array();
while($count1 > 0 and $count2 > 0){
    $count1--;
    $count2--;
    $data = $arr2[$count2];
    $month = $arr1[$count1];
    $month = explode("-", $month);
    $month = $month[1];
    $new_arr[] = ['month' => $month, 'data' => $data];
}
print_r($new_arr)
?>