
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
	.mt-5{
		margin-top:15px;
	}

</style>

<div id="wrapper">
    <div class="content accounting-template">
      <form action="<?php echo admin_url('requirement/purchase_process_approval_action');?>" id="product-form" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <input type="hidden" value="<?php echo $id?>" name="req_id">
	      <div class="panel_s">
		      <div class="panel-body">
    		    <div class="row">
                <h3 class="text-center"><?php echo $title; ?></h3>
                <hr>
                <div class="col-md-3">
                    <h5 style="font-size:15px;color:red;"><u>Department :</u></h5>
                    <span><?php echo (isset($requirement_info) && $requirement_info->department_id > 0) ? value_by_id('tbldepartmentsmaster', $requirement_info->department_id, "name") : "--"; ?></span>
                </div>
                <div class="col-md-3">
                    <h5 style="font-size:15px;color:red;"><u>Request ID :</u></h5>
                    <span><?php echo 'P-REQ-'.str_pad($requirement_info->id, 4, '0', STR_PAD_LEFT);?></span>
                </div>
                <div class="col-md-3">
                    <h5 style="font-size:15px;color:red;"><u>Expected Date :</u></h5>
                    <span><?php echo (!empty($row->expected_date)) ? _d($row->expected_date) :'N/A'; ?></span>
                </div>
                <div class="col-md-3">
                    <h5 style="font-size:15px;color:red;"><u>Created At :</u></h5>
                    <span><?php echo _d($requirement_info->created_at); ?></span>
                </div>
    		    </div>
	        </div>
	      </div>
	    </form>
        
    <?php
        if (isset($requirement_vendors)){
            foreach ($requirement_vendors as $key => $value) {

                $product_list = $this->db->query("SELECT * FROM tblrequirement_products WHERE `id` IN (".$value->reqpro_ids.") and `req_id`= '".$value->req_id."'")->result();
                
                $sysproductcount = $this->db->query("SELECT COUNT(*) as ttlcount FROM tblrequirement_products WHERE `id` IN (".$value->reqpro_ids.") and `req_id`= '".$value->req_id."' and `product_id` != 0")->row()->ttlcount; 
                $ttlproductcount = (!empty($product_list)) ? count($product_list) : 0;
    ?>
        <div class="panel_s">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">

                        <h4 align="center"><u><?php echo cc($value->vendor_name); ?></u><?php echo ($value->converted_po_id > 0) ? "&nbsp;<span class='label label-success'><i class='fa fa fa-check-circle' style='color:#84c529;'></i> Converted</span>" : ""; ?></h4>
                        <?php
                            
                            if ($value->converted_po_id == 0 && ($ttlproductcount == $sysproductcount)){
                                if ($value->vendor_id > 0){
                        ?>            
                                    <a href="<?php echo admin_url('purchase/purchase_order?req_vendor_id='.$value->id.'&req_id='.$value->req_id); ?>" class="btn-sm btn-success">Convert To PO</a>
                        <?php            
                                }else{
                        ?>
                                    <a href="<?php echo admin_url('vendor/vendor?req_vendor_id='.$value->id.'&req_id='.$value->req_id); ?>" class="btn-sm btn-info">Make Our Vendor</a>
                        <?php            
                                }
                            }
                            if ($value->converted_po_id > 0){
                                $po_number = value_by_id_empty('tblpurchaseorder', $value->converted_po_id, 'number');
                        ?>        
                                <a  title="View" class="label label-info" target="_blank" href="<?php echo admin_url('purchase/download_pdf/' . $value->converted_po_id); ?>"><?php echo $po_number; ?></a>
                        <?php        
                            }
                        ?>
                        
                        <hr>
                        <table class="table ui-table" >
                            <thead>
                                <tr>
                                    <th style="width:1%">S.no</th>
                                    <th>Product Name</th>
                                    <th style="width:5%">Quantity</th>
                                    <th style="width:5%">Unit</th>
                                    <th style="width:45%">Remark</th>
                                    <th style="width:10%">Assign Product</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                if (!empty($product_list)){
                                    foreach ($product_list as $pkey => $pro) {
                            ?>
                                        <tr>
                                            <td><?php echo ++$pkey; ?></td>
                                            <td><?php echo ($pro->product_id > 0) ? value_by_id('tblproducts', $pro->product_id, "sub_name") : $pro->product_name; ?></td>
                                            <td><?php echo $pro->quantity; ?></td>
                                            <td><?php echo value_by_id('tblunitmaster', $pro->unit, "name"); ?></td>
                                            <td><?php echo !empty($pro->remark) ? $pro->remark : '--'; ?></td>
                                            <td align="center">
                                                <?php 
                                                    if ($pro->product_id == 0){
                                                        echo '<a href="javascript:void(0);" data-toggle="modal" data-target="#assignproductModal" data-pro-id="'.$pro->id.'" class="btn-sm btn-info assignproduct">Assign</a>';
                                                    }else{
                                                        echo '<i class="fa fa-2x fa-check-circle" style="color:#84c529;"></i>';
                                                    }
                                                ?>
                                            </td>
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
    <?php            
            }
        }
    ?>
<div id="assignproductModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <form action="<?php echo admin_url('requirement/assign_product');?>" id="product-form" class="product-form" method="post" accept-charset="utf-8">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Assign Product</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" id="productid">
                                <label for="product" class="control-label">Product</label>
                                <select class="form-control selectpicker" data-live-search="true" id="product_id" name="product_id">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                        if (isset($productlist)){
                                            foreach ($productlist as $value) {
                                                echo '<option value="'.$value->id.'">'.cc($value->sub_name).'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>    
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="reqproductid" name="reqproductid" value="0">
                    <button type="submit" class="btn btn-primary" name="submit">Assign</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>              
<?php init_tail(); ?>
<script>
    $('.assignproduct').click(function () {
        var pro_id = $(this).data("pro-id");
        $('#reqproductid').val(pro_id);
    });
</script>
</body>
</html>
