<?php
session_start();

require_once '../../classes/Connect.php';
$conn = new Connect();

$tx_id = $_GET['tx_id'];
$mc_type = $_GET['mc_type'];
$amt = $_GET['amt'];
$borrowing_location = $_GET['borrowing_location'];
$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];


$insert = " INSERT INTO machine_tx_details
(tx_id,mc_type,amt,borrowing_amt,status,start_date,end_date,borrowing_location) VALUES
('$tx_id','$mc_type','$amt','$amt','wait for approve','','','$borrowing_location') ";
$rs = $conn->query($insert);

echo $rs;