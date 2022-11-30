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
    @media (max-width: 500px){
        .btn-bottom-toolbar {
            width: 100%;
        }
    }    
    @media (max-width: 768px){
        .btn-bottom-toolbar {
            width: 100%;
        }
    } 
</style>

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?></a></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="">
                                <div class="col-md-12">                                                             
                                    <div class="table-responsive">                                                         
                                        <table class="table" id="newtable">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Name</th>
                                                    <th>Sales Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($standard_rate_list)) {
                                                    $i = 1;
                                                    foreach ($standard_rate_list as $row) {
                                                        ?>
                                                        <tr>
                                                            <td width="1%"><?php echo $i++; ?></td>
                                                            <td class="categoryname<?php echo $row->id; ?>"><?php echo cc($row->name); ?></td>
                                                            <td class="price<?php echo $row->id; ?>"><input type="text" class="form-control" name="rate[<?php echo $row->id; ?>][price]" value="<?php echo ($row->price > 0.00) ? $row->price : ""; ?>"> </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                } else {
                                                    echo '<tr><td class="text-center" colspan="3"><h5>Record Not Found</h5></td></tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo 'Submit'; ?>
                            </button>
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
<script>
$(document).ready(function() {
    $('#newtable').DataTable( {
        
        "iDisplayLength": 25,
        dom: 'Bfrtip'
    } );
} );
</script>
</body>
</html>
