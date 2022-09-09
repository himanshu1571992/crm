<div class="panel-body mtop10">
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
                                                    <td style="width: 10px !important;"><i class="fa fa-cog"></i></td>
                                                    <td style="width: 200px !important;"><?php echo _l('prop_pro_name'); ?></td>
                                                    <td style="width: 100px !important;"><?php echo _l('prop_pro_remark'); ?></td>
                                                    <td style="width: 70px !important;"><?php echo _l('prop_pro_id'); ?></td>
                                                    <td style="width: 35px !important;"><?php echo _l('prop_pro_hsn_code'); ?></td>
                                                    <td style="width: 35px  !important;"><?php echo _l('prop_pro_qty'); ?></td>
                                                    <td style="width: 35px  !important;"><?php echo _l('prop_pro_months'); ?></td>
                                                    <td style="width: 35px  !important;"><?php echo _l('prop_pro_days'); ?></td>
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
													 $totprod=count($rent_prolist);?>												  
                                                <input type="hidden" id="totalrentpro" value="<?php echo count($rent_prolist); ?>">
												<input type="hidden" id="rent_company_category" value="1">
                                                <?php
                                                foreach ($rent_prolist as $single_prod_rent_det) {
                                                    $i++;
                                                    $proprice = $single_prod_rent_det['rate'];
													$months=$single_prod_rent_det['months']+($single_prod_rent_det['days']/30);
                                                    $prodprice = $proprice * $single_prod_rent_det['qty']*$months;
                                                    $totpro = $prodprice - (($prodprice * $single_prod_rent_det['discount']) / 100);
                                                    $prodet = $this->db->query("SELECT * FROM `tblproducts` WHERE `id`='" . $single_prod_rent_det['pro_id'] . "'")->row_array();
                                                    $pricelist = array($prodet['rental_price_cat_a'], $prodet['rental_price_cat_b'], $prodet['rental_price_cat_c'], $prodet['rental_price_cat_d']);
                                                    $min_price = min($pricelist);
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
                                                    <tr class="trrentpro<?php echo $i; ?>">
														<td>
															<button type="button" class="btn pull-right btn-danger" onclick="removerentpro('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button>
														</td>
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
                                                            <input type="number" class="form-control" id="rentqty_<?php echo $i; ?>" name="rentproposal[<?php echo $i; ?>][qty]" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" min="0" value="<?php echo $single_prod_rent_det['qty']; ?>">
                                                        </td>
														<td>
                                                            <input type="text" class="form-control" id="rentmonths_<?php echo $i; ?>" name="rentproposal[<?php echo $i; ?>][months]" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" min="1" value="<?php echo $single_prod_rent_det['months']; ?>">
                                                        </td>
														<td>
                                                            <input type="number" class="form-control" id="rentdays_<?php echo $i; ?>" name="rentproposal[<?php echo $i; ?>][days]" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" min="0" value="<?php echo $single_prod_rent_det['days']; ?>">
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
                                            } else {$totprod=count($lead_prod_rent_det);
                                                ?>
                                                <input type="hidden" id="totalrentpro" value="<?php echo count($lead_prod_rent_det); ?>">
                                                <input type="hidden" id="rent_company_category" value="<?php echo $lead_prod_rent_det[0]['company_category']; ?>">
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
                                                    <tr class="trrentpro<?php echo $i; ?>">
														<td>
															<button type="button" class="btn pull-right btn-danger" onclick="removerentpro('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button>
														</td>
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
                                                            <input type="text" class="form-control" id="rentmonths_<?php echo $i; ?>" name="rentproposal[<?php echo $i; ?>][months]" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" min="1" value="1">
                                                        </td>
														<td>
                                                            <input type="number" class="form-control" id="rentdays_<?php echo $i; ?>" name="rentproposal[<?php echo $i; ?>][days]" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" min="0" value="0">
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
										<div class="col-xs-12">
											<label class="label-control subHeads"><a class="addmorerentpro" value="<?php echo $totprod;?>">Add More <i class="fa fa-plus"></i></a></label>
										</div>
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
                                        <div class="col-md-6" style="background:#80808057;margin:0;padding:0"><label style="margin:0;font-weight:500;font-size: 16px;text-transform: capitalize;padding:0;" class="col-md-6 pull-left control-label rent_total_quotation_margin_profit text-right"></label></div>
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
                                    } else {?>
                                        <tr id="tr0">
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control selectpicker" data-live-search="true" id="othercharges0" onchange="otherchargesdata(0)" name="othercharges[0][category_name]">
                                                        <option value=""></option>
                                                        <?php
                                                        if (isset($othercharges) && count($othercharges) > 0) {
                                                            foreach ($othercharges as $othercharges_key => $othercharges_value) {?>
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
                                            if ($clientsate == get_staff_state()) {?>
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
                                            } else {?>
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
													<td style="width: 10px !important;"><i class="fa fa-cog"></i></td>
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
													$totsaleprod=count($sale_prolist);
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
                                                    }?>
                                                    <tr class="trsalepro<?php echo $i; ?>">
														<td>
															<button type="button" class="btn pull-right btn-danger" onclick="removesalepro('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button>
														</td>
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
                                                                <input type="hidden" name="saleproposal[<?php echo $i; ?>][isgst]" value="0">
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
                                                $totsaleprod=count($lead_prod_sale_det);?>
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
                                                    <tr class="trsalepro<?php echo $i; ?>">
														<td>
															<button type="button" class="btn pull-right btn-danger" onclick="removesalepro('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button>
														</td>
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
                                                                <input type="hidden" name="saleproposal[<?php echo $i; ?>][isgst]" value="0">
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
										<div class="col-xs-12">
											<label class="label-control subHeads"><a class="addmoresalepro" value="<?php echo $totsaleprod;?>">Add More <i class="fa fa-plus"></i></a></label>
										</div>
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
                                        <div class="col-md-6" style="background:#80808057;margin:0;padding:0"><label style="margin:0;font-weight:500;font-size: 16px;text-transform: capitalize;padding:0;" class="col-md-6 pull-left control-label sale_total_quotation_margin_profit text-right"></label></div>
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
                                        }?>
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
                                                                    }?>
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
                                                    if ($proposal->is_gst == 1) {?>
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
                                                    } else {?>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="sale_igst<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" name="saleothercharges[<?php echo $l; ?>][igst]" value="<?php echo $singlesaleothercharges['igst']; ?>" class="form-control" >
                                                            </div>
                                                        </td>
												<?php
                                                    }
                                                } else {
                                                    if ($clientsate == get_staff_state()) {?>
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
                                                    } else {?>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="sale_igst<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" name="saleothercharges[<?php echo $l; ?>][igst]" value="<?php echo $singlesaleothercharges['igst']; ?>" class="form-control" >
                                                            </div>
                                                        </td>
											<?php
                                                    }
                                                }?>
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
                                    } else {?>
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
                                                        }?>
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
                                            if ($clientsate == get_staff_state()) {?>
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
                                            } else {?>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="sale_igst0" onchange="getothersalecharges(0)" name="saleothercharges[0][igst]" class="form-control" >
                                                    </div>
                                                </td>
                                            <?php } ?>
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
                                    <?php } ?>
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
   </div>
</div>
