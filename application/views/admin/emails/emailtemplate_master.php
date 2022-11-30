<?php init_head(); ?>
<style>
    
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
   <div class="content">
      <div class="row">
         <div class="col-md-8">
            <div class="panel_s">
               <div class="panel-body">
                  <h4 class="no-margin">
                     <?php echo $title; ?>
                  </h4>
                  <hr class="hr-panel-heading" />
                  <?php echo form_open_multipart($this->uri->uri_string()); ?>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group" app-field-wrapper="name">
                        <label for="module_id" class="control-label">Email Module</label>
                        <select class="form-control selectpicker" required="" data-live-search="true" id="module_id" name="module_id">
                            <option value=""></option>
                            <?php
                            if (isset($emailmodule_data) && count($emailmodule_data) > 0) {
                                foreach ($emailmodule_data as $emailmodule_key => $emailmodule_value) {
                                    ?>
                                    <option value="<?php echo $emailmodule_value['id'] ?>" <?php  echo (isset($template['module_id']) && $template['module_id'] == $emailmodule_value['id']) ? 'selected' : "" ?>><?php echo cc($emailmodule_value['name']); ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        </div>
                        <div class="form-group" app-field-wrapper="name"><label for="name" class="control-label">Template Name</label><input type="text" id="name" required="" name="name" class="form-control"  value="<?php echo (isset($template['template_name']) && $template['template_name'] != "") ? $template['template_name'] : "" ?>"></div>

                        <div class="form-group" app-field-wrapper="subject"><label for="subject" class="control-label">Subject</label><input type="text" required="" id="subject" name="subject" class="form-control"  value="<?php echo (isset($template['subject']) && $template['subject'] != "") ? $template['subject'] : "" ?>"></div>

                        

                        <?php
                           $editors = array();
                           array_push($editors,'message['.!empty($template->id).']');
                           ?>
                        <p class="bold"><?php echo _l('email_template_email_message'); ?></p>
                        <div class="form-group" app-field-wrapper="message"><textarea  name="message[]" class="form-control tinymce tinymce-manual" data-url-converter-callback="myCustomURLConverter" rows="4" ><?php echo (isset($template['email_message']) && $template['email_message'] != "") ? $template['email_message'] : "" ?></textarea></div>
                        <div class="form-group" app-field-wrapper="fromemail"><label for="fromemail" class="control-label">Email Attachments</label><input type="file" id="file" multiple="" name="email_file[]" style="width: 100%;"></div>
                        <?php 
                        if(!empty($email_doc))
                        { ?>
                        <div class="form-group" app-field-wrapper="viewemail"><label for="viewemail" class="control-label">View Attachments</label>
                        <?php foreach ($email_doc as $email_doc_key => $email_doc_value) { ?>
                           <div class="form-group proimg">
                               <!-- <img src="<?php echo base_url('uploads/email_template_master') . "/" . $template['id'] . "/" . $email_doc_value['file_name'] ?>" style="width: 150px; height: 150px;"> -->
                                <a target="_blank" href="<?php echo base_url('uploads/email_template_master') . "/" . $template['id'] . "/" . $email_doc_value['file_name'] ?>"><?php echo $email_doc_value['file_name']; ?></a>
                                <a href="<?php echo admin_url('emails/del_attach_template/'.$email_doc_value['id'].'?email_id='.$template['id']); ?>" class="btn btn-danger btn-xs _delete"><i class="fa fa-remove"></i></a>
                           </div>  
                        <?php  } ?></div>
                        <?php }
                        ?>
                        
                       
                        <div class="btn-bottom-toolbar text-right">
                           <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
                        </div>
                     </div>
                     <?php echo form_close(); ?>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="panel_s">
               <div class="panel-body">
                  <h4 class="no-margin">
                     <?php echo _l('available_merge_fields'); ?>
                  </h4>
                  <hr class="hr-panel-heading" />
                  <div class="row">
                   <div class="col-md-12">
                        <div class="row available_merge_fields_container">
                          <?php
                            if (isset($emailtemplates_fields) && count($emailtemplates_fields) > 0) {
                                foreach ($emailtemplates_fields as $emailtemplates_fields_key => $emailtemplates_fields_value) {
                                    ?>
                          <p><?php echo $emailtemplates_fields_value['name']; ?><span class="pull-right"><a href="#" class="add_merge_field"><?php echo $emailtemplates_fields_value['slug']; ?></a></span></p> 
                        <?php } } ?>
                        </div>
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
<script>
   $(function(){
     <?php foreach($editors as $id){ ?>
       init_editor('textarea[name="<?php echo $id; ?>"]',{urlconverter_callback:'merge_field_format_url'});
       <?php } ?>
       var merge_fields_col = $('.merge_fields_col');
         // If not fields available
         $.each(merge_fields_col, function() {
           var total_available_fields = $(this).find('p');
           if (total_available_fields.length == 0) {
             $(this).remove();
           }
         });
     // Add merge field to tinymce
     $('.add_merge_field').on('click', function(e) {
      e.preventDefault();
      tinymce.activeEditor.execCommand('mceInsertContent', false, $(this).text());
    });
   });
</script>
</body>
</html>
