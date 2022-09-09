<?php

$session_id = $this->session->userdata();

init_head();

$get_link = '';
if(!empty($s_fdate) && !empty($s_tdate)){
    $get_link = '?f_date='.$s_fdate.'&t_date='.$s_tdate;
}

?>

<div id="wrapper">

    <div class="content accounting-template">

        <div class="row">
            <div class="col-md-12">

                <div class="panel_s">

                    <div class="panel-body">

                        <h4 class="no-margin"><?php echo $title; ?> 
                        <?php if(check_permission_page(316,'create')){?>
                        <a href="<?php echo admin_url('staffSalesReport/add'); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Add Sales Report</a>
                        <?php } ?>
                        </h4>



                        <hr class="hr-panel-heading">

                        <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>

                        <div class="row">

                            <div class="form-group col-md-3" app-field-wrapper="date">
                            <label for="f_date" class="control-label">From Date</label>
                            <div class="input-group date">
                                <input id="f_date" required="" name="f_date" class="form-control datepicker" value="<?php if(!empty($s_fdate)){ echo $s_fdate; }else{ echo date('d/m/Y'); } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>

                        <div class="form-group col-md-3" app-field-wrapper="date">
                            <label for="t_date" class="control-label">To Date</label>
                            <div class="input-group date">
                                <input id="t_date" required="" name="t_date" class="form-control datepicker" value="<?php if(!empty($s_tdate)){ echo $s_tdate; }else{ echo date('d/m/Y'); } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>

                         

                                                    

                        <div class="col-md-1">                            
                        <button type="submit" style="margin-top: 26px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a style="margin-top: 26px;" class="btn btn-danger" href="">Reset</a>
                        </div>

                        </div>

                        </form>

                        <br>



                        <div class="table-responsive" style="margin-bottom:30px;">
                            <table class="table" id="newtable">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Date</th>
                                        <th>Remark</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if(!empty($sales_report)){
                                        $i=1;
                                        foreach ($sales_report as $value) {
                                    ?>        
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo date('d/m/Y',strtotime($value->salesdate)); ?></td>
                                            <td><?php echo $value->remark; ?></td>
                                            <td class="text-center">                                         
                                                    <a href="<?php echo admin_url('staffSalesReport/view/'.$value->id); ?>" target="_blank" class="btn-sm btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                    <?php if(check_permission_page(316,'edit')){?>
                                                    <a href="<?php echo admin_url('staffSalesReport/add/'.$value->id); ?>" class="actionBtn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    <?php 
                                                    }
                                                    if(check_permission_page(316,'delete')){?>
                                                    <a onclick="return confirm('Are you sure you want to delete this item?'); " href="<?php echo admin_url('staffSalesReport/delete/'.$value->id); ?>" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    <?php } ?>
                                            </td>
                                        </tr>    
                                    <?php
                                        }
                                    }else{
                                        echo '<tr><td class="text-center" colspan="4"><h4>Record Not Found</h4></td></tr>';
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

                    columns: [0,1,2]

                }

            },

            {

                extend: 'pdf',

                exportOptions: {

                     columns: [0,1,2]

                }

            },

            {

                extend: 'print',

                exportOptions: {

                    columns: [0,1,2]

                }

            },

            'colvis',

        ]

    } );

} );

</script>





</html>

<script type="text/javascript">
    $(document).on('change', '#client_id', function() {   
       var client_id = $(this).val();

       $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/Invoices/get_branch'); ?>",
            data    : {'client_id' : client_id},
            success : function(response){
                if(response != ''){                   
                     $('#client_branch').html(response);  
                     $('.selectpicker').selectpicker('refresh');
                }
            }
        })

    }); 
</script>