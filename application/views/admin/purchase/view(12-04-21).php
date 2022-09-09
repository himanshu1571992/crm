<?php init_head(); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" type="text/css" />
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .button3 {background-color: #800000;}
</style>
<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('purchase'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">

                    <div class="row panelHead">
                        <div class="col-xs-12 col-md-6">
                            <h4><?php echo $title; if(check_permission_page(40,'create')){ ?></h4>
                        </div>
                        <div class="col-xs-12 col-md-6 text-right">
                            <a href="<?php echo admin_url('purchase/purchase_order'); ?>" class="btn btn-info">Create Purchase Order</a><?php } ?>
                        </div>
                    </div>

					<hr class="hr-panel-heading">
					
					<div class="row">
						<div class="form-group col-md-4">
                            <label for="vendor_id" class="control-label">Select Vendor</label>
                            <select class="form-control selectpicker vendor_id" data-live-search="true" id="vendor_id" name="vendor_id">
                                <option value=""></option>
                                <?php
                                if (isset($vendors_info) && count($vendors_info) > 0) {
                                    foreach ($vendors_info as $vendor_value) {
                                        ?>
                                        <option value="<?php echo $vendor_value['id']; ?>" <?php if(!empty($vendor_id) && $vendor_id == $vendor_value['id']){ echo 'selected'; } ?>><?php echo cc($vendor_value['name']); ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="product_id" class="control-label">Select Product</label>
                            <select class="form-control selectpicker product_id" data-live-search="true" id="product_id" name="product_id">
                                <option value=""></option>
                                <?php
                                if (isset($product_info) && count($product_info) > 0) {
                                    foreach ($product_info as $product_value) {
                                        ?>
                                        <option value="<?php echo $product_value['id']; ?>" <?php if(!empty($product_id) && $product_id == $product_value['id']){ echo 'selected'; } ?>><?php echo cc($product_value['name']); ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
					
						<div class="form-group col-md-2">
                            <label for="status" class="control-label">Status</label>
                            <select class="form-control selectpicker" data-live-search="true" name="status">
                                <option value=""></option>
                                <option value="0" <?php if(isset($s_status) && $s_status == 0){ echo 'selected'; } ?>>Pending</option>
                                <option value="1" <?php if(isset($s_status) && $s_status == 1){ echo 'selected'; } ?>>Approved</option>
                                <option value="2" <?php if(isset($s_status) && $s_status == 2){ echo 'selected'; } ?>>Rejected</option>
                                <option value="3" <?php if(isset($s_status) && $s_status == 3){ echo 'selected'; } ?>>Cancelled</option>
                                <option value="4" <?php if(isset($s_status) && $s_status == 4){ echo 'selected'; } ?>>Reconciliation</option>
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="invoice_status" class="control-label">Invoice Status</label>
                            <select class="form-control selectpicker" data-live-search="true" name="invoice_status">
                                <option value=""></option>
                                <option value="1" <?php if(isset($invoice_status) && $invoice_status == 1){ echo 'selected'; } ?>>Invoice Received</option>
                                <option value="0" <?php if(isset($invoice_status) && $invoice_status == 0){ echo 'selected'; } ?>>Invoice Not Received</option>
                            </select>
                        </div>
						
						<div class="form-group col-md-2" app-field-wrapper="date">
							<label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
							<div class="input-group date">
								<input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="form-group col-md-2" app-field-wrapper="date">
							<label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
							<div class="input-group date">
								<input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>

						<div class="form-group col-md-3">
                            <label for="mr_status" class="control-label">Material Status</label>
                            <select class="form-control selectpicker" data-live-search="true" name="mr_status">
                                <option value=""></option>                                
                                <option value="1" <?php if(isset($mr_status) && $mr_status == 1){ echo 'selected'; } ?>>Material Received</option>
                                <option value="0" <?php if(isset($mr_status) && $mr_status == 0){ echo 'selected'; } ?>>Material Not Received</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="payment_status" class="control-label">Payment Status</label>
                            <select class="form-control selectpicker" data-live-search="true" name="payment_status">
                                <option value=""></option>
                                <option value="1" <?php if(isset($payment_status) && $payment_status == 1){ echo 'selected'; } ?>>0.00 %</option>
                                <option value="2" <?php if(isset($payment_status) && $payment_status == 2){ echo 'selected'; } ?>>100.00 %</option>
                                <option value="3" <?php if(isset($payment_status) && $payment_status == 3){ echo 'selected'; } ?>>Less Than 100%</option>
                                <option value="4" <?php if(isset($payment_status) && $payment_status == 4){ echo 'selected'; } ?>>More Than 100%</option>
                            </select>
                        </div>
                        
						
						<div class="col-md-1">                            
                        <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                        </div>

						<div class="col-md-12">
							<hr>
						</div>

						<div class="col-md-12 table-responsive">																
								<table class="table" id="newtable">
									<thead>
									  <tr>
										<th>S.No.</th>
										<th>Number</th>
										<th>Vendor</th>
										<th>Warehouse/Site</th>
										<th>Date</th>
										<th>Total Amount</th>
                                        <th>Percent</th>
										<th width="10%">Status</th>
										<th>Action</th>
										
									  </tr>
									</thead>
									<tbody>
									<?php
                                    $ttl_amt=0;
									if(!empty($purchaseorder_list)){
										$z=1;
                    
										foreach($purchaseorder_list as $row){	
                                            

											if($row->status == 0){
												$status = 'Pending';
												$cls = 'btn-warning';
											}elseif($row->status == 1){
												$status = 'Approved';
												$cls = 'btn-success';
											}elseif($row->status == 2){
												$status = 'Rejected';
												$cls = 'btn-danger';
											}elseif($row->status == 4){
                                                $status = 'Reconciliation';
                                                $cls = 'btn-danger button3';
                                            }

											$can_edit = $this->db->query("SELECT * from tblpurchaseorderapproval where po_id = '".$row->id."' and (approve_status = 1 || approve_status = 2) ")->row_array();

                                            $recon_edit = $this->db->query("SELECT * from tblpurchaseorderapproval where po_id = '".$row->id."' and approve_status = 4 ")->row_array();

                                            $sub_po_exist = $this->db->query("SELECT id FROM `tblpurchaseorder` where id IN (".$row->parent_ids.") and id != '".$row->id."' ")->row();
                                            $percent = purchase_percent($row->id,$row->totalamount);

                                            if(!empty($payment_status) && $payment_status == 1 && ($percent == '0.00')){
                                                
                                                $ttl_amt += $row->totalamount;
                                            ?>                                                                                      
                                            <tr>
                                                <td><?php echo $z++;?></td>
                                                <td><?php echo 'PO-'.$row->number;?></td>
                                                <td><?php echo cc(value_by_id('tblvendor',$row->vendor_id,'name'));?></td>
                                                <td>
                                                <?php 
                                                if($row->source_type ==1) {
                                                    echo cc(value_by_id('tblwarehouse',$row->warehouse_id,'name'));
                                                }else{
                                                    echo cc(value_by_id('tblsitemanager',$row->site_id,'name'));
                                                } 
                                                ?>                                                    
                                                </td>
                                                <td><?php echo date('d/m/Y',strtotime($row->date)); ?></td>
                                                <td><?php echo $row->totalamount;?></td>
                                                <td>
                                                  <?php
                                                   
                                                   echo '<button type="button" class="btn-sm btn-info percent" value="'.$row->id.'" data-toggle="modal" data-target="#myModalpercent">'.$percent.' %</button>';
                                                 ?> 
                                               </td>
                                                <td>

                                                   

                                                    <?php
                                                    
                                                    if($row->cancel == 1){
                                                        echo '<button disabled class="btn-sm btn-danger">Cancelled</button>';
                                                    }else{
                                                        echo '<button type="button" class="'.$cls.' btn-sm status" value="'.$row->id.'" data-toggle="modal" data-target="#myModal">'.$status.'</button>';
                                                        
                                                    }
                                                    if($row->revised > 0 || $row->revised_id > 0){
                                                      echo ' <span style="color: green;"><i class="fa fa-registered" aria-hidden="true"></i></span>';  
                                                    }
                                                    ?>
                                                </td>   
                                                <td class="text-center">
                                                    <a class="tableBtn" title="View" target="_blank" href="<?php  echo admin_url('purchase/purchaseorder_view/'.$row->id); ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                    

                                                    <?php 
                                                    if($row->cancel == 0){

                                                    if(empty($can_edit)){

                                                        if($row->save == 1){
                                                            echo '<a class="tableBtn" title="Send Approval" target="_blank" href="'.admin_url('purchase/purchase_order/'.$row->id).'"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>';
                                                        }else{
                                                            if(check_permission_page(40,'edit')){
                                                            echo '<a class="tableBtn" title="Edit" target="_blank" href="'.admin_url('purchase/purchase_order/'.$row->id).'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                                                            }else{
                                                                echo '--';
                                                            }
                                                        }

                                                        
                                                    }
                                                    else
                                                    {
                                                        if(!empty($recon_edit))
                                                        {
                                                          if(check_permission_page(40,'edit')){
                                                            echo '<a class="tableBtn" title="Edit" target="_blank" href="'.admin_url('purchase/purchase_order/'.$row->id).'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                                                            }  
                                                        }

                                                    }
                                                    ?>

                                                    <?php echo '<button type="button" title="Uplaod" class="tableBtn uplaods" value="'.$row->id.'" data-toggle="modal" data-target="#upload_modal"><i class="fa fa-upload" aria-hidden="true"></i></button>'; ?>

                                                    <div class="btn-group">
                                                         <button type="button" class="tableBtn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                         </button>
                                                         <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                            <li>
                                                                <?php
                                                                    if($row->status == 1){
                                                                ?>
                                                                <a  title="View" target="_blank" href="<?php  echo admin_url('purchase/download_pdf/'.$row->id); ?>">PDF</a>
                                                                <?php
                                                                }
                                                                ?>
                                                                <a  title="View" target="_blank" href="<?php  echo admin_url('purchase/view_pdf/'.$row->id); ?>">View</a>
                                                                <a  title="View" target="_blank" href="<?php  echo admin_url('purchase/purchaseorder_payments/'.$row->id); ?>">Payments</a>
                                                                <?php
                                                                if(!empty($sub_po_exist)){
                                                                ?>
                                                                  <a  title="View" target="_blank" href="<?php  echo admin_url('purchase/purchaseorder_sub_po/'.$row->id); ?>">Sub PO List</a>
                                                                <?php  
                                                                }
                                                                ?>
                                                                
                                                               <a style="color: red;" class="text-danger _delete" href="<?php echo admin_url('purchase/cancelpo/'.$row->id);?>" data-status="1">CANCEL</a>
                                                               <?php
                                                                if((check_permission_page(40,'delete')) && (empty($can_edit))){
                                                                    ?>
                                                                    <a style="color: red;" class="text-danger _delete" href="<?php echo admin_url('purchase/deletepo/'.$row->id);?>" data-status="1">DELETE</a> 
                                                                <?php
                                                                }
                                                                
                                                                if($row->status == 1){
                                   
                                                                    ?>
                                                                    <a target="_blank" href="<?php echo admin_url('purchase/purchaseorder_renewal/'.$row->id);?>" data-status="1">RENEWAL</a>   
                                                                <?php
                                                                }
                                                                ?>
                                                                <a href="javascript:void(0);" class="btn-with-tooltip send-email" data-id="<?php echo $row->id; ?>" data-vid="<?php echo $row->vendor_id; ?>"  data-target="#send_mainto_customer" id="send_mail" data-toggle="modal">
                                                                    Send Mail
                                                                </a>    
                                                            </li>
                                                         </ul>
                                                    </div>

                                                    <?php
                                                    }
                                                    ?>
                                                    
                                                </td>
                                                
                                            </tr>
                                            <?php
                                            }elseif(!empty($payment_status) && $payment_status == 2 && $percent == 100){

                                                $ttl_amt += $row->totalamount;
                                            ?>                                                                                      
                                            <tr>
                                                <td><?php echo $z++;?></td>
                                                <td><?php echo 'PO-'.$row->number;?></td>
                                                <td><?php echo cc(value_by_id('tblvendor',$row->vendor_id,'name'));?></td>
                                                <td>
                                                <?php 
                                                if($row->source_type ==1) {
                                                    echo cc(value_by_id('tblwarehouse',$row->warehouse_id,'name'));
                                                }else{
                                                    echo cc(value_by_id('tblsitemanager',$row->site_id,'name'));
                                                } 
                                                ?>                                                    
                                                </td>
                                                <td><?php echo date('d/m/Y',strtotime($row->date)); ?></td>
                                                <td><?php echo $row->totalamount;?></td>
                                                <td>
                                                  <?php
                                                   
                                                   echo '<button type="button" class="btn-sm btn-info percent" value="'.$row->id.'" data-toggle="modal" data-target="#myModalpercent">'.$percent.' %</button>';
                                                 ?> 
                                               </td>
                                                <td>

                                                   

                                                    <?php
                                                    
                                                    if($row->cancel == 1){
                                                        echo '<button disabled class="btn-sm btn-danger">Cancelled</button>';
                                                    }else{
                                                        echo '<button type="button" class="'.$cls.' btn-sm status" value="'.$row->id.'" data-toggle="modal" data-target="#myModal">'.$status.'</button>';
                                                        
                                                    }
                                                    if($row->revised > 0 || $row->revised_id > 0){
                                                      echo ' <span style="color: green;"><i class="fa fa-registered" aria-hidden="true"></i></span>';  
                                                    }
                                                    ?>
                                                </td>   
                                                <td class="text-center">
                                                    <a class="tableBtn" title="View" target="_blank" href="<?php  echo admin_url('purchase/purchaseorder_view/'.$row->id); ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                    

                                                    <?php 
                                                    if($row->cancel == 0){

                                                    if(empty($can_edit)){

                                                        if($row->save == 1){
                                                            echo '<a class="tableBtn" title="Send Approval" target="_blank" href="'.admin_url('purchase/purchase_order/'.$row->id).'"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>';
                                                        }else{
                                                            if(check_permission_page(40,'edit')){
                                                            echo '<a class="tableBtn" title="Edit" target="_blank" href="'.admin_url('purchase/purchase_order/'.$row->id).'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                                                            }else{
                                                                echo '--';
                                                            }
                                                        }

                                                        
                                                    }
                                                    ?>

                                                    <?php echo '<button type="button" title="Uplaod" class="tableBtn uplaods" value="'.$row->id.'" data-toggle="modal" data-target="#upload_modal"><i class="fa fa-upload" aria-hidden="true"></i></button>'; ?>

                                                    <div class="btn-group">
                                                         <button type="button" class="tableBtn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                         </button>
                                                         <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                            <li>
                                                                <?php
                                                                    if($row->status == 1){
                                                                ?>
                                                                <a  title="View" target="_blank" href="<?php  echo admin_url('purchase/download_pdf/'.$row->id); ?>">PDF</a>
                                                                <?php
                                                                }
                                                                ?>
                                                                <a  title="View" target="_blank" href="<?php  echo admin_url('purchase/view_pdf/'.$row->id); ?>">View</a>
                                                                <a  title="View" target="_blank" href="<?php  echo admin_url('purchase/purchaseorder_payments/'.$row->id); ?>">Payments</a>
                                                                <?php
                                                                if(!empty($sub_po_exist)){
                                                                ?>
                                                                  <a  title="View" target="_blank" href="<?php  echo admin_url('purchase/purchaseorder_sub_po/'.$row->id); ?>">Sub PO List</a>
                                                                <?php  
                                                                }
                                                                ?>
                                                                
                                                               <a style="color: red;" class="text-danger _delete" href="<?php echo admin_url('purchase/cancelpo/'.$row->id);?>" data-status="1">CANCEL</a>
                                                               <?php
                                                                if((check_permission_page(40,'delete')) && (empty($can_edit))){
                                                                    ?>
                                                                    <a style="color: red;" class="text-danger _delete" href="<?php echo admin_url('purchase/deletepo/'.$row->id);?>" data-status="1">DELETE</a> 
                                                                <?php
                                                                }
                                                                
                                                                if($row->status == 1){
                                   
                                                                    ?>
                                                                    <a target="_blank" href="<?php echo admin_url('purchase/purchaseorder_renewal/'.$row->id);?>" data-status="1">RENEWAL</a>   
                                                                <?php
                                                                }
                                                                ?>
                                                                    <a href="javascript:void(0);" class="btn-with-tooltip send-email" data-id="<?php echo $row->id; ?>" data-vid="<?php echo $row->vendor_id; ?>"  data-target="#send_mainto_customer" id="send_mail" data-toggle="modal">
                                                                    Send Mail
                                                                </a> 
                                                            </li>
                                                         </ul>
                                                    </div>

                                                    <?php
                                                    }
                                                    ?>
                                                    
                                                </td>
                                                
                                            </tr>
                                            <?php
                                            }elseif(!empty($payment_status) && $payment_status == 3 && $percent < 100 && $percent != 0){

                                                $ttl_amt += $row->totalamount;
                                            ?>                                                                                      
                                            <tr>
                                                <td><?php echo $z++;?></td>
                                                <td><?php echo 'PO-'.$row->number;?></td>
                                                <td><?php echo cc(value_by_id('tblvendor',$row->vendor_id,'name'));?></td>
                                                <td>
                                                <?php 
                                                if($row->source_type ==1) {
                                                    echo cc(value_by_id('tblwarehouse',$row->warehouse_id,'name'));
                                                }else{
                                                    echo cc(value_by_id('tblsitemanager',$row->site_id,'name'));
                                                } 
                                                ?>                                                    
                                                </td>
                                                <td><?php echo date('d/m/Y',strtotime($row->date)); ?></td>
                                                <td><?php echo $row->totalamount;?></td>
                                                <td>
                                                  <?php
                                                   
                                                   echo '<button type="button" class="btn-sm btn-info percent" value="'.$row->id.'" data-toggle="modal" data-target="#myModalpercent">'.$percent.' %</button>';
                                                 ?> 
                                               </td>
                                                <td>

                                                   

                                                    <?php
                                                    
                                                    if($row->cancel == 1){
                                                        echo '<button disabled class="btn-sm btn-danger">Cancelled</button>';
                                                    }else{
                                                        echo '<button type="button" class="'.$cls.' btn-sm status" value="'.$row->id.'" data-toggle="modal" data-target="#myModal">'.$status.'</button>';
                                                        
                                                    }
                                                    if($row->revised > 0 || $row->revised_id > 0){
                                                      echo ' <span style="color: green;"><i class="fa fa-registered" aria-hidden="true"></i></span>';  
                                                    }
                                                    ?>
                                                </td>   
                                                <td class="text-center">
                                                    <a class="tableBtn" title="View" target="_blank" href="<?php  echo admin_url('purchase/purchaseorder_view/'.$row->id); ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                    

                                                    <?php 
                                                    if($row->cancel == 0){

                                                    if(empty($can_edit)){

                                                        if($row->save == 1){
                                                            echo '<a class="tableBtn" title="Send Approval" target="_blank" href="'.admin_url('purchase/purchase_order/'.$row->id).'"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>';
                                                        }else{
                                                            if(check_permission_page(40,'edit')){
                                                            echo '<a class="tableBtn" title="Edit" target="_blank" href="'.admin_url('purchase/purchase_order/'.$row->id).'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                                                            }else{
                                                                echo '--';
                                                            }
                                                        }

                                                        
                                                    }
                                                    ?>

                                                    <?php echo '<button type="button" title="Uplaod" class="tableBtn uplaods" value="'.$row->id.'" data-toggle="modal" data-target="#upload_modal"><i class="fa fa-upload" aria-hidden="true"></i></button>'; ?>

                                                    <div class="btn-group">
                                                         <button type="button" class="tableBtn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                         </button>
                                                         <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                            <li>
                                                                <?php
                                                                    if($row->status == 1){
                                                                ?>
                                                                <a  title="View" target="_blank" href="<?php  echo admin_url('purchase/download_pdf/'.$row->id); ?>">PDF</a>
                                                                <?php
                                                                }
                                                                ?>
                                                                <a  title="View" target="_blank" href="<?php  echo admin_url('purchase/view_pdf/'.$row->id); ?>">View</a>
                                                                <a  title="View" target="_blank" href="<?php  echo admin_url('purchase/purchaseorder_payments/'.$row->id); ?>">Payments</a>
                                                                <?php
                                                                if(!empty($sub_po_exist)){
                                                                ?>
                                                                  <a  title="View" target="_blank" href="<?php  echo admin_url('purchase/purchaseorder_sub_po/'.$row->id); ?>">Sub PO List</a>
                                                                <?php  
                                                                }
                                                                ?>
                                                                
                                                               <a style="color: red;" class="text-danger _delete" href="<?php echo admin_url('purchase/cancelpo/'.$row->id);?>" data-status="1">CANCEL</a>
                                                               <?php
                                                                if((check_permission_page(40,'delete')) && (empty($can_edit))){
                                                                    ?>
                                                                    <a style="color: red;" class="text-danger _delete" href="<?php echo admin_url('purchase/deletepo/'.$row->id);?>" data-status="1">DELETE</a> 
                                                                <?php
                                                                }
                                                                
                                                                if($row->status == 1){
                                   
                                                                    ?>
                                                                    <a target="_blank" href="<?php echo admin_url('purchase/purchaseorder_renewal/'.$row->id);?>" data-status="1">RENEWAL</a>   
                                                                <?php
                                                                }
                                                                ?>
                                                                    <a href="javascript:void(0);" class="btn-with-tooltip send-email" data-id="<?php echo $row->id; ?>" data-vid="<?php echo $row->vendor_id; ?>"  data-target="#send_mainto_customer" id="send_mail" data-toggle="modal">
                                                                    Send Mail
                                                                </a> 
                                                            </li>
                                                         </ul>
                                                    </div>

                                                    <?php
                                                    }
                                                    ?>
                                                    
                                                </td>
                                                
                                            </tr>
                                            <?php
                                            }elseif(!empty($payment_status) && $payment_status == 4 && $percent > 100 ){

                                                $ttl_amt += $row->totalamount;
                                            ?>                                                                                      
                                            <tr>
                                                <td><?php echo $z++;?></td>
                                                <td><?php echo 'PO-'.$row->number;?></td>
                                                <td><?php echo cc(value_by_id('tblvendor',$row->vendor_id,'name'));?></td>
                                                <td>
                                                <?php 
                                                if($row->source_type ==1) {
                                                    echo cc(value_by_id('tblwarehouse',$row->warehouse_id,'name'));
                                                }else{
                                                    echo cc(value_by_id('tblsitemanager',$row->site_id,'name'));
                                                } 
                                                ?>                                                    
                                                </td>
                                                <td><?php echo date('d/m/Y',strtotime($row->date)); ?></td>
                                                <td><?php echo $row->totalamount;?></td>
                                                <td>
                                                  <?php
                                                   
                                                   echo '<button type="button" class="btn-sm btn-info percent" value="'.$row->id.'" data-toggle="modal" data-target="#myModalpercent">'.$percent.' %</button>';
                                                 ?> 
                                               </td>
                                                <td>

                                                   

                                                    <?php
                                                    
                                                    if($row->cancel == 1){
                                                        echo '<button disabled class="btn-sm btn-danger">Cancelled</button>';
                                                    }else{
                                                        echo '<button type="button" class="'.$cls.' btn-sm status" value="'.$row->id.'" data-toggle="modal" data-target="#myModal">'.$status.'</button>';
                                                        
                                                    }
                                                    if($row->revised > 0 || $row->revised_id > 0){
                                                      echo ' <span style="color: green;"><i class="fa fa-registered" aria-hidden="true"></i></span>';  
                                                    }
                                                    ?>
                                                </td>   
                                                <td class="text-center">
                                                    <a class="tableBtn" title="View" target="_blank" href="<?php  echo admin_url('purchase/purchaseorder_view/'.$row->id); ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                    

                                                    <?php 
                                                    if($row->cancel == 0){

                                                    if(empty($can_edit)){

                                                        if($row->save == 1){
                                                            echo '<a class="tableBtn" title="Send Approval" target="_blank" href="'.admin_url('purchase/purchase_order/'.$row->id).'"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>';
                                                        }else{
                                                            if(check_permission_page(40,'edit')){
                                                            echo '<a class="tableBtn" title="Edit" target="_blank" href="'.admin_url('purchase/purchase_order/'.$row->id).'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                                                            }else{
                                                                echo '--';
                                                            }
                                                        }

                                                        
                                                    }
                                                    ?>

                                                    <?php echo '<button type="button" title="Uplaod" class="tableBtn uplaods" value="'.$row->id.'" data-toggle="modal" data-target="#upload_modal"><i class="fa fa-upload" aria-hidden="true"></i></button>'; ?>

                                                    <div class="btn-group">
                                                         <button type="button" class="tableBtn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                         </button>
                                                         <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                            <li>
                                                                <?php
                                                                    if($row->status == 1){
                                                                ?>
                                                                <a  title="View" target="_blank" href="<?php  echo admin_url('purchase/download_pdf/'.$row->id); ?>">PDF</a>
                                                                <?php
                                                                }
                                                                ?>
                                                                <a  title="View" target="_blank" href="<?php  echo admin_url('purchase/view_pdf/'.$row->id); ?>">View</a>
                                                                <a  title="View" target="_blank" href="<?php  echo admin_url('purchase/purchaseorder_payments/'.$row->id); ?>">Payments</a>
                                                                <?php
                                                                if(!empty($sub_po_exist)){
                                                                ?>
                                                                  <a  title="View" target="_blank" href="<?php  echo admin_url('purchase/purchaseorder_sub_po/'.$row->id); ?>">Sub PO List</a>
                                                                <?php  
                                                                }
                                                                ?>
                                                                
                                                               <a style="color: red;" class="text-danger _delete" href="<?php echo admin_url('purchase/cancelpo/'.$row->id);?>" data-status="1">CANCEL</a>
                                                               <?php
                                                                if((check_permission_page(40,'delete')) && (empty($can_edit))){
                                                                    ?>
                                                                    <a style="color: red;" class="text-danger _delete" href="<?php echo admin_url('purchase/deletepo/'.$row->id);?>" data-status="1">DELETE</a> 
                                                                <?php
                                                                }
                                                                
                                                                if($row->status == 1){
                                   
                                                                    ?>
                                                                    <a target="_blank" href="<?php echo admin_url('purchase/purchaseorder_renewal/'.$row->id);?>" data-status="1">RENEWAL</a>   
                                                                <?php
                                                                }
                                                                ?>
                                                                    <a href="javascript:void(0);" class="btn-with-tooltip send-email" data-id="<?php echo $row->id; ?>" data-vid="<?php echo $row->vendor_id; ?>"  data-target="#send_mainto_customer" id="send_mail" data-toggle="modal">
                                                                    Send Mail
                                                                </a> 
                                                            </li>
                                                         </ul>
                                                    </div>

                                                    <?php
                                                    }
                                                    ?>
                                                    
                                                </td>
                                                
                                            </tr>
                                            <?php
                                            }

                                            if(empty($payment_status)){

                                             $ttl_amt += $row->totalamount;
											?>																						
											<tr>
												<td><?php echo $z++;?></td>
												<td><?php echo 'PO-'.$row->number;?></td>
												<td><?php echo cc(value_by_id('tblvendor',$row->vendor_id,'name'));?></td>
												<td>
                                                <?php 
                                                if($row->source_type ==1) {
                                                    echo cc(value_by_id('tblwarehouse',$row->warehouse_id,'name'));
                                                }else{
                                                    echo cc(value_by_id('tblsitemanager',$row->site_id,'name'));
                                                } 
                                                ?>                                                    
                                                </td>
												<td><?php echo date('d/m/Y',strtotime($row->date)); ?></td>
												<td><?php echo $row->totalamount;?></td>
                                                <td>
                                                  <?php
                                                   
                                                   echo '<button type="button" class="btn-sm btn-info percent" value="'.$row->id.'" data-toggle="modal" data-target="#myModalpercent">'.$percent.' %</button>';
                                                 ?> 
                                               </td>
												<td>

                                                   

													<?php
                                                    
													if($row->cancel == 1){
														echo '<button disabled class="btn-sm btn-danger">Cancelled</button>';
													}else{
														echo '<button type="button" class="'.$cls.' btn-sm status" value="'.$row->id.'" data-toggle="modal" data-target="#myModal">'.$status.'</button>';
														
													}
                                                    if($row->revised > 0 || $row->revised_id > 0){
                                                      echo ' <span style="color: green;"><i class="fa fa-registered" aria-hidden="true"></i></span>';  
                                                    }
													?>
												</td>	
												<td class="text-center">
													<a class="tableBtn" title="View" target="_blank" href="<?php  echo admin_url('purchase/purchaseorder_view/'.$row->id); ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
													

													<?php 
													if($row->cancel == 0){

													if(empty($can_edit)){

														if($row->save == 1){
															echo '<a class="tableBtn" title="Send Approval" target="_blank" href="'.admin_url('purchase/purchase_order/'.$row->id).'"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>';
														}else{
															if(check_permission_page(40,'edit')){
															echo '<a class="tableBtn" title="Edit" target="_blank" href="'.admin_url('purchase/purchase_order/'.$row->id).'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
															}else{
																echo '--';
															}
														}

														
													}
													?>

													<?php echo '<button type="button" title="Uplaod" class="tableBtn uplaods" value="'.$row->id.'" data-toggle="modal" data-target="#upload_modal"><i class="fa fa-upload" aria-hidden="true"></i></button>'; ?>

													<div class="btn-group">
                                                         <button type="button" class="tableBtn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                         </button>
                                                         <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                            <li>
                                                            	<?php
                                                                    if($row->status == 1){
                                                                ?>
                                                                <a  title="View" target="_blank" href="<?php  echo admin_url('purchase/download_pdf/'.$row->id); ?>">PDF</a>
                                                                <?php
                                                                }
                                                                ?>
                                                                <a  title="View" target="_blank" href="<?php  echo admin_url('purchase/view_pdf/'.$row->id); ?>">View</a>
                                                               	<a  title="View" target="_blank" href="<?php  echo admin_url('purchase/purchaseorder_payments/'.$row->id); ?>">Payments</a>
                                                                <?php
                                                                if(!empty($sub_po_exist)){
                                                                ?>
                                                                  <a  title="View" target="_blank" href="<?php  echo admin_url('purchase/purchaseorder_sub_po/'.$row->id); ?>">Sub PO List</a>
                                                                <?php  
                                                                }
                                                                ?>
                                                                
                                                               <a style="color: red;" class="text-danger _delete" href="<?php echo admin_url('purchase/cancelpo/'.$row->id);?>" data-status="1">CANCEL</a>
															   <?php
																if((check_permission_page(40,'delete')) && (empty($can_edit))){
																	?>
																	<a style="color: red;" class="text-danger _delete" href="<?php echo admin_url('purchase/deletepo/'.$row->id);?>" data-status="1">DELETE</a>	
																<?php
																}
																
																if($row->status == 1){
                                   
																	?>
																	<a target="_blank" href="<?php echo admin_url('purchase/purchaseorder_renewal/'.$row->id);?>" data-status="1">RENEWAL</a>	
																<?php
																}
																?>
                                                                <a href="javascript:void(0);" class="btn-with-tooltip send-email" data-id="<?php echo $row->id; ?>" data-vid="<?php echo $row->vendor_id; ?>"  data-target="#send_mainto_customer" id="send_mail" data-toggle="modal">
                                                                    Send Mail
                                                                </a>                                                                         
                                                            </li>
                                                         </ul>
                                                    </div>

                                                    <?php
                                                	}
                                                    ?>
													
												</td>
												
											</tr>
											<?php
                                            }
										}
									}else{
										echo '<tr><td class="text-center" colspan="8"><h5>Record Not Found</h5></td></tr>';
									}
									?>
									  
									 
									</tbody>
                                    <tfoot>
                                          <tr>
                                              <td align="" colspan="5">Total</td>
                                              <td align=""><b><?php  echo number_format($ttl_amt, 2, '.', ''); ?></b></td>
                                              <td align="center" colspan="3"></td>
                                          </tr>
                                    </tfoot>
								  </table>
							</div>


													
					</div>
					
					 <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'salary-form')); ?>
                       
							
							
						<div class="btn-bottom-toolbar text-right">
                           
                        </div>
                        </div>
                       
                    </div>
                </div>
             
            </form>
		</div>		
        <div class="btn-bottom-pusher"></div>
    </div>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Assigned Person</h4>
      </div>
      <div class="modal-body">
       	<div id="approval_html"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="myModalpercent" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:900px;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Purchase Order Payments Details</h4>
      </div>
      <div class="modal-body">
        <div id="payment_percent"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="upload_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title upload_title">Material Receipt Uploads</h4>
      </div>
      <div class="modal-body">
        
        <div id="upload_data">
            
        </div>

        <form action="<?php echo admin_url('purchase/po_upload'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="row">

                <div class="form-group col-md-12">
                    <label for="file" class="control-label"><?php echo 'Upload File'; ?></label>
                    <input type="file" id="file" multiple="" name="file[]" style="width: 100%;">
                </div>
                
                <input type="hidden" id="po_id" name="po_id">
            </div>

            <div class="text-right">
                <button class="btn btn-info" type="submit">Submit</button>
            </div>  
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="send_mainto_customer" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <?php
        $attributes = array('id' => 'sub_form_product');
        echo form_open_multipart(admin_url("purchase/send_to_mail"), $attributes);
    ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Send purchase order to client </h4>
      </div>
      <div class="modal-body">
          <input type="hidden" name="po_id" class="po_id" value="">
          <div class="row">
              <?php $staff_data = get_employee_info(get_staff_user_id()); ?>
              <?php echo render_input('from_email', 'From Email', $staff_data->email, 'email', array(), [], 'form-group col-md-6'); ?>
              <?php echo render_input('from_name', 'From Name', $staff_data->firstname . ' ' . $staff_data->lastname, 'text', array(), [], 'form-group col-md-6'); ?>
          </div>
          <div class="row">
              <div class="client_list col-md-6">
                  <label for="module_id" class="control-label">Email To</label>
                  <select class="form-control selectpicker" required="" multiple="1" data-live-search="true" id="send_to" name="send_to">
                      <option value=""></option>
                  </select>
              </div>
              <?php echo render_input('email_to', 'Send To', '', 'text', [], [], 'form-group col-md-6'); ?>
          </div>
          <div class="row">
              <div class="col-md-6">
                  <label for="module_id" class="control-label">Staff CC</label>
                  <?php
                  $staff_list = $this->db->query("SELECT email, firstname FROM tblstaff WHERE active = 1")->result_array();
                  echo render_select('staff_cc[]', $staff_list, array('email', 'email', 'firstname'), '', array(), array('multiple' => true), array(), '', '', false);
                  ?>
              </div>
              <?php echo render_input('cc', 'CC', '', 'text', [], [], 'form-group col-md-6'); ?>

          </div>
        <?php
            $template_list = $this->db->query("SELECT id, template_name FROM tblemailmoduletemplate WHERE module_id = 10 AND status = 1")->result();
        ?>
        <div class="form-group module_template" app-field-wrapper="name">
            <label for="module_id" class="control-label">Select Template</label>
            <select class="form-control selectpicker" required="" data-live-search="true" id="module_template_id" name="module_template_id">
                <option value=""></option>
            </select>
        </div>
        <h5 class="bold"><?php echo _l('proposal_preview_template'); ?></h5>
        <hr />
        <?php
                        
            $editors = array();
            array_push($editors,'message');
        ?>
        <?php echo render_textarea('message','', '',array('rows' => 4, 'class' => 'tinymce tinymce-manual'),array(),'','tinymce tinymce-manual'); ?>
        <?php echo form_hidden('template_name',"purchase_order"); ?>
        <div class="module_attech"></div>
        <div class="form-group">
            <label for="drawing" class="control-label">File</label>
            <input type="file" id="filer_input2" class="form-control"  name="attach_files[]" multiple="">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
        <button type="submit" autocomplete="off" class="btn btn-info">Send</button>
<!--        <button type="submit" autocomplete="off" data-loading-text="Please wait..." class="btn btn-info">Send</button>-->
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>

<?php init_tail(); ?>
<script src="<?php  echo base_url(); ?>assets/plugins/jquery.filer/js/jquery.filer.min.js" type="text/javascript"></script>
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

        

        "iDisplayLength": 25,

        dom: 'Bfrtip',

        lengthMenu: [

            [ 10, 25, 50, -1 ],

            [ '10 rows', '25 rows', '50 rows', 'Show all' ]

        ],

        buttons: [  

            'pageLength',        

            {

                extend: 'excel',

                exportOptions: {

                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7]

                }

            },

            {

                extend: 'pdf',

                exportOptions: {

                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7]

                }

            },

            {

                extend: 'print',

                exportOptions: {

                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7]

                }

            },

            'colvis',

        ]

    } );

} );

