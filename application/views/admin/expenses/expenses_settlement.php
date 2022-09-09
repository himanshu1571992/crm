<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form method="post" id="expenses_form" enctype="multipart/form-data" action="<?php echo admin_url('expenses/expenses_settlement'); ?>" >
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <h4 class="no-margin"><?php echo $title; ?></h4>
                            <hr class="hr-panel-heading">
                            <div class="row"><div class="col-md-3 expenses_div" style="font-size:15px;color:red;display:none;">Total Expenses : <span class="ttlexpenses">0</span></div><div class="col-md-3 request_div" style="font-size:15px;color:red;display:none;">Total Requests : <span class="ttlrequests">0</span></div></div>
                            <br><br>
                            <div class="row">
                                
                                <div class="form-group col-md-4">
                                    <label for="staff_id" class="control-label">Employee Name </label>
                                    <select class="form-control selectpicker" required="" data-live-search="true" id="staff_id" name="staff_id">
                                        <option value="" >-- Select All -</option>
                                        <?php
                                        if (!empty($staff_list)) {
                                            foreach ($staff_list as $row) {
                                                ?>
                                                <option value="<?php echo $row->staffid; ?>" <?php if (isset($s_staff) && ($s_staff == $row->staffid)) {
                                            echo 'selected';
                                        } ?> ><?php echo cc($row->firstname); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="expense_type" class="control-label">Expenses</label>
                                    <select class="form-control selectpicker expensesids" required="" multiple="" data-live-search="true" id="expense_id" name="expense_id[]">
                                        <option value="" >-- Select All -</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="category_id" class="control-label">Requests</label>
                                    <select class="form-control selectpicker requestids" required="" multiple="" data-live-search="true" id="request_id" name="request_id[]">
                                        <option value="" >-- Select All -</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-2">
                                    
                                </div>
                            </div>
                            <div class="btn-bottom-toolbar text-right">
                                <input type="submit" class="smt-btn" style="display:none;" >
                                <input type="button" onClick='submitexpensesForm();' class="btn btn-info" value="submit">
                            </div>
                        </div>

                    </div>
                </div>

            </form>
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

    $(document).ready(function () {
        $('#newtable').DataTable({
            "iDisplayLength": 15,
            dom: 'Bfrtip',
            buttons: [
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
                'colvis'
            ]
        });
    });
</script>

</body>
</html>



<script type="text/javascript">
    $(document).on('change', '#staff_id', function () {

        var user_id = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/expenses/get_user_expenses'); ?>",
            data: {'user_id': user_id},
            success: function (response) {
                if (response != '') {
                    $('#expense_id').html(response);
                    $('.selectpicker').selectpicker('refresh');
                }else{
                    $('#expense_id').html('response');
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        });

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/expenses/get_user_request'); ?>",
            data: {'user_id': user_id},
            success: function (response) {
                if (response != '') {
                    $('#request_id').html(response);
                    $('.selectpicker').selectpicker('refresh');
                }else{
                    $('#request_id').html('');
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        });


    });

    $(document).on('change', '#expense_id', function(){
        var ttlexpenses = 0;
        // var amt = $(this).find(':selected').data('amt');

        $("#expense_id :selected").each(function() {
            var amt = $(this).data('amt');
            ttlexpenses = parseInt(ttlexpenses) + parseInt(amt);
        });
        $('.expenses_div').show();
        $('.ttlexpenses').html(ttlexpenses+'.00');
        
    });

    $(document).on('change', '#request_id', function(){
        var ttlrequest = 0;
        // var amt = $(this).find(':selected').data('amt');

        $("#request_id :selected").each(function() {
            var amt = $(this).data('amt');
            ttlrequest = parseInt(ttlrequest) + parseInt(amt);
        });
        $('.request_div').show();
        $('.ttlrequests').html(ttlrequest+'.00');
    });

    function submitexpensesForm(){
        var ttlrequest = parseInt($('.ttlrequests').html());
        var ttlexpenses = parseInt($('.ttlexpenses').html());
        if (ttlrequest >= ttlexpenses){
            // $("#expenses_form").submit();
            $(".smt-btn").click();
        }else{
            alert("Selected request amount must be equal or greater then expense amount");
        }
    }
</script>
