<?php init_head(); ?>
<style>.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php
            if (isset($proposal)) {
                echo form_hidden('isedit', $proposal->id);
            }
            $rel_type = '';
            $rel_id = '';
            if (isset($proposal) || ($this->input->get('rel_id') && $this->input->get('rel_type'))) {
                if ($this->input->get('rel_id')) {
                    $rel_id = $this->input->get('rel_id');
                    $rel_type = $this->input->get('rel_type');
                } else {
                    $rel_id = $proposal->rel_id;
                    $rel_type = $proposal->rel_type;
                }
            }
            ?>
            <?php echo form_open($this->uri->uri_string(), array('id' => 'proposal-form', 'class' => '_propsal_form proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <?php if (isset($proposal)) { ?>
                                <div class="col-md-12">
                                    <?php echo format_proposal_status($proposal->status); ?>
                                </div>
                                <div class="clearfix"></div>
                                <hr />
                            <?php } ?>
                            <div class="col-md-6 border-right">
                                <?php $value = (isset($proposal) ? $proposal->subject : ''); ?>
                                <?php $attrs = (isset($proposal) ? array() : array('autofocus' => true)); ?>
                                <?php echo render_input('subject', 'proposal_subject', $value, 'text', $attrs); ?>
                                <div class="form-group select-placeholder">
                                    <label for="rel_type" class="control-label"><?php echo _l('proposal_related'); ?></label>
                                    <select name="rel_type" onchange="get_rel_list(this.value)" id="rel_type" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                        <option value=""></option>
                                        <option value="proposal" <?php
                                        if ((isset($proposal) && $proposal->rel_type == 'proposal') || $this->input->get('rel_type')) {
                                            if ($rel_type == 'proposal') {
                                                echo 'selected';
                                            }
                                        }
                                        ?>><?php echo _l('proposal_for_lead'); ?></option>
                                        <option value="customer" <?php
                                        if ((isset($proposal) && $proposal->rel_type == 'customer') || $this->input->get('rel_type')) {
                                            if ($rel_type == 'customer') {
                                                echo 'selected';
                                            }
                                        }
                                        ?>><?php echo _l('proposal_for_customer'); ?></option>
                                    </select>
                                </div>
								<div class="ert"></div>
                                <div class="form-group select-placeholder<?php
                                if ($rel_id == '') {
                                    echo ' hide';
                                }
                                ?> " id="rel_id_wrapper">
                                    <label for="rel_id"><span class="rel_id_label"></span></label>
                                    <div id="rel_id_select">
                                        <select name="rel_id" id="rel_id" class="form-control selectpicker" data-live-search="true">
                                           <option value=""></option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="enquiry_date" class="control-label"><?php echo _l('lead_source'); ?></label>
                                            <select class="form-control selectpicker" data-live-search="true" id="source" name="source">
                                                <option value=""></option>
                                                <?php
                                                if (isset($all_source) && count($all_source) > 0) {
                                                    foreach ($all_source as $source_key => $source_value) {
                                                        ?>
                                                        <option value="<?php echo $source_value['id'] ?>" <?php echo (isset($proposal) && $proposal->source == $source_value['id']) ? 'selected' : "" ?>><?php echo $source_value['name'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php $value = (isset($proposal) ? _d($proposal->date) : _d(date('Y-m-d'))) ?>
                                        <?php echo render_date_input('date', 'proposal_date', $value); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php
                                        $value = '';
                                        if (isset($proposal)) {
                                            $value = _d($proposal->open_till);
                                        } else {
                                            if (get_option('proposal_due_after') != 0) {
                                                $value = _d(date('Y-m-d', strtotime('+' . get_option('proposal_due_after') . ' DAY', strtotime(date('Y-m-d')))));
                                            }
                                        }
                                        echo render_date_input('open_till', 'proposal_open_till', $value);
                                        ?>
                                    </div>
                                </div>
                                <?php
                                $selected = '';
                                $s_attrs = array('data-show-subtext' => true);
                                foreach ($currencies as $currency) {
                                    if ($currency['isdefault'] == 1) {
                                        $s_attrs['data-base'] = $currency['id'];
                                    }
                                    if (isset($proposal)) {
                                        if ($currency['id'] == $proposal->currency) {
                                            $selected = $currency['id'];
                                        }
                                        if ($proposal->rel_type == 'customer') {
                                            $s_attrs['disabled'] = true;
                                        }
                                    } else {
                                        if ($rel_type == 'customer') {
                                            $customer_currency = $this->clients_model->get_customer_default_currency($rel_id);
                                            if ($customer_currency != 0) {
                                                $selected = $customer_currency;
                                            } else {
                                                if ($currency['isdefault'] == 1) {
                                                    $selected = $currency['id'];
                                                }
                                            }
                                            $s_attrs['disabled'] = true;
                                        } else {
                                            if ($currency['isdefault'] == 1) {
                                                $selected = $currency['id'];
                                            }
                                        }
                                    }
                                }
                                ?>
                                <!--<div class="row">
                                    <div class="col-md-6">
                                        <?php
                                        echo render_select('currency', $currencies, array('id', 'name', 'symbol'), 'proposal_currency', $selected, do_action('proposal_currency_disabled', $s_attrs));
                                        ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group select-placeholder">
                                            <label for="discount_type" class="control-label"><?php echo _l('discount_type'); ?></label>
                                            <select name="discount_type" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                                <option value="" selected><?php echo _l('no_discount'); ?></option>
                                                <option value="before_tax" <?php
                                                if (isset($estimate)) {
                                                    if ($estimate->discount_type == 'before_tax') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>><?php echo _l('discount_type_before_tax'); ?></option>
                                                <option value="after_tax" <?php
                                                if (isset($estimate)) {
                                                    if ($estimate->discount_type == 'after_tax') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>><?php echo _l('discount_type_after_tax'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>-->
                                <?php $fc_rel_id = (isset($proposal) ? $proposal->id : false); ?>
                                <?php echo render_custom_fields('proposal', $fc_rel_id); ?>
                                <div class="form-group no-mbot">
                                    <label for="tags" class="control-label"><i class="fa fa-tag" aria-hidden="true"></i> <?php echo _l('tags'); ?></label>
                                    <input type="text" class="tagsinput" id="tags" name="tags" value="<?php echo (isset($proposal) ? prep_tags_input(get_tags_in($proposal->id, 'proposal')) : ''); ?>" data-role="tagsinput">
                                </div>
                                <div class="form-group mtop10 no-mbot">
                                    <p><?php echo _l('proposal_allow_comments'); ?></p>
                                    <div class="onoffswitch">
                                        <input type="checkbox" id="allow_comments" class="onoffswitch-checkbox" <?php
                                        if (isset($proposal)) {
                                            if ($proposal->allow_comments == 1) {
                                                echo 'checked';
                                            }
                                        };
                                        ?> value="on" name="allow_comments">
                                        <label class="onoffswitch-label" for="allow_comments" data-toggle="tooltip" title="<?php echo _l('proposal_allow_comments_help'); ?>"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group select-placeholder">
                                            <label for="status" class="control-label"><?php echo _l('proposal_status'); ?></label>
                                            <?php
                                            $disabled = '';
                                            if (isset($proposal)) {
                                                if ($proposal->estimate_id != NULL || $proposal->invoice_id != NULL) {
                                                    $disabled = 'disabled';
                                                }
                                            }
                                            ?>
                                            <select name="status" class="selectpicker" data-width="100%" <?php echo $disabled; ?> data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                                <?php foreach ($statuses as $status) { ?>
                                                    <option value="<?php echo $status; ?>" <?php
                                                    if ((isset($proposal) && $proposal->status == $status) || (!isset($proposal) && $status == 0)) {
                                                        echo 'selected';
                                                    }
                                                    ?>><?php echo format_proposal_status($status, '', false); ?></option>
                                                        <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <?php
                                        $i = 0;
                                        $selected = '';
                                        foreach ($staff as $member) {
                                            if (isset($proposal)) {
                                                if ($proposal->assigned == $member['staffid']) {
                                                    $selected = $member['staffid'];
                                                }
                                            }
                                            $i++;
                                        }
                                        echo render_select('assigned', $staff, array('staffid', array('firstname', 'lastname')), 'proposal_assigned', $selected);
                                        ?>
                                    </div>
                                </div>
                                <?php $value = (isset($proposal) ? $proposal->proposal_to : ''); ?>
                                <?php echo render_input('proposal_to', 'proposal_to', $value); ?>
                                <?php $value = (isset($proposal) ? $proposal->address : ''); ?>
                                <?php echo render_textarea('address', 'proposal_address', $value); ?>
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="city_id" class="control-label"><?php echo _l('site_city'); ?></label>
                                            <select class="form-control selectpicker" id="city" name="city" data-live-search="true">
                                                <option value=""></option>
                                                <?php
                                                if (isset($all_city_data) && count($all_city_data) > 0) {
                                                    foreach ($all_city_data as $city_key => $city_value) {
                                                        ?>
                                                        <option value="<?php echo $city_value['id'] ?>" <?php echo (isset($lead['clientbranch']['city']) && $lead['clientbranch']['city'] == $city_value['id']) ? 'selected' : "" ?>><?php echo $city_value['name'] ?></option>
                                                        <?php
                                                    }
                                                } else if (isset($lead['city']) & $lead['city'] != '') {
                                                    foreach ($allcity as $city_key => $city_value) {
                                                        ?>
                                                        <option value="<?php echo $city_value['id'] ?>" <?php echo (isset($lead['city']) && $lead['city'] == $city_value['id']) ? 'selected' : "" ?>><?php echo $city_value['name'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="state_id" class="control-label"><?php echo _l('billing_state'); ?></label>
                                            <select class="form-control selectpicker" id="state" name="state" onchange="get_city_by_stateid(this.value)" data-live-search="true">
                                                <option value=""></option>
                                                <?php
                                                if (isset($state_data) && count($state_data) > 0) {
                                                    foreach ($state_data as $state_key => $state_value) {
                                                        ?>
                                                        <option value="<?php echo $state_value['id'] ?>" <?php echo (isset($proposal->state) && $proposal->state == $state_value['id']) ? 'selected' : "" ?>><?php echo $state_value['name'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!--<div class="col-md-6">
                                    <?php $countries = get_all_countries(); ?>
                                    <?php $selected = (isset($proposal) ? $proposal->country : ''); ?>
                                    <?php echo render_select('country', $countries, array('country_id', array('short_name'), 'iso2'), 'billing_country', $selected); ?>
                                    </div>-->
                                    <div class="col-md-12">
                                        <?php $value = (isset($proposal) ? $proposal->zip : ''); ?>
                                        <?php echo render_input('zip', 'billing_zip', $value); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php $value = (isset($proposal) ? $proposal->email : ''); ?>
                                        <?php echo render_input('email', 'proposal_email', $value); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php $value = (isset($proposal) ? $proposal->phone : ''); ?>
                                        <?php echo render_input('phone', 'proposal_phone', $value); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-bottom-toolbar bottom-transaction text-right">
                            <p class="no-mbot pull-left mtop5 btn-toolbar-notice"><?php echo _l('include_proposal_items_merge_field_help', '<b>{proposal_items}</b>'); ?></p>
                            <button type="submit" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                <?php echo _l('submit'); ?>
                            </button>
                            <button class="btn btn-info mleft5 proposal-form-submit transaction-submit" type="submit">


                                <?php echo _l('send_for_approval'); ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3"><?php echo _l('proposal_for_rent'); ?></h4>
                                <hr/>
                            </div>
                            <div class="col-md-12">
                                <div style="overflow-x:auto !important;">
                                    <div class="form-group" id="docAttachDivVideo" style="margin-left:10px;width:1800px !important;">
                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop renttable">
                                            <thead>
                                                <tr>
                                                    <td style="width: 200px !important;"><?php echo _l('prop_pro_name'); ?></td>
                                                    <td style="width: 100px !important;"><?php echo _l('prop_pro_remark'); ?></td>
                                                    <td style="width: 70px !important;"><?php echo _l('prop_pro_id'); ?></td>
                                                    <td style="width: 35px !important;"><?php echo _l('prop_pro_hsn_code'); ?></td>
                                                    <td style="width: 35px  !important;"><?php echo _l('prop_pro_qty'); ?></td>
                                                    <td style="width: 45px !important;"><?php echo _l('prop_pro_price'); ?></td>
                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_tot_price'); ?></td>
                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_disc'); ?>%</td>
                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_disc_amt'); ?></td>
                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_disc_price'); ?></td>
                                                    <td style="width: 45px !important;"><?php echo _l('prop_pro_profit_margin'); ?>%</td>
                                                    <?php
                                                    if (isset($proposal->is_gst)) {
                                                        if ($proposal->is_gst == 1) {
                                                            $label = _l('prop_pro_sgst_amt');
                                                            ?>
                                                            <td style="width: 47px !important;"><?php echo _l('prop_pro_cgst'); ?>% </td>
                                                            <td style="width: 47px !important;"><?php echo _l('prop_pro_sgst'); ?>%</td>
                                                            <?php
                                                        } else {
                                                            $label = _l('prop_pro_igst');
                                                            ?>
                                                            <td style="width: 47px !important;"><?php echo _l('prop_pro_igst'); ?>%</td>
                                                            <?php
                                                        }
                                                    } else {
                                                        if ($clientsate == get_staff_state()) {
                                                            $label = _l('prop_pro_sgst_amt');
                                                            ?>
                                                            <td style="width: 47px !important;"><?php echo _l('prop_pro_cgst'); ?>% </td>
                                                            <td style="width: 47px !important;"><?php echo _l('prop_pro_sgst'); ?>%</td>
                                                            <?php
                                                        } else {
                                                            $label = _l('prop_pro_igst');
                                                            ?>
                                                            <td style="width: 47px !important;"><?php echo _l('prop_pro_igst'); ?>%</td>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <td style="width: 47px !important;"><?php echo $label; ?></td>
                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_grand_total'); ?></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                if (isset($rent_prolist)) {
                                                    ?>												  
                                                <input type="hidden" id="totalrentpro" value="<?php echo count($rent_prolist); ?>">
                                                <?php
                                                foreach ($rent_prolist as $single_prod_rent_det) {
                                                    // $pro_id['pro_id'];

                                                    $i++;
                                                    $proprice = $single_prod_rent_det['rate'];
                                                    $prodprice = $proprice * $single_prod_rent_det['qty'];
                                                    //$totpro=$prodprice-(($prodprice*$single_prod_rent_det['discount'])/100)+(($prodprice*18)/100);
                                                    $totpro = $prodprice - (($prodprice * $single_prod_rent_det['discount']) / 100);
                                                    $prodet = $this->db->query("SELECT * FROM `tblproducts` WHERE `id`='" . $single_prod_rent_det['pro_id'] . "'")->row_array();
                                                    $pricelist = array($prodet['rental_price_cat_a'], $prodet['rental_price_cat_b'], $prodet['rental_price_cat_c'], $prodet['rental_price_cat_d']);
                                                    $min_price = min($pricelist);
                                                    //$min_prc[] = min($pricelist);
                                                    $profitper = (($proprice - $min_price) / $min_price) * 100;
                                                    if ($profitper >= 0 && $profitper <= 9.99) {
                                                        $color = 'red';
                                                    } else if ($profitper >= 10 && $profitper <= 14.99) {
                                                        $color = 'yellow';
                                                    } else if ($profitper >= 15 && $profitper <= 19.99) {
                                                        $color = 'blue';
                                                    } else if ($profitper >= 20 && $profitper <= 29.99) {
                                                        $color = 'green';
                                                    } else if ($profitper >= 30) {
                                                        $color = 'orange';
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <a target="_blank" href="../product/product/<?php echo $single_prod_rent_det['pro_id']; ?>">
                                                                <input class="form-control" type="text" name="rentproposal[<?php echo $i; ?>][product_name]" readonly="" style="cursor: pointer !important;" value="<?php echo $single_prod_rent_det['description']; ?>">
                                                            </a>
                                                            <input value="<?php echo $single_prod_rent_det['pro_id']; ?>" name="rentproposal[<?php echo $i; ?>][product_id]" type="hidden">
                                                            <input value="<?php echo $single_prod_rent_det['id']; ?>" name="rentproposal[<?php echo $i; ?>][itemid]" type="hidden">
                                                            <input value="<?php echo $min_price; ?>" id="averageprice<?php echo $i; ?>" type="hidden">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="rentproposal[<?php echo $i; ?>][remark]" readonly="" value="<?php echo $single_prod_rent_det['long_description']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="rentproposal[<?php echo $i; ?>][pro_id]" readonly="" value="PRO-ID<?php echo $single_prod_rent_det['pro_id']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="rentproposal[<?php echo $i; ?>][hsn_code]" readonly="" value="<?php echo $single_prod_rent_det['hsn_code']; ?>">
                                                        </td>

                                                        <td>
                                                            <input type="number" class="form-control" id="rentqty_<?php echo $i; ?>" name="rentproposal[<?php echo $i; ?>][qty]" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" min="1" value="<?php echo $single_prod_rent_det['qty']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="rentmainprice_<?php echo $i; ?>" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" value="<?php echo $proprice; ?>" name="rentproposal[<?php echo $i; ?>][price]" id="price1">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="rentprice_<?php echo $i; ?>" value="<?php echo $proprice * $single_prod_rent_det['qty']; ?>" id="total_price1">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="rentdisc_<?php echo $i; ?>" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)"  value="<?php echo $single_prod_rent_det['discount']; ?>" name="rentproposal[<?php echo $i; ?>][discount]" id="discount_percentage">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" id="rentdisc_amt_<?php echo $i; ?>" class="form-control" value="<?php echo (($prodprice * $single_prod_rent_det['discount']) / 100); ?>">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="rentdisc_price_<?php echo $i; ?>" value="<?php echo $prodprice - (($prodprice * $single_prod_rent_det['discount']) / 100); ?>">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control <?php echo $color; ?>" id="rentprofit_amt<?php echo $i; ?>" value="<?php echo $profitper; ?>">
                                                        </td>
                                                        <?php
                                                        if ($single_prod_rent_det['is_gst'] == 1) {
                                                            ?>
                                                            <td>
                                                                <input type="hidden" name="rentproposal[<?php echo $i; ?>][isgst]" value="1">
                                                                <input readonly="" type="text" class="form-control" value="9">
                                                            </td>
                                                            <td>
                                                                <input readonly="" type="text" class="form-control" value="9">
                                                            </td>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <td>
                                                                <input type="hidden" name="rentproposal[<?php echo $i; ?>][isgst]" value="0">
                                                                <input readonly="" type="text" class="form-control" value="18">
                                                            </td>
                                                        <?php }
                                                        ?>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="renttax_amt_<?php echo $i; ?>" value="<?php echo (($prodprice * 18) / 100); ?>" id="total_price1">
                                                        </td>
                                                        <td class="grandtotal totalamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_<?php echo $i; ?>">
                                                            <?php echo ($totpro); ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <input type="hidden" id="totalrentpro" value="<?php echo count($lead_prod_rent_det); ?>">
                                                <?php
                                                foreach ($lead_prod_rent_det as $single_prod_rent_det) {
                                                    $i++;
                                                    if ($single_prod_rent_det['company_category'] == 1) {
                                                        $proprice = $single_prod_rent_det['rental_price_cat_a'];
                                                    } else if ($single_prod_rent_det['company_category'] == 2) {
                                                        $proprice = $single_prod_rent_det['rental_price_cat_b'];
                                                    } else if ($single_prod_rent_det['company_category'] == 3) {
                                                        $proprice = $single_prod_rent_det['rental_price_cat_c'];
                                                    } else if ($single_prod_rent_det['company_category'] == 4) {
                                                        $proprice = $single_prod_rent_det['rental_price_cat_d'];
                                                    }

                                                    $pricelist = array($single_prod_rent_det['rental_price_cat_a'], $single_prod_rent_det['rental_price_cat_b'], $single_prod_rent_det['rental_price_cat_c'], $single_prod_rent_det['rental_price_cat_d']);
                                                    $min_price = min($pricelist);
                                                    //$min_prc[] = min($pricelist);
                                                    $profitper = (($proprice - $min_price) / $min_price) * 100;
                                                    if ($profitper >= 0 && $profitper <= 9.99) {
                                                        $color = 'red';
                                                    } else if ($profitper >= 10 && $profitper <= 14.99) {
                                                        $color = 'yellow';
                                                    } else if ($profitper >= 15 && $profitper <= 19.99) {
                                                        $color = 'blue';
                                                    } else if ($profitper >= 20 && $profitper <= 29.99) {
                                                        $color = 'green';
                                                    } else if ($profitper >= 30) {
                                                        $color = 'orange';
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <a target="_blank" href="../product/product/<?php echo $single_prod_rent_det['id']; ?>">
                                                                <input class="form-control" type="text" name="rentproposal[<?php echo $i; ?>][product_name]" readonly="" style="cursor: pointer !important;" value="<?php echo $single_prod_rent_det['name']; ?>">
                                                            </a>
                                                            <input value="<?php echo $single_prod_rent_det['id']; ?>" name="rentproposal[<?php echo $i; ?>][product_id]" type="hidden">
                                                            <input value="<?php echo $min_price; ?>" id="averageprice<?php echo $i; ?>" type="hidden">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="rentproposal[<?php echo $i; ?>][remark]" readonly="" value="<?php echo $single_prod_rent_det['product_remarks']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="rentproposal[<?php echo $i; ?>][pro_id]" readonly="" value="PRO-ID<?php echo $single_prod_rent_det['id']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="rentproposal[<?php echo $i; ?>][hsn_code]" readonly="" value="<?php echo $single_prod_rent_det['hsn_code']; ?>">
                                                        </td>

                                                        <td>
                                                            <input type="number" class="form-control" id="rentqty_<?php echo $i; ?>" name="rentproposal[<?php echo $i; ?>][qty]" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" min="1" value="1">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="rentmainprice_<?php echo $i; ?>" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" value="<?php echo $proprice; ?>" name="rentproposal[<?php echo $i; ?>][price]" id="price1">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="rentprice_<?php echo $i; ?>" value="<?php echo $proprice * 1; ?>" id="total_price1">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="rentdisc_<?php echo $i; ?>" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)"  value="" name="rentproposal[<?php echo $i; ?>][discount]" id="discount_percentage">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" id="rentdisc_amt_<?php echo $i; ?>" class="form-control" value="0.00">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="rentdisc_price_<?php echo $i; ?>" value="<?php echo $proprice * 1; ?>">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control <?php echo $color; ?>" id="rentprofit_amt<?php echo $i; ?>" value="<?php echo $profitper; ?>">
                                                        </td>
                                                        <?php
                                                        if ($single_prod_rent_det['state'] == get_staff_state()) {
                                                            ?>
                                                            <td>
                                                                <input type="hidden" name="rentproposal[<?php echo $i; ?>][isgst]" value="1">
                                                                <input readonly="" type="text" class="form-control" value="9">
                                                            </td>
                                                            <td>
                                                                <input readonly="" type="text" class="form-control" value="9">
                                                            </td>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <td>
                                                                <input type="hidden" name="rentproposal[<?php echo $i; ?>][isgst]" value="0">
                                                                <input readonly="" type="text" class="form-control" value="18">
                                                            </td>
                                                        <?php }
                                                        ?>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="renttax_amt_<?php echo $i; ?>" value="<?php echo (($proprice * 18) / 100); ?>" id="total_price1">
                                                        </td>
                                                        <td class="grandtotal totalamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_<?php echo $i; ?>">
                                                            <?php //echo ($proprice+(($proprice*18)/100)); ?>
                                                            <?php echo ($proprice); ?>
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
                                <div class="row" style="margin-top:2%;">
                                    <div class="col-md-3">
                                        <label class="control-label">Total Amount <span style="color:red">*</span></label>
                                        <input readonly="" type="text" class="form-control rent_total_amt" value="<?php echo (isset($proposal) && $proposal->rentsubtotal != '') ? $proposal->rentsubtotal : ""; ?>" name="rentproposal[finalsubtotalamount]" id="rent_total_amt">
                                        <div class="sale_total_amtError error_msg"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Total Discount (%) <span style="color:red">*</span></label>
                                        <input type="text" class="form-control rent_discount_percentage" value="<?php echo (isset($proposal) && $proposal->rent_discount_percent != '') ? $proposal->rent_discount_percent : ""; ?>" onchange="get_total_disc_rent()" name="rentproposal[finaldiscountpercentage]" id="rent_discount_percentage">
                                        <div class="sale_discount_percentageError error_msg"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Total Discount Amt <span style="color:red">*</span></label>
                                        <input readonly="" type="text" class="form-control rent_discount_amt" value="<?php echo (isset($proposal) && $proposal->rent_discount_total != '') ? $proposal->rent_discount_total : ""; ?>" name="rentproposal[finaldiscountamount]" id="rent_discount_amt">
                                        <div class="sale_discount_amtError error_msg"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Total Quotation Amount (Rent) <span style="color:red">*</span></label>
                                        <input style="font-weight:bold;" readonly="" type="text" class="form-control rent_total_quotation_amt" value="<?php echo (isset($proposal) && $proposal->renttotal != '') ? $proposal->renttotal : ""; ?>" name="rentproposal[totalamount]" id="rent_total_quotation_amt">
                                        <div class="sale_total_quotation_amtError error_msg"></div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:2%;padding:8px;">
                                    <div class="col-md-12 pull-right">
                                        <label class="col-md-6 control-label text-right">Total Margin Profits</label>
                                        <div class="col-md-6" style="background:#80808057;margin:0;padding:0"><label style="margin:0;font-weight:500;font-size: 16px;text-transform: capitalize;" class="col-md-6 pull-left control-label rent_total_quotation_margin_profit text-right"></label></div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:2%;padding:8px;">
                                    <div class="col-md-12 pull-right">
                                        <label class="col-md-6 control-label text-right">Amount In Words</label>
                                        <label style="font-weight:500;font-size: 16px;text-transform: capitalize;" class="col-md-6 pull-left control-label rent_total_quotation_amt_in_words text-right"></label>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:2%;padding:8px;">
                                    <div class="col-md-12 pull-right">
                                        <label class="col-md-6 control-label text-right">Tax Amount In Words</label>
                                        <label style="font-weight:500;font-size: 16px;text-transform: capitalize;" class="col-md-6 pull-left control-label rent_total_quotation_tax_amt_in_words text-right"></label>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <hr/>
                        <div class="table-responsive s_table" style="margin-top:3%;">

                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3"><?php echo _l('other_charges_for_rent'); ?></h4>
                                <hr/>
                            </div>
                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable">
                                <thead>
                                    <tr>
                                        <th width="40%" align="left"><?php echo _l('other_charges_cat_name'); ?></th>
                                        <th width="10%" class="qty" align="left"><?php echo _l('other_charges_sac_code'); ?></th>
                                        <th width="10%" align="left"><?php echo _l('amt'); ?>	</th>
                                        <?php
                                        if (isset($proposal->is_gst)) {
                                            if ($proposal->is_gst == 1) {
                                                ?>
                                                <th width="10%" align="left"><?php echo _l('other_charges_cgst'); ?>	</th>
                                                <th width="10%" align="left"><?php echo _l('other_charges_sgst'); ?>	</th>
                                                <?php
                                            } else {
                                                ?>
                                                <th width="20%" align="left"><?php echo _l('other_charges_igst'); ?>	</th>
                                                <?php
                                            }
                                        } else {
                                            if ($clientsate == get_staff_state()) {
                                                ?>
                                                <th width="10%" align="left"><?php echo _l('other_charges_cgst'); ?>	</th>
                                                <th width="10%" align="left"><?php echo _l('other_charges_sgst'); ?>	</th>
                                                <?php
                                            } else {
                                                ?>
                                                <th width="20%" align="left"><?php echo _l('other_charges_igst'); ?>	</th>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <th width="10%" align="left"><?php
                                            if ($clientsate == get_staff_state()) {
                                                echo _l('cgst_amt_sgst_amt');
                                            } else {
                                                echo _l('cgst_amt_igst_amt');
                                            }
                                            ?>	</th>
                                        <th width="15%" align="left"><?php echo _l('total_amount'); ?>	</th>
                                        <th width="5%"  align="center"><i class="fa fa-cog"></i></th>
                                    </tr>
                                </thead>
                                <tbody class="ui-sortable">
                                    <?php
                                    if (count($rent_othercharges) > 0) {
                                        $l = 0;
                                        foreach ($rent_othercharges as $singlerentotherchargesp) {
                                            $l++;
                                            ?>
                                            <tr id="tr<?php echo $l; ?>">
                                                <td>
                                                    <div class="form-group">
                                                        <select class="form-control selectpicker" data-live-search="true" id="othercharges<?php echo $l; ?>" onchange="otherchargesdata(<?php echo $l; ?>)" name="othercharges[<?php echo $l; ?>][category_name]">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($othercharges) && count($othercharges) > 0) {
                                                                foreach ($othercharges as $othercharges_key => $othercharges_value) {
                                                                    ?>
                                                                    <option value="<?php echo $othercharges_value['id'] ?>" <?php
                                                                    if (isset($singlerentotherchargesp['category_name']) && $singlerentotherchargesp['category_name'] != '' && $singlerentotherchargesp['category_name'] == $othercharges_value['id']) {
                                                                        echo'selected=selected';
                                                                    }
                                                                    ?> ><?php echo $othercharges_value['category_name'] ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="sac_code<?php echo $l; ?>" value="<?php echo $singlerentotherchargesp['sac_code']; ?>" name="othercharges[<?php echo $l; ?>][sac_code]" class="form-control" >
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="amount<?php echo $l; ?>" value="<?php echo $singlerentotherchargesp['amount']; ?>" name="othercharges[<?php echo $l; ?>][amount]" onchange="getothercharges('<?php echo $l; ?>')"  class="form-control" >
                                                    </div>
                                                </td>
                                                <?php
                                                if (isset($proposal->is_gst)) {
                                                    if ($proposal->is_gst == 1) {
                                                        ?>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="gst<?php echo $l; ?>" value="<?php echo $singlerentotherchargesp['gst']; ?>" name="othercharges[<?php echo $l; ?>][gst]" onchange="getothercharges('<?php echo $l; ?>')" class="form-control" >
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="sgst<?php echo $l; ?>" name="othercharges[<?php echo $l; ?>][sgst]" value="<?php echo $singlerentotherchargesp['sgst']; ?>" onchange="getothercharges('<?php echo $l; ?>')" class="form-control" >
                                                            </div>
                                                        </td>

                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="igst<?php echo $l; ?>" name="othercharges[<?php echo $l; ?>][igst]" value="<?php echo $singlerentotherchargesp['igst']; ?>" onchange="getothercharges('<?php echo $l; ?>')" class="form-control" >
                                                            </div>
                                                        </td>
                                                        <?php
                                                    }
                                                } else {
                                                    if ($clientsate == get_staff_state()) {
                                                        ?>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="gst<?php echo $l; ?>" value="<?php echo $singlerentotherchargesp['gst']; ?>" name="othercharges[<?php echo $l; ?>][gst]" onchange="getothercharges('<?php echo $l; ?>')" class="form-control" >
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="sgst<?php echo $l; ?>" name="othercharges[<?php echo $l; ?>][sgst]" value="<?php echo $singlerentotherchargesp['sgst']; ?>" onchange="getothercharges('<?php echo $l; ?>')" class="form-control" >
                                                            </div>
                                                        </td>

                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="igst<?php echo $l; ?>" name="othercharges[<?php echo $l; ?>][igst]" value="<?php echo $singlerentotherchargesp['igst']; ?>" onchange="getothercharges('<?php echo $l; ?>')" class="form-control" >
                                                            </div>
                                                        </td>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="gst_sgst_amt<?php echo $l; ?>" name="othercharges[<?php echo $l; ?>][gst_sgst_amt]" value="<?php echo $singlerentotherchargesp['gst_sgst_amt']; ?>"  class="form-control">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="total_maount<?php echo $l; ?>" name="othercharges[<?php echo $l; ?>][total_maount]" value="<?php echo $singlerentotherchargesp['total_maount']; ?>" class="form-control">
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges('<?php echo $l; ?>');" ><i class="fa fa-remove"></i></button>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr id="tr0">
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control selectpicker" data-live-search="true" id="othercharges0" onchange="otherchargesdata(0)" name="othercharges[0][category_name]">
                                                        <option value=""></option>
                                                        <?php
                                                        if (isset($othercharges) && count($othercharges) > 0) {
                                                            foreach ($othercharges as $othercharges_key => $othercharges_value) {
                                                                ?>
                                                                <option value="<?php echo $othercharges_value['id'] ?>"  ><?php echo $othercharges_value['category_name'] ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" id="sac_code0" name="othercharges[0][sac_code]" class="form-control" >
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" id="amount0" name="othercharges[0][amount]" onchange="getothercharges(0)" class="form-control" >
                                                </div>
                                            </td>
                                            <?php
                                            if ($clientsate == get_staff_state()) {
                                                ?>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="gst0" value="0" onchange="getothercharges(0)" name="othercharges[0][gst]" class="form-control" >
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="sgst0" value="0" onchange="getothercharges(0)" name="othercharges[0][sgst]" class="form-control" >
                                                    </div>
                                                </td>

                                                <?php
                                            } else {
                                                ?>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="igst0" value="0" name="othercharges[0][igst]" onchange="getothercharges(0)" class="form-control" >
                                                    </div>
                                                </td>
                                            <?php }
                                            ?>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" id="gst_sgst_amt0" name="othercharges[0][gst_sgst_amt]" class="form-control">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" id="total_maount0" name="othercharges[0][total_maount]" class="form-control">
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges('0');" ><i class="fa fa-remove"></i></button>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                            <div class="col-xs-4">
                                <label class="label-control subHeads"><a  class="addmore" value="<?php echo count($rent_othercharges); ?>">Add More <i class="fa fa-plus"></i></a></label>
                            </div>
                            <div class="col-xs-8">
                                <label style="float : right !important;">
                                    <strong style="font-size:14px;">Other Charges Sub Total For Rent :-</strong>
                                    <strong class="rent_other_charges_subtotal">0</strong>		
                                </label>
                            </div>
                        </div>


                        <div class="row" style="margin-top:8%;">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3"><?php echo _l('proposal_for_sale'); ?></h4>
                                <hr/>
                            </div>
                            <div class="col-md-12">
                                <div style="overflow-x:auto !important;">
                                    <div class="form-group" id="docAttachDivVideo" style="margin-left:10px;width:1800px !important;">
                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                            <thead>
                                                <tr>
                                                    <td style="width: 200px !important;"><?php echo _l('prop_pro_name'); ?></td>
                                                    <td style="width: 100px !important;"><?php echo _l('prop_pro_remark'); ?></td>
                                                    <td style="width: 70px !important;"><?php echo _l('prop_pro_id'); ?></td>
                                                    <td style="width: 35px !important;"><?php echo _l('prop_pro_hsn_code'); ?></td>
                                                    <td style="width: 35px  !important;"><?php echo _l('prop_pro_qty'); ?></td>
                                                    <td style="width: 45px !important;"><?php echo _l('prop_pro_price'); ?></td>
                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_tot_price'); ?></td>
                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_disc'); ?>%</td>
                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_disc_amt'); ?></td>
                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_disc_price'); ?></td>
                                                    <td style="width: 45px !important;"><?php echo _l('prop_pro_profit_margin'); ?>%</td>
                                                    <?php
                                                    if (isset($proposal->is_gst)) {
                                                        if ($proposal->is_gst == 1) {
                                                            $label = _l('prop_pro_sgst_amt');
                                                            ?>
                                                            <td style="width: 47px !important;"><?php echo _l('prop_pro_cgst'); ?>% </td>
                                                            <td style="width: 47px !important;"><?php echo _l('prop_pro_sgst'); ?>%</td>
                                                            <?php
                                                        } else {
                                                            $label = _l('prop_pro_igst');
                                                            ?>
                                                            <td style="width: 47px !important;"><?php echo _l('prop_pro_igst'); ?>%</td>
                                                            <?php
                                                        }
                                                    } else {
                                                        if ($clientsate == get_staff_state()) {
                                                            $label = _l('prop_pro_sgst_amt');
                                                            ?>
                                                            <td style="width: 47px !important;"><?php echo _l('prop_pro_cgst'); ?>% </td>
                                                            <td style="width: 47px !important;"><?php echo _l('prop_pro_sgst'); ?>%</td>
                                                            <?php
                                                        } else {
                                                            $label = _l('prop_pro_igst');
                                                            ?>
                                                            <td style="width: 47px !important;"><?php echo _l('prop_pro_igst'); ?>%</td>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <td style="width: 47px !important;"><?php echo $label; ?></td>
                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_grand_total'); ?></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                if (isset($sale_prolist)) {
                                                    ?>
                                                <input type="hidden" id="totalsalepro" value="<?php echo count($sale_prolist); ?>">
                                                <?php
                                                foreach ($sale_prolist as $single_prod_sale_det) {
                                                    $prosaleprice = $single_prod_sale_det['rate'];
                                                    $prodproposalprice = $prosaleprice * $single_prod_sale_det['qty'];
                                                    //$totproamt=$prodproposalprice-(($prodproposalprice*$single_prod_sale_det['discount'])/100)+(($prodproposalprice*18)/100);
                                                    $totproamt = $prodproposalprice - (($prodproposalprice * $single_prod_sale_det['discount']) / 100);
                                                    $i++;
                                                    $saleprodet = $this->db->query("SELECT * FROM `tblproducts` WHERE `id`='" . $single_prod_sale_det['pro_id'] . "'")->row_array();
                                                    $salepricelist = array($saleprodet['sale_price_cat_a'], $saleprodet['sale_price_cat_b'], $saleprodet['sale_price_cat_c'], $saleprodet['sale_price_cat_d']);
                                                    $min_saleprice = min($salepricelist);
                                                    $min_salepricee[] = min($salepricelist);
                                                    $profitper = (($prosaleprice - $min_saleprice) / $min_saleprice) * 100;
                                                    if ($profitper >= 0 && $profitper <= 9.99) {
                                                        $color = 'red';
                                                    } else if ($profitper >= 10 && $profitper <= 14.99) {
                                                        $color = 'yellow';
                                                    } else if ($profitper >= 15 && $profitper <= 19.99) {
                                                        $color = 'blue';
                                                    } else if ($profitper >= 20 && $profitper <= 29.99) {
                                                        $color = 'green';
                                                    } else if ($profitper >= 30) {
                                                        $color = 'orange';
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <a target="_blank" href="../product/product/<?php echo $single_prod_sale_det['pro_id']; ?>">
                                                                <input class="form-control" type="text" readonly="" name="saleproposal[<?php echo $i; ?>][product_name]" style="cursor: pointer !important;" value="<?php echo $single_prod_sale_det['description']; ?>">
                                                            </a>
                                                            <input value="<?php echo $single_prod_sale_det['pro_id']; ?>" name="saleproposal[<?php echo $i; ?>][product_id]" type="hidden">
                                                            <input value="<?php echo $single_prod_sale_det['id']; ?>" name="saleproposal[<?php echo $i; ?>][itemid]" type="hidden">
                                                            <input value="<?php echo $min_saleprice; ?>" id="averagesaleprice<?php echo $i; ?>" type="hidden">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][remark]" readonly="" value="<?php echo $single_prod_sale_det['long_description']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][pro_id]" readonly="" value="PRO-ID<?php echo $single_prod_sale_det['pro_id']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][hsn_code]" readonly="" value="<?php echo $single_prod_sale_det['hsn_code']; ?>">
                                                        </td>

                                                        <td>
                                                            <input type="number" class="form-control" id="saleqty_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][qty]" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" min="1" value="<?php echo $single_prod_sale_det['qty']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="salemainprice_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="<?php echo $prosaleprice; ?>" name="saleproposal[<?php echo $i; ?>][price]" id="price1">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="saleprice_<?php echo $i; ?>" value="<?php echo $prosaleprice * $single_prod_sale_det['qty']; ?>" id="total_price1">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="saledisc_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="<?php echo $single_prod_sale_det['discount']; ?>" name="saleproposal[<?php echo $i; ?>][discount]" id="discount_percentage">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" id="saledisc_amt_<?php echo $i; ?>" class="form-control" value="<?php echo (($prodproposalprice * $single_prod_sale_det['discount']) / 100); ?>">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="saledisc_price_<?php echo $i; ?>" value="<?php echo $prodproposalprice - (($prodproposalprice * $single_prod_sale_det['discount']) / 100); ?>">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control <?php echo $color; ?>" id="saleprofit_amt<?php echo $i; ?>" value="<?php echo $profitper; ?>">
                                                        </td>
                                                        <?php
                                                        if ($proposal->is_gst == 1) {
                                                            ?>
                                                            <td>
                                                                <input type="hidden" name="saleproposal[<?php echo $i; ?>][isgst]" value="1">
                                                                <input readonly="" type="text" class="form-control" value="9">
                                                            </td>
                                                            <td>
                                                                <input readonly="" type="text" class="form-control" value="9">
                                                            </td>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <td>
                                                                <input type="hidden" name="saleproposal[<?php echo $i; ?>][isgst]" value="1">
                                                                <input readonly="" type="text" class="form-control" value="18">
                                                            </td>
                                                        <?php }
                                                        ?>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="saletax_amt_<?php echo $i; ?>" value="<?php echo (($prodproposalprice * 18) / 100); ?>" id="total_price1">
                                                        </td>
                                                        <td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale<?php echo $i; ?>">
                                                            <?php echo ($totproamt); ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                ?>
                                                <input type="hidden" id="totalsalepro" value="<?php echo count($lead_prod_sale_det); ?>">
                                                <?php
                                                foreach ($lead_prod_sale_det as $single_prod_sale_det) {
                                                    $i++;
                                                    if ($single_prod_sale_det['company_category'] == 1) {
                                                        $prosaleprice = $single_prod_sale_det['sale_price_cat_a'];
                                                    } else if ($single_prod_sale_det['company_category'] == 2) {
                                                        $prosaleprice = $single_prod_sale_det['sale_price_cat_b'];
                                                    } else if ($single_prod_sale_det['company_category'] == 3) {
                                                        $prosaleprice = $single_prod_sale_det['sale_price_cat_c'];
                                                    } else if ($single_prod_sale_det['company_category'] == 4) {
                                                        $prosaleprice = $single_prod_sale_det['sale_price_cat_d'];
                                                    }
                                                    $salepricelist = array($single_prod_sale_det['sale_price_cat_a'], $single_prod_sale_det['sale_price_cat_b'], $single_prod_sale_det['sale_price_cat_c'], $single_prod_sale_det['sale_price_cat_d']);
                                                    $min_saleprice = min($salepricelist);
                                                    $min_salepricee[] = min($salepricelist);
                                                    $profitper = (($prosaleprice - $min_saleprice) / $min_saleprice) * 100;
                                                    if ($profitper >= 0 && $profitper <= 9.99) {
                                                        $color = 'red';
                                                    } else if ($profitper >= 10 && $profitper <= 14.99) {
                                                        $color = 'yellow';
                                                    } else if ($profitper >= 15 && $profitper <= 19.99) {
                                                        $color = 'blue';
                                                    } else if ($profitper >= 20 && $profitper <= 29.99) {
                                                        $color = 'green';
                                                    } else if ($profitper >= 30) {
                                                        $color = 'orange';
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <a target="_blank" href="../product/product/<?php echo $single_prod_sale_det['id']; ?>">
                                                                <input class="form-control" type="text" readonly="" name="saleproposal[<?php echo $i; ?>][product_name]" style="cursor: pointer !important;" value="<?php echo $single_prod_sale_det['name']; ?>">
                                                            </a>
                                                            <input value="<?php echo $single_prod_sale_det['id']; ?>" name="saleproposal[<?php echo $i; ?>][product_id]" type="hidden">
                                                            <input value="<?php echo $min_saleprice; ?>" id="averagesaleprice<?php echo $i; ?>" type="hidden">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][remark]" readonly="" value="<?php echo $single_prod_sale_det['product_remarks']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][pro_id]" readonly="" value="PRO-ID<?php echo $single_prod_sale_det['id']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][hsn_code]" readonly="" value="<?php echo $single_prod_sale_det['hsn_code']; ?>">
                                                        </td>

                                                        <td>
                                                            <input type="number" class="form-control" id="saleqty_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][qty]" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" min="1" value="1">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="salemainprice_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="<?php echo $prosaleprice; ?>" name="saleproposal[<?php echo $i; ?>][price]" id="price1">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="saleprice_<?php echo $i; ?>" value="<?php echo $prosaleprice * 1; ?>" id="total_price1">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="saledisc_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="" name="saleproposal[<?php echo $i; ?>][discount]" id="discount_percentage">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" id="saledisc_amt_<?php echo $i; ?>" class="form-control" value="0.00">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="saledisc_price_<?php echo $i; ?>" value="<?php echo $prosaleprice * 1; ?>">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control <?php echo $color; ?>" id="saleprofit_amt<?php echo $i; ?>" value="<?php echo $profitper; ?>">
                                                        </td>
                                                        <?php
                                                        if ($single_prod_rent_det['state'] == get_staff_state()) {
                                                            ?>
                                                            <td>
                                                                <input type="hidden" name="saleproposal[<?php echo $i; ?>][isgst]" value="1">
                                                                <input readonly="" type="text" class="form-control" value="9">
                                                            </td>
                                                            <td>
                                                                <input readonly="" type="text" class="form-control" value="9">
                                                            </td>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <td>
                                                                <input type="hidden" name="saleproposal[<?php echo $i; ?>][isgst]" value="1">
                                                                <input readonly="" type="text" class="form-control" value="18">
                                                            </td>
                                                        <?php }
                                                        ?>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="saletax_amt_<?php echo $i; ?>" value="<?php echo (($prosaleprice * 18) / 100); ?>" id="total_price1">
                                                        </td>
                                                        <td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale<?php echo $i; ?>">
                                                            <?php echo ($prosaleprice); ?>
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
                                <div class="row" style="margin-top:2%;">
                                    <div class="col-md-3">
                                        <label class="control-label">Total Amount <span style="color:red">*</span></label>
                                        <input readonly="" type="text" class="form-control sale_total_amt" value="<?php echo (isset($proposal) && $proposal->salesubtotal != '') ? $proposal->salesubtotal : ""; ?>" name="saleproposal[finalsubtotalamount]" id="sale_total_amt">
                                        <div class="sale_total_amtError error_msg"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Total Discount (%) <span style="color:red">*</span></label>
                                        <input type="text" class="form-control sale_discount_percentage" value="<?php echo (isset($proposal) && $proposal->sale_discount_percent != '') ? $proposal->sale_discount_percent : ""; ?>" onchange="get_total_disc_sale()" name="saleproposal[finaldiscountpercentage]" id="sale_discount_percentage">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Total Discount Amt <span style="color:red">*</span></label>
                                        <input readonly="" type="text" class="form-control sale_discount_amt" value="<?php echo (isset($proposal) && $proposal->sale_discount_total != '') ? $proposal->sale_discount_total : ""; ?>" name="saleproposal[finaldiscountamount]" id="sale_discount_amt">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Total Quotation Amount (Rent) <span style="color:red">*</span></label>
                                        <input style="font-weight:bold;" readonly="" type="text" class="form-control sale_total_quotation_amt" value="<?php echo (isset($proposal) && $proposal->saletotal != '') ? $proposal->saletotal : ""; ?>" name="saleproposal[totalamount]" id="sale_total_quotation_amt">
                                    </div>
                                </div>
                                <div class="row" style="margin-top:2%;padding:8px;">
                                    <div class="col-md-12 pull-right">
                                        <label class="col-md-6 control-label text-right">Amount In Words</label>
                                        <label style="font-weight:500;font-size: 16px;text-transform: capitalize;" class="col-md-6 pull-left control-label sale_total_quotation_amt_in_words text-right"></label>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:2%;padding:8px;">
                                    <div class="col-md-12 pull-right">
                                        <label class="col-md-6 control-label text-right">Total Margin Profits</label>
                                        <div class="col-md-6" style="background:#80808057;margin:0;padding:0"><label style="margin:0;font-weight:500;font-size: 16px;text-transform: capitalize;" class="col-md-6 pull-left control-label sale_total_quotation_margin_profit text-right"></label></div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:2%;padding:8px;">
                                    <div class="col-md-12 pull-right">
                                        <label class="col-md-6 control-label text-right">Tax Amount In Words</label>
                                        <label style="font-weight:500;font-size: 16px;text-transform: capitalize;" class="col-md-6 pull-left control-label sale_total_quotation_tax_amt_in_words text-right"></label>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="table-responsive s_table" style="margin-top:3%;">

                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3"><?php echo _l('other_charges_for_sale'); ?></h4>
                                <hr/>
                            </div>
                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="mysaleTable">
                                <thead>
                                    <tr>
                                        <th width="40%" align="left"><?php echo _l('other_charges_cat_name'); ?></th>
                                        <th width="10%" class="qty" align="left"><?php echo _l('other_charges_sac_code'); ?></th>
                                        <th width="10%" align="left"><?php echo _l('amt'); ?>	</th>
                                        <?php
                                        if (isset($proposal->is_gst)) {
                                            if ($proposal->is_gst == 1) {
                                                ?>
                                                <th width="10%" align="left"><?php echo _l('other_charges_cgst'); ?>	</th>
                                                <th width="10%" align="left"><?php echo _l('other_charges_sgst'); ?>	</th>
                                                <?php
                                            } else {
                                                ?>
                                                <th width="20%" align="left"><?php echo _l('other_charges_igst'); ?>	</th>
                                                <?php
                                            }
                                        } else {
                                            if ($clientsate == get_staff_state()) {
                                                ?>
                                                <th width="10%" align="left"><?php echo _l('other_charges_cgst'); ?>	</th>
                                                <th width="10%" align="left"><?php echo _l('other_charges_sgst'); ?>	</th>
                                                <?php
                                            } else {
                                                ?>
                                                <th width="20%" align="left"><?php echo _l('other_charges_igst'); ?>	</th>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <th width="10%" align="left"><?php
                                            if ($clientsate == get_staff_state()) {
                                                echo _l('cgst_amt_sgst_amt');
                                            } else {
                                                echo _l('cgst_amt_igst_amt');
                                            }
                                            ?>	</th>
                                        <th width="15%" align="left"><?php echo _l('total_amount'); ?>	</th>
                                        <th width="5%"  align="center"><i class="fa fa-cog"></i></th>
                                    </tr>
                                </thead>
                                <tbody class="ui-sortable">
                                    <?php
                                    if (count($sale_othercharges) > 0) {
                                        $l = 0;
                                        foreach ($sale_othercharges as $singlesaleothercharges) {
                                            $l++;
                                            ?>
                                            <tr id="trsale<?php echo $l; ?>">
                                                <td>
                                                    <div class="form-group">
                                                        <select class="form-control selectpicker" data-live-search="true" id="sale_othercharges<?php echo $l; ?>" name="saleothercharges[<?php echo $l; ?>][category_name]">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($othercharges) && count($othercharges) > 0) {
                                                                foreach ($othercharges as $othercharges_key => $othercharges_value) {
                                                                    ?>
                                                                    <option value="<?php echo $othercharges_value['id'] ?>" <?php
                                                                    if (isset($singlesaleothercharges['category_name']) && $singlesaleothercharges['category_name'] != '' && $singlesaleothercharges['category_name'] == $othercharges_value['id']) {
                                                                        echo'selected=selected';
                                                                    }
                                                                    ?> ><?php echo $othercharges_value['category_name'] ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="sale_sac_code<?php echo $l; ?>" value="<?php echo $singlesaleothercharges['sac_code']; ?>" name="saleothercharges[<?php echo $l; ?>][sac_code]" class="form-control" >
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="sale_amount<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" value="<?php echo $singlesaleothercharges['amount']; ?>" name="saleothercharges[<?php echo $l; ?>][amount]" class="form-control" >
                                                    </div>
                                                </td>
                                                <?php
                                                if (isset($proposal->is_gst)) {
                                                    if ($proposal->is_gst == 1) {
                                                        ?>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="sale_gst<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" value="<?php echo $singlesaleothercharges['gst']; ?>" name="saleothercharges[<?php echo $l; ?>][gst]" class="form-control" >
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="sale_sgst<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" name="saleothercharges[<?php echo $l; ?>][sgst]" value="<?php echo $singlesaleothercharges['sgst']; ?>" class="form-control" >
                                                            </div>
                                                        </td>

                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="sale_igst<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" name="saleothercharges[<?php echo $l; ?>][igst]" value="<?php echo $singlesaleothercharges['igst']; ?>" class="form-control" >
                                                            </div>
                                                        </td>
                                                        <?php
                                                    }
                                                } else {
                                                    if ($clientsate == get_staff_state()) {
                                                        ?>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="sale_gst<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" value="<?php echo $singlesaleothercharges['gst']; ?>" name="saleothercharges[<?php echo $l; ?>][gst]" class="form-control" >
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="sale_sgst<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" name="saleothercharges[<?php echo $l; ?>][sgst]" value="<?php echo $singlesaleothercharges['sgst']; ?>" class="form-control" >
                                                            </div>
                                                        </td>

                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="sale_igst<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" name="saleothercharges[<?php echo $l; ?>][igst]" value="<?php echo $singlesaleothercharges['igst']; ?>" class="form-control" >
                                                            </div>
                                                        </td>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="sale_gst_sgst_amt<?php echo $l; ?>" name="saleothercharges[<?php echo $l; ?>][gst_sgst_amt]" value="<?php echo $singlesaleothercharges['gst_sgst_amt']; ?>" class="form-control">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="sale_total_maount<?php echo $l; ?>" name="saleothercharges[<?php echo $l; ?>][total_maount]" value="<?php echo $singlesaleothercharges['total_maount']; ?>" class="form-control">
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges('<?php echo $l; ?>');" ><i class="fa fa-remove"></i></button>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr id="trsale0">
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control selectpicker" data-live-search="true" id="sale_othercharges0" name="saleothercharges[0][category_name]">
                                                        <option value=""></option>
                                                        <?php
                                                        if (isset($othercharges) && count($othercharges) > 0) {
                                                            foreach ($othercharges as $othercharges_key => $othercharges_value) {
                                                                ?>
                                                                <option value="<?php echo $othercharges_value['id'] ?>"  ><?php echo $othercharges_value['category_name'] ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" id="sale_sac_code0" name="saleothercharges[0][sac_code]" class="form-control" >
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" id="sale_amount0" onchange="getothersalecharges(0)" name="saleothercharges[0][amount]" class="form-control" >
                                                </div>
                                            </td>
                                            <?php
                                            if ($clientsate == get_staff_state()) {
                                                ?>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="sale_gst0"  value="0" onchange="getothersalecharges(0)" name="saleothercharges[0][gst]" class="form-control" >
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="sale_sgst0" value="0" onchange="getothersalecharges(0)" name="saleothercharges[0][sgst]" class="form-control" >
                                                    </div>
                                                </td>

                                                <?php
                                            } else {
                                                ?>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="sale_igst0" onchange="getothersalecharges(0)" name="saleothercharges[0][igst]" class="form-control" >
                                                    </div>
                                                </td>
                                            <?php }
                                            ?>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" id="sale_gst_sgst_amt0" name="saleothercharges[0][gst_sgst_amt]" class="form-control">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" id="sale_total_maount0" name="saleothercharges[0][total_maount]" class="form-control">
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges('0');" ><i class="fa fa-remove"></i></button>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                            <div class="col-xs-4">
                                <label class="label-control subHeads"><a  class="addsalemore" value="<?php echo count($sale_othercharges); ?>">Add More <i class="fa fa-plus"></i></a></label>
                            </div>
                            <div class="col-xs-8">
                                <label style="float : right !important;">
                                    <strong style="font-size:14px;">Other Charges Sub Total For Sale :-</strong>
                                    <strong class="sale_other_charges_subtotal">0</strong>		
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top:4%">
                            <h4 class="no-mtop mrg3">Prodcut Fields for Quotation</h4>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <div style="overflow-x:auto !important;">
                                <div class="col-md-3">
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php echo (isset($proposalfields) && in_array('name', $proposalfields)) ? "checked=checked" : ""; ?> value="name">
                                        <label>Product Name</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php echo (isset($proposalfields) && in_array('sac_code', $proposalfields)) ? "checked=checked" : ""; ?> value="sac_code">
                                        <label>SAC Code</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php echo (isset($proposalfields) && in_array('hsn_code', $proposalfields)) ? "checked=checked" : ""; ?> value="hsn_code">
                                        <label>HSN Code</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php echo (isset($proposalfields) && in_array('working_height', $proposalfields)) ? "checked=checked" : ""; ?> value="working_height">
                                        <label>Working Height</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php echo (isset($proposalfields) && in_array('tower_height', $proposalfields)) ? "checked=checked" : ""; ?> value="tower_height">
                                        <label>Tower Height</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php echo (isset($proposalfields) && in_array('platform_height', $proposalfields)) ? "checked=checked" : ""; ?> value="platform_height">
                                        <label>Platform Height</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php echo (isset($proposalfields) && in_array('dimensions', $proposalfields)) ? "checked=checked" : ""; ?> value="dimensions">
                                        <label>Dimention</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php echo (isset($proposalfields) && in_array('purchase_price', $proposalfields)) ? "checked=checked" : ""; ?> value="purchase_price">
                                        <label>Purchase price</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php echo (isset($proposalfields) && in_array('product_weight', $proposalfields)) ? "checked=checked" : ""; ?> value="product_weight">
                                        <label>Product Weight</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php echo (isset($proposalfields) && in_array('product_remarks', $proposalfields)) ? "checked=checked" : ""; ?> value="product_remarks">
                                        <label>Product Remarks</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php echo (isset($proposalfields) && in_array('product_description', $proposalfields)) ? "checked=checked" : ""; ?> value="product_description">
                                        <label>Product Description</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php echo (isset($proposalfields) && in_array('damage_rate', $proposalfields)) ? "checked=checked" : ""; ?> value="damage_rate">
                                        <label>Damage Rate</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php echo (isset($proposalfields) && in_array('lost_rate', $proposalfields)) ? "checked=checked" : ""; ?> value="lost_rate">
                                        <label>Lost Rate</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php echo (isset($proposalfields) && in_array('repairable_rate', $proposalfields)) ? "checked=checked" : ""; ?> value="repairable_rate">
                                        <label>Repairable Rate</label>
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
<script>
    var _rel_id = $('#rel_id'),
            _rel_type = $('#rel_type'),
            _rel_id_wrapper = $('#rel_id_wrapper'),
            data = {};

    $(function () {
        init_currency_symbol();
        // Maybe items ajax search
        init_ajax_search('items', '#item_select.ajax-search', undefined, admin_url + 'items/search');
        validate_proposal_form();
        $('body').on('change', '#rel_id', function () {
            if ($(this).val() != '') {
                $.get(admin_url + 'proposals/get_relation_data_values/' + $(this).val() + '/' + _rel_type.val(), function (response) {
                    $('input[name="proposal_to"]').val(response.to);
                    $('textarea[name="address"]').val(response.address);
                    $('input[name="email"]').val(response.email);
                    $('input[name="phone"]').val(response.phone);
                    $('input[name="city"]').val(response.city);
                    $('input[name="state"]').val(response.state);
                    $('#state').val(response.state);
                    $('#city').val(response.city);
                    $('#source').val(response.source);
                    $('input[name="zip"]').val(response.zip);
                    $('select[name="country"]').selectpicker('val', response.country);
                    $('.selectpicker').selectpicker('refresh');
                    var currency_selector = $('#currency');
                    if (_rel_type.val() == 'customer') {
                        if (typeof (currency_selector.attr('multi-currency')) == 'undefined') {
                            currency_selector.attr('disabled', true);
                        }

                    } else {
                        currency_selector.attr('disabled', false);
                    }
                    var proposal_to_wrapper = $('[app-field-wrapper="proposal_to"]');
                    if (response.is_using_company == false && !empty(response.company)) {
                        proposal_to_wrapper.find('#use_company_name').remove();
                        proposal_to_wrapper.find('#use_company_help').remove();
                        proposal_to_wrapper.append('<div id="use_company_help" class="hide">' + response.company + '</div>');
                        proposal_to_wrapper.find('label')
                                .prepend("<a href=\"#\" id=\"use_company_name\" data-toggle=\"tooltip\" data-title=\"<?php echo _l('use_company_name_instead'); ?>\" onclick='document.getElementById(\"proposal_to\").value = document.getElementById(\"use_company_help\").innerHTML.trim(); this.remove();'><i class=\"fa fa-building-o\"></i></a> ");
                    } else {
                        proposal_to_wrapper.find('label #use_company_name').remove();
                        proposal_to_wrapper.find('label #use_company_help').remove();
                    }
                    /* Check if customer default currency is passed */
                    if (response.currency) {
                        currency_selector.selectpicker('val', response.currency);
                    } else {
                        /* Revert back to base currency */
                        currency_selector.selectpicker('val', currency_selector.data('base'));
                    }
                    currency_selector.selectpicker('refresh');
                    currency_selector.change();
                }, 'json');
            }
        });
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
    function get_total_price_per_qty_rent(value)
    {
        var price = $('#rentmainprice_' + value).val();
        var qty = $('#rentqty_' + value).val();

        var total_price = (price * qty);
        var disc = $('#rentdisc_' + value).val();
        $('#rentprice_' + value).val(total_price);
        var disc_amt = ((total_price * disc) / 100);
        var disc_price = (parseInt(total_price) - parseInt((total_price * disc) / 100));
        $('#rentdisc_amt_' + value).val(disc_amt);
        $('#rentdisc_price_' + value).val(disc_price);
        $('#renttax_amt_' + value).val((disc_price * 18) / 100);
        var disc_price = $('#rentdisc_price_' + value).val();
        var tax_amt = $('#renttax_amt_' + value).val();
        //var grand_total=parseInt(disc_price)+parseInt(tax_amt);
        var grand_total = parseInt(disc_price);
        $('#grand_total_' + value).text(grand_total);
        var totalamt = 0;
        $('table.renttable').find('td.totalamt').each(function () {
            totalamt = parseInt(totalamt) + parseInt($(this).text());
        });
        $('.rent_total_amt').val(totalamt);
        //$('.rent_total_quotation_amt').val(totalamt);
        var rent_total_amt = $('.rent_total_amt').val();
        var rent_discount_percentage = $('.rent_discount_percentage').val();
        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);
        var distotalamt = (parseInt(rent_total_amt) - parseInt(disamt));
        $('.rent_discount_amt').val(disamt);
        $('.rent_total_quotation_amt').val(distotalamt);
        $('.rent_total_quotation_amt_in_words').html(toWords(distotalamt));

        var i;
        var arry = [];
        var minarry = [];
        j = 0;
        var totalpro = $('#totalrentpro').attr('value');
        for (i = 0; i <= totalpro; i++) {
            arry[j++] = parseInt($('#renttax_amt_' + i).val());
            minarry[j++] = parseInt($('#averageprice' + i).val()) * parseInt($('#rentqty_' + i).val());
        }
        var totaltax = 0;
        for (var i = 0; i < arry.length; i++) {
            totaltax += arry[i] << 0;
        }

        var totalminprice = 0;
        for (var k = 0; k < minarry.length; k++) {
            totalminprice += minarry[k] << 0;
        }
        $('.rent_total_quotation_tax_amt_in_words').html(toWords(totaltax));

        var rentamt = $('#averageprice' + value).val();
        var rentamt = (rentamt * qty);
        var marginprofit = (100 * (disc_price - rentamt) / rentamt);
        var totalmarginprofit = (100 * (distotalamt - totalminprice) / totalminprice);
        //$('.rent_total_quotation_margin_profit').html(Math.round(totalmarginprofit)+'%');
        $('.rent_total_quotation_margin_profit').html(totalmarginprofit.toFixed(2) + '%');

        if (marginprofit >= 0 && marginprofit <= 9.99) {
            var color = 'red';
            $('#rentprofit_amt' + value).removeClass('yellow');
            $('#rentprofit_amt' + value).removeClass('blue');
            $('#rentprofit_amt' + value).removeClass('green');
            $('#rentprofit_amt' + value).removeClass('orange');
        } else if (marginprofit >= 10 && marginprofit <= 14.99) {
            var color = 'yellow';
            $('#rentprofit_amt' + value).removeClass('red');
            $('#rentprofit_amt' + value).removeClass('blue');
            $('#rentprofit_amt' + value).removeClass('green');
            $('#rentprofit_amt' + value).removeClass('orange');
        } else if (marginprofit >= 15 && marginprofit <= 19.99) {
            var color = 'blue';
            $('#rentprofit_amt' + value).removeClass('yellow');
            $('#rentprofit_amt' + value).removeClass('red');
            $('#rentprofit_amt' + value).removeClass('green');
            $('#rentprofit_amt' + value).removeClass('orange');
        } else if (marginprofit >= 20 && marginprofit <= 29.99) {
            var color = 'green';
            $('#rentprofit_amt' + value).removeClass('yellow');
            $('#rentprofit_amt' + value).removeClass('blue');
            $('#rentprofit_amt' + value).removeClass('red');
            $('#rentprofit_amt' + value).removeClass('orange');
        } else if (marginprofit >= 30) {
            var color = 'orange';
            $('#rentprofit_amt' + value).removeClass('yellow');
            $('#rentprofit_amt' + value).removeClass('blue');
            $('#rentprofit_amt' + value).removeClass('green');
            $('#rentprofit_amt' + value).removeClass('red');
        } else if (marginprofit <= 0) {
            var color = 'red';
            $('#rentprofit_amt' + value).removeClass('yellow');
            $('#rentprofit_amt' + value).removeClass('blue');
            $('#rentprofit_amt' + value).removeClass('green');
            $('#rentprofit_amt' + value).removeClass('orange');
        }
        
        $('#rentprofit_amt' + value).val(marginprofit);
        $('#rentprofit_amt' + value).addClass(color);
        if (totalmarginprofit >= 0 && totalmarginprofit <= 9.99) {
            var margincolor = 'red';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 10 && totalmarginprofit <= 14.99) {
            var margincolor = 'yellow';
            $('.rent_total_quotation_margin_profit').removeClass('red');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 15 && totalmarginprofit <= 19.99) {
            var margincolor = 'blue';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('red');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 20 && totalmarginprofit <= 29.99) {
            var margincolor = 'green';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('red');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 30) {
            var margincolor = 'orange';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('red');
        } else if (totalmarginprofit <= 0) {
            var margincolor = 'red';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        }
        $('.rent_total_quotation_margin_profit').addClass(margincolor);
    }
    
    function get_total_disc_rent() {
        var rent_total_amt = $('.rent_total_amt').val();
        var rent_discount_percentage = $('.rent_discount_percentage').val();
        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);
        var distotalamt = (parseInt(rent_total_amt) - parseInt(disamt));
        $('.rent_discount_amt').val(disamt);
        $('.rent_total_quotation_amt').val(distotalamt);
        $('.rent_total_quotation_amt_in_words').html(toWords(distotalamt));
    }

    function get_total_price_per_qty_sale(value) {
        var price = $('#salemainprice_' + value).val();
        var qty = $('#saleqty_' + value).val();
        var total_price = (price * qty);
        var disc = $('#saledisc_' + value).val();
        $('#saleprice_' + value).val(total_price);
        var disc_amt = ((total_price * disc) / 100);
        var disc_price = (parseInt(total_price) - parseInt((total_price * disc) / 100));
        $('#saledisc_amt_' + value).val(disc_amt);
        $('#saledisc_price_' + value).val(disc_price);
        $('#saletax_amt_' + value).val((disc_price * 18) / 100);
        //var disc_price=$('#saledisc_price_'+value).val();
        var tax_amt = $('#saletax_amt_' + value).val();
        var grand_total = parseInt(disc_price);
        $('#grand_total_sale' + value).text(grand_total);
        var totalamt = 0;
        $('table.saletable').find('td.totalsaleamt').each(function () {
            totalamt = parseInt(totalamt) + parseInt($(this).text());
        });
        $('.sale_total_amt').val(totalamt);
        //$('.sale_total_quotation_amt').val(totalamt);
        var rent_total_amt = $('.sale_total_amt').val();
        var rent_discount_percentage = $('.sale_discount_percentage').val();
        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);
        var distotalamt = (parseInt(rent_total_amt) - parseInt(disamt));
        $('.sale_discount_amt').val(disamt);
        $('.sale_total_quotation_amt').val(distotalamt);
        $('.sale_total_quotation_amt_in_words').html(toWords(distotalamt));

        var i;
        var arry = [];
        var minarry = [];
        j = 0;
        var totalpro = $('#totalsalepro').attr('value');
        for (i = 0; i <= totalpro; i++) {
            arry[j++] = parseInt($('#saletax_amt_' + i).val());
            minarry[j++] = parseInt($('#averagesaleprice' + i).val()) * parseInt($('#saleqty_' + i).val());
        }
        var totaltax = 0;
        for (var i = 0; i < arry.length; i++) {
            totaltax += arry[i] << 0;
        }

        var totalminprice = 0;
        for (var k = 0; k < minarry.length; k++) {
            totalminprice += minarry[k] << 0;
        }

        $('.sale_total_quotation_tax_amt_in_words').html(toWords(totaltax));


        var rentamt = $('#averagesaleprice' + value).val();
        var rentamt = (rentamt * qty);
        var totalmarginprofit = (100 * (distotalamt - totalminprice) / totalminprice);
        //$('.sale_total_quotation_margin_profit').html(Math.round(totalmarginprofit)+'%');
        $('.sale_total_quotation_margin_profit').html(totalmarginprofit.toFixed(2) + '%');
        var marginprofit = (100 * (disc_price - rentamt) / rentamt);
        if (marginprofit >= 0.00 && marginprofit <= 9.99)
        {
            var color = 'red';
            $('#saleprofit_amt' + value).removeClass('yellow');
            $('#saleprofit_amt' + value).removeClass('blue');
            $('#saleprofit_amt' + value).removeClass('green');
            $('#saleprofit_amt' + value).removeClass('orange');
        } else if (marginprofit >= 10 && marginprofit <= 14.99)
        {
            var color = 'yellow';
            $('#saleprofit_amt' + value).removeClass('red');
            $('#saleprofit_amt' + value).removeClass('blue');
            $('#saleprofit_amt' + value).removeClass('green');
            $('#saleprofit_amt' + value).removeClass('orange');
        } else if (marginprofit >= 15 && marginprofit <= 19.99)
        {
            var color = 'blue';
            $('#saleprofit_amt' + value).removeClass('yellow');
            $('#saleprofit_amt' + value).removeClass('red');
            $('#saleprofit_amt' + value).removeClass('green');
            $('#saleprofit_amt' + value).removeClass('orange');
        } else if (marginprofit >= 20 && marginprofit <= 29.99)
        {
            var color = 'green';
            $('#saleprofit_amt' + value).removeClass('yellow');
            $('#saleprofit_amt' + value).removeClass('blue');
            $('#saleprofit_amt' + value).removeClass('red');
            $('#saleprofit_amt' + value).removeClass('orange');
        } else if (marginprofit >= 30)
        {
            var color = 'orange';
            $('#saleprofit_amt' + value).removeClass('yellow');
            $('#saleprofit_amt' + value).removeClass('blue');
            $('#saleprofit_amt' + value).removeClass('green');
            $('#saleprofit_amt' + value).removeClass('red');
        }
        if (marginprofit <= 0)
        {
            var color = 'red';
            $('#saleprofit_amt' + value).removeClass('yellow');
            $('#saleprofit_amt' + value).removeClass('blue');
            $('#saleprofit_amt' + value).removeClass('green');
            $('#saleprofit_amt' + value).removeClass('orange');
        }
        $('#saleprofit_amt' + value).val(marginprofit);
        $('#saleprofit_amt' + value).addClass(color);


        if (totalmarginprofit >= 0 && totalmarginprofit <= 9.99)
        {
            var margincolor = 'red';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 10 && totalmarginprofit <= 14.99)
        {
            var margincolor = 'yellow';
            $('.sale_total_quotation_margin_profit').removeClass('red');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 15 && totalmarginprofit <= 19.99)
        {
            var margincolor = 'blue';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('red');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 20 && totalmarginprofit <= 29.99)
        {
            var margincolor = 'green';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('red');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 30)
        {
            var margincolor = 'orange';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('red');
        } else if (totalmarginprofit <= 0)
        {
            var margincolor = 'red';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        }
        $('.sale_total_quotation_margin_profit').addClass(margincolor);
    }
    function get_total_disc_sale()
    {
        var rent_total_amt = $('.sale_total_amt').val();
        var rent_discount_percentage = $('.sale_discount_percentage').val();
        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);
        var distotalamt = (parseInt(rent_total_amt) - parseInt(disamt));
        $('.sale_discount_amt').val(disamt);
        $('.sale_total_quotation_amt').val(distotalamt);
        $('.sale_total_quotation_amt_in_words').html(toWords(distotalamt));
    }
    $(document).ready(function () {
        var totalamt = 0;
        $('table.renttable').find('td.totalamt').each(function () {
            totalamt = parseInt(totalamt) + parseInt($(this).text());
        });
        $('.rent_total_amt').val(totalamt);
        //$('.rent_total_quotation_amt').val(totalamt);

        var rent_total_amt = $('.rent_total_amt').val();
        var rent_discount_percentage = $('.rent_discount_percentage').val();
        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);
        var distotalamt = (parseInt(rent_total_amt) - parseInt(disamt));
        $('.rent_discount_amt').val(disamt);
        $('.rent_total_quotation_amt').val(distotalamt);
        $('.rent_total_quotation_amt_in_words').html(toWords(distotalamt));
        var i;
        var arry = [];
        var minarry = [];
        j = 0;
        var totalpro = $('#totalrentpro').attr('value');
        for (i = 0; i <= totalpro; i++)
        {
            arry[j++] = parseInt($('#renttax_amt_' + i).val());
            minarry[j++] = parseInt($('#averageprice' + i).val()) * parseInt($('#rentqty_' + i).val());
        }
        var totaltax = 0;
        for (var i = 0; i < arry.length; i++)
        {
            totaltax += arry[i] << 0;
        }
        var totalminprice = 0;
        for (var k = 0; k < minarry.length; k++)
        {
            totalminprice += minarry[k] << 0;
        }
        $('.rent_total_quotation_tax_amt_in_words').html(toWords(totaltax));
        var totalmarginprofit = (100 * (distotalamt - totalminprice) / totalminprice);
        $('.rent_total_quotation_margin_profit').html(totalmarginprofit.toFixed(2) + '%');

        if (totalmarginprofit >= 0 && totalmarginprofit <= 9.99)
        {
            var margincolor = 'red';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 10 && totalmarginprofit <= 14.99)
        {
            var margincolor = 'yellow';
            $('.rent_total_quotation_margin_profit').removeClass('red');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 15 && totalmarginprofit <= 19.99)
        {
            var margincolor = 'blue';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('red');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 20 && totalmarginprofit <= 29.99)
        {
            var margincolor = 'green';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('red');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 30)
        {
            var margincolor = 'orange';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('red');
        } else if (totalmarginprofit <= 0)
        {
            var margincolor = 'red';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        }
        $('.rent_total_quotation_margin_profit').addClass(margincolor);

        var i;
        var arr = [];
        j = 0;
        var addmore = $('.addsalemore').attr('value');
        for (i = 0; i <= addmore; i++)
        {
            arr[j++] = parseInt($('#sale_total_maount' + i).val());
        }
        var total = 0;
        for (var i = 0; i < arr.length; i++)
        {
            total += arr[i] << 0;
        }
        $('.sale_other_charges_subtotal').html(total);
    });
    $(document).ready(function () {


        var totalamt = 0;
        $('table.saletable').find('td.totalsaleamt').each(function () {
            totalamt = parseInt(totalamt) + parseInt($(this).text());
        });
        $('.sale_total_amt').val(totalamt);
        var rent_total_amt = $('.sale_total_amt').val();
        var rent_discount_percentage = $('.sale_discount_percentage').val();
        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);
        var distotalamt = (parseInt(rent_total_amt) - parseInt(disamt));
        $('.sale_discount_amt').val(disamt);
        $('.sale_total_quotation_amt').val(distotalamt);
        $('.sale_total_quotation_amt_in_words').html(toWords(distotalamt));

        var i;
        var arry = [];
        var minarry = [];
        j = 0;
        var totalpro = $('#totalsalepro').attr('value');
        for (i = 0; i <= totalpro; i++)
        {
            arry[j++] = parseInt($('#saletax_amt_' + i).val());
            minarry[j++] = parseInt($('#averagesaleprice' + i).val()) * parseInt($('#saleqty_' + i).val());
        }
        var totaltax = 0;
        for (var i = 0; i < arry.length; i++)
        {
            totaltax += arry[i] << 0;
        }
        var totalminprice = 0;
        for (var k = 0; k < minarry.length; k++)
        {
            totalminprice += minarry[k] << 0;
        }

        $('.sale_total_quotation_tax_amt_in_words').html(toWords(totaltax));
        var totalmarginprofit = (100 * (distotalamt - totalminprice) / totalminprice);
        //$('.sale_total_quotation_margin_profit').html(Math.round(totalmarginprofit)+'%');
        $('.sale_total_quotation_margin_profit').html(totalmarginprofit.toFixed(2) + '%');

        if (totalmarginprofit >= 0 && totalmarginprofit <= 9.99)
        {
            var margincolor = 'red';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 10 && totalmarginprofit <= 14.99)
        {
            var margincolor = 'yellow';
            $('.sale_total_quotation_margin_profit').removeClass('red');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 15 && totalmarginprofit <= 19.99)
        {
            var margincolor = 'blue';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('red');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 20 && totalmarginprofit <= 29.99)
        {
            var margincolor = 'green';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('red');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 30)
        {
            var margincolor = 'orange';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('red');
        } else if (totalmarginprofit <= 0)
        {
            var margincolor = 'red';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        }
        $('.sale_total_quotation_margin_profit').addClass(margincolor);

        var i;
        var arr = [];
        j = 0;
        var addmore = $('.addmore').attr('value');
        for (i = 0; i <= addmore; i++)
        {
            arr[j++] = parseInt($('#total_maount' + i).val());
        }
        var total = 0;
        for (var i = 0; i < arr.length; i++)
        {
            total += arr[i] << 0;
        }
        $('.rent_other_charges_subtotal').html(total);
    });
</script>
<script type="text/javascript">
// American Numbering System
    var th = ['', 'thousand', 'million', 'billion', 'trillion'];

    var dg = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];

    var tn = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];

    var tw = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

    function toWords(s) {
        s = s.toString();
        s = s.replace(/[\, ]/g, '');
        if (s != parseFloat(s))
            return 'not a number';
        var x = s.indexOf('.');
        if (x == -1)
            x = s.length;
        if (x > 15)
            return 'too big';
        var n = s.split('');
        var str = '';
        var sk = 0;
        for (var i = 0; i < x; i++) {
            if ((x - i) % 3 == 2) {
                if (n[i] == '1') {
                    str += tn[Number(n[i + 1])] + ' ';
                    i++;
                    sk = 1;
                } else if (n[i] != 0) {
                    str += tw[n[i] - 2] + ' ';
                    sk = 1;
                }
            } else if (n[i] != 0) {
                str += dg[n[i]] + ' ';
                if ((x - i) % 3 == 0)
                    str += 'hundred ';
                sk = 1;
            }
            if ((x - i) % 3 == 1) {
                if (sk)
                    str += th[(x - i - 1) / 3] + ' ';
                sk = 0;
            }
        }
        if (x != s.length) {
            var y = s.length;
            str += 'point ';
            for (var i = x + 1; i < y; i++)
                str += dg[n[i]] + ' ';
        }
        return str.replace(/\s+/g, ' ');

    }
    $('.addmore').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
	<?php
		if (isset($proposal->is_gst))
		{
			if ($proposal->is_gst == 1){?>$('#myTable tbody').append('<tr id="tr' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="othercharges' + newaddmore + '" onchange="otherchargesdata(' + newaddmore + ')" name="othercharges[' + newaddmore + '][category_name]"><option value=""></option><?php if (isset($othercharges) && count($othercharges) > 0){foreach ($othercharges as $othercharges_key => $othercharges_value){?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php }}?></select></div></td><td><div class="form-group"><input type="text" id="sac_code' + newaddmore + '" name="othercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="amount' + newaddmore + '" onchange="getothercharges('+newaddmore+')" name="othercharges[' + newaddmore + '][amount]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="gst' + newaddmore + '" onchange="getothercharges('+newaddmore+')" name="othercharges[' + newaddmore + '][gst]" class="form-control" value="0"></div></td><td><div class="form-group"><input type="text" id="sgst' + newaddmore + '" onchange="getothercharges('+newaddmore+')" name="othercharges[' + newaddmore + '][sgst]" value="0" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="gst_sgst_amt' + newaddmore + '" name="othercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="text" id="total_maount' + newaddmore + '" name="othercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php } else { ?>$('#myTable tbody').append('<tr id="tr' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="othercharges' + newaddmore + '" onchange="otherchargesdata(' + newaddmore + ')" name="othercharges[' + newaddmore + '][category_name]"><option value=""></option><?php if (isset($othercharges) && count($othercharges) > 0){ foreach ($othercharges as $othercharges_key => $othercharges_value){?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php }}?></select></div></td><td><div class="form-group"><input type="text" id="sac_code' + newaddmore + '" name="othercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="text" onchange="getothercharges('+newaddmore+')" id="amount' + newaddmore + '" name="othercharges[' + newaddmore + '][amount]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="igst' + newaddmore + '" value="0" onchange="getothercharges('+newaddmore+')" name="othercharges[' + newaddmore + '][igst]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="gst_sgst_amt' + newaddmore + '" name="othercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="text" id="total_maount' + newaddmore + '" name="othercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php }
		}
		else 
		{
			if ($clientsate == get_staff_state()) {?>$('#myTable tbody').append('<tr id="tr' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="othercharges' + newaddmore + '" onchange="otherchargesdata(' + newaddmore + ')" name="othercharges[' + newaddmore + '][category_name]"><option value=""></option><?php  if (isset($othercharges) && count($othercharges) > 0) {foreach ($othercharges as $othercharges_key => $othercharges_value) {?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php }}?></select></div></td><td><div class="form-group"><input type="text" id="sac_code' + newaddmore + '" name="othercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="amount' + newaddmore + '" name="othercharges[' + newaddmore + '][amount]" onchange="getothercharges('+newaddmore+')" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="gst' + newaddmore + '" value="0" name="othercharges[' + newaddmore + '][gst]" onchange="getothercharges('+newaddmore+')" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sgst' + newaddmore + '" value="0" onchange="getothercharges('+newaddmore+')" name="othercharges[' + newaddmore + '][sgst]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="gst_sgst_amt' + newaddmore + '" name="othercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="text" id="total_maount' + newaddmore + '" name="othercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php } ?><?php if ($clientsate != get_staff_state()) { ?>$('#myTable tbody').append('<tr id="tr' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="othercharges' + newaddmore + '" onchange="otherchargesdata(' + newaddmore + ')" name="othercharges[' + newaddmore + '][category_name]"><option value=""></option><?php if (isset($othercharges) && count($othercharges) > 0) { foreach ($othercharges as $othercharges_key => $othercharges_value) { ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php }}?></select></div></td><td><div class="form-group"><input type="text" id="sac_code' + newaddmore + '" name="othercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="amount' + newaddmore + '" name="othercharges[' + newaddmore + '][amount]" onchange="getothercharges('+newaddmore+')" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="igst' + newaddmore + '" onchange="getothercharges('+newaddmore+')" name="othercharges[' + newaddmore + '][igst]" class="form-control" value="0"></div></td><td><div class="form-group"><input type="text" id="gst_sgst_amt' + newaddmore + '" name="othercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="text" id="total_maount' + newaddmore + '" name="othercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php }
		}?>
		$('.selectpicker').selectpicker('refresh');
    });

    $('.addsalemore').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
	<?php
		if (isset($proposal->is_gst)) 
		{
			if ($proposal->is_gst == 1) {?> $('#mysaleTable tbody').append('<tr id="trsale' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="sale_othercharges' + newaddmore + '" name="saleothercharges[' + newaddmore + '][category_name]"><option value=""></option><?php if (isset($othercharges) && count($othercharges) > 0) {  foreach ($othercharges as $othercharges_key => $othercharges_value) {?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php } }?></select></div></td><td><div class="form-group"><input type="text" id="sale_sac_code' + newaddmore + '" name="saleothercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_amount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][amount]" onchange="getothersalecharges('+newaddmore+')"  class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_gst' + newaddmore + '" onchange="getothersalecharges('+newaddmore+')" name="saleothercharges[' + newaddmore + '][gst]" value="0" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_sgst' + newaddmore + '" onchange="getothersalecharges('+newaddmore+')" name="saleothercharges[' + newaddmore + '][sgst]" value="0" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_gst_sgst_amt' + newaddmore + '" name="saleothercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="text" id="sale_total_maount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php } else { ?>  $('#mysaleTable tbody').append('<tr id="trsale' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="sale_othercharges' + newaddmore + '" name="saleothercharges[' + newaddmore + '][category_name]"><option value=""></option><?php if (isset($othercharges) && count($othercharges) > 0) { foreach ($othercharges as $othercharges_key => $othercharges_value) { ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php } }?></select></div></td><td><div class="form-group"><input type="text" id="sale_sac_code' + newaddmore + '" name="saleothercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_amount' + newaddmore + '" onchange="getothersalecharges('+newaddmore+')" name="saleothercharges[' + newaddmore + '][amount]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_igst' + newaddmore + '" value="0" onchange="getothersalecharges('+newaddmore+')" name="saleothercharges[' + newaddmore + '][igst]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_gst_sgst_amt' + newaddmore + '" value="0" name="saleothercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="text" id="sale_total_maount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php }
		} 
		else 
		{
			if ($clientsate == get_staff_state()) {?> $('#mysaleTable tbody').append('<tr id="trsale' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="sale_othercharges' + newaddmore + '"  name="saleothercharges[' + newaddmore + '][category_name]"><option value=""></option><?php if (isset($othercharges) && count($othercharges) > 0) {foreach ($othercharges as $othercharges_key => $othercharges_value) {?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php } }?></select></div></td><td><div class="form-group"><input type="text" id="sale_sac_code' + newaddmore + '" name="saleothercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_amount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][amount]" class="form-control" onchange="getothersalecharges('+newaddmore+')" ></div></td><td><div class="form-group"><input type="text" id="sale_gst' + newaddmore + '" value="0" onchange="getothersalecharges('+newaddmore+')" name="saleothercharges[' + newaddmore + '][gst]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_sgst' + newaddmore + '" onchange="getothersalecharges('+newaddmore+')" name="saleothercharges[' + newaddmore + '][sgst]" value="0" class="form-control"></div></td><td><div class="form-group"><input type="text" id="sale_gst_sgst_amt' + newaddmore + '" name="saleothercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="text" id="sale_total_maount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php } ?><?php if ($clientsate != get_staff_state()) { ?> $('#mysaleTable tbody').append('<tr id="trsale' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="sale_othercharges' + newaddmore + '" name="saleothercharges[' + newaddmore + '][category_name]"><option value=""></option><?php if (isset($othercharges) && count($othercharges) > 0) { foreach ($othercharges as $othercharges_key => $othercharges_value) {?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php } }?></select></div></td><td><div class="form-group"><input type="text" id="sale_sac_code' + newaddmore + '" name="saleothercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="text" onchange="getothersalecharges('+newaddmore+')" id="sale_amount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][amount]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_igst' + newaddmore + '" onchange="getothersalecharges('+newaddmore+')" name="saleothercharges[' + newaddmore + '][igst]" value="0" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_gst_sgst_amt' + newaddmore + '" name="saleothercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="text" id="sale_total_maount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php  }
		}?>
		$('.selectpicker').selectpicker('refresh');
    });
    function removeothercharges(othercharg) {
        $('#tr' + othercharg).remove();
        var i;
        var arr = [];
        j = 0;
        var addmore = $('.addmore').attr('value');
        for (i = 0; i <= addmore; i++) {
            arr[j++] = parseInt($('#total_maount' + i).val());
        }
        var total = 0;
        for (var i = 0; i < arr.length; i++) {
            total += arr[i] << 0;
        }
        $('.rent_other_charges_subtotal').html(total);
    }

    function removesaleothercharges(othercharg) {
        $('#trsale' + othercharg).remove();
        var i;
        var arr = [];
        j = 0;
        var addmore = $('.addsalemore').attr('value');
        for (i = 0; i <= addmore; i++) {
            arr[j++] = parseInt($('#sale_total_maount' + i).val());
        }
        var total = 0;
        for (var i = 0; i < arr.length; i++) {
            total += arr[i] << 0;
        }
        $('.sale_other_charges_subtotal').html(total);
    }
	function get_rel_list(value)
	{
		var rel_type=value;
		var url = '<?php echo base_url(); ?>admin/Proposals/get_rel_list';
		var html = '<option value=""></option>';
		$.post(url,
				{
					rel_type: rel_type,
				},
				function (data, status) 
				{
					if(data != "")
					{
						var resArr = $.parseJSON(data);
						if(rel_type=='proposal')
						{
							$.each(resArr, function(k, v) {
								html+= '<option value="'+v.id+'">'+v.leadno+'</option>';
							});
							$('.rel_id_label').text('Lead');
						}
						if(rel_type=='customer')
						{
							$.each(resArr, function(k, v) {
								html+= '<option value="'+v.userid+'">'+v.client_branch_name+' - '+v.email_id+'</option>';
							});
							$('.rel_id_label').text('Customer');
						}
					}
					$("#rel_id").val('');
					$("#rel_id").html('').html(html);
					<?php if((isset($proposal) && $proposal->rel_type == 'proposal') || $this->input->get('rel_type')){?> $("#rel_id").val('<?php echo $proposal->rel_id;?>');<?php }?>
					<?php if ((isset($proposal) && $proposal->rel_type == 'customer') || $this->input->get('rel_type')){?> $("#rel_id").val('<?php echo $proposal->rel_id;?>');<?php }?>
					<?php if(isset($_GET['rel_id'])){?> $("#rel_id").val('<?php echo $_GET['rel_id'];?>');<?php }?>
					$('.selectpicker').selectpicker('refresh');
				});
	}
	 $(function () {
		 <?php if(isset($_GET['rel_id'])){?>
		 var rel_id= '<?php echo $_GET['rel_id'];?>';
		 get_rel_list('proposal');
		 
		 $.get(admin_url + 'proposals/get_relation_data_values/' + rel_id + '/proposal', function (response) {
                    $('input[name="proposal_to"]').val(response.to);
                    $('textarea[name="address"]').val(response.address);
                    $('input[name="email"]').val(response.email);
                    $('input[name="phone"]').val(response.phone);
                    $('input[name="city"]').val(response.city);
                    $('input[name="state"]').val(response.state);
                    $('#state').val(response.state);
                    $('#city').val(response.city);
                    $('#source').val(response.source);
                    $('input[name="zip"]').val(response.zip);
                    $('select[name="country"]').selectpicker('val', response.country);
                    $('.selectpicker').selectpicker('refresh');
                    var currency_selector = $('#currency');
                    if (_rel_type.val() == 'customer') {
                        if (typeof (currency_selector.attr('multi-currency')) == 'undefined') {
                            currency_selector.attr('disabled', true);
                        }

                    } else {
                        currency_selector.attr('disabled', false);
                    }
                    var proposal_to_wrapper = $('[app-field-wrapper="proposal_to"]');
                    if (response.is_using_company == false && !empty(response.company)) {
                        proposal_to_wrapper.find('#use_company_name').remove();
                        proposal_to_wrapper.find('#use_company_help').remove();
                        proposal_to_wrapper.append('<div id="use_company_help" class="hide">' + response.company + '</div>');
                        proposal_to_wrapper.find('label')
                                .prepend("<a href=\"#\" id=\"use_company_name\" data-toggle=\"tooltip\" data-title=\"<?php echo _l('use_company_name_instead'); ?>\" onclick='document.getElementById(\"proposal_to\").value = document.getElementById(\"use_company_help\").innerHTML.trim(); this.remove();'><i class=\"fa fa-building-o\"></i></a> ");
                    } else {
                        proposal_to_wrapper.find('label #use_company_name').remove();
                        proposal_to_wrapper.find('label #use_company_help').remove();
                    }
                    /* Check if customer default currency is passed */
                    if (response.currency) {
                        currency_selector.selectpicker('val', response.currency);
                    } else {
                        /* Revert back to base currency */
                        currency_selector.selectpicker('val', currency_selector.data('base'));
                    }
                    currency_selector.selectpicker('refresh');
                    currency_selector.change();
                }, 'json');
		 
		 
		 
		 <?php }
		 if ((isset($proposal) && $proposal->rel_type == 'customer') || $this->input->get('rel_type')) {
		 ?>
		  get_rel_list('customer');
		 <?php }
		 if ((isset($proposal) && $proposal->rel_type == 'proposal') || $this->input->get('rel_type')) {
		 ?>
		  get_rel_list('proposal');
		 <?php }?>
	 });
	 
	 function getothercharges(value)
	 {
		var amount=$('#amount'+value).val(); 
		var igst=$('#igst'+value).val(); 
		//alert(igst);
		if (typeof igst === "undefined"){ var gst=$('#gst'+value).val(); var sgst=$('#sgst'+value).val(); var igst=parseInt(gst)+parseInt(sgst); }
		var totalgstamt=parseInt((igst*amount)/100);
		var totalamt=parseInt(amount)+parseInt(totalgstamt);
		$('#gst_sgst_amt'+value).val(totalgstamt); 
		$('#total_maount'+value).val(totalamt); 
		var i;
		var arr = [];
		j = 0;
		var addmore = $('.addmore').attr('value');
		for (i = 0; i <= addmore; i++)
		{
			arr[j++] = parseInt($('#total_maount' + i).val());
		}
		var total = 0;
		for (var i = 0; i < arr.length; i++)
		{
			total += arr[i] << 0;
		}
		$('.rent_other_charges_subtotal').html(total);
	 }
	 
	 function getothersalecharges(value)
	 {
		var sale_amount=$('#sale_amount'+value).val(); 
		var igst=$('#sale_igst'+value).val(); 
		//alert(igst);
		if (typeof igst === "undefined"){ var gst=$('#sale_gst'+value).val(); var sgst=$('#sale_sgst'+value).val(); var igst=parseInt(gst)+parseInt(sgst); }
		var totalgstamt=parseInt((igst*sale_amount)/100);
		var totalamt=parseInt(sale_amount)+parseInt(totalgstamt);
		$('#sale_gst_sgst_amt'+value).val(totalgstamt); 
		$('#sale_total_maount'+value).val(totalamt); 
		var i;
		var arr = [];
		j = 0;
		var addmore = $('.addsalemore').attr('value');
		for (i = 0; i <= addmore; i++) {
			arr[j++] = parseInt($('#sale_total_maount' + i).val());
		}
		var total = 0;
		for (var i = 0; i < arr.length; i++) {
			total += arr[i] << 0;
		}
		$('.sale_other_charges_subtotal').html(total);
	 }
</script>

</body>
</html>
