<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Creditnotes extends Admin_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Creditnote_model');
        $this->load->model('home_model');
    }

    /* Get all estimates in case user go on index page */
    public function update_tax() {
        $debitnote_list = $this->db->query("SELECT * from tblpurchaseinvoice ")->result();

        if(!empty($debitnote_list)){
            foreach ($debitnote_list as $row) {
                update_purchase_invoice_final_amount($row->id);
            }
        }
    }


    public function index() {

        check_permission(27,'view');
        $designation_id = get_staff_info(get_staff_user_id())->designation_id;
        if(is_admin() == 1 || in_array($designation_id, [12,28,52])){
            $where = "id > '0' and status != '5'";
        }else{
            $where = "id > '0' AND staff_id = '".get_staff_user_id()."' AND status != '5'";
        }
        if (!empty($_POST)) {
            extract($this->input->post());

            // $where = " id > '0' and status != '5'";
            if (!empty($clientid)) {
                $data['s_client'] = $clientid;

                $where .= " and clientid = '" . $clientid . "'";
            }
            if (strlen($status) > 0) {
                $data['s_status'] = $status;

                $where .= " and status = '" . $status . "'";
            }

            if (!empty($f_date) && !empty($t_date)) {

                $data['s_fdate'] = $f_date;
                $data['s_tdate'] = $t_date;

                $f_date = str_replace("/", "-", $f_date);
                $t_date = str_replace("/", "-", $t_date);

                $from_date = date('Y-m-d', strtotime($f_date));
                $to_date = date('Y-m-d', strtotime($t_date));

                $where .= " and date  BETWEEN  '" . $from_date . "' and  '" . $to_date . "' ";
            }
        } else {
            $where .= " and year_id = '" . financial_year() . "' ";
        }

        $data['debitnote_list'] = $this->db->query("SELECT * from tblcreditnote where  ".$where." order by id desc ")->result();
        $data['dn_amount'] = $this->db->query("SELECT sum(totalamount) as ttl_amt from `tblcreditnote` where ".$where." ")->row()->ttl_amt;
        $data['taxable_value'] = $this->db->query("SELECT sum(total_tax) as tax_val from `tblcreditnote` where ".$where." ")->row()->tax_val;
        $data['client_branch_data'] = $this->db->query("SELECT * FROM tblclientbranch WHERE `active`=1 AND `client_branch_name` !='' ORDER BY `client_branch_name` ASC ")->result();

    	$data['title'] = 'Credit Note List';
        $this->load->view('admin/creditnotes/view', $data);
    }




    public function add($id = '') {
        check_permission(27,'create');
        if ($this->input->post()) {
            $proposal_data = $this->input->post();

            /*echo '<pre/>';
            print_r($proposal_data);
            die;*/
            if ($id == '') {

                $id = $this->Creditnote_model->add($proposal_data);

                if ($id) {
                	update_creditnote_final_amount($id);
                    set_alert('success', _l('added_successfully', 'Credit Note'));
                    redirect(admin_url('creditnotes'));
                }
            } else {
                check_permission(27,'edit');
                $success = $this->Creditnote_model->update($proposal_data, $id);

                // exit;
                if ($success) {
                	update_creditnote_final_amount($id);
                    set_alert('success', _l('updated_successfully', 'Credit Note'));
                    redirect(admin_url('creditnotes'));
                }
            }
        }

        if ($id == '') {
            $title = 'Add Credit Note';
        } else {
        	 $title = 'Edit Credit Note';
            $data['debit_info'] = $this->db->query("SELECT * from tblcreditnote where id = '".$id."' ")->row();
            $data['product_info'] = $this->db->query("SELECT * from tblcreditnoteproduct where creditnote_id = '".$id."' ")->result_array();
            $data['debitnote_othercharges'] = $this->db->query("SELECT * from tblcreditnoteothercharges where proposalid = '".$id."' ")->result_array();
            $data['invoice_info'] = $this->db->query("SELECT `number`,`id` from tblinvoices where clientid = '".$data['debit_info']->clientid."' ")->result();
            $data['contactdata']=$this->db->query("SELECT *,c.id as contactid FROM `tblinvoiceclientperson` icp LEFT JOIN `tblcontacts` c ON icp.`contact_id`=c.`id` WHERE `invoice_id`='".$id."' AND `type`='creditnote'")->result_array();
        }

        $this->load->model('Other_charges_model');
        $data['othercharges'] = $this->Other_charges_model->get();
        $data['product_data'] = $this->db->query("SELECT * FROM `tblproducts` where status = 1 and is_approved = 1 ORDER BY name ASC")->result_array();

        $data['title']     = $title;
        $this->load->model('Contact_type_model');
        $data['contact_type_data'] = $this->Contact_type_model->get();
        $this->load->model('Designation_model');
        $data['designation_data'] = $this->Designation_model->get();

        $data['client_branch_data'] = $this->db->query("SELECT * FROM tblclientbranch WHERE `active`=1 AND `client_branch_name` !='' ORDER BY `client_branch_name` ASC ")->result();

        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='12'")->result_array();
        $i=0;
        foreach($Staffgroup as $singlestaff)
        {
            $i++;
            $stafff[$i]['id']=$singlestaff['id'];
            $stafff[$i]['name']=$singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='". get_staff_user_id()."' ORDER BY s.firstname ASC")->result_array();
            $stafff[$i]['staffs']=$query;
        }
        $data['allStaffdata'] = $stafff;

        $this->load->view('admin/creditnotes/add', $data);
    }




    public function download_pdf($id)
    {
        require_once APPPATH.'third_party/pdfcrowd.php';

        if (!$id) {
            redirect(admin_url('debit_note'));
        }

        $debit_info = $this->db->query("SELECT * FROM `tblcreditnote` where id =  '".$id."' ")->row();
        $file_name = 'Credit Note - '.$id;

         /*echo $html = purchase_order_pdf($purchase);
         die;*/

        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            $html = nturm_creditnote_pdf($debit_info);
        }else{
            $html = creditnote_pdf($debit_info);
        }

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        if ($debit_info->status == 5){
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
        check_permission(27,'delete');

        $delete = $this->home_model->delete('tblcreditnote',array('id'=>$id));

        if($delete == true){
            $this->home_model->delete('tblcreditnoteproduct',array('creditnote_id'=>$id));
            $this->home_model->delete('tblcreditnoteothercharges',array('proposalid'=>$id));
            set_alert('success', 'Credit note deleted successfully');
            redirect(admin_url('creditnotes'));
        }

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


    public function getclientinvoice()
    {
        if ($this->input->post()) {
            extract($this->input->post());
            $invoice_info = $this->db->query("SELECT `number`,`id` from tblinvoices where clientid = '".$client_id."' ")->result();
            $html = '<option value="">--Select One-</option>';
            if(!empty($invoice_info)){
                foreach ($invoice_info as $value) {
                    $html .= '<option value="'.$value->id.'">'.$value->number.'</option>';
                }
            }

            echo $html;
        }
    }

    public function get_invoice_by_challan()
    {
        if ($this->input->post()) {
            extract($this->input->post());
            $invoice_info = $this->db->query("SELECT `id` from tblinvoices where challan_id = '".$challan_id."' ")->row();
            if(!empty($invoice_info)){
                echo $invoice_info->id;
            }

        }
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

               $where .= " and date  BETWEEN  '".$from_date."' and  '".$to_date."' ";
           }
        }
        
        $creditnote_list = $this->db->query("SELECT * from tblcreditnote where  ".$where." order by id desc ")->result();
        
        // create file name
        $fileName = 'Creditnote.xlsx';
        // load excel library
        $this->load->library('excel');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);


        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Report : Credit Note');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J3');
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date : '.date('d/m/Y').'');


        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Company GST Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Client Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Client GST Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Credit Note Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Credit Note Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Total Credit Note Value');
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Total Taxable Value');
        $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'CGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('J4', 'SGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('K4', 'IGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('M4', 'HSN/SAC');
        $objPHPExcel->getActiveSheet()->SetCellValue('N4', 'Qty');
        $objPHPExcel->getActiveSheet()->SetCellValue('O4', 'UOM');
        // set Row
        $rowCount = 5;
        $i = 1;
        foreach ($creditnote_list as $val)
        {
            $client_info = $this->db->query("SELECT `client_branch_name`,`vat` from `tblclientbranch` where userid = '".$val->clientid."'  ")->row();
            $tax_type = get_client_gst_type($val->clientid);

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

            $hsnsac_code = $hsnqty = $hsnunit = '--';
            if ($val->invoice_id > 0){
                $invoiceinfo = $this->db->query("SELECT `service_type`,`product_type` FROM tblinvoices WHERE id = ".$val->invoice_id." ")->row();   
                
                if ($invoiceinfo->service_type == 1 && $invoiceinfo->product_type > 0){
                    $hsnsac_code = ($val->product_type == '2') ? '997313' : '995457';
                }else if ($invoiceinfo->service_type == 2){
                    $productlist = $this->db->query("SELECT `hsn_code`,`pro_id`,`temp_product`,`qty` FROM tblitems_in WHERE rel_id = ".$val->invoice_id." and rel_type = 'invoice' ")->result();   
                    
                    $hsn_arr = array();
                    $qty_arr = array();
                    $unit_arr = array();
                    if (!empty($productlist)){
                        foreach ($productlist as $proval) {
                            $isOtherCharge = 0;
                            if($proval->temp_product == 0){
                                $isOtherCharge = value_by_id('tblproducts',$proval->pro_id,'isOtherCharge');
                            }
                            
                            if ($isOtherCharge == 0){
                                if (!empty($proval->hsn_code)){
                                    $hsn_arr[] = $proval->hsn_code;
                                }
                                $qty_arr[] = '-'.$proval->qty;
                                if($proval->temp_product == 0){
                                    $unit_id = value_by_id_empty('tblproducts',$proval->pro_id,'unit_2');
                                }else{
                                    $unit_id = value_by_id_empty('tbltemperoryproduct',$proval->pro_id,'unit');
                                }
                                if ($unit_id > 0){
                                    $unit_arr[] = value_by_id('tblunitmaster',$unit_id,'name');
                                }
                            }
                        }
                    }
                    if (count(array_flip($hsn_arr)) === 1 && count(array_flip($unit_arr)) === 1){
                        $hsnsac_code = implode(',', array_unique($hsn_arr));
                        $hsnqty = array_sum($qty_arr);
                        $hsnunit = implode(',',array_unique($unit_arr));
                    }else{
                        $hsnsac_code = implode(', ', $hsn_arr);
                        $hsnqty = implode(', ', $qty_arr);
                        $hsnunit = implode(', ', $unit_arr);
                    }
                }
            }
            

            $billing_info = get_branch_details($val->branch_id);

            $total_tax_value = ($val->totalamount-$val->total_tax);

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $billing_info['gst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $client_info->client_branch_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $client_info->vat);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $val->number);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, _d($val->date));
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $val->totalamount);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $total_tax_value);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $cgst);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $sgst);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $igst);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $hsnsac_code);
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $hsnqty);
			$objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $hsnunit);

            $i++;
            $rowCount++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(site_url().$fileName);



    }

    /* this function use for send mail of lead */
    public function send_to_mail(){
        $this->load->model('emails_model');

        if ($_POST){
            extract($this->input->post());
            $cnote_data = $this->db->query("SELECT * FROM tblcreditnote WHERE id = ".$credit_note_id."")->row();

            if (!empty($cnote_data)){
                $response = $this->emails_model->send_mail($credit_note_id, "credit_note", $module_template_id, $cnote_data, $sent_to, $message, $cc);
                if ($response == TRUE){
                    set_alert('success', "Credit Note send on mail successfully");
                    redirect(admin_url("creditnotes"));
                }
                else{
                    set_alert('danger', "Something went wrong.");
                    redirect(admin_url("creditnotes"));
                }
            }
            else{
                set_alert('danger', "credit note not found");
                redirect(admin_url("creditnotes"));
            }
        }
        else{
            redirect(admin_url("creditnotes"));
        }
    }












    //Purchase Credit Note

    public function purchase_creditnote() {

        check_permission(346,'view');

        if(!empty($_POST)){
            extract($this->input->post());

            $where = " id > '0' ";
            if(!empty($vendor_id)){
                $data['s_vendor_id'] = $vendor_id;

                $where .= " and vendor_id = '".$vendor_id."'";
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
            $where = " id > '0' and year_id = '".financial_year()."' ";
        }


        $data['debitnote_list'] = $this->db->query("SELECT * from tblpurchasecreditnote where  ".$where." order by id desc ")->result();
        $data['dn_amount'] = $this->db->query("SELECT sum(totalamount) as ttl_amt from `tblpurchasecreditnote` where ".$where." ")->row()->ttl_amt;
        $data['taxable_value'] = $this->db->query("SELECT sum(total_tax) as tax_val from `tblpurchasecreditnote` where ".$where." ")->row()->tax_val;


        $data['vendors_info'] = $this->db->query("SELECT * from tblvendor where status = 1 ORDER BY name ASC")->result_array();


        $data['title'] = 'Purchase Credit Note List';
        $this->load->view('admin/creditnotes/purchase_creditnote', $data);
    }

    public function addPurchaseCreditNote($id = '') {
        check_permission(346,'create');
        if ($this->input->post()) {
            $proposal_data = $this->input->post();

            /*echo '<pre/>';
            print_r($proposal_data);
            die;*/
            if ($id == '') {
                
                $id = $this->Creditnote_model->addPurchaseCreditNote($proposal_data);

                if ($id) {
                    update_purchase_creditnote_final_amount($id);
                    set_alert('success', _l('added_successfully', 'Credit Note'));
                    redirect(admin_url('creditnotes/purchase_creditnote'));
                }
            } else {
                check_permission(346,'edit');
                $success = $this->Creditnote_model->updatePurchaseCreditNote($proposal_data, $id);

                // exit;
                if ($success) {
                    update_purchase_creditnote_final_amount($id);
                    set_alert('success', _l('updated_successfully', 'Credit Note'));
                    redirect(admin_url('creditnotes/purchase_creditnote'));
                }
            }
        }

        if ($id == '') {
            $title = 'Add Purchase Credit Note';
        } else {
             $title = 'Edit Purchase Credit Note';
            $data['debit_info'] = $this->db->query("SELECT * from tblpurchasecreditnote where id = '".$id."' ")->row();
            $data['product_info'] = $this->db->query("SELECT * from tblpurchasecreditnoteproduct where creditnote_id = '".$id."' ")->result_array();
            $data['debitnote_othercharges'] = $this->db->query("SELECT * from tblpurchasecreditnoteothercharges where proposalid = '".$id."' and amount > 0 ")->result_array();
            $data['invoice_info'] = $this->db->query("SELECT `id` from tblpurchaseinvoice where vendor_id = '".$data['debit_info']->vendor_id."' ")->result();
        }

        $this->load->model('Other_charges_model');
        $data['othercharges'] = $this->Other_charges_model->get();

        $data['title']     = $title;
        $this->load->model('Contact_type_model');
        $data['contact_type_data'] = $this->Contact_type_model->get();
        $this->load->model('Designation_model');
        $data['designation_data'] = $this->Designation_model->get();

        $data['vendors_info'] = $this->db->query("SELECT * from tblvendor where status = 1 ORDER BY name ASC")->result_array();


        $this->load->view('admin/creditnotes/addPurchaseCreditNote', $data);
    }


    public function get_purchase_invoice_list() {

        extract($this->input->post());

        $invoice_info = $this->db->query("SELECT * FROM `tblpurchaseinvoice` WHERE `vendor_id`='".$vendor_id."' order by id desc")->result();
        $html = '';
        if(!empty($invoice_info)){
            $html .= '<option value=""></option>';
            foreach ($invoice_info as $key => $value) {

                $html .= '<option value="'.$value->id.'">Inv-'.str_pad($value->id, 4, '0', STR_PAD_LEFT).'</option>';
            }
        }
        echo $html;

    }

    public function deletePurchaseCreditNote($id) {
        check_permission(346,'delete');

        $delete = $this->home_model->delete('tblpurchasecreditnote',array('id'=>$id));

        if($delete == true){
            $this->home_model->delete('tblpurchasecreditnoteproduct',array('creditnote_id'=>$id));
            $this->home_model->delete('tblpurchasecreditnoteothercharges',array('proposalid'=>$id));
            set_alert('success', 'Credit note deleted successfully');
            redirect(admin_url('creditnotes/purchase_creditnote'));
        }

    }

    public function purchase_creditnote_pdf($id)
    {
        require_once APPPATH.'third_party/pdfcrowd.php';

        if (!$id) {
            redirect(admin_url('creditnotes/purchase_creditnote'));
        }

        $debit_info = $this->db->query("SELECT * FROM `tblpurchasecreditnote` where id =  '".$id."' ")->row();
        $file_name = 'Purchase Credit Note - '.$id;

         /*echo $html = purchase_order_pdf($purchase);
         die;*/

        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            $html = nturm_purchase_creditnote_pdf($debit_info);
        }else{
            $html = purchase_creditnote_pdf($debit_info);
        }
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

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

    public function approval($id){
        $data['title'] = "Credit Note Approval";

        if ($this->input->post()){
            $data = $this->input->post();

            $ad_data = array(
                'approvereason' => $data["remark"],
                'approve_status' => $data["submit"],
                'created_at' => date('Y-m-d H:i:s')
            );

            $this->home_model->update('tblcreditnoteapproval', $ad_data,array('creditnote_id'=>$id,'staff_id'=>get_staff_user_id()));

            $this->home_model->update('tblcreditnote', array("status"=> $data["submit"]),array('id'=>$id));

            update_masterapproval_single(get_staff_user_id(),36,$id,$data["submit"]);
            update_masterapproval_all(36,$id,$data["submit"]);

            if ($data["submit"] == 1){
                set_alert('success', "Credit Note approved successfully");
            }else{
                set_alert('danger', "Credit Note rejected successfully");
            }
            redirect(admin_url('creditnotes'));
        }

        $data["creditnote_info"] = $this->home_model->get_row("tblcreditnote", array("id" => $id), array("*"));
        $data['creditnote_product'] = $this->db->query("SELECT * from tblcreditnoteproduct where creditnote_id = '".$id."' ")->result_array();
        $data['contactdata']=$this->db->query("SELECT *,c.id as contactid FROM `tblinvoiceclientperson` icp LEFT JOIN `tblcontacts` c ON icp.`contact_id`=c.`id` WHERE `invoice_id`='".$id."' AND `type`='creditnote'")->result_array();
        $data['creditnote_othercharges'] = $this->db->query("SELECT * from tblcreditnoteothercharges where proposalid = '".$id."' ")->result_array();
        $data["info"] = $this->db->query("SELECT * FROM tblcreditnoteapproval WHERE `creditnote_id` = '".$id."' AND `staff_id` = '".get_staff_user_id()."'")->row();

        $this->load->view('admin/creditnotes/creditnotes_approval', $data);
    }

    public function get_approval_info() {

    	if(!empty($_POST)){
        extract($this->input->post());
        $assign_info = $this->db->query("SELECT * FROM tblcreditnoteapproval WHERE creditnote_id = '".$cid."'  ")->result();
        ?>
        <div class="row">
                    <div class="col-md-12">
                        <h4 class="no-mtop mrg3">Assign Detail List</h4>
                    </div>
                     <hr/>
                    <div class="col-md-12">
                    <div style="overflow-x:auto !important;">
                        <div class="form-group" >
                            <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                                <thead>
                                    <tr>
                                        <td>S.No</td>
                                        <td>Name</td>
                                        <td>Action</td>
                                        <td>Remark</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!empty($assign_info)){
                                        $i = 1;
                                        foreach ($assign_info as $key => $value) {

                                                if($value->approve_status == 0){
                                                        $status = 'Pending';
                                                        $color = 'Darkorange';
                                                }elseif($value->approve_status == 1){
                                                        $status = 'Approved';
                                                        $color = 'green';
                                                }elseif($value->approve_status == 2){
                                                        $status = 'Reject';
                                                        $color = 'red';
                                                }elseif($value->approve_status == 4){
                                                    $status = 'Reconciliation';
                                                    $color = 'brown';
                                                }elseif($value->approve_status == 5){
                                                    $status = 'On Hold';
                                                    $color = '#e8bb0b;';
                                                }
                                                ?>
                                                <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo get_employee_name($value->staff_id); ?></td>
                                                <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
                                                <td><?php echo ($value->approvereason != '') ?  $value->approvereason : '--';  ?></td>
                                            </tr>
                                                <?php
                                        }
                                }else{
                                        echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found!</h5></td></tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>

        <?php

       	}
    }

    /* this function use for mark as cancelled */
    public function mark_as_cancelled($id)
    {
        // check against debit note
        $chk_debitnote = $this->db->query("SELECT * FROM `tblcreditnote` WHERE `id` = '".$id."'")->row();
        if (!empty($chk_debitnote)){
            $success = $this->home_model->update('tblcreditnote', array('status' => 5), array('id' => $id));
            if ($success) {
                set_alert('success', 'Credit note cancelled successfully.');
            }else{
                set_alert('warning', "Something went wrong");
            }
        }
        else{
            set_alert('warning', "Record Not Found");
        }
        redirect(admin_url('creditnotes'));
    }

    /* this function use for update accounted status in credit note */
    public function update_accounted_status($creditnote_id){
        
        $status = value_by_id_empty('tblcreditnote', $creditnote_id, "accounted_status");
        $updata["accounted_status"] = 0;
        if ($status == 0){
            $updata["accounted_status"] = 1;
            $updata["accounted_by"] = get_staff_user_id();
            $updata["accounted_date"] = date("Y-m-d H:i:s");
        }
        
        $response = $this->home_model->update('tblcreditnote', $updata,array('id'=>$creditnote_id));
        if ($response){
            // redirect(admin_url('creditnotes'));
            $accounted_text = '<span class="btn-sm btn-warning">Pending</span>';
            if ($updata["accounted_status"] == 1){
                $accounted_text = '<span class="btn-sm btn-success">Accounted</span>';
            }
            echo $accounted_text;
            exit;
        }
        
    }
}
