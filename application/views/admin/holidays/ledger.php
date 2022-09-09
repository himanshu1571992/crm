
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
	
	/*new style*/
	
	.sheetWrapper {
		margin-bottom: 50px;
	}
	
	.company-title {
		text-transform: uppercase;
		font-weight: 600;
		letter-spacing: 1.5px;
		color: rgb(39, 39, 39);
		font-size: 23px;
	}
	
	.sec-title {
		position: relative;
		z-index: 1;
		margin-bottom:40px;
	}
	.separator {
		margin: 0 auto !important;
		float: none !important;
		width: 40px;
		position: relative;
	}
	.separator span {
		position: absolute;
		left: 50%;
		top: -2px;
		width: 10px;
		height: 5px;
		margin-left: -5px;
		display: inline-block;
		background-color:#2e2e2e;
	}
	
	.separator:before {
		position: absolute;
		content: '';
		left: 0px;
		top: 0px;
		width: 10px;
		height: 2px;
		background-color: rgb(241, 106, 46);
	}
	
	.separator:after {
		position: absolute;
		content: '';
		right: 0px;
		top: 0px;
		width: 10px;
		height: 2px;
		background-color: rgb(241, 106, 46);
	}
	
	.details-table{
		border: 1px solid #F0F2F5;
		box-shadow:0 5px 70px rgba(0, 0, 0, 0.07);
	}
	
	.details-table thead tr{
		background: #4045bf;
		box-shadow:0 3px 15px rgba(76, 76, 77, 0.15);
	}
	
	.details-table thead th{
		padding: 15px 5px !important;
		color: #fff !important;
		font-weight: 500 !important;
		letter-spacing: 0.4px;
		border: none !important;
		font-size: 12px;
	}
	
	.details-table tbody td{
		vertical-align: middle !important;
		padding:10px 5px !important;
		font-weight: 500;
	}
	
	.details-table > tbody > tr:nth-child(even){
		background:#F0F2F5;
	}
	
	.details-table tfoot {
		background: #f0f2f5;
	}
	
	.details-table tfoot td{
		font-size: 14px;
		font-weight:500;
		border-top: 1px solid #e5e5e5 !important;
	}
	
	.details-table tfoot td b {
		font-weight:500;
		color: rgb(39, 39, 39);
		text-transform: uppercase;
		letter-spacing: 0.5px;
		font-size: 14px;
	}
	
