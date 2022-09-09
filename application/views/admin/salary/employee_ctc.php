<?php init_head(); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('salary/ctc_print'); ?>">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <h4 class="no-margin">Employee CTC Calculator</h4>
                            <hr class="hr-panel-heading">

                            <div class="row">


                                <div class="form-group col-md-4" app-field-wrapper="date">
                                    <label for="name" class="control-label">Employee Name</label>
                                    <div class="input-group">

                                        <input type="text" id="name" name="name" class="form-control" value="<?php echo (isset($name) && !empty($name)) ? $name : ""; ?>"><div class="input-group-addon"><i class="fa fa-user user-icon"></i></div>
                                    </div>


                                </div>

                                <div class="form-group col-md-3" app-field-wrapper="date">
                                    <label for="salary" class="control-label">Salary</label>
                                    <div class="input-group">
                                        <input type="text" id="salary" required="" name="salary" class="form-control" value=""><div class="input-group-addon"><i class="fa fa-money money-icon"></i></div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="type" class="control-label">CTC Type</label>
                                    <select class="form-control selectpicker" id="type" name="type" required="">
                                        <option value="" disabled selected >--Select One-</option>
                                        <option value="1" >No Deduction No Bonus</option>
                                        <option value="2" >No Deduction with Bonus</option>
                                        <option value="3" >Deduction No Bonus</option>
                                        <option value="4" >Deduction with Bonus</option>

                                    </select>
                                </div>

                                <div class="form-group col-md-2" style="margin-top: 22px;">
                                    <?php
                                        if(isset($candidate_id) && !empty($candidate_id)){
                                            echo "<input type='hidden' name='candidate_id' value='".$candidate_id."'>";
                                        }
                                    ?>
                                    <button class="form-control btn-info" type="submit" value="print">Calculate</button>
                                </div>





                                <div class="col-md-12" style="padding-bottom: 100px">																





                                    <table style="width:100%; border:2px solid #111; margin-top: -2px;">
                                        <tr>				
                                        </tr>
                                        <tr>

                                            <td style="padding:10px;">
                                                <b><u>Earning</u></b><br>
                                                <small>1) Basic 		     :- 50 % of CTC  </small><br>
                                                <small>2) HRA               :- 20 % of CTC  </small><br>
                                                <small>3) Convence Allownce :- 4 % of CTC  </small><br>
                                                <small>4) Medical Allownce  :- 4 % of CTC  </small><br>
                                                <small>5) Uniform Allownce  :- 4 % of CTC  </small><br>
                                                <small>6) Other Allownce 	 :- 80 % of CTC - Gross Salary  </small><br>
                                                <small>7) Gross Salary      :- (Basic + HRA + Convence + Medical + Uniform + Other Allownce)  </small><br>
                                                <b><u>Deductions</u></b><br>
                                                <small>1) Employer PF and Employee PF is the sum of 12% of all Allownce except HRA  </small><br>
                                                <small>2) Employer ESIC is the 3.75% of Gross. If Gross is smaller ther 21000 </small><br>
                                                <small>3) Employee ESIC is the 1.75% of Gross. If Gross is smaller ther 21000 </small><br>
                                                <small>4) PT will deduct 200 each month and 300 for the month of February</small>
                                            </td>

                                        </tr>
                                    </table>




                                </div>

                                <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'salary-form')); ?>



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
