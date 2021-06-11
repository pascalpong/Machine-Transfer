<?php
session_start();
$_SESSION['sidebar'] = 'machine_transfer';



require_once '../classes/Connect.php';
$conn = new Connect();

require_once '../classes/InvStock.class.php';
$stock = new InvStock();


require_once '../classes/Utility.php';
$uu = new Utility();



 $personal_lang = "select * from hr where code = '{$_SESSION['username']}'";
$rsxx = $conn->query($personal_lang);
$rowxx = $conn->parseArray($rsxx);

$count_slash_lang =  explode('/', $_SERVER['PHP_SELF']);
if(count($count_slash_lang) == '3'){
	$th_lang_count = 'language_config/thai_lang.php';
	$eng_lang_count = 'language_config/eng_lang.php';
}
if(count($count_slash_lang) == '4'){
	$th_lang_count = '../language_config/thai_lang.php';
	$eng_lang_count = '../language_config/eng_lang.php';
}
if(count($count_slash_lang) == '5'){
	$th_lang_count = '../../language_config/thai_lang.php';
	$eng_lang_count = '../../language_config/eng_lang.php';
}
if(count($count_slash_lang) == '6'){
	$th_lang_count = '../../../language_config/thai_lang.php';
	$eng_lang_count = '../../../language_config/eng_lang.php';
}


if($rowxx['language']=='eng'){
	include $eng_lang_count;

}else{

	include $th_lang_count;
}



if (isset($_POST['savedata'])) {
    
    if(isset($_GET['id'])){
    $sql = "UPDATE machine_tx SET etc  = '{$_POST['tx_details']}'  "
    . " WHERE tx_id = '{$_GET['id']}' ";
//    echo $sql;
//    exit();
    $rs = $conn->query($sql);
    header("Location: create_transfer.php?id=".$_GET['id']); 
    }else{
    
    $docNo = $_POST['docno'];
    $lendingFactory = $_POST['lendingFac'];
    $borrowingFactory = $_POST['borrowingFac'];
    $etc = $_POST['tx_details'];
    $creator = $_POST['creator'];
    $creatorDept = $_POST['creator_dept'];
    
    
    $genTxId = " SELECT tx_id FROM machine_tx WHERE lending_factory = '{$lendingFactory}' ORDER BY id DESC ";
    $rsGenTxId = $conn->query($genTxId);
    $dataGenTxId = $conn->parseArray($rsGenTxId);
    
    if(!$dataGenTxId['tx_id']){
        $genId = 0;
    }else{
        $genId = explode('-', $dataGenTxId['tx_id']);
        $genId = (int)$genId[2]+1;
    }
        $genNow = date("Y-m-d H:i:s");
        $genThisYear = date("Y");
    
        $useGenId = $lendingFactory."-".$genThisYear."-".$genId;
        
    $getCountry = " SELECT lend.country_code AS countryLend , borrow.country_code AS countryBorrow FROM 
                            (SELECT country_code FROM factory WHERE code = '{$lendingFactory}') AS lend,
                            (SELECT country_code FROM factory WHERE code = '{$borrowingFactory}') AS borrow ";
    $rsCountry = $conn->query($getCountry);
    $dataCountry = $conn->parseArray($rsCountry);
    
    $time = date('Y-m-d H:i:s', time());
    

    $sql = "INSERT INTO machine_tx (tx_id,docno,etc,create_ts,creator,creator_dept,lending_factory,lending_country,lending_status,borrowing_factory,borrowing_country,borrowing_status) "
    . "VALUES('{$useGenId}','{$docNo}','{$etc}','{$genNow}','{$creator}','{$creatorDept}','{$lendingFactory}','{$dataCountry['countryLend']}','0','{$borrowingFactory}','{$dataCountry['countryBorrow']}','0');";
   echo $sql ;
   exit();
    
    $rs = $conn->query($sql);
    
    header("Location: create_transfer.php?id=".$useGenId); 
    }
}


 

