<?php
$session_id = $this->session->userdata();

init_head();
?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?></h4>
                        <hr class="hr-panel-heading">
                        <form method="post" enctype="multipart/form-data" action="">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="status" class="control-label">From</label>
                                    <select class="form-control selectpicker" required="" data-live-search="true" id="from" name="from">
                                        <option value="" ></option>
                                        <option value="GSTR2B" <?php echo (isset($from) && $from == "GSTR2B") ? "selected" : ""; ?> >GSTR2B</option>
                                        <option value="GSTR3B" <?php echo (isset($from) && $from == "GSTR3B") ? "selected" : ""; ?>>GSTR3B</option>
                                        <option value="TALLY" <?php echo (isset($from) && $from == "TALLY") ? "selected" : ""; ?>>TALLY</option>
                                        <option value="CRM" <?php echo (isset($from) && $from == "CRM") ? "selected" : ""; ?>>CRM</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="status" class="control-label">To</label>
                                    <select class="form-control selectpicker" required="" data-live-search="true" id="to" name="to">
                                        <option value="" ></option>
                                        <option value="GSTR2B" <?php echo (isset($to) && $to == "GSTR2B") ? "selected" : ""; ?> >GSTR2B</option>
                                        <option value="GSTR3B" <?php echo (isset($to) && $to == "GSTR3B") ? "selected" : ""; ?>>GSTR3B</option>
                                        <option value="TALLY" <?php echo (isset($to) && $to == "TALLY") ? "selected" : ""; ?>>TALLY</option>
                                        <option value="CRM" <?php echo (isset($to) && $to == "CRM") ? "selected" : ""; ?>>CRM</option>
                                    </select>
                                </div>
                                <div class="col-md-2">                            
                                    <button type="submit" style="margin-top: 24px;" class="btn btn-info">Compare</button>
                                    <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                                </div>
                            </div>
                        </form>
                        <br>
                        <?php
                            $gstr2b = $gstr3b = $tally = $crm = "";
                            if (isset($from) && isset($to)){
                                $gstr2b = $gstr3b = $tally = $crm = "hide";
                                if (($from == "GSTR2B" OR $to == "GSTR2B")){
                                    $gstr2b = ""; 
                                }
                                if (($from == "GSTR3B" OR $to == "GSTR3B")){
                                    $gstr3b = ""; 
                                }
                                if ($from == "TALLY" OR $to == "TALLY"){
                                    $tally = ""; 
                                }
                                if ($from == "CRM" OR $to == "CRM"){
                                    $crm = ""; 
                                }
                            }
                        
                        ?>
                        <div class="table-responsive" style="margin-bottom:30px;">
                            <table class="table" id="newtable">
                                <thead>
                                    <tr>
                                        <th rowspan=2 style="text-align: center;">Month</th>
                                        <th colspan=3 class="<?php echo $gstr2b; ?>" style="text-align: center;">GSTR2B</th>
                                        <th colspan=3 class="<?php echo $gstr3b; ?>" style="text-align: center;">GSTR3B</th>
                                        <th colspan=3 class="<?php echo $tally; ?>" style="text-align: center;">TALLY</th>
                                        <th colspan=3 class="<?php echo $crm; ?>" style="text-align: center;">CRM</th>
                                        <?php if (isset($from) && isset($to)){ ?>
                                            <th colspan=3 style="text-align: center;">Cumulative Shortfall</th>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th class="<?php echo $gstr2b; ?>" style="text-align: center;">CGST</th>
                                        <th class="<?php echo $gstr2b; ?>" style="text-align: center;">SGST</th>
                                        <th class="<?php echo $gstr2b; ?>" style="text-align: center;">IGST</th>
                                        <th class="<?php echo $gstr3b; ?>" style="text-align: center;">CGST</th>
                                        <th class="<?php echo $gstr3b; ?>" style="text-align: center;">SGST</th>
                                        <th class="<?php echo $gstr3b; ?>" style="text-align: center;">IGST</th>
                                        <th class="<?php echo $tally; ?>" style="text-align: center;">CGST</th>
                                        <th class="<?php echo $tally; ?>" style="text-align: center;">SGST</th>
                                        <th class="<?php echo $tally; ?>" style="text-align: center;">IGST</th>
                                        <th class="<?php echo $crm; ?>" style="text-align: center;">CGST</th>
                                        <th class="<?php echo $crm; ?>" style="text-align: center;">SGST</th>
                                        <th class="<?php echo $crm; ?>" style="text-align: center;">IGST</th>
                                        <?php if (isset($from) && isset($to)){ ?>
                                            <th style="text-align: center;">CGST</th>
                                            <th style="text-align: center;">SGST</th>
                                            <th style="text-align: center;">IGST</th>
                                        <?php } ?>
                                        
                                    </tr>
                                </thead>
                                <tbody class="ui-sortable">
                                    <?php
                                        if (!empty($gst_output)) {

                                            foreach ($gst_output as $key => $row) {
                                                $url = admin_url("purchase_entry/gsttaxdetails");
                                                $month = $row["month"];
                                    ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo date("M-Y", strtotime($row["month"]."-01")); ?></td>
                                        <td class="<?php echo $gstr2b; ?>" style="text-align: center;"><?php echo ($row["gstr2b"]["cgst"] > 0.00) ? "<a href='".$url."?gsttype=1&month=".$month."' target='_blank'>".$row["gstr2b"]["cgst"]."</a>" : $row["gstr2b"]["cgst"]; ?></td>
                                        <td class="<?php echo $gstr2b; ?>" style="text-align: center;"><?php echo ($row["gstr2b"]["sgst"] > 0.00) ? "<a href='".$url."?gsttype=1&month=".$month."' target='_blank'>".$row["gstr2b"]["sgst"]."</a>" : $row["gstr2b"]["sgst"]; ?></td>
                                        <td class="<?php echo $gstr2b; ?>" style="text-align: center;"><?php echo ($row["gstr2b"]["igst"] > 0.00) ? "<a href='".$url."?gsttype=1&month=".$month."' target='_blank'>".$row["gstr2b"]["igst"]."</a>" : $row["gstr2b"]["igst"]; ?></td>
                                        <td class="<?php echo $gstr3b; ?>" style="text-align: center;"><?php echo ($row["gstr3b"]["cgst"] > 0.00) ? "<a href='".$url."?gsttype=2&month=".$month."' target='_blank'>".$row["gstr3b"]["cgst"]."</a>" : $row["gstr3b"]["cgst"]; ?></td>
                                        <td class="<?php echo $gstr3b; ?>" style="text-align: center;"><?php echo ($row["gstr3b"]["sgst"] > 0.00) ? "<a href='".$url."?gsttype=2&month=".$month."' target='_blank'>".$row["gstr3b"]["sgst"]."</a>" : $row["gstr3b"]["sgst"]; ?></td>
                                        <td class="<?php echo $gstr3b; ?>" style="text-align: center;"><?php echo ($row["gstr3b"]["igst"] > 0.00) ? "<a href='".$url."?gsttype=2&month=".$month."' target='_blank'>".$row["gstr3b"]["igst"]."</a>" : $row["gstr3b"]["igst"]; ?></td>
                                        <td class="<?php echo $tally; ?>" style="text-align: center;"><?php echo ($row["tally"]["cgst"] > 0.00) ? "<a href='".$url."?gsttype=3&month=".$month."' target='_blank'>".$row["tally"]["cgst"]."</a>" : $row["tally"]["cgst"]; ?></td>
                                        <td class="<?php echo $tally; ?>" style="text-align: center;"><?php echo ($row["tally"]["sgst"] > 0.00) ? "<a href='".$url."?gsttype=3&month=".$month."' target='_blank'>".$row["tally"]["sgst"]."</a>" : $row["tally"]["sgst"]; ?></td>
                                        <td class="<?php echo $tally; ?>" style="text-align: center;"><?php echo ($row["tally"]["igst"] > 0.00) ? "<a href='".$url."?gsttype=3&month=".$month."' target='_blank'>".$row["tally"]["igst"]."</a>" : $row["tally"]["igst"]; ?></td>
                                        <td class="<?php echo $crm; ?>" style="text-align: center;"><?php echo ($row["crm"]["cgst"] > 0.00) ? "<a href='".$url."?gsttype=4&month=".$month."' target='_blank'>".$row["crm"]["cgst"]."</a>" : $row["crm"]["cgst"]; ?></td>
                                        <td class="<?php echo $crm; ?>" style="text-align: center;"><?php echo ($row["crm"]["sgst"] > 0.00) ? "<a href='".$url."?gsttype=4&month=".$month."' target='_blank'>".$row["crm"]["sgst"]."</a>" : $row["crm"]["sgst"]; ?></td>
                                        <td class="<?php echo $crm; ?>" style="text-align: center;"><?php echo ($row["crm"]["igst"] > 0.00) ? "<a href='".$url."?gsttype=4&month=".$month."' target='_blank'>".$row["crm"]["igst"]."</a>" : $row["crm"]["igst"]; ?></td>
                                        <?php 
                                        
                                        if (isset($from) && isset($to)){
                                            
                                            if ($gstr2b == "" && $gstr3b == ""){
                                                $cgst = ($from == "GSTR2B") ? $row["gstr2b"]["cgst"] - $row["gstr3b"]["cgst"] : $row["gstr3b"]["cgst"] - $row["gstr2b"]["cgst"];
                                                $sgst = ($from == "GSTR2B") ? $row["gstr2b"]["sgst"] - $row["gstr3b"]["sgst"] : $row["gstr3b"]["sgst"] - $row["gstr2b"]["sgst"];
                                                $igst = ($from == "GSTR2B") ? $row["gstr2b"]["igst"] - $row["gstr3b"]["igst"] : $row["gstr3b"]["igst"] - $row["gstr2b"]["igst"];
                                                echo '<td style="text-align: center;">'.number_format(round($cgst), 2, '.', '').'</td>';
                                                echo '<td style="text-align: center;">'.number_format(round($sgst), 2, '.', '').'</td>';
                                                echo '<td style="text-align: center;">'.number_format(round($igst), 2, '.', '').'</td>';
                                            }
                                            if ($gstr2b == "" && $tally == ""){
                                                $cgst = ($from == "GSTR2B") ? $row["gstr2b"]["cgst"] - $row["tally"]["cgst"] : $row["tally"]["cgst"] - $row["gstr2b"]["cgst"];
                                                $sgst = ($from == "GSTR2B") ? $row["gstr2b"]["sgst"] - $row["tally"]["sgst"] : $row["tally"]["sgst"] - $row["gstr2b"]["sgst"];
                                                $igst = ($from == "GSTR2B") ? $row["gstr2b"]["igst"] - $row["tally"]["igst"] : $row["tally"]["igst"] - $row["gstr2b"]["igst"];
                                                echo '<td style="text-align: center;">'.number_format(round($cgst), 2, '.', '').'</td>';
                                                echo '<td style="text-align: center;">'.number_format(round($sgst), 2, '.', '').'</td>';
                                                echo '<td style="text-align: center;">'.number_format(round($igst), 2, '.', '').'</td>';
                                            }
                                            if ($gstr2b == "" && $crm == ""){
                                                $cgst = ($from == "GSTR2B") ? $row["gstr2b"]["cgst"] - $row["crm"]["cgst"] : $row["crm"]["cgst"] - $row["gstr2b"]["cgst"];
                                                $sgst = ($from == "GSTR2B") ? $row["gstr2b"]["sgst"] - $row["crm"]["sgst"] : $row["crm"]["sgst"] - $row["gstr2b"]["sgst"];
                                                $igst = ($from == "GSTR2B") ? $row["gstr2b"]["igst"] - $row["crm"]["igst"] : $row["crm"]["igst"] - $row["gstr2b"]["igst"];
                                                echo '<td style="text-align: center;">'.number_format(round($cgst), 2, '.', '').'</td>';
                                                echo '<td style="text-align: center;">'.number_format(round($sgst), 2, '.', '').'</td>';
                                                echo '<td style="text-align: center;">'.number_format(round($igst), 2, '.', '').'</td>';
                                            }
                                            if ($gstr3b == "" && $tally == ""){
                                                $cgst = ($from == "GSTR3B") ? $row["gstr3b"]["cgst"] - $row["tally"]["cgst"] : $row["tally"]["cgst"] - $row["gstr3b"]["cgst"];
                                                $sgst = ($from == "GSTR3B") ? $row["gstr3b"]["sgst"] - $row["tally"]["sgst"] : $row["tally"]["sgst"] - $row["gstr3b"]["sgst"];
                                                $igst = ($from == "GSTR3B") ? $row["gstr3b"]["igst"] - $row["tally"]["igst"] : $row["tally"]["igst"] - $row["gstr3b"]["igst"];
                                                echo '<td style="text-align: center;">'.number_format(round($cgst), 2, '.', '').'</td>';
                                                echo '<td style="text-align: center;">'.number_format(round($sgst), 2, '.', '').'</td>';
                                                echo '<td style="text-align: center;">'.number_format(round($igst), 2, '.', '').'</td>';
                                            }
                                            if ($gstr3b == "" && $crm == ""){
                                                $cgst = ($from == "GSTR3B") ? $row["gstr3b"]["cgst"] - $row["crm"]["cgst"] : $row["crm"]["cgst"] - $row["gstr3b"]["cgst"];
                                                $sgst = ($from == "GSTR3B") ? $row["gstr3b"]["sgst"] - $row["crm"]["sgst"] : $row["crm"]["sgst"] - $row["gstr3b"]["sgst"];
                                                $igst = ($from == "GSTR3B") ? $row["gstr3b"]["igst"] - $row["crm"]["igst"] : $row["crm"]["igst"] - $row["gstr3b"]["igst"];
                                                echo '<td style="text-align: center;">'.number_format(round($cgst), 2, '.', '').'</td>';
                                                echo '<td style="text-align: center;">'.number_format(round($sgst), 2, '.', '').'</td>';
                                                echo '<td style="text-align: center;">'.number_format(round($igst), 2, '.', '').'</td>';
                                            }
                                            if ($tally == "" && $crm == ""){
                                                $cgst = ($from == "TALLY") ? $row["tally"]["cgst"] - $row["crm"]["cgst"] : $row["crm"]["cgst"] - $row["tally"]["cgst"];
                                                $sgst = ($from == "TALLY") ? $row["tally"]["sgst"] - $row["crm"]["sgst"] : $row["crm"]["sgst"] - $row["tally"]["sgst"];
                                                $igst = ($from == "TALLY") ? $row["tally"]["igst"] - $row["crm"]["igst"] : $row["crm"]["igst"] - $row["tally"]["igst"];
                                                echo '<td style="text-align: center;">'.number_format(round($cgst), 2, '.', '').'</td>';
                                                echo '<td style="text-align: center;">'.number_format(round($sgst), 2, '.', '').'</td>';
                                                echo '<td style="text-align: center;">'.number_format(round($igst), 2, '.', '').'</td>';
                                            }
                                        } ?>
                                    </tr>
                                    <?php
                                            }
                                        }    
                                    ?>
                                </tbody>
                            </table>
                        </div>    
                    </div>
                </div>
            </div>
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>
<?php init_tail(); ?>
</body>
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

</html>

<script type="text/javascript">
//    $(document).on('click', '#take_action', function () {
//        
//        var document_id = [];
//        var document_type = [];
//        $('.chkaction').each(function() {
//            if (this.checked){
//                var doc_id = $(this).data("did");
//                var dtype = $(this).data("dtype");
//                document_id.push(doc_id);
//                document_type.push(dtype);
//            }
//        });
//        if (document_id != ""){
//            $('#client_chkbox').modal({
//                show: 'false'
//            }); 
//            
//            $(".document_id").val(document_id);
//            $(".document_type").val(document_type);
//        }else{
//            alert("Please check at least one report");
//        }
//    });
    
//    $("#from").change(function() {
//        
//        var opt1 = $(this).val();
//        $("#to option[value='"+ opt1 +"']").remove();
////          $("#to option[value='" + opt1 + "']").remove();
////        $("#to").children("option[value^=" + opt1 + "]").hide();
////        alert(opt1);
////        
////        var opt1 = $(this).find("option:selected").val();
////        if (opt1 != ""){
//////            $("#to").children("option[value^=" + opt1 + "]").hide();
////            $("#to option .to"+opt1).hide();
////        }
////        alert($(this).find("option:selected").val())
////          if ($(this).find("option:selected").val() == "gender") {
////                $("#yrFrom").show();
////          } else if ($(this).find("option:selected").attr("id") == "income") {
////                $("#yrTo").show();
////          }
//    });
    
    $("#from").change(function() {
        var opt1 = $(this).val();
        var opt2 = $("#to").val();
        if (opt1 == opt2){
            $('#to').val('').trigger("change");
        }
//        $("#to option.to1").prop('disabled', false);
//        $("#to option.to2").prop('disabled', false);
//        $("#to option.to3").prop('disabled', false);
//        $("#to option.to4").prop('disabled', false);
//        $("#to option.to"+opt1).prop('disabled', true);
    });
    $("#to").change(function() {
        var opt1 = $(this).val();
        var opt2 = $("#from").val();
        if (opt1 == opt2){
            $('#from').val('').trigger("change");
        }
//        $("#from option.from1").prop('disabled', false);
//        $("#from option.from2").prop('disabled', false);
//        $("#from option.from3").prop('disabled', false);
//        $("#from option.from4").prop('disabled', false);
//        $("#from option.from"+opt1).prop('disabled', true);
    });
</script>