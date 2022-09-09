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

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin">Lead Process List <?php if(check_permission_page(117,'create')){ ?> <a href="<?php echo admin_url('lead_process/add'); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Add New Process</a> <?php } ?></h4>



                    <hr class="hr-panel-heading">

                    <div class="row">
                    
                                    
                        <div class="">
                        
                            
                            <div class="col-md-12">                                                             
                                <table class="table ui-table">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Process</th>
                                        <th>Order</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($process_info)){
                                        $i=1;
                                        foreach($process_info as $row){  
                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $row->name;?></td>
                                                <td><?php echo $row->orders;?></td>
                                                <td class="text-center">
                                                    <?php 
                                                    if(check_permission_page(117,'edit')){
                                                        if($row->id != 12){
                                                    ?>
                                                        <a href="<?php echo admin_url('lead_process/add/'.$row->id); ?>" class="btn btn-info" ><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                        <?php
                                                        }else{
                                                            echo '--';
                                                        }
                                                    }else{
                                                        echo '--';
                                                    }

                                                    if(check_permission_page(117,'delete')){
                                                        if($row->id != 12){
                                                        ?>                                                        
                                                        <a onclick="return confirm('Are you sure you want to delete this item?'); " href="<?php echo admin_url('lead_process/delete/'.$row->id); ?>" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        <?php
                                                        }else{
                                                            echo '--';
                                                        }
                                                    }else{
                                                        echo '--';
                                                    }
                                                    ?>
                                                    
                                                    
                                                </td>    
                                              
                                              </tr>
                                            <?php
                                        }
                                    }else{
                                        echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found</h5></td></tr>';
                                    }
                                    ?>
                                      
                                     
                                    </tbody>
                                  </table>
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
             
            <?php echo form_close(); ?>
        </div>      
        <div class="btn-bottom-pusher"></div>
    </div>
</div>

<?php init_tail(); ?>


</body>
</html>
