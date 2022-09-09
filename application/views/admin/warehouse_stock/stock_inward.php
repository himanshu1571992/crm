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
                        <h4 class="no-margin">Stock Inward (Transfer Stock)</h4>
                        <hr class="hr-panel-heading">
						
						
						
								 <div class="col-md-12">

								 		
								 		<div class="col-md-6">
								 			<h4> From Warehouse :- <?php echo value_by_id('tblwarehouse',$stock_transfer->warehouse_id,'name'); ?></h4>
								 		</div>
								 		<div class="col-md-6">
								 			<h4> To Warehouse :-  <?php echo value_by_id('tblwarehouse',$stock_transfer->to_warehouse_id,'name'); ?></h4>
								 		</div>

								 		<div class="col-md-12">
								 			<h4>Transfer No. :- <?php echo $stock_transfer->transferstockno; ?></h4>

								 			<a href="<?php echo admin_url('Stock/transferpdf/' . $stock_transfer->id);?>" class="btn btn-default action-btn download mright10" style="float:right;margin-bottom:2%"><i class="fa fa-file-pdf-o"></i> Download PDF</a>
								 		</div>

								 </div>	


								

								<div class="tabel-responsive" style="margin-bottom:30px;">
                      		    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable">
	                                <thead>
	                                    <tr>
	                                        <th style="width:2%" align="center">S.No.</th>
	                                        <th style="width:30%" align="center">Item Name</th>
	                                        <th style="width:7%" align="center">Total</th>
	                                        <th style="width:8%" align="center">Ok</th>
	                                        <th style="width:8%" align="center">Non Repairable</th>
	                                        <th style="width:8%" align="center">Repairable</th>
	                                        <th style="width:8%" align="center">Lost</th>
	                                    </tr>
	                                </thead>

                                	<tbody class="ui-sortable">
                                	<?php
                                	
                                	if(!empty($transfer_product)){
										$i = 1;
                                		foreach($transfer_product as $row)
                  						{	         
                       						?>
											<tr>                            
											 <td align="center"><?php echo $i++?></td>
											 <td align="center"><?php echo $row->name; ?></td>
											 <td align="center"><input readonly name="<?php echo 'ttl_'.$row->id;?>"  type="text" value="<?php echo $row->transfer_qty; ?>"></td>	
											 
											 <td align="center"><input class="qty"  name="<?php echo 'ok_'.$row->id;?>" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" type="text"></td>
											 
											 <td align="center"><input class="qty"  name="<?php echo 'nr_'.$row->id;?>" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" type="text"></td>
											 
											 <td align="center"><input class="qty"  name="<?php echo 'r_'.$row->id;?>" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" type="text"></td>
											 
											 <td align="center"><input class="qty"  name="<?php echo 'lost_'.$row->id;?>" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" type="text"></td>
													
											</tr>		
											<?php
                       						 
                  						}
									}
                                	?>
									</tbody>
								 </table>
							  </div>
							
						<input type="hidden" name="transer_id" value="<?php echo $stock_transfer->id; ?>">	
					
						<div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" name="submit" id="submit" type="submit">
                                <?php echo _l('submit'); ?>
                            </button>
                        </div>
						
                    </div>
                </div>

              
                </form>

            </div>
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>
    <?php init_tail(); ?>
   
</body>


<script type="text/javascript">

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

$(document).on('click', '.product_id', function() { 	
	var product_id = $(this).val();
	var product = $(this).attr('id');
	var arr = product.split('_');
	challan_id = arr[1];


   
   	if(challan_id != '' && product_id != ''){
   		

   		if($(this).prop('checked') === true){
   			$.ajax({
	            type    : "POST",
	            url     : "<?php echo site_url('admin/chalan/get_challan_product_component'); ?>",
	            data    : {'challan_id' : challan_id, 'product_id' : product_id},
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
   
}); 

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

</script> 


</html>
