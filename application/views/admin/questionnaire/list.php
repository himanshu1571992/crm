
<?php init_head(); ?>

<style>
    .badge-success {
        background-color: #008200;
    }
    
    .question_div{
        background: #75ba48;
        padding: 20px;
        color: #fff;
        border-bottom-right-radius: 55px;
        border-top-left-radius: 55px;
    }
    
    .comment {
    overflow: hidden;
    padding: 0 0 1em;
    border-bottom: 1px solid #ddd;
    margin: 0 0 1em;
    *zoom: 1;
}

.comment-img {
    float: left;
    margin-right: 33px;
    border-radius: 5px;
    overflow: hidden;
}

.comment-img img {
    display: block;
}

.comment-body {
    overflow: hidden;
}

.comment .text {
    padding: 10px;
    border: 1px solid #e5e5e5;
    border-radius: 5px;
    background: #fff;
}

.comment .text p:last-child {
    margin: 0;
}

.comment .attribution {
    margin: 0.5em 0 0;
    font-size: 14px;
    color: #666;
}

/* Decoration */

.comments,
.comment {
    position: relative;
}

/*.comments:before,
.comment:before,
.comment .text:before {
    content: "";
    position: absolute;
    top: 0;
    left: 65px;
}

.comments:before {
    width: 3px;
    top: -4px;
    bottom: -20px;
    background: rgba(0,0,0,0.1);
    margin-left: 7px;
}

.comment:before {
    width: 9px;
    height: 9px;
    border: 3px solid #fff;
    border-radius: 100px;
    margin: 16px 0 0 0px;
    box-shadow: 0 1px 1px rgba(0,0,0,0.2), inset 0 1px 1px rgba(0,0,0,0.1);
    background: #ccc;
}

.comment:hover:before {
    background: orange;
}

.comment .text:before {
    top: 18px;
    left: 78px;
    width: 9px;
    height: 9px;
    border-width: 0 0 1px 1px;
    border-style: solid;
    border-color: #e5e5e5;
    background: #fff;
    -webkit-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    -o-transform: rotate(45deg);
}​*/

