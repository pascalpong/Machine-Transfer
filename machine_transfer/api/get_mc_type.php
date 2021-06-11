<?php
session_start();
require_once '../../classes/Connect.php';
$conn = new Connect();

$tx_id = $_GET['tx_id'];
$mc_type = $_GET['mcType'];

if($tx_id != ''){
    $sqlCheck = " SELECT * FROM machine_tx_details WHERE tx_id = '{$tx_id}' ";
    $rsCheck = $conn->query($sqlCheck);
    while($dataCheck = $conn->parseArray($rsCheck)){
        $selectedTypes .= "'".$dataCheck['mc_type']."',";
    }
    $allTypesSelected = substr($selectedTypes, 0, -1);
    if($dataCheck['mc_type']!=''){
        $andNotInclude = "AND machine_type.code NOT IN ($allTypesSelected)";
    }
}

if($mc_type != ''){
    $andMcType = "AND machine_type.code = '$mc_type' ";
}

 $McTx = " SELECT lending_factory FROM machine_tx WHERE tx_id = '{$tx_id}' ";
     $rsMcTx = $conn->query($McTx);
     $dataMcTx = $conn->parseArray($rsMcTx);

$sql = " SELECT machine_type.* FROM machine LEFT JOIN machine_type ON machine_type.code = machine.machine_type  WHERE machine_type.status = 'A'  $andFac $andNotInclude $andMcType AND machine.factory='{$dataMcTx['lending_factory']}'   ";
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