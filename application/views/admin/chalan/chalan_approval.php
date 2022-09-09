<?php
$session_id = $this->session->userdata();
init_head();
?>
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  padding: 25px;
  /*width: 20%;*/
  /*border-radius: 50%;*/
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}
</style>
<style>#address{margin: 0px 1.5px 0px 0px;height: 112px;width: 508px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open($this->uri->uri_string(), array('id' => 'payment-form', 'class' => '_propsal_form proposal-form', 'enctype' => 'multipart/form-data')); ?>

            <?php
            $sessiondata = $this->session->userdata();
            $warehouse_id = $estimate->warehouse_id;
            $get_warehouse_details = $this->db->query("SELECT * FROM `tblwarehouse` WHERE `id`='" . $warehouse_id . "'")->row_array();
            $warehouse = $get_warehouse_details['name'];
            $service_type = $estimate->service_type;
            $rel_type = $estimate->rel_type;
            if ($estimate->service_type == 1) {
                $is_sale = 0;
                $servicetype = 'Challan For Rent';
            } else {
                $is_sale = 1;
                $servicetype = 'Challan For Sale';
            }
            $rel_id = $estimate->rel_id;
            //$to_info = get_estimate_to_array($rel_id);
            $shipto_info = get_ship_to_array($estimate->site_id);

            $to_info = array();
              if ($estimate->rel_type == 'proforma_challan'){
                $estimate_info = $this->db->query("SELECT * FROM `tblproformachalan` where  `id` = '".$estimate->rel_id."' ")->row();
                if ($estimate_info->clientid > 0){
                  $client_info = $this->db->query("SELECT * FROM `tblclientbranch` where userid = '".$estimate_info->clientid."' ")->row();
                  $to_info = array("name" => $client_info->client_branch_name, "address"=> $client_info->address, "city" => value_by_id('tblcities',$client_info->city,'name'), "state"=> value_by_id('tblstates',$client_info->state,'name'), "zip"=> $client_info->zip, "gst" => $client_info->vat, "phone" => $client_info->phone_no_1);
                }
              }else{
                $estimate_info = $this->db->query("SELECT * FROM `tblestimates` where  `id` = '".$estimate->rel_id."' ")->row();
                $to_info = get_estimate_to_array($estimate->rel_id);
              }
            ?>
            <input type="hidden" name="warehouse_id" value="<?php echo $warehouse_id; ?>">
            <input type="hidden" name="service_type" value="<?php echo $service_type; ?>">
            <div class="col-md-12">
                
                <div class="panel_s">
                    <div class="panel-body">
                        <!--<h3><?php echo $title; ?></h3>-->
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                        <hr/>
                        <div class="modal-body" id="stockavdv">
                            <input type="hidden" name="rel_type" value="<?php echo $rel_type; ?>">
                            <input type="hidden" name="rel_id" value="<?php echo $rel_id; ?>">
                            <input type="hidden" name="is_sale" value="<?php echo $is_sale; ?>">
                            <div class="row">
                                <h3 align="center" style="color:red;"><u><?php echo (!empty($chalan["clientid"])) ? client_info($chalan["clientid"])->client_branch_name : "";?></u></h3>
                            </div>
                            <br>
                            <br>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="challan_no" class="control-label" style="font-size:18px"> Challan No :</label>
                                        <div class="form-group">
                                            <?php echo $chalan['chalanno']; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="challan_no" class="control-label" style="font-size:18px"> Warehouse Selected :</label>
                                        <div class="form-group">
                                            <?php echo $warehouse_name; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="challan_no" class="control-label" style="font-size:18px"> Work Order No :</label>
                                        <div class="form-group">
                                            <?php echo ($chalan['work_no']) ? $chalan['work_no'] : "--"; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="challan_no" class="control-label" style="font-size:18px"> Work Order Date :</label>
                                        <div class="form-group">
                                            <?php echo date('d/m/Y', strtotime($chalan['workdate'])); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="challan_no" class="control-label" style="font-size:18px"> Challan Date :</label>
                                        <div class="form-group">
                                            <?php echo date('d/m/Y',strtotime($estimate->challandate)); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="challan_no" class="control-label" style="font-size:18px"> Service Type :</label>
                                        <div class="form-group">
                                            <?php echo $servicetype; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card label-info">
                                            <div class="card-body ">
                                                <h4 class="card-title"><?php echo _l('invoice_bill_to'); ?></h4>
                                                <p class="card-text">
                                                    <div class="form-group">
                                                        <address>
                                                            <h4 style="color:red;"><?php echo $to_info['name']; ?></h4>
                                                            <span class="billing_street" style="font-size: 15px;">
                                                                <?php $billing_street = (isset($estimate) ? $estimate->billing_street : '--'); ?>
                                                                <?php $billing_street = ($billing_street == '' ? '--' : $billing_street); ?>
                                                                <?php echo $billing_street; ?></span><br>
                                                            <span class="billing_city" style="font-size: 15px;">
                                                                <?php $billing_city = (isset($estimate) ? $estimate->billing_city : '--'); ?>
                                                                <?php $billing_city = ($billing_city == '' ? '--' : $billing_city); ?>
                                                                <?php echo $billing_city; ?></span>,
                                                            <span class="billing_state" style="font-size: 15px;">
                                                                <?php $billing_state = (isset($estimate) ? $estimate->billing_state : '--'); ?>
                                                                <?php $billing_state = ($billing_state == '' ? '--' : $billing_state); ?>
                                                                <?php echo $billing_state; ?></span>
                                                            <br/>
                                                           <!--  <span class="billing_country">
                                                            <?php
                                                            $billing_country = (isset($estimate) ? get_country_short_name($estimate->billing_country) : '--');
                                                            $billing_country = ($billing_country == '' ? '--' : $billing_country);
                                                            echo $billing_country;
                                                            ?>
                                                            </span>, -->
                                                            <span class="billing_zip" style="font-size: 15px;">
                                                                <?php $billing_zip = (isset($estimate) ? $estimate->billing_zip : '--'); ?>
                                                                <?php $billing_zip = ($billing_zip == '' ? '--' : $billing_zip); ?>
                                                                <?php echo $billing_zip; ?>
                                                            </span><br>
                                                            <?php
                                                                if(!empty($to_info['gst'])){
                                                            ?>
                                                                <span>
                                                                    <label for="challan_no" class="control-label" style="font-size:15px"> GST NO :</label>
                                                                    <div class="form-group">
                                                                        <?php echo $to_info['gst']; ?>
                                                                    </div>
                                                                </span>
                                                            <?php }elseif(!empty($estimate->office_person)){ ?>
                                                                <span>
                                                                    <label for="challan_no" class="control-label" style="font-size:15px"> Contact Person :</label>
                                                                    <div class="form-group">
                                                                        <?php echo $estimate->office_person.', '.$estimate->office_person_number; ?>
                                                                    </div>
                                                                </span>
                                                            <?php } ?>
                                                        </address>
                                                    </div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card label-info">
                                            <div class="card-body ">
                                                <h4 class="card-title"><?php echo "Ship To"; ?></h4>
                                                <p class="card-text">
                                                <div class="form-group">
                                                    <address>
                                                        <h4 style="color:red;"><?php echo $shipto_info['name']; ?></h4>
                                                        <span class="shipping_street" style="font-size: 15px;">
                                                            <?php $shipping_street = (isset($estimate) ? $estimate->shipping_street : '--'); ?>
                                                            <?php $shipping_street = ($shipping_street == '' ? '--' : $shipping_street); ?>
                                                            <?php echo $shipping_street; ?>
                                                        </span><br>
                                                        <span class="shipping_city" style="font-size: 15px;">
                                                            <?php $shipping_city = (isset($estimate) ? $estimate->shipping_city : '--'); ?>
                                                            <?php $shipping_city = ($shipping_city == '' ? '--' : $shipping_city); ?>
                                                            <?php echo $shipping_city; ?>
                                                        </span>,
                                                        <span class="shipping_state" style="font-size: 15px;">
                                                            <?php $shipping_state = (isset($estimate) ? $estimate->shipping_state : '--'); ?>
                                                            <?php $shipping_state = ($shipping_state == '' ? '--' : $shipping_state); ?>
                                                            <?php echo $shipping_state; ?>
                                                        </span><br/>
                                                        <span class="shipping_zip" style="font-size: 15px;">
                                                            <?php $shipping_zip = (isset($estimate) ? $estimate->shipping_zip : '--'); ?>
                                                            <?php $shipping_zip = ($shipping_zip == '' ? '--' : $shipping_zip); ?>
                                                            <?php echo $shipping_zip; ?>
                                                        </span><br>
                                                        <?php if(!empty($estimate->site_person)){ ?>
                                                            <span>
                                                                <label for="challan_no" class="control-label" style="font-size:15px"> Contact Person :</label>
                                                                <div class="form-group">
                                                                    <?php echo $estimate->site_person.', '.$estimate->site_person_number; ?>
                                                                </div>
                                                            </span>
                                                        <?php } ?>
                                                    </address>
                                                </div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
