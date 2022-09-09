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
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="text-danger"> Customer Name : </label>
                                        <div class="form-group">
                                            <span>
                                                <?php
                                                if (!empty($proformachallan_info)){
                                                    $client_info = $this->db->query("SELECT * FROM `tblclientbranch` where userid = '".$proformachallan_info->clientid."' ")->row();
                                                    echo (!empty($client_info)) ? cc($client_info->client_branch_name) : '--';
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-danger"> Proforma Challan # : </label>
                                        <div class="form-group">
                                            <span>
                                                <?php echo '<a target="_blank" href="' . admin_url('estimates/proformachallan_download_pdf/' . $proformachallan_info->id) . '" >' . 'PC-'.sprintf("%'.05d\n", $proformachallan_info->id) . '</a>'; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-danger"> Proforma Invoice # : </label>
                                        <div class="form-group">
                                            <span>
                                            <?php
                                                if (!empty($proformachallan_info)){
                                                    $invoice_info = $this->db->query("SELECT `id`,`number` from `tblestimates` where id = '".$proformachallan_info->rel_id."'")->row();
                                                    echo (!empty($invoice_info)) ? '<a target="_blank" href="' . admin_url('estimates/download_pdf/' . $invoice_info->id). '" >' .$invoice_info->number. '</a>':'--';
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-danger"> Sales Person Name : </label>
                                        <div class="form-group">
                                            <span>
                                            <?php
                                                if (!empty($proformachallan_info)){
                                                    $sales_person_id = value_by_id_empty("tblleadstaffgroup", $proformachallan_info->group_id,"sales_person_id");
                                                    echo (!empty($sales_person_id)) ? get_employee_fullname($sales_person_id) : '--';
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="text-danger"> Warehouse : </label>
                                        <div class="form-group">
                                            <span>
                                                <?php 
                                                    if ($proformachallan_info->warehouse_id > 0){
                                                        echo value_by_id("tblwarehouse", $proformachallan_info->warehouse_id, "name");
                                                    }else{
                                                        echo "--";
                                                    }
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-danger"> Service Type : </label>
                                        <div class="form-group">
                                            <span>
                                                <?php 
                                                    if ($proformachallan_info->service_type > 0){
                                                        echo ($proformachallan_info->service_type == '1') ? "Rent": "Sales";
                                                    }else{
                                                        echo "--";
                                                    }
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-danger"> Proforma Challan Date : </label>
                                        <div class="form-group">
                                            <span>
                                                <?php echo _d($proformachallan_info->date); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-danger"> Remark : </label>
                                        <div class="form-group">
                                            <span>
                                                <?php echo (!empty($proformachallan_info->adminnote)) ? $proformachallan_info->adminnote : '--'; ?>
                                            </span>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="text-danger"> Office Person : </label>
                                        <div class="form-group">
                                            <span>
                                                <?php 
                                                    echo (!empty($proformachallan_info->office_person)) ? cc($proformachallan_info->office_person) : '--';
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-danger"> Office Person Number : </label>
                                        <div class="form-group">
                                            <span>
                                                <?php 
                                                    echo (!empty($proformachallan_info->office_person_number)) ? cc($proformachallan_info->office_person_number) : '--';
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-danger"> Site Person : </label>
                                        <div class="form-group">
                                            <span>
                                                <?php echo (!empty($proformachallan_info->site_person)) ? cc($proformachallan_info->site_person) : '--'; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-danger"> Site Person Number : </label>
                                        <div class="form-group">
                                            <span>
                                                <?php echo (!empty($proformachallan_info->site_person_number)) ? $proformachallan_info->site_person_number : '--'; ?>
                                            </span>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="text-danger"> Work No : </label>
                                        <div class="form-group">
                                            <span>
                                                <?php 
                                                    echo (!empty($proformachallan_info->work_no)) ? cc($proformachallan_info->work_no) : '--';
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-danger"> Work Date : </label>
                                        <div class="form-group">
                                            <span>
                                                <?php 
                                                    echo (!empty($proformachallan_info->workdate)) ? _d($proformachallan_info->workdate) : '--';
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            if(empty($appvoal_info)){
                        ?>
                                <div class="btn-bottom-toolbar bottom-transaction text-right">
                                    <!-- <input type="hidden" name="submit" value="0" class="submit_button"> -->
                                    <button type="submit" name="submit" value="2" class="btn btn-danger mleft10 proposal-form-submit save-and-send challan-submit">
                                        Reject
                                    </button>
                                    <button type="submit" name="submit" value="1" class="btn btn-info mleft10 proposal-form-submit save-and-send challan-submit">
                                        Approve
                                    </button>
                                </div>
                        <?php
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
                                    <h4 class="no-mtop mrg3">Product List</h4>
                                    <hr>
                                </div>
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table" id="newtable">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Product Name</th>
                                                    <th>Qty</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $i = 0;
                                                    if (!empty($proformachallan_details)){
                                                        foreach ($proformachallan_details as $key => $value) {
                                                            if ($value->type == '1'){
                                                ?>
                                                                <tr>
                                                                    <td><?php echo ++$i; ?></td>
                                                                    <td><?php echo value_by_id("tblproducts", $value->product_id, "sub_name"); ?></td>
                                                                    <td><?php echo $value->qty; ?></td>
                                                                </tr>
                                                <?php                
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </tbody>    
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="no-mtop mrg3">Component List</h4>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table" id="newtable">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Component Name</th>
                                                    <th>Qty</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $i = 0;
                                                    if (!empty($proformachallan_details)){
                                                        foreach ($proformachallan_details as $key => $value) {
                                                            if ($value->type == '2'){
                                                ?>
                                                                <tr>
                                                                    <td><?php echo ++$i; ?></td>
                                                                    <td><?php echo value_by_id("tblproducts", $value->product_id, "sub_name"); ?></td>
                                                                    <td><?php echo $value->qty; ?></td>
                                                                </tr>
                                                <?php                
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </tbody>    
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="no-mtop mrg3">Approve/Reject Remark</h4>
                                    <hr/>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12 pull-right">
                                           <div class="form-group" app-field-wrapper="remark">
                                            <textarea id="remark" required="" name="remark" class="form-control" rows="4"></textarea>
                                        </div>
                                        </div>
                                    </div>
                                </div>
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
   /* $(".challan-submit").on("click", function(){
        var val = $(this).attr("value");
        $(".submit_button").val(val);
        $('button[type="submit"]').attr('disabled','disabled');
    });*/
</script>    
</body>
</html>
