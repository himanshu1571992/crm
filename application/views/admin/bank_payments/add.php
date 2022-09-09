<?php init_head(); ?>
<style>table.items tr.main td { padding: 10px 10px !important;}.error{border:1px solid red !important;}</style>

<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">

           <form action="<?php if(!empty($id)){ echo admin_url('bank_payments/edit'); }else{ echo admin_url('bank_payments/add'); } ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
           
           <textarea name="availablestockhtml" id="availablestockhtml" style="display:none;"></textarea>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4><?php echo $title; ?></h4>
                                <hr/>
                            </div>

                           
                            <div class="col-md-6">
                                <label class="control-label">Company Code </label>
                                <input readonly="" type="text" class="form-control" value="SCHACH" name="company_code" id="company_code">
                            </div>

                            <div class="col-md-6">
                                <label class="control-label">Company Account </label>
                                <input readonly="" type="text" class="form-control" value="8111580589" name="account_no" id="account_no">
                            </div>


                         
                            
                            <div class="table-responsive s_table proddv" style="margin-top:19%;" >
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2%; !important">
                                    <thead>
                                        <tr>
                                            <th width="9%" align="left">Date</th>
                                            <th width="15%" align="left">Vendor Name</th>
                                            <th width="8%" align="left">IFSC</th>
                                            <th width="10%" align="left">Account No.</th>
                                            <th width="8%" align="left">Method</th>
                                            <th width="8%" align="left">Type</th>
                                            <th width="8%" align="left">Amount</th>
                                            <th width="10%" align="left">Remark 1</th>
                                            <th width="10%" align="left">Remark 2</th>
                                            <th width="2%"  align="center"><i class="fa fa-cog"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable">


                                            <?php
                                            if(!empty($payments_info)){

                                                foreach ($payments_info as $key => $row) {

                                                    ?>
                                                    <tr class="main" id="tr<?php echo $key;?>">

                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="date<?php echo $key;?>" name="paymentdata[<?php echo $key; ?>][date]" class="form-control date" value="<?php echo date('m/d/Y',strtotime($row->date));?>">
                                                            </div>
                                                        </td>


                                                        <td>
                                                            <div class="form-group">
                                                              <input required="" list="vendor<?php echo $key;?>" class="form-control" onchange="get_vendor_detl($key,this.value)" name="paymentdata[<?php echo $key; ?>][vendor]" value="<?php echo $row->vendor; ?>">
                                                                  <datalist id="vendor<?php echo $key;?>">
                                                                    <?php
                                                                    if(!empty($vendor_info)){
                                                                        foreach ($vendor_info as $value) {
                                                                            echo '<option value="'.$value['name'].'">';
                                                                           
                                                                        }
                                                                    }
                                                                    ?>
                                                                  </datalist>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" required="" id="ifsc<?php echo $key;?>" name="paymentdata[<?php echo $key; ?>][ifsc]" class="form-control" value="<?php echo $row->ifsc; ?>">
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" required="" id="account<?php echo $key;?>" name="paymentdata[<?php echo $key; ?>][account]" class="form-control" value="<?php echo $row->account; ?>">
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="form-group">
                                                                <select required="" class="form-control selectpicker" data-live-search="true" id="method<?php echo $key;?>" name="paymentdata[<?php echo $key; ?>][method]">
                                                                    <option value="NEFT" <?php if($row->method == 'NEFT'){ echo 'selected'; }?> >NEFT</option>
                                                                    <option value="RTGS" <?php if($row->method == 'RTGS'){ echo 'selected'; }?> >RTGS</option>
                                                                    <option value="IFT" <?php if($row->method == 'IFT'){ echo 'selected'; }?> >IFT</option>
                                                                </select>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="form-group">
                                                                <select required="" class="form-control selectpicker" data-live-search="true" id="type<?php echo $key;?>" name="paymentdata[<?php echo $key; ?>][type]">
                                                                    <option value="RPAY" <?php if($row->type == 'RPAY'){ echo 'selected'; }?> >RPAY</option>
                                                                    <option value="SALPAY" <?php if($row->type == 'SALPAY'){ echo 'selected'; }?> >SALPAY</option>
                                                                </select>
                                                            </div>
                                                        </td>

                                                         <td>
                                                            <div class="form-group">
                                                                <input type="text" required="" id="amount<?php echo $key;?>" name="paymentdata[<?php echo $key; ?>][amount]" class="form-control" value="<?php echo $row->amount; ?>">
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="form-group">
                                                                <textarea id="first_remark<?php echo $key;?>" name="paymentdata[<?php echo $key; ?>][first_remark]" class="form-control"><?php echo $row->first_remark; ?></textarea>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="form-group">
                                                                <textarea id="second_remark<?php echo $key;?>" name="paymentdata[<?php echo $key; ?>][second_remark]" class="form-control"><?php echo $row->second_remark; ?></textarea>
                                                            </div>
                                                        </td>
                                                        
                                                        <td>
                                                            <button type="button" class="btn pull-right btn-danger"  onclick="removeprocomp(<?php echo $key; ?>);" ><i class="fa fa-remove"></i></button>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    
                                                }

                                            }else{
                                                ?>
                                                <tr class="main" id="tr0">

                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="date0" name="paymentdata[0][date]" class="form-control date" value="<?php echo date('m/d/Y');?>">
                                                            </div>
                                                        </td>


                                                        <td>
                                                            <div class="form-group">
                                                              <input required="" list="vendor0" class="form-control" onchange="get_vendor_detl(0,this.value)" name="paymentdata[0][vendor]">
                                                                  <datalist id="vendor0">
                                                                    <?php
                                                                    if(!empty($vendor_info)){
                                                                        foreach ($vendor_info as $value) {
                                                                            echo '<option value="'.$value['name'].'">';
                                                                           
                                                                        }
                                                                    }
                                                                    ?>
                                                                  </datalist>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" required="" id="ifsc0" name="paymentdata[0][ifsc]" class="form-control" value="">
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" required="" id="account0" name="paymentdata[0][account]" class="form-control" value="">
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="form-group">
                                                                <select required="" class="form-control selectpicker" data-live-search="true" id="method0" name="paymentdata[0][method]">
                                                                    <option value="NEFT">NEFT</option>
                                                                    <option value="RTGS">RTGS</option>
                                                                    <option value="IFT">IFT</option>
                                                                </select>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="form-group">
                                                                <select required="" class="form-control selectpicker" data-live-search="true" id="type0" name="paymentdata[0][type]">
                                                                    <option value="RPAY">RPAY</option>
                                                                    <option value="SALPAY">SALPAY</option>
                                                                </select>
                                                            </div>
                                                        </td>

                                                         <td>
                                                            <div class="form-group">
                                                                <input type="text" required="" id="amount0" name="paymentdata[0][amount]" class="form-control" value="">
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="form-group">
                                                                <textarea id="first_remark0" name="paymentdata[0][first_remark]" class="form-control"></textarea>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="form-group">
                                                                <textarea id="second_remark0" name="paymentdata[0][second_remark]" class="form-control"></textarea>
                                                            </div>
                                                        </td>
                                                        
                                                        <td>
                                                            <button type="button" class="btn pull-right btn-danger"  onclick="removeprocomp('0');" ><i class="fa fa-remove"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php
                                            }
                                            ?>
                                        
                                            
                                        
                                    </tbody>
                                </table>
                                <div class="col-xs-12">
                                    <label class="label-control subHeads"><a class="addmorepro" value="<?php if(!empty($payments_info)){ echo count($payments_info); }else{ echo 0; } ?>">Add More <i class="fa fa-plus"></i></a></label>
                                </div>
                            </div>
                            <div class="ee"></div>
                            <div class="eeff"></div>
                        </div>

                        <?php
                        if(!empty($id)){
                            echo '<input type="hidden" value="'.$id.'" name="id">'; 
                        }
                        ?>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info check_availability" type="submit">Add Payments</button>
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
<script>

    $('.date').datepicker();
   
    $(document).on('click', '.addmorepro', function()     
    {
        


        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);

        $('#myproTable tbody').append('<tr class="main" id="tr'+newaddmore+'"> <td> <div class="form-group"> <input type="text" id="date'+newaddmore+'" name="paymentdata['+newaddmore+'][date]" class="form-control date" value="<?php echo date('m/d/Y');?>"> </div></td><td> <div class="form-group"> <input required="" list="vendor'+newaddmore+'" onchange="get_vendor_detl('+newaddmore+',this.value)" class="form-control" name="paymentdata['+newaddmore+'][vendor]"> <datalist id="vendor'+newaddmore+'"> <?php if(!empty($vendor_info)){foreach ($vendor_info as $value){echo '<option value="'.$value['name'].'">'; }} ?> </datalist> </div></td><td> <div class="form-group"> <input type="text" required="" id="ifsc'+newaddmore+'" name="paymentdata['+newaddmore+'][ifsc]" class="form-control" value=""> </div></td><td> <div class="form-group"> <input type="text" required="" id="account'+newaddmore+'" name="paymentdata['+newaddmore+'][account]" class="form-control" value=""> </div></td><td> <div class="form-group"> <select required="" class="form-control selectpicker" data-live-search="true" id="method'+newaddmore+'" name="paymentdata['+newaddmore+'][method]"> <option value="NEFT">NEFT</option> <option value="RTGS">RTGS</option> <option value="IFT">IFT</option> </select> </div></td><td> <div class="form-group"> <select required="" class="form-control selectpicker" data-live-search="true" id="type'+newaddmore+'" name="paymentdata['+newaddmore+'][type]"> <option value="RPAY">RPAY</option> <option value="SALPAY">SALPAY</option> </select> </div></td><td> <div class="form-group"> <input type="text" required="" id="amount'+newaddmore+'" name="paymentdata['+newaddmore+'][amount]" class="form-control" value=""> </div></td> <td> <div class="form-group"> <textarea id="first_remark'+newaddmore+'" name="paymentdata['+newaddmore+'][first_remark]" class="form-control"></textarea> </div></td><td> <div class="form-group"> <textarea id="second_remark'+newaddmore+'" name="paymentdata['+newaddmore+'][second_remark]" class="form-control"></textarea> </div></td><td> <button type="button" class="btn pull-right btn-danger" onclick="removeprocomp('+newaddmore+');" ><i class="fa fa-remove"></i></button> </td></tr>');



    $('.selectpicker').selectpicker('refresh');
    $('.date').datepicker();
    });
    function removeprocomp(procompid)
    {
        $('#tr' + procompid).remove();
    }

    function get_vendor_detl(i,vendor)
    {
        
        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/bank_payments/get_vendor_detl'); ?>",
            data    : {'vendor' : vendor},
            success:function(res) {
                var data=JSON.parse(res);
                $('#ifsc'+i).val(data.ifsc);
                $('#account'+i).val(data.account_no);
            }
        })

    }       
    
    </script>
</body>
</html>