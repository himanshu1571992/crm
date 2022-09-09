<?php init_head(); ?>
<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width: 499px;height: 125px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<!-- Modal Contact -->

<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">
            
            <?php echo form_open($this->uri->uri_string(), array('id' => 'allot-item-form', 'class' => '_item_form allot-item-form')); ?>
            <div class="col-md-12">
            <div class="panel_s">
                <div class="panel-body">
                    <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">

                    <div class="row">
                      <?php if(!empty($info)){ 
                         $client_name = $this->db->query("SELECT * FROM `tblclientbranch` where userid = '".$info->client_id."' ")->row();

                        ?>
                        <div class="col-md-6">
                             <div class="form-group">
                                <label for="color" class="control-label">Client</label>
                                <input type="text" readonly="" class="form-control" value="<?php echo $client_name->client_branch_name; ?>">
                            </div>
                        </div>

                        <div class="form-group col-md-3" app-field-wrapper="amount">
                            <div class="form-group">
                            <label for="amount" class="control-label">Amount</label>
                                <input type="text" readonly="" class="form-control" value="<?php echo $info->amount; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group col-md-3" app-field-wrapper="service_type">
                            <div class="form-group">
                            <label for="service_type" class="control-label">Service Type</label>
                                <input type="text" readonly="" class="form-control" value="<?php echo ($info->service_type == 1) ? 'Rent' : 'Sales';?>">
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                            <label for="remark" class="control-label">Remark</label>
                                <input type="text" readonly="" class="form-control" value="<?php echo $info->remark; ?>">
                            </div>
                        </div>
                    <?php  } ?>
                    </div>

                    <?php 
                        if(empty($appvoal_info) OR (!empty($appvoal_info) && $appvoal_info->approve_status == 5)){

                           ?>
                           <div class="btn-bottom-toolbar bottom-transaction text-right">
                                <button type="submit" name="submit" value="5" style="background-color: #e8bb0b;color: #fff;" class="btn btn-warning hold mleft10 proposal-form-submit save-and-send transaction-submit">
                                    On Hold
                                </button>
                                 <button type="submit" name="submit" value="2" class="btn btn-danger mleft10 proposal-form-submit save-and-send transaction-submit">
                                    Reject
                                </button>
                               <button type="submit" name="submit" value="1" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                    Approved
                                </button>
                            </div> 
                           <?php 
                        }
                        ?>
                </div>
            </div>
        </div>   
           

            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Approve/Reject Remark</h4>
                            </div>

                            <hr/>
                            <div class="col-md-12">
                               
                                     <input type="hidden" value="<?php echo $id;?>" name="id">
                                <div class="row">
                                    <div class="col-md-12 pull-right">
                                       <div class="form-group" app-field-wrapper="remark">
                                        <textarea id="remark" required="" name="remark" class="form-control" rows="4"><?php if(!empty($appvoal_info)){ echo $appvoal_info->approve_remark; } ?></textarea>
                                    </div>
                                    </div>
                                </div>
                                </div>
                           
                        </div>

                    </div>


                </div>
            </div>  
           

            

            <?php echo form_close(); ?>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>


</body>
</html>
