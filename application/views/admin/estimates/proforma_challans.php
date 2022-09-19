<?php init_head(); ?>
<style type="text/css">
.btn-hold {
    background-color: #e8bb0b;
    color: #fff;
    border: 1px solid #e8bb0b;
}

.btn-hold:hover {
    background-color: #e8bb0b;
    color: #fff;
}

.btn-brown {
    background-color: brown;
    color: #fff;
    border: 1px solid brown;
}

.btn-brown:hover {
    background-color: brown;
    color: #fff;
}
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <form method="post" id="salary_form" enctype="multipart/form-data"
                action="<?php echo admin_url('purchase'); ?>">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="row panelHead">
                                <div class="col-xs-12 col-md-6">
                                    <h4><?php echo $title; //if(check_permission_page(40,'create')){  ?></h4>
                                </div>
                                <div class="col-xs-12 col-md-6 text-right">
                                    <!-- <a href="<?php echo admin_url('estimates/proforma_chalan_add/' . $proforma_invoice_id); ?>" class="btn btn-info">Add Proforma Chalan</a> -->
                                    <?php 
                                        $chk_order = value_by_id("tblestimates", $proforma_invoice_id, "order_confirm");
                                        if ($chk_order > 0){
                                    ?>
                                    <a href="#" class="btn btn-info proformachalan" data-estimateid="<?php echo $proforma_invoice_id; ?>">Add Proforma Chalan</a>
                                    <?php }else{
                                        echo "<strong style='color:red;font-size:15px;'>* NOTE : First Confirm Order then Create Proforma Challan</strong>";
                                    } ?>        
                                </div>
                            </div>
                            <hr class="hr-panel-heading">
                            <div class="row">
                                <div class="col-md-12 table-responsive">
                                    <table class="table" id="newtable">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Proforma Challan #</th>
                                                <th>Delivery Challan #</th>
                                                <th>Date</th>
                                                <th>Customer Name</th>
                                                <th>Service Type</th>
                                                <th>Approve Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($proformachalan_list)) {
                                                $z = 1;
                                                foreach ($proformachalan_list as $row) {
                                                    $servicetype = ($row->service_type == 1) ? '<span class="label label-success">Rent</span>':'<span class="label label-danger">Sales</span>';
                                                    $approve_status = "<a href='javascript:void(0);' data-id='".$row->id."' class='btn-sm btn-warning assignapproval'>Pending</a>";
                                                    if ($row->approve_status == '1'){
                                                        $approve_status = "<a href='javascript:void(0);' data-id='".$row->id."' class='btn-sm btn-success assignapproval'>Approved</a>";
                                                    }else if ($row->approve_status == '2'){
                                                        $approve_status = "<a href='javascript:void(0);' data-id='".$row->id."' class='btn-sm btn-danger assignapproval'>Rejected</a>";
                                                    }

                                                    $deliverychallan_info = $this->db->query("SELECT id,chalanno FROM tblchalanmst WHERE `rel_type`='proforma_challan' AND `rel_id`='".$row->id."' ")->row();
                                                    $delivery_Challan_no = (!empty($deliverychallan_info)) ? '<a target="_blank" href="'.admin_url('Chalan/pdf/'.$deliverychallan_info->id).'">'.$deliverychallan_info->chalanno.'</a>' : '--';
                                            ?>
                                            <tr>
                                                <td><?php echo $z++; ?></td>
                                                <td>
                                                    <?php echo 'PC-'.sprintf("%'.05d\n", $row->id);?>
                                                    <?php echo get_creator_info($row->addedfrom, $row->datecreated); ?>
                                                </td>
                                                <td><?php echo $delivery_Challan_no; ?></td>
                                                <td><?php echo _d($row->date); ?></td>
                                                <td><?php echo client_info($row->clientid)->client_branch_name; ?></td>
                                                <td><?php echo $servicetype; ?></td>
                                                <td><?php echo $approve_status; ?></td>
                                                <td class="text-center">
                                                    <?php if ($row->approve_status != '1'){ ?>
                                                        <a href="<?php echo admin_url('estimates/edit_proformachallan/'.$row->id); ?>" title="Edit" class="btn-sm btn-info">Edit</a>
                                                    <?php } ?>
                                                    <div class="btn-group pull-right">
                                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                                                        <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                        <?php if (empty($deliverychallan_info) && $row->approve_status != '1'){ ?>
                                                            <li><a href="<?php echo admin_url('estimates/delete_proformachallan/'.$row->id); ?>" title="delete" class="_delete" style="color:red;">DELETE</a></li>
                                                        <?php } ?>
                                                            <li><a href="<?php echo admin_url('estimates/proformachallan_download_pdf/'.$row->id); ?>" target="_blank" title="PDF">View PDF</a></li>
                                                            <?php if (empty($deliverychallan_info) && $row->approve_status == '1'){ ?>
                                                            <li><a href="<?php echo admin_url('estimates/convert_delivery_challan/'.$row->id.'?service_type='.$row->service_type.'&warehouse_id='.$row->warehouse_id); ?>" target="_blank">Convert Delivery Challan</a></li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <div class="btn-bottom-toolbar text-right">

                            </div>
                        </div>

                    </div>
                </div>

            </form>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<div id="proformchalanmodal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <?php
        $attributes = array('id' => 'sub_form_order');
        echo form_open_multipart(admin_url("estimates/generateproformachalan"), $attributes);
        ?>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Proforma Chalan </h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="estimate_id" class="estimateid" value="">
                <div class="row">
                    <hr>
                    <div class="col-md-6">
                        <div class="form-group" app-field-wrapper="date">
                            <label for="warehouse" class="control-label">Warehouse</label>
                            <?php
                                $branch_list  = $this->db->query("SELECT `name`,`id` FROM `tblwarehouse` WHERE `status`= '1' ")->result();
                            ?>
                            <select class="form-control selectpicker" required="" name="warehouse_id" id="warehouse_id">
                                <option value=""></option>
                                <?php
                                    if (!empty($branch_list)){
                                        foreach ($branch_list as $value) {
                                           echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" app-field-wrapper="date">
                            <label for="service_type" class="control-label">Service Type</label>
                            <select class="form-control selectpicker" required="" name="service_type" id="service_type">
                                <option value=""></option>
                                <option value="1">Rent</option>
                                <option value="2">Sales</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" autocomplete="off" class="btn btn-info cancelremarkbtn">Generate</button>
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<div id="pfchallanstatus_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Proforma Chalan Assign Status </h4>
            </div>
            <div class="modal-body pfchallan_div">

            </div>    
        </div>    
    </div>    
</div>    
<?php init_tail(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" />
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
    $('#newtable, #refundtable').DataTable({
        "iDisplayLength": 15,
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            'colvis'
        ]
    });
});
</script>

<script type="text/javascript">
$(".myselect").select2();

$(document).on("click", ".proformachalan", function() {
    estimate_id = $(this).data("estimateid");
    $(".estimateid").val(estimate_id);
    $("#proformchalanmodal").modal("show");

});

$(document).on("click", ".assignapproval", function(){
    var rid = $(this).data("id");
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/estimates/get_approval_info",
        data    : {'rid': rid},
        success : function(response){
            if(response != ''){
                $("#pfchallanstatus_modal").modal('show');
                $(".pfchallan_div").html(response);
            }
        }
    });
});
</script>

</body>

</html>