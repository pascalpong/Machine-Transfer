<?php
session_start();
require_once '../../classes/Connect.php';
$conn = new Connect();

$tx_id = $_GET['tx_id'];

if($tx_id != ''){
    $where  =" AND tx_id = '{$tx_id}' ";
}

 

$sql = " SELECT * FROM machine_tx_details WHERE 1=1 $where ORDER BY id ASC ";
$rs = $conn->query($sql);
$i=0;
 while($row = $conn->parseArray($rs)){
 $data[$i] = array(
    'mc_type' => $row['mc_type'],
    'amt' => $row['amt'],
    'lending_amt' => $row['lending_amt'],
    'borrowing_amt' => $row['borrowing_amt'],
    'renting_amt' => $row['renting_amt'],
    'borrowing_approved_by' => $row['borrowing_approved_by'],
    'lending_approved_by' => $row['lending_approved_by'],
    'borrowing_approved_ts' => $row['borrowing_approved_ts'],
    'lending_approved_ts' => $row['lending_approved_ts'],
    'start_date' => $row['start_date'],
    'end_date' => $row['end_date'],
    'lending_location' => $row['lending_location'],
    'borrowing_location' => $row['borrowing_location'],
 );
 $i++ ; }


echo json_encode(array('data'=>$data,'count'=>count($data)));