<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
class Sales_report extends Admin_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
	}

	/* this function use for sales report */
	public function rent_invoice_list(){
		check_permission(394,'view');
		$data["title"] = "Rent Invoice Report";
		$data["month_list"] = array(); //added
		$data["yearmonth"] = array();
		if(!empty($_POST)){
			extract($this->input->post());

			$data["f_date"] = $from_date;
			$data["s_date"] = $to_date;
			while (strtotime($from_date.'-01') <= strtotime($to_date.'-28')) {
				$data["month_list"][] = date("Y-m-d", strtotime($from_date));
				$data["yearmonth"][] = "'".date("M-Y", strtotime($from_date))."'";
				$from_date = date ("Y-m-d", strtotime("+1 month", strtotime($from_date)));
			}
		}else{

			$month_list = $this->db->query("SELECT * FROM `tblmonths` order by id asc ")->result();
			if (!empty($month_list)){
				 foreach ($month_list as $value) {
					   $date = date("Y").'-'.$value->id.'-28';
				 	   $data["month_list"][] = date("Y-m-d", strtotime($date));
						 $data["yearmonth"][] = "'".date("M-Y", strtotime($date))."'";
				 }
			}
		}

		$data["yearmonth"] = implode(",", $data["yearmonth"]);

		$this->load->view('admin/sales_report/rent_invoice_report', $data);
	}
	public function rent_invoice_list_old(){

		$data["title"] = "Rent Invoice Report";
		$where = "parent_id=0 and service_type=1 and MONTH(invoice_date) = ".date('m')." and YEAR(invoice_date) = ".date('Y')."  ";
		$where2 = "parent_id > 0 and service_type=1 and MONTH(invoice_date) = ".date('m')." and YEAR(invoice_date) = ".date('Y')." ";
		$data['s_month'] = $data['s_month2'] = date('m');
		$data['s_year'] = $data['s_year2'] = date('Y');
		$data["section"] = 1;
		if(!empty($_POST)){
			extract($this->input->post());
			$data["section"] = $section;
			if ($section == 1){
				$where = "parent_id=0 and service_type=1";
				if(!empty($client_id)){
					$data['client_id'] = $client_id;
					$where .= " and clientid = '".$client_id."'";
				}
				if(!empty($month) && !empty($year)){
					$data['s_month'] = $month;
					$data['s_year'] = $year;
					$where .= " and MONTH(invoice_date) = ".$month." and YEAR(invoice_date) = ".$year."";
				}
			}else if($section == 2){
				$where2 = "parent_id > 0 and service_type=1";
				if(!empty($client_id2)){
					$data['client_id2'] = $client_id2;
					$where2 .= " and clientid = '".$client_id2."'";
				}
				if(!empty($month2) && !empty($year2)){
					$data['s_month2'] = $month2;
					$data['s_year2'] = $year2;
					$where2 .= " and MONTH(invoice_date) = ".$month2." and YEAR(invoice_date) = ".$year2."";
				}
			}
		}

		$this->load->model('Client_model');
		$client_data = $this->Client_model->get();
		$i=0;
		foreach($client_data as $singleclient)
		{
			$i++;
			$clientd[$i]['id']=$singleclient['userid'];
			$clientd[$i]['companyname']=$singleclient['client_branch_name'].' - '.$singleclient['email_id'];
		}
		$data['client_branch_data'] =$clientd;

		$data["title"] = "Rent Invoice Report";
		$data["rent_invoice_report"] = $this->db->query("SELECT * FROM `tblinvoices` WHERE $where ORDER BY id DESC")->result();

		$data["invoice_amount"] = $this->db->query("SELECT sum(total) as ttl_amt FROM `tblinvoices` WHERE $where ")->row()->ttl_amt;
		$data['taxable_value'] = $this->db->query("SELECT sum(total_tax) as tax_val from `tblinvoices` WHERE ".$where." ")->row()->tax_val;

		$data["closing_report"] = $this->db->query("SELECT * FROM `tblinvoices` WHERE $where2 GROUP BY parent_id ORDER BY id DESC")->result();
		// echo $this->db->last_query();
		// exit;
		// $data["closing_report"] = $this->db->query("SELECT * FROM `tblinvoices` WHERE id IN (SELECT MAX(id) FROM `tblinvoices` WHERE $where2 GROUP BY parent_id) AND  $where2  ORDER BY id DESC")->result();

		// $data["ttlclosing_amount"] = $this->db->query("SELECT sum(total) as ttl_amt FROM `tblinvoices` WHERE id IN (SELECT MAX(id) FROM `tblinvoices` WHERE $where2 GROUP BY parent_id) AND  $where2  ORDER BY id DESC")->row()->ttl_amt;
		// $data["ttlclosing_taxamount"] = $this->db->query("SELECT sum(total_tax) as tax_val FROM `tblinvoices` WHERE id IN (SELECT MAX(id) FROM `tblinvoices` GROUP BY parent_id) AND  $where2  ORDER BY id DESC")->row()->tax_val;

		$data['month_list'] = $this->db->query("SELECT * FROM `tblmonths` order by id asc ")->result();
		$data['client_data'] = $this->db->query("SELECT `client_branch_name`,`userid` from `tblclientbranch` WHERE company_branch = '0' ORDER BY client_branch_name ASC ")->result();
		$this->load->view('admin/sales_report/rent_invoice_report', $data);
	}

	public function opening_rent_invoice($month, $year){
		$data["title"] = "Opening Rent Invoice Report";
		$data["invoice_report"] = $this->db->query("SELECT * FROM `tblinvoices` WHERE status != 5 and parent_id=0 and service_type=1 and MONTH(invoice_date) = ".$month." and YEAR(invoice_date) = ".$year." ORDER BY id DESC")->result();
		$data["invoice_amount"] = $this->db->query("SELECT sum(total) as ttl_amt FROM `tblinvoices` WHERE status != 5 and parent_id=0 and service_type=1 and MONTH(invoice_date) = ".$month." and YEAR(invoice_date) = ".$year." ")->row()->ttl_amt;
		$data['taxable_value'] = $this->db->query("SELECT sum(total_tax) as tax_val from `tblinvoices` WHERE status != 5 and parent_id=0 and service_type=1 and MONTH(invoice_date) = ".$month." and YEAR(invoice_date) = ".$year." ")->row()->tax_val;
		$this->load->view('admin/sales_report/opening_invoice_report', $data);
	}

	public function closing_rent_invoice($month, $year){
		$data["title"] = "Closing Rent Invoice Report";
		$data["invoice_report"] = $this->db->query("SELECT * FROM `tblinvoices` WHERE service_type=1 and status != 5 and rental_status IN (1,3) and MONTH(invoice_date) = ".$month." and YEAR(invoice_date) = ".$year."")->result();
		$data["invoice_amount"] = $this->db->query("SELECT sum(total) as ttl_amt FROM `tblinvoices` WHERE service_type=1 and status != 5 and rental_status IN (1,3) and MONTH(invoice_date) = ".$month." and YEAR(invoice_date) = ".$year." ")->row()->ttl_amt;
		$data['taxable_value'] = $this->db->query("SELECT sum(total_tax) as tax_val from `tblinvoices` WHERE service_type=1 and status != 5 and rental_status IN (1,3) and MONTH(invoice_date) = ".$month." and YEAR(invoice_date) = ".$year." ")->row()->tax_val;
		$this->load->view('admin/sales_report/closing_invoice_report', $data);
	}
	public function rent_details($invoice_id){
		$data["title"] = "Sub Invoices";
		$data["parent_data"] = $this->db->query("SELECT cb.client_branch_name FROM `tblclientbranch` as cb LEFT JOIN `tblinvoices` as i ON i.clientid = cb.userid WHERE i.id = '".$invoice_id."'  ")->row();

		$data["rent_invoice_report"] = $this->db->query("SELECT * FROM `tblinvoices` WHERE parent_id = '".$invoice_id."' ")->result();
		$data["invoice_amount"] = $this->db->query("SELECT sum(total) as ttl_amt FROM `tblinvoices` WHERE parent_id = '".$invoice_id."' ")->row()->ttl_amt;
		$data['taxable_value'] = $this->db->query("SELECT sum(total_tax) as tax_val from `tblinvoices` WHERE parent_id = '".$invoice_id."' ")->row()->tax_val;
		$data['month_list'] = $this->db->query("SELECT * FROM `tblmonths` order by id asc ")->result();
		$this->load->view('admin/sales_report/rent_invoice_details', $data);
	}

	public function closing_details($invoice_id){
		$data["title"] = "Sub Invoices";
		$parent_data = $this->db->query("SELECT cb.client_branch_name, i.parent_id FROM `tblclientbranch` as cb LEFT JOIN `tblinvoices` as i ON i.clientid = cb.userid WHERE i.id = '".$invoice_id."'  ")->row();
		$data["parent_data"] = $parent_data;
		$data["rent_invoice_report"] = $this->db->query("SELECT * FROM `tblinvoices` WHERE (id = '".$parent_data->parent_id."' OR parent_id = '".$parent_data->parent_id."') AND id != '".$invoice_id."' ")->result();
		$data["invoice_amount"] = $this->db->query("SELECT sum(total) as ttl_amt FROM `tblinvoices` WHERE (id = '".$parent_data->parent_id."' OR parent_id = '".$parent_data->parent_id."') AND id != '".$invoice_id."' ")->row()->ttl_amt;
		$data['taxable_value'] = $this->db->query("SELECT sum(total_tax) as tax_val from `tblinvoices` WHERE (id = '".$parent_data->parent_id."' OR parent_id = '".$parent_data->parent_id."') AND id != '".$invoice_id."' ")->row()->tax_val;

		$data['month_list'] = $this->db->query("SELECT * FROM `tblmonths` order by id asc ")->result();
		$this->load->view('admin/sales_report/rent_invoice_details', $data);
	}

	public function po_invoice_report(){
		check_permission(404,'view');
		 $data["title"] = "Compaire Purchase Order - Purchase Invoice ";
		 if(!empty($_POST)){
	 			extract($this->input->post());
				  $where = "po.status = 1";

					if (!empty($f_date) && !empty($t_date)) {
							$data['f_date'] = $f_date;
							$data['s_date'] = $t_date;
							$where .= " and po.date between '" . db_date($f_date) . "' and '" . db_date($t_date) . "' ";
					}

					if (!empty($vendor_id)){
						 $data["vendor_id"] = $vendor_id;
						 $data["po_report"] = $this->db->query("SELECT pro.product_id, pro.product_name, po.id, po.date, po.number, pro.qty FROM `tblpurchaseorder` as po RIGHT JOIN `tblpurchaseorderproduct` as pro ON po.id = pro.po_id WHERE ".$where." and po.vendor_id = ".$vendor_id." ORDER BY po.id DESC ")->result();
					}
	 		}
			// echo "<pre>";
			// print_r($_POST);exit;
			$data["vendor_list"] = $this->db->query("SELECT id,name FROM `tblvendor` where status = '1' ")->result();
		 $this->load->view('admin/sales_report/po_invoice_report', $data);
	}

  /* this is a challan trip report */
	public function challan_trip_report(){
		check_permission(405,'view');
			$where = "is_details_given > 0 and status = 1";
			if(!empty($_POST)){
				extract($this->input->post());

					if (!empty($f_date) && !empty($t_date)) {
							$data['f_date'] = $f_date;
							$data['s_date'] = $t_date;
							$where .= " and date between '" . db_date($f_date) . "' and '" . db_date($t_date) . "' ";
					}else{
						  $where .= " and MONTH(date)= '".date('m')."' ";
					}

					if (!empty($vehicle_type)){
						 $data["vehicle_type"] = $vehicle_type;
						 $where .= " and vehicle_type='".$vehicle_type."'";
					}
			}else{
				 $where .= " and MONTH(date)= '".date('m')."' ";
			}
			$data["title"] = "Trip Report";
			$data["challan_trip_list"] = $this->db->query("SELECT * FROM `tblchallantrip` WHERE ".$where." ORDER BY id DESC")->result();

			$this->load->view("admin/sales_report/challan_trip_report", $data);
	}


	public function get_vehicle_details(){
        if (!empty($_POST)){
            extract($this->input->post());
            $processInfo = $this->db->query("SELECT * FROM `tblchallanprocess` where trip_id = '".$trip_id."' ")->row();
			$vehicleInfo = $this->db->query("SELECT * FROM `tblnoncompanyvehicle` where id = '".$processInfo->vehicle_id."' ")->row();
            if (!empty($vehicleInfo)){
    ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">                            
                            <table class="col-md-12">
                                <tr>
                                    <td class="col-md-6"><label class=" control-label" style="color:red;">Vehicle Name <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
                                    <td class="col-md-6"><p class="form-control-static text-success"><?php echo (!empty($vehicleInfo->vehicle_name)) ? $vehicleInfo->vehicle_name : "--"; ?></p></td>
                                </tr>
                                <tr>
                                    <td class="col-md-6"><label class=" control-label" style="color:red;">Vehicle Number <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
                                    <td class="col-md-6"><p class="form-control-static text-success"><?php echo (!empty($vehicleInfo->vehicle_number)) ? $vehicleInfo->vehicle_number : "--"; ?></p></td>
                                </tr>
								<tr>
                                    <td class="col-md-6"><label class=" control-label" style="color:red;">Driver Name <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
                                    <td class="col-md-6"><p class="form-control-static text-success"><?php echo (!empty($vehicleInfo->driver_name)) ? $vehicleInfo->driver_name : "--"; ?></p></td>
                                </tr>
								<tr>
                                    <td class="col-md-6"><label class=" control-label" style="color:red;">Driver Number <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
                                    <td class="col-md-6"><p class="form-control-static text-success"><?php echo (!empty($vehicleInfo->driver_number)) ? $vehicleInfo->driver_number : "--"; ?></p></td>
                                </tr>
								<?php
								 if(!empty($vehicleInfo->vehicle_rc)){
									?>
									<tr>
										<td class="col-md-6"><label class=" control-label" style="color:red;">Vehicle RC <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
										<td class="col-md-6"><a target="_blank" href="<?php echo base_url('uploads/challan_delivery/vehicle_rc/'.$processInfo->vehicle_id.'/'.$vehicleInfo->vehicle_rc); ?>" ><p class="form-control-static text-success">View</p></a></td>
									</tr>
									<?php
								 }
								 if(!empty($vehicleInfo->vehicle_rc)){
									?>
									<tr>
										<td class="col-md-6"><label class=" control-label" style="color:red;">Driver Licence <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
										<td class="col-md-6"><a target="_blank" href="<?php echo base_url('uploads/challan_delivery/driving_licence/'.$processInfo->vehicle_id.'/'.$vehicleInfo->driving_licence); ?>" ><p class="form-control-static text-success">View</p></a></td>
									</tr>
									<?php
								 }
								 if(!empty($vehicleInfo->vehicle_rc)){
									?>
									<tr>
										<td class="col-md-6"><label class=" control-label" style="color:red;">Vehicle Image <sapn class="pull-right">&nbsp;&nbsp;:</sapn></label></td>
										<td class="col-md-6"><a target="_blank" href="<?php echo base_url('uploads/challan_delivery/vehicle_pic/'.$processInfo->vehicle_id.'/'.$vehicleInfo->vehicle_pic); ?>" ><p class="form-control-static text-success">View</p></a></td>
									</tr>
									<?php
								 }
								?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

    <?php
            }
        }
    }

	public function employee_expense_report(){
		
		$data['f_date'] = date('Y-m').'-01';		
		$data['s_date'] = date('Y-m-d');
		$data['section'] = 1;
		$where = "`status`=1";
		if(!empty($_POST)){
			extract($this->input->post());

			if (!empty($f_date) && !empty($t_date)) {
				$data['f_date'] = db_date($f_date);
				$data['s_date'] = db_date($t_date);
			}
			if (!empty($section)){
				$data['section'] = $section;
			}
			if (!empty($expense_head_id)){
				$data['expense_head_id'] = $expense_head_id;
			}
			if (!empty($category_id)){
				$data['category_id'] = $category_id;
				$where .= " and category_id = ".$category_id;
			}
		}
		
		$data['title'] = "Expense Report";
		$data['subtypeslist'] = $this->db->query('SELECT `id`,`name`,`type_id` FROM `tblexpensetypesub` WHERE `status`=1')->result();
		$data['headslist'] = $this->db->query('SELECT `category_id`,`id`,`name` FROM `tblheads` WHERE '.$where)->result();
		$data['employeesname_list'] = $this->db->query("SELECT `addedfrom` FROM `tblexpenses` WHERE `date` between '".$data['f_date']."' AND '".$data['s_date']."' and `approved_status` = 1 and `typesub_id` > 0 GROUP BY addedfrom")->result();
		$data['expense_head_list'] = $this->db->query("SELECT `id`,`name` FROM `tblexpensehead` WHERE `status`='1' ORDER BY id ASC")->result();
		$data['category_list'] = $this->db->query("SELECT `id`,`name` FROM `tblcompanyexpensecatergory` WHERE `status`='1' ORDER BY id ASC")->result();
		$this->load->view('admin/sales_report/employee_expense_report',$data);
	}

	/* this is for get employee expenses data */
	public function getEmployeeExpenses(){
		if(!empty($_GET)){
			extract($this->input->get());

			$data['title'] = 'Employee Expenses Details';
			$data['employee_id'] = $employee_id;
			$data['subtypeid'] = $subtypeid;
			$data['totalexpense'] = $this->db->query("SELECT COALESCE(SUM(amount),0) as ttl_amt FROM `tblexpenses` WHERE `date` between '".$from_date."' AND '".$to_date."' AND `approved_status` = 1 and `typesub_id` = '".$subtypeid."' and `addedfrom` = '".$employee_id."' ")->row()->ttl_amt;
			$data['employee_expense_list'] = $this->db->query("SELECT * FROM `tblexpenses` WHERE `date` between '".$from_date."' AND '".$to_date."' AND `approved_status` = 1 and `typesub_id` = '".$subtypeid."' and `addedfrom` = '".$employee_id."' ")->result();
			$this->load->view('admin/sales_report/employee_expense_details',$data);			
		}
	}

	/* this is for get System expenses data */
	public function getSystemExpenses(){
		if(!empty($_GET)){
			extract($this->input->get());

			$data['title'] = 'System Expenses Details';
			$data['head_id'] = $head_id;
			$data['head_info'] = $this->db->query('SELECT * FROM `tblheads` WHERE `id`= "'.$head_id.'" ')->row();
			$data['totalexpense'] = $this->db->query("SELECT COALESCE(SUM(amount),0) as ttl_amt FROM `tblpaymentrequest` WHERE `created_at` between '".$from_date."' AND '".$to_date."' AND `approved_status` = 1 AND `payfile_done` = 1 AND `head_id` = '".$head_id."'")->row()->ttl_amt;
			$data['system_expense_list'] = $this->db->query("SELECT * FROM `tblpaymentrequest` WHERE `created_at` between '".$from_date."' AND '".$to_date."' AND `approved_status` = 1 AND `payfile_done` = 1 AND `head_id` = '".$head_id."'")->result();
			$this->load->view('admin/sales_report/system_expense_details',$data);			
		}
	}

	/* this function use for Cancelled Documents List */
	public function cancelled_documents_list(){
		$data["title"] = "Cancelled Documents List";
		$data['invoice_list'] = $this->db->query("SELECT * FROM `tblinvoices` WHERE `status` = '5' ORDER BY id DESC ")->result();
		$data['debitnote_list'] = $this->db->query("SELECT * FROM `tbldebitnote` WHERE `status` = '0' ORDER BY id DESC ")->result();
		$data["dn_payment_list"] = $this->db->query("SELECT * FROM `tbldebitnotepayment` WHERE `status` = '0' ORDER BY id DESC")->result();
		$data["creditnote_list"] = $this->db->query("SELECT * FROM `tblcreditnote` WHERE `status` = '5' ")->result();
		
		$this->load->view('admin/sales_report/cancelled_document_list',$data);
	}

	public function freight_collected_report(){
		
		if (isset($_GET["from_date"]) && isset($_GET["to_date"])){
			$data['f_date'] = _d($_GET["from_date"]);
			$data['t_date'] = _d($_GET["to_date"]);
			$where = "i.invoice_date between '" . db_date($_GET["from_date"]) . "' and '" . db_date($_GET["to_date"]) . "' ";
		}

		$where = 'i.year_id ='.financial_year();
		if(!empty($_POST)){
			extract($this->input->post());

			if (!empty($f_date) && !empty($t_date)) {
				$data['f_date'] = $f_date;
				$data['t_date'] = $t_date;
				$where = "i.invoice_date between '" . db_date($f_date) . "' and '" . db_date($t_date) . "' ";
			}
		}

		$data["title"] = "Freight Collected";
		$data["invoice_list"] = $this->db->query("SELECT i.* FROM `tblinvoices` as i LEFT JOIN tblitems_in as p ON i.id = p.rel_id WHERE p.rel_type = 'invoice' and  p.pro_id IN (798,865,866,11) and ".$where." GROUP by i.id order by i.id DESC")->result();
		
		$this->load->view("admin/sales_report/freight_collected_report", $data);
	}

	/* this function use for transport comparision */
	public function transport_comparision(){

		$year_id = financial_year();
		$from_date = value_by_id_empty("tblfinancialyear", $year_id, "from_date");
        $to_date = value_by_id_empty("tblfinancialyear", $year_id, "to_date");

		$data["from_date"] = $from_date;
		$data["to_date"] = $to_date;
		$data["month_arr"] = "";
        $data["ttltransfer_collected"] = "";
        $data["ttlpaidthroughsystem"] = "";
		$data["ttlpaidworkadvanced"] = "";
		$data["ttloverheadamt"] = "";

		/* this is for get financial date year */
        $dt1 = new DateTime("$from_date");
        $dt2 = new DateTime("$to_date");
        $dp = new DatePeriod($dt1, new DateInterval('P1M'), $dt2);
        foreach ($dp as $k => $d) {
			
			if ($d->format('Y-m') <= date("Y-m")){
				$prefix = ($k > 0) ? ', ' : '';
				$data["month_arr"] .= $prefix.'"'.$d->format('M-Y').'"';

				/* Get transfer collected */
				$invoice_list = $this->db->query("SELECT i.* FROM `tblinvoices` as i LEFT JOIN tblitems_in as p ON i.id = p.rel_id WHERE p.rel_type = 'invoice' and  p.pro_id IN (798,865,866,11) and YEAR(`i`.`invoice_date`) = '".$d->format('Y')."' AND MONTH(`i`.`invoice_date`) = '".$d->format('m')."' GROUP by i.id order by i.id DESC")->result();
				// $transfercollected = $this->db->query("SELECT COALESCE(SUM(`p`.`qty` * `p`.`rate`),0) as ttlamt FROM `tblinvoices` as i RIGHT JOIN tblitems_in as p ON i.id = p.rel_id WHERE p.rel_type = 'invoice' and  p.pro_id IN (798,865,866,11) and YEAR(`invoice_date`) = '".$d->format('Y')."' AND MONTH(`invoice_date`) = '".$d->format('m')."'")->row()->ttlamt;
				$transfercollected = 0;
				if ($invoice_list){
					foreach ($invoice_list as $value) {
						$item_info = $this->db->query("SELECT `qty`,`rate` FROM `tblitems_in` WHERE `rel_type` = 'invoice' and `pro_id` IN (798,865,866,11) and rel_id = '".$value->id."' ")->result();
						if(!empty($item_info)){
							foreach ($item_info as  $row) {
								$transfercollected += ($row->qty * $row->rate);    
							}
						}
					}
				}
				$data["ttltransfer_collected"] .= $prefix.$transfercollected;

				/* Get transport paid through system */
				$ttlpaidthroughsystem = 0;
				$subexpenses = $this->db->query("SELECT `id` FROM `tblexpensetypesub` WHERE `status`=1 AND `type_id` IN (1,2)")->result();
				if (!empty($subexpenses)){
					foreach ($subexpenses as $value) {
						$ttlpaidthroughsystem += $this->db->query("SELECT COALESCE(SUM(amount),0) as ttl_amt FROM `tblexpenses` WHERE YEAR(`date`) = '".$d->format('Y')."' AND MONTH(`date`) = '".$d->format('m')."' AND `approved_status` = 1 AND `typesub_id` = '".$value->id."'")->row()->ttl_amt;
					}
				}
				$data["ttlpaidthroughsystem"] .= $prefix.$ttlpaidthroughsystem;

				/* Get transport paid through work advanced */
				$ttlpaidworkadvanced = $this->db->query("SELECT COALESCE(SUM(amount),0) as ttl_amt FROM `tblpaymentrequest` WHERE YEAR(`created_at`) = '".$d->format('Y')."' AND MONTH(`created_at`) = '".$d->format('m')."' AND `approved_status` = 1 AND `payfile_done` = 1 AND `head_id` IN (8,9)")->row()->ttl_amt;
				$data["ttlpaidworkadvanced"] .= $prefix.$ttlpaidworkadvanced;

				/* Get transport overhead amount */
				$ttloverheadamt = $this->db->query("SELECT COALESCE(SUM(amount),0) as ttl_amt FROM `tbltransportoverhead` WHERE YEAR(`date`) = '".$d->format('Y')."' AND MONTH(`date`) = '".$d->format('m')."'")->row()->ttl_amt;
				$data["ttloverheadamt"] .= $prefix.$ttloverheadamt;
			}
        }
		
		$data["title"] = "TRANSPORT COMPARISION";
		$this->load->view("admin/sales_report/transport_comparision", $data);
	}

	/* This function use for transport paid */
	public function transport_paid(){

		$year_id = financial_year();
		$from_date = value_by_id_empty("tblfinancialyear", $year_id, "from_date");
        $to_date = value_by_id_empty("tblfinancialyear", $year_id, "to_date");

		$data['f_date'] = $from_date;
		$data['t_date'] = $to_date;
		if (isset($_GET["from_date"]) && isset($_GET["to_date"])){
			$data['f_date'] = _d($_GET["from_date"]);
			$data['t_date'] = _d($_GET["to_date"]);
		}

		if (isset($_POST["f_date"]) && isset($_POST["t_date"])){
			$data['f_date'] = $_POST["f_date"];
			$data['t_date'] = $_POST["t_date"];
		}
		
		/* Get transport paid through system */
		$subexpenses = $this->db->query("SELECT `s`.`id`,`s`.`name`,`e`.`amount`,`e`.`date` FROM `tblexpensetypesub` as s RIGHT JOIN `tblexpenses` as e ON e.typesub_id = s.id WHERE `s`.`status`=1 AND `s`.`type_id` IN (1,2) AND `e`.`approved_status` = 1 AND `e`.`date` between '" . db_date($from_date) . "' and '" . db_date($to_date) . "' ")->result();
		$data["paidthroughsystem_list"] = $subexpenses;

		/* Get transport paid through work advanced */
		$data["paidworkadvanced_list"] = $this->db->query("SELECT * FROM `tblpaymentrequest` WHERE created_at between '" . db_date($from_date) . "' and '" . db_date($to_date) . "' AND `approved_status` = 1 AND `payfile_done` = 1 AND `head_id` IN (8,9)")->result();

		/* Get transport overhead amount */
		$data["transport_overhead_list"] = $this->db->query("SELECT * FROM `tbltransportoverhead` WHERE date between '" . db_date($from_date) . "' and '" . db_date($to_date) . "'")->result();
		
		$data["title"] = "Transport Paid Report";
		$this->load->view("admin/sales_report/transport_paid_report", $data);
	}
}
