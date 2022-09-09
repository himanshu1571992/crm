<style>
    .title-panel {
        font-size: 15px;
        color:#03a9f4;
    }
</style>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <?php 
        $expense_type = '';
        $expense_requests = array();
        $expense_number = $expensehead_name = $typesub_name = $related_to = $related_name = $purpose ="--";
        $from_destination = $to_destination = $t_mode = $kilometer_limit = $amount = $note = $tempo_owner = "--";
        $billtype = $modal_title = $tempo_name = $tempo_number = $tempo_driver_name = $tempo_driver_number = "--";
        $bill_type_id = 0;
        $expense_info = array();
        
        if (!empty($expense_details) && isset($expense_details["main_receipt"])){
            $expense_info = $expense_details["main_receipt"];
            $expense_number = 'EXP-'.get_short(get_expense_category($category_id)).'-'.number_series($expense_id);
            $expense_type = $expense_details["main_receipt"]["type_name"];
            if ($category_id == 6){
                $modal_title = "Extra Bill";
            }else{
                $modal_title = get_expense_category($category_id);
            }
            
            $expensehead_name = $expense_details["main_receipt"]["head_name"];
            $typesub_name = $expense_info['typesub_name'];
            $related_to = $expense_info['related_to'];
            $related_name = $expense_info['related_name'];
            $purpose = $expense_info['purpose'];
            
            $t_mode = $expense_info['t_mode'];
            $kilometer_limit = $expense_info['kilometer_limit'].' Km';
            $amount = $expense_info['amount'];
            $note = $expense_info['note'];
            if ($expense_info['extra_bill_type'] == 1){
                $billtype = "With Bill";
                $bill_type_id = $expense_info['extra_bill_type'];
            }else if ($expense_info['extra_bill_type'] == 2){
                $billtype = "Without Bill";
                $bill_type_id = $expense_info['extra_bill_type'];
            }else if ($expense_info['extra_bill_type'] == 3){
                $billtype = "With GST Bill";
                $bill_type_id = $expense_info['extra_bill_type'];
            }
            $billfield = 'extra_bill_type';
            if ($category_id == 2){
                $bill_type_id = $expense_info['tempo_bill_type'];
                $billfield = 'tempo_bill_type';
            }
            if ($category_id == 4){
                $bill_type_id = $expense_info['hotel_bill_type'];
                $billfield = 'hotel_bill_type';
            }
            $expense_requests = $expense_info["request_ids"];
            $tempo_name = $expense_info["tempo_name"];
            $tempo_number = $expense_info["tempo_number"];
            $tempo_driver_name = $expense_info["tempo_driver_name"];
            $tempo_driver_number = $expense_info["tempo_driver_number"];
            $tempo_owner = $expense_info["tempo_owner"];
            if ($category_id == 2){
                $from_destination = $expense_info['tempo_from_destination'];
                $to_destination = $expense_info['tempo_to_destination'];
            }else{
                $from_destination = $expense_info['from_destination'];
                $to_destination = $expense_info['to_destination'];
            }
            
        }
        /* Logistic Section */
        $logistic_from_person_name = (isset($expense_info['logistic_from_person_name'])) ? $expense_info['logistic_from_person_name'] : '--';
        $logistic_from_person_no = (isset($expense_info['logistic_from_person_no'])) ? $expense_info['logistic_from_person_no'] : '--';
        $logistic_from_address = (isset($expense_info['logistic_from_address'])) ? $expense_info['logistic_from_address'] : '--';
        $logistic_from_state = (isset($expense_info['logistic_from_state'])) ? $expense_info['logistic_from_state'] : '--';
        $logistic_from_city = (isset($expense_info['logistic_from_city'])) ? $expense_info['logistic_from_city'] : '--';
        $logistic_from_pin = (isset($expense_info['logistic_from_pin'])) ? $expense_info['logistic_from_pin'] : '--';
        $logistic_to_person_name = (isset($expense_info['logistic_to_person_name'])) ? $expense_info['logistic_to_person_name'] : '--';
        $logistic_to_person_no = (isset($expense_info['logistic_to_person_no'])) ? $expense_info['logistic_to_person_no'] : '--';
        $logistic_to_address = (isset($expense_info['logistic_to_address'])) ? $expense_info['logistic_to_address'] : '--';
        $logistic_to_state = (isset($expense_info['logistic_to_state'])) ? $expense_info['logistic_to_state'] : '--';
        $logistic_to_city = (isset($expense_info['logistic_to_city'])) ? $expense_info['logistic_to_city'] : '--';
        $logistic_to_pin = (isset($expense_info['logistic_to_pin'])) ? $expense_info['logistic_to_pin'] : '--';
        $logistic_paid_by = (isset($expense_info['logistic_paid_by'])) ? $expense_info['logistic_paid_by'] : '--';
        
        /* Food Section */
        $meal_type = (isset($expense_info['meal_type'])) ? $expense_info['meal_type'] : '--';
        $payforperson = (isset($expense_info['pay_for_person'])) ? $expense_info['pay_for_person'] : '--';
        
        /* Hotel Section */
        $hotel_name = (isset($expense_info['hotel_name'])) ? $expense_info['hotel_name'] : '--';
        $hotel_no = (isset($expense_info['hotel_no'])) ? $expense_info['hotel_no'] : '--';
        $hotel_address = (isset($expense_info['hotel_address'])) ? cc($expense_info['hotel_address']) : '--';
        $stay_from = (isset($expense_info['stay_from'])) ? $expense_info['stay_from'] : '--';
        $stay_to = (isset($expense_info['stay_to'])) ? $expense_info['stay_to'] : '--';
        $stay_day = (isset($expense_info['stay_day'])) ? $expense_info['stay_day'] : '--';
        $person_no = (isset($expense_info['person_no'])) ? $expense_info['person_no'] : '--';
        $pay_date = (isset($expense_info['pay_date'])) ? $expense_info['pay_date'] : '--';
        $hotel_paid_by = (isset($expense_info['hotel_paid_by'])) ? $expense_info['hotel_paid_by'] : '--';
        
    ?>
    <h4 class="modal-title"><?php echo $modal_title; ?> Details</h4>