?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PMII Maintenance Solution</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="../global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="../full/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../full/assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
    <link href="../full/assets/css/layout.min.css" rel="stylesheet" type="text/css">
    <link href="../full/assets/css/components.min.css" rel="stylesheet" type="text/css">
    <link href="../full/assets/css/colors.min.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="../global_assets/js/main/jquery.min.js"></script>
    <script src="../global_assets/js/main/bootstrap.bundle.min.js"></script>
    <script src="../global_assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="../global_assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script src="../global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
    <script src="../global_assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script src="../global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script src="../global_assets/js/plugins/ui/moment/moment.min.js"></script>
    <script src="../global_assets/js/plugins/pickers/daterangepicker.js"></script>

    <script src="../global_assets/js/plugins/ui/moment/moment.min.js"></script>
    <script src="../global_assets/js/plugins/pickers/daterangepicker.js"></script>
    <script src="../global_assets/js/plugins/pickers/anytime.min.js"></script>
    <script src="../global_assets/js/plugins/pickers/pickadate/picker.js"></script>
    <script src="../global_assets/js/plugins/pickers/pickadate/picker.date.js"></script>
    <script src="../global_assets/js/plugins/pickers/pickadate/picker.time.js"></script>
    <script src="../global_assets/js/plugins/pickers/pickadate/legacy.js"></script>
    <script src="../global_assets/js/demo_pages/picker_date.js"></script>

    <script src="../global_assets/js/plugins/ui/perfect_scrollbar.min.js"></script>

    <script src="../full/assets/js/app.js"></script>
    <script src="../global_assets/js/demo_pages/dashboard.js"></script>
    <script src="../global_assets/js/demo_pages/layout_fixed_sidebar_custom.js"></script>
    <!-- <script src="fullcalendar_basic.js"></script> -->
    <script src="../global_assets/js/plugins/ui/moment/moment.min.js"></script>
    <script src="../global_assets/js/plugins/ui/fullcalendar/fullcalendar.min.js"></script>
    <script src="../global_assets/js/demo_pages/components_modals.js"></script>
    <script src="../global_assets/js/plugins/notifications/jgrowl.min.js"></script>
    <!-- /theme JS files -->



    <link href="../style/my.css" rel="stylesheet" type="text/css">

