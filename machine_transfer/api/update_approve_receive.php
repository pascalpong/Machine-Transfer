<?php
session_start();

require_once '../../classes/Connect.php';
$conn = new Connect();
$approve_person = $_SESSION['username'];

$tx_id = $_POST['tx_id'];


/////////////////////////SELECT ALL WAITS 

$get_waits = " SELECT mc_code FROM machine_tx_history WHERE tx_id = '$tx_id' AND transfer_status = 'WAIT' ";
$rs_waits = $conn->query($get_waits);
while($row_waits = $conn->parseArray($rs_waits)){
$all_waits .= "'".$row_waits['mc_code']."',";
	}
$all_waits = substr($all_waits, 0,-1);
$where_mc_change = "AND mc_code IN (".$all_waits.")";




$change_stat = " SELECT * FROM machine_tx_history WHERE tx_id = '$tx_id' AND transfer_status = 'ORIGINAL' $where_mc_change ";
// echo $change_stat;
// exit();
$rsChangeStat = $conn->query($change_stat);
while($rowchange_stat = $conn->parseArray($rsChangeStat)){

$sqlq = "UPDATE machine_tx_history SET transfer_status = 'MOVED' WHERE id = '{$rowchange_stat['id']}' AND tx_id = '$tx_id' ";
// echo $sqlq ; 
$rsq = $conn->query($sqlq);


// $updateMachine = " UPDATE machine SET machine_dept = '{$rowchange_stat['mc_dept']}' , machine_location = '{$rowchange_stat['mc_location']}' , factory = '{$rowchange_stat['factory']}' , machine_room = '{$rowchange_stat['mc_room']}' WHERE code = '{$rowchange_stat['mc_code']}' ";
// echo $updateMachine; 
// $conn->query($updateMachine);

}


$sql = "UPDATE machine_tx_history SET transfer_status = 'ACTIVE' WHERE transfer_status = 'WAIT' AND tx_id = '$tx_id' ";
$rs = $conn->query($sql);





echo $rs;
 
?>
