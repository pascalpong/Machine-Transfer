<?php
session_start();
require_once '../../classes/Connect.php';
$conn = new Connect();

if($_SESSION['username']=='admin'){
    $where = "";
}else{
    $where = " AND borrowing_factory = '{$_SESSION['factory']}' ";
}

 

$sql = " SELECT machine_tx.* FROM `machine_tx_details` LEFT JOIN machine_tx ON machine_tx.tx_id = machine_tx_details.tx_id WHERE machine_tx_details.status = 'RECEIVED' $where GROUP BY machine_tx_details.tx_id ";
$rs = $conn->query($sql);
$i=0;
 while($row = $conn->parseArray($rs)){
 $data[$i] = array(
    'tx_id' => $row['tx_id'],
    'lending_factory' => $row['lending_factory'],
    'lending_status' => $row['lending_status'],
    'lending_country' => $row['lending_country'],
    'borrowing_factory' => $row['borrowing_factory'],
    'borrowing_status' => $row['borrowing_status'],
    'borrowing_country' => $row['borrowing_country'],
    'creator' => $row['creator'],
    'creator_dept' => $row['creator_dept'],
    'etc' => $row['etc'],
    'create_ts' => $row['create_ts'],
    'docno' => $row['docno'],
    'refno' => $row['refno'],
 );
 $i++ ; }


echo json_encode(array('data'=>$data));