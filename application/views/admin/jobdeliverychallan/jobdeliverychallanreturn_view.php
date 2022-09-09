<?php init_head(); ?>
<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width: 499px;height: 125px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<input id="check_gst" type='hidden' value="0">
<!-- Modal Contact -->

<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">
            
            <?php echo form_open($this->uri->uri_string(), array('id' => 'proposal-form', 'class' => '_propsal_form proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4><?php echo $title; ?></h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">

                            <?php
                            $vendor_name = value_by_id('tblvendor',$info->vendor_id,'name');
                            $site_name = value_by_id('tblsitemanager',$info->site_id,'name');

                            ?>
                                <input type="hidden" name="vendor_id" id="vendor_id" value="<?php echo $info->vendor_id; ?>">
                                <input type="hidden" name="site_id" id="site_id" value="<?php echo $info->site_id; ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="text-info">Vendor Name : </label>
                                        <div class="form-group">
                                            <span><?php echo  $vendor_name; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="text-info">Site Name : </label>
                                        <div class="form-group">
                                            <span><?php echo  $site_name; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="bold text-info"><?php echo _l('invoice_bill_to'); ?> : </p>
                                        <address>
                                            <span class="billing_name"><?php echo  cc($vendor_name); ?></span><br>
                                            <span class="billing_street">--</span><br>
                                            <span class="billing_city">--</span>,
                                            <span class="billing_state">--</span>
                                            <br/>
                                            <span class="billing_country">--</span>,
                                            <span class="billing_zip">--</span>
                                        </address>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="bold text-info"><?php echo _l('ship_to'); ?> : </p>
                                        <address>
                                            <span class="shipping_name"><?php echo  $site_name; ?></span><br>
                                            <span class="shipping_street">--</span><br>
                                            <span class="shipping_city">--</span>,
                                            <span class="shipping_state">--</span>
                                            <br/>
                                            <span class="shipping_country">--</span>,
                                            <span class="shipping_zip">--</span>
                                        </address>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel_s no-shadow">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" app-field-wrapper="">
                                                <label class="text-info">Challan No. :</label>
                                                <div class="form-group">
                                                    <span><?php echo 'JDC-' . str_pad($info->id, 4, '0', STR_PAD_LEFT); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <?php $value = (isset($info) ? _d($info->date) : _d(date('Y-m-d'))); ?>
                                            <div class="form-group" app-field-wrapper="date"><label for="date" class="text-info"> Date : </label>
                                                <div class="form-group">
                                                    <span><?php echo $value; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" app-field-wrapper="">
                                                <label class="text-info">Service Type : </label>
                                                <?php $service_type = (!empty($info)) ? ($info->service_type == 1) ? 'Rent' : 'Sale' : ""; ?>
                                                <div class="form-group">
                                                    <span><?php echo $service_type; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" app-field-wrapper="">
                                                <label class="text-info"> Note : </label>
                                                <?php $value = (isset($info) ? cc($info->adminnote) : ''); ?>
                                                <div class="form-group">
                                                    <span><?php echo $value; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <?php if ($section != "approval") { ?>
                                        <div class="col-md-6">
                                            <div class="form-group" app-field-wrapper="">
                                                <label class="text-info"> Status : </label>
                                                <?php 
                                                    $status = "--";
                                                    if($info->status == 0){
                                                        $status = '<span class="btn-sm btn-warning status">Pending</span>';
                                                    }elseif ($info->status == 1){
                                                        $status = '<span class="btn-sm btn-success status">Approved</span>';    
                                                    }elseif ($info->status == 2){
                                                        $status = '<span class="btn-sm btn-danger status">Rejected</span>';    
                                                    }
                                                ?>
                                                <div class="form-group">
                                                    <span><?php echo $status; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                            if ($section == "approval"){
                                if(empty($appvoal_info)){
                        ?>
                                <div class="btn-bottom-toolbar bottom-transaction text-right">
                                    <button type="submit" name="submit" value="2" class="btn btn-danger mleft10 proposal-form-submit save-and-send transaction-submit">
                                        Reject
                                    </button>
                                    <button type="submit" name="submit" value="1" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                        Approve
                                    </button>
                                </div> 
                        <?php 
                                }
                            }
                        ?>
                          
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Delivery Products</h4>
                            </div>

                            <hr/>
                            <div class="col-md-12">
                                <div style="overflow-x:auto !important;">
                                    <div class="form-group" id="docAttachDivVideo" >
                                        <div class="col-md-12">
                                            <div >
                                                <div class="form-group" id="docAttachDivVideo" >
                                                    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                                        <thead>
                                                            <tr>
                                                                <td style="width: 80px !important;"><?php echo _l('prop_pro_name'); ?></td>
                                                                <td style="width: 20px !important;"><?php echo _l('prop_pro_id'); ?></td>
                                                                <td style="width: 20px !important;">Unit</td>
                                                                <td style="width: 70px !important;">Remark</td>
                                                                <td style="width: 16px  !important;">Available Qty</td>
                                                                <td style="width: 16px  !important;"><?php echo _l('prop_pro_qty'); ?></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            $i = 1;
                                                            $totsaleprod = 0;

                                                            if (isset($product_info)) {

                                                                $totsaleprod = count($product_info);
                                                                ?>

                                                            <input type="hidden" id="totalsalepro" value="<?php echo count($product_info); ?>">

                                                                <?php
                                                                foreach ($product_info as $single_prod_sale_det) {
                                                                    ?>
                                                                <tr class="trsalepro<?php echo $i; ?>">
                                                                    <td>
                                                                        <?php
                                                                        if ($single_prod_sale_det["is_temp"] == 0) {
                                                                            $url = admin_url("product_new/view/");
                                                                            $unit_id = ($single_prod_sale_det['unit_id'] > 0) ? $single_prod_sale_det['unit_id'] : value_by_id_empty('tblproducts', $single_prod_sale_det['product_id'], 'unit_2');
                                                                        } else {
                                                                            $url = admin_url("product_new/temperory_product/");
                                                                            $unit_id = ($single_prod_sale_det['unit_id'] > 0) ? $single_prod_sale_det['unit_id'] : value_by_id_empty('tbltemperoryproduct', $single_prod_sale_det['product_id'], 'unit');
                                                                        }
                                                                        ?>
                                                                        <a target="_blank" href="<?php echo $url . $single_prod_sale_det['product_id']; ?>">
                                                                            <input class="form-control" type="text" readonly="" name="saleproposal[<?php echo $i; ?>][product_name]" style="cursor: pointer !important;" value="<?php echo $single_prod_sale_det['product_name']; ?>">
                                                                        </a>
                                                                        <input value="<?php echo $single_prod_sale_det['product_id']; ?>" name="saleproposal[<?php echo $i; ?>][product_id]" type="hidden">
                                                                        <input value="<?php echo $single_prod_sale_det["is_temp"]; ?>" name="saleproposal[<?php echo $i; ?>][is_temp]" type="hidden">
                                                                        <input value="<?php echo $single_prod_sale_det['id']; ?>" name="saleproposal[<?php echo $i; ?>][itemid]" type="hidden">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][pro_id]" readonly="" value="<?php echo $single_prod_sale_det['pro_id']; ?>">
                                                                    </td>
                                                                    <td>
                                                                        <select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="salepro_unit1_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][unit_id]">
                                                                            <option value=""></option>
                                                                            <?php
                                                                            if (isset($unit_list) && count($unit_list) > 0) {
                                                                                foreach ($unit_list as $uvalue) {
                                                                                    $selected = ($unit_id == $uvalue->id) ? "selected" : "";
                                                                                    echo '<option value="' . $uvalue->id . '" ' . $selected . '>' . $uvalue->name . '</option>';
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][remark]" value="<?php echo $single_prod_sale_det['remark']; ?>">
                                                                    </td>
                                                                    <td>
                                                                        <?php
                                                                            $where = "pro_id = '" . $single_prod_sale_det['product_id'] . "' and service_type = '" . $info->service_type . "' and stock_type = 1 and status = 1 and staff_id = 0";
                                                                            $getprostock = $this->db->query("SELECT `id`,`qty` FROM tblprostock WHERE " . $where . " ORDER BY id DESC")->row();
                                                                        ?>
                                                                        <input type="number" class="form-control availableqty" data-rid="<?php echo $i; ?>" id="saleavailableqty_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][availableqty]" min="1" value="<?php echo (!empty($getprostock)) ? $getprostock->qty : 0; ?>" readonly="">
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" class="form-control qty" id="saleqty_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][qty]" min="1" value="<?php echo $single_prod_sale_det['qty']; ?>">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                 if ($section == "approval"){
            ?>
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="no-mtop mrg3">Approve/Reject Remark</h4>
                                </div>
                                <hr/>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 pull-right">
                                           <div class="form-group" app-field-wrapper="remark">
                                            <textarea id="remark" required="" name="remark" class="form-control" rows="4"><?php if(!empty($appvoal_info)){ echo $appvoal_info->remark; } ?></textarea>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php
                $assign_info = $this->db->query("SELECT * from tblmasterapproval  where module_id = '33' and table_id = '".$info->id."'  ")->result();
            ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Assign Detail List</h4>
                                <h5 style="color: red;">Minimum <?php echo (count($assign_info) > 1 ) ? 2 : 1; ?> Approval is Required</h5>
                            </div>
                            <hr/>
                            <div class="col-md-12">
                            <div style="overflow-x:auto !important;">
                                <div class="form-group" >
                                    <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                                        <thead>
                                            <tr>
                                                <td>S.No</td>
                                                <td>Name</td>
                                                <td>Status</td>
                                                <td>Read At</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if(!empty($assign_info)){
                                                $i = 1;
                                                foreach ($assign_info as $key => $value) {

                                                        if($value->approve_status == 0){
                                                            $status = 'Pending';
                                                            $color = 'Darkorange';
                                                        }elseif($value->approve_status == 1){
                                                            $status = 'Approved';
                                                            $color = 'green';
                                                        }elseif($value->approve_status == 2){
                                                            $status = 'Reject';
                                                            $color = 'red';
                                                        }
                                                    ?>
                                                    <tr>                                                      
                                                        <td><?php echo $i++;?></td>
                                                        <td><?php echo get_employee_name($value->staff_id); ?></td>
                                                        <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>   
                                                        <td><?php if(!empty($value->readdate)){ echo _d($value->readdate); }else{ echo 'Not Yet'; }   ?></td>                                                       
                                                    </tr>
                                                    <?php
                                                }
                                            }else{
                                                echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found!</h5></td></tr>';
                                            }
                                        ?>  
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>  
           

            

            <?php echo form_close(); ?>
            <?php $this->load->view('admin/invoice_items/item'); ?>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>


<script type="text/javascript">	
    $( document ).ready(function() { 
        
            var vendor_id = $('#vendor_id').val();
            var site_id = $('#site_id').val();

            if(vendor_id > 0){
                var url = '<?php echo base_url(); ?>admin/Purchase/getvendordtails';
                $.post(url,
                        {
                            vendor_id: vendor_id,
                        },
                        function (data, status) {
                            var res = JSON.parse(data);
                            if(res != ''){
                                $('.billing_street').html(res.address);
                                $('#billing_street').val(res.address);
                                $('.billing_state').html(res.state_name);
                                $('#billing_state').val(res.state_name);
                                $('.billing_city').html(res.city_name);
                                $('#billing_city').val(res.city_name);
                                $('.billing_zip').html(res.pincode);
                                $('#billing_zip').val(res.pincode);
                                $('.billing_country').html('India');
                                $('#billing_country').val('India');
                            }                        

                        });
            }
        
            if(site_id > 0){
                var url = '<?php echo base_url(); ?>admin/Site_manager/getsitedetails';
                $.post(url,
                        {
                            site_id: site_id,
                        },
                        function (data, status) {
                            var res=JSON.parse(data);


                            $('.shipping_street').html(res.address);
                            $('#shipping_street').val(res.address);
                            $('.shipping_state').html(res.state_name);
                            $('#shipping_state').val(res.state_name);
                            $('.shipping_city').html(res.city_name);
                            $('#shipping_city').val(res.city_name);
                            $('.shipping_zip').html(res.pincode);
                            $('#shipping_zip').val(res.pincode);
                        });
            }

	});

</script>
</body>
</html>
