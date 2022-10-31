<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Debit_note extends Admin_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Debitnote_model');
        $this->load->model('home_model');
    }

    /* Get all estimates in case user go on index page */
    public function update_tax() {
        /*$debitnote_list = $this->db->query("SELECT * from tbldebitnote ")->result();

        if(!empty($debitnote_list)){
            foreach ($debitnote_list as $row) {
                update_debitnote_final_amount($row->id);
            }
        }*/

        $debitnote_list = $this->db->query("SELECT * from tbldebitnotepayment ")->result();

        if(!empty($debitnote_list)){
            foreach ($debitnote_list as $row) {
                update_payment_debitnote_final_amount($row->id);
            }
        }
    }


    public function index() {

        check_permission(25,'view');
        $designation_id = get_staff_info(get_staff_user_id())->designation_id;
        if(is_admin() == 1 || in_array($designation_id, [12,28,52])){
            $where = "id > '0' AND status != '0'";
        }else{
            $where = "id > '0' AND staff_id = '".get_staff_user_id()."' AND status != '0'";
        }
    	if(!empty($_POST)){
       		extract($this->input->post());

       		// $where = " id > '0'and status != '0' ";
       		if(!empty($clientid)){
       		    $data['s_client'] = $clientid;

       		    $where .= " and clientid = '".$clientid."'";
       		}

       		if(!empty($status)){
       		    $data['status'] = $status;
       		    if($status == 3){
       		    	$st = 0;
       		    }else{
       		    	$st = $status;
       		    }
       		    $where .= " and paid_status = '".$st."'";
       		}


       		if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $t_date = str_replace("/","-",$t_date);

                $from_date = date('Y-m-d',strtotime($f_date));
                $to_date = date('Y-m-d',strtotime($t_date));

               $where .= " and dabit_note_date  BETWEEN  '".$from_date."' and  '".$to_date."' ";
           }
    	}else{
            $where .= " and year_id = '".financial_year()."' ";
        }


    	   $data['debitnote_list'] = $this->db->query("SELECT * from tbldebitnote where  ".$where." order by id desc ")->result();
         $data['dn_amount'] = $this->db->query("SELECT sum(totalamount) as ttl_amt from `tbldebitnote` where ".$where." ")->row()->ttl_amt;
         $data['taxable_value'] = $this->db->query("SELECT sum(total_tax) as tax_val from `tbldebitnote` where ".$where." ")->row()->tax_val;

         $data['client_branch_data'] = $this->db->query("SELECT * FROM `tblclientbranch` WHERE `active`=1 AND `client_branch_name`!='' ORDER BY client_branch_name ASC")->result();

    	   $data['title'] = 'Debit Note List';
        $this->load->view('admin/debit_note/view', $data);
    }




    public function add($id = '') {
        check_permission(25,'create');
        if ($this->input->post()) {
            $proposal_data = $this->input->post();

            /*echo '<pre/>';
            print_r($proposal_data);
            die;*/
            if ($id == '') {

                $id = $this->Debitnote_model->add($proposal_data);

                if ($id) {
                	update_debitnote_final_amount($id);
                    set_alert('success', _l('added_successfully', 'debit Note'));
                    redirect(admin_url('debit_note'));
                }
            } else {
                check_permission(25,'edit');
                $success = $this->Debitnote_model->update($proposal_data, $id);

                // exit;
                if ($success) {
                	update_debitnote_final_amount($id);
                    set_alert('success', _l('updated_successfully', 'debit Note'));
                    redirect(admin_url('debit_note'));
                }
            }
        }

        if ($id == '') {
            $title = 'Add Debit Note';
        } else {
        	 $title = 'Edit Debit Note';
            $data['debit_info'] = $this->db->query("SELECT * from tbldebitnote where id = '".$id."' ")->row();
            $data['product_info'] = $this->db->query("SELECT * from tbldebitnoteproduct where debitnote_id = '".$id."' ")->result_array();
            $data['debitnote_othercharges'] = $this->db->query("SELECT * from tbldebitnoteothercharges where proposalid = '".$id."' ")->result_array();
            $data['challan_info'] = $this->db->query("SELECT * FROM `tblchalanmst` WHERE `clientid`='".$data['debit_info']->clientid."' and status = 1 order by id desc")->result();
            $data['invoice_info'] = $this->db->query("SELECT `number`,`id` from tblinvoices where clientid = '".$data['debit_info']->clientid."' ")->result();
            $data['contactdata']=$this->db->query("SELECT *,c.id as contactid FROM `tblinvoiceclientperson` icp LEFT JOIN `tblcontacts` c ON icp.`contact_id`=c.`id` WHERE `invoice_id`='".$id."' AND `type`='debitnote'")->result_array();
            $this->db->where('proposalid', $id);
            $proposalfields = $this->db->get('tbldebitnoteproductfields')->result_array();
            $proposalfieldname = array_column($proposalfields, 'field_id');
            $data['proposalfields'] = $proposalfieldname;
        }

        $this->load->model('Other_charges_model');
        $data['othercharges'] = $this->Other_charges_model->get();
        $data['product_data'] = $this->db->query("SELECT * FROM `tblproducts` where status = 1 and is_approved = 1 ORDER BY name ASC")->result_array();

        $data['title']     = $title;
        $this->load->model('Site_manager_model');
        $data['all_site'] = $this->Site_manager_model->get();
        $this->load->model('Contact_type_model');
        $data['contact_type_data'] = $this->Contact_type_model->get();
        $this->load->model('Designation_model');
        $data['designation_data'] = $this->Designation_model->get();

        $data['client_branch_data'] = $this->db->query("SELECT * FROM `tblclientbranch` WHERE `active`=1 AND `client_branch_name`!='' ORDER BY client_branch_name ASC")->result();

        $data['productfield_info'] = $this->db->query("SELECT * FROM `tblproductcustomfields` where status = 1 order by field_for desc")->result();

        $this->load->view('admin/debit_note/add', $data);
    }



    public function get_challan_list() {

    	extract($this->input->post());

		$challan_info = $this->db->query("SELECT * FROM `tblchalanmst` WHERE `clientid`='".$clientid."' and status IN (1,6) order by id desc")->result();
		$html = '';
		if(!empty($challan_info)){
			$html .= '<option value=""></option>';
			foreach ($challan_info as $key => $value) {
                $date = '';
                if(!empty($value->challandate)){
                   $date = ' - '._d($value->challandate);
                }
                $selectedcls = (!empty($challan_id) && $challan_id == $value->id) ? 'selected': ''; 
				$html .= '<option value="'.$value->id.'" '.$selectedcls.'>'.$value->chalanno.$date.'</option>';
            }
        }
		echo $html;

    }




    public function download_pdf($id)
    {
        require_once APPPATH.'third_party/pdfcrowd.php';

        if (!$id) {
            redirect(admin_url('debit_note'));
        }

        $debit_info = $this->db->query("SELECT * FROM `tbldebitnote` where id =  '".$id."' ")->row();
        $file_name = 'Debit Note - '.$id;

         /*echo $html = purchase_order_pdf($purchase);
         die;*/
        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            $html = nturm_debit_note_pdf($debit_info);
        }else{
            $html = debit_note_pdf($debit_info);
        }

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        if ($debit_info->status == 0){
            // Instantiate canvas instance 
            $canvas = $dompdf->getCanvas(); 

            // Get height and width of page 
            $w = $canvas->get_width(); 
            $h = $canvas->get_height(); 
            
            // Specify watermark image 
            $imageURL = 'assets/images/cancelled-img.jpg'; 
            $imgWidth = 500; 
            $imgHeight = 250; 
            
            // Set image opacity 
            $canvas->set_opacity(.2); 
            
            // Specify horizontal and vertical position 
            $x = (($w-$imgWidth)/2); 
            $y = (($h-$imgHeight)/2); 
            
            // Add an image to the pdf 
            $canvas->image($imageURL, $x, $y, $imgWidth, $imgHeight); 
        }

        // Parameters
        $x          = 280;
        $y          = 820;
        $text       = "{PAGE_NUM} of {PAGE_COUNT}";
        $font       = $dompdf->getFontMetrics()->get_font('Helvetica', 'normal');
        $size       = 8;
        $color      = array(0,0,0);
        $word_space = 0.0;
        $char_space = 0.0;
        $angle      = 0.0;

        $dompdf->getCanvas()->page_text(
          $x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle
        );

        //$dompdf->stream($file_name);
        $dompdf->stream($file_name, array("Attachment" => false));


    }


    public function delete($id) {
        check_permission(25,'delete');

        $delete = $this->home_model->delete('tbldebitnote',array('id'=>$id));

        if($delete == true){
            $this->home_model->delete('tbldebitnoteproduct',array('debitnote_id'=>$id));
            $this->home_model->delete('tbldebitnoteothercharges',array('proposalid'=>$id));
            $this->home_model->delete('tbldebitnoteproductfields',array('proposalid'=>$id));
            set_alert('success', 'Debit note deleted successfully');
            redirect(admin_url('debit_note'));
        }

    }

    public function view_paymentnote() {

        check_permission(26,'view');
        $designation_id = get_staff_info(get_staff_user_id())->designation_id;
        if(is_admin() == 1 || in_array($designation_id, [12,28,52])){
            $where = "id > '0' AND status != '0'";
        }else{
            $where = "id > '0' AND staff_id = '".get_staff_user_id()."' AND status != '0'";
        }
        if(!empty($_POST)){
            extract($this->input->post());
            /*echo '<pre/>';
            print_r($_POST);
            die;*/
            // $where = " id > '0' and status != '0'";
            if(!empty($clientid)){
                $data['s_client'] = $clientid;

                $where .= " and clientid = '".$clientid."'";
            }

            if(!empty($status)){
       		    $data['status'] = $status;
       		    
                $st = ($status == 3) ? 0 : $status;
       		    $where .= " and paid_status = '".$st."'";
       		}

            if(!empty($f_date) && !empty($t_date)){

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $t_date = str_replace("/","-",$t_date);

                $from_date = date('Y-m-d',strtotime($f_date));
                $to_date = date('Y-m-d',strtotime($t_date));

               $where .= " and date  BETWEEN  '".$from_date."' and  '".$to_date."' ";
           }

        }else{
            $where .= " and year_id = '".financial_year()."' ";
        }


        $data['debitnote_list'] = $this->db->query("SELECT * from tbldebitnotepayment where  ".$where." order by id desc ")->result();
        $data['dn_amount'] = $this->db->query("SELECT sum(amount) as ttl_amt from `tbldebitnotepayment` where ".$where." AND status = 1 ")->row()->ttl_amt;

        $data['client_branch_data'] = $this->db->query("SELECT * FROM `tblclientbranch` WHERE `active`=1 AND `client_branch_name`!='' ORDER BY client_branch_name ASC")->result();

        $data['title'] = 'Debit Note List';
        $this->load->view('admin/debit_note/view_paymentnote', $data);
    }

    public function add_paymentnote($id = '') {
        check_permission(26,'create');
        if ($this->input->post()) {
            $proposal_data = $this->input->post();

            /*echo '<pre/>';
            print_r($proposal_data);
            die;*/
            if ($id == '') {

                $id = $this->Debitnote_model->add_paymentnote($proposal_data);

                if ($id) {
                    update_payment_debitnote_final_amount($id);
                    set_alert('success', _l('added_successfully', 'debit Note'));
                    redirect(admin_url('debit_note/view_paymentnote'));
                }
            } else {
                check_permission(26,'edit');
               $success = $this->Debitnote_model->update_paymentnote($proposal_data, $id);

                // exit;
                if ($success) {
                    update_payment_debitnote_final_amount($id);
                    set_alert('success', _l('updated_successfully', 'debit Note'));
                    redirect(admin_url('debit_note/view_paymentnote'));
                }
            }
        }

        if ($id == '') {
            $title = 'Add Debit Note';
        } else {
             $title = 'Edit Debit Note';
            $data['debit_info'] = $this->db->query("SELECT * from tbldebitnotepayment where id = '".$id."' ")->row();
            $data['invoice_info'] = $this->db->query("SELECT * FROM `tblinvoices` WHERE `clientid`='".$data['debit_info']->clientid."' order by id desc")->result();
            $data['invoicedata_info'] = $this->db->query("SELECT * FROM `tbldebitnotepaymentitems` WHERE `type` = '1' and `debitnote_id`='".$id."' ")->result();
            $data['debitnotedata_info'] = $this->db->query("SELECT * FROM `tbldebitnotepaymentitems` WHERE `type` = '2' and `debitnote_id`='".$id."' ")->result();
            $data['contactdata']=$this->db->query("SELECT *,c.id as contactid FROM `tblinvoiceclientperson` icp LEFT JOIN `tblcontacts` c ON icp.`contact_id`=c.`id` WHERE `invoice_id`='".$id."' AND `type`='debitnotepayment'")->result_array();
        }

        $data['title']     = $title;
        $this->load->model('Contact_type_model');
        $data['contact_type_data'] = $this->Contact_type_model->get();
        $this->load->model('Designation_model');
        $data['designation_data'] = $this->Designation_model->get();

        $data['client_branch_data'] = $this->db->query("SELECT * FROM `tblclientbranch` WHERE `active`=1 AND `client_branch_name`!='' ORDER BY client_branch_name ASC")->result();

        $this->load->view('admin/debit_note/add_paymentnote', $data);
    }

    public function get_invoice_list() {

        extract($this->input->post());

        $invoice_info = $this->db->query("SELECT * FROM `tblinvoices` WHERE `clientid`='".$clientid."' order by id desc")->result();
        $html = '';
        if(!empty($invoice_info)){
            $html .= '<option value=""></option>';
            foreach ($invoice_info as $key => $value) {

                $html .= '<option value="'.$value->id.'">'.$value->number.'</option>';
            }
        }
        echo $html;

    }

    public function get_debitnote_list() {

        extract($this->input->post());

        $debitnote_info = $this->db->query("SELECT * FROM `tbldebitnote` WHERE `clientid`='".$clientid."' AND `status` = 1 order by id desc")->result();
        $html = '';
        if(!empty($debitnote_info)){
            $html .= '<option value=""></option>';
            foreach ($debitnote_info as $key => $value) {

                $html .= '<option value="'.$value->id.'">'.$value->number.'</option>';
            }
        }
        echo $html;

    }

    public function invoice_details() {
        extract($this->input->post());
        $invoice_info = $this->db->query("SELECT `paid_amt`,`total`,`invoice_date` FROM `tblinvoices` WHERE `id`='".$id."' ")->row();
        $data = _d($invoice_info->invoice_date);
        $balance_amt = ($invoice_info->total - $invoice_info->paid_amt);
        $invoice_data = array('amount' => $balance_amt , 'date' =>$data);

        echo json_encode($invoice_data);
    }

    public function debitnote_details() {
        extract($this->input->post());
        $debitnote_info = $this->db->query("SELECT `totalamount`,`dabit_note_date` FROM `tbldebitnote` WHERE `id`='".$id."' ")->row();
        $date = _d($debitnote_info->dabit_note_date);
        $debitnote_data = array('amount' => $debitnote_info->totalamount , 'date' =>$date);

        echo json_encode($debitnote_data);
    }

    public function make_calculation() {
        extract($this->input->post());


        $date1 = str_replace("/","-",$date);
        $date1 = date("Y-m-d",strtotime($date1));

        $date2 = str_replace("/","-",$due_date);
        $date2 = date("Y-m-d",strtotime($date2));

        $diff = strtotime($date2) - strtotime($date1);
        $delay_days = abs(round($diff / 86400));

        $amount = ($invoice_amount*$delay_days/365*$intrest_percent/100);

        $tax_amt = ($amount*18/100);
        $final_amount = ($amount + $tax_amt);


        $invoice_data = array(
            'invoice_amount' => $invoice_amount,
            'delay_days' =>$delay_days,
            'amount' =>number_format(round($amount), 2, '.', ''),
            'final_amount' =>number_format(round($final_amount), 2, '.', ''),
            'tax' => 18,
         );
        echo json_encode($invoice_data);
    }

    public function download_paymentpdf($id)
    {
        require_once APPPATH.'third_party/pdfcrowd.php';

        if (!$id) {
            redirect(admin_url('debit_note'));
        }

        $debit_info = $this->db->query("SELECT * FROM `tbldebitnotepayment` where id =  '".$id."' ")->row();
        $file_name = 'Debit Note - '.$id;

         /*echo $html = purchase_order_pdf($purchase);
         die;*/
        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            $html = nturm_debit_notepayment_pdf($debit_info);
        }else{
            $html = debit_notepayment_pdf($debit_info);
        }

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        if ($debit_info->status == 0){
            // Instantiate canvas instance 
            $canvas = $dompdf->getCanvas(); 

            // Get height and width of page 
            $w = $canvas->get_width(); 
            $h = $canvas->get_height(); 
            
            // Specify watermark image 
            $imageURL = 'assets/images/cancelled-img.jpg'; 
            $imgWidth = 500; 
            $imgHeight = 250; 
            
            // Set image opacity 
            $canvas->set_opacity(.2); 
            
            // Specify horizontal and vertical position 
            $x = (($w-$imgWidth)/2); 
            $y = (($h-$imgHeight)/2); 
            
            // Add an image to the pdf 
            $canvas->image($imageURL, $x, $y, $imgWidth, $imgHeight); 
        }
        
        // Parameters
        $x          = 280;
        $y          = 820;
        $text       = "{PAGE_NUM} of {PAGE_COUNT}";
        $font       = $dompdf->getFontMetrics()->get_font('Helvetica', 'normal');
        $size       = 8;
        $color      = array(0,0,0);
        $word_space = 0.0;
        $char_space = 0.0;
        $angle      = 0.0;

        $dompdf->getCanvas()->page_text(
          $x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle
        );

        //$dompdf->stream($file_name);
        $dompdf->stream($file_name, array("Attachment" => false));


    }

    public function delete_paymentnote($id) {
        check_permission(26,'delete');

        $delete = $this->home_model->delete('tbldebitnotepayment',array('id'=>$id));

        if($delete == true){
        	$this->home_model->delete('tbldebitnotepaymentitems',array('debitnote_id'=>$id));
            set_alert('success', 'Debit note deleted successfully');
            redirect(admin_url('debit_note/view_paymentnote'));
        }

    }

    public function get_invoice_row() {
        extract($this->input->post());
        $invoice_info = $this->db->query("SELECT * FROM `tblinvoices` WHERE `clientid`='".$clientid."' order by id desc")->result();

        ?>
        <tr class="trsalepro<?php echo $row; ?>">
                <td>
                    <button type="button" class="btn btn-danger" onclick="removesalepro(<?php echo $row; ?>);"><i class="fa fa-remove"></i></button>
                </td>
                <td>
                    <select class="form-control selectpicker invoice" val="<?php echo $row; ?>" name="data[<?php echo $row; ?>][invoice_id]" id="invoice_id<?php echo $row; ?>" data-live-search="true" required="">
                        <option value=""></option>
                        <?php
                        if (!empty($invoice_info)) {
                            foreach ($invoice_info as  $r) {

                                ?>
                                <option value="<?php echo $r->id ?>"><?php echo $r->number; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <div class="input-group">
                        <input type="text" id="due_date<?php echo $row; ?>" name="data[<?php echo $row; ?>][due_date]" class="form-control date" value="">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input type="text" name="data[<?php echo $row; ?>][invoice_amount]" id="invoice_amount<?php echo $row; ?>" readonly="" class="form-control" value="">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input type="text" id="delay_days<?php echo $row; ?>" name="data[<?php echo $row; ?>][delay_days]" readonly="" class="form-control" value="">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input type="text" id="amount<?php echo $row; ?>" name="data[<?php echo $row; ?>][amount]" readonly="" class="form-control onlynumbers" value="">
                    </div>
                </td>

                <td>
                    <div class="form-group">
                        <input type="text" id="tax<?php echo $row; ?>" name="data[<?php echo $row; ?>][tax]" readonly="" class="form-control onlynumbers" value="">
                    </div>
                </td>

                <td>
                    <div class="form-group">
                        <input type="text"  id="final_amount<?php echo $row; ?>" name="data[<?php echo $row; ?>][final_amount]"  readonly="" class="form-control onlynumbers" value="">
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-success calculate" value="<?php echo $row; ?>">Calculate</button>
                </td>
          </tr>

        <?php
    }

    public function get_debitnote_row() {
        extract($this->input->post());
        $debitnote_info = $this->db->query("SELECT * FROM `tbldebitnote` WHERE `clientid`='".$clientid."' and `status` = 1 order by id desc")->result();

        ?>
        <tr class="trdebitnote<?php echo $row; ?>">
                <td>
                    <button type="button" class="btn btn-danger" onclick="removesalepro(<?php echo $row; ?>);"><i class="fa fa-remove"></i></button>
                </td>
                <td>
                    <select class="form-control selectpicker debitnote" val="<?php echo $row; ?>" name="data_dn[<?php echo $row; ?>][invoice_id]" id="dn_invoice_id<?php echo $row; ?>" data-live-search="true" required="">
                        <option value=""></option>
                        <?php
                        if (!empty($debitnote_info)) {
                            foreach ($debitnote_info as  $r) {

                                ?>
                                <option value="<?php echo $r->id ?>"><?php echo $r->number; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <div class="input-group">
                        <input type="text" id="dn_due_date<?php echo $row; ?>" name="data_dn[<?php echo $row; ?>][due_date]" class="form-control date" value="">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input type="text" name="data_dn[<?php echo $row; ?>][invoice_amount]" id="dn_invoice_amount<?php echo $row; ?>" readonly="" class="form-control" value="">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input type="text" id="dn_delay_days<?php echo $row; ?>" name="data_dn[<?php echo $row; ?>][delay_days]" readonly="" class="form-control" value="">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input type="text" id="dn_amount<?php echo $row; ?>" name="data_dn[<?php echo $row; ?>][amount]" readonly="" class="form-control onlynumbers" value="">
                    </div>
                </td>

                <td>
                    <div class="form-group">
                        <input type="text" id="dn_tax<?php echo $row; ?>" name="data_dn[<?php echo $row; ?>][tax]" readonly="" class="form-control onlynumbers" value="">
                    </div>
                </td>

                <td>
                    <div class="form-group">
                        <input type="text"  id="dn_final_amount<?php echo $row; ?>" name="data_dn[<?php echo $row; ?>][final_amount]"  readonly="" class="form-control onlynumbers" value="">
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-success calculate_dn" value="<?php echo $row; ?>">Calculate</button>
                </td>
          </tr>

        <?php
    }


    public function export()
    {
        $where = " id > '0' and year_id = '".financial_year()."' ";
        if(!empty($_GET)){
            extract($this->input->get());
            if(!empty($client_id)){
                $where .= " and clientid = '".$client_id."'";
            }

            if(!empty($f_date) && !empty($t_date)){
                $f_date = str_replace("/","-",$f_date);
                $t_date = str_replace("/","-",$t_date);

                $from_date = date('Y-m-d',strtotime($f_date));
                $to_date = date('Y-m-d',strtotime($t_date));

               $where .= " and dabit_note_date  BETWEEN  '".$from_date."' and  '".$to_date."' ";
           }
        }
        $debitnote_list = $this->db->query("SELECT * from tbldebitnote where  ".$where." order by id desc ")->result();

        // create file name
        $fileName = 'Debitnote.xlsx';
        // load excel library
        $this->load->library('excel');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);


        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Report : Debit Note');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J3');
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date : '.date('d/m/Y').'');


        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Company GST Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Client Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Client GST Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Invoice Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Invoice Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Total Invoice Value');
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Total Taxable Value');
        $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'CGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('J4', 'SGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('K4', 'IGST');
        // set Row
        $rowCount = 5;
        $i = 1;
        foreach ($debitnote_list as $val)
        {
            $client_info = $this->db->query("SELECT `client_branch_name`,`vat` from `tblclientbranch` where userid = '".$val->clientid."'  ")->row();
            //$tax_type = get_client_gst_type($val->clientid);
            $tax_type = $val->tax_type;

            $cgst = '--';
            $sgst = '--';
            $igst = '--';
            if($tax_type == 1){
                $tax = ($val->total_tax/2);
                $sgst = number_format(round($tax), 2, '.', '');
                $cgst = number_format(round($tax), 2, '.', '');
            }else{
                $igst = $val->total_tax;
            }

            $billing_info = get_branch_details($val->branch_id);

            $total_tax_value = ($val->totalamount-$val->total_tax);

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $billing_info['gst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $client_info->client_branch_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $client_info->vat);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $val->number);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, _d($val->dabit_note_date));
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $val->totalamount);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $total_tax_value);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $cgst);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $sgst);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $igst);

            $i++;
            $rowCount++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(site_url().$fileName);



    }

    public function getclientinvoice()
    {
       // if ($this->input->post()) {
            extract($this->input->post());
            $invoice_info = $this->db->query("SELECT `number`,`id` from `tblinvoices` where `clientid` = '".$client_id."' AND `parent_id` = 0 ")->result();

            $html = '<option value="">--Select One-</option>';
            if(!empty($invoice_info)){
                foreach ($invoice_info as $value) {
                    $html .= '<option value="'.$value->id.'">'.$value->number.'</option>';
                }
            }

            echo $html;
       // }
    }

    public function get_invoice_by_challan()
    {
        if ($this->input->post()) {
            extract($this->input->post());
            if ($challan_id != ''){
                $invoice_info = $this->db->query("SELECT `id` from tblinvoices where challan_id = '".$challan_id."' ")->row();
                if(!empty($invoice_info)){
                    echo $invoice_info->id;
                }
            }
        }
    }

    /* this function use for send mail of lead */
    public function send_to_mail(){
        $this->load->model('emails_model');

        if ($_POST){
            extract($this->input->post());
            if ($template_name == "debit_note"){
                $dnote_data = $this->db->query("SELECT * FROM tbldebitnote WHERE id = ".$debit_note_id."")->row();
                $redirect_url = "debit_note";
            }else{
                $dnote_data = $this->db->query("SELECT * FROM tbldebitnotepayment WHERE id = ".$debit_note_id."")->row();
                $redirect_url = "debit_note/view_paymentnote";
            }

            if (!empty($dnote_data)){
                $response = $this->emails_model->send_mail($debit_note_id, $template_name, $module_template_id, $dnote_data, $sent_to, $message, $cc);
                if ($response == TRUE){
                    set_alert('success', "Debit Note send on mail successfully");
                    redirect(admin_url($redirect_url));
                }
                else{
                    set_alert('danger', "Something went wrong.");
                    redirect(admin_url($redirect_url));
                }
            }
            else{
                set_alert('danger', "debit note not found");
                redirect(admin_url($redirect_url));
            }
        }
        else{
            redirect(admin_url($redirect_url));
        }
    }

    /* this function use for mark as cancelled */
    public function mark_as_cancelled($id)
    {
        // check against debit note
        $chk_debitnote = $this->db->query("SELECT * FROM `tbldebitnote` WHERE `id` = '".$id."'")->row();
        if (!empty($chk_debitnote)){
            $success = $this->home_model->update('tbldebitnote', array('status' => 0), array('id' => $id));
            if ($success) {
                set_alert('success', 'Debit note cancelled successfully.');
            }else{
                set_alert('warning', "Something went wrong");
            }
        }
        else{
            set_alert('warning', "Record Not Found");
        }
        redirect(admin_url('debit_note'));
    }

    /* this function use for payment mark as cancelled */
    public function paymentmark_as_cancelled($id)
    {
        // check against debit note
        $chk_debitnote = $this->db->query("SELECT * FROM `tbldebitnotepayment` WHERE `id` = '".$id."'")->row();
        if (!empty($chk_debitnote)){
            $success = $this->home_model->update(' tbldebitnotepayment', array('status' => 0), array('id' => $id));
            if ($success) {
                set_alert('success', 'Debit note cancelled successfully.');
            }else{
                set_alert('warning', "Something went wrong");
            }
        }
        else{
            set_alert('warning', "Record Not Found");
        }
        redirect(admin_url('debit_note/view_paymentnote'));
    }

    /* this function use for update accounted status in debit note */
    public function update_accounted_status($debitnote_id, $page_name){
        $table_name = 'tbldebitnotepayment';
        $redirect_url = 'debit_note/view_paymentnote';
        if ($page_name == 'debit_note'){
            $table_name = 'tbldebitnote';
            $redirect_url = 'debit_note';
        }
        $status = value_by_id_empty($table_name, $debitnote_id, "accounted_status");
        $updata["accounted_status"] = 0;
        if ($status == 0){
            $updata["accounted_status"] = 1;
            $updata["accounted_by"] = get_staff_user_id();
            $updata["accounted_date"] = date("Y-m-d H:i:s");
        }
        
        $this->home_model->update($table_name, $updata,array('id'=>$debitnote_id));
        redirect(admin_url($redirect_url));
    }
}
