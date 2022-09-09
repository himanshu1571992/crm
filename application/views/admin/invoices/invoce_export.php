
<?php init_head(); ?>

<style type="text/css">

    .ui-table > thead > tr > th {
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
        border: 1px solid #2196F3;
        padding: 5px;
        border-radius: 3px;
        background: #2196F3;
        color: #fff;
        margin-right: 3px;
        margin-bottom: 3px;
        display: inline-block;
        font-size: 12px;
    }

    .actionBtn:hover {
        border: 1px solid #2196F3;
        background:#51647c;
        color:#fff;
    }

    .delete-btn{
        border: 1px solid #f33224;
        padding: 5px;
        border-radius: 3px;
        background: #f33224;
        color: #fff;
        margin-right: 3px;
        margin-bottom: 3px;
        display: inline-block;
        font-size: 12px;
    }

    .delete-btn:hover{
        color: #fff;
    }

    .staus_process {
        display: inline-block;
        color: #fff;
        padding: 8px 15px;
        font-size: 14px;
        box-shadow: 0px 3px 8px #ccc;    
        display: block;
        margin: 5px;
    }
     .scroll {
        width:200px;
        max-height:450px;
        overflow-y:auto;
}
.dropdown-menu-right {
    right: auto;
    left: 0;
}
</style>
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" type="text/css" />
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" type="text/css" />
<style>
    fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}
</style>
<?php
if(!empty($this->session->userdata('lead_search'))){
    $search_arr = $this->session->userdata('lead_search');
}    
?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin">Transport Charges Not Updated (22-23)</h4>

                    <hr class="hr-panel-heading">

                    <div class="row">
                    
                    <div >
                        
                                            
                                             
                    </div>
                                                
                    <div class="col-md-12"> 
                        
                        
                        <div class="table-responsive">
                        <table class="table" id="newtable">
                            <thead>
                              <tr>
                                <th>S.No</th>
                                <th>Invoice Number</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($invoice_list)){
                                $i = 1;
                                foreach ($invoice_list as $key => $value) {
                                        
                                    $product_info = $this->db->query("SELECT * FROM tblitems_in WHERE rel_type = 'invoice' and pro_id IN (798,865,866) and  rel_id = '".$value->id."' ")->row();
                                                                      
                                    if(empty($product_info)){
                                ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>     
                                    <td><a href="<?php echo admin_url('invoices/invoices/'.$value->id) ?>" target="_blank"><?php echo $value->number;  ?></a></td>    
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
</div>


<?php init_tail(); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
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

<script src="<?php  echo base_url(); ?>assets/plugins/jquery.filer/js/jquery.filer.min.js" type="text/javascript"></script>
</body>
</html>


<script>

$(document).ready(function() {
    $('#newtable').DataTable( {
        "iDisplayLength": 15,
        dom: 'Bfrtip',
        buttons: [           
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5, 6]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6]
                }
            },
            'colvis'
        ]
    } );
} );
</script>