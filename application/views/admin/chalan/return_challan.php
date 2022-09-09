<?php
$session_id = $this->session->userdata();
init_head();
?>
<style>#address{margin: 0px 1.5px 0px 0px;height: 112px;width: 508px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;} input[type="text"]{width:100%;} .checkbox.mass_select_all_wrap {border: 1px solid #ccc;padding: 10px;border-radius: 3px;} </style>

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            
      
            <div class="col-md-12">
                <form method="post" action="" id="reutrn_form">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin">Return Challan</h4>
                        <hr class="hr-panel-heading">
						
						
						<h4>Challan List</h4>
						
						
						
						
						<div class="row">

						<?php
							if(!empty($challan_info)){
								foreach ($challan_info as $value) {
									?>
										<div class="col-xs-12 col-md-3">
											<div class="checkbox mass_select_all_wrap">
												<input <?php /*if(in_array($value['id'], $last_challan_info)){ echo 'checked'; }*/ ?> name="challan_list[]" value="<?php echo $value['id']; ?>" class="challan" type="checkbox" id="<?php echo 'challan_'.$value['id'] ;?>" data-to-table="tasks"><label for="<?php echo 'challan_'.$value['id'] ;?>"><?php echo $value['chalanno']; ?></label>
											</div>
										</div>	
									<?php
								}
							}
						?>
						
						</div>
						

						<div id="table_details">
							<?php
							/*if(!empty($last_challan_info)){
								foreach ($last_challan_info as $challan_id) {
									$getchalandetails=$this->db->query("SELECT * FROM `tblcreatedchalandetailsmst` WHERE `chalan_id`='".$challan_id."' group by component_id")->result_array();
									$challan_name = value_by_id('tblcreatedchalanmst',$challan_id,'chalanno');
							?>
							<div id="<?php echo 'tbl_'.$challan_id.''; ?>">		
								 <h4>Challan Name :- <?php echo $challan_name; ?></h4>
								 <div class="tabel-responsive" style="margin-bottom:30px;">
                      		    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable">
	                                <thead>
	                                    <tr>
	                                        <th style="width:30%" align="center">Component Name</th>
	                                        <th style="width:7%" align="center">Total</th>
	                                        <th style="width:8%" align="center">List</th>
	                                        <th style="width:8%" align="center">Ok</th>
	                                        <th style="width:8%" align="center">Non Repairable</th>
	                                        <th style="width:8%" align="center">Repairable</th>
	                                        <th style="width:8%" align="center">Lost</th>
	                                        <th style="width:8%" align="center">Pending</th>
	                                    </tr>
	                                </thead>

                                	<tbody class="ui-sortable">
                                	<?php
                                	$total = 0; $list = 0; 	$ok = 0; $repairable = 0; $non_repairable = 0; $lost = 0; $pending = 0;
                                	if(!empty($getchalandetails)){
                                		foreach($getchalandetails as $singlechalandetail)
                  						{	         
                       						$value_info = $this->home_model->get_row('tblchallanreturn', array('perfoma_id'=>$estimate_id,'challan_id'=>$challan_id,'component_id'=>$singlechalandetail['component_id'],'status'=>1), '');

                       						if(!empty($value_info)){
                       							if($value_info->total > 0){
                       								$total = $value_info->total;
                       							}else{
                       								$total = 0;
                       							}

                       							if($value_info->list > 0){
                       								$list = $value_info->list;
                       							}else{
                       								$list = 0;
                       							}

                       							if($value_info->ok > 0){
                       								$ok = $value_info->ok;
                       							}else{
                       								$ok = 0;
                       							}

                       							if($value_info->non_repairable > 0){
                       								$non_repairable = $value_info->non_repairable;
                       							}else{
                       								$non_repairable = 0;
                       							}

                       							if($value_info->repairable > 0){
                       								$repairable = $value_info->repairable;
                       							}else{
                       								$repairable = 0;
                       							}

                       							if($value_info->lost > 0){
                       								$lost = $value_info->lost;
                       							}else{
                       								$lost = 0;
                       							}

                       							if($value_info->pending > 0){
                       								$pending = $value_info->pending;
                       							}else{
                       								$pending = 0;
                       							}
                       						}

                       						 $getcomponentdetails=$this->db->query("SELECT * FROM `tblcomponents` WHERE `id`='".$singlechalandetail['component_id']."'")->row_array();
                       						 echo '<tr>                            
				                                    <td align="center">'.$getcomponentdetails['name'].'</td>
				                                    <td align="center"><input readonly name="ttl_'.$challan_id.'_'.$getcomponentdetails['id'].'" id="ttl_'.$challan_id.'_'.$getcomponentdetails['id'].'"  type="text" value="'.$singlechalandetail['deleverable_qty'].'"></td>

				                                    <td align="center"><input value="'.$list.'" class="qty" id="list_'.$challan_id.'_'.$getcomponentdetails['id'].'" name="list_'.$challan_id.'_'.$getcomponentdetails['id'].'"type="text"></td>

				                                    <td align="center"><input value="'.$ok.'" class="qty" id="ok_'.$challan_id.'_'.$getcomponentdetails['id'].'" name="ok_'.$challan_id.'_'.$getcomponentdetails['id'].'"type="text"></td>

				                                    <td align="center"><input value="'.$non_repairable.'" class="qty" id="nr_'.$challan_id.'_'.$getcomponentdetails['id'].'" name="nr_'.$challan_id.'_'.$getcomponentdetails['id'].'"type="text"></td>

				                                    <td align="center"><input value="'.$repairable.'" class="qty" id="r_'.$challan_id.'_'.$getcomponentdetails['id'].'" name="r_'.$challan_id.'_'.$getcomponentdetails['id'].'"type="text"></td>

				                                    <td align="center"><input value="'.$lost.'" class="qty" id="lost_'.$challan_id.'_'.$getcomponentdetails['id'].'" name="lost_'.$challan_id.'_'.$getcomponentdetails['id'].'"type="text"></td>

				                                    <td align="center"><input value="'.$pending.'" id="pending_'.$challan_id.'_'.$getcomponentdetails['id'].'" name="pending_'.$challan_id.'_'.$getcomponentdetails['id'].'"type="text"></td>
				                               </tr>';
                  						}
									}
                                	?>
									</tbody>
								 </table>
							  </div>
							</div>	

							<?php
								}
							}
							*/
							?>	
						</div>	
					
						 <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" name="submit" id="submit" type="submit">
                                <?php echo _l('submit'); ?>
                            </button>
                        </div>
						
                    </div>
                </div>

                <input type="hidden" name="perfoma_id" value="<?php echo $estimate_id; ?>">
                </form>

            </div>
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>
    <?php init_tail(); ?>
   
