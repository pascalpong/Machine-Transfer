<?php
session_start();

require_once '../../classes/Connect.php';
$conn = new Connect();
$approve_person = $_SESSION['username'];

$tx_id = $_POST['tx_id'];

//////////////////GET total MC transferred 

$selectMcTransferred = " SELECT COUNT(transfer.mc_code) AS amt , details.tx_id , details.mc_type FROM (SELECT tx_id,mc_type FROM machine_tx_details WHERE tx_id = '$tx_id' ) AS details LEFT JOIN (SELECT machine_tx_details_transfer.tx_id, machine_tx_details_transfer.mc_code , machine.machine_type AS mc_type  FROM machine_tx_details_transfer LEFT JOIN machine ON machine.code = machine_tx_details_transfer.mc_code WHERE machine_tx_details_transfer.tx_id = '$tx_id' ) AS transfer ON transfer.mc_type = details.mc_type GROUP BY transfer.mc_type  ";
// echo $selectMcTransferred;
$rsMcTransferred = $conn->query($selectMcTransferred);
while($rowMcTransferred = $conn->parseArray($rsMcTransferred)){
	$mc_type = $rowMcTransferred['mc_type'];
	$amt = $rowMcTransferred['amt'];

$sql = " UPDATE machine_tx_details SET status = 'APPROVED' , lending_approved_ts = now() , lending_approved_by = '{$approve_person}' , lending_amt = '{$amt}' , lending_location = '' WHERE tx_id = '{$tx_id}' AND mc_type = '{$mc_type}'   ";
$rs = $conn->query($sql);

}






$select = " SELECT machine_tx_details_transfer.mc_code , machine.machine_type FROM machine_tx_details_transfer LEFT JOIN machine ON machine.code = machine_tx_details_transfer.mc_code WHERE machine_tx_details_transfer.tx_id = '$tx_id'  ";
$rsSelected = $conn->query($select);

$i=0;
while($rowSelected = $conn->parseArray($rsSelected)){
	$mc_code = $rowSelected['mc_code'];
	$mc_type = $rowSelected['machine_type'];
///////////////////GET new location
	$getNewDetails = " SELECT * FROM machine_tx_details WHERE tx_id = '$tx_id' AND mc_type = '$mc_type' ";
	$rsNewDetails = $conn->query($getNewDetails);
	$rowNewDetails = $conn->parseArray($rsNewDetails);

	$newMcDetails = " SELECT borrowing_factory FROM machine_tx WHERE tx_id = '$tx_id' ";
	$rsMcDetails = $conn->query($newMcDetails);
	$rowMcDetails = $conn->parseArray($rsMcDetails);

	$newRoom = " SELECT room FROM machine_location WHERE code = '{$rowMcDetails['borrowing_factory']}' ";
	$rsNewRoom = $conn->query($newRoom);
	$rowNewRoom = $conn->parseArray($rsNewRoom);

	$newRoom = $rowNewRoom['room'];
	$newLocation = $rowNewDetails['borrowing_location'];
	$newFactory = $rowMcDetails['borrowing_factory'];
///////////////////UPDATE MC stat to transferred and assign a new location
	

	$getMachineInfo = " SELECT code, machine_type , machine_dept , machine_location , machine_room , factory FROM machine WHERE code =  '$mc_code' ";
	// echo $getMachineInfo ;
	$rsGetMachineInfo = $conn->query($getMachineInfo);
	$rowGetMachineInfo = $conn->parseArray($rsGetMachineInfo);

	$machine_code = $rowGetMachineInfo['code'];
	$machine_type = $rowGetMachineInfo['machine_type'];
	$machine_dept = $rowGetMachineInfo['machine_dept'];
	$machine_location = $rowGetMachineInfo['machine_location'];
	$machine_room = $rowGetMachineInfo['machine_room'];
	$machine_factory = $rowGetMachineInfo['factory'];

	if($machine_code == ''|| $machine_code == null){

	}else{

	$insertMcInfo = " INSERT INTO machine_tx_history (mc_code,mc_dept,mc_type,factory,mc_room,mc_location,transfer_ts,transfer_status,tx_id) VALUES('$machine_code','$machine_dept','$machine_type','$machine_factory','$machine_room','$machine_location',now(),'ORIGINAL','$tx_id') ";
	// echo $insertMcInfo; 
	$rsUpdateMcStat = $conn->query($insertMcInfo);
	$i++;
	}

	
}

echo $i;
 
?>
