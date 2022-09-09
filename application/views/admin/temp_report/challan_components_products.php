<?php
$session_id = $this->session->userdata();
init_head();

$s_year = '';
$s_type = '';

if(!empty($year_id)){
  $s_year = $year_id;
}
if(!empty($service_type)){
  $s_type = $service_type;
}
?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            
      
            <div class="col-md-12">
               
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?></h4>

                        <hr class="hr-panel-heading">
						
						

						<div class="tabel-responsive" style="margin-bottom:30px;">
                  		    <table class="table" id="newtable">
                                <thead>
                                    <tr>
                                    	<th align="center">S.No</th>
                                    	<th align="center">Product ID</th>
                                    	<th align="center">Product Name</th>  
                                    </tr>
                                </thead>

                            	<tbody class="ui-sortable">
                        		<?php
								if(!empty($product_list)){
									$i=1;									
									foreach ($product_list as $row) {
										?>
											<tr>
												<td align="center"><?php echo $i; ?></td>
												<td align="center"><a target="_blank" href="<?php echo admin_url('product_new/product_used/'.$row->component_id); ?>"><?php echo "PRO - " . number_series($row->component_id); ?></a></td>
												<td align="center"><a target="_blank" href="<?php echo admin_url('product/product/'.$row->component_id); ?>"><?php echo get_product_name($row->component_id); ?></a></td>
											</tr>	
										<?php	
										$i++;

									}
								}
								?>
								</tbody>
							 </table>
						 </div>

						
                    </div>
                </div>
               

            </div>
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>
    <?php init_tail(); ?>
   
</body>


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
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            },
            'colvis',
        ]
    } );
} );
</script>


</html>