</head>
<script type="text/javascript">

     var $_GET = <?php echo json_encode($_GET); ?>;


    $(document).ready(function () {


                        
    $('#startDate').pickadate({
                    //container:"#my-root",
                    monthsFull: ['<? echo $month_january ; ?>', '<? echo $month_febuary ; ?>', '<? echo $month_march ; ?>', '<? echo $month_april ; ?>', '<? echo $month_may ; ?>', '<? echo $month_june ; ?>', '<? echo $month_july ; ?>', '<? echo $month_august ; ?>', '<? echo $month_september ; ?>', '<? echo $month_october ; ?>', '<? echo $month_november ; ?>', '<? echo $month_december ; ?>'],
                    weekdaysShort: ['<? echo $abbr_Sun ?>', '<? echo $abbr_Mon ?>', '<? echo $abbr_Tue ?>', '<? echo $abbr_Wed ?>', '<? echo $abbr_Thu ?>', '<? echo $abbr_Fri ?>', '<? echo $abbr_Sat ?>'],
                    labelMonthNext: '<? echo $nxt_mo ; ?>',
                    labelMonthPrev: '<? echo $nxt_mo_b4 ; ?>',
                    labelMonthSelect: '<? echo $nxt_mo_select ; ?>',
                    labelYearSelect: '<? echo $nxt_yr_select ; ?>',
                    selectMonths: true,
                    selectYears: true,
                    today: '<? echo $nxt_today ; ?>',
                    clear: '',
                    close: '',
                    format: 'yyyy-mm-dd',
                    formatSubmit: 'yyyy-mm-dd',
                    
                });

    $('#endDate').pickadate({
                    monthsFull: ['<? echo $month_january ; ?>', '<? echo $month_febuary ; ?>', '<? echo $month_march ; ?>', '<? echo $month_april ; ?>', '<? echo $month_may ; ?>', '<? echo $month_june ; ?>', '<? echo $month_july ; ?>', '<? echo $month_august ; ?>', '<? echo $month_september ; ?>', '<? echo $month_october ; ?>', '<? echo $month_november ; ?>', '<? echo $month_december ; ?>'],
                    weekdaysShort: ['<? echo $abbr_Sun ?>', '<? echo $abbr_Mon ?>', '<? echo $abbr_Tue ?>', '<? echo $abbr_Wed ?>', '<? echo $abbr_Thu ?>', '<? echo $abbr_Fri ?>', '<? echo $abbr_Sat ?>'],
                    labelMonthNext: '<? echo $nxt_mo ; ?>',
                    labelMonthPrev: '<? echo $nxt_mo_b4 ; ?>',
                    labelMonthSelect: '<? echo $nxt_mo_select ; ?>',
                    labelYearSelect: '<? echo $nxt_yr_select ; ?>',
                    selectMonths: true,
                    selectYears: true,
                    today: '<? echo $nxt_today ; ?>',
                    clear: '',
                    close: '',
                    format: 'yyyy-mm-dd',
                    formatSubmit: 'yyyy-mm-dd',
    });
    

                        $("#tfDetails").hide(); 
                        $("#machineTypeTransferDetails").hide();

                        
                        if('<?php echo $_GET['id'] ?>'==''){
                            // alert('null');
                                $("#detailsMachineTx").hide();
                                setData();
                        }else{
                            // alert('this id<?php echo $_GET['id'] ?>');
                                $("#detailsMachineTx").show();
                                setData('<? echo $_GET['id'] ?>');
                        }



    });



                    function setData(code){
                    
                        if(!code){
                            
                                selectBorrowingFactory();
                                selectFactory();
                        }else{
                            $.get("api/get_machine_tx_details.php",{tx_id:code},function(data){
                                json = $.parseJSON(data);
                                
                                    $("#tx_details").val(json['etc']);
                                    $("#creator").val(json['creator']);
                                    $("#creator_dept").val(json['creator_dept']);
                                    $("#tx_date").val(json['create_ts']);
                                    $("#docno").val(json['docno']).prop('readonly', true).removeClass('requiredText');
                                    $("#tx_code").val(json['tx_id']);
                                    $("#lendingFac").append("<option  value='"+json['lending_factory']+"' >"+json['lending_factory']+" : "+json['lending_factory_nameth']+"</option>");
                                    $("#country").val(json['lending_country']);
                                    $("#borrowingFac").append("<option  value='"+json['borrowing_factory']+"' >"+json['borrowing_factory']+" : "+json['borrowing_factory_nameth']+"</option>");
                                    $("#borrowingCountry").val(json['borrowing_country']);
                                    
                                     selectMcType(json['tx_id']);
                                                             $("#existingAmt").hide();
                                     $.get("api/get_machine_tx_details_info.php",{tx_id:json['tx_id']},function(data){
                                         json = $.parseJSON(data);
                                         
                                         if(json.count <= 0){
                                             
                                        }else{
                                         $("#machineTypeTransferDetails").show();
                                            for(a=0;a<json.count;a++){

                                                $("#machineTypeTransferDetails").append("<tr>");
                                                $("#machineTypeTransferDetails").append("<td>ประเภท : <br>"+json.data[a]['mc_type']+"</td>");
                                                $("#existingAmt").show();
                                                var mc_type = json.data[a]['mc_type'];
                                                var borrow_location = json.data[a]['borrowing_location'];
//                                                $.get("api/get_available_machines.php",{mc_type:mc_type,mc_location:borrow_location},function(data){
//                                                    json = $.parseJSON(data);
//                                                    for(i=0;i<json.count;i++){
//                                                        $("#existingAmt").append("<input value='"+json.data[i]['amt']+"' id='existAmt' hidden />");
//                                                        $("#existingAmt").append("(จำนวนที่มีอยู่ : "+json.data[i]['amt']+")");
//                                                    }
//                                                });
                                                var checkMcClick = "selectMachineToLend('"+json.data[a]['mc_type']+"')";    
                                                $("#machineTypeTransferDetails").append("<td>จำนวนที่ขอยืม :  "+json.data[a]['amt']+"<b style='color:red' id='existingAmt'></b><input class='form-control primary-btn' type='button'  onclick="+checkMcClick+" value='Machine Listed'/></td>");
                                                $("#machineTypeTransferDetails").append("<td>วันที่ขอยืม : "+json.data[a]['start_date']+"<br>วันที่คืน : "+json.data[a]['end_date']+"</td>");
                                                $("#machineTypeTransferDetails").append("</tr>");
                                             
                                            }
                                        }
                                         
                                         
                                     }) ;
                                    
                            });
                             
                        }
                    }


