
<?php init_head(); ?>
<div id="wrapper" class="customer_profile">
<div class="content">
   <div class="row">
      <div class="col-md-2">
         <div class="panel_s mbot5">
            <div class="panel-body padding-10">
               <h4 class="bold"><?php echo $vendor_info->name; ?></h4>
            </div>
         </div>
         <?php echo vendor_report_tab('product_term_condition',$vendor_info->id);?>
      </div>
      
      <?php echo form_open($this->uri->uri_string(), array('id' => 'vendor-form', 'class' => 'proposal-form', 'enctype' => 'multipart/form-data')); ?>
            <div class="col-md-10">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            
                            <div class="col-md-12">
                                <h3><?php echo $title; ?></h3>
                                <hr/>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_terms_and_conditions" class="control-label">Product Terms and Conditions</label>
                                    <textarea class="form-control tinymce" name="product_term_condition" id="product_term_condition">
                                        <?php echo $vendor_info->product_term_condition; ?>
                                    </textarea>
                                </div>
                            </div>
                            <div>
                                <div class="col-md-12 text-right">
                                     <button class="btn btn-info" type="submit">
                                        <?php echo _l('submit'); ?>
                                    </button>
                                </div>
                            </div>
                            
                        </div>
                        <!-- <div class="btn-bottom-toolbar text-right">
                           
                        </div> -->
                    </div>
                </div>
            </div> 
            <?php echo form_close(); ?>
   </div>
</div>
</div>

<?php init_tail(); ?>

</body>
</html>


<?php if(isset($lead) && $lead_locked == true){ ?>
<script>
  $(function() {
      // Set all fields to disabled if lead is locked
      var lead_fields = $('.lead-wrapper').find('input, select, textarea');
      $.each(lead_fields, function() {
          $(this).attr('disabled', true);
          if($(this).is('select')) {
              $(this).selectpicker('refresh');
          }
      });
  });
</script>
<script>
$('.lead_approval').click(function(){
    var leadid=$(this).attr('value');
    var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
        });
    var staffid=val;
    var url = '<?php echo base_url(); ?>admin/Leads/sendapproval';
    $.post(url,
        {
          staffid: staffid,
          leadid: leadid,
        },
        function (data, status) {
          $('.leaddv').hide();
          $('.leadSuccess').show();
          
        });
        
   });
   $('.approval').click(function()
   {
    var leadid=$(this).attr('val');
    var approve_status=$(this).attr('value');
    var leadcreatorid=$('#addedfrom').val();
    var lead_description=$('.lead_desc').val();
    var url = '<?php echo base_url(); ?>admin/Leads/approvalaccept';
    if(lead_description.trim()!='')
    {
    $.post(url,
        {
          approve_status: approve_status,
          leadid: leadid,
          leadcreatorid: leadcreatorid,
          approvereason: lead_description,
        },
        function (data, status) {
          if(approve_status==1)
          {
            $('.leadsdv').hide();
            $('.leadaccept').show();
          }
          if(approve_status==2)
          {
            $('.leadsdv').hide();
            $('.leaddecline').show();
          }
        });
    }
    else
    {
      if(lead_description=='')
      {
      $('.lead_desc').addClass('error');  
      }
      else
      {
      $('.lead_desc').removeClass('error');    
      }
    }
   });
   
   
</script>
<?php } ?>
