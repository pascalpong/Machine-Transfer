<?php
session_start();
require_once '../../classes/Connect.php';
$conn = new Connect();
$tx_id = $_GET['tx_id'];
$mc_type  = $_GET['mc_type'];
$mc_location = $_GET['mc_location'];
$limit = $_GET['limit'];

$findAvailableMachine = " SELECT mc_code,wo_state FROM wo WHERE wo_state NOT IN ('09','c','99') GROUP BY mc_code ";
$rsAvailableMachine = $conn->query($findAvailableMachine);
while($rowAvailableMachine = $conn->parseArray($rsAvailableMachine)){
    $notInclude1 .= "'".$rowAvailableMachine['mc_code']."',";
}
if($tx_id!=''||$tx_id!=null){
$findTransfering = " SELECT mc_code FROM machine_tx_details_transfer  ";
$rsFindTransfering = $conn->query($findTransfering);
while($rowFindTransfering = $conn->parseArray($rsFindTransfering)){
    $notInclude2 .= "'".$rowFindTransfering['mc_code']."',";
}
}

$totalNotInclude = $notInclude1.$notInclude2;


    if(isset($totalNotInclude)){
    $notInclude = substr($totalNotInclude, 0, -1);
    $notIncludeReal = " AND machine.code NOT IN (".$notInclude.") ";
    }
    
    if($mc_type!=''){
        $andType = " AND machine.machine_type = '$mc_type' ";
    }
    
    if($mc_location != ''){
        $andLocation = "AND machine.machine_location = '{$mc_location}' ";
    }
    
    

$sql = " SELECT machine.machine_location, count(machine.code) AS amt ,machine_location.nameth , machine_location.nameen, machine_location.details, machine_location.factory "
        . "FROM machine LEFT JOIN "
        . "machine_location ON machine_location.code  = machine.machine_location "
        . "WHERE 1=1  $andType  $notIncludeReal $andLocation GROUP BY machine.machine_location $andLimit ";
// echo $sql;
$rs = $conn->query($sql);
$i=0;
 while($row = $conn->parseArray($rs)){
 $data[$i] = array(
    'mc_location' => $row['machine_location'], 
     'nameth' => $row['nameth'], 
     'nameen' => $row['nameen'], 
     'details' => $row['details'], 
     'factory' => $row['factory'], 
     'amt' => $row['amt'], 
 );
 $i++ ; }
 
 if($limit != ''){
     $andLimit = "limit $limit";
 }

 
 $machineDetails = " SELECT * FROM machine WHERE  status  = 'A' "
        . "  $andType  $notIncludeReal $andLocation  $andLimit  ";
// echo $machineDetails ;
$rsDetails= $conn->query($machineDetails);
$i=0;
 while($rowDetails = $conn->parseArray($rsDetails)){
 $dataDetails[$i] = array(
    'mc_code' => $rowDetails['code'], 
     'nameth' => $rowDetails['nameth'], 
     'nameen' => $rowDetails['nameen'], 
     'details' => $rowDetails['details'], 
     'mc_type' => $rowDetails['machine_type'], 
     'mc_dept' => $rowDetails['machine_dept'], 
     'mc_location' => $rowDetails['machine_locatoin'], 
     'factory' => $rowDetails['factory'], 
     'details' => $rowDetails['details'], 
 );
 $i++ ; }


echo json_encode(array('data'=>$data,'dataDetails'=>$dataDetails));