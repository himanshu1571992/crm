<?php init_head(); ?>


<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">
             
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">
                    <div> <h3>Unverified Products</h3></div>
                    <hr class="hr-panel-heading">

                    <div class="row"  style="margin-top: 30px;">
                    
              
                        <div class="">
                        
                            
                            <div class="col-md-12 table-responsive">

                            <div class="row" style="margin-top: 15px;">
                            </div>                                                             
                                <table class="table" id="newtable" style="margin-top: 30px;">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Product Name</th>
                                        <th>Pro ID</th>
                                        <th>Unit</th>
                                        <th>Category</th>
                                        <th>Picture</th>
                                        <th>Status</th>
                                        <th>Verified</th>
                                        <th>Date Created</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i=1;
                                    if(!empty($product_data)){                                        
                                        foreach($product_data as $aRow){
                                           $check_pro_details = check_products_details($aRow['id']);
                                           if ($check_pro_details == 0){
                                               $url = admin_url('product_new/product/' . $aRow['id']);
                                            $detail_url = admin_url('product_new/product_used/' . $aRow['id']);

                                            $img_url = base_url('assets/images/no_image_available.jpeg');
                                            if($aRow['photo'] != "") {
                                                $img_url = base_url('uploads/product') . "/" . $aRow['photo'];
                                            }

                                            if($aRow['is_varified'] == 1){
                                                $is_varified = '<button disabled="" class="btn-sm btn-success">Verified</button>';
                                            }else{
                                                $is_varified = '<button disabled="" class="btn-sm btn-danger">Pending</button>';
                                            }

                                            $checked = ($aRow['status'] == 1 ) ? 'checked' : '';  
                                            $toggleActive = '<div class="onoffswitch">
                                                <input type="checkbox" data-switch-url="' . admin_url() . 'product_new/change_product_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $aRow['id'] . '" data-id="' . $aRow['id'] . '" ' . $checked . '>
                                                <label class="onoffswitch-label" for="' . $aRow['id'] . '"></label>
                                            </div>';

                                            $name_html = '<a href="' . $url . '">' . cc($aRow['name']) . '</a>';
                                            $name_html .= '<div class="row-options">';
                                            $name_html .= '<a target="_blank" href="' . $detail_url . '">Details</a>';
                                            $name_html .= '</div>';
                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $name_html; ?></td>
                                                <td><?php echo "PRO-" .number_series($aRow['id']); ?></td>
                                                <td><?php echo cc(value_by_id('tblunitmaster',$aRow['unit_2'],'name'));?></td>
                                                <td><?php echo cc(value_by_id('tblproductcategory',$aRow['product_cat_id'],'name'));?></td>
                                                <td><?php echo '<img src="' . $img_url . '" class="image-responsive" style="height: 100px; width : 100px;" alt="' . cc($aRow['name']) . '" />';?></td>
                                                <td><?php echo $toggleActive;?></td>
                                                <td><?php echo $is_varified;?></td>
                                                <td><?php echo _d($aRow['created_at']);?></td>
                                              </tr>
                                            <?php
                                           }
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
             
            <?php echo form_close(); ?>
        </div>      
        <div class="btn-bottom-pusher"></div>
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
        
        "iDisplayLength": 25,
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [  
            'pageLength',        
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4]
                }
            },
            'colvis',
        ]
    } );
} );


</script>
</body>
</html>
