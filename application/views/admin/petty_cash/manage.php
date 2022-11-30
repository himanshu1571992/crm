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
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6">
                                <h4><?php echo $title; ?></h4>
                            </div>
                            <div class="col-xs-12 col-md-6 text-right">
                                <?php if(check_permission_page('134,266','create') ){ ?> <a href="<?php echo admin_url('petty_cash/add'); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Add New Department</a> <?php } ?>
                            </div>
                        </div>
                        <hr class="hr-panel-heading">
                    <div class="row">
                        <div class="table-responsive">
                            <div class="col-md-12">                                                             
                                <table class="table ui-table">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Added By</th>
                                        <th>ID</th>
                                        <th>Department</th>
                                        <th>Amount</th>
                                        <th>Assigned To</th>
                                        <th>Confirmation status</th>
                                        <th>Created Date</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($pettycash_info)){
                                        $i=1;
                                        foreach($pettycash_info as $row){  

                                            if($row->staff_confirmed == 0){
                                                $status = '<div style="color: #F7B900;"><b>Pending</b></div>'; 
                                            }elseif($row->staff_confirmed == 1){
                                                $status = '<div style="color: green;"><b>Confirmed</b></div>';
                                            }elseif($row->staff_confirmed == 2){
                                                $status = '<div style="color: red;"><b>Rejected</b></div>';
                                            }

                                            ?>
                                            
                                                                                       
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo ($row->addedby > 0) ? get_employee_fullname($row->addedby) : 'N/A'; ?></td>
                                                <td><?php echo 'PCM-'. str_pad($row->id, 4, '0', STR_PAD_LEFT);?></td>
                                                <td><a href="<?php echo admin_url('petty_cash/reports/'.$row->id); ?>" target="_blank"><?php echo cc($row->department_name);?></a></td>
                                                <td><?php echo $row->amount;?></td>
                                                <td><?php echo get_employee_name($row->staff_id);?></td>
                                                <td><?php echo $status;?></td>
                                                <td><?php echo _($row->created_at);?></td>
                                                <td class="text-center">
                                                    <?php if(check_permission_page('134,266','edit') ){ ?>
                                                    <a href="<?php echo admin_url('petty_cash/add/'.$row->id); ?>" class="btn btn-info" ><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    <?php
                                                    }else{
                                                        echo '--';
                                                    }
                                                    ?>
                                                </td>   
                                              
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
