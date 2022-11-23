
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
@media (max-width: 500px){
    .btn-bottom-toolbar {
        width: 100%
    }
}    
@media (max-width: 768px){
    .btn-bottom-toolbar {
        width: 100%
    }
}     
</style>

<div id="wrapper">
    <div class="content accounting-template">

  <form action="<?php echo site_url($this->uri->uri_string());?>" id="product-form" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
	<div class="panel_s">
		<div class="panel-body">
      <div class="row">
          <h3 class="text-center">Add Transport Charges</h3>
          
            <!-- <div class="col-md-4">
          <button type="submit" style="margin-top: 24px;" class="btn btn-info">Send for approval</button>
        </div> -->
        <hr>
      </div>
      <?php 
          if ($request_info->ref_type == 'proposals'){
            $to_info = get_proposal_to_array($request_info->ref_id);
            echo "<h4 style='text-align:center;color:red;'><u>".cc($to_info["name"])."</u></h4>";
          }else if ($request_info->ref_type == 'estimates'){
            $to_info = get_estimate_to_array($request_info->ref_id);
            echo "<h4 style='text-align: center;color:red;'><u>".cc($to_info["name"])."</u></h4>";
          }
          
      ?>
      <div class="col-md-4">
        <h5 style="font-size:15px;color:red;"><u>Sender Remark :</u></h5>
        <span><?php echo cc($request_info->sender_remark); ?></span>
      </div>
      <div class="col-md-4">
        <h5 style="font-size:15px;color:red;"><u>Request Send By :</u></h5>
        <span><?php echo ($request_info->added_by > 0) ? get_employee_fullname($request_info->added_by) : '--'; ?></span>
      </div>
    <?php
      
      if ($request_info->ref_type == 'proposals'){
          $number = format_proposal_number($request_info->ref_id);
          // $to_info = get_proposal_to_array($request_info->ref_id);
          // $to_data = '';
          // if(empty($to_info['address']) && !empty($to_info['state'])){
          //   $to_data .= $to_info['state'];
          // }else{
          //   $to_data .= $to_info['address'].', '.$to_info['state'];
          // }
          // if(!empty($to_info['city'])){
          //   $to_data = $to_data.', '.$to_info['city'];
          // }
          $lead_id = value_by_id('tblproposals', $request_info->ref_id, 'rel_id');
          $billing_branch_id = value_by_id('tblproposals', $request_info->ref_id, 'billing_branch_id');
          $billing_branch = get_branch_details($billing_branch_id);;
          $lead_info = $this->db->query("SELECT * FROM `tblleads` where id = '".$lead_id."' ")->row();

          $site_id = (!empty($lead_info)) ? $lead_info->site_id : 0;
          $site_city_id = (!empty($lead_info)) ? $lead_info->site_city_id : 0;
          $site_state_id = (!empty($lead_info)) ? $lead_info->site_state_id : 0;
            
          
          $shipto_info = get_ship_to_array($site_id);
          echo '<div class="col-md-4">
                  <h5 style="font-size:15px;color:red;"><u>Quotation Number :</u></h5>
                  <span>'.$number.'</span>
                </div>
                <div class="col-md-4">
                    <h5 style="font-size:15px;color:red;"><u>From Location :</u></h5>
                    <span>'.$billing_branch['address'].'</span>
                </div>';
          if($site_id > 0){
            $shiptoaddress = "";
            if (!empty($shipto_info['address'])){
              $shiptoaddress .= $shipto_info['address'];
            }
            if (!empty($shipto_info['city'])){
              if ($shiptoaddress != ''){
                $shiptoaddress .= ','.$shipto_info['city'];
              }else{
                $shiptoaddress .= $shipto_info['city'];
              }
            }
            if (!empty($shipto_info['state'])){
              if ($shiptoaddress != ''){
                $shiptoaddress .= ','.$shipto_info['state'];
              }else{
                $shiptoaddress .= $shipto_info['state'];
              }
            }
            if (!empty($shipto_info['zip'])){
              $shiptoaddress .= '<p><b>Zip :</b> '.$shipto_info['zip'].'</p>';
            }
            echo '<div class="col-md-4">
                    <h5 style="font-size:15px;color:red;"><u>To Location: </u></h5>
                    <p>'.$shiptoaddress.'</p>
                  </div>';
          }else{
            $shiptoaddress = '';
            $separator = 0;
            if(!empty($lead_info->site_address)){
              
              $shiptoaddress .= $lead_info->site_address;
              $separator = 1;
            }

            if($site_city_id > 0){
              $city = value_by_id('tblcities',$lead_info->site_city_id,'name');
              $shiptoaddress .= ($separator > 0) ? ', '.$city : $city;
              $separator = 1;
            }

            if($site_state_id > 0){
              $state = value_by_id('tblstates',$lead_info->site_state_id,'name');
              $shiptoaddress .= ($separator > 0) ? ', '.$state : $state;
              $separator = 1;
            }
            
            echo '<div class="col-md-4">
                    <h5 style="font-size:15px;color:red;"><u>Ship To: </u></h5>';
                    if(!empty($lead_info->site_location)){
                      echo '<h3>'.$lead_info->site_location.'</h3>';
                    }
                    if(!empty($shiptoaddress)){
                      echo '<p>'.$shiptoaddress.'</p>';
                    }
                    if(!empty($lead_info->site_pincode)){
                      echo '<p><b>Zip :</b> '.$lead_info->site_pincode.'</p>';
                    }
            echo '</div>';
          }      
          $items_list = $this->db->query("SELECT * FROM `tblitems_in` WHERE `rel_id`= '".$request_info->ref_id."' AND `rel_type`='proposal'")->result();      
      }else if ($request_info->ref_type == 'estimates'){
          $number = format_estimate_number($request_info->ref_id);
          // $to_info = get_estimate_to_array($request_info->ref_id);
          $site_id = value_by_id('tblestimates',$request_info->ref_id,'site_id');
          $billing_branch_id = value_by_id('tblestimates', $request_info->ref_id, 'billing_branch_id');
          $billing_branch = get_branch_info($billing_branch_id);

          $shipto_info = get_ship_to_array($site_id);
          echo '<div class="col-md-4">
                  <h5 style="font-size:15px;color:red;"><u>Proforma Invoice :</u></h5>
                  <span>'.$number.'</span>
                </div>
                <div class="col-md-4">
                    <h5 style="font-size:15px;color:red;"><u>From Location :</u></h5>
                    <span>'.$billing_branch["city"].', '.$billing_branch["state"].'</span>
                </div>
                <div class="col-md-4">
                  <h5 style="font-size:15px;color:red;"><u>To Location: </u></h5>
                  <p>'.$shipto_info['city'].', '.$shipto_info['state'].'</p>
                </div>';
          $items_list = $this->db->query("SELECT * FROM `tblitems_in` WHERE `rel_id`= '".$request_info->ref_id."' AND `rel_type`='estimate'")->result();      
      }
      if (isset($items_list) && !empty($items_list)){
      ?>
          <div class="col-md-12">
                  <table class="table ui-table" >
                    <thead>
                        <tr>
                            <th style="width:5%">S.No.</th>
                            <th style="width:25%">Product Name</th>
                            <th style="width:15%">Weight (Kg)</th>
                            <th style="width:15%">Qty</th>
                            <th style="width:15%">Total Weight</th>
                        </tr>
                    </thead>
                    <tbody>
                          <?php
                              $grand_ttl = $ttl_weight = 0;
                              if(!empty($items_list)){
                                $i = 1;
                                foreach ($items_list as $k2 => $r2) {
                                  $weight = '--';
                                  $product_info = $this->db->query("SELECT `unit_id`,`size`,`unit_1`,`conversion_1`,`unit_2`,`conversion_2` FROM tblproducts WHERE `id` = '".$r2->pro_id."' ")->row();
                                  if (!empty($product_info)){
                                    echo $unit = value_by_id('tblunitmaster',$product_info->unit_id,'name');
                                    $unit1 = value_by_id('tblunitmaster',$product_info->unit_1,'name');
                                    $unit2 = value_by_id('tblunitmaster',$product_info->unit_2,'name');
                                    
                                    if (cc($unit) == 'Kg'){
                                      $weight = number_format($product_info->size, 2, '.', ',');
                                      $ttl_weight = ($weight*$r2->qty);
                                      $grand_ttl += $ttl_weight;
                                    }else if(cc($unit1) == 'kg'){
                                      $weight = number_format($product_info->conversion_1, 2, '.', ',');
                                      $ttl_weight = ($weight*$r2->qty);
                                      $grand_ttl += $ttl_weight;
                                    }else if(cc($unit2) == 'kg'){
                                      $weight = number_format($product_info->conversion_2, 2, '.', ',');
                                      $ttl_weight = ($weight*$r2->qty);
                                      $grand_ttl += $ttl_weight;
                                    }
                                  }
                                  
                                  ?>
                                    <tr>
                                      <td><?php echo $i++; ?></td>
                                      <td><?php echo value_by_id("tblproducts", $r2->pro_id, "name"); ?></td>
                                      <td><?php echo $weight; ?></td>
                                      <td><?php echo $r2->qty; ?></td>
                                      <td><?php echo number_format($ttl_weight, 2, '.', ','); ?></td>
                                    </tr>
                                  <?php
                                }
                              }
                          ?>
                    </tbody>
                    <tfoot>
                          <tr style="background-color: #e5e7eb;">
                            <td class="text-center" colspan="4"><h4>GRAND TOTAL</h4></td>
                            <td><h4><?php echo number_format($grand_ttl, 2, '.', ','); ?></h4></td>
                          </tr>    
                    </tfoot>
                  </table>
              </div>
      <?php    
      }
    ?>
                
		<div class="btn-bottom-toolbar text-right">
        <button class="btn btn-info" type="submit">Submit</button>
    </div>

	   </div>
	</div>
  <div class="panel_s">
      <div class="panel-body">
          <div class="col-md-4">
              <h4 class="no-mtop mrg3">Transport Charges</h4>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group" >
                          <input type="number" required="" onchange="setTwoNumberDecimal" step="0.01" name="transport_charges" id="transport_charges" class="form-control" >
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-md-8">
              <h4 class="no-mtop mrg3">Remark</h4>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group" app-field-wrapper="remark">
                          <textarea id="remark" required="" name="manager_remark" class="form-control" rows="6"></textarea>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
	</form>


<?php init_tail(); ?>
<script>
  function setTwoNumberDecimal(event) {
      this.value = parseFloat(this.value).toFixed(2);
  }
</script>




</body>
</html>
