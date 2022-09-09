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

                    <h4 class="no-margin"> <?php echo $title;  if(check_permission_page(204,'create')){ ?><a href="<?php echo admin_url('assembling_department_first/conversion'); ?>" class="btn btn-info pull-right" style="margin-top:-6px;">Make Conversion</a><?php } ?></h4>



                    <hr class="hr-panel-heading">

                    <div class="row">
                    
                    <div class="row col-md-12">

                         <div class="form-group col-md-4">
                            <label for="warehouse_id" class="control-label">Select Warehouse *</label>
                            <select class="form-control" id="warehouse_id" name="warehouse_id">
                                <option value="" disabled selected >--Select One-</option>
                                <?php
                                if(!empty($warehouse_info)){
                                    foreach ($warehouse_info as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value->id;?>" <?php if($s_warehouse_id == $value->id){ echo 'selected';} ?>  ><?php echo cc($value->name);?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-md-3" app-field-wrapper="date">
                            <label for="f_date" class="control-label">From Date</label>
                            <div class="input-group date">
                                <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if(!empty($s_fdate)){ echo $s_fdate; }else{ echo date('d/m/Y'); } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>

                        <div class="form-group col-md-3" app-field-wrapper="date">
                            <label for="t_date" class="control-label">To Date</label>
                            <div class="input-group date">
                                <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($s_tdate)){ echo $s_tdate; }else{ echo date('d/m/Y'); } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>
                        

                        
                        <div class="col-md-1">                            
                        <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                        </div>

                                                
                    </div>
                    
                        <div class="">
                        
                            
                            <div class="col-md-12 table-responsive">                                                             
                                <table class="table ui-table">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Conversion Id</th>
                                        <th>Reference No</th>                                        
                                        <th>Warehouse</th>
                                        <th>Service Type</th>
                                        <th>Product Name</th>
                                        <th>Date</th>
                                        <th>View</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($cuttitng_info)){
                                        $i=1;
                                        foreach($cuttitng_info as $row){  

                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo 'COV-'.str_pad($row->id, 4, "0", STR_PAD_LEFT);?></td>
                                                <td><?php echo $row->reference_no; ?></td>
                                                <td><?php echo cc(value_by_id('tblwarehouse',$row->warehouse_id,'name')); ?></td>
                                                <td><?php echo ($row->service_type == 1) ? 'Rent' : 'Sale'; ?></td>
                                                <td><?php echo cc(value_by_id('tblproducts',$row->product_id,'sub_name')); ?></td>
                                                <td><?php echo _d($row->date);?></td>
                                                <td><button type="button" value="<?php echo $row->id; ?>" class="c_id btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Show Details</button></td>
                                               
                                              </tr>
                                            <?php
                                        }
                                    }else{
                                        echo '<tr><td class="text-center" colspan="8"><h4>Record Not Found</h4></td></tr>';
                                    }
                                    ?>
                                      
                                     
                                    </tbody>
                                  </table>
                            </div>
                        
                        

                               
                            </div>
                             
                        </div>

                        <!-- <div class="btn-bottom-toolbar text-right">
                                <button class="btn btn-info" value="1" name="mark" type="submit">
                                    <?php echo _l('submit'); ?>
                                </button>
                            </div> -->
                       
                    </div>
                </div>
             
            <?php echo form_close(); ?>
        </div>      
        <div class="btn-bottom-pusher"></div>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cutting process details</h4>
      </div>
      <div class="modal-body">
        <!-- <div class="row">
            <form action="<?php echo admin_url('bank_payments/update_reference'); ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-6">
                <label class="control-label">UTR No. </label>
                <input type="text" class="form-control" value="" name="reference_no">
            </div>

            <input type="hidden" id="pay_id" value="" name="pay_id">

            <div style="float: right;" class="col-md-6">
                <button style="margin-top: 27px;" type="submit" class="btn btn-info">Update</button>
            </div>
            </form>
        </div> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




<?php init_tail(); ?>


<script type="text/javascript">
    $(document).on('click', '.c_id', function()   
    {
        var id = $(this).val();        

            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('admin/assembling_department_first/get_conversion_details'); ?>",
                data    : {'id' : id},
                success : function(response){
                    if(response != ''){                   
                         $('.modal-body').html(response);  
                         /* $('.selectpicker').selectpicker('refresh');
                         $('.date').datepicker();*/
                    }
                }
            })    
       

    }); 
</script>


</body>
</html>
