<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <title>JCORE - <?php echo $title; ?></title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="Avenxo Admin Theme">
    <meta name="author" content="">

    <?php echo $_def_css_files; ?>

    <link rel="stylesheet" href="assets/plugins/spinner/dist/ladda-themeless.min.css">
    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet">
    <link type="text/css" href="assets/plugins/datatables/dataTables.themify.css" rel="stylesheet">
    <link href="assets/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <style>
        .select2-container{
            min-width: 100%;
        }


        .select2-dropdown{
            z-index: 9999999999;
        }

        .datepicker-dropdown{
            z-index: 9999999999;
        }

        .dropdown-menu{
            z-index: 9999999999;
        }

        .glyphicon.spinning {
            animation: spin 1s infinite linear;
            -webkit-animation: spin2 1s infinite linear;
        }

        @keyframes spin {
            from { transform: scale(1) rotate(0deg); }
            to { transform: scale(1) rotate(360deg); }
        }

        @-webkit-keyframes spin2 {
            from { -webkit-transform: rotate(0deg); }
            to { -webkit-transform: rotate(360deg); }
        }

    </style>

</head>

<body class="animated-content">

<?php echo $_top_navigation; ?>

<div id="wrapper">
    <div id="layout-static">

        <?php echo $_side_bar_navigation;?>

        <div class="static-content-wrapper white-bg">
            <div class="static-content"  >
                <div class="page-content"><!-- #page-content -->
                    <ol class="breadcrumb" style="margin:0%;">
                        <li><a href="dashboard">Dashboard</a></li>
                        <li><a href="Supplier_subsidiary_detailed">Supplier Subsidiary (Detailed)</a></li>
                    </ol>
                    <div class="container-fluid">
                        <div data-widget-group="group1">

                            <div id="modal_bsheet" class="modal fade" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" style="color: white;">Supplier Subsidiary (Detailed)</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                 <b class="required">*</b> Choose <b>Admin</b> to use all branches/departments .<br>
                                                    Account : <br />
                                                    <select id="cbo_accounts" class="form-control">
                                                        <?php foreach($account_titles as $account){ ?>
                                                            <option value="<?php echo $account->account_id; ?>" <?php echo ($ap_account==$account->account_id?'selected':''); ?>><?php echo $account->account_title; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <br />
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    Start Date : <br />
                                                    <div class="input-group">
                                                        <input type="text" id="txt_date" name="date_from" class="date-picker form-control" value="01/01/<?php echo date("Y"); ?>">
                                                         <span class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                         </span>
                                                    </div>
                                                </div>
                                            </div><br />

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    End Date : <br />
                                                    <div class="input-group">
                                                        <input type="text" id="txt_date" name="date_to" class="date-picker form-control" value="<?php echo date("m/d/Y"); ?>">
                                                         <span class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                         </span>
                                                    </div>
                                                </div>
                                            </div><br />





                                        </div>
                                        <div class="modal-footer">
                                            <div class="col-xs-12">
                                                <a id="btn_print" href="#" target="_blank" class="btn btn-green" style="text-transform:none;font-family: tahoma;" title=" Print" ><i class="fa fa-print"></i> Print </a>
                                                <button id="btn_export" class="btn btn-primary" title="All departments"><i class="fa fa-file-excel-o"></i> Export to Excel</button>
<!--                                                 <a href="Templates/layout/income-statement?type=&type=pdf" class="btn btn-primary" style="text-transform:none;font-family: tahoma;" ><i class="fa fa-file-pdf-o"></i> Download as PDF </a> -->
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> <!-- .container-fluid -->
                </div> <!-- #page-content -->
            </div>
            <footer role="contentinfo">
                <div class="clearfix">
                    <ul class="list-unstyled list-inline pull-left">
                        <li><h6 style="margin: 0;">&copy; 2018 - JDEV OFFICE SOLUTION</h6></li>
                    </ul>
                    <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i class="ti ti-arrow-up"></i></button>
                </div>
            </footer>
        </div>
    </div>
</div>


<?php echo $_switcher_settings; ?>
<?php echo $_def_js_files; ?>


<!-- Select2 -->
<script src="assets/plugins/select2/select2.full.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        var _cboAccounts;
        var _date_from = $('input[name="date_from"]');
        var _date_to = $('input[name="date_to"]');
        var _modal_filter = $('#modal_bsheet');
        $('.date-picker').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });

        _cboAccounts=$("#cbo_accounts").select2({
            placeholder: "Please select accounts.",
            allowClear: true
        });


        $('#btn_export').click(function(){
            window.open('Supplier_Subsidiary/transaction/get-supplier-subsidiary-all-export?accountId='+_cboAccounts.val()+'&startDate='+_date_from.val()+'&endDate='+_date_to.val());
        });


    var showSpinningProgress=function(e){
        $(e).toggleClass('disabled');
        $(e).find('span').toggleClass('glyphicon glyphicon-refresh spinning');
    };


    var showNotification=function(obj){
        PNotify.removeAll(); //remove all notifications
        new PNotify({
            title:  obj.title,
            text:  obj.msg,
            type:  obj.stat
        });
    };
    
        $('#btn_print').click(function(){
         $(this).attr('href','Supplier_Subsidiary/transaction/get-supplier-subsidiary-all?accountId='+_cboAccounts.val()+'&startDate='+_date_from.val()+'&endDate='+_date_to.val());
            //window.open($(this).attr('href')+"?start="+$('#dt_start_date').val()+"&end="+$('#dt_end_date').val()+"&depid="+_cboDepartments.select2('val'));

        });



        // _btnPrint.on('click', function(){
        //     $('#modal_balance').modal('show');
        // });

        _modal_filter.modal('show');
    });
</script>

<script src="assets/plugins/spinner/dist/spin.min.js"></script>
<script src="assets/plugins/spinner/dist/ladda.min.js"></script>
<script src="assets/plugins/select2/select2.full.min.js"></script>
<script src="assets/plugins/datapicker/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="assets/plugins/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/plugins/datatables/dataTables.bootstrap.js"></script>


</body>

</html>