</script>
<body class="navbar-top">
    <?php
    include "../navbar.php";
    ?>


    <div class="page-content">
        <?php
        include "../sidebar.php";
        ?>
        <div class="content-wrapper">



            <!-- Content area -->
            <!--<div class="content">-->

                <script>

                    
                    function selectMachineToLend(mc_type){
                                var tx_id = '<? echo $_GET['id'] ?>';
                            $("#myModal").modal();
                            $("#myframeprint").attr("src", "modal/machine_lists.php?tx_id="+tx_id+"&mc_type="+mc_type);
                    }
                    
                    
                    function selectFactory(code){
                        var sessionFactory = '<? echo $_SESSION['factory'] ?>';
                        var tx_id = "<? echo $_GET['id'] ?>";
                            $.get("api/load_lending_factory.php",{code:code,tx_id:tx_id},function(data){
                                json = $.parseJSON(data);
                                for(i=0;i<json.count;i++){
                                        if(sessionFactory==json.data[i]['fac_code']){
                                            var selected = 'selected';    
                                        }else{
                                            var selected = '';    
                                        }
                                    $("#lendingFac").append("<option "+selected+" value='"+json.data[i]["fac_code"]+"' >"+json.data[i]["fac_nameth"]+"</option>");
                                    $("#country").val(json.data[i]["country_code"]);
                                }
                            });
                    }
                    
                    function selectBorrowingFactory(code){
                            var tx_id = "<? echo $_GET['id'] ?>";
                            $.get("api/load_borrowing_factory.php",{code:code,tx_id:tx_id},function(data){
                                json = $.parseJSON(data);
                                for(i=0;i<json.count;i++){
                                    $("#borrowingFac").append("<option  value='"+json.data[i]["fac_code"]+"' >"+json.data[i]["fac_nameth"]+"</option>");
                                    $("#borrowingCountry").val(json.data[i]["country_code"]);
                                }
                            });
                    }
                    
                    function selectMcType(tx_id,select){

                    $.get("api/get_mc_type.php",{tx_id:tx_id},function(data){
                        json = $.parseJSON(data);   
                        for(i=0;i<json.count;i++){
                        $("#selectMcType").append("<option value='"+json.data[i]['code']+"' >"+json.data[i]['code']+" : "+json.data[i]['nameth']+"</option>");
                    }
                    });
 
                    }
                    
                    function confirmSelectMcType(){
                        $("#mcTypeDetails").empty();
                        $("#submitAppears").empty();
                    var selectMcType = $("#selectMcType").val();
                    $("#submitAppears").append("<input style='' class='form-control' type='button' id='confirmMcType' onclick='insertTxDetails()' value='Confirm' >");
                    $("#tfDetails").show(); 
                    
                    $.get("api/get_available_machines.php",{mc_type:selectMcType},function(data){
                                json = $.parseJSON(data);
//                        alert(json.count);
                    $("#mcTypeDetails").append("<td>"+"<? echo 'ประเภทเครื่องจักร : ' ?>"+"<br><b>"+selectMcType+"</b><input hidden class='form-control' id='typeSelect' type='text' readonly /></td>");
                    $("#mcTypeDetails").append("<td>"+"<? echo 'Location : ' ?>"+"<select class='form-control' id='mcLocation' ></select>"+"<? echo 'จำนวน : ' ?>"+"<input class='form-control' id='amtBorrow' type='number' />จำนวนเครื่องจักรที่มี : <b style='color:red' id='amtAvailable' ></b></td>");
                    $("#mcTypeDetails").append("<td>"+"<? echo 'วันที่ยืม : ' ?>"+"<input class='form-control form-control-sm date-picker'  id='startDate' type='text' readonly value='' />"+"<? echo 'วันที่คืน : ' ?>"+"<input class='form-control form-control-sm date-picker'  id='endDate' type='text' readonly value=' ' /></td>");
                    $("#typeSelect").val(selectMcType);
                       
                    for(i=0;i<json.count;i++){
                            
                            $("#mcLocation").append("<option val='"+json.data[i]['mc_location']+"' >"+json.data[i]['mc_location']+"</option>");
                            $("#amtAvailable").append(json.data[i]['amt']);
                            }
                            
                    });
                    
            
                    }
                    function insertTxDetails(){
                    
                        var tx_id = $("#tx_code").val();
                        var mcType = $("#typeSelect").val();
                        var startDate = $("#startDate").val();
                        var endDate = $("#endDate").val();
                        var amt = $("#amtBorrow").val();
                        var borrowing_location = $("#mcLocation").val();

//                        alert(mcType);
                          $.get("api/insert_machine_tx_details.php",{mc_type:mcType,tx_id:tx_id,amt:amt,borrowing_location:borrowing_location,start_date:startDate,end_date:endDate},function(data){
                            json = $.parseJSON(data);
                            if(json == 1){
                                window.location.replace("create_transfer?id="+tx_id);
                            }
                    });                  
                    }
                    
                    function selectMachineTransfer(mc_code){
                        $("#myModal").modal('hide');
                        alert(mc_code);
                    }
                    
 
