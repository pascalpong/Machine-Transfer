<?php
session_start();
require_once '../../classes/Connect.php';
$conn = new Connect(); 


$tx_id = $_GET['tx_id'];


$sql = " SELECT * FROM machine_tx_history WHERE tx_id = '{$tx_id}' AND transfer_status = 'RETURNED' ";


$data = array();
$i=0;
$rs = $conn->query($sql);
while($row = $conn->parseArray($rs)){

    $data[$i] = array(
        'mc_code'=>$row['mc_code'],
        'mc_dept'=>$row['mc_dept'],
        'mc_room'=>$row['mc_room'],
        'mc_location'=>$row['mc_location'],
        'factory'=>$row['factory'],
        );
$i++;

}

echo  json_encode(array('data'=>$data));



