<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Invoice_payments extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }

    public function index($id = '', $section = "add") {

        check_permission(50, 'view');

        $staff_id = $this->session->userdata('staff_user_id');

        //$data['client_info'] = $this->db->query("SELECT i.clientid, c.* FROM tblinvoices as  i LEFT JOIN tblclientbranch as c ON i.clientid = c.userid GROUP By i.clientid")->result();
        $data['client_info'] = $this->db->query("SELECT * FROM tblclientbranch where active = 1 and client_branch_name != '' order by client_branch_name asc")->result();
        $data['service_type'] = get_service_type();

        /* by safiya */
        $data['bank_info'] = $this->db->query("SELECT * FROM tblbankmaster WHERE status = '1' order by name asc ")->result();
        $data['paytype_info'] = $this->db->query("SELECT * FROM  tblpaymenttypes order by name asc")->result();

        if ($this->input->post()) {
            extract($this->input->post());
            /* echo '<pre/>';
              print_r($_POST);
              die; */

            $assignstaff = $assign['assignid'];
            $staff_id = array();
            foreach ($assignstaff as $s_id) {
                if ($s_id > 0) {
                    $staff_id[] = $s_id;
                }
            }
            $staff_id = array_unique($staff_id);
            $client_id = (isset($client_id) && !empty($client_id)) ? $client_id : 0;
            $date = str_replace("/", "-", $date);
            $date = date("Y-m-d", strtotime($date));

            $query = $this->db->query("SELECT * FROM tblclientpayment WHERE client_id = '".$client_id."' and ttl_amt = '".$ttl_amt."' and date = '".$date."' and reference_no = '".$reference_no."' ")->row();
            if(!empty($query))
            {
                set_alert('warning', 'Already exist!');
                redirect(admin_url('Invoice_payments'));
                die;
            }

            if (empty($bank_id)) {
                $bank_id = 0;
            }
            if (empty($paymenttype)) {
                $paymenttype = 0;
            }
            
            $cheque_date = str_replace("/", "-", $cheque_date);
            $cheque_date = date("Y-m-d", strtotime($cheque_date));

            $is_suspense_account = 0;
            if (isset($suspense_account) && $suspense_account == "on") {
                $is_suspense_account = 1;
            }

            if (empty($chaque_for)) {
                $chaque_for = 0;
            }

            if (empty($cheque_no)) {
                $cheque_no = 0;
            }

            if (!empty($site_id)) {
                $site_str = implode(",", $site_id);
            } else {
                $site_str = '';
            }

            if (!empty($invoice_id)) {
                $invoice_str = implode(",", $invoice_id);
            } else {
                $invoice_str = '';
            }

            if (!empty($debitnote_id)) {
                $debitnote_str = implode(",", $debitnote_id);
            } else {
                $debitnote_str = '';
            }

            if (empty($service_type)) {
                $service_type = 0;
            }
            // $client_id = (isset($client_id) && !empty($client_id)) ? $client_id : 0;
            $payment_behalf = (isset($payment_behalf) && !empty($payment_behalf)) ? $payment_behalf : 0;
            $ad_data = array(
                'staff_id' => get_staff_user_id(),
                'client_id' => $client_id,
                'billing_branch_id' => get_login_branch(),
                'payment_behalf' => $payment_behalf,
                'payment_mode' => $payment_mode,
                'chaque_for' => $chaque_for,
                'cheque_no' => $cheque_no,
                'cheque_date' => $cheque_date,
                'site_id' => $site_str,
                'invoice_id' => $invoice_str,
                'debitnote_no' => $debitnote_str,
                'service_type' => $service_type,
                'ttl_amt' => $ttl_amt,
                'reference_no' => $reference_no,
                'remark' => $remark,
                'date' => $date,
                'payment_type_id' => $paymenttype,
                'bank_id' => $bank_id,
                'is_suspense_account' => $is_suspense_account,
                'status' => 0,
                'created_date' => date('Y-m-d H:i:s')
            );

            if ($section == "suspense_account" && !empty($id)){
                unset($ad_data["date"]);
                $insert = $this->home_model->update('tblclientpayment', $ad_data, array("id" => $id));
            }else{
                $insert = $this->home_model->insert('tblclientpayment', $ad_data);
            }

            if ($insert == true) {

                $pay_id = ($section == "suspense_account" && !empty($id)) ? $id : $this->db->insert_id();

                if ($section == "suspense_account" && !empty($id)){
                    /* this is for delete suspense account notification */
                    $this->home_model->delete("tblmasterapproval", array("module_id" => 59, "table_id" => $pay_id));
                    $this->home_model->delete("tblclientreceiptapproval", array("clientpayment_id" => $pay_id));
                    $this->home_model->delete("tblmasterapproval", array("table_id" => $pay_id, "module_id" => 15));
                }
                if (!empty($staff_id)) {
                    foreach ($staff_id as $staffid) {

                        $ad_field = array(
                            'staff_id' => $staffid,
                            'clientpayment_id' => $pay_id,
                            'status' => 1,
                            'approve_status' => 0,
                            'created_at' => date('Y-m-d H:i:s')
                        );
                        $this->home_model->insert('tblclientreceiptapproval', $ad_field);

                        $message = 'Client Receipt send you for aaproval';


                        $adata = array(
                            'staff_id' => $staffid,
                            'fromuserid' => get_staff_user_id(),
                            'module_id' => 15,
                            'table_id' => $pay_id,
                            'approve_status' => 0,
                            'status' => 0,
                            'description' => $message,
                            'link' => 'invoice_payments/clientpayment_approval/' . $pay_id,
                            'date' => date('Y-m-d'),
                            'date_time' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('tblmasterapproval', $adata);

                        //Sending Mobile Intimation
                        $token = get_staff_token($staffid);
                        $title = 'Schach';
                        $send_intimation = sendFCM($message, $title, $token, $page = 2);
                    }
                }

                $result_file = handle_multi_payment_attachments($pay_id, 'payment');
                if ($payment_behalf == 1) {
                    $paymnt = 'On Account';
                } elseif ($payment_behalf == 2) {
                    $paymnt = 'Against Invoice';
                } elseif ($payment_behalf == 3) {
                    $paymnt = 'Against Debitnote';
                }


                $message = 'Payment Made ' . $paymnt . ' of amount ' . $ttl_amt . ' at ' . $date . ' ';
                $activity = array(
                    'client_id' => $client_id,
                    'message' => $message,
                    'staffid' => get_staff_user_id(),
                    'date' => date('Y-m-d'),
                    'datetime' => date('Y-m-d H:i:s'),
                    'priority' => 0,
                    'status' => 1
                );

                $this->home_model->insert('tblfollowupclientactivity', $activity);

                if ($payment_behalf == 2) {
                    if (!empty($row)) {
                        foreach ($row as $key => $value) {
                            $amount = $_POST['amount_' . $value];
                            $tds = $_POST['tds' . $value];
                            $tds_amt = $_POST['tds_amt' . $value];

                            if (!empty($_POST['clear_' . $value])) {
                                $is_clear = 1;
                            } else {
                                $is_clear = 0;
                            }



                            if ($amount > 0 || $tds_amt > 0) {

                                //By Safiya
                                ///For payment mode NEFT and CASH
                                if ($payment_mode == 2 || $payment_mode == 3) {

                                    $invoice_info = $this->db->query("SELECT * FROM tblinvoices  where id = '" . $value . "' ")->row();
                                    $f_paidamt = ($invoice_info->paid_amt + $amount);

                                    //Getting Payment status
                                    $inv_amt = $invoice_info->total;
                                    $inv_duedate = $invoice_info->duedate;
                                    $status = $invoice_info->status;

                                    if ($f_paidamt > 0) {
                                        if ($f_paidamt >= $inv_amt) {
                                            $status = 2;
                                        } else {
                                            if (date('Y-m-d') > $inv_duedate) {
                                                $status = 4;
                                            } else {
                                                $status = 3;
                                            }
                                        }
                                    }

                                    if ($amount == 0) {
                                        if (date('Y-m-d') > $inv_duedate) {
                                            $status = 4;
                                        } else {
                                            $status = 1;
                                        }
                                    }
                                    //End Getting Payment status


                                    $this->home_model->update('tblinvoices', array('paid_amt' => $f_paidamt, 'status' => $status), array('id' => $value));
                                }
                                //For payment mode NEFT and CASH


                                $ad_data_1 = array(
                                    'invoiceid' => $value,
                                    'amount' => $amount,
                                    'pay_id' => $pay_id,
                                    'bank_id' => $bank_id,
                                    'payment_type_id' => $paymenttype,
                                    'paymentmode' => $payment_mode,
                                    'paymentmethod' => $payment_behalf,
                                    'date' => $date,
                                    'tds' => $tds,
                                    'tds_amt' => $tds_amt,
                                    'is_clear' => $is_clear,
                                    'daterecorded' => date('Y-m-d H:i:s')
                                );


                                $insert_payment = $this->home_model->insert('tblinvoicepaymentrecords', $ad_data_1);
                            }
                        }
                    }
                } elseif ($payment_behalf == 3) {
                    if (!empty($row)) {
                        foreach ($row as $key => $value) {
                            $amount = $_POST['amount_' . $value];
                            $tds = $_POST['tds' . $value];
                            $tds_amt = $_POST['tds_amt' . $value];

                            if (!empty($_POST['clear_' . $value])) {
                                $is_clear = 1;
                            } else {
                                $is_clear = 0;
                            }



                            if ($amount > 0 || $tds_amt > 0) {
                                $debit_info = $this->db->query("SELECT * FROM tbldebitnote  where `number` = '" . $value . "' ")->row();
                                $debitpayment_info = $this->db->query("SELECT * FROM tbldebitnotepayment  where `number` = '" . $value . "' ")->row();

                                $dbitnote_id = 0;
                                if (!empty($debit_info)) {
                                    $f_paidamt = ($debit_info->paid_amt + $amount);

                                    //Getting Payment status
                                    $amt = $debit_info->totalamount;
                                    if ($f_paidamt >= $amt) {
                                        $paid_status = 1;
                                    } else {
                                        $paid_status = 2;
                                    }
                                    //For payment mode NEFT And CASH
                                    if ($payment_mode == 2 || $payment_mode == 3) {
                                        $this->home_model->update('tbldebitnote', array('paid_amt' => $f_paidamt, 'paid_status' => $paid_status), array('id' => $debit_info->id));
                                    }
                                    //END For payment mode NEFT And CASH

                                    $dbitnote_id = $debit_info->id;
                                } elseif (!empty($debitpayment_info)) {
                                    $f_paidamt = ($debitpayment_info->paid_amt + $amount);

                                    //Getting Payment status
                                    $amt = $debitpayment_info->amount;
                                    if ($f_paidamt >= $amt) {
                                        $paid_status = 1;
                                    } else {
                                        $paid_status = 2;
                                    }

                                    //For payment mode NEFT And CASH
                                    if ($payment_mode == 2 || $payment_mode == 3) {
                                        $this->home_model->update('tbldebitnotepayment', array('paid_amt' => $f_paidamt, 'paid_status' => $paid_status), array('id' => $debitpayment_info->id));
                                    }
                                    //END For payment mode NEFT And CASH

                                    $dbitnote_id = $debitpayment_info->id;
                                }



                                $ad_data_1 = array(
                                    'invoiceid' => $dbitnote_id,
                                    'debitnote_no' => $value,
                                    'amount' => $amount,
                                    'pay_id' => $pay_id,
                                    'bank_id' => $bank_id,
                                    'payment_type_id' => $paymenttype,
                                    'paymentmode' => $payment_mode,
                                    'paymentmethod' => $payment_behalf,
                                    'date' => $date,
                                    'tds' => $tds,
                                    'tds_amt' => $tds_amt,
                                    'is_clear' => $is_clear,
                                    'daterecorded' => date('Y-m-d H:i:s')
                                );


                                $insert_payment = $this->home_model->insert('tblinvoicepaymentrecords', $ad_data_1);
                            }
                        }
                    }
                }


                set_alert('success', 'Payment Added successfully');
                $redirect_url = ($payment_behalf == 1) ? "Invoice_payments/on_account" : "payments";
                $redirect_url = ($is_suspense_account == 1) ? "payments/suspense_account_list" : $redirect_url;
                redirect(admin_url($redirect_url));
            }
        }


        //$Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Stock'")->result_array();
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='20'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "' order by s.firstname asc")->result_array();
            $stafff[$i]['staffs'] = $query;
        }
        $data['allStaffdata'] = $stafff;

        $data['approved_by'] = $this->db->query("SELECT * FROM `tblclientreceiptapproval` where clientpayment_id = '" . $id . "' ")->result_array();

        $data['title'] = 'Client Payment Form';
        $data["section"] = $section;
        if ($section == "suspense_account"){
            $data["clientpayment_info"] = $this->db->query("SELECT * FROM `tblclientpayment` where id = '" . $id . "' ")->row();
            $data['title'] = 'Convert to Receipt';
        }



        $this->load->view('admin/invoice_payments/add', $data);
    }

    public function on_account($id = '')
    {

    	check_permission(52,'view');
        $staff_id = $this->session->userdata('staff_user_id');

        //$data['client_info'] = $this->db->query("SELECT i.client_id, c.* FROM tblclientpayment as  i LEFT JOIN tblclients as c ON i.client_id = c.userid where i.payment_behalf = 1 GROUP By i.client_id")->result();
        $data['client_info'] = $this->db->query("SELECT i.client_id, c.* FROM tblclientpayment as  i LEFT JOIN tblclientbranch as c ON i.client_id = c.userid where i.payment_behalf = 1 GROUP By i.client_id")->result();

        $where = "payment_behalf = 1 and is_suspense_account = 0";
        if ($this->input->post()) {
            extract($this->input->post());


            if (!empty($f_date) && !empty($t_date)) {
                $data['sf_date'] = $f_date;
                $data['st_date'] = $t_date;


                $f_date = str_replace("/", "-", $f_date);
                $f_date = date("Y-m-d", strtotime($f_date));

                $t_date = str_replace("/", "-", $t_date);
                $t_date = date("Y-m-d", strtotime($t_date));

                $where .= " and date between '" . $f_date . "' and '" . $t_date . "'";
            }

            if (!empty($client_id)) {
                $data['s_client'] = $client_id;

                $where .= " and client_id = '" . $client_id . "' ";
            }
            if ($status != '') {
                $data['s_status'] = $status;
                $where .= " and status = '" . $status . "'";
            }



        }
        $data['table_data'] = $this->db->query("SELECT * from tblclientpayment where " . $where . " order by date desc ")->result();

        $data['title'] = 'Invoice Payments';

        $this->load->view('admin/invoice_payments/on_account', $data);
    }


    public function convert_againstinvoice($id)
    {

    	if(!empty($id)){


			$data['payment_info'] = $this->db->query("SELECT * from tblclientpayment where id = '".$id."' ")->row();

			$client_info = $this->db->query("SELECT `client_branch_name` from tblclientbranch where userid =  '".$data['payment_info']->client_id."' order by client_branch_name asc ")->row();
			$data['client_company'] = $client_info->client_branch_name;
			$data['id'] = $id;


			//$Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Stock'")->result_array();
            $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='20'")->result_array();
	        $i=0;
	        foreach($Staffgroup as $singlestaff)
	        {
	            $i++;
	            $stafff[$i]['id']=$singlestaff['id'];
	            $stafff[$i]['name']=$singlestaff['name'];
	            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='". get_staff_user_id()."' order by s.firstname asc")->result_array();
	            $stafff[$i]['staffs']=$query;
	        }
	        $data['allStaffdata'] = $stafff;

	        $data['approved_by'] = $this->db->query("SELECT * FROM `tblclientreceiptapproval` where clientpayment_id = '".$id."' ")->result_array();

            /*$this->db->where('clientpayment_id', $id);
	        $staffassigndata = $this->db->get('tblclientreceiptapproval')->result_array();
            $staffassigndata = array_column($staffassigndata, 'staff_id');
            $data['staffassigndata'] = $staffassigndata;*/

	        $data['title'] = 'Invoice Payments';


                $data['bank_info'] = $this->db->query("SELECT * FROM tblbankmaster WHERE status = '1' order by name asc ")->result();
		$data['paytype_info'] = $this->db->query("SELECT * FROM tblpaymenttypes order by name asc")->result();

	        $this->load->view('admin/invoice_payments/convert_againstinvoice', $data);
    	}

    }


    public function action_againstinvoice($id = '')
    {
    	if ($this->input->post()) {
				extract($this->input->post());
				/*echo '<pre/>';
				print_r($_POST);
				die;*/
                $assignstaff=$assign['assignid'];
	            $staff_id = array();
	            foreach($assignstaff as $s_id)
	            {
	               if($s_id > 0){
	                $staff_id[]=$s_id;
	               }

	            }
	            $staff_id=array_unique($staff_id);

				$date = str_replace("/","-",$date);
				$date = date("Y-m-d",strtotime($date));


				$cheque_date = str_replace("/","-",$cheque_date);
				$cheque_date = date("Y-m-d",strtotime($cheque_date));

                                if(empty($paymenttype)){
                                    $paymenttype = 0;
                                }
				if(empty($chaque_for)){
					$chaque_for = 0;
				}

				if(empty($cheque_no)){
					$cheque_no = 0;
				}

				if(!empty($site_id)){
					$site_str = implode(",",$site_id);
				}else{
					$site_str = '';
				}

				if(!empty($invoice_id)){
					$invoice_str = implode(",",$invoice_id);
				}else{
					$invoice_str = '';
				}


				$ad_data = array(
	                    'staff_id' => get_staff_user_id(),
	                    'client_id' => $client_id,
	                    'bank_id' => $bank_id,
	                    'payment_type_id' => $paymenttype,
	                    'payment_behalf' => $payment_behalf,
	                    'payment_mode' => $payment_mode,
	                    'chaque_for' => $chaque_for,
	                    'cheque_no' => $cheque_no,
	                    'cheque_date' => $cheque_date,
	                    'site_id' => $site_str,
	                    'invoice_id' => $invoice_str,
	                    'ttl_amt' => $ttl_amt,
	                    'reference_no' => $reference_no,
	                    'remark' => $remark,
	                    'date' => $date,
	                    'status' => 0,
	                    'created_date' => date('Y-m-d H:i:s')
	                );


	            $update = $this->home_model->update('tblclientpayment', $ad_data,array('id'=>$id));


	            if($update == true){
	            	$pay_id = $id;

		           if(!empty($staff_id)){
		           	$this->home_model->delete('tblclientreceiptapproval', array('clientpayment_id'=>$id));
		           	$this->home_model->delete('tblmasterapproval', array('table_id'=>$id, 'module_id'=>'15'));

                    foreach ($staff_id as $staffid) {

                        $ad_field = array(
                            'staff_id' => $staffid,
                            'clientpayment_id' => $pay_id,
                            'status' => 1,
                            'approve_status' => 0,
                            'created_at' => date('Y-m-d H:i:s')
                        );
                        $this->home_model->insert('tblclientreceiptapproval',$ad_field);

                        $message = 'Client Receipt send you for aaproval';


                            $adata = array(
                                'staff_id' => $staffid,
                                'fromuserid'      => get_staff_user_id(),
                                'module_id' => 15,
                                'table_id' => $pay_id,
                                'approve_status' => 0,
                                'status' => 0,
                                'description'     => $message,
                                'link' => 'invoice_payments/clientpayment_approval/'.$pay_id,
                                'date' => date('Y-m-d'),
                                'date_time' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            );
                            $this->db->insert('tblmasterapproval', $adata);

                            //Sending Mobile Intimation
                            $token = get_staff_token($staffid);
                            $title = 'Schach';
                            $send_intimation = sendFCM($message, $title, $token, $page = 2);
                    }
                }

	            	$result_file=handle_multi_payment_attachments($pay_id,'payment');

	            	if(!empty($row)){
		        		foreach ($row as $key => $value) {
		        			$amount = $_POST['amount_'.$value];
		        			$tds = $_POST['tds'.$value];
		        			$tds_amt = $_POST['tds_amt'.$value];

		        			if(!empty($_POST['clear_'.$value])){
		        				$is_clear = 1;
		        			}else{
		        				$is_clear = 0;
		        			}



		        			if($amount > 0){
		        				$invoice_info = $this->db->query("SELECT `paid_amt` FROM tblinvoices  where id = '".$value."' ")->row();
		        				$f_paidamt = ($invoice_info->paid_amt + $amount);

		        				$this->home_model->update('tblinvoices', array('paid_amt'=>$f_paidamt) ,array('id'=>$value));


		        				$ad_data_1 = array(
					                    'invoiceid' => $value,
					                    'amount' => $amount,
					                    'pay_id' => $pay_id,
					                    'bank_id' => $bank_id,
                                                            'payment_type_id' => $paymenttype,
					                    'paymentmode' => $payment_mode,
					                    'paymentmethod' => $payment_behalf,
					                    'date' => $date,
					                    'tds' => $tds,
					                    'tds_amt' => $tds_amt,
					                    'is_clear' => $is_clear,
					                    'daterecorded' => date('Y-m-d H:i:s')
					                );


					            $insert_payment = $this->home_model->insert('tblinvoicepaymentrecords', $ad_data_1);


		        			}

		        		}
		            }

	            	set_alert('success', 'Payment Added successfully');
	                redirect(admin_url('payments'));
	            }
			}

    }



    public function get_sites()
    {
    	if ($this->input->post()) {
			extract($this->input->post());
			$site_info = $this->db->query("SELECT i.site_id, s.name FROM tblinvoices as  i LEFT JOIN tblsitemanager as s ON i.site_id = s.id where i.clientid = '".$client_id."' and i.paid_amt < i.total  GROUP By i.site_id")->result();
			$html = '<option value="">--Select One-</option>';
			if(!empty($site_info)){
				foreach ($site_info as $key => $value) {
					$html .= '<option value="'.$value->site_id.'">'.cc($value->name).'</option>';
				}
			}

			echo $html;
		}
    }

    public function get_invoice()
    {
    	if ($this->input->post()) {
                    extract($this->input->post());
                     $site_str = implode(",",$site_id);

                    $invoice_info = $this->db->query("SELECT * FROM tblinvoices where clientid = '".$client_id."' and site_id IN (".$site_str.")  and paid_amt < total and status != '5'")->result();
                    $html = '<option value="">--Select One-</option>';
                    if(!empty($invoice_info)){
                            foreach ($invoice_info as $key => $value) {
                                    $html .= '<option value="'.$value->id.'">'.format_invoice_number($value->id).'</option>';
                            }
                    }

                    echo $html;
            }
    }

    public function get_debitnote()
    {
    	if ($this->input->post()) {
			extract($this->input->post());
			 $site_str = implode(",",$site_id);

			$debitnote_info = $this->db->query("SELECT * FROM tbldebitnote where clientid = '".$client_id."' and paid_amt < totalamount and paid_status != '1'")->result();
			$html = '<option value="">--Select One-</option>';
			if(!empty($debitnote_info)){
				foreach ($debitnote_info as $key => $value) {
					$html .= '<option value="'.$value->number.'">'.$value->number.'</option>';
				}
			}
			$debitnotepayment_info = $this->db->query("SELECT * FROM tbldebitnotepayment where clientid = '".$client_id."' and paid_amt < amount and paid_status != '1'")->result();
			if(!empty($debitnotepayment_info)){
				foreach ($debitnotepayment_info as $key => $value) {
					$html .= '<option value="'.$value->number.'">'.$value->number.'</option>';
				}
			}

			echo $html;
		}
    }

    public function delete_on_account($id)
    {
        //check_permission(50,'delete');

        if (!$id) {
            redirect(admin_url('Invoice_payments/on_account'));
        }

        $response = $this->home_model->delete('tblclientpayment', array('id'=>$id));
        if ($response == true) {

        	//deleteing approval notificatoin
        	$this->home_model->delete('tblmasterapproval',array('module_id'=>15,'table_id'=>$id));

            set_alert('success', _l('deleted', 'On Account'));
        } else {
            set_alert('warning', _l('problem_deleting', 'On Account'));
        }
        redirect(admin_url('Invoice_payments/on_account'));
    }

    public function get_invoice_table()
    {
    	if ($this->input->post()) {
			extract($this->input->post());
			if(!empty($invoice_id)){
				$invoice_str = implode(",",$invoice_id);
			}
			if(!empty($debitnote_id)){
				$debitnote_str = '';
				foreach ($debitnote_id as $key => $val) {
					if($key == 0){
						$debitnote_str .= "'".$val."'";
					}else{
						$debitnote_str .= ",'".$val."'";
					}
				}

			}

			if(!isset($payment_behalf)){
				$payment_behalf = 2;
			}

			if($payment_behalf == 2){
				$invoice_info = $this->db->query("SELECT * FROM tblinvoices where id IN (".$invoice_str.") ")->result();
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
	                                        <th width="10%" align="center">TDS %</th>
	                                        <th width="10%" align="center">TDS Amt</th>
	                                        <th width="20%" align="center">Payble Amount</th>
	                                        <th width="10%" align="center">Clear Balance</th>
	                                    </tr>
	                                </thead>
	                                <tbody class="ui-sortable" style="font-size:15px;">
	                                	<?php
	                                	foreach ($invoice_info as $key => $row) {
	                                		$balance_amt = ($row->total - $row->paid_amt);
	                                		?>
	                                		<input type="hidden" value="<?php echo $row->id; ?>" name="row[]">
	                                		<tr class="main">
		                                        <td width="10%" align="center"><?php echo ++$key; ?></td>
		                                        <td width="20%" align="center"><a href="<?php echo base_url("admin/invoices/list_invoices/".$row->id); ?>" target="_blank"><?php echo format_invoice_number($row->id); ?></a></td>
		                                        <td width="20%" align="center"><?php echo $balance_amt; ?></td>
		                                        <td width="10%" align="center">
		                                            <input class="form-control" type="text" name="<?php echo 'tds'.$row->id; ?>" value="0">
		                                        </td>
		                                        <td width="10%" align="center">
		                                            <input class="form-control" type="text" name="<?php echo 'tds_amt'.$row->id; ?>" value="0">
		                                        </td>
		                                        <td width="20%" align="center">
		                                            <input class="form-control amt" type="text" name="<?php echo 'amount_'.$row->id; ?>" value="0">
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
			}else{
				$debitnote_info = $this->db->query("SELECT * FROM tbldebitnote where `number` IN (".$debitnote_str.") ")->result();
				$debitnotepayment_info = $this->db->query("SELECT * FROM tbldebitnotepayment where `number` IN (".$debitnote_str.") ")->result();
					?>
					<div class="panel_s">
	                    <div class="panel-body">
	                        <div class="modal-body">

	                            <div style="padding:5px;margin-bottom:5%;">
	                                <h4 class="modal-title pull-left">Add Debitnote Payment Detials</h4>
	                            </div>
	                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2% !important;">
	                                <thead>
	                                    <tr>
	                                        <th width="10%" align="center">S.No.</th>
	                                        <th width="20%" align="center">Debitnote No.</th>
	                                        <th width="20%" align="center">Balance Amt</th>
	                                        <th width="10%" align="center">TDS %</th>
	                                        <th width="10%" align="center">TDS Amt</th>
	                                        <th width="20%" align="center">Payble Amount</th>
	                                        <th width="10%" align="center">Clear Balance</th>
	                                    </tr>
	                                </thead>
	                                <tbody class="ui-sortable" style="font-size:15px;">
	                                	<?php
	                                	$i = 1;
	                                	if(!empty($debitnote_info)){
	                                		foreach ($debitnote_info as $row) {
		                                		$balance_amt = ($row->totalamount - $row->paid_amt);
		                                		$number = rtrim($row->number,' ');
		                                		?>
		                                		<input type="hidden" value="<?php echo $number; ?>" name="row[]">
		                                		<tr class="main">
			                                        <td width="10%" align="center"><?php echo $i; ?></td>
			                                        <td width="20%" align="center"><a href="<?php echo base_url("admin/debit_note/download_pdf/".$row->id); ?>" target="_blank"><?php echo $row->number; ?></a></td>
			                                        <td width="20%" align="center"><?php echo $balance_amt; ?></td>
			                                        <td width="10%" align="center">
			                                            <input class="form-control" type="text" name="<?php echo 'tds'.$number; ?>" value="0">
			                                        </td>
			                                        <td width="10%" align="center">
			                                            <input class="form-control" type="text" name="<?php echo 'tds_amt'.$number; ?>" value="0">
			                                        </td>
			                                        <td width="20%" align="center">
			                                            <input class="form-control amt" type="text" name="<?php echo 'amount_'.$number; ?>" value="0">
			                                        </td>
			                                        <td width="10%" align="center"><input type="checkbox" value="1" name="<?php echo 'clear_'.$number; ?>" ></td>
			                                    </tr>
		                                		<?php
		                                		$i++;
		                                	}
	                                	}

	                                	if(!empty($debitnotepayment_info)){
	                                		foreach ($debitnotepayment_info as $row) {
		                                		$balance_amt = ($row->amount - $row->paid_amt);
		                                		$number = rtrim($row->number,' ');
		                                		?>
		                                		<input type="hidden" value="<?php echo $number; ?>" name="row[]">
		                                		<tr class="main">
			                                        <td width="10%" align="center"><?php echo $i; ?></td>
			                                        <td width="20%" align="center"><a href="<?php echo base_url("admin/debit_note/download_paymentpdf/".$row->id); ?>" target="_blank"><?php echo $row->number; ?></a></td>
			                                        <td width="20%" align="center"><?php echo $balance_amt; ?></td>
			                                        <td width="10%" align="center">
			                                            <input class="form-control" type="text" name="<?php echo 'tds'.$number; ?>" value="0">
			                                        </td>
			                                        <td width="10%" align="center">
			                                            <input class="form-control" type="text" name="<?php echo 'tds_amt'.$number; ?>" value="0">
			                                        </td>
			                                        <td width="20%" align="center">
			                                            <input class="form-control" type="text" name="<?php echo 'amount_'.$number; ?>" value="0">
			                                        </td>
			                                        <td width="10%" align="center"><input type="checkbox" value="1" name="<?php echo 'clear_'.$number; ?>" ></td>
			                                    </tr>
		                                		<?php
		                                		$i++;
		                                	}
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


    //By Safiya
    public function edit_on_account($id = '') {

        $data['title'] = 'Edit On Account Payments';
        //$data['client_info'] = $this->db->query("SELECT i.clientid, c.* FROM tblinvoices as  i LEFT JOIN tblclientbranch as c ON i.clientid = c.userid GROUP By i.clientid")->result();
        $data['client_info'] = $this->db->query("SELECT * FROM  tblclientbranch ")->result();
        $data['service_type'] = get_service_type();

        $data['bank_info'] = $this->db->query("SELECT * FROM tblbankmaster WHERE status = '1' order by name asc")->result();
        $data['onaccount_data'] = $this->db->query("SELECT * from tblclientpayment where id = '" . $id . "' ")->row();
        if (!empty($data['onaccount_data']) && $data['onaccount_data']->is_suspense_account == 1){
            $data['title'] = 'Edit Suspense Receipt';
        }
        if ($this->input->post()) {
            extract($this->input->post());


            if (empty($bank_id)) {
                $bank_id = 0;
            }
            if (empty($paymenttype)) {
                $paymenttype = 0;
            }
            $date = str_replace("/", "-", $date);
            $date = date("Y-m-d", strtotime($date));


            $cheque_date = str_replace("/", "-", $cheque_date);
            $cheque_date = date("Y-m-d", strtotime($cheque_date));

            if (empty($chaque_for)) {
                $chaque_for = 0;
            }

            if (empty($cheque_no)) {
                $cheque_no = 0;
            }

            if (!empty($site_id)) {
                $site_str = implode(",", $site_id);
            } else {
                $site_str = '';
            }

            if (!empty($invoice_id)) {
                $invoice_str = implode(",", $invoice_id);
            } else {
                $invoice_str = '';
            }

            if (!empty($debitnote_id)) {
                $debitnote_str = implode(",", $debitnote_id);
            } else {
                $debitnote_str = '';
            }

            if (empty($service_type)) {
                $service_type = 0;
            }
            $payment_behalf = 0;
            $client_id = (isset($client_id) && !empty($client_id)) ? $client_id : 0;
            if (!empty($data['onaccount_data']) && $data['onaccount_data']->is_suspense_account == 0){
                $payment_behalf = 1;
            }

            $ad_data = array(
                'staff_id' => get_staff_user_id(),
                'client_id' => $client_id,
                'payment_behalf' => $payment_behalf,
                'payment_mode' => $payment_mode,
                'chaque_for' => $chaque_for,
                'cheque_no' => $cheque_no,
                'cheque_date' => $cheque_date,
                'site_id' => $site_str,
                'invoice_id' => $invoice_str,
                'ttl_amt' => $ttl_amt,
                'reference_no' => $reference_no,
                'remark' => $remark,
                'date' => $date,
                'bank_id' => $bank_id,
                'payment_type_id' => $paymenttype,
                'service_type' => $service_type,
                'status' => $data['onaccount_data']->status,
                'created_date' => date('Y-m-d H:i:s')
            );

            $update = $this->home_model->update('tblclientpayment', $ad_data, array('id' => $id));


            if ($update == true) {
                $pay_id = $id;

                if (in_array("", $_FILES['file']['name'])) {
                    set_alert('success', 'file not select');
                } else {
                    $check1 = $this->db->query("SELECT * FROM `tblfiles` where rel_id = '" . $id . "' and rel_type = 'payment' ");
                    if ($check1) {
                        $this->db->delete('tblfiles', array('rel_id' => $id, 'rel_type' => 'payment'));
                    }

                    handle_multi_payment_attachments($pay_id, 'payment');
                }

                set_alert('success', 'On Account Payment Edit Successfully');
                $redirect_url = (!empty($data['onaccount_data']) && $data['onaccount_data']->is_suspense_account == 1) ? "payments/suspense_account_list": "Invoice_payments/on_account";
                redirect(admin_url($redirect_url));
            }
        }


        $data['file_info'] = $this->db->query("SELECT * FROM tblfiles WHERE rel_id = '" . $id . "' and rel_type = 'payment'  ")->result();
        $data['paytype_info'] = $this->db->query("SELECT * FROM tblpaymenttypes order by name asc")->result();


        $this->load->view('admin/invoice_payments/edit_onaccount', $data);
    }

    function clientpayment_approval($id)
    {
    	$info = $this->db->query("SELECT * from tblclientpayment  where id = '".$id."' and status > 0 ")->row();
	        if(!empty($info) && $info->status != 5){
	            set_alert('warning', 'Action already taken!');
	             redirect(admin_url('approval/notifications'));
	        }

        if(!empty($_POST)){
            extract($this->input->post());

            
            if($submit == 2)
            {
                $payment_info = $this->db->query("SELECT * FROM tblinvoicepaymentrecords  where pay_id = '".$id."' ")->result();
                if(!empty($payment_info))
                {
                    foreach ($payment_info as $payment_key => $payment_value)  {
                        if($payment_value->paymentmethod == 2){
                            $invoice_info = $this->db->query("SELECT `paid_amt` FROM tblinvoices  where id = '".$payment_value->invoiceid."' ")->row();
                            $f_paidamt = ($invoice_info->paid_amt - $payment_value->amount);
                        }
                        else{
                            $debit_info = $this->db->query("SELECT * FROM tbldebitnote  where `number` = '".$payment_value->debitnote_no."' ")->row();
                            $debitpayment_info = $this->db->query("SELECT * FROM tbldebitnotepayment  where `number` = '".$payment_value->debitnote_no."' ")->row();

                            if(!empty($debit_info)){
                                $f_paidamt = ($debit_info->paid_amt - $payment_value->amount);
                            }elseif(!empty($debitpayment_info)){
                                $f_paidamt = ($debitpayment_info->paid_amt - $payment_value->amount);
                            }
                        }


                            if($payment_value->paymentmethod == 2){
                                $this->home_model->update('tblinvoices', array('paid_amt'=>$f_paidamt) ,array('id'=>$payment_value->invoiceid));
                            }else{
                                if(!empty($debit_info)){
                                $this->home_model->update('tbldebitnote', array('paid_amt'=>$f_paidamt) ,array('id'=>$payment_value->invoiceid));
                                }elseif(!empty($debitpayment_info)){
                                $this->home_model->update('tbldebitnotepayment', array('paid_amt'=>$f_paidamt) ,array('id'=>$payment_value->invoiceid));
                                }
                            }

                            if($payment_value->paymentmethod == 2 || $payment_value->paymentmethod == 3){
                            $data1 = array(
                                'tds' => 0,
                                'tds_amt' => 0,
                                'showInReconciliation' => 0
                                );
                                $this->db->where('pay_id',$id);
                                $this->db->update('tblinvoicepaymentrecords', $data1);
                            }

                    }
                }
            }

            //Update master approval
            update_masterapproval_single(get_staff_user_id(),15,$id,$submit);
            update_masterapproval_all(15,$id,1);

            $ad_data = array('approve_status' => $submit,
                            'approve_date' => date('Y-m-d H:i:s'),
                            'approve_remark' => $remark
                        );
                                    
            $this->load->model('home_model');
            $update = $this->home_model->update('tblclientreceiptapproval', $ad_data,array('clientpayment_id'=>$id,'staff_id'=>get_staff_user_id()));
            $this->db->query("UPDATE tblclientpayment SET status='".$submit."' WHERE id='".$id."' ");

            if($update){
                if ($submit == 1){
                    set_alert('success', 'Client Payment taken approval succesfully');
                }else if ($submit == 2){
                    set_alert('danger', 'Client Payment taken Rejected succesfully');
                }else if ($submit == 4){
                    set_alert('success', 'Client Payment taken Reconciliation succesfully');
                }else if ($submit == 5){
                    set_alert('success', 'Client Payment taken Hold succesfully');
                }
                
                 redirect(admin_url('approval/notifications'));
            }


        }

        $data['bank_info'] = $this->db->query("SELECT * FROM tblbankmaster WHERE status = '1' order by name asc ")->result_array();
        $data['pay_info'] = $this->db->query("SELECT * FROM tblpaymenttypes order by name asc")->result_array();
        $data['service_type'] = get_service_type();
        $data['info']  = $this->db->query("SELECT * FROM tblclientpayment where id = '".$id."'  ")->row_array();
        $data['Sitedata'] = explode(',', $data['info']['site_id']);
        $data['invoicedata'] = explode(',', $data['info']['invoice_id']);
        $data['debitnotedata'] = explode(',', $data['info']['debitnote_no']);

        $data['stitemanager_info'] = $this->db->query("SELECT * FROM `tblsitemanager` order by name asc")->result_array();
        $data['invoice_info'] = $this->db->query("SELECT * FROM `tblinvoices` ")->result_array();
        $data['debitnote_info'] = $this->db->query("SELECT * FROM `tbldebitnote` ")->result_array();

        $staff  = $this->db->query("SELECT * FROM tblclientpayment where id = '".$id."'  ")->row();

        $data['appvoal_info'] = $this->db->query("SELECT * from tblclientreceiptapproval where clientpayment_id = '".$id."' and staff_id = '".get_staff_user_id()."' and approve_status !=0 ")->row();

        $data['id'] = $id;
        $data['staff_id'] = $staff->staff_id;
        $data['payment']  = $this->db->query("SELECT * FROM tblinvoicepaymentrecords where pay_id = '".$id."'  ")->result();

        $data['title'] = 'Client Payment Approval';
        $this->load->view('admin/invoice_payments/clientpayment_approval', $data);
    }

    public function convert_againstdebitnote($id) {

        if (!empty($id)) {

            if ($_POST){
                extract($this->input->post());

                $assignstaff=$assign['assignid'];
                $staff_id = array();
                foreach($assignstaff as $s_id)
                {
                    if($s_id > 0){
                        $staff_id[]=$s_id;
                    }
                }
                $staff_id=array_unique($staff_id);

                if(!empty($debitnote_id)){
                    $debitnote_str = implode(",",$debitnote_id);
                }else{
                    $debitnote_str = '';
                }

                $date = str_replace("/","-",$date);
                $date = date("Y-m-d",strtotime($date));

                $cheque_date = str_replace("/","-",$cheque_date);
                $cheque_date = date("Y-m-d",strtotime($cheque_date));

                if(empty($paymenttype)){
                    $paymenttype = 0;
                }

                if(empty($chaque_for)){
                    $chaque_for = 0;
                }

                if(empty($cheque_no)){
                    $cheque_no = 0;
                }

                if(empty($service_type)){
                    $service_type = 0;
                }

                $ad_data = array(
                        'staff_id' => get_staff_user_id(),
                        'client_id' => $client_id,
                        'payment_type_id' => $paymenttype,
                        'bank_id' => $bank_id,
                        'payment_behalf' => $payment_behalf,
                        'payment_mode' => $payment_mode,
                        'debitnote_no' => $debitnote_str,
                        'chaque_for' => $chaque_for,
                        'cheque_no' => $cheque_no,
                        'cheque_date' => $cheque_date,
                        'ttl_amt' => $ttl_amt,
                        'reference_no' => $reference_no,
                        'service_type' => $service_type,
                        'remark' => $remark,
                        'date' => $date,
                        'status' => 0,
                        'created_date' => date('Y-m-d H:i:s')
                    );

                $update = $this->home_model->update('tblclientpayment', $ad_data,array('id'=>$id));
                if($update == true){
                    $pay_id = $id;

                    if (!empty($staff_id)) {
                        $this->home_model->delete('tblclientreceiptapproval', array('clientpayment_id' => $id));
                        $this->home_model->delete('tblmasterapproval', array('table_id' => $id, 'module_id' => '15'));

                        foreach ($staff_id as $staffid) {

                            $ad_field = array(
                                'staff_id' => $staffid,
                                'clientpayment_id' => $pay_id,
                                'status' => 1,
                                'approve_status' => 0,
                                'created_at' => date('Y-m-d H:i:s')
                            );
                            $this->home_model->insert('tblclientreceiptapproval', $ad_field);

                            $message = 'Client Receipt send you for approval';

                            $adata = array(
                                'staff_id' => $staffid,
                                'fromuserid' => get_staff_user_id(),
                                'module_id' => 15,
                                'table_id' => $pay_id,
                                'approve_status' => 0,
                                'status' => 0,
                                'description' => $message,
                                'link' => 'invoice_payments/clientpayment_approval/' . $pay_id,
                                'date' => date('Y-m-d'),
                                'date_time' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            );
                            $this->db->insert('tblmasterapproval', $adata);

                            //Sending Mobile Intimation
                            $token = get_staff_token($staffid);
                            $title = 'Schach';
                            $send_intimation = sendFCM($message, $title, $token, $page = 2);
                        }
                    }

                    $result_file=handle_multi_payment_attachments($pay_id,'payment');
                    if (!empty($row)) {
                        foreach ($row as $key => $value) {
                            $amount = $_POST['amount_' . $value];
                            $tds = $_POST['tds' . $value];
                            $tds_amt = $_POST['tds_amt' . $value];

                            if (!empty($_POST['clear_' . $value])) {
                                $is_clear = 1;
                            } else {
                                $is_clear = 0;
                            }



                            if ($amount > 0 || $tds_amt > 0) {
                                $debit_info = $this->db->query("SELECT * FROM tbldebitnote  where `number` = '" . $value . "' ")->row();
                                $debitpayment_info = $this->db->query("SELECT * FROM tbldebitnotepayment  where `number` = '" . $value . "' ")->row();

                                $dbitnote_id = 0;
                                if (!empty($debit_info)) {
                                    $f_paidamt = ($debit_info->paid_amt + $amount);

                                    //Getting Payment status
                                    $amt = $debit_info->totalamount;
                                    if ($f_paidamt >= $amt) {
                                        $paid_status = 1;
                                    } else {
                                        $paid_status = 2;
                                    }
                                    //For payment mode NEFT And CASH
                                    if ($payment_mode == 2 || $payment_mode == 3) {
                                        $this->home_model->update('tbldebitnote', array('paid_amt' => $f_paidamt, 'paid_status' => $paid_status), array('id' => $debit_info->id));
                                    }
                                    //END For payment mode NEFT And CASH

                                    $dbitnote_id = $debit_info->id;
                                } elseif (!empty($debitpayment_info)) {
                                    $f_paidamt = ($debitpayment_info->paid_amt + $amount);

                                    //Getting Payment status
                                    $amt = $debitpayment_info->amount;
                                    if ($f_paidamt >= $amt) {
                                        $paid_status = 1;
                                    } else {
                                        $paid_status = 2;
                                    }

                                    //For payment mode NEFT And CASH
                                    if ($payment_mode == 2 || $payment_mode == 3) {
                                        $this->home_model->update('tbldebitnotepayment', array('paid_amt' => $f_paidamt, 'paid_status' => $paid_status), array('id' => $debitpayment_info->id));
                                    }
                                    //END For payment mode NEFT And CASH

                                    $dbitnote_id = $debitpayment_info->id;
                                }



                                $ad_data_1 = array(
                                    'invoiceid' => $dbitnote_id,
                                    'debitnote_no' => $value,
                                    'amount' => $amount,
                                    'pay_id' => $pay_id,
                                    'bank_id' => $bank_id,
                                    'payment_type_id' => $paymenttype,
                                    'paymentmode' => $payment_mode,
                                    'paymentmethod' => $payment_behalf,
                                    'date' => $date,
                                    'tds' => $tds,
                                    'tds_amt' => $tds_amt,
                                    'is_clear' => $is_clear,
                                    'daterecorded' => date('Y-m-d H:i:s')
                                );

                                $insert_payment = $this->home_model->insert('tblinvoicepaymentrecords', $ad_data_1);
                            }
                        }
                    }
                    set_alert('success', 'Payment Added successfully');
	            redirect(admin_url('payments'));
                }
            }

            $data['title'] = 'Client Payment Form';
            $data['payment_info'] = $this->db->query("SELECT * from tblclientpayment where id = '" . $id . "' ")->row();

            $client_info = $this->db->query("SELECT `client_branch_name` from tblclientbranch where userid =  '" . $data['payment_info']->client_id . "' ")->row();
            $data['client_company'] = $client_info->client_branch_name;
            $data['id'] = $id;

            $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='Stock'")->result_array();
            $i = 0;
            foreach ($Staffgroup as $singlestaff) {
                $i++;
                $stafff[$i]['id'] = $singlestaff['id'];
                $stafff[$i]['name'] = $singlestaff['name'];
                $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "' order by s.firstname asc")->result_array();
                $stafff[$i]['staffs'] = $query;
            }
            $data['allStaffdata'] = $stafff;

            $data['approved_by'] = $this->db->query("SELECT * FROM `tblclientreceiptapproval` where clientpayment_id = '" . $id . "' ")->result_array();
            $data['bank_info'] = $this->db->query("SELECT * FROM tblbankmaster WHERE status = '1' order by name asc ")->result();
            $data['paytype_info'] = $this->db->query("SELECT * FROM tblpaymenttypes order by name asc")->result();
            $this->load->view('admin/invoice_payments/convert_againstdebitnote', $data);
        }
    }

    public function get_paymenttype_bank()
    {
    	if ($this->input->post()) {
            $paytype_id = $_POST["paytype"];
            $bank_id = $_POST["bank_id"];

            $bank_list = $this->db->query("SELECT * FROM tblbankmaster WHERE payment_type = '".$paytype_id."' ")->result();
            $html = '<option value="">--Select One-</option>';
            if(!empty($bank_list)){
                foreach ($bank_list as $key => $value) {
                    $selected = (isset($bank_id) && $bank_id == $value->id) ? "selected":"";
                    $html .= '<option value="'.$value->id.'" '.$selected.'>'.cc($value->name).'</option>';
                }
            }

            echo $html;
        }
    }

}
