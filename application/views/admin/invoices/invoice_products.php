<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin"><?php echo $title; ?> </h4>



                    <hr class="hr-panel-heading">

                    <div class="row">
                    
                        <div class="table-responsive">
                        
                            
                            <div class="col-md-12">                                                             
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Invoice No.</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Value</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $ttl_value = 0;
                                    if(!empty($parent_invoice)){
                                        $i=1;                                        
                                        foreach($parent_invoice as $parent){  

                                            $check_invoice_rent_item = check_proposal_item($parent->id,0,'invoice');
                                            $check_invoice_sale_item = check_proposal_item($parent->id,1,'invoice');

                                            if($check_invoice_rent_item>=1){
                                              $type = 'rent';
                                            }elseif($check_invoice_sale_item>=1){
                                              $type = 'sale';
                                            }

                                            $item_info = get_invoice_items_list($parent->id,$type,'invoice');
                                            
                                            if(!empty($item_info)){
                                                foreach ($item_info as $row) {

                                                    $isOtherCharge = value_by_id('tblproducts',$row['pro_id'],'isOtherCharge');

                                                    if($isOtherCharge == 0){

                                                            $value = get_material_value($row['pro_id'],$row['qty']);
                                                            $ttl_value += $value;
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $i++;?></td>
                                                            <td><a target="_blank" href="<?php echo admin_url('invoices/download_pdf/'.$parent->id.'/?output_type=I');?>"><?php echo $parent->number; ?></a></td>
                                                            <td><?php echo $row['description']; ?></td>                                               
                                                            <td><?php echo $row['qty']; ?></td>                                               
                                                            <td><?php echo $value; ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                            
                                            <?php
                                        }
                                    }
                                    ?>
                                      
                                     
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="text-center" colspan="4"><b>Total Value</b></td>
                                            <td><b><?php echo $ttl_value; ?></b></td>
                                        </tr>
                                    </tfoot>
                                  </table>
                            </div>
                        
                        

                               
                            </div>
                             <!-- <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" value="1" name="mark" type="submit">
                                <?php echo _l('submit'); ?>
                            </button>
                        </div> -->
                        </div>
                       
                    </div>
                </div>
             
            <?php echo form_close(); ?>
        </div>      
        <div class="btn-bottom-pusher"></div>
    </div>
</div>

<?php init_tail(); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

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
        
    } );
} );
</script>
</body>
</html>


<script type="text/javascript">
    $(document).on('click', '.handover', function() {  

    var handover_id = $(this).val(); 
    if(handover_id > 0 ){
          $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/handover/get_handover_data'); ?>",
            data    : {'handover_id' : handover_id},
            success : function(response){
                if(response != ''){       

                     
                     $('#handover_data').html(response);  
                }
            }
        })  
    }
    

});    
</script>
