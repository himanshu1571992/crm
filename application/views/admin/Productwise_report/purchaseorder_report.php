

<?php init_head(); ?>

<div id="wrapper" class="customer_profile">

<div class="content">

   <div class="row">

      <div class="col-md-2">

         <div class="panel_s mbot5">

            <div class="panel-body padding-10">

               <h4 class="bold">Product Wise</h4>

            </div>

         </div>

         <?php echo prodcutwise_report_tab('purchaseorder');?>

      </div>

      

            <div class="col-md-10">

                <div class="panel_s">

                    <div class="panel-body">



                    <div class="col-md-4"><h4 class="no-margin"> </h4></div>  



                   <h4 class="no-margin"><?php echo $title; ?></h4>



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

              



              <div class="form-group col-md-2">
                    <select class="form-control selectpicker" data-live-search="true" name="status">
                         <option value="" selected >--Select Status-</option>
                        <option value="0" <?php if(isset($s_status) && $s_status == 0){ echo 'selected'; } ?>>Pending</option>
                        <option value="1" <?php if(isset($s_status) && $s_status == 1){ echo 'selected'; } ?>>Approved</option>
                        <option value="2" <?php if(isset($s_status) && $s_status == 2){ echo 'selected'; } ?>>Rejected</option>
                        <option value="3" <?php if(isset($s_status) && $s_status == 3){ echo 'selected'; } ?>>Cancelled</option>
                    </select>
                </div>



             <div class="col-md-2">

               <div class="input-group date">

                    <input id="f_date" placeholder="From date" name="f_date" class="form-control datepicker" value="<?php if(!empty($f_date)){ echo $f_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>

                </div>

              </div>

              <div class="col-md-2">

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

            <hr>                             

                <table class="table" id="newtable">
                  <thead>
                    <tr>
                    <th>S.No.</th>
                    <th>Number</th>
                    <th>Vendor</th>
                    <th>Warehouse/Site</th>
                    <th>Date</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $ttl_amt=0;
                  if(!empty($purchaseorder_list)){
                    $z=1;
                    
                    foreach($purchaseorder_list as $row){ 
                       $ttl_amt += $row->totalamount;

                      if($row->status == 0){
                        $status = 'Pending';
                        $cls = 'btn-warning';
                      }elseif($row->status == 1){
                        $status = 'Approved';
                        $cls = 'btn-success';
                      }elseif($row->status == 2){
                        $status = 'Rejected';
                        $cls = 'btn-danger';
                      }

                      $can_edit = $this->db->query("SELECT * from tblpurchaseorderapproval where po_id = '".$row->id."' and (approve_status = 1 || approve_status = 2) ")->row_array();

                      $sub_po_exist = $this->db->query("SELECT id FROM `tblpurchaseorder` where id IN (".$row->parent_ids.") and id != '".$row->id."' ")->row();
                      ?>                                            
                      <tr>
                        <td><?php echo $z++;?></td>
                        <td><a target="_blank" href="<?php  echo admin_url('purchase/download_pdf/'.$row->id); ?>"><?php echo 'PO-'.$row->number;?></a></td>
                        <td><?php echo cc(value_by_id('tblvendor',$row->vendor_id,'name'));?></td>
                        <td>
                                                <?php 
                                                if($row->source_type ==1) {
                                                    echo cc(value_by_id('tblwarehouse',$row->warehouse_id,'name'));
                                                }else{
                                                    echo cc(value_by_id('tblsitemanager',$row->site_id,'name'));
                                                } 
                                                ?>                                                    
                                                </td>
                        <td><?php echo date('d/m/Y',strtotime($row->date)); ?></td>
                        <td><?php echo $row->totalamount;?></td>
                       
                        <td>
                          <?php
                          if($row->cancel == 1){
                            echo '<button disabled class="btn-sm btn-danger">Cancelled</button>';
                          }elseif($row->revised == 1){
                                                        echo '<button disabled class="btn-sm btn-info">Revised</button>';
                                                    }else{
                            echo '<button type="button" class="'.$cls.' btn-sm status" value="'.$row->id.'" disabled>'.$status.'</button>';
                            
                          }
                          ?>
                        </td> 
                        
                        
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
                                              <td align="" colspan="5">Total</td>
                                              <td align=""><b><?php  echo number_format($ttl_amt, 2, '.', ''); ?></b></td>
                                              <td align="center" colspan="3"></td>
                                          </tr>
                                    </tfoot>
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