<!--                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop table-responsive">
                                    <tbody class="ui-sortable" style="font-size:15px;">
                                        <tr>
                                            <td><b>Chalan No :</b></td>
                                            <td><?php echo $chalan['chalanno']; ?></td>
                                            <td><b>Warehouse Selected :</b></td>
                                            <td><?php echo $warehouse_name; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Work Order No :</b></td>
                                            <td><?php echo $chalan['work_no']; ?></td>
                                            <td><b>Work Order Date :</b></td>
                                            <td><?php echo date('d/m/Y', strtotime($chalan['workdate'])); ?></td>
                                        </tr>
                                        <tr >
                                            <td><b>Product Name :</b></td>
                                            <td><?php echo $proname; ?></td>
                                            <td><b>Service Type :</b></td>
                                            <td><?php echo $servicetype; ?></td>
                                        </tr>
                                        <tr >
                                            <td><b><p class="bold"><?php echo _l('invoice_bill_to'); ?></p></b></td>
                                            <td>
                                                <address>
                                                    <span class="billing_street">
                                                        <?php $billing_street = (isset($estimate) ? $estimate->billing_street : '--'); ?>
                                                        <?php $billing_street = ($billing_street == '' ? '--' : $billing_street); ?>
                                                        <?php echo $billing_street; ?></span><br>
                                                    <span class="billing_city">
                                                        <?php $billing_city = (isset($estimate) ? $estimate->billing_city : '--'); ?>
                                                        <?php $billing_city = ($billing_city == '' ? '--' : $billing_city); ?>
                                                        <?php echo $billing_city; ?></span>,
                                                    <span class="billing_state">
                                                        <?php $billing_state = (isset($estimate) ? $estimate->billing_state : '--'); ?>
                                                        <?php $billing_state = ($billing_state == '' ? '--' : $billing_state); ?>
                                                        <?php echo $billing_state; ?></span>
                                                    <br/>
                                                     <span class="billing_country">
                                                    <?php
                                                    $billing_country = (isset($estimate) ? get_country_short_name($estimate->billing_country) : '--');
                                                    $billing_country = ($billing_country == '' ? '--' : $billing_country);
                                                    echo $billing_country;
                                                    ?>
                                                    </span>, 
                                                    <span class="billing_zip">
                                                        <?php $billing_zip = (isset($estimate) ? $estimate->billing_zip : '--'); ?>
                                                        <?php $billing_zip = ($billing_zip == '' ? '--' : $billing_zip); ?>
                                                        <?php echo $billing_zip; ?></span>
                                                </address></td>
                                            <td><b><?php echo _l('ship_to'); ?></b></td>
                                            <td>
                                                <address>
                                                    <span class="shipping_street">
                                                        <?php $shipping_street = (isset($estimate) ? $estimate->shipping_street : '--'); ?>
                                                        <?php $shipping_street = ($shipping_street == '' ? '--' : $shipping_street); ?>
                                                        <?php echo $shipping_street; ?>
                                                    </span><br>
                                                    <span class="shipping_city">
                                                        <?php $shipping_city = (isset($estimate) ? $estimate->shipping_city : '--'); ?>
                                                        <?php $shipping_city = ($shipping_city == '' ? '--' : $shipping_city); ?>
                                                        <?php echo $shipping_city; ?>
                                                    </span>,
                                                    <span class="shipping_state">
                                                        <?php $shipping_state = (isset($estimate) ? $estimate->shipping_state : '--'); ?>
                                                        <?php $shipping_state = ($shipping_state == '' ? '--' : $shipping_state); ?>
                                                        <?php echo $shipping_state; ?>
                                                    </span><br/>
                                                    <span class="shipping_zip">
                                                        <?php $shipping_zip = (isset($estimate) ? $estimate->shipping_zip : '--'); ?>
                                                        <?php $shipping_zip = ($shipping_zip == '' ? '--' : $shipping_zip); ?>
                                                        <?php echo $shipping_zip; ?>
                                                    </span>
                                                </address></td>
                                        </tr>
                                    </tbody>
                                </table>-->
                            </div>
                            
                            <div class="col-md-12">
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2% !important;">
                                    <thead>
                                        <tr>
                                            <th width="20%">No.</th>
                                            <th width="50%">Product Name</th>
                                            <th width="30%">QTY</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable" style="font-size:15px;">
                                        <?php
                                        $k = 0;
                                        $i = 1;

                                        if (!empty($chalan["product_json"])) {
                                            $products = json_decode($chalan["product_json"]);
                                            foreach ($products as $key => $single_chalan) {
                                                ?>
                                                <tr class="main" id="tr<?php echo $k; ?>">

                                                    <td width="20%"><?php echo ++$key; ?></td>
                                                    <td width="50%"><?php echo value_by_id("tblproducts", $single_chalan->product_id, "sub_name"); ?></td>
                                                    <td width="30%"><?php echo $single_chalan->product_qty; ?></td>

                                                </tr>
                                                <?php
                                                $k++;
                                            }
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="col-md-12">
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2% !important;">
                                    <thead>
                                        <tr>
                                            <th width="20%">S.no</th>
                                            <th width="50%">Bill Of Material</th>
                                            <th width="30%">Qty Delivered</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable" style="font-size:15px;">
                                        <?php
                                        $k = 0;
                                        $i = 1;
                                        foreach ($chalan_details as $single_chalan_details) {
                                            ?>
                                            <tr class="main" id="tr<?php echo $k; ?>">

                                                <td width="20%"><?php echo $i++; ?></td>
                                                <td width="50%"><?php echo $single_chalan_details['component_name']; ?></td>
                                                <td width="30%"><?php echo $single_chalan_details['qty']; ?></td>

                                            </tr>
                                            <?php
                                            $k++;
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                            
                            
                        </div>
                              <?php
                            $appvoal_info = $this->db->query("SELECT * FROM `tblchallanapproval` WHERE `challan_id`='" . $estimate->id . "' AND `approve_status`!=0")->row();
                            if (empty($appvoal_info) OR (!empty($appvoal_info) && $appvoal_info->approve_status == 5)) {
                                ?>
                                <div class="btn-bottom-toolbar bottom-transaction text-right">
                                    <button type="submit" name="action" value="5" style="background-color: #f9d306;color:#fff;" class="btn btn-warning hold mleft10 proposal-form-submit save-and-send transaction-submit">
                                        On Hold
                                    </button>
                                    <button type="submit" name="action" value="4" style="background-color: #9d0b1a;color:#fff;" class="btn btn-danger mleft10 proposal-form-submit save-and-send transaction-submit button3">
                                        Reconciliation
                                    </button>
                                    <button type="submit" name="action" value="2" class="btn btn-danger mleft10 proposal-form-submit save-and-send transaction-submit">
                                        Reject
                                    </button>
                                    <button type="submit" name="action" value="1" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                        Approved
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
                                            <textarea id="remark" required="" name="approvereason" class="form-control" rows="4"><?php echo (!empty($appvoal_info)) ? $appvoal_info->approvereason : '';?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="btn-bottom-pusher"></div>
            <?php echo form_close(); ?>
        </div>
    </div>
<?php init_tail(); ?>
    <script>

        $('#site_id').change(function () {
            var site_id = $('#site_id').val();
            var url = '<?php echo base_url(); ?>admin/Site_manager/getsitedetails';
            $.post(url,
                    {
                        site_id: site_id,
                    },
                    function (data, status) {
                        var res = JSON.parse(data);

                        $('.shipping_street').html(res.address);
                        $('#shipping_street').val(res.address);
                        $('.shipping_state').html(res.state_name);
                        $('#shipping_state').val(res.state_name);
                        $('.shipping_city').html(res.city_name);
                        $('#shipping_city').val(res.city_name);
                        $('.shipping_zip').html(res.pincode);
                        $('#shipping_zip').val(res.pincode);
                    });

        });
        $(function () {
            init_currency_symbol();
            // Maybe items ajax search
            init_ajax_search('items', '#item_select.ajax-search', undefined, admin_url + 'items/search');
            validate_proposal_form();

            $('.rel_id_label').html(_rel_type.find('option:selected').text());
            _rel_type.on('change', function () {
                var clonedSelect = _rel_id.html('').clone();
                _rel_id.selectpicker('destroy').remove();
                _rel_id = clonedSelect;
                $('#rel_id_select').append(clonedSelect);
                proposal_rel_id_select();
                if ($(this).val() != '') {
                    _rel_id_wrapper.removeClass('hide');
                } else {
                    _rel_id_wrapper.addClass('hide');
                }
                $('.rel_id_label').html(_rel_type.find('option:selected').text());
            });
            proposal_rel_id_select();
<?php if (!isset($proposal) && $rel_id != '') { ?>
                _rel_id.change();
<?php } ?>

        });
        /* function proposal_rel_id_select() {
         var serverData = {};
         serverData.rel_id = _rel_id.val();
         data.type = _rel_type.val();
<?php if (isset($proposal)) { ?>
             serverData.connection_type = 'proposal';
             serverData.connection_id = '<?php echo $proposal->id; ?>';
<?php } ?>
         init_ajax_search(_rel_type.val(), _rel_id, serverData);
         }*/
        function validate_proposal_form() {
            _validate_form($('#proposal-form'), {
                subject: 'required',
                proposal_to: 'required',
                rel_type: 'required',
                rel_id: 'required',
                date: 'required',
                email: {
                    email: true,
                    required: true
                },
                currency: 'required',
            });
        }
        function removecomponent(procompid)
        {
            $('#tr' + procompid).remove();
        }
        function getprostock(proid, value) {

            var warehouseid = '<?php echo $warehouse_id; ?>';
            var service_type = '<?php echo $service_type; ?>';
            var url = '<?php echo base_url(); ?>admin/Site_manager/getprostock';
            $.post(url,
                    {
                        proid: proid,
                        warehouseid: warehouseid,
                        service_type: service_type,
                    },
                    function (data, status)
                    {
                        $('#avabqty' + value).val(data);
                        $('#pendingqty' + value).val('0');
                    });
        }
        function staffdropdown() {
            $.each($("#assign option:selected"), function () {
                var select = $(this).val();
                $("optgroup." + select).children().attr('selected', 'selected');
            });
            $('.selectpicker').selectpicker('refresh');
            $.each($("#assign option:not(:selected)"), function () {
                var select = $(this).val();
                $("optgroup." + select).children().removeAttr('selected');
            });
            $('.selectpicker').selectpicker('refresh');
        }
        $('.approval').click(function () {
            var approval = parseInt($(this).attr('value'));
            var approval_desc = $('#approval_desc').val();
            var chalan_id = '<?php echo $chalan['id']; ?>';
            var url = '<?php echo base_url(); ?>admin/Site_manager/approvchalan';
            $.post(url,
                    {
                        chalan_id: chalan_id,
                        approval: approval,
                        approval_desc: approval_desc,
                    },
                    function (data, status)
                    {
                        $('.successdv').show();
                        $('.chalandv').hide();
                    });
        });


        function changeDeliverableQty(product_key) {
            var pending_qty = $("#pendingqty" + product_key).val();
            var required_qty = $("#reqqty" + product_key).val();
            if ((pending_qty !== '') && (pending_qty.indexOf('.') === -1))
            {
                $('#pendingqty' + product_key).val(Math.max(Math.min(pending_qty, required_qty), -required_qty));
            }
            var pending_qty = $("#pendingqty" + product_key).val();
            var deliverable_qty = parseInt(required_qty) - Math.abs(parseInt(pending_qty));
            $("#deliverable_qty_" + product_key).html("").html(deliverable_qty);
            if (pending_qty == 0)
            {
                $('#pendingststatus' + product_key).val(1);
                $('.selectpicker').selectpicker('refresh');
            }
            else
            {
                $('#pendingststatus' + product_key).val(0);
                $('.selectpicker').selectpicker('refresh');
            }
        }
    </script>
</body>
</html>
