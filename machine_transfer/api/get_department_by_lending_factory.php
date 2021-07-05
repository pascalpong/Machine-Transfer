<?php
session_start();
require_once '../../classes/Connect.php';
$conn = new Connect();

$tx_id  = $_GET['tx_id'];

$getFactory = " SELECT machine_tx.lending_factory FROM machine_tx LEFT JOIN machine_tx_details ON machine_tx_details.tx_id = machine_tx.tx_id WHERE 1=1 AND machine_tx_details.status = 'RECEIVED' AND machine_tx.tx_id = '$tx_id' GROUP BY machine_tx.lending_factory  ";
// echo $getFactory ;
$rsGetFactory = $conn->query($getFactory);
$rowGetFactory = $conn->parseArray($rsGetFactory);

$lending_factory = $rowGetFactory['lending_factory'];




$sql = " SELECT * FROM machine_dept WHERE 1=1 AND  factory = '$lending_factory' AND status = 'A' ";
// echo $sql ; 
$rs = $conn->query($sql);
$i=0;
 while($row = $conn->parseArray($rs)){
 $data[$i] = array(
    'code' => $row['code'],
    'nameth' => $row['nameth'],
    'nameen' => $row['nameen'],
    'details' => $row['details'],
 );
 $i++ ; }


echo json_encode(array('data'=>$data));