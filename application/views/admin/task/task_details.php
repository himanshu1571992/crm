l<?php init_head(); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<style>
    fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}
legend.scheduler-border {
    font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;
    border-bottom: blue;
}
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('Task/task_details'); ?>">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">

                            <h4 class="no-margin">Task - Details <?php if (!empty($task_info->task_file)) { ?><a target="_blank" href="<?php echo base_url('uploads/tasks/' . $task_info->task_file); ?>" class="btn btn-info pull-right">View Attachment</a><?php } ?> </h4>
                            <hr class="hr-panel-heading">

                            
                                <div class="row">
                                    <?php
                                    $priority = '--';
                                    if ($task_info->priority == 1) {
                                        $priority = 'Low';
                                    } elseif ($task_info->priority == 2) {
                                        $priority = 'Medium';
                                    } elseif ($task_info->priority == 3) {
                                        $priority = 'High';
                                    } elseif ($task_info->priority == 4) {
                                        $priority = 'Urgent';
                                    }
                                    ?>						

                                    <div role="tabpanel" class="tab-pane" id="lead_activity">
                                        <div class="panel_s no-shadow">
                                            <div class="activity-feed">
                                                <fieldset class="scheduler-border">
                                                    <br>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <h4 class="control-label">Title</h4>
                                                                    <p><?php echo cc($task_info->title); ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <h4 class="control-label">Priority</h4>
                                                                    <p><?php echo $priority; ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <?php
                                                                    if ($task_info->is_repeat == 1) {
                                                                        ?>
                                                                        <div class="Description-box">
                                                                            <p><b>Repeat Every  : </b> <?php echo ($task_info->repeat_type == 1) ? 'Weekly' : 'Monthly'; ?></p> 
                                                                        </div>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <div class="form-group">
                                                                            <select class="form-control" id="status" name="status" required="">
                                                                                <option value="" disabled="" selected="">--Select One-</option>               
                                                                                <option value="0" <?php
                                                                                if (!empty($status_info) && $status_info->task_status == 0) {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?> >Pending</option>
                                                                                <option value="1" <?php
                                                                                if (!empty($status_info) && $status_info->task_status == 1) {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?> >Completed</option>
                                                                                <option value="2" <?php
                                                                                if (!empty($status_info) && $status_info->task_status == 2) {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?> >Rejected</option>
                                                                            </select>
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <h4 class="control-label">Task Description</h4>
                                                                <p><?php echo cc($task_info->description); ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <h4 class="control-label">Start Date</h4>
                                                                <p><?php echo date('d/m/Y', strtotime($task_info->start_date)); ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <h4 class="control-label">Due Date</h4>
                                                                <p><?php echo date('d/m/Y', strtotime($task_info->due_date)); ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </fieldset>
                                                <fieldset class="scheduler-border">
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <h4 class="control-label">Task Related To</h4>
                                                                    <p><fieldset class="scheduler-border">
                                                                        <legend class="scheduler-border"><?php echo value_by_id('tbltaskfor', $task_info->related_to, 'name'); ?></legend>
                                                                        <?php
                                                                        if ($task_info->related_to != 7) {

                                                                            if ($task_info->related_to == 1) {
                                                                                if (!empty($task_info->clients)) {
                                                                                    $client_info = $this->db->query("SELECT * from tblclients where userid IN (" . $task_info->clients . ") ")->result();
                                                                                    if (!empty($client_info)) {
                                                                                        echo '<div class="task-box">';
                                                                                        foreach ($client_info as $key => $value) {
                                                                                            ?>
                                                                                            <?php echo ++$key;?>) <a target="_blank" href="<?php echo admin_url('client/client/' . $value->userid); ?>"><?php echo $value->company; ?></a><br>
                                                                                            <?php
                                                                                        }
                                                                                        echo '</div>';
                                                                                    }
                                                                                }
                                                                            } elseif ($task_info->related_to == 2 || $task_info->related_to == 8 || $task_info->related_to == 9) {
                                                                                if (!empty($task_info->challans)) {
                                                                                    $challan_info = $this->db->query("SELECT * from tblchalanmst where id IN (" . $task_info->challans . ") ")->result();
                                                                                    if (!empty($challan_info)) {
                                                                                        echo '<div class="task-box">';
                                                                                        foreach ($challan_info as $key => $value) {
                                                                                            ?>
                                                                                            <?php echo ++$key;?>) <a target="_blank" href="<?php echo admin_url('chalan/view/' . $value->id); ?>"><?php echo $value->chalanno; ?></a><br>
                                                                                            <?php
                                                                                        }
                                                                                        echo '</div>';
                                                                                    }
                                                                                }
                                                                            } elseif ($task_info->related_to == 3) {
                                                                                if (!empty($task_info->expenses)) {
                                                                                    $expense_info = $this->db->query("SELECT e.id,c.name as category_name FROM tblexpenses as e INNER JOIN tblexpensescategories as c ON e.category = c.id  WHERE e.id IN (" . $task_info->expenses . ") ")->result();

                                                                                    if (!empty($expense_info)) {
                                                                                        echo '<div class="task-box">';
                                                                                        foreach ($expense_info as $key => $value) {
                                                                                            $exp = 'EXP-' . get_short($value->category_name) . '-' . number_series($value->id);
                                                                                            ?>
                                                                                            <?php echo ++$key;?>) <a target="_blank" href="<?php echo admin_url('expenses/list_expenses#' . $value->id); ?>" ><?php echo $exp; ?></a><br>
                                                                                            <?php
                                                                                        }
                                                                                        echo '</div>';
                                                                                    }
                                                                                }
                                                                            } elseif ($task_info->related_to == 4) {
                                                                                if (!empty($task_info->invoices)) {
                                                                                    $invoice_info = $this->db->query("SELECT * from tblinvoices where id IN (" . $task_info->invoices . ") ")->result();
                                                                                    if (!empty($invoice_info)) {
                                                                                        echo '<div class="task-box">';
                                                                                        foreach ($invoice_info as $key => $value) {
                                                                                            ?>
                                                                                            <?php echo ++$key;?>) <a target="_blank" href="<?php echo admin_url('invoices/list_invoices/' . $value->id); ?>" ><?php echo format_invoice_number($value->id); ?></a><br>
                                                                                            <?php
                                                                                        }
                                                                                        echo '</div>';
                                                                                    }
                                                                                }
                                                                            } elseif ($task_info->related_to == 5) {
                                                                                if (!empty($task_info->leads)) {
                                                                                    $lead_info = $this->db->query("SELECT * from tblleads where id IN (" . $task_info->leads . ") ")->result();
                                                                                    if (!empty($lead_info)) {
                                                                                        echo '<div class="task-box">';
                                                                                        foreach ($lead_info as $key => $value) {
                                                                                            ?>
                                                                                            <?php echo ++$key;?>) <a target="_blank" href="<?php echo admin_url('leads/index/' . $value->id); ?>" ><?php echo $value->leadno; ?></a><br>
                                                                                            <?php
                                                                                        }
                                                                                        echo '</div>';
                                                                                    }
                                                                                }
                                                                            } elseif ($task_info->related_to == 6) {

                                                                                if (!empty($task_info->perfoma_invoices)) {
                                                                                    $pi_info = $this->db->query("SELECT * from tblestimates where id IN (" . $task_info->perfoma_invoices . ") ")->result();
                                                                                    if (!empty($pi_info)) {
                                                                                        echo '<div class="task-box">';
                                                                                        foreach ($pi_info as $key => $value) {
                                                                                            ?>
                                                                                            <?php echo ++$key;?>) <a target="_blank" href="<?php echo admin_url('estimates/list_estimates#' . $value->id); ?>" ><?php echo format_estimate_number($value->id); ?></a><br>
                                                                                            <?php
                                                                                        }
                                                                                        echo '</div>';
                                                                                    }
                                                                                }
                                                                            } elseif ($task_info->related_to == 10) {

                                                                                if (!empty($task_info->quotation)) {
                                                                                    $quotation_info = $this->db->query("SELECT * from tblproposals where id IN (" . $task_info->quotation . ") ")->result();
                                                                                    if (!empty($quotation_info)) {
                                                                                        echo '<div class="task-box">';
                                                                                        foreach ($quotation_info as $key => $value) {
                                                                                            ?>
                                                                                            <?php echo ++$key;?>) <a target="_blank" href="<?php echo admin_url('proposals/proposal/' . $value->id); ?>" ><?php echo format_proposal_number($value->id); ?></a><br>
                                                                                            <?php
                                                                                        }
                                                                                        echo '</div>';
                                                                                    }
                                                                                }
                                                                            } elseif ($task_info->related_to == 11) {
                                                                                $city_name = value_by_id('tblcities', $task_info->city_id, 'name');
                                                                                $state_name = value_by_id('tblstates', $task_info->state_id, 'name');
                                                                                if (!empty($task_info->client_id)) {
                                                                                    $client_info = client_info($task_info->client_id);
                                                                                }
                                                                                echo '<div class="task-box">';
                                                                                ?>  

                                                                                Client Name : 
                                                                                <?php
                                                                                if (!empty($client_info)) {
                                                                                    ?>
                                                                                    <a target="_blank" href="<?php echo admin_url('client/client/' . $client_info->userid); ?>"><?php echo $client_info->client_branch_name; ?></a><br>
                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                    <?php echo $task_info->client_name; ?><br>
                                                                                    <?php
                                                                                }
                                                                                ?>


                                                                                Date : <?php echo _d($task_info->other_date); ?><br>
                                                                                Service Type : <?php echo ($task_info->service_type == 1) ? 'Rent' : 'Sales'; ?><br>
                                                                                Location : <?php echo $city_name . ', ' . $state_name; ?>
                                                                                <?php
                                                                                echo '</div>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </fieldset></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <h4 class="control-label">Task Assigned To</h4>
                                                                    <?php
                                                                    $assignee_arr = explode(',', $task_info->assigned_to);
                                                                    ?>
                                                                    <br>
                                                                    <p><?php
                                                                        if (!empty($task_info->assigned_to)) {
                                                                            echo '<fieldset class="scheduler-border"><br>';
                                                                            foreach ($assignee_arr as $key => $staff_id) {
                                                                                ?>
                                                                                <?php echo ++$key;?>) <a target="_blank" href="<?php echo admin_url('staff/member/' . $staff_id); ?>" ><?php echo get_employee_name($staff_id); ?></a><br>
                                                                                <?php
                                                                            }
                                                                            echo '</fieldset>';
                                                                        } else {
                                                                            echo '<a href="#" >Self</a><br>';
                                                                        }
                                                                        ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <h4 class="control-label">Files Attachment </h4>
                                                                    <?php 
                                                                        $files = $this->db->query("SELECT * FROM tblfiles WHERE rel_id = ".$task_info->id." AND rel_type = 'task'")->result();
                                                                    ?>
                                                                    <br>
                                                                    <p><?php
                                                                        if (!empty($files)) {
                                                                            echo '<fieldset class="scheduler-border"><br>';
                                                                            foreach ($files as $key => $file) {
                                                                                ?>
                                                                                <?php echo ++$key;?>) <a target="_blank" href="<?php echo site_url('uploads/tasks/' .$task_info->id .'/'.$file->file_name); ?>" ><?php echo $file->file_name; ?></a><br>
                                                                                <?php
                                                                            }
                                                                            echo '</fieldset>';
                                                                        } else {
                                                                            echo '--';
                                                                        }
                                                                        ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <?php
                                                if ($task_info->related_to == 7) {
                                                    $pj_array = json_decode($task_info->product_data);
                                                    ?>
                                                    <hr>

                                                    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2%; !important">
                                                        <thead>
                                                            <tr>
                                                                <th align="left">S.No.</th>
                                                                <th align="left">Product Name</th>
                                                                <th align="left">View</th>
                                                                <th align="left">Quantity</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="ui-sortable">
                                                            <?php
                                                            if (!empty($pj_array)) {
                                                                $i = 1;
                                                                foreach ($pj_array as $p_info) {
                                                                    ?>
                                                                    <tr class="main" id="tr0">
                                                                        <td><?php echo $i++; ?></td>                  
                                                                        <td><?php echo value_by_id('tblproducts', $p_info->p_id, 'name'); ?></td>
                                                                        <td><a target="_blank" href="<?php echo base_url('admin/product_new/view/' . $p_info->p_id); ?>">View</a></td>
                                                                        <td><?php echo $p_info->p_qty; ?> </td>                                 
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>


                                                    <?php
                                                }

                                                if ($task_info->related_to == 8 || $task_info->related_to == 9) {
                                                    echo '<hr>';
                                                    $challan_arr = explode(',', $task_info->challans);
                                                    echo get_challan_address($challan_arr, 0);
                                                }
                                                ?>



                                            </div>

                                            <input type="hidden" value="<?php echo $id; ?>" name="id">
                                            <div class="col-md-12">
                                                <?php
                                                if ($task_info->is_repeat == 0) {
                                                    ?>
                                                    <div class="text-right">
                                                        <button class="btn btn-info"><?php echo _l('submit'); ?></button>
                                                    </div>
                                                    <?php
                                                }
                                                ?>                 
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>


<script type="text/javascript">
    $(document).on('change', '#branch_id', function () {
        $("#attendance_form").submit();
    });

    $(document).on('change', '#month', function () {
        $("#attendance_form").submit();
    });
</script> 


<script type="text/javascript">
    $(document).on('click', '.pay_all', function () {
        if (!$("input[name='staffid[]']").is(":checked")) {
            alert('Please Check Any Checkbox First!');
            return false;
        } else {
            $("#salary_form").submit();
        }



    });
</script> 

<script type="text/javascript">
    $(".myselect").select2();
</script>

</body>
</html>
