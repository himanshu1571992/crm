<?php
$session_id = $this->session->userdata();
?>
<?php init_head(); ?>
<style type="text/css">
  .button3 {background-color: #800000;}
  .badge-primary {background-color: #28a745;}
</style>
<div id="wrapper">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="panel_s">
          <div class="panel-body">
            <h4><?php echo $title; ?></h4>
            <div class="clearfix"></div>
            <hr class="hr-panel-heading" />
            <div class="row">
              <div class="col-md-12">
                <div class="col-md-3">
                  <label for="f_date" class="control-label">Client Name :</label>
                  <div class="input-group date"> 
                      <div class="badge badge-pill badge-primary"><?php echo ($clientpaymentrequest->client_id > 0) ? client_info($clientpaymentrequest->client_id)->client_branch_name : "--"; ?></div>
                  </div>
                </div>
                <div class="col-md-3">
                  <label for="f_date" class="control-label">Cheque No :</label>
                  <div class="input-group date"> 
                      <div class="badge badge-pill badge-primary"><?php echo (isset($clientpaymentrequest->cheque_no)) ? $clientpaymentrequest->cheque_no : "--"; ?></div>
                  </div>
                </div>
                <div class="col-md-3">
                  <label for="f_date" class="control-label">Cheque Amount :</label>
                  <div class="input-group date"> 
                      <div class="badge badge-pill badge-primary"><?php echo (isset($clientpaymentrequest->ttl_amt)) ? number_format($clientpaymentrequest->ttl_amt, 2) : "--"; ?></div>
                  </div>
                </div>
                <div class="col-md-3">
                  <label for="f_date" class="control-label">Cheque Date :</label>
                  <div class="input-group date"> 
                      <div class="badge badge-pill badge-primary"><?php echo (!empty($clientpaymentrequest->cheque_date)) ? _d($clientpaymentrequest->cheque_date) : "--"; ?></div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <br>
                <div class="col-md-3">
                  <label for="f_date" class="control-label">Payment Behalf :</label>
                  <div class="input-group date"> 
                      <div class="badge badge-pill badge-primary">
                        <?php 
                          if (!empty($clientpaymentrequest->payment_behalf)){
                              if ($clientpaymentrequest->payment_behalf == 1){
                                 echo "On Account";
                              }else if ($clientpaymentrequest->payment_behalf == 2){
                                 echo "Against Invoice";
                              }else if ($clientpaymentrequest->payment_behalf == 3){
                                echo "Against Invoice";
                              }else{
                                echo "--";
                              }
                          }
                       ?>
                      </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <label for="f_date" class="control-label">Service Type :</label>
                  <div class="input-group date"> 
                      <div class="badge badge-pill badge-primary">
                        <?php 
                          if ($clientpaymentrequest->service_type == 1){
                            echo 'Rent';
                          }else if ($clientpaymentrequest->service_type == 2){
                            echo "Sales";
                          }else{
                            echo "--";
                          }
                       ?>
                      </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <label for="f_date" class="control-label">Reference No :</label>
                  <div class="input-group date"> 
                      <div class="badge badge-pill badge-primary">
                        <?php echo (!empty($clientpaymentrequest->reference_no)) ? $clientpaymentrequest->reference_no : "--"; ?>
                      </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <label for="f_date" class="control-label">Bank :</label>
                  <div class="input-group date"> 
                      <div class="badge badge-pill badge-primary"><?php echo ($clientpaymentrequest->bank_id > 0) ? value_by_id("tblbankmaster", $clientpaymentrequest->bank_id, "name") : "--"; ?></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>    
      <div class="col-md-12">
        <div class="panel_s">    
          <div class="panel-body">
            <form action="<?php echo admin_url('manage_cheque/pending_cheque_status'); ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
              <div class="row">
                <div class="col-md-8">
                <div class="table-responsive" style="margin-bottom:30px;">
                      <table class="table ui-table">
                        <thead>
                          <tr>
                            <th>Status</th>
                            <th>Action Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                              <td>
                                <select class="form-control" name="status" required="">
                                  <option value="">--select status--</option>
                                  <?php if ($section == "clearance"){ ?>
                                  <option value="2">Bounced</option>
                                  <option value="3">Redeposit</option>
                                  <option value="1">Clear</option>
                                  <?php }elseif ($section == "deposit"){ ?>
                                  <option value="4">Cancel</option>
                                  <option value="5">Deposit</option>
                                  <option value="6">Hold</option>
                                  <?php } ?>
                                </select>
                              </td>
                              <td>
                                <div class="input-group date"> 
                                    <input id="chaque_clear_date" required="" name="chaque_clear_date" class="form-control date_picker" value="<?php echo date('m/d/Y');?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                </div>
                              </td>
                            </tr>
                        </tbody>
                      </table>      
                    </div>
                    <input type="hidden" value="<?php echo (!empty($clientpaymentrequest->id)) ? $clientpaymentrequest->id : 0; ?>" name="id">
                    <input type="hidden" name="chequesaction" value="<?php echo $section; ?>">
                </div>                          
              </div>
              <div class="btn-bottom-toolbar text-right">
                <button  type="submit" class="btn btn-info">Update</button>
              </div>
            </form>
          </div>  
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php init_tail(); ?>
</body>
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
<script type="text/javascript">
  $(document).ready(function() {
    $('.date_picker').datepicker();
  });
  

</script>
</html>
