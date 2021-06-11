<? 
session_start();
require_once '../../classes/Connect.php';
$conn = new Connect(); 
 
$tx_id = $_GET['tx_id'];
$mc_type = $_GET['mc_type'];

$session_username = $_SESSION['username'];

$personal_lang = "select * from hr where code = '{$session_username}'";
$rs = $conn->query($personal_lang);
$row = $conn->parseArray($rs);

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
if($row['language']=='eng'){
	include $eng_lang_count;

}else{

	include $th_lang_count;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	 <title>PMII Maintenance Solution</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="../../global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="../../full/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="../../full/assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="../../full/assets/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="../../full/assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="../../full/assets/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	  <!-- Core JS files -->
        <script src="../../global_assets/js/main/jquery.min.js"></script>
        <script src="../../global_assets/js/main/bootstrap.bundle.min.js"></script>
        <script src="../../global_assets/js/plugins/loaders/blockui.min.js"></script>
        <!-- /core JS files -->

        <!-- Theme JS files -->
        <script src="../../global_assets/js/plugins/visualization/d3/d3.min.js"></script>
        <script src="../../global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
        <!--<script src="../../global_assets/js/plugins/forms/styling/switchery.min.js"></script>-->
        <script src="../../global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
        <script src="../../global_assets/js/plugins/ui/moment/moment.min.js"></script>
        <script src="../../global_assets/js/plugins/pickers/daterangepicker.js"></script>
        <script src="../../global_assets/js/plugins/ui/perfect_scrollbar.min.js"></script>

        <script src="../../full/assets/js/app.js"></script>
        <script src="../../global_assets/js/demo_pages/dashboard.js"></script>
        <script src="../../global_assets/js/demo_pages/layout_fixed_sidebar_custom.js"></script>
        <!-- /theme JS files -->
        <link href="../../include/wizard/css/progress-wizard.min.css" rel="stylesheet">
        <script src="../../global_assets/js/plugins/extensions/jquery_ui/interactions.min.js"></script>
        <script src="../../global_assets/js/demo_pages/form_select2.js"></script>
        <script src="../../global_assets/js/demo_pages/picker_date.js"></script>

        <script src="../../global_assets/js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
        <link href="../../style/my.css" rel="stylesheet">
        <script src="../../global_assets/js/plugins/forms/selects/select2.min.js"></script>
        <script src="../../global_assets/js/plugins/forms/styling/uniform.min.js"></script>
        <script src="../../global_assets/js/demo_pages/form_checkboxes_radios.js"></script>
        <script src="../../global_assets/js/demo_pages/form_layouts.js"></script>

        <script src="../../global_assets/js/demo_pages/dashboard.js"></script>
        <script src="../../global_assets/js/demo_pages/layout_fixed_sidebar_custom.js"></script>
        <script src="../../global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
        <script src="../../global_assets/js/demo_pages/datatables_basic.js"></script>
        <script src="../../global_assets/js/plugins/forms/styling/uniform.min.js"></script>
        <script src="../../global_assets/js/demo_pages/form_checkboxes_radios.js"></script>
        <script src="../../global_assets/js/plugins/forms/selects/select2.min.js"></script>
        <script src="../../global_assets/js/demo_pages/form_layouts.js"></script>
        <script src="../../global_assets/js/plugins/uploaders/dropzone.min.js"></script>
        <script src="../../global_assets/js/plugins/pickers/pickadate/picker.js"></script>
        <script src="../../global_assets/js/plugins/ui/moment/moment.min.js"></script>
        <script src="../../global_assets/js/plugins/pickers/daterangepicker.js"></script>
        <script src="../../global_assets/js/plugins/pickers/anytime.min.js"></script>
        <script src="../../global_assets/js/plugins/pickers/pickadate/picker.date.js"></script>
        <script src="../../global_assets/js/plugins/pickers/pickadate/picker.time.js"></script>
        <script src="../../global_assets/js/plugins/pickers/pickadate/legacy.js"></script>
        <script src="../../global_assets/js/plugins/notifications/jgrowl.min.js"></script>

        <script src="../../global_assets/js/plugins/extensions/jquery_ui/interactions.min.js"></script>
        <script src="../../global_assets/js/demo_pages/form_select2.js"></script>
        <script src="../../global_assets/js/demo_pages/picker_date.js"></script>

        <script src="../../global_assets/js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
        <link href="../../style/my.css" rel="stylesheet">

        <script src="../../global_assets/js/plugins/notifications/bootbox.min.js"></script>
         <script src="../../include/excel/excel.js"></script>

        
        <style  type="text/css">
            .table-lg td, .table-lg th{
                padding: 2px;
               
            }
           .table-lg th{
               
                font-weight: bold;
               
            }
            
            .table-lg tr th{
                border: 1px solid #b7b7b7;
                border-top: 1px solid #b7b7b7;
            }
            
             .table-lg tr td{
                border: 1px solid #b7b7b7;
            }
            
           
           
            @media print {
            .card-header {
              display: none !important;
            }
          }
          
          
            
        </style>
<script>
     
            var allMcSelected = [];
            var allMcRemove = [];
            var tx_id = "<? echo $_GET['tx_id'] ?>";
            var mc_type = "<? echo $_GET['mc_type'] ?>";
            $(document).ready(function(){
            var limit = 100;
            $.get("../api/get_available_machines.php",{mc_type:mc_type,limit:limit},function(data){
                json = $.parseJSON(data);
                
                
                
                for( var i = 0; i< json.countMcDetails ; i++){
                    
                    var checkBoxSelectMc = "selectCheckBox('"+json.dataDetails[i]['mc_code']+"')";
                    
                    $("#tbody").append("<tr>");
                    $("#tbody").append("<td><input id='mcSelected"+json.dataDetails[i]['mc_code']+"' name='mcSelected[]' onclick="+checkBoxSelectMc+"  class='form-control' value='"+json.dataDetails[i]['mc_code']+"' type='checkbox' /></td>");
                    $("#tbody").append("<td onclick="+onclick+" style='cursor:pointer' >"+json.dataDetails[i]['mc_code']+"</td>");
                    $("#tbody").append("<td>"+json.dataDetails[i]['nameth']+"</td>");
                    $("#tbody").append("<td>"+json.dataDetails[i]['nameen']+"</td>");
                    $("#tbody").append("<td>"+json.dataDetails[i]['mc_type']+"</td>");
                    $("#tbody").append("<td>"+json.dataDetails[i]['mc_dept']+"</td>");
                    $("#tbody").append("<td>"+json.dataDetails[i]['mc_locaiton']+"</td>");
                    $("#tbody").append("<tr>");
                }
 
            });
            
            $.get("../api/get_machine_selected.php",{tx_id:tx_id,mc_type:mc_type},function(data){
                json = $.parseJSON(data);
                
                for( var i = 0; i< json.count ; i++){
                    
                    var onclickRemove = "removeCheckBox('"+json.data[i]['mc_code']+"')";
                    
                    $("#tbodySelected").append("<tr>");
                    $("#tbodySelected").append("<td><input id='mcRemove"+json.data[i]['mc_code']+"' name='mcRemove[]' onclick="+onclickRemove+"  class='form-control' value='"+json.data[i]['mc_code']+"' type='checkbox' /></td>");
                    $("#tbodySelected").append("<td onclick="+onclick+" style='cursor:pointer' >"+json.data[i]['mc_code']+"</td>");
                    $("#tbodySelected").append("<td>"+json.data[i]['nameth']+"</td>");
                    $("#tbodySelected").append("<td>"+json.data[i]['nameen']+"</td>");
                    $("#tbodySelected").append("<td>"+json.data[i]['machine_type']+"</td>");
                    $("#tbodySelected").append("<td>"+json.data[i]['machine_dept']+"</td>");
                    $("#tbodySelected").append("<td>"+json.data[i]['mc_locaiton']+"</td>");
                    $("#tbodySelected").append("<tr>");
                }
            });
            
            
        });
        
        function onSearch(){
        var search = $("#search").val();
        }

 function removeCheckBox(mc_code) {
     
     
         if($("#mcRemove"+mc_code).is(":checked")){
             allMcRemove.push(mc_code);
         }
         if(!$("#mcRemove"+mc_code).is(":checked")){
             
            for(i=0;i<allMcRemove.length;i++ ){
                    if ( allMcRemove[i] == mc_code) { 
                        allMcRemove.splice(i, 1);
                    }
         }
     }
//      machineSelected()
    }
 
        
 function selectCheckBox(mc_code) {
         if($("#mcSelected"+mc_code).is(":checked")){
             allMcSelected.push(mc_code);
         }
         if(!$("#mcSelected"+mc_code).is(":checked")){
             
            for(i=0;i<allMcSelected.length;i++ ){
                    if ( allMcSelected[i] == mc_code) { 
                        allMcSelected.splice(i, 1);
                    }
         }
     }
//      machineSelected()
    }
 
        
        function machineSelected(){

            $.post("../api/insert_machine_tx_details_transfer.php",{allMcSelected:allMcSelected,tx_id:tx_id},function(data){
                json = $.parseJSON(data);
                
                if(json=='1'){
                alert('Successfully inserted');    
                window.location.replace(window.location.href);
                }else{
                    alert("These following machines cannot be selected : "+json);
                    window.location.replace(window.location.href);
                }
                        
            });
                
        }
        
        function machineRemoved(){

//alert('asdfasdf');

            $.post("../api/delete_machine_tx_details_transfer.php",{allMcRemove:allMcRemove,tx_id:tx_id},function(data){
                json = $.parseJSON(data);
                
                if(json=='0'){
                alert('No machine selected for a removal ');    
                }
                if(json=='1'){
                alert('Machine Removed');    
                window.location.replace(window.location.href);
                }

            });
                
        }
        
 
        </script>   
</head>

<body >
    <div class="content-wrapper">
            <div class="content">
                <div class="card">
                    <div class="card-header bg-white header-elements-sm-inline">
                        <h5 class="card-title">Machine Available To Transfer</h5>
                        <div class="header-elements">
                             
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7">
                                <div style="margin-left: 12px;" class="form-group row">
                                    <div class="col-sm-2"> 
                                        <label  class="col-form-label"><? echo 'Search Machine' ; ?>:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input id="search" onkeypress="if (event.keyCode == 13) {
                                                        onSearch();
                                                    }" name="search" type="text" class="form-control " placeholder="<? echo $mse_to_search ; ?>..."> 
                                            <span class="input-group-append">
                                                <span onclick="onSearch()" class="input-group-text btn btn-light"><i class="icon-search4 font-size-sm"></i></span>
                                            </span>                                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span id="allMcSelected" ></span>
                            <div class="col-5">
                                <div style="float: right;margin-right: 0px;" class="form-group row">
                                    <label class="col-form-label"><? echo $mse_shows ; ?>:</label>
                                    <select  class="select2-selection--single breadcrumb-elements-item dropdown-toggle "   name="limit" id="limit" 
                                             style="padding-left: 10px;width: 60px;margin-left: 0.8125rem;" onchange="onSearch()">
                                        <option   <?php if ($_GET['limit'] == "10") echo "selected=''" ?> value="10">10</option>
                                        <option <?php if ($_GET['limit'] == "25") echo "selected=''" ?> value="25">25</option>
                                        <option <?php if ($_GET['limit'] == "50") echo "selected=''" ?> value="50">50</option>
                                        <option <?php if ($_GET['limit'] == "100") echo "selected=''" ?> value="100">100</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            
                            <table class="table table-hover table-xs table-bordered" id="selectedLists" >
                                <span>Machines Selected for Transfer No.<? echo $_GET['tx_id'] ?></span>
                                <thead  class="bg-slate-800">
                                    <tr>
                                        <td colspan="4" style="text-align:center"><b>Selected Machine</b></td>
                                        <td colspan="1" style="text-align:right">Click to remove</td>
                                        <td colspan="2"><span style="text-align:right;"><input  onclick="machineRemoved()" class="form-control btn-danger" type="button" value="Remove" ></span></td>
                                    </tr>
                                    <tr align="center">
                                        <th  style="font-weight: normal; width: 5%;text-align: center;">#</th>
                                        <th style="font-weight: normal; cursor: pointer" onclick="onSearch('1', 'code', true)"><? echo $mse_code ; ?></th>
                                        <th style="font-weight: normal; cursor: pointer" onclick="onSearch('1', 'nameth', true)"><?echo $mse_nameTH ;?></th>
                                        <th style="font-weight: normal;; cursor: pointer" onclick="onSearch('1', 'nameen', true)"><? echo $mse_nameEN ; ?></th> 
                                        <th style="font-weight: normal;;text-align: center; cursor: pointer" onclick="onSearch('1', 'status', true)"><? echo 'Type' ; ?></th>
                                        <th style="font-weight: normal;;text-align: center; cursor: pointer" onclick="onSearch('1', 'status', true)"><? echo 'Department' ; ?></th>
                                        <th style="font-weight: normal;;text-align: center; cursor: pointer" onclick="onSearch('1', 'status', true)"><? echo 'Location' ; ?></th>
                                    </tr>
                                </thead>
                                <tbody id="tbodySelected">
 
                                </tbody>
                            </table>
                            
                            <table class="table table-hover table-xs table-bordered" style="margin-top:3rem">
                                <thead  class="bg-slate-800">
                                    <tr>
                                        <td colspan="4" style="text-align:center"><b>Available Machine</b></td>
                                        <td colspan="1" style="text-align:right">Click to select</td>
                                        <td colspan="2"><span style="text-align:right;"><input  onclick="machineSelected()" class="form-control btn-primary" type="button" value="Select" ></span></td>
                                    </tr>
                                    <tr align="center">
                                        <!--<th  style="font-weight: normal; width: 5%;text-align: center;">#</th>-->
                                        <th style="font-weight: normal; cursor: pointer" onclick="onSearch('1', 'code', true)"><? echo '#' ; ?></th>
                                        <th style="font-weight: normal; cursor: pointer" onclick="onSearch('1', 'code', true)"><? echo $mse_code ; ?></th>
                                        <th style="font-weight: normal; cursor: pointer" onclick="onSearch('1', 'nameth', true)"><?echo $mse_nameTH ;?></th>
                                        <th style="font-weight: normal;; cursor: pointer" onclick="onSearch('1', 'nameen', true)"><? echo $mse_nameEN ; ?></th> 
                                        <!-- <th style="font-weight: normal; cursor: pointer" onclick="onSearch('1', 'machine.nameth', true)">เครื่องจักร</th> -->
                                        <th style="font-weight: normal;;text-align: center; cursor: pointer" onclick="onSearch('1', 'status', true)"><? echo 'Type' ; ?></th>
                                        <th style="font-weight: normal;;text-align: center; cursor: pointer" onclick="onSearch('1', 'status', true)"><? echo 'Department' ; ?></th>
                                        <th style="font-weight: normal;;text-align: center; cursor: pointer" onclick="onSearch('1', 'status', true)"><? echo 'Location' ; ?></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
 
                                </tbody>
                                
                                
                            </table>
                        </div>     
                        <div class="datatable-footer">
                            <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite"><? echo $mse_showing ; ?> <label id="page_start" > 1 </label> <? echo $mse_to ; ?>  <label id="page_end" > 10  </label>  <? echo $mse_from ; ?> <label id="all_unit"  ></label> <? echo $mse_lists ; ?></div>
                            <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                <a id="previous" class="paginate_button previous" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" id="DataTables_Table_0_previous">←</a>
                                <span id="pagination">
                                </span>
                                <a id="next" class="paginate_button next" aria-controls="DataTables_Table_0" data-dt-idx="3" tabindex="0" id="DataTables_Table_0_next">→</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                                        
</body>
</html>
