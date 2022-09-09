

<?php init_head(); ?>
<style>
    fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}
</style>
<div id="wrapper" class="customer_profile">

<div class="content">

   <div class="row">

      <div class="col-md-2">

         <div class="panel_s mbot5">

            <div class="panel-body padding-10">

               <h4 class="bold">Product Wise</h4>

            </div>

         </div>

         <?php echo prodcutwise_report_tab('lead');?>

      </div>

      

            <div class="col-md-10">

                <div class="panel_s">

                    <div class="panel-body">



                    <div class="col-md-4"><h4 class="no-margin"> </h4></div>  



                   <h4 class="no-margin"><?php echo $title; ?> </h4>



          <hr class="hr-panel-heading">

          

          <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="">



              <div class="form-group col-md-3">
                  <select class="form-control selectpicker" id="product_cat_id" name="category_id" data-live-search="true">
                      <option value="" selected >--Select Category-</option>
                      <?php
                      if(!empty($category_list)){
                          foreach($category_list as $row){
                              ?>
                              <option value="<?php echo $row->id;?>" <?php if(!empty($category_id) && $category_id == $row->id){ echo 'selected'; } ?>><?php echo cc($row->name); ?></option>
                              <?php
                          }
                      }
                      ?>
                  </select>
              </div>

              <div class="form-group col-md-3">
                  <select class="form-control selectpicker" id="product_sub_cat_id" name="sub_category_id" data-live-search="true">
                      <option value="" selected >--Select Sub Category-</option>
                      <?php
                      if(!empty($sub_category_list)){
                          foreach($sub_category_list as $row){
                              ?>
                              <option value="<?php echo $row->id;?>" <?php if(!empty($sub_category_id) && $sub_category_id == $row->id){ echo 'selected'; } ?>><?php echo cc($row->name); ?></option>
                              <?php
                          }
                      }
                      ?>
                  </select>
              </div>

              <div class="form-group col-md-3">
                  <select class="form-control selectpicker" id="parent_category_id" name="parent_category_id" data-live-search="true">
                      <option value="" selected >--Select Parent Category-</option>
                      <?php
                      if(!empty($parent_category_list)){
                          foreach($parent_category_list as $row){
                              ?>
                              <option value="<?php echo $row->id;?>" <?php if(!empty($parent_category_id) && $parent_category_id == $row->id){ echo 'selected'; } ?>><?php echo cc($row->name); ?></option>
                              <?php
                          }
                      }
                      ?>
                  </select>
              </div>

              <div class="form-group col-md-3">
                  <select class="form-control selectpicker" id="child_category_id" name="child_category_id" data-live-search="true">
                      <option value="" selected >--Select Child Category-</option>
                      <?php
                      if(!empty($child_category_list)){
                          foreach($child_category_list as $row){
                              ?>
                              <option value="<?php echo $row->id;?>" <?php if(!empty($child_category_id) && $child_category_id == $row->id){ echo 'selected'; } ?>><?php echo cc($row->name); ?></option>
                              <?php
                          }
                      }
                      ?>
                  </select>
              </div>




              <div class="form-group col-md-3">
                  <select class="form-control selectpicker" id="product_id" name="product_id" data-live-search="true">
                      <option value="" selected >--Select Product-</option>
                      <?php
                      if(!empty($product_list)){
                          foreach($product_list as $row){
                              ?>
                              <option value="<?php echo $row->id;?>" <?php if(!empty($product_id) && $product_id == $row->id){ echo 'selected'; } ?>><?php echo cc($row->name).product_code($row->id); ?></option>
                              <?php
                          }
                      }
                      ?>
                  </select>
              </div>

              



              <div class="form-group col-md-3">
                  <select class="form-control selectpicker" id="service_type" name="service_type" data-live-search="true">
                      <option value="" selected >-Service Type-</option>
                      <?php
                      if(!empty($servicetype_list)){
                          foreach($servicetype_list as $row){
                              ?>
                              <option value="<?php echo $row->id;?>" <?php if(!empty($service_type) && $service_type == $row->id){ echo 'selected'; } ?>><?php echo cc($row->name); ?></option>
                              <?php
                          }
                      }
                      ?>
                  </select>
              </div>

              <div class="form-group col-md-3">
                    <div class="">
                        <select class="form-control selectpicker" id="lead_source" name="lead_source" data-live-search="true">
                            <option value="" disabled selected >--Select Source-</option>
                            <?php
                            if(!empty($sources_info)){
                                foreach ($sources_info as $value) {
                                    ?>
                                    <option value="<?php echo $value->id; ?>" <?php if(!empty($lead_source) && $lead_source == $value->id){ echo 'selected';} ?>><?php echo cc($value->name); ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>


             <div class="form-group col-md-3">

               <div class="input-group date">

                    <input id="f_date" placeholder="From date" name="f_date" class="form-control datepicker" value="<?php if(!empty($f_date)){ echo $f_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>

                </div>

              </div>

              <div class="form-group col-md-3">

                <div class="input-group date">

                    <input id="t_date" placeholder="To date" name="t_date" class="form-control datepicker" value="<?php if(!empty($t_date)){ echo $t_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>

                </div>

              </div>    

            

            <div class="col-md-1">                            
              <button type="submit" class="btn btn-info">Search</button>
              </div>
              <div class="col-md-1">
               <a style="margin-left: 20px;" class="btn btn-danger" href="">Reset</a>
              </div>

            </form>



            <div class="col-md-12 table-responsive"> 
<!--              <div class="row">
                                   
                <div class="col-md-12">
                    <h4 style="color: red;">Total Amount : <?php echo number_format($ttl_amount, 2, '.', ''); ?></h4>
                    <h4 style="color: red;">Total Count : <?php echo $ttl_count; ?></h4>
                </div>  
            </div>-->
            <div class="col-md-12">
                <div class="row"> 
                    <fieldset class="scheduler-border"><br>
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 style="color: red; text-align: center;" class="control-label">Total Amount</h4>
                                    <p id="igst_tot" style="color: red; text-align: center;"><?php echo number_format($ttl_amount, 2, '.', ''); ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 style="color: red; text-align: center;" class="control-label">Total Count</h4>
                                    <p id="igst_tot" style="color: red; text-align: center;"><?php echo $ttl_count; ?></p>
                                </div>
                            </div>

                        </div>
                    </fieldset> 
                </div>
            </div>
                
            <hr> 
                <table class="table" id="newtable">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Lead #</th>
                      <th>Staff Name</th>
                      <th>Customer Name</th>
                      <th>Quotation</th>
                      <th>Enq date</th>
                      <th>Source</th>
                      <!-- <th>Amount</th> -->
                      <th>Created</th>
                      <th>Followup</th>
                      <th>Contacts</th>
                    </tr>
                  </thead>
                 <tbody>

                  <?php

                  if(!empty($lead_list)){

                      foreach ($lead_list as $key => $value) {

                          $client_info = $this->db->query("SELECT * FROM tblclientbranch WHERE userid = '".$value->client_branch_id."' ")->row();

                          if($value->client_branch_id > 0){
                              $company = $client_info->client_branch_name;
                          }else{
                              $company = $value->company;
                          }

                          if(check_quotation($value->id) == 1){
                              $quotation = 'Yes';
                          }else{
                              $quotation = 'No';
                          }

                          $checked = ($value->followup == 1 ) ? 'checked' : '';
                          $toggleActive = '<div class="onoffswitch">
                              <input type="checkbox" data-switch-url="' . admin_url() . 'leads/change_followup_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $value->id . '" data-id="' . $value->id . '" ' . $checked . '>
                              <label class="onoffswitch-label" for="' . $value->id . '"></label>
                          </div>';

                          $contact_info = $this->db->query("SELECT c.id from tblcontacts as c LEFT JOIN tblenquiryclientperson as cp ON cp.contact_id = c.id where cp.enquiry_id = '".$value->id."' and c.phonenumber != '' ")->row();


                          //getting last quotation amount
                            /*$quotation_info = $this->db->query("SELECT `total` FROM `tblproposals` WHERE total > 0 and `rel_id` = '".$value->id."' order by id desc  ")->row();
                            if(!empty($quotation_info)){
                                $amount = $quotation_info->total;
                            }else{
                                $amount = '0.00';
                            }*/
                      ?>

                      <tr>

                          <td><?php echo ++$key; ?></td>  
                          <td><?php echo '<a href="'.admin_url('leads/index/' . $value->id).'" onclick="init_lead(' . $value->id . ');return false;"> LEAD-'.number_series($value->id).'</a>'; ?></td>
                          <td><?php echo get_employee_name($value->addedfrom); ?></td>
                          <td><?php echo $company; ?></td>
                          <td><?php echo $quotation; ?></td>
                          <td><?php echo _d($value->enquiry_date); ?></td>
                          <td><?php echo value_by_id('tblleadssources',$value->source,'name'); ?></td>
                          <!-- <td><?php echo $amount; ?></td> -->
                          <td><?php echo _d($value->dateadded); ?></td>
                          <td><?php echo $toggleActive; ?></td>
                          <td class="text-center"><?php if(!empty($contact_info)){ ?><a target="_blank" href="<?php echo admin_url('leads/lead_contact/'.$value->id); ?>" data-status="1"><i class="fa fa-user fa-2x" aria-hidden="true"></i></a><?php }else{ echo '--'; }?></td>                         

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

                       

                    </div>

                </div>

   </div>

</div>

</div>



<?php init_tail(); ?>



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





<script>



$(document).ready(function() {

    $('#newtable').DataTable( {

        "iDisplayLength": 15,

        dom: 'Bfrtip',

        buttons: [           

            {

                extend: 'excel',

                exportOptions: {

                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]

                }

            },

            {

                extend: 'pdf',

                exportOptions: {

                     columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]

                }

            },

            {

                extend: 'print',

                exportOptions: {

                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]

                }

            },

            'colvis'

        ]

    } );

} );

</script>


<script type="text/javascript">
$(document).on('change', '#product_cat_id', function() { 
    var id = $(this).val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/product/get_sub_categoty",
        data    : {'id' : id},
        success : function(response){
            if(response != ''){
                $("#product_sub_cat_id").html('').html(response);
                $('.selectpicker').selectpicker('refresh');
            }
        }
    })
}); 
</script>


