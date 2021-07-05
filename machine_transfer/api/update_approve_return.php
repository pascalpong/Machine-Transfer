<?php
session_start();

require_once '../../classes/Connect.php';
$conn = new Connect();

$approve_person = $_SESSION['username'];
$allMcSelected = $_POST['allMcSelected'];

$tx_id = $_POST['tx_id'];
$mc_dept = $_POST['mc_dept'];
$mc_room = $_POST['mc_room'];
$mc_location = $_POST['mc_lcoation'];
$mc_dept = $_POST['mc_dept'];


if($allMcSelected==''||$allMcSelected==null){
	echo '0';
}else{
	for($i=0;$i<count($allMcSelected);$i++){
		$mc_code = $allMcSelected[$i];

		$get_type = " SELECT machine_type FROM machine WHERE code = '$mc_code' ";
		$rs_get_type = $conn->query($get_type);
		$row_get_type = $conn->parseArray($rs_get_type);

		$mc_type = $row_get_type['machine_type'];

		$get_lending_fac = " SELECT lending_factory FROM machine_tx WHERE tx_id = '$tx_id' ";
		$rs_lending_fac = $conn->query($get_lending_fac);
		$row_lending_fac = $conn->parseArray($rs_lending_fac);

		$factory = $row_lending_fac['lending_factory'];

		$insert = " INSERT INTO machine_tx_history (mc_code,mc_dept,mc_type,factory,mc_room,mc_location,transfer_status,tx_id,transfer_ts) VALUES('$mc_code','$mc_dept','$mc_type','$factory','$mc_room','$mc_location','RETURNED','$tx_id',now()) ";
		$rs_insert = $conn->query($insert);


		$update = "UPDATE machine_tx_history SET transfer_status = 'INACTIVE' WHERE tx_id = '$tx_id' AND transfer_status = 'ACTIVE' AND mc_code = '$mc_code' ";
 		$rs_update = $conn->query($update);

	}

	echo '1';
}

 
 
 
?>
