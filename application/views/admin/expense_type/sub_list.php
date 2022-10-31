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

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin"><?php echo $title;  if(check_permission_page('140,272','create')){ ?> <a href="<?php echo admin_url('expense_type/add_subtype'); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Add New</a> <?php } ?></h4>



                    <hr class="hr-panel-heading">

                    <div class="row">

                    <div class="row col-md-12">
                        <div class="form-group col-md-4">
                            <label for="branch_id" class="control-label">Expense Type *</label>
                            <select class="form-control" id="type_id" name="type_id">
                                 <option value="">--Select One--</option>
                                <?php
                                if(!empty($type_data)){
                                    foreach ($type_data as $key => $value) {
                                        ?>
                                            <option value="<?php echo $value->id; ?>" <?php echo (isset($s_type_id) && $s_type_id == $value->id) ? "selected" : ""; ?>><?php echo cc($value->name); ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>



                       <div class="col-md-1">
                        <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                        </div>

                    </div>

                            <div class="">
                                <div class="col-md-12">
                                  <div class="table-responsive">
                                      <table class="table ui-table newtable">
                                          <thead>
                                              <tr>
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Designations</th>
                                                <th>Type</th>
                                                <th class="text-center">Action</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <?php
                                                if(!empty($type_info)){
                                                    $i=1;
                                                    foreach($type_info as $row){

                                                        if (!empty($row->designation_ids)){
                                                            $designationname = '';
                                                            $designationstr = explode(",",$row->designation_ids);
                                                            foreach($designationstr as $designationid){
                                                                $dname = value_by_id_empty('tbldesignation', $designationid, 'designation');
                                                                if (!empty($dname)){
                                                                    $designationname .= '<span class="btn-sm btn-info">'.$dname.'</span>&nbsp;';
                                                                }
                                                            }
                                                        }else{
                                                            $designationname = '--';
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $i++;?>
                                                                
                                                            </td>
                                                            <td>
                                                                <?php echo get_creator_info($row->added_by, $row->created_at); ?>
                                                                <?php echo cc($row->name);?>
                                                            </td>
                                                            <td><?php echo $designationname; ?></td>
                                                            <td><?php echo cc(value_by_id('tblexpensetype',$row->type_id,'name')); ?></td>
                                                            <td class="text-center">
                                                                <?php
                                                                if(check_permission_page('140,272','edit')){
                                                                ?>
                                                                    <a href="<?php echo admin_url('expense_type/add_subtype/'.$row->id); ?>" class="btn btn-info" ><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                                    <?php
                                                                }else{
                                                                    echo '--';
                                                                }

                                                                if(check_permission_page('140,272','delete')){
                                                                    ?>
                                                                    <a onclick="return confirm('Are you sure you want to delete this item?'); " href="<?php echo admin_url('expense_type/delete_subtype/'.$row->id); ?>" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                                    <?php
                                                                }else{
                                                                    echo '--';
                                                                }
                                                                ?>


                                                            </td>

                                                          </tr>
                                                        <?php
                                                    }
                                                }else{
                                                    echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found</h5></td></tr>';
                                                }
                                              ?>
                                          </tbody>
                                      </table>
                                  </div>
                                </div>
                            </div>
                             <!-- <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" value="1" name="mark" type="submit">
                                <?php echo _l('submit'); ?>
                            </button>
                        </div> -->
                        </div>

                    </div>
                </div>

            <?php echo form_close(); ?>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>

<?php init_tail(); ?>
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
<script>

    $(document).ready(function () {
        $('.newtable').DataTable({
        });
    });
</script>

</body>
</html>
