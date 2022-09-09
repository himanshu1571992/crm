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
                                        <label class="text-danger"> Challan # : </label>
                                        <div class="form-group">
                                            <span>
                                                <?php
                                                if (!empty($priority_order_info)){
                                                    $challan_info = $this->db->query("SELECT id,production_plan_id,chalanno FROM `tblchalanmst` WHERE `rel_id`='".$priority_order_info->id."' AND `rel_type`='estimate'")->row();
                                                    if (!empty($challan_info)){
                                                        echo '<a target="_blank" href="' . admin_url('chalan/pdf/' . $challan_info->id). '" >' .$challan_info->chalanno. '</a>';
                                                    }else{
                                                        echo '--';
                                                    }
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-danger"> Proforma Invoice # : </label>
                                        <div class="form-group">
                                            <span>
                                                <?php echo '<a target="_blank" href="' . admin_url('estimates/download_pdf/' . $priority_order_info->id) . '" >' . format_estimate_number($priority_order_info->id) . '</a>'; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-danger"> Invoice # : </label>
                                        <div class="form-group">
                                            <span>
                                            <?php
                                                if (!empty($priority_order_info)){
                                                    $invoice_info = $this->db->query("SELECT `id`,`number` from `tblinvoices` where estimate_id = '".$priority_order_info->id."'")->row();
                                                    echo (!empty($invoice_info)) ? '<a target="_blank" href="' . admin_url('invoices/download_pdf/' . $invoice_info->id). '" >' .$invoice_info->number. '</a>':'--';
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
                                                if (!empty($priority_order_info)){
                                                    $sales_person_id = value_by_id_empty("tblleadstaffgroup", $priority_order_info->group_id,"sales_person_id");
                                                    echo (!empty($sales_person_id)) ? get_employee_fullname($sales_person_id) : '--';
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="text-danger"> Customer Name : </label>
                                        <div class="form-group">
                                            <span>
                                                <?php
                                                if (!empty($priority_order_info)){
                                                    $client_info = $this->db->query("SELECT * FROM `tblclientbranch` where userid = '".$priority_order_info->clientid."' ")->row();
                                                    echo (!empty($client_info)) ? cc($client_info->client_branch_name) : '--';
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-danger"> Delivery Date : </label>
                                        <div class="form-group">
                                            <span>
                                                <?php echo _d($priority_order_info->delivery_date); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-danger"> Expected Complete Date : </label>
                                        <div class="form-group">
                                            <span>
                                                <?php echo (!empty($priority_order_info->expected_completed_date)) ? _d($priority_order_info->expected_completed_date) : '--'; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-danger"> Order Status : </label>
                                        <div class="form-group">
                                            <span>
                                                <?php 
                                                    if ($priority_order_info->order_status_id > 0){
                                                        echo value_by_id("tblconfirmorderstatus", $priority_order_info->order_status_id, "title");
                                                    }else{
                                                        echo "--";
                                                    }
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="text-danger"> Current Priority : </label>
                                        <div class="form-group">
                                            <span class="btn-sm btn-info"><?php echo (!empty($priority_order_info)) ? $priority_order_info->priority : 0; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-danger"> Requested Priority : </label>
                                        <div class="form-group">
                                            <span class="btn-sm btn-info"><?php echo (!empty($priority_order_info)) ? $priority_order_info->requested_priority : 0; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="text-danger"> Requested Person Remark : </label>
                                        <div class="form-group">
                                            <span><?php echo (!empty($priority_order_info->priority_request_remark)) ? $priority_order_info->priority_request_remark : 'N/a'; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
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
                        ?>
                    </div>
                </div>
            </div>
            
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

            <?php echo form_close(); ?>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>

</body>
</html>
