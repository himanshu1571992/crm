<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'inspection_form', 'name'=>'inspectionfrm', 'class' => 'proposal-form', 'onsubmit'=>"return checkform()")); ?>
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <h4 class="no-margin"><?php echo $title; ?></h4>
                            <hr class="hr-panel-heading">
                            <div>
                                <div class="row">
                                    <div class="col-md-12">    
                                        <div class="col-md-3">  
                                            <label for="requested_id" class="control-label"><u class="text-danger">Proposal Number : </u></label>
                                            <div class="form-group">
                                                <?php echo format_proposal_number($request_info->id);?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                        <div class="table-responsive">  
                                            <div class="col-md-12">
                                                <table class="table ui-table" >
                                                    <thead>
                                                        <tr>
                                                            <th style="width:5%">S.No.</th>
                                                            <th style="width:25%">Product Name</th>
                                                            <th>Remark</th>
                                                            <th>Unit</th>
                                                            <th>Hsn Code/<br>SAC Code</th>
                                                            <th>Weight</th>
                                                            <th>Qty</th>
                                                            <th>Months</th>
                                                            <th>Days</th>
                                                            <th>Rate</th>
                                                            <th>Price</th>
                                                            <th>Discount %</th>
                                                            <th>Discount</th>
                                                            <th>Discount Amt</th>
                                                            <th>Tax</th>
                                                            <th>Tax Amt</th>
                                                            <th>Total Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $grand_ttl = $ttl_weight = 0;
                                                            if(!empty($items_list)){
                                                                $i = 1;
                                                                foreach ($items_list as $k2 => $r2) {
                                                                $weight = '--';
                                                                // $product_info = $this->db->query("SELECT `unit_id`,`size`,`unit_1`,`conversion_1`,`unit_2`,`conversion_2` FROM tblproducts WHERE `id` = '".$r2->pro_id."' ")->row();
                                                                // if (!empty($product_info)){
                                                                //     $unit = value_by_id('tblunitmaster',$product_info->unit_id,'name');
                                                                //     if (empty($unit) && $unit != '--'){
                                                                //         $unit = value_by_id('tblunitmaster',$product_info->unit_1,'name');
                                                                //         if(empty($unit) && $unit != '--'){
                                                                //             $unit = value_by_id('tblunitmaster',$product_info->unit_2,'name');
                                                                //         }
                                                                //     }
                                                                // }
                                                                $months= $r2->months+($r2->days/30);
                                                                $prodprice = $r2->rate * $r2->qty*$months*$r2->weight;
                                                                $rnt_dis_price = $prodprice - (($prodprice * $r2->discount) / 100);

                                                                $totpro = ((($rnt_dis_price * $r2->prodtax) / 100) + $rnt_dis_price);
                                                                $grand_ttl += round($totpro);
                                                        ?>
                                                                    <tr>
                                                                        <td><?php echo $i++; ?></td>
                                                                        <td><?php echo value_by_id("tblproducts", $r2->pro_id, "name"); ?></td>
                                                                        <td><?php echo (!empty($value->long_description)) ? $value->long_description : 'N/a'; ?></td>
                                                                        <td><?php echo get_product_unit($r2->pro_id, $r2->temp_product); ?></td>
                                                                        <td><?php echo (!empty($value->hsn_code)) ? $value->hsn_code :'--'; ?></td>
                                                                        <td><?php echo $r2->weight; ?></td>
                                                                        <td><?php echo $r2->qty; ?></td>
                                                                        <td><?php echo $r2->months; ?></td>
                                                                        <td><?php echo $r2->days; ?></td>
                                                                        <td><?php echo $r2->rate; ?></td>
                                                                        <td><?php echo $prodprice; ?></td>
                                                                        <td><?php echo $r2->discount; ?></td>
                                                                        <td><?php echo (($prodprice * $r2->discount) / 100); ?></td>
                                                                        <td><?php echo $rnt_dis_price; ?></td>
                                                                        <td><?php echo $r2->prodtax; ?></td>
                                                                        <td><?php echo (($rnt_dis_price * $r2->prodtax) / 100); ?></td>
                                                                        <td><?php echo number_format(round($totpro), 2, '.', ','); ?></td>
                                                                    </tr>
                                                                <?php
                                                                }
                                                            }
                                                        ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr style="background-color: #e5e7eb;">
                                                            <td class="text-center" colspan="16"><h4>GRAND TOTAL</h4></td>
                                                            <td><h4><?php echo number_format($grand_ttl, 2, '.', ','); ?></h4></td>
                                                        </tr>    
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>        
                                        <div class="col-md-12">
                                            <h4>Terms & Conditions</h4>
                                            <hr>
                                            <?php echo getAllTermsConditions($request_info->id, "proposal"); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">  
                                    <div class="form-group">
                                        <label for="remark" class="control-label">Approval Remark</label>
                                        <textarea name="approval_remark" class="form-control" id="approval_remark" cols="20" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                <br>
                                    <div class="btn-bottom-toolbar text-right">
                                        <input type="hidden" name="proposal_id" value="<?php echo $request_info->id; ?>">
                                        <button class="btn btn-warning" name="action" style="background-color: #e8bb0b;" value="5" type="submit">On Hold</button>
                                        <button class="btn btn-danger" name="action" style="background-color: #800000;" value="4" type="submit">Recalculation</button>
                                        <button class="btn btn-danger" name="action" value="2" type="submit">Reject</button>
                                        <button class="btn btn-success" name="action" value="1" type="submit">Approve</button>
                                        <!-- <a href="javascript:void(0);" class="btn btn-info submit-btn" >Save</a> -->
                                    </div> 
                                </div>                            
                            </div>                            
                        </div>
                    </div>  
                </div>        
            <?php echo form_close(); ?>
        <div class="btn-bottom-pusher"></div>
        </div>
    </div>
</div>

<?php init_tail(); ?>
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

</script>


</body>
</html>