</body>


  <!-- Modal -->
 <div class="modal fade" id="productlistmodel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        
      </div>
      
    </div>
  </div>


<script type="text/javascript">

$(document).on('click', '.pickup', function() { 	
	var product_id = $(this).val();
	var challan_id = $(this).attr('val');
	
	
		 $.ajax({
	            type    : "POST",
	            url     : "<?php echo site_url('admin/chalan/last_pickup_model'); ?>",
	            data    : {'challan_id' : challan_id,'product_id' : product_id},
	            success : function(response){
	                if(response != ''){                     
	                    $('.modal-content').html(response);       
	                }
	            }
	        })
	
        
    
}); 


$('.challan').click(function(){
	var challan_id = $(this).val();
	if($(this).prop('checked') === true){
		 $.ajax({
	            type    : "POST",
	            url     : "<?php echo site_url('admin/chalan/get_challan_products'); ?>",
	            data    : {'challan_id' : challan_id},
	            success : function(response){
	                if(response != ''){                     
	                    $('#table_details').append(response);       
	                }
	            }
	        })
	}else{
		$("#main_"+challan_id).remove();
	}
        
    
}); 


$(document).on('change', '.picktype', function() { 
		var picktype = $(this).val();
		var picktype_id = $(this).attr('id');
		var arr = picktype_id.split('_');
		challan_id = arr[1];

		if(picktype == 2){
			$.ajax({
	            type    : "POST",
	            url     : "<?php echo site_url('admin/chalan/get_challan_products_list'); ?>",
	            data    : {'challan_id' : challan_id},
	            success : function(response){
	                if(response != ''){                     
	                    $('#productdiv_'+challan_id).html(response);
	                    $('#challandiv_'+challan_id).html('');        
	                }
	            }
	        })
		}else if(picktype == 1){

			$.ajax({
	            type    : "POST",
	            url     : "<?php echo site_url('admin/chalan/get_challan_component'); ?>",
	            data    : {'challan_id' : challan_id},
	            success : function(response){
	                if(response != ''){                   
	                     $('#challandiv_'+challan_id).html(response);  
	                     $('#productdiv_'+challan_id).html('');       
	                }
	            }
	        })
		}else{
			$('#challandiv_'+challan_id).html('');
			$('#productdiv_'+challan_id).html('');
		}

}); 