</script>



<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>


<script type="text/javascript">
	$(document).on('change', '#branch_id', function(){	
		$("#attendance_form").submit();	
	});
	
	$(document).on('change', '#month', function(){	
		$("#attendance_form").submit();	
	});
</script> 


<script type="text/javascript">
	$(document).on('click', '.pay_all', function(){	
		if (! $("input[name='staffid[]']").is(":checked")){
		   alert('Please Check Any Checkbox First!');
		   return false;
		}else{
			$("#salary_form").submit();	
		}
	
	});	
</script> 


<script type="text/javascript">
	$('.status').click(function(){
	var po_id = $(this).val();
	
		$.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/purchase/get_approval_info'); ?>",
			data    : {'po_id' : po_id},
			success : function(response){
				if(response != ''){
					$("#approval_html").html(response);
				}
			}
		})
	});
</script> 

<script type="text/javascript">
$(document).on('click', '.uplaods', function() {  

    var id = $(this).val();
    $('#po_id').val(id); 

    $.ajax({
        type    : "POST",
        url     : "<?php echo site_url('admin/purchase/get_po_uploads_data'); ?>",
        data    : {'id' : id},
        success : function(response){
            if(response != ''){       

                $('#upload_data').html(response);  
            }
        }
    })

}); 
</script>

