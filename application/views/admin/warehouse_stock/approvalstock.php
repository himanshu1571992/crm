<?php init_head(); ?>
<style>table.items tr.main td { padding: 10px 10px !important;}</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open($this->uri->uri_string(), array('id' => 'product-form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-md-12">
                            <h4 class="no-margin"><?php echo (isset($stockdata['id'])) ? _l('approve_stock') : "";?></h4>
                                <hr/>
                            </div>
                            <div class="col-md-6">
								<div class="form-group">
                                   <h4><span class="text-muted lead-field-heading no-mtop">Service Type :</span>
                                   
                                        <?php
                                        if (isset($service_type) && count($service_type) > 0) {
                                            foreach ($service_type as $service_type_key => $service_type_value) {
                                                 echo (isset($stockdata['service_type']) && $stockdata['service_type'] == $service_type_value['id']) ? $service_type_value['name'] : "" ?>
                                                <?php
                                            }
                                        }
                                        ?>
                                </div>
                            </div>
                            <div class="col-md-6">	
								<div class="form-group">
                                   <h4><span class="text-muted lead-field-heading no-mtop"> Warehouse :</span>
                                    <?php
                                        if (isset($all_warehouse) && count($all_warehouse) > 0) {
                                            foreach ($all_warehouse as $all_warehouse_key => $all_warehouse_value) {
                                                ?>
                                                <?php echo (isset($stockdata['warehouse_id']) && $stockdata['warehouse_id'] == $all_warehouse_value['id']) ? $all_warehouse_value['name'] : "" ?>
                                                <?php
                                            }
                                        }
                                        ?> </h4> 
                                </div>
                            </div> 
							<div class="col-md-12" style="margin-bottom:5%;">	
								<div class="form-group">
                                    <h4><span class="text-muted lead-field-heading no-mtop"><?php echo _l('stock_type'); ?> : </span>
                                        <?php echo (isset($stockdata['is_product']) && $stockdata['is_product'] == 0) ? 'Component' : "" ?>
                                       <?php echo (isset($stockdata['is_product']) && $stockdata['is_product'] == 1) ? 'Product' : "" ?>
                                </h4>
								</div>
                            </div>
                            <div class="table-responsive s_table compdv" <?php if (isset($prostockdata) && count($prostockdata) > 0 && $stockdata['is_product']==1){?>style="display:none;"<?php }?>>
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable" style="margin-top:2%; !important">
                                    <thead>
                                        <tr>
                                            <th width="51%" align="left"><?php echo _l('stock_component');?></th>
                                            <th width="22%" class="qty" align="left"><?php echo _l('stock_qty');?></th>
                                            <th width="22%" align="left"><?php echo _l('stock_remarks');?>	</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable">
                                        <?php
                                        
                                        if (isset($prostockdata) && count($prostockdata) > 0 && $stockdata['is_product']==0) {
                                            $i = 0;
                                            foreach ($prostockdata as $singleproductcomp) {
                                                $i++;
                                                ?>
                                                <tr class="main" id="tr<?php echo $i; ?>">
                                                    <td>
                                                        <?php
                                                            if (isset($component_data) && count($component_data) > 0) {
                                                                foreach ($component_data as $unit_key => $component_value) {
                                                                    if($component_value['sac_code']!=''){$sac_code='( '.$component_value['sac_code'].' )';}else{$sac_code='';}
                                                                    ?>
                                                                    <?php echo (isset($singleproductcomp['product_id']) && $singleproductcomp['product_id'] == $component_value['id']) ? $component_value['name'].' '.$sac_code : "" ?>
                                                                    <?php
                                                                }
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <?php echo (isset($singleproductcomp['qty']) && $singleproductcomp['qty'] != "") ? $singleproductcomp['qty'] : "" ?>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <?php echo (isset($singleproductcomp['remarks']) && $singleproductcomp['remarks'] != "") ? $singleproductcomp['remarks'] : "" ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } 
                                        ?>
                                    </tbody>
                                </table>
                                
                            </div>
                            <div class="col-md-12">

                                <div class="table-responsive s_table proddv" <?php if (isset($prostockdata) && count($prostockdata) > 0 && $stockdata['is_product']==1){?>style="display:block;"<?php }else{?>style="display:none;"<?php }?>>
                                    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2%; !important">
                                        <thead>
                                            <tr>
                                            <!--  <th width="30%" align="left"><?php echo _l('product_cat');?></th> -->
                                                <th width="30%" align="left"><?php echo _l('product_name');?></th>
                                                <th width="10%" class="qty" align="left"><?php echo _l('stock_qty');?></th>
                                                <th width="25%" align="left"><?php echo _l('stock_remarks');?>	</th>
                                            </tr>
                                        </thead>
                                        <tbody class="ui-sortable">
                                            <?php
                                            if (isset($prostockdata) && count($prostockdata) > 0 && $stockdata['is_product']==1) {
                                                $i = 0;
                                                foreach ($prostockdata as $singleproductcomp) {
                                                    $prodet=$this->db->query("SELECT * FROM `tblproducts` WHERE `id`='".$singleproductcomp['product_id']."'")->row_array();
                                                    $catprodet=$this->db->query("SELECT * FROM `tblproducts` WHERE `product_cat_id`='".$prodet['product_cat_id']."'")->result_array();
                                                
                                                    ?>
                                                    <tr class="main" id="tr<?php echo $i; ?>">
                                                        <!-- <td>
                                                            <div class="form-group">
                                                                
                                                                    <?php
                                                                    if (isset($procategory) && count($procategory) > 0) {
                                                                        foreach ($procategory as $procategory_key => $procategory_value) {
                                                                            
                                                                            ?>
                                                                            <?php echo (isset($prodet['product_cat_id']) && $prodet['product_cat_id'] == $procategory_value['id']) ? $procategory_value['name']  : "" ?>
                                                                            <?php
                                                                        }
                                                                    }?>
                                                            </div>
                                                        </td> -->
                                                        <td>
                                                            <div class="form-group">
                                                                
                                                                    <?php
                                                                    if (isset($catprodet) && count($catprodet) > 0) {
                                                                        foreach ($catprodet as $catprodet_key => $catprodet_value) {
                                                                            $prosac_code = (isset($catprodet_value['sac_code']) && $catprodet_value['sac_code']!='') ? '('.$catprodet_value['sac_code'].')' : '';
                                                                            ?>
                                                                            <?php echo (isset($singleproductcomp['product_id']) && $singleproductcomp['product_id'] == $catprodet_value['id']) ? $catprodet_value['name'].' '.$prosac_code : "" ?>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <?php echo (isset($singleproductcomp['qty']) && $singleproductcomp['qty'] != "") ? $singleproductcomp['qty'] : "" ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <?php echo (isset($singleproductcomp['remarks']) && $singleproductcomp['remarks'] != "") ? $singleproductcomp['remarks'] : "" ?>
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
							<?php
							$stockapprovalcheck=$this->db->query("SELECT * FROM `tblstockapproval` WHERE `warehousestockid`='".$stockdata['id']."' AND `approve_status`='0' AND `staffid`='".get_staff_user_id()."'")->result_array();
							if(count($stockapprovalcheck)>=1)
							{?>
							<div class="panel_s no-shadow leadsdv">
								<div class="activity-feed">
								  <div class="col-md-12">
									<h4>Would you like to accept this Stock?</h4>
									<div class="text-right">
										<input type="hidden" id="addedfrom" value="<?php echo $stockdata['addedfrom']; ?>">
										<div class="form-group">
											<textarea id="stockapprov_desc" required="" name="approve_remark" placeholder="Enter Reason"class="form-control stockapprov_desc" rows="4" enabled="enabled"></textarea>
										</div>
										<button val="<?php echo $stockdata['id'];?>"class="btn btn-success approval" name="status" type="submit" value="1"><?php echo 'Accept'; ?></button>
										<button val="<?php echo $stockdata['id'];?>" class="btn btn-danger approval" name="status" type="submit" value="2"><?php echo 'Decline'; ?></button>
									</div>
								  </div>
								</div>
							</div>
							<?php
							}
							$stockapprovalacceptcheck=$this->db->query("SELECT * FROM `tblstockapproval` WHERE `warehousestockid`='".$stockdata['id']."' AND `approve_status`='1' AND `staffid`='".get_staff_user_id()."'")->result_array();
							if(count($stockapprovalacceptcheck)>=1)
							{?>
								<div style="text-align: center;font-size: 19px;color: green;padding: 7px;font-weight: 500;">Stock is already Accepted.</div>
						<?php
							}
							$stockapprovaldeclinecheck=$this->db->query("SELECT * FROM `tblstockapproval` WHERE `warehousestockid`='".$stockdata['id']."' AND `approve_status`='2' AND `staffid`='".get_staff_user_id()."'")->result_array();
							if(count($stockapprovaldeclinecheck)>=1)
							{?>
								<div style="color:red;text-align: center;font-size: 19px;padding: 7px;font-weight: 500;">Stock is already Decline.</div>
						<?php
							}?>
							<div class="leadaccept" style="display:none;    text-align: center;font-size: 19px;color: green;padding: 7px;font-weight: 500;">Stock is Accept Successfully.</div>
							<div class="leaddecline" style="display:none;    text-align: center;font-size: 19px;color: red;padding: 7px;font-weight: 500;">Stock is Decline Successfully.</div>
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
<script>
//     $('.approval').click(function()
//    {
// 	  var warehousestockid=$(this).attr('val');
// 	  var approve_status=$(this).attr('value');
// 	  var warehousestockcreatorid=$('#addedfrom').val();
// 	  var stockapprov_desc=$('.stockapprov_desc').val();
// 	  var url = '<?php echo base_url(); ?>admin/Stock/approvestock';
// 	  if(stockapprov_desc.trim()!='')
// 	  {
// 	  $.post(url,
// 				{
// 					approve_status: approve_status,
// 					warehousestockid: warehousestockid,
// 					warehousestockcreatorid: warehousestockcreatorid,
// 					approvereason: stockapprov_desc,
// 				},
// 				function (data, status) {
// 					if(approve_status==1)
// 					{
// 						$('.leadsdv').hide();
// 						$('.leadaccept').show();
// 					}
// 					if(approve_status==2)
// 					{
// 						$('.leadsdv').hide();
// 						$('.leaddecline').show();
// 					}
// 				});
// 	  }
// 	  else
// 	  {
// 		  if(warehousestockcreatorid=='')
// 		  {
// 			$('.warehousestockcreatorid').addClass('error');  
// 		  }
// 		  else
// 		  {
// 			$('.warehousestockcreatorid').removeClass('error');    
// 		  }
// 	  }
//    });
</script>
</body>
</html>
