<?php
$session_id = $this->session->userdata();
init_head();
?>
<style>#address{margin: 0px 1.5px 0px 0px;height: 112px;width: 508px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            
            
		<?php
			$warehouse_id = $challan_info->warehouse_id;
			$get_warehouse_details=$this->db->query("SELECT * FROM `tblwarehouse` WHERE `id`='".$warehouse_id."'")->row_array();
			$warehouse_name=$get_warehouse_details['name'];


            $client_info=$this->db->query("SELECT * FROM `tblclients` WHERE `userid`='".$challan_info->clientid."'")->row();

            $product_details = json_decode($challan_info->product_json);
            $productpickup_details = json_decode($return_info->product_json);

        ?>
			
            <div class="col-md-12">
				
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="modal-body" id="stockavdv">
                          
							<table class="table credite-note-items-table items table-main-credit-note-edit no-mtop">
								<tbody class="ui-sortable" style="font-size:15px;">
								<tr>
									<td><b>Chalan No :</b></td>
									<td><?php echo $challan_info->chalanno;?></td>
									<td><b>Warehouse :</b></td>
									<td><?php echo $warehouse_name;?></td>
								</tr>
							
								<tr >
									<td><b>Client Name :</b></td>
                                    <td><?php if(!empty($client_info)){ echo $client_info->company; }else{ echo '--'; } ?></td>
									<td><b>Service Type :</b></td>
									<td>Challan For <?php echo value_by_id('tblenquiryformaster',$challan_info->service_type,'name'); ?></td>
								</tr>
								
								</tbody>
							</table>


                            <div class="col-md-6">
                                <h4 class="text-center">Challan Product Details</h4>
                                 <div class="tabel-responsive" style="margin-bottom:30px;">
                             <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable">
                                    <thead>
                                        <tr>
                                            <th align="center">S.No</th>
                                            <th align="center">Product Name</th>
                                            <th align="center">Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable">
                                        <?php
                                        if(!empty($product_details)){
                                            $i =  1;
                                            foreach ($product_details as $value) {
                                                ?>
                                                <tr>
                                                    <td align="center"><?php echo $i++; ?></td>
                                                    <td align="center"><?php echo value_by_id('tblproducts',$value->product_id,'name')." (PRO - " . number_series($value->product_id).')'; ?></td>
                                                    <td align="center"><?php echo $value->product_qty; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h4 class="text-center">Pickup Product Details</h4>
                                 <div class="tabel-responsive" style="margin-bottom:30px;">
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable">
                                    <thead>
                                        <tr>
                                            <th align="center">S.No</th>
                                            <th align="center">Product Name</th>
                                            <th align="center">Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable">
                                        <?php
                                        if(!empty($productpickup_details)){
                                            $i =  1;
                                            foreach ($productpickup_details as $value) {
                                                ?>
                                                <tr>
                                                    <td align="center"><?php echo $i++; ?></td>
                                                    <td align="center"><?php echo value_by_id('tblproducts',$value->product_id,'name')." (PRO - " . number_series($value->product_id).')'; ?></td>
                                                    <td align="center"><?php echo $value->taken_qty; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>

                                </table>
                                </div>
                            </div>
                            
                           
                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2% !important;">
                                <thead>
                                    <tr>
                                        <th align="center">S.No</th>
                                        <th align="center">Item Name</th>
                                        <th align="center">Total</th>
                                        <th align="center">Ok</th>
                                        <th align="center">Non Repairable</th>
                                        <th align="center">Repairable</th>
                                        <th align="center">Lost</th>
                                        <th align="center">Pending</th>
                                        <th align="center">Remark</th>
                                    </tr>
                                </thead>
                                <tbody class="ui-sortable" style="font-size:15px;">
                                <?php
                                if(!empty($returndtl_info)){
                                    $i = 1;
                                    foreach ($returndtl_info as $key => $value) {
                                        ?>
                                        <tr>
                                            <td align="center"><?php echo $i++; ?></td>
                                            <td align="center"><?php echo value_by_id('tblproducts',$value->component_id,'name'); ?></td>
                                            <td align="center"><?php echo $value->total; ?></td>
                                            <td align="center"><?php echo $value->ok; ?></td>
                                            <td align="center"><?php echo $value->non_repairable; ?></td>
                                            <td align="center"><?php echo $value->repairable; ?></td>
                                            <td align="center"><?php echo $value->lost; ?></td>
                                            <td align="center"><?php echo $value->pending; ?></td>
                                            <td align="center"><?php echo $value->remark; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
							
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>
    <?php init_tail(); ?>
  
</body>
</html>
