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
                        <h4 class="no-margin"><?php echo $title; ?></h4>
                        <hr class="hr-panel-heading">
                            <div class="form-group col-md-3" app-field-wrapper="date">
                                <h4>Employee Name : </h3>
                                <?php echo (isset($sales_report_info)) ? get_employee_fullname($sales_report_info->staff_id): "--"; ?>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3" app-field-wrapper="date">
                                <h4>Date : </h3>
                                <?php echo (isset($sales_report_info)) ? db_date($sales_report_info->salesdate) : date("d/m/Y"); ?>
                            </div>
                            <div class="form-group col-md-3" app-field-wrapper="date">
                                <h4>Remark : </h3>
                                <?php echo (isset($sales_report_info)) ? $sales_report_info->remark : "--"; ?>
                            </div>
                            
                            </div>
                        <br>
                        <div class="table-responsive" style="margin-bottom:30px;">
                            <table class="table" id="newtable">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Client Name</th>
                                        <th>Contact Person</th>
                                        <th>Contact no.</th>
                                        <th>Email Id</th>
                                        <th>Address</th>
                                        <th>Industry</th>
                                        <th>Products</th>
                                        <th>Remark</th>
                                        <th>File</th>
                                      </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if(!empty($sales_details)){
                                        $i=1;
                                        foreach ($sales_details as $value) {

                                            $clientname = ($value->clientname) ? $value->clientname : "--";
                                            if (isset($value->client_id)){
                                                $clientinfo = client_info($value->client_id);
                                                $clientname = $clientinfo->client_branch_name;
                                            }
                                            
                                            if($value->product_category_id == 0)
                                            {
                                               $product_name = ($value->product_name) ? $value->product_name : "--";
                                            }
                                            else
                                            {
                                                $product_name = value_by_id('tblsalesproductmaster',$value->product_category_id,'product_name');
                                            }
                                    ?>        
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $clientname; ?></td>
                                            <td><?php echo ($value->contact_person) ? $value->contact_person : "--"; ?></td>
                                            <td><?php echo ($value->contact_number) ? $value->contact_number : "--"; ?></td>
                                            <td><?php echo ($value->email_id) ? $value->email_id : "--"; ?></td>
                                            <td><?php echo ($value->address) ? $value->address : "--"; ?></td>
                                            <td><?php echo ($value->industry) ? $value->industry : "--"; ?></td>
                                            <td><?php echo $product_name; ?></td>
                                            <td><?php echo ($value->remark) ? $value->remark : "--"; ?></td>
                                            <td><a target="_blank" href="<?php echo site_url('uploads/sales_report/'.$value->id.'/'.$value->upload_file); ?>"><?php echo $value->upload_file;  ?></a></td>
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

                    columns: [0,1,2,3,4,5,6,7,8]
                    // columns: ':visible'

                }

            },
            'colvis',

        ]

    } );

} );

</script>
</html>