</div>
<div class="modal-body">
    <div class="panel_s panel-body">
        <div class="col-md-12">
            <label for="id" class="title-panel">ID :</label> <span><?php echo $expense_number; ?></span>
        </div>
        <div class="col-md-12">    
            <label for="expensehead_name" class="title-panel">Expense Head :</label> <span><?php echo $expensehead_name; ?></span>
        </div>
        <div class="col-md-12">    
            <label for="expense_type" class="title-panel">Expense Type :</label> <span><?php echo $expense_type; ?></span>
        </div>
        <div class="col-md-12">    
            <label for="typesub_name" class="title-panel">Expense Sub Type :</label> <span><?php echo $typesub_name; ?></span>
        </div>
        <div class="col-md-12">    
            <label for="related_to" class="title-panel">Related To :</label> <span><?php echo $related_to; ?></span>
        </div>
        <div class="col-md-12">    
            <label for="related_name" class="title-panel">Related Name :</label> <span><?php echo $related_name; ?></span>
        </div>
        <div class="col-md-12">    
            <label for="purpose" class="title-panel">Purpose :</label> <span><?php echo $purpose; ?></span>
        </div>
        <?php if ($category_id == '1' || $category_id == '2'){ ?>
            <div class="col-md-12">    
                <label for="from_destination" class="title-panel">Source :</label> <span><?php echo $from_destination; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="to_destination" class="title-panel">Destination :</label> <span><?php echo $to_destination; ?></span>
            </div>
            <?php if ($category_id == '1'){ ?>
                <div class="col-md-12">    
                    <label for="t_mode" class="title-panel">Travel Mode :</label> <span><?php echo $t_mode; ?></span>
                </div>
                <div class="col-md-12">    
                    <label for="kilometer_limit" class="title-panel">Kilometer Limit :</label> <span><?php echo $kilometer_limit; ?></span>
                </div>
        <?php }} ?> 
        <?php if ($category_id == '2'){ ?>
            <div class="col-md-12">    
                <label for="tempo_name" class="title-panel">Tempo Name :</label> <span><?php echo $tempo_name; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="amount" class="title-panel">Tempo Number :</label> <span><?php echo $tempo_number; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="amount" class="title-panel">Tempo Driver Name :</label> <span><?php echo $tempo_driver_name; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="amount" class="title-panel">Tempo Driver Number :</label> <span><?php echo $tempo_driver_number; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="amount" class="title-panel">Tempo Owner :</label> <span><?php echo $tempo_owner; ?></span>
            </div>
        <?php } ?>
        <?php if ($category_id == '3'){ ?>
            <div class="col-md-12">    
                <label for="meal_type" class="title-panel">Meal Type :</label> <span><?php echo $meal_type; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="payforperson" class="title-panel">Pay For Person :</label> <span><?php echo $payforperson; ?></span>
            </div>
        <?php } ?>  
        <?php if ($category_id == '4'){ ?>
            <div class="col-md-12">    
                <label for="hotel_name" class="title-panel">Hotel Name :</label> <span><?php echo $hotel_name; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="hotel_no" class="title-panel">Hotel No :</label> <span><?php echo $hotel_no; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="hotel_address" class="title-panel">Hotel Address :</label> <span><?php echo $hotel_address; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="stay_from" class="title-panel">Stay From :</label> <span><?php echo $stay_from; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="stay_to" class="title-panel">Stay To :</label> <span><?php echo $stay_to; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="stay_day" class="title-panel">Stay Day :</label> <span><?php echo $stay_day; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="person_no" class="title-panel">Person No :</label> <span><?php echo $person_no; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="pay_date" class="title-panel">Pay Date :</label> <span><?php echo $pay_date; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="hotel_paid_by" class="title-panel">Paid By :</label> <span><?php echo $hotel_paid_by; ?></span>
            </div>
        <?php } ?>   
        <?php if ($category_id == '5'){ ?>
            <div class="col-md-12">    
                <label for="logistic_from_person_name" class="title-panel">From Person Name :</label> <span><?php echo $logistic_from_person_name; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="logistic_from_person_no" class="title-panel">From Person No. :</label> <span><?php echo $logistic_from_person_no; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="logistic_from_address" class="title-panel">From Address :</label> <span><?php echo $logistic_from_address; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="logistic_from_state" class="title-panel">From State :</label> <span><?php echo $logistic_from_state; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="logistic_from_city" class="title-panel">From City :</label> <span><?php echo $logistic_from_city; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="logistic_from_pin" class="title-panel">From Pin :</label> <span><?php echo $logistic_from_pin; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="logistic_to_person_name" class="title-panel">To Person Name :</label> <span><?php echo $logistic_to_person_name; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="logistic_to_person_no" class="title-panel">To Person No. :</label> <span><?php echo $logistic_to_person_no; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="logistic_to_address" class="title-panel">To Address :</label> <span><?php echo $logistic_to_address; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="logistic_to_state" class="title-panel">To State :</label> <span><?php echo $logistic_to_state; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="logistic_to_city" class="title-panel">To City :</label> <span><?php echo $logistic_to_city; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="logistic_to_pin" class="title-panel">To Pin :</label> <span><?php echo $logistic_to_pin; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="logistic_paid_by" class="title-panel">Paid By :</label> <span><?php echo $logistic_paid_by; ?></span>
            </div>
        <?php } ?>     
        <div class="col-md-12">    
            <label for="amount" class="title-panel">Amount :</label> <span>&#8377; <?php echo $amount; ?></span>
        </div>
        <?php if ($category_id == '6'){ ?>
            <div class="col-md-12">    
                <label for="billtype" class="title-panel">Bill Type :</label> <span><?php echo $billtype; ?></span>
            </div>
            <div class="col-md-12">    
                <label for="remark" class="title-panel">Remark :</label> <span><?php echo $note; ?></span>
            </div>
        <?php }else{ ?>    
            <div class="col-md-12"> 
                <label for="note" class="title-panel">Description :</label> <span><?php echo $note; ?></span>
            </div>
        <?php } ?>    
        <?php 
            if ($category_id == '6' || $category_id == '2' || $category_id == '4'){
                if ($approve_status == "0"){
        ?>
            <div class="col-md-12">
                <br>
                <div class="form-group">
                    <label for="bill_type" class="control-label title-panel">Bill :</label>
                    <select class="form-control selectpicker" onchange="changebilltype(this.value, '<?php echo $expense_id; ?>', '<?php echo $billfield; ?>');" id="bill_type" name="bill_type" >
                        <option value="" disabled selected >--Select Type-</option>
                        <option value="1" <?php echo (isset($bill_type_id) && $bill_type_id == 1) ? 'selected' : "" ?>>With Bill</option>
                        <option value="2" <?php echo (isset($bill_type_id) && $bill_type_id == 2) ? 'selected' : "" ?>>Without Bill</option>
                        <option value="3" <?php echo (isset($bill_type_id) && $bill_type_id == 3) ? 'selected' : "" ?>>With GST Bill</option>
                    </select>
                </div>
            </div>
        <?php 
                }
            }    
        ?>
    </div>
    <?php if (!empty($expense_details) && isset($expense_details["sub_receipt"]) && !empty($expense_details["sub_receipt"])){ ?>
        <div class="panel_s panel-body">
            <h4 class="no-margin">Repeats :</h4>
            <hr class="hr-panel-heading">
            <div class="card" >
                <ul class="list-group list-group-flush">
                    <?php 
                        foreach ($expense_details["sub_receipt"] as $sub_receipt) {
                    ?>
                            <div class="panel-body">
                                <?php if ($category_id == 1 || $category_id == 2){ ?>
                                    <div class="col-md-12">
                                        <label for="source" class="col-3 title-panel">Source &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["from_destination"]; ?></span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="destination" class="col-3 title-panel">Destination &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["to_destination"]; ?></span>
                                    </div>
                                <?php } ?>    
                                <?php if ($category_id == 1){ ?>    
                                    <div class="col-md-12">
                                        <label for="travel_mode" class="col-3 title-panel">Travel Mode &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["t_mode"]; ?></span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="kilometer_limit" class="col-3 title-panel">Kilometer Limit &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["kilometer_limit"]; ?></span>
                                    </div>
                                <?php } ?>
                                <?php if ($category_id == 2){ ?>    
                                    <div class="col-md-12">
                                        <label for="tempo_name" class="col-3 title-panel">Tempo Name &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["tempo_name"]; ?></span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="tempo_number" class="col-3 title-panel">Tempo Number &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["tempo_number"]; ?></span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="tempo_driver_name" class="col-3 title-panel">Tempo Driver Name &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["tempo_driver_name"]; ?></span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="tempo_driver_number" class="col-3 title-panel">Tempo Driver Number &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["tempo_driver_number"]; ?></span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="tempo_owner" class="col-3 title-panel">Tempo Owner &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["tempo_owner"]; ?></span>
                                    </div>
                                <?php } ?>
                                <?php if ($category_id == 5){ ?>
                                    <div class="col-md-12">
                                        <label for="logistic_from_person_name" class="col-3 title-panel">From Person Name &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["logistic_from_person_name"]; ?></span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="logistic_from_person_no" class="col-3 title-panel">From Person No &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["logistic_from_person_no"]; ?></span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="logistic_from_address" class="col-3 title-panel">From Address &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["logistic_from_address"]; ?></span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="logistic_from_state" class="col-3 title-panel">From State &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["logistic_from_state"]; ?></span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="logistic_from_city" class="col-3 title-panel">From City &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["logistic_from_city"]; ?></span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="logistic_from_pin" class="col-3 title-panel">From Pin &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["logistic_from_pin"]; ?></span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="logistic_to_person_name" class="col-3 title-panel">To Person Name &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["logistic_to_person_name"]; ?></span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="logistic_to_person_no" class="col-3 title-panel">To Person No &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["logistic_to_person_no"]; ?></span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="logistic_to_address" class="col-3 title-panel">To Address &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["logistic_to_address"]; ?></span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="logistic_to_state" class="col-3 title-panel">To State &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["logistic_to_state"]; ?></span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="logistic_to_city" class="col-3 title-panel">To City &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["logistic_to_city"]; ?></span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="logistic_to_pin" class="col-3 title-panel">To Pin &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["logistic_to_pin"]; ?></span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="logistic_paid_by" class="col-3 title-panel">Paid By &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["logistic_paid_by"]; ?></span>
                                    </div>
                                <?php } ?>     
                                <div class="col-md-12">
                                    <label for="id" class="col-3 title-panel">Amount &nbsp;&nbsp;:</label>
                                    <span class="pull-right">&#8377; <?php echo $sub_receipt["amount"]; ?></span>
                                </div>
                                <?php if ($category_id == 6){ ?>
                                    <div class="col-md-12">
                                        <label for="id" class="col-3 title-panel">Expense Sub Type &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["typesub_name"]; ?></span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="id" class="col-3 title-panel">Remark &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["note"]; ?></span>
                                    </div>
                                <?php }else{ ?>
                                    <div class="col-md-12">
                                        <label for="id" class="col-3 title-panel">Description &nbsp;&nbsp;:</label>
                                        <span class="pull-right"><?php echo $sub_receipt["note"]; ?></span>
                                    </div>
                                <?php } ?>    
                            </div>
                    <?php      
                        }
                    ?>
                </ul>
            </div>
        </div>
    <?php } ?>
    <?php if (!empty($expense_requests)){ ?>
        <div class="panel_s panel-body">
            <h4 class="no-margin">Linked Request :</h4>
            <hr class="hr-panel-heading">
            <div class="card" >
                <ul class="list-group list-group-flush">
                    <?php 
                        foreach ($expense_requests as $requests) {
                    ?>
                            <li class="list-group-item">
                                <label for="id" class="col-3 title-panel"><?php echo $requests["request_no"]; ?></label>
                                <span class="text-danger pull-right">&#8377; <?php echo $requests["amount"]; ?></span>
                            </li>
                    <?php      
                        }
                    ?>
                </ul>
            </div>
        </div>
    <?php } ?>    
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
<script>
    function changebilltype(bill_type, expense_id, field){
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url('admin/expenses/change_bill_type'); ?>",
            data    : {'expense_id': expense_id, 'bill_type' : bill_type, 'field' : field},
            success : function(response){
                if(response != ''){

                    alert(response);
                }
            }
        });
    }
</script>
