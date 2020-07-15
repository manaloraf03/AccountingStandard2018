<!DOCTYPE html>
<html>
<head>
	<title>Purchase Order</title>
	<style type="text/css">
		body {
			font-family: 'Calibri',sans-serif;
			font-size: 12px;
		}

		.align-right {
			text-align: right;
		}

		.align-left {
			text-align: left;
		}

		.align-center {
			text-align: center;
		}

		.report-header {
			font-weight: bolder;
		}

		hr {
			/*border-top: 3px solid #404040;*/
		}

		tr {
            border: none!important;
        }
/*
        tr:nth-child(even){
            background: #414141 !important;
            border: none!important;
            color: white !important;
        }

        tr:nth-child(odd){
            background: #414141 !important;
            border: none!important;
            color: white !important;
        }*/

/*        tr:hover {
            transition: .4s;
            background: #414141 !important;
            color: white;
        }

        tr:hover .btn {
            border-color: #494949!important;
            border-radius: 0!important;
            -webkit-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.75);
            -moz-box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.75);
            box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.75);
        }
*/
    table{
        border:none!important;
    }
	</style>
</head>
<body>
	<table width="100%">
        <tr class="row_child_tbl_sales_order">
            <td width="10%"><img src="<?php echo $company_info->logo_path; ?>" style="height: 100px; width: 100px; text-align: left;"></td>
            <td width="90%" class="" style="">
                <h3 class="report-header"><strong><?php echo $company_info->company_name; ?></strong></h3>
                <p><?php echo $company_info->company_address; ?></p>
                <p><?php echo $company_info->landline.'/'.$company_info->mobile_no; ?></p>
                <span><?php echo $company_info->email_address; ?></span><br>

            </td>
        </tr>
    </table>
    <table width="100%">
        <tr class="row_child_tbl_sales_order">
            <td width="60%" style="text-align: right;"><b>PURCHASE ORDER</b> </td>
            <td width="40%" class="" style="text-align: right;">NO: <?php echo $purchase_info->po_no; ?></td>
        </tr>
    </table><br>
    <table width="100%"  cellspacing="-1">
        <tr>
            <td style="padding: 3px;" width="15%"></td>
            <td style="padding: 3px;" width="45%"></td>
            <td style="padding: 3px;" width="15%"><strong>Date:</strong></td>
            <td style="padding: 3px;" width="25%"><?php echo $purchase_info->date_invoice; ?></td>
        </tr>
        <tr>
            <td style="padding: 3px;" width="15%"><strong>Supplier:</strong></td>
            <td style="padding: 3px;" width="45%"><?php echo $purchase_info->supplier_name; ?></td>
            <td style="padding: 3px;" width="15%"><strong>Contact #:</strong></td>
            <td style="padding: 3px;" width="25%"><?php echo $purchase_info->contact_no; ?></td>
        </tr>
        <tr>
            <td style="padding: 3px;" width="15%"><strong>Terms:</strong></td>
            <td style="padding: 3px;" width="45%"><?php echo $purchase_info->terms; ?></td>
            <td style="padding: 3px;" width="15%"><strong>Delivery Date:</strong></td>
            <td style="padding: 3px;" width="25%"><?php echo $purchase_info->date_delivery; ?></td>
        </tr>
    </table>

	<br>
	<table width="100%" cellpadding="10" cellspacing="-1" class="table table-striped" style="text-align: center;">
		<tr>
            <td style="padding: 6px;border: 1px solid gray;"><strong>Qty</strong></td>
			<td style="padding: 6px;border: 1px solid gray;"><strong>UM</strong></td>
            <td style="padding: 6px;border: 1px solid gray;"><strong>Description</strong></td>
			<td style="padding: 6px;border: 1px solid gray;"><strong>Amount</strong></td>
		</tr>
		<?php foreach($po_items as $item){ ?>
            <tr>
                <td style="border-left: 1px solid gray;text-align: right;height: 10px;padding: 6px;"><?php echo number_format($item->po_qty,2); ?></td>
                <td width="10%" style="border-left: 1px solid gray;text-align: center;height: 10px;padding: 6px;"><?php echo $item->unit_name; ?></td>
                <td width="50%" style="border-left: 1px solid gray;text-align: left;height: 10px;padding: 6px;"><?php echo $item->product_desc; ?></td>
                <td style="border-left: 1px solid gray;border-right: 1px solid gray;text-align: right;height: 10px;padding: 6px;"><?php echo number_format($item->po_line_total_after_global,2); ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td  colspan="3"  style="padding: 6px;border-bottom: 1px solid gray;border-left: 1px solid gray;border-top: 1px solid gray;height: 30px;" align="left"><strong>Total:</strong></td>
            <td style="padding: 6px;border-bottom: 1px solid gray;height: 30px;border-right: 1px solid gray;border-top: 1px solid gray;" align="right"><strong><?php echo number_format($purchase_info->total_after_discount,2); ?></strong></td>
        </tr>
	</table><br><br>
    <table width="100%">
        <tr>
            <td style="padding: 3px;" width="15%"><strong>Prepared By:</strong></td>
            <td style="padding: 3px;" width="45%">__________________________________________</td>
            <td style="padding: 3px;" width="15%"><strong>Approved By:</strong></td>
            <td style="padding: 3px;" width="25%">__________________________________________</td>
        </tr>
    </table><br>
    
</body>
</html>