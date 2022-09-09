<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin">Terms Conditions List </h4>



                    <hr class="hr-panel-heading">

                    <div class="row">
                    
                    <!-- <div class="row col-md-12">
                        <div class="form-group col-md-4" id="employee_div">
                            <label for="receiver" class="control-label">Search by receiver *</label>
                            <select class="form-control selectpicker" id="receiver" name="receiver" data-live-search="true">
                                <option value="" disabled selected >--Select One-</option>
                                <?php
                               if(!empty($staff_info)){
                                    foreach ($staff_info as $key => $value) {
                                        ?>
                                            <option value="<?php echo $value->staffid; ?>" <?php if(!empty($s_receiver) && $s_receiver == $value->staffid){ echo 'selected'; }?>><?php echo $value->firstname; ?></option>
                                        <?php     
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        

                        
                        <div class="form-group col-md-4">                            
                            <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                        </div>
               
                    </div> -->
                    
                        <div class="table-responsive">
                        
                            
                            <div class="col-md-12">                                                             
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Title</th>
                                        <th>For</th>
                                        <th>Type</th>
                                        <th>Update Date</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($termscondition_info)){
                                        $i=1;
                                        foreach($termscondition_info as $row){  
                                            if($row->for == 1){
                                                $for = 'Rent';
                                            }elseif($row->for == 2){
                                                $for = 'Sales';
                                            }else{
                                                $for = '--';
                                            }

                                            if($row->type == 1){
                                                $type = 'Scaffold';
                                            }elseif($row->type == 2){
                                                $type = 'Boom Lift';
                                            }else{
                                                $type = '--';
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $row->name;?></td>
                                                <td><?php echo $for; ?></td>                                               
                                                <td><?php echo $type; ?></td>
                                                <td><?php echo ($row->updated_at > 0) ? _d($row->updated_at) : '--'; ?></td>                                                 
                                                <td class="text-center">
                                                   <a href="<?php echo admin_url('terms_conditions/update/'.$row->id); ?>" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></a>                                                    
                                                </td>    
                                              
                                            </tr>
                                            <?php
                                        }
                                    }else{
                                        echo '<tr><td class="text-center" colspan="5"><h5>Record Not Found</h5></td></tr>';
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

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
    $('#newtable').DataTable( {
        
    } );
} );
</script>
</body>
</html>


<script type="text/javascript">
    $(document).on('click', '.handover', function() {  

    var handover_id = $(this).val(); 
    if(handover_id > 0 ){
          $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/handover/get_handover_data'); ?>",
            data    : {'handover_id' : handover_id},
            success : function(response){
                if(response != ''){       

                     
                     $('#handover_data').html(response);  
                }
            }
        })  
    }
    

});    
</script>
