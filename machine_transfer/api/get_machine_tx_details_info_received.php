<?php
session_start();
require_once '../../classes/Connect.php';
$conn = new Connect();

$tx_id = $_GET['tx_id'];

if($tx_id != ''){
    $where  =" AND tx_id = '{$tx_id}' ";
}

 

$sql = " SELECT * FROM machine_tx_history WHERE 1=1 $where AND transfer_status = 'ACTIVE' ORDER BY mc_code ASC ";


$rs = $conn->query($sql);
$i=0;
 while($row = $conn->parseArray($rs)){
 $data[$i] = array(
    'mc_type' => $row['mc_type'],
    'mc_dept' => $row['mc_dept'],
    'mc_code' => $row['mc_code'],
    'mc_room' => $row['mc_room'],
    'mc_location' => $row['mc_location'],
    'factory' => $row['factory'],
    'transfer_ts' => $row['transfer_ts'],
 );
 $i++ ; }


echo json_encode(array('data'=>$data,'count'=>count($data)));