

<?php init_head(); ?>

<div id="wrapper" class="customer_profile">

<div class="content">

   <div class="row">

      <div class="col-md-2">

         <div class="panel_s mbot5">

            <div class="panel-body padding-10">

               <h4 class="bold">Product Sale</h4>

            </div>

         </div>

         <?php echo prodcutwise_sale_report_tab('pi');?>

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


              <div class="col-md-3">
                    <div class="form-group ">
                        <select class="form-control selectpicker" id="lead_source" name="lead_source" data-live-search="true">
                            <option value="" disabled selected >--Select Source-</option>
                            <?php
                            if(!empty($sources_info)){
                                foreach ($sources_info as $value) {
                                    ?>
                                    <option value="<?php echo $value->id; ?>" <?php if(!empty($search_arr['lead_source']) && $search_arr['lead_source'] == $value->id){ echo 'selected';} ?>><?php echo cc($value->name); ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>


            <div class="col-md-3">
              <div class="input-group date">
                <input id="f_date" placeholder="From date" name="f_date" class="form-control datepicker" value="<?php if(!empty($f_date)){ echo $f_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
              </div>
            </div>

              <div class="col-md-3">
                <div class="input-group date">
                    <input id="t_date" placeholder="To date" name="t_date" class="form-control datepicker" value="<?php if(!empty($t_date)){ echo $t_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                </div>
              </div> 


            

            <div class="col-md-1">                            
            <button type="submit" class="btn btn-info">Search</button>
            </div>
            <div class="col-md-1">
             <a class="btn btn-danger" href="" style="margin-left: 20px">Reset</a>
            </div>

            </form>



            <div class="col-md-12 table-responsive"> 
            <hr> 
                <table class="table" id="newtable">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Product Name</th>
                      <th>Product Code #</th>
                      <th>Rent Qty</th>
                      <th>Sale Qty</th>
                      <th>Total Qty</th>
                    </tr>
                  </thead>
                 <tbody>

                  <?php

                  if(!empty($lead_list)){

                      foreach ($lead_list as $key => $value) {
                         $total_qty = ($value->rent_qty+$value->sale_qty);
                      ?>

                      <tr>
                          <td><?php echo ++$key; ?></td>  
                          <td><a target="_blank" href="<?php echo admin_url('product_new/view/'.$value->product_id);?>"><?php echo value_by_id('tblproducts',$value->product_id,'name'); ?></a></td>
                          <td><?php echo 'PRO-'.$value->product_id; ?></td>                       
                          <td class="text-center"><?php echo $value->rent_qty; ?></td>                       
                          <td class="text-center"><?php echo $value->sale_qty; ?></td>
                          <td class="text-center"><?php echo $total_qty; ?></td>
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
                  columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                  columns: ':visible'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                  columns: ':visible'
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

