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

                    <h4 class="no-margin">Menu List <a href="<?php echo admin_url('menu_master/add'); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Add New Menu</a></h4>



                    <hr class="hr-panel-heading">

                    <div class="row">
                    
                    <div class="row col-md-12">
                        <div class="form-group col-md-4">
                            <label for="branch_id" class="control-label">Main Menu</label>
                            <select class="form-control" id="parent_id" name="parent_id">
                                <option value="" disabled selected >--Select One-</option>
                                <?php
                                if(!empty($main_menu)){
                                    foreach ($main_menu as $r) {
                                        ?>
                                        <option value="<?php echo $r->id; ?>" <?php if(!empty($s_parent_id) && $s_parent_id == $r->id){ echo 'selected';} ?>  ><?php echo $r->name; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-4">
                            <label for="is_main" class="control-label">Search By</label>
                            <select class="form-control" id="is_main" name="is_main">
                                <option value="" disabled selected >--Select One-</option>
                                <option value="1" <?php if(!empty($s_is_main) && $s_is_main == 1){ echo 'selected';} ?>>Main Menu</option>
                                <option value="0" <?php if(!empty($s_is_main) && $s_is_main == 0){ echo 'selected';} ?>>Full Menu</option>
                            </select>
                        </div>

                        
                        <div class="form-group col-md-4">                            
                            <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                        </div>
               
                    </div>
                    
                        <div class="">
                        
                            
                            <div class="col-md-12">                                                             
                                <table class="table ui-table">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Perent</th>
                                        <th>Sub</th>
                                        <th>Icon</th>
                                        <th>Name</th>
                                        <th>Link</th>
                                        <th>Order</th>
                                        <th>Main</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($menu_info)){
                                        $i=1;
                                        foreach($menu_info as $row){  
                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo value_by_id('tblmenumaster',$row->parent_id,'name'); ?></td>
                                                <td><?php echo value_by_id('tblmenumaster',$row->sub_id,'name'); ?></td>
                                                <td><?php echo (!empty($row->icon)) ? '<i class="'.$row->icon.'" aria-hidden="true"></i>' : '--';  ?></td>
                                                <td><?php echo $row->name; ?></td>
                                                <td><?php echo $row->link; ?></td>
                                                <td><?php echo $row->order_no; ?></td>
                                                <td><?php echo ($row->is_main == 1) ? 'Yes' : 'No';  ?></td>
                                                <td class="text-center">
                                                    <a href="<?php echo admin_url('menu_master/add/'.$row->id); ?>" class="btn btn-info" ><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    <!-- <a onclick="return confirm('Are you sure you want to delete this item?'); " href="<?php echo admin_url('menu_master/delete/'.$row->id); ?>" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i></a> -->
                                                </td>    
                                              
                                              </tr>
                                            <?php
                                        }
                                    }else{
                                        echo '<tr><td class="text-center" colspan="8"><h5>Record Not Found</h5></td></tr>';
                                    }
                                    ?>
                                      
                                     
                                    </tbody>
                                  </table>
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
