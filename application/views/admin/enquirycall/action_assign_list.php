
<?php init_head(); ?>
<style type="text/css">
    .popover{
        max-width:600px;
    }
</style>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin"><?php echo $title; ?></h4>

                    <hr class="hr-panel-heading">

                    <div>
                    
                        <div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group" app-field-wrapper="date">
                                        <label for="f_date" class="control-label">From Date</label>
                                        <div class="input-group date">
                                            <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if (!empty($f_date)) {echo $f_date;} ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group" app-field-wrapper="date">
                                        <label for="t_date" class="control-label">To Date</label>
                                        <div class="input-group date">
                                            <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if (!empty($t_date)) {echo $t_date;} ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
           
                                <div class="col-md-2">
                                    <div class="input-group" style="margin-top: 26px;">
                                        <button type="submit" class="btn btn-info">Search</button>
                                        <a class="btn btn-danger" href="">Reset</a>
                                    </div>
                                </div>   
                            </div>
                        </div>
                            <br>
                            <hr>                    
                            <div class="col-md-12"> 
                                <div class="table-responsive">  
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Company Name</th>
                                        <th>Email</th>
                                        <th width="1%">Recording</th>
                                        <th>Date Time</th>
                                        <th width="1%">Contacts</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($enquirycall_list)){
                                        foreach ($enquirycall_list as $key => $value) { 
                                            
                                        $recording_url = '';    
                                         
                                        if ($value->call_type == 1){
                                            $call_data = $this->db->query("SELECT `recording_url` FROM tblcallincoming WHERE `id` = ".$value->call_id."")->row();
                                            if (!empty($call_data)){
                                                $recording_url = $call_data->recording_url;   
//                                                $recording_url = '<audio controls style="height: 30px;width: 210px;">
//                                                    <source src="'.$call_data->recording_url.'" type="audio/mpeg">
//                                                </audio>';
                                            }
                                        }else{
                                            $call_data = $this->db->query("SELECT `recording_url` FROM tblcalloutgoing WHERE `id` = ".$value->call_id."")->row();
                                            if (!empty($call_data)){
                                                $recording_url = $call_data->recording_url;   
//                                                $recording_url = '<audio controls style="height: 30px;width: 210px;">
//                                                    <source src="'.$call_data->recording_url.'" type="audio/mpeg">
//                                                </audio>';
                                            }
                                        }    
                                        $source_name = value_by_id('tblleadssources',$value->source_id,'name');
                                        if ($value->clientid > 0){
                                            $company_name = client_info($value->clientid)->client_branch_name;
                                        }else{
                                            $company_name = (!empty($value->company_name)) ? cc($value->company_name) : "--";
                                        }
                                    ?>
                                        <tr>
                                            <td><?php echo ++$key; ?></td>
                                            <td><?php echo $company_name; ?></td>
                                            <td><?php echo (!empty($value->email)) ? $value->email : "--"; ?></td>      
<!--                                            <td class="text-center"><?php echo $recording_url; ?></td>-->
                                            <td class="text-center">
                                                <?php if ($recording_url != ''){ ?>
                                                <a href="#" data-toggle="popover" class="recording_play" id="record<?php echo $key; ?>" data-placement="top" data-container="body" data-html="true" onclick="recording(this, '<?php echo $key; ?>', '<?php echo $recording_url; ?>');" style="font-size: 40px;" data-content=""><i class="fa fa-play-circle"></i></a>
                                                <?php } else{
                                                        echo '--';
                                                    }?>
                                            </td>
                                            <td><?php echo _d($value->created_at); ?></td>
                                            <td>
                                                <?php if ($value->call_id > 0){ ?>
                                                    <a target="_blank" href="<?php echo admin_url('enquirycall/enquirycall_contacts/'.$value->id); ?>"><img src="https://schachengineers.com/schacrm/assets/images/make_call.png" width="35" height="35"></a>
                                                <?php }else{
                                                    echo '--';
                                                } ?>
                                            </td> 
                                            <td class="text-center">
                                                
                                                <div class="btn-group pull-right">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                        <li>
                                                            <a href="<?php echo admin_url('enquirycall/view/' . $value->id); ?>" title="View" >View</a>
                                                        </li>
                                                        <?php 
                                                        $check_action = $this->db->query("SELECT COUNT(id) as count FROM tblenquirycall_assignproduction WHERE `enquirycall_id` = '".$value->id."' AND `approve_status` = 1")->row();
                                                            if ($check_action->count == 0){
                                                        ?>
                                                            <li>
                                                                <a href="<?php echo admin_url('enquirycall/enquirycall_actionassign/' . $value->id); ?>" title="Take Action" >Take Action</a>
                                                            </li>
                                                        <?php
                                                            }else{
                                                                echo '<li><a href="javascript:void(0);" ><span class="text-success">Action Takened</span></a></li>';
                                                            }
                                                        ?>
                                                    </ul>
                                                </div>
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
        
        "iDisplayLength": 15,
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
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            'colvis',
        ]
    } );
} );
</script>
<script type="text/javascript">

    function recording(el, id, url) {
        var audio = '<audio controls autoplay><source src="' + url + '" type="audio/ogg"></audio>';
        $(el).attr('data-content', audio);
        $('#record'+id+' i').toggleClass('fa-play-circle fa-pause-circle');
    }
</script>

</body>
</html>

