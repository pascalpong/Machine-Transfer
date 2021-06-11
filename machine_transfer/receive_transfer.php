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
        
                                     $.get("api/get_machine_tx_details_info_approved.php",{tx_id:json['tx_id']},function(data){
                                         json = $.parseJSON(data);
                                         
                                         if(json.count <= 0){
                                             
                                        }else{
                                         $("#machineTypeTransferDetails").show();
                                            for(a=0;a<json.count;a++){

                                                $("#machineTypeTransferDetails").append("<tr>");
                                                var onclickCheck = "toAssign('"+json.data[a]['mc_code']+"')"

                                                var inputCheckBox = "<input class='form-control' style='width:100%' onclick="+onclickCheck+" type='checkbox' value='"+json.data[a]['mc_code']+"' />"
                                                $("#machineTypeTransferDetails").append("<td>"+inputCheckBox+"</td>");
                                                $("#machineTypeTransferDetails").append("<td>"+json.data[a]['mc_type']+"</td>");
                                                $("#machineTypeTransferDetails").append("<td>"+json.data[a]['mc_code']+"</td>");
                                                $("#machineTypeTransferDetails").append("<td>"+json.data[a]['mc_dept']+"</td>");
                                                $("#machineTypeTransferDetails").append("<td>"+json.data[a]['mc_room']+"</td>");
                                                $("#machineTypeTransferDetails").append("<td>"+json.data[a]['mc_location']+"</td>");
                                                $("#machineTypeTransferDetails").append("<td>"+json.data[a]['factory']+"</td>");
                                                $("#machineTypeTransferDetails").append("<td>"+json.data[a]['transfer_ts']+"</td>");
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

                    var tx_id = "<?php echo $_GET['id'] ?>";

                    $( document ).ready(function() {

                        getDept();
 
                    });

                    function toAssign(mc_code){
                        var mc_dept = $("#newDept").val();
                        var mc_location = $("#newLocation").val();
                        var mc_room = $("#newRoom").val();


                        if($("#newLocation").val()==''||$("#newLocation").val()==null){
                            alert('Please select a locaiton to assign this machine to first');
                            return false;
                        }else{
                            $.post("api/insert_machine_tx_history",{tx_id:'<?php echo $_GET['id'] ?>',mc_code:mc_code,mc_location:mc_location,mc_room:mc_room,mc_dept:mc_dept},function(data){
                                json = $.parseJSON(data);

                            });
                        }

                    }

                    function getDept(){

                       $.get("api/get_department_by_borrowing_factory.php",{tx_id:tx_id},function(data){
                            json = $.parseJSON(data);

                            // alert(json.data.length);
                                $("#newDept").append("<option>"+"Please Select a Machine Department"+"</option>");
                            for(i=0;i<json.data.length;i++){
                                // alert(json.data[i]['code']);
                                $("#newDept").append("<option value='"+json.data[i]['code']+"'>"+json.data[i]['code']+" : "+json.data[i]['nameth']+"</option>");
                            }
 
                        }); 
                    }

                    function afterDept(){
                        $("#newRoom").empty();
                        var mcDept = $("#newDept").val();

                        $.get("../data/machine/api/get_room_by_dept.php",{mc_dept:mcDept},function(data){
                            json = $.parseJSON(data);
                                $("#newRoom").append("<option value=''>"+"Please Select a Machine Room"+"</option>");
                             for(i=0;i<json.data.length;i++){
                                $("#newRoom").append("<option value='"+json.data[i]['code']+"'>"+json.data[i]['code']+" : "+json.data[i]['nameth']+"</option>");
                             }

                        });
                    }

                    function afterRoom(){
                        $("#newLocation").empty();
                        var mcRoom = $("#newRoom").val();

                        $.get("api/get_mc_location_by_room.php",{mc_room:mcRoom},function(data){
                            json = $.parseJSON(data);
                                $("#newLocation").append("<option value=''>"+"Please Select a Machine Location"+"</option>");
                             for(i=0;i<json.data.length;i++){
                                $("#newLocation").append("<option value='"+json.data[i]['code']+"'>"+json.data[i]['code']+" : "+json.data[i]['nameth']+"</option>");
                             }

                        });
                    }

                    
                    function selectMachineToLend(mc_type){
                                var tx_id = '<? echo $_GET['id'] ?>';
                            $("#myModal").modal();
                            $("#myframeprint").attr("src", "modal/machine_lists.php?tx_id="+tx_id+"&mc_type="+mc_type);
                    }

                    function assignSelectedMachines(){

                        var dept = $("#newDept").val();
                        var room = $("#newRoom").val();
                        var loca = $("#newLocation").val();

                        if(dept == '' || dept == null || room == '' || room == null || loca == '' || loca == null){
                            alert('กรุณา');
                        }


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
                    <span class="font-weight-semibold">TRANSFER TO : </span>
                    <table class="table  table-xs table-bordered table-framed" style='font-family: Roboto,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
                    font-size: .8125rem;
                    font-weight: 400;
                    line-height: 1.5385;
                    color: #333;'>
                    <thead class="bg-slate-800">
                        <tr style="width:100%">
                            <th style="text-align:center;width:20%"> Department : <select class="form-control" id="newDept" onchange="afterDept()" ></select> </th>
                            <th style="text-align:center;width:20%"> Room : <select class="form-control" id="newRoom" onchange="afterRoom()" ></select></th>
                            <th style="text-align:center;width:20%"> Location : <select class="form-control" id="newLocation" ></select></th>
                            <th style="text-align:center;width:5%"><input style="width:100%" class="btn btn-primary" type="button" id="assign" onclick="assignSelectedMachines()" value="Submit" name=""></th>

                        </tr>
                    </thead>
                     
                    <tbody id="assignNew">
                    </tbody>
                    </table>

                </div>
            </div> 

        </div>  
    </div>



<div  id="detailsMachineTx"  class="card">
        <div class="card-body">
            <div class="row">
                <div class="table-responsive">
                    <span class="font-weight-semibold">TRANSFER TO : </span>
                    <table class="table  table-xs table-bordered table-framed" style='font-family: Roboto,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
                    font-size: .8125rem;
                    font-weight: 400;
                    line-height: 1.5385;
                    color: #333;'>
                    <thead class="bg-slate-800" id='transferReady'>
                        <!-- <tr style="width:100%">
                            <th style="text-align:center;width:20%" id="deptShown"></th>
                            <th style="text-align:center;width:20%" id="roomShown"></th>
                            <th style="text-align:center;width:20%" id="locationShown"></th>
                            <th style="text-align:center;width:5%" id="#"></th>
                        </tr> -->
                    </thead>
                     
                    <tbody id="transferReadyInfo">
                    </tbody>
                    </table>

                </div>
            </div> 

        </div>  
    </div>



 
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
                        <tr style="width:100%">
                            <th style="text-align:center;width:5%"> # </th>
                            <th style="text-align:center;width:10%"> Machine type </th>
                            <th style="text-align:center;width:20%"> Machine Code </th>
                            <th style="text-align:center;width:15%"> Machine Department </th>
                            <th style="text-align:center;width:15%"> Machine Room </th>
                            <th style="text-align:center;width:15%"> Machine Location </th>
                            <th style="text-align:center;width:15%"> Machine Factory </th>
                            <th style="text-align:center;width:15%" id="submitAppears">Date</th>

                        </tr>
                    </thead>
                     
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