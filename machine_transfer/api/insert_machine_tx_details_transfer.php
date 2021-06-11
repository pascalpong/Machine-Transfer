<?php
session_start();

require_once '../../classes/Connect.php';
$conn = new Connect();
$tx_id = $_POST['tx_id'];
$allMcSelected = $_POST['allMcSelected'];

//$allMcSelected = explode(",", $allMcSelected);
//print_r($allMcSelected);
for($i=0;$i<count($allMcSelected);$i++){
    $allMc .= "'".$allMcSelected[$i]."',";
}

//echo $allMc;
$allMc = substr($allMc, 0  ,-1);

if(isset($allMc)){
    $codeNotIn = "AND code  IN ($allMc)";
    $codeInTransfer = "AND mc_code IN ($allMc)";
}

$check = " SELECT mc_code FROM machine_tx_details_transfer WHERE 1=1 $codeInTransfer ";
$rsCheck = $conn->query($check);
while($rowCheck = $conn->parseArray($rsCheck)){
  $allMcSelected .= "'".$rowCheck['mc_code']."',";
}
if($allMcSelected == '' || $allMcSelected == null ){
    echo json_encode($allMcSelected);
}else{



$moreInfo = " SELECT machine_location , factory , code FROM machine WHERE 1=1 $codeNotIn ;";
//echo $moreInfo;
$rsMoreInfo = $conn->query($moreInfo);
while($rowMoreInfo = $conn->parseArray($rsMoreInfo)){
            $insert = "INSERT INTO machine_tx_details_transfer
                        (tx_id,mc_code,original_location,original_factory,status) 
            VALUES('$tx_id','{$rowMoreInfo['code']}','{$rowMoreInfo['machine_location']}','{$rowMoreInfo['factory']}','w') ;";
//            echo $insert ;
            $rs = $conn->query($insert);
}
echo '1';
}