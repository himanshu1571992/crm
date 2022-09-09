<?php if(isset($client)){ 
$where = "clientid = '".$client->userid."' ";
if(!empty($_GET)){
  extract($this->input->get());
  if(!empty($from_date) && !empty($to_date)){
    $where .= "and date between '".$from_date."' and '".$to_date."' ";  
  } 
 
}
$invoice_list = $this->db->query("SELECT * from `tblestimates` where ".$where." ORDER BY id desc ")->result();
?>
<h4 class="customer-profile-group-heading">Perfoma Invoice</h4>
<div class="row">
    <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('clients/estimate_search'); ?>">
      <input type="hidden" name="clientid" value="<?php echo $client->userid; ?>">
     <div class="col-md-3">
        <div class="form-group select-placeholder">
            <select class="selectpicker" name="range" id="range" data-width="100%" required="" onchange="render_customer_statement();">
                <option value="">--Select One--</option>
                <option value="1" <?php if(!empty($range) && $range == 1){ echo 'selected'; } ?>>Today</option>
                <option value="2" <?php if(!empty($range) && $range == 2){ echo 'selected'; } ?>>This Week</option>
                <option value="3" <?php if(!empty($range) && $range == 3){ echo 'selected'; } ?>>This Month</option>
                <option value="4" <?php if(!empty($range) && $range == 4){ echo 'selected'; } ?>>Last Month</option>
                <option value="5" <?php if(!empty($range) && $range == 5){ echo 'selected'; } ?>>This Year</option>
                <option value="period" <?php if(!empty($range) && $range == 'period'){ echo 'selected'; } ?>>Custom Date</option>
            </select>
        </div>
       
    </div>
     <div class="col-md-3">
           <div class="period <?php if(!empty($range) && $range == 'period'){  }else{ echo 'hide'; } ?> ">
              <div class="input-group date">
                  <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if(!empty($f_date)){ echo $f_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
              </div>
          </div>
      </div>
      <div class="col-md-3">
          <div class="period <?php if(!empty($range) && $range == 'period'){  }else{ echo 'hide'; } ?>">
               <div class="input-group date">
                  <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($t_date)){ echo $t_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
              </div>
          </div>
      </div>

    
    <div class="form-group col-md-2 float-right">
      <button class="form-control btn-info" type="submit">Search</button>
    </div>
    </form>

    <div class="col-md-12">  
    <hr>                             
        <table class="table" id="newtable">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Perfoma Invoice #</th>
                      <th>Staff Name</th>                      
                      <th>Total Tax</th>
                      <th>Customer</th>
                      <th>Date</th>
                      <th>Expiry Date</th>
                      <th>Status</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                 <tbody>
                  <?php
                  $ttl_amt = 0;
                  if(!empty($invoice_list)){
                      foreach ($invoice_list as $key => $value) {
                        $client_info = $this->db->query("SELECT * FROM `tblclientbranch` where userid = '".$value->clientid."' ")->row();
                        $ttl_amt += $value->total;
                      ?>
                      <tr>
                          <td><?php echo ++$key; ?></td>                                                
                          <td><?php echo '<a href="' . admin_url('estimates/list_estimates/' . $value->id) . '" target="_blank">' . format_estimate_number($value->id) . '</a>'; ?></td>
                          <td><?php echo get_employee_name($value->addedfrom); ?></td>                          
                          <td><?php echo $value->total_tax; ?></td>
                          <td><a href="<?php echo admin_url('clients/client/'.$value->clientid);?>" target="_blank"><?php echo (!empty($client_info)) ? cc($client_info->client_branch_name) : '--' ; ?></a></td>                          
                          <td><?php echo _d($value->date); ?></td> 
                          <td><?php echo _d($value->expirydate); ?></td> 
                          <td><?php echo format_estimate_status($value->status); ?></td> 
                          <td><?php echo $value->total; ?></td>                    
                        </tr>
                      <?php
                      }
                 }else{
                    echo '<tr><td class="text-center" colspan="9"><h5>Record Not Found</h5></td></tr>';
                  }
                  ?>
                   
                  </tbody>
                  <tfoot>
                       <tr>
                          <td colspan="8" class="text-center"><b>Total Amount</b></td>
                          <td><b><?php echo $ttl_amt; ?></b></td>
                        </tr>
                  </tfoot>
                  </table>
      </div>                  
  </div>

<?php } ?>

