<?php
session_start();
require_once '../../classes/Connect.php';
$conn = new Connect();
$tx_id = $_POST['tx_id'];





$sql = " SELECT * FROM machine_tx_history WHERE tx_id = '$tx_id' AND transfer_status = 'RETURNED' ";
// echo $sql;
$i=0;
$rs = $conn->query($sql);
 while($row = $conn->parseArray($rs)){

$update = "UPDATE machine SET machine_dept = '{$row['mc_dept']}' , machine_location = '{$row['mc_location']}' , factory = '{$row['factory']}' , machine_room = '{$row['mc_room']}' , status = 'A' WHERE code = '{$row['mc_code']}'  ";
// echo $update ;
$updateRow = $conn->query($update);

$i++;
}


// $sqlHistory = "SELECT * FROM (SELECT COUNT(mc_code) AS receive FROM machine_tx_history WHERE tx_id = '$tx_id' AND transfer_status = 'INACTIVE' ) AS receive , (SELECT COUNT(mc_code) AS original FROM machine_tx_history WHERE tx_id = '$tx_id' AND transfer_status = 'MOVED' ) AS original";
// $rsHistory = $conn->query($sqlHistory);
// $rsHistory = $conn->parseArray($rsHistory);

$updateStatusDetails = " UPDATE machine_tx_details SET status = 'COMPLETED' WHERE tx_id = '$tx_id' ";
$rsStatusDetails = $conn->query($updateStatusDetails);

$updateStatusTx = " UPDATE machine_tx SET status = 'COMPLETED' WHERE tx_id = '$tx_id' ";
$rsStatusTx = $conn->query($updateStatusTx);


echo $i;



?>