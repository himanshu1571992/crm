
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

</style>

<div id="wrapper">
    <div class="content accounting-template">

  <form action="<?php echo admin_url('requirement/purchase_process_approval_action');?>" id="product-form" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
  <input type="hidden" value="<?php echo $id?>" name="req_id">
	<div class="panel_s">
		<div class="panel-body">
    		<div class="row">
    			   <h3 class="text-center">Purchase Product Final</h3>
             <?php if($requirement_info->cancel == 1){
                ?>
                  <h4 class="text-center text-danger">Cancelled</h4>
                  <p class="text-center text-danger"><?php echo $requirement_info->cancel_remark; ?></p>
                <?php
             }
             ?>
             <div class="col-md-3">
                 <h5 style="font-size:15px;color:red;"><u>Department :</u></h5>
                 <span><?php echo (isset($requirement_info) && $requirement_info->department_id > 0) ? value_by_id('tbldepartmentsmaster', $requirement_info->department_id, "name") : "--"; ?></span>
             </div>
             <div class="col-md-3">
                 <h5 style="font-size:15px;color:red;"><u>Expected Date :</u></h5>
                 <span><?php echo (!empty($requirement_info->expected_date)) ? _d($requirement_info->expected_date) :'N/A'; ?></span>
             </div>
             <div class="col-md-3">
                 <h5 style="font-size:15px;color:red;"><u>Remark :</u></h5>
                 <span><?php echo $requirement_info->remark; ?></span>
             </div>
             <?php if(isset($requirement_info) && $requirement_info->reason_for_request > 0){ ?>
               <div class="col-md-3">
                   <h5 style="font-size:15px;color:red;"><u>Reason For Request</u></h5>
                   <div class="form-group">
                     <span>
                       <?php
                           echo ($requirement_info->reason_for_request == 1) ? 'For Sales Order' : 'For Stock';
                       ?>
                     </span>
                   </div>
               </div>
             <?php } ?>
             <?php if(isset($requirement_info) && $requirement_info->estimate_id > 0){ ?>
               <div class="col-md-3">
                   <h5 style="font-size:15px;color:red;"><u>Proforma Invoice</u></h5>
                   <div class="form-group">
                     <span >
                       <?php
                           echo '<a target="_blank" href="'.admin_url('estimates/download_pdf/'.$requirement_info->estimate_id).'">'.value_by_id("tblestimates", $requirement_info->estimate_id, "number").'</a>';
                       ?>
                     </span>
                   </div>
               </div>
             <?php } ?>
              <?php if (!empty($requirement_info->purchase_person_remark)){ ?>
                <div class="col-md-3">
                    <h5 style="font-size:15px;color:red;"><u>Approval Remark :</u></h5>
                    <p><?php echo $requirement_info->purchase_person_remark; ?></p>
                </div>
              <?php } ?>

    					<!-- <div class="col-md-4">
    				<button type="submit" style="margin-top: 24px;" class="btn btn-info">Send for approval</button>
    			</div> -->
    		</div>
    <?php
    if(!empty($requirement_products)){
      foreach ($requirement_products as $key => $value) {

         $productfields  = $this->db->query("SELECT * FROM tblrequirement_productfields WHERE reqpro_id =  '".$value->id."' ")->result();
         $productimages  = $this->db->query("SELECT * FROM tblrequirement_productimages WHERE reqpro_id =  '".$value->id."' ")->result();
         $productvendors  = $this->db->query("SELECT * FROM tblrequirement_productvendors WHERE reqpro_id =  '".$value->id."' ")->result();
        ?>
        <div class="row mt-5">
            <div class="col-md-12">
                <hr class="hr-panel-heading">
                <h4 class="no-margin text-center"><?php echo $value->product_name.' | Quantity ('.$value->quantity.') | Remark ('.$value->remark.')'; ?></h4>
                <hr class="hr-panel-heading">
            </div>
            <div id="fieldmodel_<?php echo $value->id; ?>" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><?php echo $value->product_name; ?> </h4>
                        </div>
                        <div class="modal-body">
                      		<div class="text-left">
                      			<p><b>Prodcut Remark : </b> <?php echo (!empty($value->remark)) ? $value->remark : '--'; ?></p>
                      		</div>
                      		<div class="text-right">
                      			 <?php
                               if(!empty($productimages)){
                                ?>
                                <ul>
                                  <?php
                                  foreach ($productimages as $k => $img) {
                                    echo '<li><a target="_blank" href="'.base_url('uploads/requirement_product/'.$img->image).'">'.$value->product_name.' Image'.++$k.'</a></li>';
                                  }
                                  ?>
                                </ul>
                                <?php
                               }
                               ?>
                      		</div>



                                <table class="table ui-table" id="table_<?php echo $value->id; ?>">
                                    <thead>
                                      <tr>
                                        <th style="width:15%">Name</th>
                                        <th style="width:20%">Value</th>
                                        <th style="width:20%">Remark</th>
                                        <th style="width:20%">Your Remark</th>
                                        <th style="width:20%">Vendor Remark</th>
                                      </tr>
                                    </thead>
                                    <tbody>

                                      <?php
                                      if(!empty($productfields)){
                                        foreach ($productfields as $k1 => $r1) {
                                          ?>
                                            <tr id="trcf_<?php echo $value->id.'_'.$k1; ?>">
                                              <td><?php echo (!empty($r1->field)) ? cc($r1->field) : '--'; ?></td>
                                              <td><?php echo (!empty($r1->value)) ? $r1->value : '--'; ?></td>
                                              <td><?php echo (!empty($r1->remark)) ? cc($r1->remark) : '--'; ?></td>
                                              <td><?php echo (!empty($r1->pp_remark)) ? cc($r1->pp_remark) : '--'; ?></td>
                                              <td><?php echo (!empty($r1->vendor_remark)) ? cc($r1->vendor_remark) : '--'; ?></td>
                                            </tr>

                                          <?php
                                        }
                                      }
                                      ?>

                                    </tbody>
                                  </table>
                      </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table ui-table" id="vendortable_<?php echo $value->id; ?>">
                      <thead>
                          <tr>
                              <th style="width:5%">S.No.</th>
                              <th style="width:25%">Vendor</th>
                              <th style="width:15%">Unit</th>
                              <th style="width:15%">Rate</th>
                              <th style="width:10%">Tax</th>
                              <th style="width:45%">Remark</th>
                              <th style="width:5%" class="text-center">Approve</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                              if(!empty($productvendors)){
                                $i = 1;
                                foreach ($productvendors as $k2 => $r2) {
                                  if($r2->approve == 1){
                                    $status = 'Approved';
                                    $color = 'green';
                                  }elseif($r2->approve == 2){
                                    $status = 'Rejected';
                                    $color = 'red';
                                  }else{
                                    $status = 'Pending';
                                    $color = 'Orange';
                                  }
                                  ?>
                                  <input type="hidden" value="<?php echo $r2->id; ?>" name="row[]">
                                    <tr id="tr<?php echo $value->id.'_'.$k2;?>">
                                      <td><?php echo $i++; ?></td>
                                      <td><?php echo cc($r2->vendor_name); ?></td>
                                      <td><?php echo value_by_id("tblunitmaster", $r2->unit_id, "name"); ?></td>
                                      <td><?php echo $r2->rate; ?></td>
                                      <td><?php echo ($r2->tax == 1) ? 'Including' : 'Excluding'; ?></td>
                                      <td><?php echo cc($r2->remark); ?></td>
                                      <td class="text-center" style="color: <?php echo $color; ?>"><?php echo $status; ?></td>
                                    </tr>
                                  <?php
                                }
                              }else{
                                ?>
                                <tr>
                                  <td colspan="6" class="text-center">Vendors are not alloted!</td>
                                </tr>
                                <?php
                              }
                          ?>
                      </tbody>
                  </table>
              </div>
          </div>
        <?php
      }
    }
    ?>
	   </div>
	</div>
	</form>


<?php init_tail(); ?>





</body>
</html>
