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
                        <h4 class="no-margin"><?php echo $title; ?></a></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="">
                                <div class="col-md-12">                                                             
                                    <table class="table ui-table">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Coil Pipe (Per Kg)</th>
                                                <th>Non Coil Pipe (Per Kg)</th>
                                                <!--<th>Action</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if (!empty($category_info)) {
                                                $i = 1;
                                                foreach ($category_info as $row) {
                                                    $colorcls = ($row->update_date != date("Y-m-d")) ? 'color: #f24017;':"";
                                        ?>
                                                    <tr >
                                                        <td width="1%"><?php echo $i++; ?></td>
                                                        <td style="font-size: 15px; <?php echo $colorcls; ?>" class="categoryname<?php echo $row->id; ?>" ><?php echo cc($row->name); ?></td>
                                                        <td class="categorycoil<?php echo $row->id; ?>"><input type="text" class="form-control" name="rate[<?php echo $row->id; ?>][coilpipe]" value="<?php echo ($row->coilPipePrice > 0.00) ? $row->coilPipePrice: ""; ?>"> </td>
                                                        <td class="categorynoncoil<?php echo $row->id; ?>"><input type="text" class="form-control" name="rate[<?php echo $row->id; ?>][noncoilpipe]" value="<?php echo ($row->nonCoilPipePrice > 0.00) ? $row->nonCoilPipePrice : ""; ?>"> </td>   
                                                        <!--<td><a href="javascript:void(0);" data-id="<?php echo $row->id; ?>" data-toggle="modal" data-target="#materialrate" class="btn btn-success addmaterialrate"><i class="fa fa-edit"></i></a></td>-->
                                                    </tr>
                                        <?php
                                                }
                                            } else {
                                                echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found</h5></td></tr>';
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo 'Submit'; ?>
                            </button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>      
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>

<?php init_tail(); ?>
<div id="materialrate" class="modal fade" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <?php echo form_open(admin_url("productcategory/raw_material_ratelist"));?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close model_close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Material Rate List</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="category_id" class="category_id" value="0">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="categoryname text-danger"></h4>
                    </div>    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Coil Pipe" class="control-label">Coil Pipe  (Per Kg)</label>
                            <input id="coil_pipe" name="coil_pipe" class="form-control">
                        </div>
                    </div>    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Non Coil Pipe" class="control-label">Non Coil Pipe  (Per Kg)</label>
                            <input id="noncoil_pipe" name="noncoil_pipe" class="form-control">
                        </div>
                    </div>    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default model_close" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-success" value="Save">
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script>

    $(document).on("click", ".model_close", function(){
       location.reload(); 
    });
    
    $(document).on("click", ".addmaterialrate", function(){
       var category_id = $(this).data("id");
       var text = $(".categoryname"+category_id).first().text();
       var coiltext = $(".categorycoil"+category_id).first().text();
       var noncoiltext = $(".categorynoncoil"+category_id).first().text();
       $(".categoryname").html("Category Name : "+text);
       $(".category_id").val(category_id);
       $("#coil_pipe").val(coiltext);
       $("#noncoil_pipe").val(noncoiltext);
    });
</script>
</body>
</html>
