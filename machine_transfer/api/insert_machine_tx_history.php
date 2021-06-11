<?php
session_start();

require_once '../../classes/Connect.php';
$conn = new Connect();

$mc_code = $_POST['mc_code'];
$mc_dept = $_POST['mc_dept'];
$mc_room = $_POST['mc_room'];
$mc_location = $_POST['mc_location'];
$tx_id = $_POST['tx_id'];

$borrowFac = "SELECT borrowing_factory FROM machine_tx WHERE tx_id = '$tx_id' ";
// echo $borrowFac ;
$rsBorrowFac = $conn->query($borrowFac);
$rowBorrowFac = $conn->parseArray($rsBorrowFac);

$mcType = "SELECT machine_type FROM machine WHERE code = '$mc_code'";
$rsMcType = $conn->query($mcType);
$rowMcType = $conn->parseArray($rsMcType);


$mc_type = $rowMcType['machine_type'];
$borrowing_factory = $rowBorrowFac['borrowing_factory'];

///////////////////////////////// Check if In the list

$chk  = " SELECT id FROM machine_tx_history WHERE mc_code = '$mc_code' AND transfer_status = 'WAIT' ORDER BY id DESC LIMIT 1  " ; 
$rsChk = $conn->query($chk);
$rowChk = $conn->parseArray($rsChk);

$historyId = $rowChk['id'];

if($historyId != '' || $historyId != null){

$thenDelete = " DELETE FROM machine_tx_history WHERE id = '$historyId' ";
$rsThenDelete = $conn->query($thenDelete);

$result = "DEL";

}else{
$insert = " INSERT INTO machine_tx_history(mc_code,mc_dept,mc_room,mc_location,transfer_status,transfer_ts,tx_id,factory,mc_type) VALUES('$mc_code','$mc_dept','$mc_room','$mc_location','WAIT',now(),'$tx_id','$borrowing_factory','$mc_type')  ";
$rsInsert = $conn->query($insert);
$result = "INS";
}




echo $rsInsert; 