function onLoad(value) {
    var light = $('#load').closest('.content-wrapper');
    if (value) {
        $(light).block({
            message: '<i class="icon-spinner spinner"></i>',
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'none'
            }
        });

    } else {
        window.setTimeout(function () {
            $(light).unblock();
        }, 250);
    }

}

function clickSelectInv(code) {
    $('#modalDialog').modal('hide');
    $("#inv_code").val(code);
}

function clickSelectStore(code) {
    $('#modalDialogST').modal('hide');
    $("#store_code").val(code);
}

function clickSelectLocation(code) {
    $('#modalDialogLC').modal('hide');
    $("#loca_code").val(code);
} 

 

function approveTransfer(){
    var id = '<?php echo $_GET['id']?>'

    // alert(id);
     confirm = confirm("Do you want to approve this transfer?");
        if (confirm == true) {
            // alert(id);
            $.post("api/update_approve_transfer.php",{tx_id:id},function(data){
                    json = $.parseJSON(data);

                    if(json>0){
                        alert(json+'Machine(s) have already been selected for the transfer');
                        
                    }else{
                        alert('transaction failed');
                    }
                    window.location.replace("create_transfer?id="+id);
            });
        } else {
          // alert('adsfasdfasdf');
          return false;
        }

}
</script>

<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold"><?php echo $mcTR_MCTransfer ?></span> -<?php echo $mcTR_createTransfer; ?></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>


    </div>

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="list_all.php" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> <?php echo $mcTR_transferList; ?></a>
                <span class="breadcrumb-item active"><?php echo $adjdetails; ?></span>
            </div>

            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="breadcrumb justify-content-center">



            </div>
        </div>
    </div>
    <!--</div>-->
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">

    <!-- Form inputs -->
    <div id="load" class="card">
        <?php
        require_once '../classes/Connect.php';

        $conn = New Connect;
        $chkedit = false;

        ?>

        <div class="card-body">




            <form method="post" action="">
                <fieldset class="mb-3">
                    <div class="row">
                    <div class="col-lg-5">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-4">เลขที่เอกสาร: </label>
                            <div class="col-lg-8">
                                <input autofocus="true" required type="text" class="form-control requiredText" placeholder=""   id="docno" name="docno" value="">
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4">หมายเลข Transfer : </label>
                                <div class="col-lg-8" >
                                    <input type="text" class="form-control" readonly value=""  id="tx_code" name="tx_code">
                             </div>
                         </div>  
                     </div>
                     <div class="col-lg-5">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-4">วันที่ทำรายการ : </label>
                            <div class="col-lg-6">
                                <input readonly="" type="text" class="form-control" id="tx_date" name="tx_date"   value="">
                            </div>

                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-5">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-4">ผู้ทำรายการ : </label>
                            <div class="col-lg-8">

                                <input type="text" name="creator" id="creator"  class="form-control" readonly=""  value="<?php
                                if ($chkedit) {
                                    echo  $uu->getNameth("hr", $dataTxt['creator']);
                                    }else{
                                       echo  $uu->getNameth("hr", $_SESSION["username"]);
                                   }
                                   ?>" >
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-5">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-4">แผนกผู้ทำรายการ :</label>
                            <div class="col-lg-6">
                                <input type="text"  readonly="" class="form-control  "  id="creator_dept" name="creator_dept" value="<?php
                                if ($chkedit) {
                                    echo $uu->getNameth("hr_dept", $dataTxt["creator_dept"]);
                                    }else{
                                        $sql_dept = "SELECT hr_dept.nameth FROM hr LEFT JOIN hr_dept ON hr_dept.code = hr.hr_dept WHERE hr.code = '{$_SESSION["username"]}'";
                                        $rs_dept = $conn->query($sql_dept);
                                        $row = $conn->parseArray($rs_dept);
                                        echo $row["nameth"];
                                    }
                                    ?>" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4">โรงงานที่ให้ยืม : </label>
                                <div class="col-lg-8" >
                                    <select class="form-control" id="lendingFac" name="lendingFac" onchange="selectFactory()" ></select>
                             </div>
                         </div>  
                     </div>
                     <div class="col-lg-5">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-4">ประเทศ : </label>
                            <div class="col-lg-6">
                                <input readonly="" type="text" class="form-control" id="country" name="country"  value="">
                            </div>

                        </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4">โรงงานที่ขอยืม : </label>
                                <div class="col-lg-8" >
                                    <select class="form-control" id="borrowingFac" name="borrowingFac" onchange="selectBorrowingFactory()" ></select>
                             </div>
                         </div>  
                     </div>
                     <div class="col-lg-5">
                        <div class="form-group row">
                            <label class="col-form-label col-lg-4">ประเทศ : </label>
                            <div class="col-lg-6">
                                <input readonly="" type="text" class="form-control" id="borrowingCountry" name="borrowingCountry"  value="">
                            </div>

                        </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4">หมายเหตุ : </label>
                                <div class="col-lg-8">
                                    <textarea <?php if($chkedit)echo "readonly='true'" ?> cols="3" class="form-control"  id="tx_details" name="tx_details"  ><?php
                                    if ($chkedit) {
                                        echo $dataTxt['etc'];
                                    }
                                    ?></textarea>
                                </div>
                            </div>
                        </div> 
                    </div>


                </fieldset>


                <div class="text-right">
 
                    <button type="submit" id="savedata"  name="savedata"  class="btn btn-primary">บันทึก <i class="icon-paperplane ml-2"></i>
                    </button>
                    <button type="button" id="approveLending" onclick="approveTransfer()" name="approveLending"  class="btn btn-primary">Approve Transfer<i class="icon-rating ml-2"></i>
                    </button>
 
            </div>
        </form>
    </div>