<script type="text/javascript">
$(document).on('change', '#product_sub_cat_id', function() { 
    var id = $(this).val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/product/get_parent_categoty",
        data    : {'id' : id},
        success : function(response){
            if(response != ''){
                $("#parent_category_id").html('').html(response);
                $('.selectpicker').selectpicker('refresh');
            }
        }
    })
}); 
</script>

<script type="text/javascript">
$(document).on('change', '#parent_category_id', function() { 
    var id = $(this).val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/product/check_bundles_entry",
        data    : {'id' : id},
        success : function(response){
            if(response != ''){
                $("#child_category_id").html('').html(response);
                $('.selectpicker').selectpicker('refresh');
            }
        }
    })
}); 
</script>

<script type="text/javascript">
$(document).on('change', '#product_cat_id, #product_sub_cat_id, #parent_category_id, #child_category_id', function() { 
    var product_cat_id = $('#product_cat_id').val();
    var product_sub_cat_id = $('#product_sub_cat_id').val();
    var parent_category_id = $('#parent_category_id').val();
    var child_category_id = $('#child_category_id').val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/product/get_product",
        data    : {'product_cat_id' : product_cat_id, 'product_sub_cat_id' : product_sub_cat_id, 'parent_category_id' : parent_category_id, 'child_category_id' : child_category_id },
        success : function(response){
            if(response != ''){
                $("#product_id").html('').html(response);
                $('.selectpicker').selectpicker('refresh');
            }
        }
    })
}); 
</script>

</body>

</html>