<script type="text/javascript">
      $(".myselect").select2();
</script>

<script type="text/javascript">
    $('.percent').click(function(){
    var po_id = $(this).val();
    
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url('admin/purchase/get_payment_percent'); ?>",
            data    : {'po_id' : po_id},
            success : function(response){
                if(response != ''){
                    $("#payment_percent").html(response);
                }
            }
        })
    });
</script>
<script>
   $(function(){
     <?php foreach($editors as $id){ ?>
       init_editor('textarea[name="<?php echo $id; ?>"]',{urlconverter_callback:'merge_field_format_url'});
       <?php } ?>
       var merge_fields_col = $('.merge_fields_col');
         // If not fields available
         $.each(merge_fields_col, function() {
           var total_available_fields = $(this).find('p');
           if (total_available_fields.length == 0) {
             $(this).remove();
           }
         });
       // Add merge field to tinymce
       $('.send-email').on('click', function(e) {
      e.preventDefault();
        var po_id = $(this).data("id");
        var vid = $(this).data("vid");
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url(); ?>admin/purchase/get_vender_list",
            data    : {'vid' : vid},
            success : function(response){
                $(".client_list").html(response);
                $('.selectpicker').selectpicker('refresh');
            }
        });
        $(".po_id").val(po_id);
        $("#cc").val("");
        $(".module_template").html('<label for="module_id" class="control-label">Select Template</label><select class="form-control selectpicker" required="" data-live-search="true" id="module_template_id" name="module_template_id"><option value=""></option><?php if (isset($template_list) && count($template_list) > 0) {foreach ($template_list as $template) {?><option value="<?php echo $template->id; ?>"><?php echo cc($template->template_name); ?></option><?php } }?></select>');
        $('.selectpicker').selectpicker('refresh');
        tinymce.activeEditor.execCommand('mceSetContent', false, "");
//        $('.selectpicker option:selected').remove();
    });
   });
</script>
<script type="text/javascript">
$(document).on('change', '#module_template_id', function() { 
    tinymce.activeEditor.execCommand('mceSetContent', false, "");
    $(".module_attech").html();
    var tid = $(this).val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/leads/get_email_template",
        data    : {'t_id' : tid},
        success : function(response){
            tinymce.activeEditor.execCommand('mceSetContent', false, response);
//                $('.selectpicker').selectpicker('refresh');
        }
    })
    
    $.get("<?php echo base_url(); ?>admin/leads/get_templete_attechment/"+tid, function(res){
        if (res != ""){
            $(".module_attech").html(res);
        }
    })
}); 
</script>
<script type="text/javascript">
  $(document).ready(function(){
'use-strict';

    //Example 2
    $('#filer_input2').filer({
//        limit: 5,
        maxSize: 20,
//        extensions: ['jpg', 'jpeg', 'png' ],
        changeInput: true,
        showThumbs: true,
        addMore: true
    });
  });
  
    function removeattch(index){
      if (confirm("Are you sure you want to remove this file?")){
          $(".box"+index).remove();
      }
    }
  
  $(document).on("click", ".close-model", function(){
      location.reload(); 
  });
</script>
</body>
</html>
