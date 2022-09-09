<?php init_head(); ?>
<style>
    .title-panel {
        font-size: 15px;
        color:#03a9f4;
    }
	.text-content{
		margin-left: 12px;
	}
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <form  action="<?php echo site_url($this->uri->uri_string()); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="col-md-6">
                    <div class="panel_s">
                        <div class="panel-body">
                            <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                            <hr class="hr-panel-heading">
                            <div class="row">
                                <?php 
                                    $number = 'PCM-'.number_series($request_info["id"]);
                                ?>	
                                <div class="col-md-12">
                                    <label for="id" class="control-label title-panel col-md-6">Id :</label> <span class="text-content"><?php echo $number; ?></span>
                                </div>
                                <div class="col-md-12">
                                    <label for="department_name" class="control-label title-panel col-md-6">Department Name :</label> <span class="text-content"><?php echo $request_info["department_name"]; ?></span>
                                </div>
                                <div class="col-md-12">
                                    <label for="manager_name" class="control-label title-panel col-md-6">Manager Name :</label> <span class="text-content"><?php echo $request_info["manager_name"]; ?></span>
                                </div>
                                <div class="col-md-12">
                                    <label for="amount" class="control-label title-panel col-md-6">Amount :</label> <span class="text-content"><?php echo $request_info["amount"]; ?></span>
                                </div>
                                <div class="col-md-12">
                                    <label for="description" class="control-label title-panel col-md-6">Description :</label> <span class="text-content"><?php echo ($request_info["description"] != "") ? $request_info["description"] : "--"; ?></span>
                                </div>
                            </div>
                            
                            <div class="btn-bottom-toolbar text-right">
                                <?php if ($request_info["staff_confirmed"] == 0) { ?>
                                    <button class="btn btn-info" type="submit">
                                        <?php echo 'Submit'; ?>
                                    </button>
                                <?php }else if ($request_info["staff_confirmed"] == 1) { ?>
                                    <h3 class="text-success text-center">Request Confirmed</h3>
                                <?php }else if ($request_info["staff_confirmed"] == 2) { ?>   
                                    <h3 class="text-danger text-center">Request Rejected</h3> 
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($request_info["staff_confirmed"] == 0) { ?>
                <div class="col-md-6">
                    <div class="panel_s">
                        <div class="panel-body">
                            <h4 class="no-margin">Confirmation Action</h4>
                            <hr class="hr-panel-heading">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="staff_confirmed" class="control-label">Confirmation *</label>
                                        <select class="form-control selectpicker" required="" id="staff_confirmed" name="staff_confirmed">
                                            <option value="" disabled="" selected="">--Select One-</option>
                                            <option value="1" <?php echo ($request_info["staff_confirmed"] == 1) ? 'selected':''; ?>>Confirmed</option>
                                            <option value="2" <?php echo ($request_info["staff_confirmed"] == 2) ? 'selected':''; ?>>Rejected</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="confirmation_payment_mode" class="control-label"><?php echo 'Payment Mode'; ?> *</label>
                                        <select class="form-control selectpicker selectpicker" id="payment_mode" name="payment_mode" required="">
                                            <option value="" disabled selected >--Select One-</option>
                                            <?php
                                            if(!empty($payment_mode_info)){
                                                foreach($payment_mode_info as $row){
                                                    ?>
                                                    <option value="<?php echo $row->id;?>"><?php echo $row->name; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="control-label"><?php echo 'Confirmation Remark'; ?> *</label>
                                        <textarea id="staff_remark" name="staff_remark" required="" class="form-control"></textarea>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>        
                </div> 
                <?php } ?>
            </form>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>


<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });

});	
</script>





</body>
</html>
