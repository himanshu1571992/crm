<?php init_head(); ?>

<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" type="text/css" />
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" type="text/css" />
<!-- <link href="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/css/bootstrap.min.css" rel="stylesheet"> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">

<style>
    fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6">
                                <h4><?php echo $title; ?> </h4>
                            </div>
                        </div>
                        <hr class="hr-panel-heading">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset class="scheduler-border"><br>
                                        <div class="col-md-12" align="center">
                                            <span style="font-size:20px;">Category : </span><span style="color: red;font-size:20px;"><?php echo value_by_id('tblcompanyexpensecatergory',$head_info->category_id,'name'); ?></span>
                                        </div>
                                        <div class="col-md-12" align="center">
                                            <span style="font-size:20px;">Head Type : </span><span style="color: red;font-size:20px;"><?php echo value_by_id('tblheads', $head_id, 'name'); ?></span>
                                        </div>
                                        <div class="col-md-12" align="center">
                                            <span style="font-size:20px;">Total Amount : </span><span style="color: red;font-size:20px;" ><?php echo number_format($totalexpense, 2, '.', ','); ?></span>
                                        </div>
                                    </fieldset>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table" id="newtable">
                                            <thead>
                                                <tr>
                                                    <th align="center" width="1px;">Sr.No</th>
                                                    <th align="center">Sub Head</th>
                                                    <th align="center">Party Name</th>
                                                    <th align="center">Amount</th>
                                                    <th align="center">Documents No.</th>
                                                    <th align="center">Payment Date</th>
                                                </tr>
                                            </thead>	
                                            <tbody>
                                                <?php
                                                    $ttlamount = 0;
                                                    if (!empty($system_expense_list)){
                                                        foreach ($system_expense_list as $k => $row) {
                                                            if ($row->type == 2 && $row->category_id == 6) {
                                                                $party_name = $row->party_name;
                                                            } else {
                                                                $party_name = '<a href="'.admin_url('company_expense/expense_vendor_ledger/'.$row->category_id.'/'.$row->party_id).'" target="_blank">'.value_by_id('tblcompanyexpenseparties', $row->party_id, 'name').'</a>';
                                                            }

                                                            $document_no = "--";
                                                            if ($row->transport_against == '1' && !empty($row->document_id)){
                                                                $documents = explode(',', $row->document_id);
                                                                $document_no ="";
                                                                foreach ($documents as $doc_id) {
                                                                    $invoice_no = value_by_id("tblinvoices", $doc_id, "number");
                                                                    $document_no .= '<a class="btn-sm btn-info" target="_blank" href="'.admin_url('invoices/download_pdf/'.$doc_id).'">'.$invoice_no.'</a>&nbsp;'; 
                                                                }
                                                            }else if ($row->transport_against == '2' && !empty($row->document_id)){
                                                                $documents = explode(',', $row->document_id);
                                                                $document_no ="";
                                                                foreach ($documents as $doc_id) {
                                                                    $po_no = value_by_id("tblpurchaseorder", $doc_id, "number");
                                                                    $document_no .= '<a class="btn-sm btn-info" target="_blank" href="'.admin_url('purchase/download_pdf/'.$doc_id).'">'.$po_no.'</a>&nbsp;'; 
                                                                }
                                                            }
                                                            $ttlamount += $row->amount;
                                                            $sub_head = ($row->sub_head_id > 0) ? value_by_id('tblsubheads', $row->sub_head_id, 'name') : '--';

                                                            $payment_info = $this->db->query('SELECT `utr_date` FROM `tblbankpaymentdetails` WHERE `pay_type`= "pay_request" and `pay_type_id` = "'.$row->id.'" ')->row();
                                                            $utr_date = '--';
                                                            if(!empty($payment_info->utr_date)){
                                                                $utr_date = _d($payment_info->utr_date);
                                                            }
                                                            echo '<tr>
                                                                    <td align="center">'.++$k.'</td>
                                                                    <td align="center">'.$sub_head.'</td>
                                                                    <td align="center">'.$party_name.'</td>
                                                                    <td align="center">'.number_format($row->amount, 2, '.', ',').'</td>
                                                                    <td align="center">'.$document_no.'</td>
                                                                    <td align="center">'.$utr_date.'</td>
                                                                </tr>	
                                                            ';
                                                        }
                                                    }
                                                ?>
                                            </tbody>	
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3" align="center"> <h4>TOTAL</h4> </td>
                                                    <td align="center"><h4><?php echo number_format($ttlamount, 2, '.', ','); ?></h4></td>
                                                    <td colspan="2"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>		
                                </div>
                            </div>
                        </div>

						 <!-- <div class="btn-bottom-toolbar text-right">
								<button class="btn btn-info" value="1" name="mark" type="submit">
									<?php echo _l('submit'); ?>
								</button>
							</div> -->

                    </div>
                </div>
            </div>
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>
</div>


<?php init_tail(); ?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
<!-- <script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="<?php  echo base_url(); ?>assets/plugins/jquery.filer/js/jquery.filer.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="http://cdn.rawgit.com/bassjobsen/Bootstrap-3-Typeahead/master/bootstrap3-typeahead.min.js"></script>

<script>

$(document).ready(function() {
    $('#newtable').DataTable( {

        "iDisplayLength": 15,
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [
            'pageLength',
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5]
                }
            },
            'colvis',
        ]
    } );
});
</script>
<script type="text/javascript">
$(".datepicker2").datepicker( {
  format: "yyyy-mm",
  startView: "months",
  minViewMode: "months"
});
</script>

</body>
</html>
