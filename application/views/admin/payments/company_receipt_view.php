<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'company_receipt_form', 'class' => 'company-receipt-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4><?php echo $title; ?>
                    <a href="<?php echo admin_url('payments/company_receipt'); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Add Company Receipt</a></h4>
                        

                    <hr class="hr-panel-heading">

                    <div class="row">
                    
                                                
                    <div class="col-md-12"> 
                            
                        <div class="table-responsive">                                                    
                        <table class="table" id="newtable">
                            <thead>
                              <tr>
                                <th>S.No</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>UTR No</th>
                                <th>Date</th>
                                <th>Remark</th>
                                <th class="text-center">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($comapany)){
                               foreach ($comapany as $key => $value) {
                             ?>
                                <tr>
                                    <td><?php echo ++$key; ?></td>                                                
                                    <td><?php if($value->type == 1){ echo "General Receipt";} else { echo "Internal Point Transfer";} ?></td>
                                    <td><?php echo $value->amount; ?></td>
                                    <td><?php echo $value->utr_no; ?></td>
                                    <td><?php echo _d($value->date); ?></td>
                                    <td><?php echo $value->remark; ?></td>
                                    <td class="text-center">
                                      <div class="btn-group pull-right">
                                      <a class="btn btn-info" href="<?php echo admin_url('payments/company_receipt/'.$value->id); ?>">EDIT</a>
                                      </div>
                                    </td>
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
             
            <?php echo form_close(); ?>
        </div>      
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
</div> 
<!-- Email Modal -->

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
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [  
            'pageLength',        
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                }
            },
            'colvis',
        ]
    } );
} );

</script>

</body>
</html>

