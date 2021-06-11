<?php
session_start();
require_once '../../classes/Connect.php';
$conn = new Connect();

$mc_room = $_GET['mc_room'];
 
$sql = " SELECT * FROM machine_location WHERE 1=1 AND room = '$mc_room'  ";
$rs = $conn->query($sql);
$i=0;
while($row = $conn->parseArray($rs)){
$data[$i] = array(
    'code' => $row['code'],
    'nameth' => $row['nameth'],
    'nameen' => $row['nameen'],
    'details' => $row['details'],
    'factory' => $row['factory'],
);
$i++ ;}
echo json_encode(array('data'=>$data,'count'=>count($data)));