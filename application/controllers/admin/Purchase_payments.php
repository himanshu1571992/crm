<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Purchase_payments extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->model('Purchase_model');
    }

    public function payment_list()
    {
        check_permission(55,'view');


        $where = "status = 1 ";

        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($reset)){
                $this->session->unset_userdata('paymentinvoice_where');
                $this->session->unset_userdata('paymentinvoice_search');
            }else{
                if(!empty($vendor_id) || !empty($f_date) || !empty($t_date)){
                    $this->session->unset_userdata('paymentinvoice_where');
                    $this->session->unset_userdata('paymentinvoice_search');
                    $sreach_arr = array();
                    if(!empty($vendor_id)){
                        $sreach_arr['vendor_id'] = $vendor_id;
                        $where .= " and vendor_id = '".$vendor_id."'";
                    }

                    if(!empty($f_date) && !empty($t_date)){
                        $sreach_arr['f_date'] = $f_date;
                        $sreach_arr['t_date'] = $t_date;

                        $f_date = str_replace("/","-",$f_date);
                        $f_date = date("Y-m-d",strtotime($f_date));

                        $t_date = str_replace("/","-",$t_date);
                        $t_date = date("Y-m-d",strtotime($t_date));

                        $where .= " and date between '".$f_date."' and '".$t_date."' ";
                    }


                    $this->session->set_userdata('paymentinvoice_where',$where);
                    $this->session->set_userdata('paymentinvoice_search',$sreach_arr);

                }

            }
        }else{
            if(!empty($this->session->userdata('paymentinvoice_where'))){
                $where = $this->session->userdata('paymentinvoice_where');
            }
        }


        $this->load->library('pagination');

        $uriSegment = 4;
        $perPage = 25;




        // Get record count
        $totalRec = $this->Purchase_model->get_paymentinvoice_count($where);

        // Pagination configuration
        $config['base_url']    = admin_url().'purchase_payments/payment_list/';
        $config['uri_segment'] = $uriSegment;
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $perPage;

        // For pagination link
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['next_tag_open'] = '<li class="pg-next">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="pg-prev">';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        // Initialize pagination library
        $this->pagination->initialize($config);

        // Define offset
        $page = $this->uri->segment($uriSegment);
        $offset = !$page?0:$page;

        // Get records
        $data['payment_list'] = $this->Purchase_model->get_paymentinvoice($where,$offset,$perPage);



        $data['vendor_data'] = $this->db->query("SELECT * FROM `tblvendor` where status = 1 ORDER BY name ASC")->result();

        $data['title'] = 'Purchase Payment List';
        $this->load->view('admin/purchase_payments/payment_list', $data);

    }

    public function purchase_payment($id = '')
    {

		check_permission(54,'view');

		$staff_id = $this->session->userdata('staff_user_id');

		//$data['vendor_info'] = $this->db->query("SELECT i.vendor_id, c.* FROM tblpurchaseinvoice as  i LEFT JOIN tblvendor as c ON i.vendor_id = c.id GROUP By i.vendor_id")->result();
		$data['vendor_info'] = $this->db->query("SELECT * FROM tblvendor where status = 1 order by name asc ")->result();


        if ($this->input->post()) {
			extract($this->input->post());
			/*echo '<pre/>';
			print_r($_POST);
			die;*/


			$date = str_replace("/","-",$date);
			$date = date("Y-m-d",strtotime($date));


			$cheque_date = str_replace("/","-",$cheque_date);
			$cheque_date = date("Y-m-d",strtotime($cheque_date));

			if(empty($chaque_for)){
				$chaque_for = 0;
			}

			if(empty($cheque_no)){
				$cheque_no = 0;
			}

			if(!empty($invoice_id)){
				$invoice_str = implode(",",$invoice_id);
			}else{
				$invoice_str = '';
			}


			$ad_data = array(
                    'staff_id' => get_staff_user_id(),
                    'year_id' => financial_year(),
                    'vendor_id' => $vendor_id,
                    'billing_branch_id' => get_login_branch(),
                    'payment_behalf' => $payment_behalf,
                    'payment_mode' => $payment_mode,
                    'chaque_for' => $chaque_for,
                    'cheque_no' => $cheque_no,
                    'cheque_date' => $cheque_date,
                    'invoice_id' => $invoice_str,
                    'ttl_amt' => $ttl_amt,
                    'reference_no' => $reference_no,
                    'remark' => $remark,
                    'date' => $date,
                    'status' => 1,
                    'created_date' => date('Y-m-d H:i:s')
                );


            $insert = $this->home_model->insert('tblvendorpayment', $ad_data);





            if($insert == true){
            	$pay_id = $this->db->insert_id();


            	$result_file=handle_multi_payment_attachments($pay_id,'purchase_payment');

            	if(!empty($row)){
	        		foreach ($row as $key => $value) {
	        			$amount = $_POST['amount_'.$value];
	        			$tds = $_POST['tds'.$value];

	        			if(!empty($_POST['clear_'.$value])){
	        				$is_clear = 1;
	        			}else{
	        				$is_clear = 0;
	        			}



	        			if($amount > 0){
	        				$invoice_info = $this->db->query("SELECT * FROM tblpurchaseinvoice  where id = '".$value."' ")->row();
	        				$f_paidamt = ($invoice_info->paid_amt + $amount);


	        				$this->home_model->update('tblpurchaseinvoice', array('paid_amt'=>$f_paidamt) ,array('id'=>$value));


	        				$ad_data_1 = array(
				                    'invoiceid' => $value,
				                    'amount' => $amount,
				                    'pay_id' => $pay_id,
				                    'paymentmode' => $payment_mode,
				                    'paymentmethod' => $payment_behalf,
				                    'date' => $date,
				                    'tds' => $tds,
				                    'is_clear' => $is_clear,
				                    'daterecorded' => date('Y-m-d H:i:s')
				                );


				            $insert_payment = $this->home_model->insert('tblpurchaseinvoicepaymentrecords', $ad_data_1);

	        			}

	        		}
	            }

            	set_alert('success', 'Payment Added successfully');
                redirect(admin_url('purchase_payments/payment_list'));
            }
		}



         $data['title'] = 'Purchase Invoice Payments';

        $this->load->view('admin/purchase_payments/add', $data);
    }

    public function payment_details($id)
    {
        check_permission(54,'view');

        $data['payment_info'] = $this->db->query("SELECT * from tblvendorpayment where id = '".$id."' ")->row();
        $data['payment_details'] = $this->db->query("SELECT * from tblpurchaseinvoicepaymentrecords where pay_id = '".$id."' ")->result();
        $data['files_info'] = $this->db->query("SELECT `file_name`,`rel_id` from tblfiles where rel_id = '".$id."' and rel_type = 'purchase_payment' ")->result();


        $data['title'] = 'Invoice Payment Details';
        $this->load->view('admin/purchase_payments/payment_details', $data);
    }



    public function on_account($id = '')
    {

    	check_permission(56,'view');
		//$staff_id = $this->session->userdata('staff_user_id');

		$data['vendor_data'] = $this->db->query("SELECT i.vendor_id, c.* FROM tblvendorpayment as  i LEFT JOIN tblvendor as c ON i.vendor_id = c.id where i.payment_behalf = 1 GROUP By i.vendor_id")->result();

		if ($this->input->post()) {
			extract($this->input->post());

			$where = "payment_behalf = 1";

			if(!empty($f_date) && !empty($t_date)){
				$data['sf_date'] = $f_date;
				$data['st_date'] = $t_date;


				$f_date = str_replace("/","-",$f_date);
				$f_date = date("Y-m-d",strtotime($f_date));

				$t_date = str_replace("/","-",$t_date);
				$t_date = date("Y-m-d",strtotime($t_date));

				$where .= " and date between '".$f_date."' and '".$t_date."'";
			}

			if(!empty($vendor_id)){
				$data['s_vendor_id'] = $vendor_id;

				$where .= " and vendor_id = '".$vendor_id."' ";
			}


			$data['table_data'] = $this->db->query("SELECT * from tblvendorpayment where ".$where."  order by date desc")->result();

		}else{
			$data['table_data'] = $this->db->query("SELECT * from tblvendorpayment where payment_behalf = 1 order by date desc ")->result();
		}

        $data['title'] = 'Vendors On Account Payments';

        $this->load->view('admin/purchase_payments/on_account', $data);
    }


    public function convert_againstinvoice($id)
    {

    	if(!empty($id)){


			$data['payment_info'] = $this->db->query("SELECT * from tblvendorpayment where id = '".$id."' ")->row();
			$data['id'] = $id;

	        $data['title'] = 'Purchase Invoice Payments';

	        $this->load->view('admin/purchase_payments/convert_againstinvoice', $data);
    	}

    }


    public function action_againstinvoice($id = '')
    {
    	if ($this->input->post()) {
				extract($this->input->post());
				/*echo '<pre/>';
				print_r($_POST);
				die;*/


				$date = str_replace("/","-",$date);
				$date = date("Y-m-d",strtotime($date));


				$cheque_date = str_replace("/","-",$cheque_date);
				$cheque_date = date("Y-m-d",strtotime($cheque_date));

				if(empty($chaque_for)){
					$chaque_for = 0;
				}

				if(empty($cheque_no)){
					$cheque_no = 0;
				}

				if(!empty($invoice_id)){
					$invoice_str = implode(",",$invoice_id);
				}else{
					$invoice_str = '';
				}


				$ad_data = array(
	                    'staff_id' => get_staff_user_id(),
	                    'year_id' => financial_year(),
                    	'vendor_id' => $vendor_id,
	                    'payment_behalf' => $payment_behalf,
	                    'payment_mode' => $payment_mode,
	                    'chaque_for' => $chaque_for,
	                    'cheque_no' => $cheque_no,
	                    'cheque_date' => $cheque_date,
	                    'invoice_id' => $invoice_str,
	                    'ttl_amt' => $ttl_amt,
	                    'reference_no' => $reference_no,
	                    'remark' => $remark,
	                    'date' => $date,
	                    'status' => 1,
	                    'created_date' => date('Y-m-d H:i:s')
	                );


	            $update = $this->home_model->update('tblvendorpayment', $ad_data,array('id'=>$id));


	            if($update == true){
	            	$pay_id = $id;

	            	$result_file=handle_multi_payment_attachments($pay_id,'purchase_payment');

	            	if(!empty($row)){
		        		foreach ($row as $key => $value) {
		        			$amount = $_POST['amount_'.$value];
		        			$tds = $_POST['tds'.$value];

		        			if(!empty($_POST['clear_'.$value])){
		        				$is_clear = 1;
		        			}else{
		        				$is_clear = 0;
		        			}



		        			if($amount > 0){
		        				$invoice_info = $this->db->query("SELECT `paid_amt` FROM tblpurchaseinvoice  where id = '".$value."' ")->row();
		        				$f_paidamt = ($invoice_info->paid_amt + $amount);

		        				$this->home_model->update('tblpurchaseinvoice', array('paid_amt'=>$f_paidamt) ,array('id'=>$value));


		        				$ad_data_1 = array(
					                    'invoiceid' => $value,
					                    'amount' => $amount,
					                    'pay_id' => $pay_id,
					                    'paymentmode' => $payment_mode,
					                    'paymentmethod' => $payment_behalf,
					                    'date' => $date,
					                    'tds' => $tds,
					                    'is_clear' => $is_clear,
					                    'daterecorded' => date('Y-m-d H:i:s')
					                );


					            $insert_payment = $this->home_model->insert('tblpurchaseinvoicepaymentrecords', $ad_data_1);


		        			}

		        		}
		            }

	            	set_alert('success', 'Payment Added successfully');
	                redirect(admin_url('purchase_payments/payment_list'));
	            }
			}

    }


    public function get_invoice()
    {
    	if ($this->input->post()) {
			extract($this->input->post());

			$invoice_info = $this->db->query("SELECT * FROM tblpurchaseinvoice where vendor_id = '".$vendor_id."' and paid_amt < totalamount ")->result();
			$html = '<option value="" disabled>--Select One-</option>';
			if(!empty($invoice_info)){
				foreach ($invoice_info as $key => $value) {
					$po_info = $this->db->query("SELECT `number` FROM `tblpurchaseorder` where id = '".$value->po_id."' ")->row();
					$po_number = (is_numeric($po_info->number)) ? 'PO-'.$po_info->number : $po_info->number;
					$html .= '<option value="'.$value->id.'">'.'Inv-'.str_pad($value->id, 4, '0', STR_PAD_LEFT).' - ('._d($value->date).') - ('.$po_number.')</option>';
				}
			}

			echo $html;
		}
    }


    public function get_invoice_table()
    {
    	if ($this->input->post()) {
			extract($this->input->post());
			$invoice_str = implode(",",$invoice_id);

			$invoice_info = $this->db->query("SELECT * FROM tblpurchaseinvoice where id IN (".$invoice_str.") ")->result();

			if(!empty($invoice_info)){
				?>
				<div class="panel_s">
                    <div class="panel-body">
                        <div class="modal-body">


                            <div style="padding:5px;margin-bottom:5%;">
                                <h4 class="modal-title pull-left">Add Invoice Payment Detials</h4>
                            </div>
                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2% !important;">
                                <thead>
                                    <tr>
                                        <th width="10%" align="center">S.No.</th>
                                        <th width="20%" align="center">Invoice No.</th>
                                        <th width="20%" align="center">Balance Amt</th>
                                        <th width="20%" align="center">TDS %</th>
                                        <th width="20%" align="center">Payble Amount</th>
                                        <th width="10%" align="center">Clear Balance</th>
                                    </tr>
                                </thead>
                                <tbody class="ui-sortable" style="font-size:15px;">
                                	<?php
                                	foreach ($invoice_info as $key => $row) {
                                		$balance_amt = ($row->totalamount - $row->paid_amt);
                                		?>
                                		<input type="hidden" value="<?php echo $row->id; ?>" name="row[]">
                                		<tr class="main">
	                                        <td width="10%" align="center"><?php echo ++$key; ?></td>
	                                        <td width="20%" align="center"><a href="<?php echo base_url("admin/purchase/purchase_invoice_pdf/".$row->id); ?>" target="_blank"><?php echo 'Inv-'.str_pad($row->id, 4, '0', STR_PAD_LEFT).' - ('._d($row->date).')'; ?></a></td>
	                                        <td width="20%" align="center"><?php echo $balance_amt; ?></td>
	                                        <td width="20%" align="center">
	                                            <input class="form-control" type="text" name="<?php echo 'tds'.$row->id; ?>" value="0">
	                                        </td>
	                                        <td width="20%" align="center">
	                                            <input class="form-control invoice_product" type="text" name="<?php echo 'amount_'.$row->id; ?>" value="0" required="">
	                                        </td>
	                                        <td width="10%" align="center"><input type="checkbox" value="1" name="<?php echo 'clear_'.$row->id; ?>" ></td>
	                                    </tr>
                                		<?php
                                	}
                                	?>


                                </tbody>
                            </table>





                        </div>
                    </div>
                </div>
				<?php
			}


		}
    }



     /* Delete payment */
    public function delete($id)
    {
        check_permission(54,'delete');

        if (!$id) {
            redirect(admin_url('purchase_payments/payment_list'));
        }

        //Amount Adjustment
        $payment_info = $this->db->query("SELECT * FROM tblpurchaseinvoicepaymentrecords  where pay_id = '".$id."' ")->result();
        if(!empty($payment_info)){
        	foreach ($payment_info as $value) {
        		$invoice_info = $this->db->query("SELECT `paid_amt` FROM tblpurchaseinvoice  where id = '".$value->invoiceid."' ")->row();
       			$f_paidamt = ($invoice_info->paid_amt - $value->amount);
       			$this->home_model->update('tblpurchaseinvoice', array('paid_amt'=>$f_paidamt) ,array('id'=>$value->invoiceid));
        	}
        }


        $delete = $this->home_model->delete('tblvendorpayment',array('id'=>$id));
        if ($delete) {
        	$this->home_model->delete('tblpurchaseinvoicepaymentrecords',array('pay_id'=>$id));
            set_alert('success', _l('deleted', _l('payment')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('payment_lowercase')));
        }
        redirect(admin_url('purchase_payments/payment_list'));
    }

    public function delete_on_account($id)
    {
        check_permission(56,'delete');

        if (!$id) {
            redirect(admin_url('purchase_payments/on_account'));
        }

        $response = $this->home_model->delete('tblvendorpayment', array('id'=>$id));
        if ($response == true) {
            set_alert('success', _l('deleted', 'On Account'));
        } else {
            set_alert('warning', _l('problem_deleting', 'On Account'));
        }
        redirect(admin_url('purchase_payments/on_account'));
    }


}
