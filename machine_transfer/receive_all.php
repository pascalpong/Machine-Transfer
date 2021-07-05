<?php
session_start();
$_SESSION['sidebar'] = 'machine_transfer';
require_once '../classes/Connect.php';
$conn = new Connect();

$_GET['txtype'] = $conn->detectParam($_GET['txtype']);
//echo $_GET['txtype'];
//exit();
?>
<?php






    ?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>PMII Maintenance Solution</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
        <link href="../global_assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
        <link href="../full/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="../full/assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
        <link href="../full/assets/css/layout.min.css" rel="stylesheet" type="text/css">
        <link href="../full/assets/css/components.min.css" rel="stylesheet" type="text/css">
        <link href="../full/assets/css/colors.min.css" rel="stylesheet" type="text/css">
        <script src="../global_assets/js/main/jquery.min.js"></script>
        <script src="../global_assets/js/main/bootstrap.bundle.min.js"></script>
        <script src="../global_assets/js/plugins/loaders/blockui.min.js"></script>
        <script src="../global_assets/js/plugins/visualization/d3/d3.min.js"></script>
        <script src="../global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
        <script src="../global_assets/js/plugins/forms/styling/switchery.min.js"></script>
        <script src="../global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
        <script src="../global_assets/js/plugins/ui/moment/moment.min.js"></script>
        <script src="../global_assets/js/plugins/pickers/daterangepicker.js"></script>
        <script src="../global_assets/js/plugins/ui/perfect_scrollbar.min.js"></script>
        <script src="../full/assets/js/app.js"></script>
        <script src="../global_assets/js/demo_pages/dashboard.js"></script>
        <script src="../global_assets/js/demo_pages/layout_fixed_sidebar_custom.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function () {
                setDataTable();
            });

            function setDataTable() {
                var $_GET = <?php echo json_encode($_GET); ?>;
                var search = $_GET.search != null ? $_GET.search : "";
                var page = $_GET.page != null ? $_GET.page : 1;
                var limit = $_GET.limit != null ? $_GET.limit : 10;
                var txtype = $_GET.txtype != null ? $_GET.txtype : "";
//                var tex = 
                var linkfromx = "receive_transfer?id="   ;
//                alert(linkfromx) ;
                document.getElementById('search').value = search;
                $.get('api/get_machine_tx_approved.php', {search: search, page: page, limit: limit,txtype: txtype}, function (data) {
                    json = $.parseJSON(data);
                    var kuymax = parseInt('1');
                    if(json.data==''||json.data==null){
                        var count = 0;
                    }else{
                        var count = json.data.length;
                    }

                    for (i = 0; i < count; i++) {
                      var run=  kuymax+i ;
                        $("#tbody").append("<tr style='text-align: left;cursor: pointer;'   >");
                        $("#tbody").append("<td style='text-align: left;cursor: pointer;'  onclick='"+'javascript:window.location.href="' + linkfromx +  json.data[i]['tx_id'] +'"' + "'>" + run + " </td>");
                        $("#tbody").append("<td style='text-align: left;cursor: pointer;' onclick='"+'javascript:window.location.href="' + linkfromx +  json.data[i]['tx_id'] +'"' + "'>"+   json.data[i]['create_ts']   +  "</td>");

//                        $("#tbody").append("<td style='text-align: left;width:20%;cursor: pointer;'>" + data.data[i]['tx_date'] + "</td>");
                        $("#tbody").append("<td style='cursor: pointer;'  onclick='"+'javascript:window.location.href="' + linkfromx +  json.data[i]['tx_id'] +'"' + "'>" + json.data[i]['docno'] + "</td>");
                        $("#tbody").append("<td style='cursor: pointer;'  onclick='"+'javascript:window.location.href="' + linkfromx +  json.data[i]['tx_id'] +'"' + "'>" + json.data[i]['tx_id'] + "</td>");
                        $("#tbody").append("<td style='cursor: pointer;'  onclick='"+'javascript:window.location.href="' + linkfromx +  json.data[i]['tx_id'] +'"' + "'>" + json.data[i]['etc'] + "</td>");
                        $("#tbody").append("</tr>");

                 }
                    setPagination(data.count_page, data.page, data.count_item, limit);
                        
                    window.setTimeout(function () {
                        var light = $('#load').closest('.card');
                        $(light).unblock();
                    }, 250);
                }
                );
            }

            function oo(){
            alert('ggg');
            }

            function setPagination(count_page, page, count_item, limit) {
                count_page = parseInt(count_page);
                count_item = parseInt(count_item);
                page = parseInt(page);
                var pageLimit = 15;
                var pageLast = 7;
                $("#all_unit").html(count_item);
                if (count_item == 0) {
                    $("#page_start").html(0);
                } else {
                    $("#page_start").html((page * limit) - limit + 1);
                }
                if (page * limit > count_item) {
                    $("#page_end").html(count_item);
                } else {
                    $("#page_end").html(page * limit);
                }
                if (count_page < pageLimit + 1) {
                    setPagination(1, count_page + 1);
                } else if (page < pageLimit - pageLast) {
                    setPagination(1, pageLimit + 1);
                } else if (page > count_page - pageLimit) {
                    setPagination(count_page - pageLimit, count_page + 1);
                } else {
                    setPagination(page - pageLast, page + pageLimit - pageLast);
                }
                document.getElementById("previous").onclick = function () {
                    onSearch();
                };
                document.getElementById("next").onclick = function () {
                    onSearch(count_page);
                };
                function setPagination(start, end) {
                    for (i = start; i < end; i++) {
                        if (page == i) {
                            $("#pagination").append('<a class="paginate_button current" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0">' + i + '</a>');
                        } else {
                            $("#pagination").append('<a onclick="onSearch(' + i + ')" class="paginate_button" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0">' + i + '</a>');
                        }
                    }
                }

            }

            function onSearch(page) {
                
                var $_GET = <?php echo json_encode($_GET); ?>;
                
                var txtype = $_GET.txtype != null ? $_GET.txtype : "";
                page = page != null ? page : 1;
                var limit = document.getElementById("limit").value;
                var search = document.getElementById("search").value;
                window.location.href = "list_all?search=" + search + "&page=" + page + "&limit=" + limit  + "&txtype=" + txtype ;
            }

            function onSearchEnter(event) {
                if (event.keyCode == 13) {
                    onSearch();
                }
            }

        </script>
    </head>
    <!DOCTYPE html>
     

    <body class="navbar-top">
               <style type="text/css">
            html,body{
/*                maring:0;padding:0;
                font-family:tahoma, "Microsoft Sans Serif", sans-serif, Verdana;   
                font-size:14px;*/
            }
            .fullcalendar-basicx{
                width: 100%;

                /*margin: 0 auto;*/
                font-size:16px;
            }     

            table tr th{
                text-align: center;

            }



        </style>
        <?php if ($_SESSION['username'] == NULL) { ?>
            <script>
                window.location.href = '../login';
            </script>   
            <?php
        }
        include "../navbar.php";
        ?>
        <div class="page-content">
            <?php
            include "../sidebar.php";
            ?>
            <div class="content-wrapper">
                <div class="page-header page-header-light">
                    
                   
                </div>
                <div class="content">
                    <div id="load" class="card">
                       <div class="card-header header-elements-inline">
                           <h5 class="card-title"><?php echo $typedetails;?></h5>
                            <div class="header-elements">
                                <div class="btn btn-link btn-float text-default">
                                     
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div style="margin-left: 12px;" class="form-group row">
                                        <div class="col-lg-1"> 
                                            <label  class="col-form-label">ค้นหา:</label>
                                        </div>
                                        <div class="col-lg-11">
                                            <div class="input-group">
                                                <input id="search" onkeypress="onSearchEnter(event)" name="search" type="text" class="form-control " placeholder="พิมพ์เพื่อค้นหา..."> 
                                                <span class="input-group-append">
                                                    <button onclick="onSearch()" class="btn btn-light btn-icon" type="submit"><i class="icon-search4 font-size-sm"></i></button>
                                                </span>                                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 ">
                                    <div style="float: right;margin-right: 0px;" class="form-group row">
                                        <label class="col-form-label">แสดง</label>
                                        <select  class="select2-selection--single breadcrumb-elements-item dropdown-toggle "   name="limit" id="limit" style="padding-left: 10px;width: 60px;margin-left: 0.8125rem;" onchange="onSearch()">
                                            <option   <?php if ($_GET['limit'] == "10") echo "selected=''" ?> value="10">10</option>
                                            <option <?php if ($_GET['limit'] == "25") echo "selected=''" ?> value="25">25</option>
                                            <option <?php if ($_GET['limit'] == "50") echo "selected=''" ?> value="50">50</option>
                                            <option <?php if ($_GET['limit'] == "100") echo "selected=''" ?> value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table  table-xs table-bordered" style='font-family: Roboto,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
                                       font-size: 13px;
                                       font-weight: 400;
                                       line-height: 1.5385;
                                       color: #333;'>
                                    <thead class="bg-slate-800">
                                        <tr>
                                            <th style="width: 5%;text-align: center;">#</th>
                                            <th style="width: 15%;text-align: center;">วันที่</th>
                                            <th style="width: 20%;">เลขที่อ้างอิง</th>
                                            <th>เลขที่เอกสาร</th>
                                            <th>รายละเอียด</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                    </tbody>
                                </table>
                            </div>     
                            <div class="datatable-footer">
                                <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">กำลังแสดง <label id="page_start" > 1 </label> ถึง  <label id="page_end" > 10  </label>  จาก <label id="all_unit"  ></label> รายการ</div>
                                <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                    <a id="previous" class="paginate_button previous" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" id="DataTables_Table_0_previous">←</a>
                                    <span id="pagination">
                                    </span>
                                    <a id="next" class="paginate_button next" aria-controls="DataTables_Table_0" data-dt-idx="3" tabindex="0" id="DataTables_Table_0_next">→</a>
                                </div>
                            </div>
                        </div>
                        <div class="blockUI" style="display:none"></div>
                        <div class="blockUI blockOverlay" style="z-index: 1000; border: none; margin: 0px; padding: 0px; width: 100%; height: 100%; top: 0px; left: 0px; background-color: rgb(255, 255, 255); opacity: 0.8; cursor: wait; position: absolute;"></div>
                        <div class="blockUI blockMsg blockElement" style="z-index: 1011; position: absolute; padding: 0px; margin: 0px; width: 30%; top: 123.5px; left: 451px; text-align: center; color: rgb(0, 0, 0); border: 0px; cursor: wait;"><i class="icon-spinner spinner"></i></div>
                    </div>
                </div> 
                <?php
               include "../footer.php";
                ?>
            </div>
        </div>
    </body>
</html>
