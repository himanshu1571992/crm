<?php init_head(); ?>
<style>table.items tr.main td { padding: 10px 10px !important;}</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open($this->uri->uri_string(), array('id' => 'product-form', 'class' => 'proposal-form', 'enctype' => 'multipart/form-data')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-md-12">
                                <h4>Booking Release</h4>
                                <hr/>
                            </div>


                            <div class="col-md-6">
								<div class="form-group">
                                    <label for="release_for" class="control-label">Release For</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="release_for" name="release_for">
                                        <option value="1">Company</option>
                                        <option value="2">Self</option>
                                        <option value="3">Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-6" id="staff_div" hidden>
                                <label for="staff_id" class="control-label"><?php echo 'Employee Name'; ?> </label>
                                <select class="form-control selectpicker" data-live-search="true" id="staff_id" name="staff_id">
                                    <option value=""></option>
                                    <?php
                                    if(!empty($staff_list)){
                                        foreach($staff_list as $row){
                                            ?>
                                            <option value="<?php echo $row->staffid;?>" ><?php echo $row->firstname; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                           
							<div class="col-md-12" style="margin-bottom:5%;">	
							
                            </div>
                            
							<div class="table-responsive s_table compdv">
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable" style="margin-top:2%; !important">
                                    <thead>
                                        <tr>
                                            <th width="28%" align="left">Item Name</th>
											<th width="10%" class="qty" align="left">Booking Qty</th>
                                            <th width="10%" class="qty" align="left">Available Qty</th>
                                            <th width="10%" class="qty" align="left">Release Qty</th>
                                            <th width="5%"  align="center"><i class="fa fa-cog"></i></th>
                                        </tr>


                                    </thead>
                                    <tbody class="ui-sortable">

                                        <?php
                                        if(!empty($items_info)){
                                            $i = 1;
                                            foreach ($items_info as $value) {
                                                ?>
                                                <tr>
                                                    <td><?php echo value_by_id('tblproducts',$value->product_id,'name'); ?></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input readonly id="book_<?php echo $value->id; ?>" value="<?php echo $value->quantity ?>" name="" class="form-control" >
                                                        </div>
                                                    </td>
                                                    
                                                    <td>
                                                        <div class="form-group">
                                                            <input readonly id="avail_<?php echo $value->id; ?>" value="<?php echo $value->balanced_qty ?>" name="avail_<?php echo $value->id; ?>" class="form-control" >
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="form-group">
                                                            <input type="number" id="qty_<?php echo $value->id; ?>" name="qty_<?php echo $value->id; ?>" class="form-control" >
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="form-group">
                                                            <input type="checkbox" id="check_<?php echo $value->id; ?>" value="<?php echo $value->id; ?>" name="row[]" class="form-control check" >
                                                        </div>
                                                    </td>
                                                   
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                        }
                                        ?>                                            
                                    </tbody>
                                </table>
                               
                            </div>
                        </div>

                        <input type="hidden" value="<?php echo $booking_info->id; ?>" name="booking_id">

                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">Release</button>
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



<script type="text/javascript">
 


$(document).on('click', '.check', function(){   

    var id = $(this).attr('id').split("_")[1];
    var avail_qty = parseInt($('#avail_'+id).val());
    var release_qty = parseInt($('#qty_'+id).val());


    if(avail_qty < release_qty){
        alert('Release quantity must be smaller then Available quantity!');
         $('#qty_'+id).val(avail_qty);
    }

});


$(document).on('click', '.check', function(){   

    var id = $(this).attr('id').split("_")[1];
    var release_qty = parseInt($('#qty_'+id).val());
    
    if(release_qty > 0){
        
    }else{
        alert('Quantity must be greater then zero!');
        $(this).prop('checked', false);
    }

});



$(document).on('change', '#release_for', function(){   

   
    var release_for = $(this).val();

    if(release_for == 3){
        $("#staff_div").show();
        $("#staff_id").prop('required',true); 

    }else{
       $("#staff_div").hide(); 
       $("#staff_id").prop('required',false); 
    }

});


</script>





</body>
</html>