</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                        <h4 class="no-margin"><?php echo $title; ?>
                        <?php if (check_permission_page(333,'view')){ ?>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#addquestions" class="btn btn-info pull-right" style="margin-top:-6px; "> Add New Questions </a>
                        <?php } ?>
                        </h4>

                        <hr class="hr-panel-heading">

                        <div>

                            <div>
                                <div class="col-md-4">
                                    <div class="form-group" app-field-wrapper="status">
                                        <label for="staff_id" class="control-label"> Employee Name</label>
                                        <select class="form-control selectpicker" name="staff_id" id="staff_id" data-live-search="true">
                                            <option value=""></option>
                                            <?php
                                            if (isset($staff_list)) {
                                                foreach ($staff_list as $value) {
                                                    ?>
                                                    <option value="<?php echo $value->staffid; ?>" <?php echo (isset($staff_id) && $staff_id == $value->staffid) ? 'selected' : "" ?>><?php echo cc($value->firstname); ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group" app-field-wrapper="date">
                                            <label for="f_date" class="control-label">From Date</label>
                                            <div class="input-group date">
                                                <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if (!empty($f_date)) {
                                                echo $f_date;
                                            } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group" app-field-wrapper="date">
                                            <label for="t_date" class="control-label">To Date</label>
                                            <div class="input-group date">
                                                <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if (!empty($t_date)) {
                                                echo $t_date;
                                            } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
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
                                                <th width="1%">S.No</th>
                                                <th>Questions</th>
                                                <th>Replies</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($questions_list) {
                                                foreach ($questions_list as $key => $value) {
                                                    $reply = $this->db->query("SELECT COUNT(id) as count FROM tblproductquestionsanswers WHERE `questions_id` = '" . $value->id . "'")->row();
                                                    ?>
                                                    <tr>
                                                        <td><?php echo ++$key; ?></td>
                                                        <td>
                                                            <p style="color:red; font-size: 20px" class="qus<?php echo $value->id;?>"><?php echo cc($value->questions); ?></p>
                                                            <span>Created On : <?php echo db_date($value->date); ?> - <a href="#" class="badge badge-pill badge-success"> <?php echo get_employee_name($value->staff_id); ?> </a></span>
                                                        </td>
                                                        <?php if ($reply->count == 0) { ?>
                                                            <td><span class="btn btn-primary"><?php echo $reply->count; ?></span></td>
                                                        <?php } else { ?>
                                                            <td><a href="javascript:void(0)" data-id="<?php echo $value->id;?>" data-toggle="modal" data-target="#getanswerlist" class="btn btn-primary get_answers_list"><?php echo $reply->count; ?></a></td>
                                                        <?php } ?>
                                                            <td><a href="javascript:void(0)" data-toggle="modal" data-target="#addanswer" data-qustion_id="<?php echo $value->id;?>" class="btn btn-success answer_box"> <i class="fa fa-plus" aria-hidden="true"></i> </a></td>
                                                    </tr>
                                                <?php }
                                            } ?>
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
<div id="addquestions" class="modal fade" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <?php echo form_open(admin_url("questionnaire/add"));?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close model_close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Questions</h4>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-md-12">
                        <?php
                            $productcategorys = $this->db->query("SELECT `id`,`name` FROM `tblproductcategory` WHERE `for_service` = 0 AND `status` = 1 ")->result();
                        ?>
                        <div class="form-group select-placeholder">
                            <label for="payment_method" class="control-label"><small class="req text-danger">* </small> Select Category </label>
                            <select class="form-control selectpicker" required="" id="product_category_id"  name="product_category_id" required="" data-live-search="true">
                                <option value="">--Select One--</option>
                                <?php
                                if (!empty($productcategorys)) {

                                    foreach ($productcategorys as $category) {
                                        ?>

                                        <option value="<?php echo $category->id; ?>" ><?php echo cc($category->name); ?></option>

                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>    
                    <div class="col-md-12">    
                        <div class="form-group">
                            <label for="questions" class="control-label"><small class="req text-danger">* </small>Question</label>
                            <textarea id="questions" required="" rows="5" name="questions" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default model_close" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-success" value="Add Question">
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<div id="addanswer" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <?php echo form_open(admin_url("questionnaire/add_answer"));?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close model_close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Questions Answer</h4>
            </div>
            <div class="modal-body">
                <div class="row answer_div">
                    <div class="col-md-12">    
                        <div class="form-group">
                            <div class="question_div">
                                <h4>
                                    <span class="question-text"> </span>
                                </h4>
                            </div>
                            <input type="hidden" id="question_answer_id" name="question_id" value="">
                        </div>
                    </div>
                    <div class="col-md-12">    
                        <div class="form-group">
                            <label for="answer" class="control-label"><small class="req text-danger">* </small>Answer</label>
                            <textarea id="answer" required="" rows="5" name="answer" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default model_close" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="submit">
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<div id="getanswerlist" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close model_close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Questions Answer List</h4>
            </div>
            <div class="modal-body">
                <div class="row answer_list_div overflow-auto">
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default model_close" data-dismiss="modal">Close</button>
            </div>
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

    $(document).ready(function () {
        $('#newtable').DataTable({
            "iDisplayLength": 15,
            dom: 'Bfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],
            buttons: [
                'pageLength',
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                'colvis',
            ]
        });
    });
    
    $(document).on("click", ".model_close", function(){
       location.reload(); 
    });
    
    $(document).on("click", ".answer_box", function(){
       var question_id = $(this).data("qustion_id");
       var text = $(".qus"+question_id).first().text();
       $(".question-text").html(question_id+") "+text);
       $("#question_answer_id").val(question_id);
    });
    $(document).on("click", ".get_answers_list", function(){
       var question_id = $(this).data("id");
       var url = "<?php echo admin_url("questionnaire/get_answer_list/");?>";
       $.get(url+question_id, function(data){
           $(".answer_list_div").html(data);
       });
    });
</script>


</body>
</html>