</div>

<form action=""  method="post">
 
    <div  id="detailsMachineTx"  class="card">
        <div class="card-body">
            <div class="row">
                <div class="table-responsive">
                    <table class="table  table-xs table-bordered table-framed" style='font-family: Roboto,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
                    font-size: .8125rem;
                    font-weight: 400;
                    line-height: 1.5385;
                    color: #333;'>
                    <thead class="bg-slate-800">
                        <tr>
                            <th style="text-align:center;"> ประเภทเครื่องจักรที่ขอยืม </th>
                            <th style="text-align:right;"> <div class="row"><select style="width:100%" class="form-control" id="selectMcType" name="selectMcType" onchange="confirmSelectMcType()" ></select> </div></th>
                            <th style="text-align:center" id="submitAppears">Date</th>

                        </tr>
                    </thead>
                    <tbody id="tfDetails">
                        <tr id="mcTypeDetails">
                        </tr>
                    </tbody>
                    <tbody id="machineTypeTransferDetails">
                    </tbody>
                    </table>

                </div>
            </div> 

        </div>  
    </div>

    </form>    



<!-- /footer -->

</div>
<?php
include "../footer.php";
?>
<!-- /main content -->

</div>
<!-- /main content -->

</div>

<!-- Horizontal form modal -->
                <div class="modal fade" id="myModal" role="dialog">
                  <div class="modal-dialog modal-xl">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <iframe id="myframeprint"  style="height: 1200px;width: 100%;" frameborder="0" src="" ></iframe>
                    </div>
                    </div>
                </div>

<!--         <script type="text/javascript">
   function CloseWindow() {
//        $("#iframe").remove();
   alert('ggggg');
   }
</script>-->
<script>


    function fram() {

        $('#modalDialog').modal('hide');
    }
    function framloca() {
        $('#modalDialogLC').modal('hide');
    }

    function framstore() {
        $('#modalDialogST').modal('hide');
    }

    function setModal() {
      //            $("#iframe").show();
      var src = "service_store/get_inv_adj.php";
      $("#iframe").attr('src', src);
  }

  function setModalST() {
    var src = "service_store/get_store_adj.php";
    $("#iframeST").attr('src', src);
}

function setModalLC() {
   var store =  $("#store_code").val();
//                 alert(store);
var src = "service_store/get_loca_adj.php?store_code=" +store;
$("#iframeLC").attr('src', src);
}

</script>
</body>
</html>