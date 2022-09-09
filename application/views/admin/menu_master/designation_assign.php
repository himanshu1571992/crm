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
					<h4 class="no-margin"><?php echo $title; ?></h4>
					<hr class="hr-panel-heading">
					
					<div class="row">
						<div class="form-group col-md-4" id="employee_div">
							<label for="staff_id" class="control-label"><?php echo 'Designation Name'; ?> *</label>
							<select required="" class="form-control selectpicker" id="staff_id" name="designation_id" data-live-search="true">
								<option value="" disabled selected >--Select One-</option>
								<?php
								if(!empty($designation_list)){
									foreach($designation_list as $dval){
										?>
										<option value="<?php echo $dval->id;?>" <?php if($designation_id == $dval->id){ echo 'selected'; } ?> ><?php echo $dval->designation; ?></option>
										<?php
									}
								}
								?>
							</select>
						</div>

										
						
						<div class="form-group col-md-2" app-field-wrapper="date">
							
							<div class="input-group date">
								<button style="margin-top: 25px;" class="btn btn-info" value="1" name="mark" type="submit">Search</button>
							</div>
						</div>
												
					</div>
					
                        <div class="row">
						
							
                            <div class="col-md-12">               
                            <lable><b>Give all permissions</b></lable>                                               
                            <input type="checkbox" id="checkAll" >
                                <table class="table ui-table">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Icon</th>
                                        <th>Perent</th>                                        
                                        <th>Sub</th>                                        
                                        <th>Name</th>
                                        <th>Link</th>
                                        <th>View</th>
                                        <th>Create</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    
                                    if(!empty($menu_info)){
                                        $i=1;
                                        foreach($menu_info as $row){  
                                        	$view = 0;
                                        	$create = 0;
                                        	$edit = 0;
                                        	$delete = 0;
                                               
                                        	$assigned_info  = $this->db->query("SELECT * FROM tblmenuassigned WHERE designation_id = '".$designation_id."' and staff_id = 0 and menu_id =  '".$row->id."' ")->row();
                                                if(!empty($assigned_info)){
                                                    $view = $assigned_info->view;
                                                    $create = $assigned_info->create;
                                                    $edit = $assigned_info->edit;
                                                    $delete = $assigned_info->delete;
                                                }

                                            ?>
                                            <input type="hidden" value="<?php echo $row->id; ?>" name="row[]">
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo (!empty($row->icon)) ? '<i class="'.$row->icon.'" aria-hidden="true"></i>' : '--';  ?></td>
                                                <td><?php echo value_by_id('tblmenumaster',$row->parent_id,'name'); ?></td>                                                
                                                <td><?php echo value_by_id('tblmenumaster',$row->sub_id,'name'); ?></td>                                                
                                                <td><?php echo $row->name; ?></td>
                                                <td><?php echo $row->link; ?></td>
                                                <td class="text-center">
                                                   <input type="checkbox" <?php echo ($view == 1) ? 'checked' : ''; ?> name="view_<?php echo $row->id; ?>" value="1">
                                                </td> 

                                                <td class="text-center">
                                                   <input type="checkbox" <?php echo ($create == 1) ? 'checked' : '' ; ?> name="create_<?php echo $row->id; ?>" value="1">
                                                </td>  

                                                <td class="text-center">
                                                   <input type="checkbox" <?php echo ($edit == 1) ? 'checked' : '' ; ?> name="edit_<?php echo $row->id; ?>" value="1">
                                                </td>  

                                                <td class="text-center">
                                                   <input type="checkbox" <?php echo ($delete == 1) ? 'checked' : '' ; ?> name="delete_<?php echo $row->id; ?>" value="1">
                                                </td>     
                                              
                                            </tr>                                            
                                            <?php
                                        }
                                    }else{
                                        echo '<tr><td class="text-center" colspan="9"><h5>Record Not Found</h5></td></tr>';
                                    }
                                    ?>
                                      
                                     
                                    </tbody>
                                  </table>
                            </div>
						
						

                               
                            </div>
						<div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">Save</button>
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
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>


<script type="text/javascript">
	$(document).on('change', '#branch_id', function(){	
		$("#attendance_form").submit();	
	});
	
	$(document).on('change', '#date', function(){	
		$("#attendance_form").submit();	
	});
</script> 

<script type="text/javascript">
	$("#checkAll").click(function(){
	    $('input:checkbox').not(this).prop('checked', this.checked);
	});
</script> 

</body>
</html>
