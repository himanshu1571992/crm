
<?php init_head(); ?>

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

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin">
                            <?php if(!empty($title)){ echo $title;}?>
                            <a href="<?php echo admin_url('Stock/addstock'); ?>" class="btn btn-info mright5 test pull-right display-block">
                                <?php echo _l('add_stock'); ?>
                            </a>
                        </h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-12 table-responsive">                                                             
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Stock No.</th>
                                            <th>Warehouse Name</th>
                                            <th>Remark</th>
                                            <th>Status</th>
                                            <th>Date Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $z=1;
                                    if(!empty($store_list)){
                                        foreach ($store_list as $key => $row) {
                                            $stock_status = '<span class="btn-sm btn-warning">Pending</span>';
                                            if($row["is_approved"] == 1){
                                                $stock_status = '<span class="btn-sm btn-success">Approved</span>';
                                            }elseif($row["is_approved"] == 2){
                                                $stock_status = '<span class="btn-sm btn-danger">Rejected</span>';
                                            }
                                            $remarks = (!empty($row["remarks"])) ? $row["remarks"] : "--";
                                    ?>
                                            <tr>
                                                <td><?php echo $z++;?></td>
                                                <td><?php echo format_stock_number($row['id']); ?></td>
                                                <td><?php echo cc($row['name']); ?></td>
                                                <td><?php echo $remarks; ?></td>                                             
                                                <td><a href="javascript:void(0);" class="productstockstatus" data-id="<?php echo $row['stockid']; ?>"><?php echo $stock_status; ?></a></td>
                                                <td><?php echo _d($row['created_at']); ?></td>                                               
                                                <td class="text-center">
                                                    <div class="btn-group pull-right">
                                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                            <?php if ($row["is_approved"] != 1){ ?>
                                                                <li>
                                                                    <a href="<?php echo admin_url('Stock/addstock/' . $row['stockid']); ?>" title="edit" >Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a href="<?php echo admin_url('Stock/delete/' . $row['stockid']); ?>" title="delete" >Delete</a>
                                                                </li>
                                                            <?php } ?>
                                                            <li>
                                                                <a href="<?php echo admin_url('Stock/warehousestock?id=' . $row['stockid']); ?>" title="View" >View</a>
                                                            </li>
                                                            <li>
                                                                <a href="<?php echo admin_url('Stock/pdf/' . $row['stockid']); ?>" title="PDF" >Download</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>                                           
                                            </tr>
                                    <?php
                                        }
                                    }else{
                                        echo '<tr><td class="text-center" colspan="7"><h5>Record Not Found</h5></td></tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>      
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>
</div>
<div id="stockassigndata" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Assign Person List</h4>
      </div>
      <div class="modal-body stockassigndata_div">
        
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                   columns: ':visible'
                }
            },
            'colvis',
        ]
    } );

    $(document).on("click", ".productstockstatus", function(){
        var stock_id = $(this).data("id");
        var url = "<?php echo admin_url('stock/get_approval_info'); ?>";
        
        $.ajax({
            type    : "POST",
            url     : "<?php echo admin_url(); ?>stock/get_approval_info",
            data    : {'stock_id': stock_id},
            success : function(response){
                $("#stockassigndata").modal("show");
                $(".stockassigndata_div").html(response);
            }
        })
    });
} );
</script>

</body>
</html>
