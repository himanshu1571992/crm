<?php
$session_id = $this->session->userdata();
init_head();
?>
<style type="text/css">

    .ui-table > thead > tr > th {
        border:1px solid #9d9d9d !important;
        color: #fff !important;
        background:#6d7580;
    }

    .ui-table > tbody > tr > td{
        border: 1px solid #c7c7c7;
        color:#5f6670;
    }

    .ui-table > tbody > tr:nth-child(even) {
      background: #f8f8f8;
    }

    .actionBtn {
        border: 1px solid #6d7580;
        padding: 8px 10px;
        border-radius: 3px;
        background:#6d7580;
        color:#fff;
        margin-right: 3px;
    }

    .actionBtn:hover {
        background:#51647c;
        color:#fff;
    }

</style>
<?php
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


						<br>

						<div class="tabel-responsive" style="margin-bottom:30px;">
                  		    <table class="table" id="newtable">
                                <thead>
                                    <tr>
                                    	<th align="center">S.No</th>
                                    	<th align="center">Product Name</th>
                                    	<th align="center">Service Type</th>
                                    	<th align="center">Client Name</th>
                                        <th align="center">Quantity</th>

                                    </tr>
                                </thead>

                            	<tbody class="ui-sortable">
                        		<?php
								if(!empty($client_list)){
									$i=1;
									$ttl_qty = 0;
									foreach ($client_list as $row) {

										if($service_type == 1){
											$service_type_name = 'Rent';
										}elseif($service_type == 2){
											$service_type_name = 'Sale';
										}elseif($service_type == 3){
											$service_type_name = 'Rent & Sale Both';
										}
                                            if ($used_for == 'proposal'){
                                               $client_name = trim($row->proposal_to);
                                               $client_info = $this->db->query("SELECT `userid` FROM `tblclientbranch` where `client_branch_name`='".$client_name."' ")->row();
                                               $client_id = (!empty($client_info)) ? $client_info->userid : 0;
                                            }elseif ($used_for == 'material_receipt'){
                                               $vendore_info = $this->db->query("SELECT `name` FROM `tblvendor` where `id`='".$row->vendor_id."' ")->row();
                                               $client_name = (!empty($vendore_info)) ? $vendore_info->name : '--';
                                               $client_id = $row->vendor_id;
                                            }else{
                                               $client_info = $this->db->query("SELECT `client_branch_name` FROM `tblclientbranch` where `userid`='".$row->clientid."' ")->row();
                                               $client_name = (!empty($client_info)) ? $client_info->client_branch_name : '--';
                                               $client_id = $row->clientid;
                                            }
                                            if ($client_id > 0){
                        						            $sale_qty = get_product_sales_quantity_client($f_date,$t_date,$service_type,$product_id,$client_id, $used_for);
                                            }else{
                                                $sale_qty = get_product_sales_quantity_client($f_date,$t_date,$service_type,$product_id,$client_name, $used_for);
                                            }
										$ttl_qty += $sale_qty;
										?>
											<tr>
												<td align="center"><?php echo $i; ?></td>
												<td align="center"><a target="_blank" href="<?php echo admin_url('product_new/view/'.$product_id); ?>"><?php echo value_by_id('tblproducts',$product_id,'name'); ?></a></td>
												<td align="center"><?php echo $service_type_name; ?></td>
												<td align="center">
                          <?php  if ($used_for == 'material_receipt'){
                            ?>
                            <a target="_blank" href="<?php echo admin_url('vendor/vendor_profile/'.$client_id); ?>"><?php echo $client_name; ?></a>
                            <?php
                          } else if ($client_id > 0){ ?>
                            <a target="_blank" href="<?php echo admin_url('ClientBranch/branch/'.$client_id); ?>"><?php echo $client_name; ?></a>
                          <?php }else{
                            echo $client_name;
                          } ?>
                        </td>
												<td align="center">
                          <?php if ($client_id > 0){ ?>
                              <button type="button" used_for="<?php echo $used_for; ?>" f_date="<?php echo $f_date; ?>" t_date="<?php echo $t_date; ?>" service_type="<?php echo $service_type; ?>" product_id="<?php echo $product_id; ?>" client_id="<?php echo $client_id; ?>" class="btn btn-info qty" data-toggle="modal" data-target="#myModal"><?php echo number_format($sale_qty, 2, '.', ''); ?></button>
                          <?php }else{ ?>
                              <button type="button" used_for="<?php echo $used_for; ?>" f_date="<?php echo $f_date; ?>" t_date="<?php echo $t_date; ?>" service_type="<?php echo $service_type; ?>" product_id="<?php echo $product_id; ?>" client_id="<?php echo $client_name; ?>" class="btn btn-info qty" data-toggle="modal" data-target="#myModal"><?php echo number_format($sale_qty, 2, '.', ''); ?></button>
                          <?php } ?>
                        </td>
											</tr>

										<?php
										$i++;

									}
								}else{
									echo '<tr><td colspan=5 align="center" ><b>Record Not Found!</b></td></tr>';
								}
								?>
								</tbody>
							        <tfoot>
							            <tr>
							                <th align="right" colspan="4">Total</th>
											<td align="center"><b><?php echo number_format($ttl_qty, 2, '.', ''); ?></b></td>
							            </tr>
							        </tfoot>
							 </table>
						 </div>


                    </div>
                </div>


            </div>
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>
    <?php init_tail(); ?>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Product Rate Details</h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

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
            'colvis'
        ]
    } );
} );
</script>


</html>


<script type="text/javascript">
    $(document).on('click', '.qty', function()
    {
        var client_id = $(this).attr('client_id');
        var f_date = $(this).attr('f_date');
        var t_date = $(this).attr('t_date');
        var service_type = $(this).attr('service_type');
        var product_id = $(this).attr('product_id');
        var used_for = $(this).attr('used_for');

        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/report/product_rate_modal'); ?>",
            data    : {'client_id' : client_id,'f_date' : f_date,'t_date' : t_date,'service_type' : service_type,'product_id' : product_id, 'used_for' : used_for},
            success : function(response){
                if(response != ''){
                     $('.modal-body').html(response);
                }
            }
        });
    });
</script>
