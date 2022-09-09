<?php init_head(); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<style>
    .hold {
        color: #fff;
        background-color: #e8bb0b;
    }
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <h4 class="no-margin"><?php echo $title; ?></h4>
                            <hr class="hr-panel-heading">
                            <div class="row">
                                <?php echo form_open($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
                                    <div class="col-md-12">
                                      <div class="form-group col-md-3">
                                          <label for="category_id" class="control-label">Expense Category *</label>
                                          <select class="form-control selectpicker" data-live-search="true" required="" id="category_id" name="category_id">
                                              <option value=""></option>
                                              <?php
                                              if(!empty($category_info)){
                                                  foreach ($category_info as $key => $value) {
                                                     ?>
                                                       <option value="<?php echo $value->id; ?>" <?php echo (isset($category_id) && $category_id == $value->id) ? 'selected':''; ?>  ><?php echo cc($value->name); ?></option>
                                                     <?php
                                                  }
                                              }
                                              ?>
                                          </select>
                                      </div>
                                      <div class="form-group col-md-3">
                                          <label for="category_id" class="control-label">Party</label>
                                          <select class="form-control selectpicker" data-live-search="true" id="party_id" name="party_id">
                                              <option value=""></option>
                                              <?php
                                                  if (isset($party_list) && !empty($party_list)){
                                                     foreach ($party_list as $key => $value) {
                                                        echo '<option value="'.$value->id.'" selected>'.$value->name.'</option>';
                                                     }
                                                  }
                                              ?>
                                          </select>
                                      </div>
                                      <div class="form-group col-md-2" app-field-wrapper="date">
                                          <label for="from_date" class="control-label"><?php echo 'From Date'; ?></label>
                                          <div class="input-group date">
                                              <input id="from_date" name="from_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && !empty($s_fdate)) ? $s_fdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                          </div>
                                      </div>
                                      <div class="form-group col-md-2" app-field-wrapper="date">
                                          <label for="to_date" class="control-label"><?php echo 'To Date'; ?></label>
                                          <div class="input-group date">
                                              <input id="to_date" name="to_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && !empty($s_tdate)) ? $s_tdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                          </div>
                                      </div>
                                      <div class="form-group col-md-2 float-right">
                                          <button class="btn btn-info" type="submit" style="margin-top: 26px;">Search</button>
                                          <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                                      </div>
                                    </div>
                                <?php echo form_close(); ?>

                                <div class="col-md-12 table-responsive">
                                    <table class="table" id="newtable">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Request Id</th>
                                                <th>Category</th>
                                                <th>Party Name</th>
                                                <th>Remark</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Payment Method</th>
                                                <th>UTR</th>
                                                <th>From/To Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                           
                                            if (!empty($expense_info)) {
                                                $z = 1;
                                                foreach ($expense_info as $row) {

                                                    $from_to_date = '-';
                                                     if($row->from_date > 0 && $row->to_date > 0)
                                                     {
                                                     $from_to_date = _d($row->from_date)." - "._d($row->to_date);
                                                      }

                                                    if ($row->type == 2 && $row->category_id == 6) {
                                                        $party_name = $row->party_name;
                                                    } else {
                                                        $party_name = value_by_id('tblcompanyexpenseparties', $row->party_id, 'name');
                                                    }
                                                    $party_name = (empty($party_name)) ? $row->payee_name : $party_name;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $z++; ?></td>
                                                        <td class="text-center"><?php echo 'REQ-'.$row->id; ?></td>
                                                        <td><?php echo value_by_id('tblcompanyexpensecatergory', $row->category_id, 'name'); ?></td>
                                                        <td><?php echo cc($party_name); ?></td>
                                                        <td><?php echo cc($row->remark); ?></td>
                                                        <td><?php echo _d($row->date); ?></td>
                                                        <td><?php echo $row->amount; ?></td>
                                                        <td class="text-center"><?php echo $row->method; ?></td>
                                                        <td class="text-center"><?php echo $row->utr_no; ?></td>
                                                        <td><?php echo $from_to_date; ?></td>
                                                        <td>
                                                            <a href="javascript:void(0)" class="btn-sm btn-info payment_details" data-toggle="modal" value="<?php echo $row->id; ?>" data-target="#detailsModal">Details</a>

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
                            <div class="btn-bottom-toolbar text-right">

                            </div>
                        </div>
                    </div>
                </div>
            </form>
       </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>

<!-- Modal -->

<div id="statusModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Payment Request Status</h4>
            </div>
            <div class="modal-body" id="approval_html">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="detailsModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color:#fff;">Payment Details</h4>
            </div>
            <div class="modal-body" id="payment_html">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
$(document).ready(function() {
    $('#newtable').DataTable( {
        "iDisplayLength": 15,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            },
            'colvis'
        ]
    } );

      var category_id = $("#category_id").val();
      var party_id = $("#party_id").val();
      if (category_id !='' && party_id == ''){
          $.ajax({
             type    : "POST",
             url     : "<?php echo site_url('admin/company_expense/get_party'); ?>",
             data    : {'category_id' : category_id},
             success : function(response){
               if(response != ''){
                    $('#party_id').html(response);
                    $('.selectpicker').selectpicker('refresh');
               }
             }
         });
      }

} );
</script>
<script type="text/javascript">
   $(document).on("change", "#category_id", function(){
       var category_id = $("#category_id").val();
       $.ajax({
        type    : "POST",
        url     : "<?php echo site_url('admin/company_expense/get_party'); ?>",
        data    : {'category_id' : category_id},
        success : function(response){
            if(response != ''){
                 $('#party_id').html(response);
                 $('.selectpicker').selectpicker('refresh');
            }
        }
      });
   });
   $(document).on("click", ".payment_details", function(){
         var payment_id = $(this).attr("value");
         var burl = "<?php echo site_url('admin/company_expense/expense_vendor_details/'); ?>";
         $.ajax({
          type    : "POST",
          url     : burl+payment_id,
          success : function(response){
              if(response != ''){
                   $('#payment_html').html(response);
              }
          }
        });
   });
</script>

</body>

</html>
