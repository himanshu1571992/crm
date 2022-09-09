<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form  action="<?php echo admin_url('client/add_waveoff'); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="branch_id" class="control-label">Select Client *</label>
                                    <select class="form-control selectpicker" id="client_id" name="client_id" data-live-search="true" required="">
                                        <option value="" disabled selected >--Select One-</option>
                                        <?php
                                        if(!empty($client_data)){
                                            foreach ($client_data as $row) {
                                                ?>
                                                <option value="<?php echo $row->userid; ?>" ><?php echo cc($row->client_branch_name); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                 <div class="form-group">
                                    <label for="balance" class="control-label">Balance</label>
                                    <input type="text" id="balance" name="balance" class="form-control" value="" readonly="">
                                </div>
                            </div>

                            

                             <div class="col-md-4">
                                 <div class="form-group">
                                    <label for="amount" class="control-label">Waive off Amount *</label>
                                    <input type="text" id="amount" name="amount" class="form-control" value="" required="">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="service_type" class="control-label">Service Type <small class="req text-danger">* </small></label>
                                    <select class="form-control selectpicker" required="" id="service_type"  name="service_type">
                                        <option value="1">Rent</option>
                                        <option value="2">Sales</option>
                                       
                                       
                                       
                                    </select>
                                </div>
                            </div>

                            <div  class="col-md-6">
                                <div class="form-group">
                                    <label for="remark" class="control-label">Remark</label>
                                    <textarea class="form-control" name="remark" id="remark"></textarea>
                                </div>
                            </div> 

                            <div class="col-md-6">
                            
                            <div class="form-group">
                                <label for="color" class="control-label">Approved By</label>
                                
                                <select required="" class="form-control selectpicker" multiple data-live-search="true" id="assign" name="assign[assignid][]">
                                    <?php
                                    if (isset($allStaffdata) && count($allStaffdata) > 0) {
                                        foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) 
                                        {?>
                                             <optgroup class="<?php echo 'group'.$Staffgroup_value['id'] ?>">
                                            <option value=""><?php echo $Staffgroup_value['name'] ?></option>
                                            <?php
                                            foreach($Staffgroup_value['staffs'] as $singstaff)
                                            {?>
                                                <option style="padding-left: 50px;" value="<?php echo $singstaff['staffid'] ?>" <?php 
                                                 foreach ($approved_by as $approvby) 
                                                 {
                                                if(isset($approvby->staffid) && in_array($singstaff['staffid'],$approvby->staffid)){echo'selected';} }?>><?php echo $singstaff['firstname'] ?></option>
                                            <?php
                                            }?>
                                            </optgroup>
                                        <?php
                                        }
                                    }
                                    ?>
                                </select>
                                
                            </div>
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

<script type="text/javascript">
    $(document).on('change', '#client_id', function() {   
       var client_id = $(this).val();

       $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/client/get_balance'); ?>",
            data    : {'client_id' : client_id},
            success : function(response){
                if(response != ''){                   
                     $('#balance').val(response);
                }
            }
        })

    }); 
</script>


</body>
</html>