</style>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin">Client Ledger</h4>

                    <hr class="hr-panel-heading">

                    <div class="row">
                    
                    <div>
                        <div class="col-md-4" id="employee_div">
                            <div class="form-group ">
                                <label for="branch_id" class="control-label"><?php echo 'Year'; ?> *</label>
                                <select class="form-control" id="year" name="year">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                    $j = date('Y');
                                    for($i=2018; $i<=$j; $i++){
                                        ?>
                                        <option value="<?php echo $i;?>" <?php if(!empty($year) && $year == $i){ echo 'selected';} ?>  ><?php echo $i; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-4">                            
                            <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
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

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="panel_s">
				<div class="panel-body">
					<div class="sheetWrapper">
						<div class="sec-title">
							<h3 class="text-center company-title">Company Co. Ltd</h3>
							<div class="separator"><span></span></div>
						</div>
						<table class="table details-table">
							<thead>
								<tr>
									<th>Rental Tunure Start Date</th>
									<th>Rental Tunure Due Date</th>
									<th>Invoice Number</th>
									<th>Invoice Date</th>
									<th>Invoice Amt</th>
									<th>Invoice recd</th>
									<th>TDS</th>
									<th>Payment Balance</th>
									<th>Remarks</th>
									<th>Payment Receipt Date</th>
									<th>Payment Ref Detail</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>05-11-2019</td>
									<td>XXX</td>
									<td>XXX/RT/19-20</td>
									<td>DD/MM/YYYY</td>
									<td>10</td>
									<td>9</td>
									<td>1</td>
									<td>0</td>
									<td>--------------------------</td>
									<td>DD/MM/YYYY</td>
									<td>ChqNo/IMPS/NEFT</td>
								</tr>
								<tr>
									<td>05-11-2019</td>
									<td>XXX</td>
									<td>XXX/RT/19-20</td>
									<td>DD/MM/YYYY</td>
									<td>10</td>
									<td>9</td>
									<td>1</td>
									<td>0</td>
									<td>--------------------------</td>
									<td>DD/MM/YYYY</td>
									<td>ChqNo/IMPS/NEFT</td>
								</tr>
								<tr>
									<td>05-11-2019</td>
									<td>XXX</td>
									<td>XXX/RT/19-20</td>
									<td>DD/MM/YYYY</td>
									<td>10</td>
									<td>9</td>
									<td>1</td>
									<td>0</td>
									<td>--------------------------</td>
									<td>DD/MM/YYYY</td>
									<td>ChqNo/IMPS/NEFT</td>
								</tr>
							</tbody>
							
							<tfoot>
								<tr>
									<td colspan="4" class="text-center"><b>Balance</b></td>
									<td colspan="4" class="text-center">58000</td>
									<td colspan="3"></td>
								</tr>
								<tr>
									<td colspan="4" class="text-center"><b>Onaccount</b></td>
									<td colspan="4" class="text-center">58000</td>
									<td colspan="3"></td>
								</tr>
								<tr>
									<td colspan="4" class="text-center"><b>Total Balance</b></td>
									<td colspan="4" class="text-center">58000</td>
									<td colspan="3"></td>
								</tr>
							</tfoot>
							
						</table>
					</div><!---->
					
					
										<div class="sheetWrapper">
						<div class="sec-title">
							<h3 class="text-center company-title">Company Co. Ltd</h3>
							<div class="separator"><span></span></div>
						</div>
						<table class="table details-table">
							<thead>
								<tr>
									<th>Rental Tunure Start Date</th>
									<th>Rental Tunure Due Date</th>
									<th>Invoice Number</th>
									<th>Invoice Date</th>
									<th>Invoice Amt</th>
									<th>Invoice recd</th>
									<th>TDS</th>
									<th>Payment Balance</th>
									<th>Remarks</th>
									<th>Payment Receipt Date</th>
									<th>Payment Ref Detail</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>05-11-2019</td>
									<td>XXX</td>
									<td>XXX/RT/19-20</td>
									<td>DD/MM/YYYY</td>
									<td>10</td>
									<td>9</td>
									<td>1</td>
									<td>0</td>
									<td>--------------------------</td>
									<td>DD/MM/YYYY</td>
									<td>ChqNo/IMPS/NEFT</td>
								</tr>
								<tr>
									<td>05-11-2019</td>
									<td>XXX</td>
									<td>XXX/RT/19-20</td>
									<td>DD/MM/YYYY</td>
									<td>10</td>
									<td>9</td>
									<td>1</td>
									<td>0</td>
									<td>--------------------------</td>
									<td>DD/MM/YYYY</td>
									<td>ChqNo/IMPS/NEFT</td>
								</tr>
								<tr>
									<td>05-11-2019</td>
									<td>XXX</td>
									<td>XXX/RT/19-20</td>
									<td>DD/MM/YYYY</td>
									<td>10</td>
									<td>9</td>
									<td>1</td>
									<td>0</td>
									<td>--------------------------</td>
									<td>DD/MM/YYYY</td>
									<td>ChqNo/IMPS/NEFT</td>
								</tr>
							</tbody>
							
							<tfoot>
								<tr>
									<td colspan="4" class="text-center"><b>Balance</b></td>
									<td colspan="4" class="text-center">58000</td>
									<td colspan="3"></td>
								</tr>
								<tr>
									<td colspan="4" class="text-center"><b>Onaccount</b></td>
									<td colspan="4" class="text-center">58000</td>
									<td colspan="3"></td>
								</tr>
								<tr>
									<td colspan="4" class="text-center"><b>Total Balance</b></td>
									<td colspan="4" class="text-center">58000</td>
									<td colspan="3"></td>
								</tr>
							</tfoot>
							
						</table>
					</div>


                    <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" value="1" name="mark" type="submit">
                                <?php echo _l('submit'); ?>
                            </button>
                        </div>
					
					
				</div>
			</div>
		</div>
	</div>
</div>

<?php init_tail(); ?>


</body>
</html>