$(document).on('click', '.get_data', function() { 	

	var challan_id = $(this).val();	

	var arr = [];
	var inval = '';
	i = 0;
	$('.product_id_'+challan_id).each(function() {
	       
		var r_qty = $(this).val();
		var product_id = $(this).attr('pro');
		var qty = $(this).attr('p_qty');
	
		
		if(r_qty > 0){			

			

			if(r_qty <= qty){
			   	$("input",$(this).parent().next()).prop("checked", true);	
			   		
			   	arr[i++] = [
				  [r_qty, product_id, qty]
				];
		       	
			   
			}else{
				inval = 'invalid';
				$(this).val(' ');

					$("input",$(this).parent().next()).prop("checked", false);
			}
		}

	       
	});

	if(inval == ''){
		
   		$.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/chalan/get_challan_product_component'); ?>",
            data    : {'challan_id' : challan_id, 'arr' : arr},
            success : function(response){
                if(response != ''){                   
                     $('#challandiv_'+challan_id).html(response);  
                }
            }
        })
		
	}else{
		alert('Invalid Input!');
	}

	
}); 	

/*$(document).on('click', '.product_id', function() { 	
	var product_id = $(this).val();
	var product = $(this).attr('id');
	var arr = product.split('_');
	challan_id = arr[1];

	var qty = $(this).parent().prev().prev().html();	
	var r_qty = $("input",$(this).parent().prev()).val();

	if(r_qty > 0){
			if(r_qty <= qty){
		   		if(challan_id != '' && product_id != ''){
		   		

		   		if($(this).prop('checked') === true){
		   			$.ajax({
			            type    : "POST",
			            url     : "<?php echo site_url('admin/chalan/get_challan_product_component'); ?>",
			            data    : {'challan_id' : challan_id, 'product_id' : product_id, 'r_qty' : r_qty},
			            success : function(response){
			                if(response != ''){                   
			                     $('#challandiv_'+challan_id).append(response);  
			                }
			            }
			        })
				}else{
					$('#challanproduct_'+challan_id+'_'+product_id).remove();
				}
		  			
		   	} 
		}else{
	   		alert('Invalid Input!');
	   		$("input",$(this).parent().prev()).val(' ');
	   		$(this).prop("checked", false);
	   }
	}else{
		alert('Product quantity is empty!');
		$(this).prop("checked", false);
	}
   
   	
   		   
   
}); */

$(document).on('keyup', '.qty', function() { 	
	var qty_id = $(this).attr('id');
	var arr = qty_id.split('_');
	challan_id = arr[1];
	id = arr[2];

	var total = parseInt($('#ttl_'+challan_id+'_'+id).val());
	var ok = parseInt($('#ok_'+challan_id+'_'+id).val());
	var nr = parseInt($('#nr_'+challan_id+'_'+id).val());
	var r = parseInt($('#r_'+challan_id+'_'+id).val());
	var lost = parseInt($('#lost_'+challan_id+'_'+id).val());

	var add_qty = (ok+nr+r+lost);
	var pending = (total-add_qty);

	$('#pending_'+challan_id+'_'+id).val(pending);	


}); 


$(document).on('keyup', '.part_qty', function() { 	
	var qty_id = $(this).attr('id');
	var arr = qty_id.split('_');
	challan_id = arr[1];
	//product_id = arr[2];
	id = arr[2];

	var total = parseInt($('#ttl_'+challan_id+'_'+id).val());
	var ok = parseInt($('#ok_'+challan_id+'_'+id).val());
	var nr = parseInt($('#nr_'+challan_id+'_'+id).val());
	var r = parseInt($('#r_'+challan_id+'_'+id).val());
	var lost = parseInt($('#lost_'+challan_id+'_'+id).val());

	var add_qty = (ok+nr+r+lost);
	var pending = (total-add_qty);

	$('#pending_'+challan_id+'_'+id).val(pending);	

}); 

</script> 


</html>
