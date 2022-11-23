<?php init_head(); ?>
<style>
    @media (max-width: 500px){
        .btn-bottom-toolbar {
            width: 100%
        }
    }    
    @media (max-width: 768px){
        .btn-bottom-toolbar {
            width: 100%
        }
    }     
</style>    
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form  action=""  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">

                        <div class="row">

                            <div  class="col-md-6">
                                <div class="form-group">
                                    <label for="remark" class="control-label">Remark</label>
                                    <textarea class="form-control" disabled=""><?php echo (isset($main_info) && $main_info->remark != '') ? $main_info->remark : ""; ?></textarea>
                                </div>
                            </div>
                            
                            <div  class="col-md-6">
                                <div class="form-group">
                                    <label for="approval_remark" class="control-label">Approval/Reject Remark</label>
                                    <textarea class="form-control" name="approval_remark" id="approval_remark" required=""></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <hr>
                            </div>

                            <div class="col-md-12 table-responsive">                                                             
                                <table class="table" id="">
                                    <thead>
                                      <tr>
                                        <th>S.No.</th>
                                        <th>Product Name</th>
                                        <th>Print Name</th>
                                        <th>Created Date</th>  
                                        <th class="text-center">View</th>
                                        <th class="text-center">Remark</th>
                                        <th class="text-center">Action</th>
                                        
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($item_data)){
                                        $z=1;
                                        foreach($item_data as $row){ 
                                            ?>                                                                                      
                                            <tr>
                                                <td><?php echo $z++;?></td>                                                                                                        
                                                <td><?php echo $row->name;?></td>
                                                <td><?php echo $row->sub_name;?></td>
                                                <td><?php echo _d($row->created_at);?></td>
                                                <td class="text-center"><a class="btn-sm btn-info" target="_blank" href="<?php echo admin_url('product_new/products_log_view/'.$row->id); ?>">View</a></td>
                                                <td class="text-center">
                                                    <textarea class="form-control" name="remark_<?php echo $row->main_id?>"></textarea>
                                                </td>
                                                <td class="text-center">
                                                    <select class="selectpicker" name="status_<?php echo $row->main_id?>">
                                                        <option value="1">Approve</option>
                                                        <option value="2">Reject</option>
                                                    </select>
                                                </td>                                                
                                            </tr>
                                            <?php
                                        }
                                    }else{
                                        echo '<tr><td class="text-center" colspan="6"><h5>Record Not Found</h5></td></tr>';
                                    }
                                    ?>
                                      
                                     
                                    </tbody>
                                  </table>
                            </div>                             

                        </div>

                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo 'Submit'; ?>
                            </button>
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
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>


<script>

$(document).ready(function() {
    $('#newtable').DataTable( {
        "iDisplayLength": 25
    } );
} );
</script>


<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>





</body>
</html>
