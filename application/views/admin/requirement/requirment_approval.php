
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

  <?php echo form_open($this->uri->uri_string(), array('id' => 'requirment-form', 'class' => 'requirment-form','enctype' => 'multipart/form-data')); ?>
	<div class="panel_s">
		<div class="panel-body">
		<div class="row">
			   <h3 class="text-center"> <?php echo $title; ?></h3>
					<!-- <div class="col-md-4">
				<button type="submit" style="margin-top: 24px;" class="btn btn-info">Send for approval</button>
			</div> -->
      <hr class="hr-panel-heading">
		</div>
    <div class="col-md-12">
        <div class="col-md-3">
            <h4 for="warehouse_id" class="control-label"><u>Request ID </u> : </h4>
            <div class="form-group">
                <span class="text-danger"><?php echo (!empty($requirement_info)) ? 'P-REQ-'.str_pad($requirement_info->id, 4, '0', STR_PAD_LEFT) : ""; ?></span>
            </div>
        </div>
        <div class="col-md-3">
            <h4 for="warehouse_id" class="control-label"><u>Department </u> : </h4>
            <div class="form-group">
                <span class="text-danger"><?php echo (isset($requirement_info) && $requirement_info->department_id > 0) ? value_by_id('tbldepartmentsmaster', $requirement_info->department_id, "name") : "--"; ?></span>
            </div>
        </div>
        <?php if(isset($requirement_info) && $requirement_info->reason_for_request > 0){ ?>
          <div class="col-md-3">
              <h4 for="reason_for_request" class="control-label"><u>Reason For Request</u></h4>
              <div class="form-group">
                <span class="text-danger">
                  <?php
                      echo ($requirement_info->reason_for_request == 1) ? 'For Sales Order' : 'For Stock';
                  ?>
                </span>
              </div>
          </div>
        <?php } ?>
        <?php if(isset($requirement_info) && $requirement_info->estimate_id > 0){ ?>
          <div class="col-md-3">
              <h4 for="reason_for_request" class="control-label"><u>Proforma Invoice</u></h4>
              <div class="form-group">
                <span class="text-danger">
                  <?php
                      echo '<a target="_blank" href="'.admin_url('estimates/download_pdf/'.$requirement_info->estimate_id).'">'.value_by_id("tblestimates", $requirement_info->estimate_id, "number").'</a>';
                  ?>
                </span>
              </div>
          </div>
        <?php } ?>
        <div class="col-md-3">
          <h4 for="warehouse_id" class="control-label"><u><?php echo _l('stock_remarks'); ?></u> : </h4>
          <div class="form-group">
              <span class="text-danger"><?php echo (!empty($requirement_info)) ? $requirement_info->remark : ""; ?></span>
          </div>
        </div>
    </div>

    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable" style="margin-top:2%; !important">
        <thead>
            <tr>
                <th width="5%"  align="center"><i class="fa fa-cog"></i></th>
                <th width="35%" align="left">Product Name</th>
                <th width="10%" align="left">Unit</th>
                <th width="10%" align="left">Quantity</th>
                <th width="20%" align="left">Product Images</th>
                <th width="20%" align="left">Remarks</th>
            </tr>
        </thead>
        <tbody class="ui-sortable">
             <?php
                 $prid = 0;
                if (isset($requirement_products) && !empty($requirement_products)){
                  foreach ($requirement_products as $value) {
              ?>
                    <tr class="main" id="tr<?php echo $prid; ?>">
                       <td align="center"><?php echo ++$prid;?></td>
                       <td><?php echo cc($value->product_name);?></td>
                       <td><?php echo value_by_id("tblunitmaster", $value->unit, "name"); ?></td>
                       <td><?php echo $value->quantity; ?></td>
                       <td>
                           <div class="form-group">
                               <?php
                                  $files_data = $this->db->query("SELECT * FROM `tblrequirement_productimages` WHERE `req_id`='".$value->req_id."' AND `reqpro_id`='".$value->id."' ")->result();
                                  if (!empty($files_data)){
                                     foreach ($files_data as $ky => $file) {
                                ?>
                                      <a href="<?php echo site_url('uploads/requirement_product/'.$file->image); ?>" target="_blank"><img style="border: 1px solid;" src="<?php echo site_url('uploads/requirement_product/'.$file->image); ?>" width="50" height="50"></a>
                                <?php
                                     }
                                  }
                               ?>
                           </div>
                       </td>
                       <td><?php echo cc($value->remark); ?></td>
                  </tr>
              <?php
                  }
                }
              ?>
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-12">
            <?php if (empty($appvoal_info) OR (!empty($appvoal_info) && $appvoal_info->approve_status == 5)){ ?>
            <div class="btn-bottom-toolbar bottom-transaction text-right">
                <button type="submit" name="action" value="5" style="background-color: #e8bb0b;" class="btn btn-warning hold mleft10 proposal-form-submit save-and-send transaction-submit">
                    On Hold
                </button>
                <button type="submit" name="action" value="2" class="btn btn-danger mleft10">
                    Reject
                </button>
                <button type="submit" name="action" value="1" class="btn btn-info mleft10">
                    Approve
                </button>
            </div>
           <?php } ?> 
        </div>
    </div>

	   </div>
	</div>
  <div class="panel_s">
      <div class="panel-body">
          <div class="col-md-12">
              <h4 class="no-mtop mrg3">Approve Remark</h4>
          </div>
          <hr/>
          <div class="col-md-12">
              <div class="row">
                  <div class="col-md-12 pull-right">
                      <div class="form-group" app-field-wrapper="remark">
                          <textarea id="remark" required="" name="remark" class="form-control" rows="6"><?php
                              if (!empty($appvoal_info)) {
                                  echo $appvoal_info->approvereason;
                              }
                              ?></textarea>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
	<?php echo form_close(); ?>


<?php init_tail(); ?>





</body>
</html>
