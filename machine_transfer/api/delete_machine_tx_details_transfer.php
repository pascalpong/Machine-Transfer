<?php
session_start();

require_once '../../classes/Connect.php';
$conn = new Connect();
$tx_id = $_POST['tx_id'];
$allMcSelected = $_POST['allMcRemove'];

//$allMcSelected = explode(",", $allMcSelected);
//print_r($allMcSelected);
for($i=0;$i<count($allMcSelected);$i++){
    $allMc .= "'".$allMcSelected[$i]."',";
}


$allMc = substr($allMc, 0  ,-1);
// echo $allMc;

if($allMc == ''|| $allMc == null){
    echo '0';
}else{
     $deleteAllSelected = " DELETE FROM machine_tx_details_transfer WHERE mc_code IN ($allMc) ";
    $rs = $conn->query($deleteAllSelected);
    echo '1';
}
 

         

