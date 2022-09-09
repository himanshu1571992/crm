<?php
$where = "clientid = '".$client->userid."'";

if(!empty($_GET)){
  extract($this->input->get());
  if(!empty($from_date) && !empty($to_date)){
    $where .= "and dabit_note_date between '".$from_date."' and '".$to_date."' ";  
  } 
 
}
$debitnote_list = $this->db->query("SELECT * from tbldebitnote where  ".$where." order by id desc ")->result();
?>
<h4 class="customer-profile-group-heading">Debit Note</h4>
<div class="row">
    <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('clients/dn_search'); ?>">
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
                            <div class="table-responsive">                            
                <table class="table" id="newtable">
                  <thead>
                    <tr>
                    <th>S.No.</th>
                    <th>Number</th>
                    <th>Customer</th>
                    <th>Challan</th>
                    <th>Date</th>                   
                    <th>Amount</th>
                    <th>Status</th>
                    
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  if(!empty($debitnote_list)){
                    $z=1;
                    foreach($debitnote_list as $row){ 
                      $client_info = $this->db->query("SELECT `client_branch_name` from `tblclientbranch` where userid = '".$row->clientid."'  ")->row();
                      if($row->challan_id > 0){
                        $challan_no = value_by_id('tblchalanmst',$row->challan_id,'chalanno');
                      }else{
                        $challan_no = $row->challan_number;
                      }

                      if($row->paid_status == 1){
                        $paid_status = 'Paid';
                        $cls = 'text-success';
                      }elseif($row->paid_status == 2){
                        $paid_status = 'Partially Paid';
                        $cls = 'text-warning';
                      }else{
                        $paid_status = 'Outstanding';                       
                        $cls = 'text-danger';
                      }
                      ?>                                            
                      <tr>
                        <td><?php echo $z++;?></td>
                        <td><a target="_blank" href="<?php  echo admin_url('debit_note/download_pdf/'.$row->id); ?>"><?php echo $row->number;?></a></td>
                        <td><a href="<?php echo admin_url('clients/client/'.$row->clientid);?>" target="_blank"><?php echo cc($client_info->client_branch_name); ?></a></td>
                        <td><?php echo $challan_no;?></td>
                        <td><?php echo _d($row->dabit_note_date); ?></td>
                        <td><?php echo $row->totalamount;?></td>
                        <td><?php echo '<p class="'.$cls.'">'.$paid_status.'</p>'; ?></td>
                        
                      </tr>
                      <?php
                    }
                  }
                  ?>
                    
                   
                  </tbody>
                  </table>
              </div>
            </div>                
  </div>

