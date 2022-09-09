
<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'main_store_issue', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?></h4>
                        <hr class="hr-panel-heading">
                        <div>
                            <div>
                                <div class="row">
                                    <div class="col-md-3">  
                                        <div class="form-group">
                                            <label for="warehouse_id" class="control-label">Warehouse</label>
                                            <select class="form-control selectpicker" required='' data-live-search="true" onchange="getShopfloorStoredata();" id="warehouse_id" name="warehouse_id">
                                                <option value=""></option>
                                                <?php
                                                if (isset($all_warehouse) && count($all_warehouse) > 0) {
                                                    foreach ($all_warehouse as $all_warehouse_value) {
                                                        $selected = ($warehouse_id == $all_warehouse_value->id) ? "selected": ""; ?>
                                                        ?>
                                                        <option value="<?php echo $all_warehouse_value->id; ?>" <?php echo $selected; ?>><?php echo $all_warehouse_value->name; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" app-field-wrapper="date">
                                            <label for="date" class="control-label">Date</label>
                                            <div class="input-group date">
                                                <input id="date" name="date" required='' class="form-control datepicker" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" app-field-wrapper="remark">
                                            <label for="remark" class="control-label">Remark</label>
                                            <textarea id="remark" class="form-control" rows="5" name="remark"></textarea>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-2">
                                        <div class="input-group" style="margin-top: 26px;">
                                            <button type="submit" class="btn btn-info">Get Records</button>
                                            <a class="btn btn-danger" href="">Reset</a>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                            <br>
                            <hr>                    
                            <div class="col-md-12"> 
                                <div class="table-responsive">  
                                    <table class="table" id="newtable">
                                        <thead>
                                        <tr>
                                            <th width='1%'>S.No</th>
                                            <th>Product Name</th>
                                            <th>Pro ID</th>
                                            <th>Available Qty</th>
                                            <th>Issue Qty</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="mainstoredata">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div style="display:none;" class="btn-bottom-toolbar text-right form-sub-btn">
                            <button class="btn btn-info final-btn" type="submit" onclick="return checkForTheCondition();">Submit</button>
                            <!-- <a href="javascript:void(0);" class="btn btn-info final-btn">Submit</a> -->
                        </div>
                    </div>
                </div>
            </div>                                
            <?php echo form_close(); ?>
        </div>      
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
</div>
<div id="stock_status" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Assigned Person</h4>
      </div>
      <div class="modal-body stock_status_details">
        
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

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
    $('#newtable').DataTable({"bPaginate": false});
});
$(document).ready(function() {
    getShopfloorStoredata();

    $(document).on('click','.action-box', function() {
        var rid = $(this).data("rid");
        if($(this).is(":checked")) {
            
            var pname = $(this).data("name");
            var aqty = $('#aqty_'+rid).val();
            var qty = $('#qty_'+rid).val();
            if (qty != ''){
                if (parseFloat(aqty) < parseFloat(qty)){
                    alert(pname+' Should be equal to less then available qty');
                    $('#qty_'+rid).val('');
                    $(this).prop("checked", false);
                }
            }else{
                alert(pname+' Issue Qty Required');
                $(this).prop("checked", false);
            }
            
        }else{
            $('#qty_'+rid).val('');
        }
    });

});
    
function checkfinalqty(rid){
        
    var aqty = $('#aqty_'+rid).val();
    var qty = $('#qty_'+rid).val();
    if (qty != ''){
        if (aqty < parseFloat(qty)){
            alert('Qty Should be equal to less then available qty');
            $('#qty_'+rid).val('');
            $('#action_'+rid).prop("checked", false);
        }
    }
}

function checkForTheCondition(){
    var actioncount = 0;
    $('.action-box').each(function() {
        if($(this).is(":checked")) {
            actioncount++;
        }
    });
    if (actioncount == 0){
        alert("Please check at least one record");
        return false;
    }
    return true;
}

function getShopfloorStoredata(){
    $(".form-sub-btn").hide();
    var service_type = $("#service_type").val();
    var warehouse_id = $("#warehouse_id").val();
    $(".mainstoredata").html("<tr><td colspan='5' class='dataTables_empty' valign='top'>No data available in table</td></tr>");
    if (service_type != "" && warehouse_id != ""){
        var url = "<?php echo site_url('admin/store/getShopfloorStoredata'); ?>";
        $.ajax({
            type: "POST",
            url: url,
            data: {'warehouse_id': warehouse_id},
            success: function (res) {
                if (res != ''){
                    $('#newtable').DataTable().destroy();
                    $(".mainstoredata").html(res);
                    $('#newtable').DataTable({"bPaginate": false});
                    $(".form-sub-btn").show();
                }
            }
        });
    }
}

</script>


</body>
</html>

