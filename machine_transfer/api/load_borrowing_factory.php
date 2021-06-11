<?php
session_start();

require_once '../../classes/Connect.php';
$conn = new Connect();

$tx_id = $_GET['tx_id'];

if($_SESSION['username']=='admin'){
    $where = "";
}else{
    $where = "AND factory.code = '{$_SESSION['factory']}' ";
}

if($tx_id != ''){
    $assignedFactory = " SELECT borrowing_factory FROM machine_tx WHERE tx_id = '$tx_id' ";
    $rsAssignedFactory = $conn->query($assignedFactory);
    $dataAssignedFactory = $conn->parseArray($rsAssignedFactory);
    
    $whereCode = " AND factory.code = '{$dataAssignedFactory['borrowing_factory']}' ";
}

$seeFac = " SELECT factory.code AS fac_code ,factory.nameth AS fac_nameth , factory.nameen AS fac_nameen ,"
        . "                   country.code AS country_code , country.nameth AS country_nameth ,country.nameen AS country_nameen   "
        . "FROM factory LEFT JOIN country ON factory.country_code = country.code WHERE 1 = 1  $where $whereCode ";
$rsFac = $conn->query($seeFac);
$data = array();
$i=0;
while($dataFac = $conn->parseArray($rsFac)){ 
    $data[$i] = array(
        "fac_code"=>$dataFac['fac_code'],
        "fac_nameth"=>$dataFac['fac_nameth'],
        "fac_nameen"=>$dataFac['fac_nameen'],
        "country_code"=>$dataFac['country_code'],
        "country_nameth"=>$dataFac['country_nameth'],
        "country_nameen"=>$dataFac['country_nameen'],
        "sql" => $seeFac,
);
$i++ ;}
echo json_encode(array('data'=>$data, 'count' => count($data)));

?>
