<?php
session_start();
require_once '../../classes/Connect.php';
$conn = new Connect();

$tx_id = $_GET['tx_id'];
$mc_type = $_GET['mc_type'];
if($_SESSION['username']=='admin'){
    $where = "";
}else{
    $where = " AND borrowing_factory = '{$_SESSION['factory']}' ";
}

 

$sql = " SELECT machine_tx_details_transfer.tx_id , machine.code , machine.nameth , machine.nameen , machine.machine_location  , machine.factory , machine.machine_type , machine.machine_dept  "
        . " FROM machine_tx_details_transfer "
        . " LEFT JOIN machine ON machine.code = machine_tx_details_transfer.mc_code "
        . " WHERE 1=1 AND machine_tx_details_transfer.tx_id = '$tx_id' AND machine.machine_type = '$mc_type'  ";
//echo $sql;
$rs = $conn->query($sql);
$i=0;
 while($row = $conn->parseArray($rs)){
 $data[$i] = array(
    'tx_id' => $row['tx_id'],
    'mc_code' => $row['code'],
    'nameth' => $row['nameth'],
    'nameen' => $row['nameen'],
     'machine_type' => $row['machine_type'],
     'machine_dept' => $row['machine_dept'],
    'mc_locaiton' => $row['machine_location'],
    'factory' => $row['factory'],
 );
 $i++ ; }


echo json_encode(array('data'=>$data,'count'=>count($data)));