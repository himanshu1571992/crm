<?php if(isset($client)){ 
$where = "approved_status = 1 and status = 1 and clientid = '".$client->userid."' ";
if(!empty($_GET)){
  extract($this->input->get());
  if(!empty($from_date) && !empty($to_date)){
    $where .= "and date between '".$from_date."' and '".$to_date."' ";  
  } 
 
}
$expense_info = $this->db->query("SELECT * from `tblexpenses` where ".$where." ORDER BY id desc ")->result();
?>
<h4 class="customer-profile-group-heading">Expenses</h4>
<div class="row">
    <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('clients/expense_search'); ?>">
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
                      <th width="3%">S.No</th>
                      <th width="7%">Date</th>
                      <th width="10%">EXP-ID</th>
                      <th>Employee</th>
                      <th>Details</th>
                      <th>Category</th>
                      <th>Type</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                 <tbody>
                  <?php
                  $ttl_amt = 0;
                  if(!empty($expense_info)){
                    $z=1;
                    foreach($expense_info as $row){ 

                        if($row->parent_id > 0){
                          $parent_id = $row->parent_id;
                        }else{
                          $parent_id = $row->id;
                        }
                        
                        $ttl_amt += $row->amount;
                      ?>                                            
                      <tr>
                        <td><?php echo $z++;?></td>
                        <td><?php echo _d($row->date); ?></td>
                        <td><?php echo 'EXP-'.get_short(get_expense_category($row->category)).'-'.number_series($parent_id);?></td>
                        <td><?php echo get_employee_name($row->addedfrom);?></td>
                        <td>Purpose - <?php echo get_expense_purpose($row->id); ?> <br> <?php echo get_expense_related($row->id);?></td>
                        <td><?php echo cc(value_by_id('tblexpensescategories',$row->category,'name')); ?></td>
                        <td><?php echo cc(value_by_id('tblexpensetype',$row->type_id,'name')); ?></td>
                        <td><?php echo $row->amount; ?></td>
                        
                      </tr>
                      <?php
                    }
                  }else{
                    echo '<tr><td class="text-center" colspan="8"><h5>Record Not Found</h5></td></tr>';
                  }
                  ?>
                    
                   
                  </tbody>
                  <tfoot>
                       <tr>
                          <td colspan="7" class="text-center"><b>Total Amount</b></td>
                          <td><b><?php echo $ttl_amt; ?></b></td>
                        </tr>
                  </tfoot>
                  </table>
      </div>                  
  </div>

<?php } ?>

