<?php init_head(); ?>
<style>
    .title-panel {
        font-size: 15px;
        color:#03a9f4;
    }
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php //echo form_open_multipart(admin_url('expenses/approve_all_expense'), array('id' => 'unit-form', 'class' => 'proposal-form', 'onsubmit' => '')); ?>
            <form action="<?php echo admin_url('expenses/approve_all_expense');?>" class="proposal-form" id="request_form" enctype="multipart/form-data" method="post" accept-charset="utf-8" onsubmit="return confirm('Do you really want to take action ?');">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="panel_s panel-body">
                                        <div class="col-md-12">
                                            <label for="id" class="title-panel">ID :</label> <span><?php echo (isset($expense_data[0])) ? "EXP-".number_series($expense_data[0]['id']) : '--'; ?></span>
                                        </div>
                                        <div class="col-md-12">    
                                            <label for="expense_date" class="title-panel">Expense Date :</label> <span><?php echo (isset($expense_data[0])) ? $expense_data[0]['date'] : '--'; ?></span>
                                        </div>
                                        <div class="col-md-12">    
                                            <label for="submitted_date" class="title-panel">Submitted Date :</label> <span><?php echo (isset($expense_data[0])) ? $expense_data[0]['submitted_date'] : '--'; ?></span>
                                        </div>
                                        <div class="col-md-12">    
                                            <label for="added_by" class="title-panel">Added By :</label> <span><?php echo (isset($expense_data[0])) ? $expense_data[0]['added_by'] : '--'; ?></span>
                                        </div>
                                        <div class="col-md-12">     
                                            <label for="total_amt" class="title-panel">Total Amount :</label> &#8377; <span class="expense-amt">0.00</span>
                                        </div>
                                    </div>    
                                </div>
                                <div class="col-md-6">
                                    <div class="panel_s panel-body">
                                        <?php if ($approved_status > 0){ ?>
                                            <div class="col-md-12">
                                                <label for="Status" class="title-panel">Status :</label> <span <?php echo ($approved_status == '1') ? 'class="label label-success"': 'class="label label-danger"'; ?>><?php echo ($approved_status == '1') ? 'Approved': 'Rejected'; ?></span>
                                            </div>
                                        <?php } ?>    
                                        <div class="col-md-12">
                                            <label for="approved_by" class="title-panel">Approved / Rejected By :</label> <span><?php echo (isset($expense_data[0]) && !empty($expense_data[0]['approved_by'])) ? $expense_data[0]['approved_by'] : '--'; ?></span>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="approved_date" class="title-panel">Approved / Rejected Date :</label> <span><?php echo (isset($expense_data[0]) && !empty($expense_data[0]['approved_date'])) ? $expense_data[0]['approved_date'] : '--'; ?></span>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="approved_remark" class="title-panel">Approved / Rejected Remark :</label> <span><?php echo (isset($expense_data[0]) && !empty($expense_data[0]['remark'])) ? $expense_data[0]['remark'] : '--'; ?></span> 
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            <div class="col-md-12 table-responsive">																
								<table class="table" id="newtable">
									<thead>
                                        <tr>
                                            <th width="1%">S.No</th>
                                            <th>Expense ID</th>
                                            <th>Expense Head</th>
                                            <th>Expense Type</th>
                                            <th>Total Amount</th>
                                            <th>Paid By</th>
                                            <th>Action</th>
                                        </tr>
									</thead>
									<tbody>
                                        <?php 
                                            $ttl_amount = 0;
                                            if (!empty($expense_data)){
                                                foreach ($expense_data as $key => $value) {
                                                    $ttl_amount +=$value['amount'];
                                                    $expense_number = 'EXP-'.get_short(get_expense_category($value['category_id'])).'-'.number_series($value['id']);
                                        ?>
                                                    <tr>
                                                        <td><?php echo ++$key; ?></td>
                                                        <td><?php echo $expense_number; ?></td>
                                                        <td><?php echo $value['head_name']; ?></td>
                                                        <td><?php echo $value['type_name']; ?></td>
                                                        <td>&#8377; <?php echo number_format($value['amount'], 2, '.', ','); ?></td>
                                                        <td><?php echo $value['paid_by']; ?></td>
                                                        <td>
                                                            <a href="javascript:void(0);" onclick="get_expense_details('<?php echo $value['id']; ?>', '<?php echo $value['category_id']; ?>', '<?php echo $approved_status; ?>');" class="btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                                            <a href="javascript:void(0);" onclick="get_expense_attachment('<?php echo $value['id']; ?>');" class="btn-sm btn-success">Attachment (<?php echo $value['file_count']; ?>)</a>
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
                        <?php if ($approved_status == 0){ ?>
                            <div class="btn-bottom-toolbar text-right">
                                <input type="hidden" name="expense_id" value="<?php echo (isset($expense_data[0]) && !empty($expense_data[0]['id'])) ? $expense_data[0]['id'] : 0; ?>">
                                <button class="btn btn-info" type="submit" name="approve_status" value="1">Approve</button>
                                <button class="btn btn-danger" type="submit" name="approve_status" value="2">Reject</button>
                            </div>
                        <?php } ?>    
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin">Read By Details</h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" >
                                    <ul class="list-group list-group-flush">
                                        <?php 
                                            if (!empty($read_by_user_list)){
                                                foreach ($read_by_user_list as $staff) {
                                        ?>
                                                    <li class="list-group-item col-md-6">
                                                        <label for="id" class="col-3 title-panel">Read By : &nbsp;&nbsp;</label>
                                                        <span><?php echo $staff["name"]; ?>&nbsp;<span class="text-danger">(<?php echo $staff["read_date"]; ?>)</span></span>
                                                    </li>
                                        <?php            
                                                }
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <?php if ($approved_status == 0){ ?> 
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <h4 class="no-margin">Approve/Reject Remark</h4>
                            <hr class="hr-panel-heading">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group" app-field-wrapper="remark">
                                                <label class="control-label"> Remark </label>
                                                <textarea id="remark" required="" name="remark" class="form-control" rows="4"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>                 
            <?php //echo form_close(); ?>
            </form>    
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>
<div id="expense-details" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content expense-content">
            
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });

    var ttl_amount = '<?php echo number_format($ttl_amount, 2, '.', ','); ?>';
    $('.expense-amt').html(ttl_amount);

    function get_expense_details(expenseid, category_id, approved_status){
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url('admin/expenses/get_expenses_details'); ?>",
            data    : {'expense_id': expenseid, 'category_id' : category_id, 'approve_status': approved_status},
            success : function(response){
                if(response != ''){

                    $(".expense-content").html('').html(response);
                    $("#expense-details").modal("show");
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        });
    }
    function get_expense_attachment(expenseid){
        $.ajax({
            type    : "GET",
            url     : "<?php echo base_url('admin/expenses/get_expense_attachment/'); ?>"+expenseid,
            success : function(response){
                if(response != ''){
                    $(".expense-content").html('').html(response);
                    $("#expense-details").modal("show");
                }
            }
        });
    }
</script>

</body>
</html>
