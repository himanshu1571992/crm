<?php init_head(); ?>
<style type="text/css">

    .ui-table > thead > tr > th {
        border:1px solid #9d9d9d !important;
        color: #fff !important;
        background:#6d7580;
    }

    .ui-table > tbody > tr > td{
        border: 1px solid #c7c7c7;
        color:#5f6670;
    }

    .ui-table > tbody > tr:nth-child(even) {
      background: #f8f8f8;
    }

    .actionBtn {
        border: 1px solid #6d7580;
        padding: 8px 10px;
        border-radius: 3px;
        background:#6d7580;
        color:#fff;
        margin-right: 3px;
    }

    .actionBtn:hover {
        background:#51647c;
        color:#fff;
    }

</style>
<style>
    fieldset.scheduler-border {
    border: 2px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}
</style>
<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" id="category_id">
                                    <label for="bank_id" class="control-label">Bank <span style="color:red">*</span></label>
                                    <select class="form-control selectpicker" data-live-search="true" required="" id="bank_id" name="bank_id">
                                        <option value="" selected=" disabled ">--Select One--</option>
                                        <?php
                                        if (!empty($bank_list)) {
                                            foreach ($bank_list as $key => $value) {
                                                $selected = (!empty($sbank_id) && $sbank_id == $value->id) ? 'selected' : "";
                                                ?>                                               
                                                <option value="<?php echo $value->id; ?>" <?php echo $selected; ?>  ><?php echo cc($value->name); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-4" app-field-wrapper="date">
                                <label for="f_date" class="control-label"><?php echo 'From Date'; ?> <span style="color:red">*</span></label>
                                <div class="input-group date">
                                    <input id="f_date" name="f_date" required="" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                </div>
                            </div>
                            <div class="form-group col-md-4" app-field-wrapper="date">
                                <label for="t_date" class="control-label"><?php echo 'To Date'; ?> <span style="color:red">*</span></label>
                                <div class="input-group date">
                                    <input id="t_date" name="t_date" required="" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" value="1" name="mark" type="submit">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
        <?php if (isset($bank_statement) && !empty($bank_statement)) { ?>     
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
<!--                        <fieldset class="scheduler-border"><br>
                            <div class="col-md-12">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-3 col-form-label" style="font-size: 18px;">Bank Name : </label>
                                        <div class="col-sm-9">
                                            <span style="font-size: 18px;"><?php echo value_by_id("tblbankmaster", $sbank_id, "name"); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-3 col-form-label" style="font-size: 18px;">Added By : </label>
                                        <div class="col-sm-9">
                                            <span style="font-size: 18px;"><?php echo (isset($added_by)) ? get_employee_name($added_by) : "--"; ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-3 col-form-label" style="font-size: 18px;">Statement Period : </label>
                                        <div class="col-sm-9">
                                            <span style="font-size: 18px;"><?php echo $s_fdate." To ".$s_tdate; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-3 col-form-label" style="font-size: 18px;">Opening Balance : </label>
                                        <div class="col-sm-9">
                                            <span style="font-size: 18px;" ><?php echo number_format($opening_bal, 2, '.', ''); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-3 col-form-label" style="font-size: 18px;">Closing Balance : </label>
                                        <div class="col-sm-9">
                                            <span style="font-size: 18px;" class="scbal"><?php echo number_format($closing_bal, 2, '.', ''); ?></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword3" class="col-sm-3 col-form-label" style="font-size: 18px;">Calculate Balance : </label>
                                        <div class="col-sm-8">
                                            <span style="font-size: 18px;" class="calculate_bal"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>-->
                        <div class="col-md-12">                                                             
                            <table class="table" id="example">
                                
                                <thead>
                                    <tr><td align="center" colspan="2"></td></tr>
                                    <tr>
                                        <td colspan="2" style="border-left: 5px solid; border-top: 5px solid; border-bottom: 5px solid;"> 
                                            <div class="form-group row">
                                                <label for="inputPassword3" class="col-sm-5 col-form-label" style="font-size: 18px; color: red;">Bank Name : </label>
                                                <div class="col-sm-7">
                                                    <span style="font-size: 15px;" ><?php echo value_by_id("tblbankmaster", $sbank_id, "name"); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPassword3" class="col-sm-5 col-form-label" style="font-size: 18px; color: red;">Statement Period : </label>
                                                <div class="col-sm-7">
                                                    <span style="font-size: 15px;"><?php echo $s_fdate . " To " . $s_tdate; ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td colspan="2" style="border-top: 5px solid; border-bottom: 5px solid;"> 
                                            <div class="form-group row">
                                                <label for="inputPassword3" class="col-sm-6 col-form-label" style="font-size: 18px; color: red;">Opening Balance : </label>
                                                <div class="col-sm-6">
                                                    <?php $oadded_by = (isset($opening_added_by)) ? get_employee_name($opening_added_by) : "--"; ?>
                                                    <span style="font-size: 15px;" ><?php echo number_format($opening_bal, 2, '.', ''). " ( by ". $oadded_by . " )"; ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputPassword3" class="col-sm-6 col-form-label" style="font-size: 18px; color: red;">Closing Balance : </label>
                                                <div class="col-sm-6">
                                                    <?php $cadded_by = (isset($closing_added_by)) ? get_employee_name($closing_added_by) : "--"; ?>
                                                    <span style="font-size: 15px;" class="scbal"><?php echo number_format($closing_bal, 2, '.', ''). " ( by ". $cadded_by . " )"; ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td colspan="2" style="border-top: 5px solid; border-right: 5px solid; border-bottom: 5px solid;"> 
                                            
                                            <div class="form-group row">
                                                <label for="inputPassword3" class="col-sm-5 col-form-label" style="font-size: 18px; color: red;">Calculate Balance : </label>
                                                <div class="col-sm-7">
                                                    <span style="font-size: 15px;" class="calculate_bal"></span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    
<!--                                    <tr>
                                        <td style="border-left: 1px solid;"> Bank Name </td>
                                        <td style="border-right: 1px solid;"> <span class="badge badge-pill badge-primary"> Kotak Mahindra Bank </span></td>
                                    </tr>
                                    <tr>
                                        <td style="border-left: 1px solid;"> Added By </td>
                                        <td style="border-right: 1px solid;"> <span class="badge badge-pill badge-primary">  Abhishek </span> </td>
                                    </tr>
                                    <tr>
                                        <td style="border-left: 1px solid;">Statement Period : </td>
                                        <td style="border-right: 1px solid;"> <span class="badge badge-pill badge-primary">  09/01/2021 To 21/04/2021 </span> </td>
                                    </tr>
                                    <tr>
                                        <td style="border-left: 1px solid;">Opening Balance : </td>
                                        <td style="border-right: 1px solid;"> <span class="badge badge-pill badge-primary">  1200.00 </span></td>
                                    </tr>
                                    <tr>
                                        <td style="border-left: 1px solid;">Closing Balance : </td>
                                        <td style="border-right: 1px solid;"><span class="badge badge-pill badge-primary">  1550.00 </span></td>
                                    </tr>
                                    <tr>
                                        <td style="border-left: 1px solid;">Calculate Balance : </td>
                                        <td style="border-right: 1px solid;"> -2128.00 ( 1550.00 -3678.00 ) </td>
                                    </tr>-->
                                    <tr>
                                        <th align="center">Date</th>
                                        <th align="center">Description</th>
                                        <th align="center">Ref.</th>
                                        <th align="center">Debit</th>
                                        <th align="center">Credit</th>
                                        <th align="center">Balance</th>
                                        <!--<th class="text-center">Action</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                            
                                        $ttcredit_amt = $ttdebit_amt = 0;
                                        $tcount = count($bank_statement);
                                        
                                        $i = 1;
                                        echo '<tr><td align="center">'.db_date($s_fdate).'</td><td align="center">Opening Balance</td><td></td><td></td><td></td><td align="center">'.$opening_bal.'</td></tr>';
                                        foreach ($bank_statement as $key => $bvalue) {
                                            $last_bal = ($tcount == $i) ? "class='cbal'" : "";
                                            
                                            foreach ($bvalue as $value) {
                                                
                                                $ref = (!empty($value["ref"])) ? $value["ref"] : "--";
                                                $debit_amt = number_format($value["debit_amt"], 2, '.', '');
                                                $credit_amt = number_format($value["credit_amt"], 2, '.', '');
                                                $opening_bal = ($debit_amt > 0.00) ? $opening_bal - $debit_amt : $opening_bal + $credit_amt;

                                                $ttcredit_amt += $credit_amt;
                                                $ttdebit_amt += $debit_amt;
                                                $debit_amt = ($debit_amt > 0.00) ? '<p class="text-danger">'.$debit_amt.'</p>' : $debit_amt;
                                                $credit_amt = ($credit_amt > 0.00) ? '<p class="text-success">'.$credit_amt.'</p>' : $credit_amt;

                                                echo '<tr>'
                                                        . '<td align="center">'.$value["date"].'</td>'
                                                        . '<td align="center">'.$value["description"].'</td>'
                                                        . '<td align="center">'.$ref.'</td>'
                                                        . '<td align="center">'.$debit_amt.'</td>'
                                                        . '<td align="center">'.$credit_amt.'</td>'
                                                        . '<td align="center" '.$last_bal.'>'.number_format($opening_bal, 2, '.', '').'</td>'
                                                        . '</tr>';
                                            }
                                         
                                            $i++;
                                        }
                                    ?> 
                                </tbody>
                                <tfoot><tr><td colspan="3" align="center">Totals</td><td class="text-danger" align="center"><?php echo number_format($ttdebit_amt, 2, '.', ''); ?></td><td class="text-success" align="center"><?php echo number_format($ttcredit_amt, 2, '.', ''); ?></td><td></td></tr></tfoot>
                            </table>
                        </div>
                    </div>    
                </div>    
            </div>
        <?php } ?>     
        <div class="btn-bottom-pusher"></div>
    </div>
</div>


<?php init_tail(); ?>
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
<script>

$(document).ready(function() {
    $('#example').DataTable({

        "iDisplayLength": 30,

        dom: 'Bfrtip',

        lengthMenu: [

            [ 10, 30, 50, -1 ],

            [ '10 rows', '30 rows', '50 rows', 'Show all' ]

        ],
        buttons: [  
        	'pageLength',        
            {

                extend: 'excel',

                exportOptions: {

                    columns: ':visible'

                }

            },

            {

                extend: 'pdf',

                exportOptions: {

                     columns: ':visible'

                }

            },

            {

                extend: 'print',

                exportOptions: {

                    columns: ':visible'

                }

            },

            'colvis',

        ]

    });
} );

var cbal = $(".cbal").text();
var scbal = $(".scbal").text();
if (cbal != "" && scbal != ""){
    
    if (cbal > 0){
        var cal_bal = parseFloat(scbal) - parseFloat(cbal);
        $(".calculate_bal").html(cal_bal.toFixed(2)+" <small> ( "+ scbal + " - " + cbal + " )</small>");
    }else{
        var cal_bal = parseFloat(cbal) + parseFloat(scbal);
        $(".calculate_bal").html(cal_bal.toFixed(2)+" <small> ( "+ scbal + " "+ cbal + " )</small>");
    }
}
</script>


</body>
</html>
