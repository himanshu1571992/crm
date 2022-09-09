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

                    <h4 class="no-margin">Expense Party List <?php if(check_permission_page(92,'create') ){ ?> <a href="<?php echo admin_url('company_expense/add_party'); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Add New Party</a> <?php } ?></h4>



                    <hr class="hr-panel-heading">

                    <div class="row">
                    
                    <div class="col-md-4">
                        <div class="form-group" id="category_id">
                            <label for="branch_id" class="control-label">Category *</label>
                            <select class="form-control" required="" id="category_id" name="category_id">
                                <option value="" selected=" disabled ">--Select One--</option>
                                <?php
                                if(!empty($category_info)){
                                    foreach ($category_info as $key => $value) {
                                       ?>                                               
                                         <option value="<?php echo $value->id; ?>" <?php if(!empty($scategory_id) && $scategory_id == $value->id){ echo 'selected';} ?>  ><?php echo cc($value->name); ?></option>
                                       <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>    

                        
                          <div class="col-md-1">                            
                          <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                          </div>
                          <div class="col-md-1">
                           <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                          </div>
               
                    
                    
                        <div class="">
                        
                            
                            <div class="col-md-12 table-responsive">                                                             
                                <table class="table ui-table">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Vendor ID</th>
                                        <th>Party Name</th>
                                        <th>Cetegory</th>
                                        <th>Mobile No.</th>
                                        <th>IFSC</th>
                                        <th>Account No.</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($party_info)){
                                        $i=1;
                                        foreach($party_info as $row){  
                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo 'VEND-E-'.str_pad($row->id, 4, '0', STR_PAD_LEFT); ?></td>
                                                <td><?php echo cc($row->name);?></td>
                                                <td><?php echo cc(value_by_id('tblcompanyexpensecatergory',$row->category_id,'name'));?></td>
                                                <td><?php echo $row->mobile_no;?></td>
                                                <td><?php echo $row->ifsc;?></td>
                                                <td><?php echo $row->account_no;?></td>
                                                <td class="text-center">
                                                    <?php if(check_permission_page(92,'edit') ){ ?>
                                                    <a href="<?php echo admin_url('company_expense/add_party/'.$row->id); ?>" class="btn btn-info" ><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    <?php
                                                    }else{
                                                        echo '--';
                                                    }
                                                    if(check_permission_page(92,'delete') ){
                                                    ?>
                                                    <a onclick="return confirm('Are you sure you want to delete this item?'); " href="<?php echo admin_url('company_expense/delete_party/'.$row->id); ?>" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i></a>
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
                                        echo '<tr><td class="text-center" colspan="7"><h5>Record Not Found</h5></td></tr>';
                                    }
                                    ?>
                                      
                                     
                                    </tbody>
                                  </table>
                            </div>
                        
                        

                               
                            </div>
                             
                        </div>
                       <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" value="1" name="mark" type="submit">
                                <?php echo _l('submit'); ?>
                            </button>
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
