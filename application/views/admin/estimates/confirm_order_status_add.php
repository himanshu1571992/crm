<?php init_head(); ?>
<style>.error{border:1px solid red !important;}.mrg3{margin-bottom: 3%;margin-top: 3% !important;}table.items tr.main td {padding-top: 8px !important;padding-bottom: 8px !important;}</style>
<div id="wrapper">
    <div class="content">
   <div class="row">
      <div class="col-md-12"></div>
      <div class="col-md-12">
         <div class="panel_s">
            <div class="panel-body">
               <div>
                  <div class="tab-content">
                      <h4 class="customer-profile-group-heading"><?php echo isset($title) ? $title: "";?></h4>
                      <?php echo form_open($this->uri->uri_string(), array('id' => 'enquirycall-form', 'class' => 'enquirycall-form')); ?>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title" class="control-label">Order Status</label>
                                        <input type="text" id="title" class="form-control" value="<?php echo (isset($order_status)) ? $order_status->title: ""; ?>" name="title" placeholder="Order Status" required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo _l('submit'); ?>
                            </button>
                        </div>
                      <?php echo form_close(); ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="btn-bottom-pusher"></div>
</div>
</div>
<?php init_tail(); ?>

</body>
</html>
