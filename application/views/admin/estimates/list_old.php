
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


    .staus_process {
        display: inline-block;
        color: #fff;
        padding: 8px 15px;
        font-size: 14px;
        box-shadow: 0px 3px 8px #ccc;    
        display: block;
        margin: 5px;
    }

</style>

<?php
$where_amt_desc = 0;
if(!empty($this->session->userdata('estimate_search'))){
    $search_arr = $this->session->userdata('estimate_search');
} 
if(!empty($this->session->userdata('estimate_where_amt_desc'))){
    $where_amt_desc = $this->session->userdata('estimate_where_amt_desc');
}   
?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin"><?php echo $title; if(check_permission_page(98,'create')){ ?> <a href="<?php echo admin_url('leads/export_lead'); ?>" class="btn btn-info pull-right" style="margin-top:-6px;"> Export </a> <a href="<?php echo admin_url('estimates/performerinvoice'); ?>" class="btn btn-info pull-right" style="margin-top:-6px; margin-right: 10px;"> Create New Perfoma Invoice</a>  <?php } ?></h4>

                    <hr class="hr-panel-heading">

                    <div class="row">
                    
                    <div >
                        <div class="row col-md-12">

                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="source" class="control-label">Customer</label>
                                <select class="form-control selectpicker" name="clientid" id="clientid" data-live-search="true">
                                    <option value=""></option>
                                    <?php
                                    if (isset($client_branch_data) && count($client_branch_data) > 0) {
                                        foreach ($client_branch_data as $value) {
                                            ?>
                                            <option value="<?php echo $value->userid ?>" <?php if(!empty($search_arr['clientid']) && $search_arr['clientid'] == $value->userid){ echo 'selected';} ?>><?php echo $value->client_branch_name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div> 

                        <div class="col-md-2">
                            <div class="form-group ">
                                <label for="type" class="control-label">Proforma Type</label>
                                <select class="form-control selectpicker" id="type" name="type" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                    if(!empty($type_info)){
                                        foreach ($type_info as $value) {
                                            ?>
                                            <option value="<?php echo $value->id; ?>" <?php if(!empty($search_arr['type']) && $search_arr['type'] == $value->id){ echo 'selected';} ?>><?php echo $value->name; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>  

                          <div class="form-group col-md-3" app-field-wrapper="date">
                            <label for="f_date" class="control-label">From Date</label>
                            <div class="input-group date">
                                <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if(!empty($search_arr['f_date'])){ echo $search_arr['f_date']; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>

                        <div class="form-group col-md-3" app-field-wrapper="date">
                            <label for="t_date" class="control-label">To Date</label>
                            <div class="input-group date">
                                <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($search_arr['t_date'])){ echo $search_arr['t_date']; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="estimate_no" class="control-label">Profoma No.</label>
                            <input type="text" name="estimate_no" class="form-control" value="<?php if(!empty($search_arr['estimate_no'])){ echo $search_arr['estimate_no']; } ?>">
                       </div>      

                        <div class="col-md-2">
                            <label for="amt_desc" class="control-label">Descending by Amount </label>
                            <input type="checkbox" name="amt_desc" class="form-control" value="1" <?php if($where_amt_desc == 1){ echo 'checked'; }?>>
                       </div>   
                      


                        
                        <div class="col-md-2">                            
                            <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                            <button type="submit" value="1" name="reset" style="margin-top: 24px;" class="btn btn-danger">Reset</button>
                        </div>                     

                        </div>
                       
                    </div>
                                                
                            <div class="col-md-12">                                                             
                                <table class="table ui-table">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Perfoma Invoice #</th>
                                        <th>Customer Name</th>
                                        <th>Total Tax</th>
                                        <th>Total</th>
                                        <th>Date</th>                          
                                        <th>Expiry Date</th>
                                        <th>Proforma Type</th> 
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($estimate_list)){
                                        foreach ($estimate_list as $key => $value) {

                                            $client_info = $this->db->query("SELECT * FROM `tblclientbranch` where userid = '".$value->clientid."' ")->row();

                                        ?>
                                        <tr>
                                            <td><?php echo ++$key; ?></td>                                                
                                            <td><?php echo '<a target="_blank" href="' . admin_url('estimates/list_estimates/' . $value->id) . '" onclick="init_estimate(' . $value->id . '); ">' . format_estimate_number($value->id) . '</a>'; ?></td>
                                            <td><?php if(!empty($client_info)){ echo '<a target="_blank" href="' . admin_url('clients/client/' . $value->clientid) . '">' . $client_info->client_branch_name . '</a>'; }else{ echo '--'; } ?></td>
                                            <td><?php echo $value->total_tax; ?></td>
                                            <td><?php echo $value->total; ?></td>                                        
                                            <td><?php echo _d($value->date); ?></td> 
                                            <td><?php echo _d($value->expirydate); ?></td> 
                                            <td>
                                                <span class="inline-block label label-" style="color:#7cb342;border:1px solid #7cb342">
                                                   <?php echo value_by_id('tblenquirytypemaster',$value->proforma_type,'name'); ?>
                                                   <div class="dropdown inline-block mleft5 table-export-exclude">
                                                      <a href="#" style="font-size:14px;vertical-align:middle;" class="dropdown-toggle text-dark" id="tableLeadsStatus-13" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span data-toggle="tooltip" title="" data-original-title="Change Source"><i class="fa fa-caret-down" aria-hidden="true"></i></span></a>
                                                      <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="tableLeadsStatus-13">
                                                        <?php
                                                            if(!empty($type_info)){
                                                                foreach ($type_info as $r) {
                                                                    ?>
                                                                    <li>
                                                                        <a href="#" onclick="change_source(<?php echo $r->id; ?>,<?php echo $value->id; ?>); return false;"><?php echo $r->name; ?></a>
                                                                     </li>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                         
                                                      </ul>
                                                   </div>
                                                </span>
                                            </td> 
                                            
                                            <td><?php echo format_estimate_status($value->status); ?></td>
                                            <td class="text-center">
                                                
                                                <a href="<?php echo admin_url('estimates/download_pdf/'.$value->id); ?>" target="_blank" class="actionBtn">PDF</a>
                                                <?php if(check_permission_page(98,'edit')){ ?>
                                                <a href="<?php echo admin_url('estimates/performerinvoice/' . $value->id); ?>" class="actionBtn">Edit</a>
                                                <?php } ?>

                                            </td>
                                          </tr>
                                        <?php
                                        }
                                    }
                                    ?>
                                     
                                    </tbody>
                                  </table>

                                <div class="pagination">
                                    <?php echo $this->pagination->create_links(); ?>
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


</body>
</html>

<script type="text/javascript">
    function change_source(value,id)
    {
        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/estimates/change_source'); ?>",
            data    : {'source' : value,'id' : id},
            success : function(response){
                if(response != ''){           
                    location.reload(true);
                }
            }
        })
    }
</script>

