<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form  action="<?php echo admin_url('product_new/send_product_approval'); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">

                        <div class="row">
                            <div class="col-md-6">
                                <label for="city_id" class="control-label"><?php echo _l('proposal_assigned'); ?></label>
                                <select onchange="staffdropdown()" class="form-control selectpicker" multiple data-live-search="true" required="" id="assign" name="assignid[]">
                                    <?php
                                    if (isset($allStaffdata) && count($allStaffdata) > 0) {
                                        foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
                                            ?>
                                            <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">
                                                <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
                                                <?php
                                                foreach ($Staffgroup_value['staffs'] as $singstaff) {
                                                    ?>
                                                    <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" <?php
                                                    if (isset($staffassigndata) && in_array($singstaff['staffid'], $staffassigndata)) {
                                                        echo'selected';
                                                    }
                                                    ?>><?php echo $singstaff['firstname'] ?></option>
                                                        <?php }
                                                        ?>
                                            </optgroup>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>                                

                            </div>

                            <div  class="col-md-6">
                                <div class="form-group">
                                    <label for="remark" class="control-label">Remark</label>
                                    <textarea class="form-control" name="remark" id="remark"><?php echo (isset($purchase_info) && $purchase_info['remark'] != '') ? $purchase_info['remark'] : ""; ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <hr>
                            </div>

                            <div class="col-md-12 table-responsive">                                                             
                                <table class="table" id="">
                                    <thead>
                                      <tr>
                                        <th>S.No.</th>
                                        <th>Product Name</th>
                                        <th>Print Name</th>
                                        <th>Created Date</th>  
                                        <th class="text-center">View</th>
                                        <!-- <th class="text-center">Edit</th> -->
                                        <th class="text-center">Action</th>
                                        
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($item_data)){
                                        $z=1;
                                        foreach($item_data as $row){ 
                                            ?>                                                                                      
                                            <tr>
                                                <td><?php echo $z++;?></td>                                                                                                        
                                                <td><?php echo cc($row->name);?></td>
                                                <td><?php echo cc($row->sub_name);?></td>
                                                <td><?php echo _d($row->created_at);?></td>
                                                <td class="text-center"><a class="btn-sm btn-info" target="_blank" href="<?php echo admin_url('product_new/products_log_view/'.$row->id); ?>">View</a>
                                                <a class="btn-sm btn-danger _delete" href="<?php echo admin_url('product_new/delete_product_log/'.$row->id); ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                <!-- <a class="btn-sm btn-info" target="_blank" href="<?php echo admin_url('product_new/edit_product_log/'.$row->id); ?>"><i class="fa fa-edit"></i></a> -->
                                                </td> 
                                                <td class="text-center"><input type="checkbox" value="<?php echo $row->id; ?>" name="row[]"></td>
                                            </tr>
                                            <?php
                                        }
                                    }else{
                                        echo '<tr><td class="text-center" colspan="6"><h5>Record Not Found</h5></td></tr>';
                                    }
                                    ?>
                                      
                                     
                                    </tbody>
                                  </table>
                            </div>                             

                        </div>

                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo 'Submit'; ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div> 
            </form>

        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>


<script>

$(document).ready(function() {
    $('#newtable').DataTable( {
        "iDisplayLength": 25
    } );
} );
</script>


<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>





</body>
</html>
