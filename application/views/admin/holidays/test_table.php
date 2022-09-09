
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

                    <h4 class="no-margin">Holidays List <a href="<?php echo admin_url('holidays/add'); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Add New Holiday</a></h4>

                    <hr class="hr-panel-heading">

                    <div class="row">
                    
                    <div>
                        <div class="col-md-4" id="employee_div">
                            <div class="form-group ">
                                <label for="branch_id" class="control-label"><?php echo 'Year'; ?> *</label>
                                <select class="form-control" id="year" name="year">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                    $j = date('Y');
                                    for($i=2018; $i<=$j; $i++){
                                        ?>
                                        <option value="<?php echo $i;?>" <?php if(!empty($year) && $year == $i){ echo 'selected';} ?>  ><?php echo $i; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-4">                            
                            <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                        </div>
                       
                    </div>
                                                
                            <div class="col-md-12">                                                             
                                <table class="table ui-table">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Title</th>
                                        <th>Year</th>
                                        <th>Date</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                     <tr>
                                        <td>1</td>
                                        <td>First Title</td>
                                        <td>2019</td>
                                        <td>04-11-2019</td>
                                        <td class="text-center">
                                            <a href="#" class="actionBtn">View</a>
                                            <a href="#" class="actionBtn">Edit</a>
                                            <div class="btn-group pull-right">
                                                 <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                 </button>
                                                 <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                    <li>
                                                       <a href="#" id="invoice_create_credit_note" data-status="1">Create Credit Note</a>
                                                    </li>
                                                    <li>
                                                       <a href="#" data-toggle="modal" data-target="#sales_attach_file">Attach File</a>
                                                    </li>
                                                 </ul>
                                            </div>
                                        </td>
                                      </tr>

                                       <tr>
                                        <td>1</td>
                                        <td>Second Title</td>
                                        <td>2019</td>
                                        <td>04-11-2019</td>
                                        <td class="text-center">
                                            <a href="#" class="actionBtn">View</a>
                                            <a href="#" class="actionBtn">Edit</a>
                                            <div class="btn-group pull-right">
                                                 <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                 </button>
                                                 <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                    <li>
                                                       <a href="#" id="invoice_create_credit_note" data-status="1">Mustu</a>
                                                    </li>
                                                    <li>
                                                       <a href="#" data-toggle="modal" data-target="#sales_attach_file">Kapil</a>
                                                    </li>
                                                 </ul>
                                            </div>
                                        </td>
                                      </tr>
                                      
                                     
                                    </tbody>
                                  </table>
                            </div>
                        
                               
                             <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" value="1" name="mark" type="submit">
                                <?php echo _l('submit'); ?>
                            </button>
                        </div>
                        </div>
                       
                    </div>
                </div>
             
            <?php echo form_close(); ?>
        </div>      
        <div class="btn-bottom-pusher"></div>
    </div>
</div>

<?php init_tail(); ?>


</body>
</html>
