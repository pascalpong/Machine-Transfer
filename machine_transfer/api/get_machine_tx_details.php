<?php
session_start();
require_once '../../classes/Connect.php';
$conn = new Connect();

$tx_id = $_GET['tx_id'];

$sql = " SELECT * FROM machine_tx WHERE tx_id = '$tx_id' ";
$rs = $conn->query($sql);
$data = $conn->parseArray($rs);

$facInfo = " SELECT lending_fac.code AS lending_fac_code , lending_fac.nameth AS lending_fac_nameth , lending_fac.country_code AS lending_country_code, lending_fac.country_nameth AS lending_country_nameth , "
        . "                           borrowing_fac.code AS borrowing_fac_code , borrowing_fac.nameth AS borrowing_fac_nameth , borrowing_fac.country_code AS borrowing_country_code  , lending_fac.country_nameth AS borrowing_country_nameth "
        . "FROM "
        . "(SELECT factory.code, factory.nameth, factory.country_code, country.nameth AS country_nameth FROM factory LEFT JOIN country ON country.code = factory.country_code WHERE factory.code = '{$data['lending_factory']}' ) AS lending_fac ,"
        . "(SELECT factory.code, factory.nameth, factory.country_code, country.nameth AS country_nameth FROM factory LEFT JOIN country ON country.code = factory.country_code WHERE factory.code = '{$data['borrowing_factory']}' ) AS borrowing_fac ";
$rsFacInfo = $conn->query($facInfo);
$dataFacInfo = $conn->parseArray($rsFacInfo);
 
$data = array(
//    'facSQL'=>$facInfo,
    'tx_id' => $data['tx_id'],
    'lending_factory' => $dataFacInfo['lending_fac_code'],
    'lending_factory_nameth' => $dataFacInfo['lending_fac_nameth'],
    'lending_status' => $data['lending_status'],
    'lending_country' => $dataFacInfo['lending_country_code'],
    'lending_country_nameth' => $dataFacInfo['lending_country_nameth'],
    'borrowing_factory' => $dataFacInfo['borrowing_fac_code'],
    'borrowing_factory_nameth' => $dataFacInfo['borrowing_fac_nameth'],
    'borrowing_status' => $data['borrowing_status'],
    'borrowing_country' => $dataFacInfo['borrowing_country_code'],
    'borrowing_country_nameth' => $dataFacInfo['borrowing_country_nameth'],
    'creator' => $data['creator'],
    'creator_dept' => $data['creator_dept'],
    'etc' => $data['etc'],
    'create_ts' => $data['create_ts'],
    'docno' => $data['docno'],
    'refno' => $data['refno'],
//    'sql' => $sql,
);

echo json_encode($data);