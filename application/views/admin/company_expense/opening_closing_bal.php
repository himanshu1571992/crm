<?php init_head(); ?>
<style>
    fieldset.scheduler-border {
    border: 2px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                        <hr class="hr-panel-heading">
                        <?php echo form_open($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
                            <div class="row">
                                <div class="form-group col-md-4" app-field-wrapper="date">
                                    <label for="f_date" class="control-label"><?php echo 'Date'; ?> <span style="color:red">*</span></label>
                                    <div class="input-group date">
                                        <input id="f_date" name="f_date" required="" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : date("d/m/Y"); ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <input type="hidden" name="date_filter" value="1">
                                    <button type="submit" style="margin-top: 26px;" class="btn btn-info">Search</button>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                        
                        <form  action="<?php echo site_url($this->uri->uri_string()); ?>"  class="balance-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        <div class="row">
                            <?php
                                if (isset($bank_list) && !empty($bank_list)){
                                    foreach($bank_list as $value) {
                                        
                                        $pre_bal = $this->db->query("SELECT * FROM `tbldailyopeningclosingbalance` WHERE `bank_id` = ".$value->id." AND `date` < '".db_date($s_fdate)."' ORDER BY date DESC")->row();
                                        $balance_info = $this->db->query("SELECT * FROM `tbldailyopeningclosingbalance` WHERE `bank_id` = ".$value->id." AND `date` = '".db_date($s_fdate)."'")->row();
                                        
                                        if (!empty($balance_info)){
                                            $opening_bal = $balance_info->opening_bal;
                                            $closing_bal = $balance_info->closing_bal;
                                        }else{
                                            $opening_bal = (!empty($pre_bal)) ? $pre_bal->closing_bal : 0.00;
                                            $closing_bal = 0.00;
                                        }
                                        
                            ?>   
                                    <div class="col-md-12">
                                        <fieldset class="scheduler-border"><br>
                                            <div class="col-md-12">
                                                <h3 align="center"><p style="font-size:25px;"><u><?php echo $value->name; ?></u></p></h3>
                                                <hr>
                                            </div>
                                            <div class="col-md-12">
<!--                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-1 col-form-label">Date : </label>
                                                    <div class="col-sm-10">
                                                        <p> <?php echo date("d-m-Y"); ?> </p>
                                                        <input type="hidden" name="baldata[<?php echo $value->id; ?>][bank_id]" value="<?php echo $value->id; ?>">
                                                    </div>
                                                </div>-->
                                                <input type="hidden" name="date" value="<?php echo $s_fdate; ?>">
                                                <input type="hidden" name="baldata[<?php echo $value->id; ?>][bank_id]" value="<?php echo $value->id; ?>">
                                                <div class="form-group row">
                                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Opening Balance : </label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control" id="opening_bal" name="baldata[<?php echo $value->id; ?>][opening_bal]" value="<?php echo $opening_bal; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Closing Balance : </label>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control closing_bal" id="closing_bal" name="baldata[<?php echo $value->id; ?>][closing_bal]" value="<?php echo $closing_bal; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            
  
                                        </fieldset>
                                    </div>
                            <?php            
                                    }
                                }
                            ?>
                            
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo 'Submit'; ?>
                            </button>
                        </div>
                    </form>
                    </div>
                </div>
            </div> 
            </form>

        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>


<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
    
</script>





</body>
</html>
