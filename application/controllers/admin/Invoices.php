<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Invoices extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('invoices_model');
        $this->load->model('credit_notes_model');
        $this->load->model('home_model');
    }


    public function no_products($id = '')
    {
        $p_id = array();
        $invoice_info = $this->db->query("SELECT id from `tblinvoices`  ")->result();
        if(!empty($invoice_info)){
            foreach ($invoice_info as $key => $value) {
               $product_info = $this->db->query("SELECT * from `tblitems_in` where rel_type = 'invoice' and rel_id = '".$value->id."' ")->result();
               if(empty($product_info)){
                    $p_id[] =  $value->id;
               }
            }

            echo implode(" , ",$p_id);
        }

    }

    public function update_inv_amt($id = '')
    {
        $p_id = array();
        $invoice_info = $this->db->query("SELECT id from `tblinvoices`  ")->result();
        if(!empty($invoice_info)){
            foreach ($invoice_info as $value) {
               update_invoice_final_amount($value->id);
            }
        }

    }

    public function update_inv_number($id = '')
    {
        $p_id = array();
        $invoice_info = $this->db->query("SELECT id,number from `tblinvoices`  ")->result();
        if(!empty($invoice_info)){
            foreach ($invoice_info as $key => $value) {
               $number_arr = explode("/",$value->number);
               $invoice_number = '0';
               if(!empty($number_arr[2])){
                $invoice_number = $number_arr[2];
               }
               $this->home_model->update('tblinvoices', array('invoice_number'=>$invoice_number),array('id'=>$value->id));
            }
        }

    }


    public function update_inv_status($id = '')
    {
        $p_id = array();
        $invoice_info = $this->db->query("SELECT id,total,status,duedate,paid_amt from `tblinvoices` where status != 5 ")->result();
        if(!empty($invoice_info)){
            foreach ($invoice_info as $key => $value) {

               $inv_amt = $value->total;
                $inv_duedate = $value->duedate;
                $status = $value->status;
                $f_paidamt = $value->paid_amt;

                if($f_paidamt > 0){
                    if($f_paidamt >= $inv_amt){
                        $status = 2;
                    }else{
                        $status = 3;

                    }
                }

                if($value->paid_amt == 0){
                    if(date('Y-m-d') > $inv_duedate){
                        $status = 4;
                    }else{
                        $status = 1;
                    }
                }
               $this->home_model->update('tblinvoices', array('status'=>$status),array('id'=>$value->id));
            }
        }

    }

    /* Get all invoices in case user go on index page */
    public function index($id = '')
    {
        check_permission('17,18','view');
        $this->list_invoices($id);
    }


    public function list()
    {
        check_permission('17,18','view');
        $designation_id = get_staff_info(get_staff_user_id())->designation_id;
        if(is_admin() == 1 || in_array($designation_id, [12,28,52])){
            $where = "i.status != 5 and i.service_type = 2 and cb.company_branch = '0'";
        }else{
            $where = "i.status != 5 and i.service_type = 2 and i.addedfrom = '".get_staff_user_id()."' and cb.company_branch = '0'";
        }

        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($client_id) || !empty($staff_id) || !empty($f_date) || !empty($t_date) || !empty($status)){
                //$where = "service_type = 2 ";
                $where_ttl = "i.status != 5 and i.service_type = 2 and cb.company_branch = '0'";

                if(!empty($client_id)){
                    $data['client_id'] = $client_id;
                    $where .= " and i.clientid = '".$client_id."'";
                    $where_ttl .= " and i.clientid = '".$client_id."'";
                }

                if(!empty($staff_id)){
                    $data['staff_id'] = $staff_id;
                    $where .= " and i.addedfrom = '".$staff_id."'";
                    $where_ttl .= " and i.addedfrom = '".$staff_id."'";
                }

                if(!empty($f_date) && !empty($t_date)){
                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;

                    $f_date = str_replace("/","-",$f_date);
                    $f_date = date("Y-m-d",strtotime($f_date));

                    $t_date = str_replace("/","-",$t_date);
                    $t_date = date("Y-m-d",strtotime($t_date));

                    $where .= " and i.invoice_date between '".$f_date."' and '".$t_date."' ";
                    $where_ttl .= " and i.invoice_date between '".$f_date."' and '".$t_date."' ";
                }

                if(!empty($status)){
                    $data['status'] = $status;
                    $where .= " and i.status = '".$status."'";
                    $where_ttl .= " and i.status = '".$status."'";
                }

            }
        }else{
            $where .= " and i.year_id = '".financial_year()."' and cb.company_branch = '0'";
            $where_ttl = "i.status != 5 and i.service_type = 2 and i.year_id = '".financial_year()."' and cb.company_branch = '0'";
        }



        // Get records
        $data['invoice_list'] = $this->db->query("SELECT i.* FROM `tblinvoices` as i LEFT JOIN `tblclientbranch` as cb ON i.clientid = cb.userid WHERE ".$where." ORDER BY id DESC ")->result();
        $data['invoice_amount'] = $this->db->query("SELECT sum(total) as ttl_amt from `tblinvoices` as i LEFT JOIN `tblclientbranch` as cb ON i.clientid = cb.userid WHERE ".$where_ttl." ")->row()->ttl_amt;
        $data['taxable_value'] = $this->db->query("SELECT sum(total_tax) as tax_val from `tblinvoices` as i LEFT JOIN `tblclientbranch` as cb ON i.clientid = cb.userid WHERE ".$where_ttl." ")->row()->tax_val;
        $data['client_data'] = $this->db->query("SELECT `client_branch_name`,`userid`,`email_id`,`phone_no_1` FROM `tblclientbranch` WHERE `active` = 1 AND `client_branch_name` !='' AND company_branch = '0' ORDER BY `client_branch_name` ASC")->result();
        $data['staff_list'] = get_staff_list();

        $data['title'] = 'Invoice List';
        $this->load->view('admin/invoices/list', $data);

    }

    public function rent_list()
    {
        check_permission('17,18','view');
        $designation_id = get_staff_info(get_staff_user_id())->designation_id;
        if(is_admin() == 1 || in_array($designation_id, [12,28,52])){
            $where = "i.status != 5 and i.service_type = 1 and cb.company_branch = '0'";
        }else{
            $where = "i.status != 5 and i.service_type = 1 and i.addedfrom = '".get_staff_user_id()."' and cb.company_branch = '0'";
        }

        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($client_id) || !empty($staff_id) || !empty($f_date) || !empty($t_date) || !empty($status)){

                $where_ttl = "i.status != 5 and i.service_type = 1 and cb.company_branch = '0'";

                    if(!empty($client_id)){
                        $data['client_id'] = $client_id;
                        $where .= " and i.clientid = '".$client_id."'";
                        $where_ttl .= " and i.clientid = '".$client_id."'";
                    }

                    if(!empty($staff_id)){
                        $data['staff_id'] = $staff_id;
                        $where .= " and i.addedfrom = '".$staff_id."'";
                        $where_ttl .= " and i.addedfrom = '".$staff_id."'";
                    }

                    if(!empty($f_date) && !empty($t_date)){
                        $data['f_date'] = $f_date;
                        $data['t_date'] = $t_date;

                        $f_date = str_replace("/","-",$f_date);
                        $f_date = date("Y-m-d",strtotime($f_date));

                        $t_date = str_replace("/","-",$t_date);
                        $t_date = date("Y-m-d",strtotime($t_date));

                        $where .= " and i.invoice_date between '".$f_date."' and '".$t_date."' ";
                        $where_ttl .= " and i.invoice_date between '".$f_date."' and '".$t_date."' ";
                    }

                    if(!empty($status)){
                        $data['status'] = $status;
                        $where .= " and i.status = '".$status."'";
                        $where_ttl .= " and i.status = '".$status."'";
                    }

            }
        }else{
            $where .= " and i.year_id = '".financial_year()."' and cb.company_branch = '0'";
            $where_ttl = "i.status != 5 and i.service_type = 1 and i.year_id = '".financial_year()."' and cb.company_branch = '0'";
        }


       $data['invoice_list'] = $this->db->query("SELECT i.* FROM `tblinvoices` as i LEFT JOIN `tblclientbranch` as cb ON i.clientid = cb.userid WHERE ".$where." ORDER BY id DESC ")->result();
       $data['invoice_amount'] = $this->db->query("SELECT sum(total) as ttl_amt from `tblinvoices` as i LEFT JOIN `tblclientbranch` as cb ON i.clientid = cb.userid WHERE ".$where_ttl." ")->row()->ttl_amt;

       $data['taxable_value'] = $this->db->query("SELECT sum(total_tax) as tax_val from `tblinvoices` as i LEFT JOIN `tblclientbranch` as cb ON i.clientid = cb.userid WHERE ".$where_ttl." ")->row()->tax_val;

        $data['client_data'] = $this->db->query("SELECT `client_branch_name`,`userid`,`email_id`,`phone_no_1` FROM `tblclientbranch` WHERE `active` = 1 AND `client_branch_name` !='' AND company_branch = '0' ORDER BY `client_branch_name` ASC")->result();
        $data['staff_list'] = get_staff_list();

        $data['title'] = 'Invoice List';
        $this->load->view('admin/invoices/rent_list', $data);

    }


/*    public function rent_list()
    {
        check_permission(118,'view');


        $where = "service_type = 1 and year_id = '".financial_year()."' ";

        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($reset)){
                $this->session->unset_userdata('rent_invoice_where');
                $this->session->unset_userdata('rent_invoice_search');
            }else{
                if(!empty($client_id) || !empty($staff_id) || !empty($f_date) || !empty($t_date) || !empty($status)){
                    $this->session->unset_userdata('rent_invoice_where');
                    $this->session->unset_userdata('rent_invoice_search');
                    $sreach_arr = array();
                    if(!empty($client_id)){
                        $sreach_arr['client_id'] = $client_id;
                        $where .= " and clientid = '".$client_id."'";
                    }

                    if(!empty($staff_id)){
                        $sreach_arr['staff_id'] = $staff_id;
                        $where .= " and addedfrom = '".$staff_id."'";
                    }

                    if(!empty($f_date) && !empty($t_date)){
                        $sreach_arr['f_date'] = $f_date;
                        $sreach_arr['t_date'] = $t_date;

                        $f_date = str_replace("/","-",$f_date);
                        $f_date = date("Y-m-d",strtotime($f_date));

                        $t_date = str_replace("/","-",$t_date);
                        $t_date = date("Y-m-d",strtotime($t_date));

                        $where .= " and invoice_date between '".$f_date."' and '".$t_date."' ";
                    }

                    if(!empty($status)){
                        $sreach_arr['status'] = $status;
                        $where .= " and status = '".$status."'";
                    }


                    $this->session->set_userdata('rent_invoice_where',$where);
                    $this->session->set_userdata('rent_invoice_search',$sreach_arr);

                }

            }
        }else{
            if(!empty($this->session->userdata('rent_invoice_where'))){
                $where = $this->session->userdata('rent_invoice_where');
            }
        }


        $this->load->library('pagination');

        $uriSegment = 4;
        $perPage = 25;



        // Get record count
        $totalRec = $this->invoices_model->get_invoice_count($where);

        // Pagination configuration
        $config['base_url']    = admin_url().'invoices/rent_list/';
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
        $data['invoice_list'] = $this->invoices_model->get_invoice($where,$offset,$perPage);



        $data['client_data'] = $this->db->query("SELECT `company`,`userid` from `tblclientbranch`  ")->result();
        $data['staff_list'] = get_staff_list();

        $data['title'] = 'Invoice List';
        $this->load->view('admin/invoices/rent_list', $data);

    }*/

    /* List all invoices datatables */
    public function list_invoices($id = '')
    {
        if (!has_permission('invoices', '', 'view') && !has_permission('invoices', '', 'view_own') && get_option('allow_staff_view_invoices_assigned') == '0') {
            access_denied('invoices');
        }

        close_setup_menu();

        $this->load->model('payment_modes_model');
        $data['payment_modes']        = $this->payment_modes_model->get('', [], true);
        $data['invoiceid']            = $id;
        $data['title']                = _l('invoices');
        $data['invoices_years']       = $this->invoices_model->get_invoices_years();
        $data['invoices_sale_agents'] = $this->invoices_model->get_sale_agents();
        $data['invoices_statuses']    = $this->invoices_model->get_statuses();
        $data['bodyclass']            = 'invoices-total-manual';
        $this->load->view('admin/invoices/manage', $data);
    }

    public function table($clientid = '')
    {
        if (!has_permission('invoices', '', 'view') && !has_permission('invoices', '', 'view_own') && get_option('allow_staff_view_invoices_assigned') == '0') {
            ajax_access_denied();
        }

        $this->load->model('payment_modes_model');
        $data['payment_modes'] = $this->payment_modes_model->get('', [], true);

        $this->app->get_table_data('invoices', [
            'clientid' => $clientid,
            'data'     => $data,
        ]);
    }

    public function client_change_data($customer_id, $current_invoice = '')
    {
        if ($this->input->is_ajax_request()) {
            $this->load->model('projects_model');
            $data                     = [];
            //$data['billing_shipping'] = $this->clients_model->get_customer_billing_and_shipping_details($customer_id);



            $this->db->where('userid', $customer_id);
            $clientdata= $this->db->get('tblclientbranch')->row();
            $clientdata= (array) $clientdata;
            $get_state_details=$this->db->query("SELECT * FROM `tblstates` WHERE `id`='".$clientdata['state']."'")->row_array();
            $get_city_details=$this->db->query("SELECT * FROM `tblcities` WHERE `id`='".$clientdata['city']."'")->row_array();

            $data['billing_shipping'][0] =  array('billing_street' => $clientdata['address'], 'billing_city' => $get_city_details['name'], 'billing_state' => $get_state_details['name'], 'billing_zip' => $clientdata['zip'], 'billing_country' => '0' );


            $data['client_currency']  = $this->clients_model->get_customer_default_currency($customer_id);

            $data['customer_has_projects'] = customer_has_projects($customer_id);
            $data['billable_tasks']        = $this->tasks_model->get_billable_tasks($customer_id);

            if ($current_invoice != '') {
                $this->db->select('status');
                $this->db->where('id', $current_invoice);
                $current_invoice_status = $this->db->get('tblinvoices')->row()->status;
            }

            $_data['invoices_to_merge'] = !isset($current_invoice_status) || (isset($current_invoice_status) && $current_invoice_status != 5) ? $this->invoices_model->check_for_merge_invoice($customer_id, $current_invoice) : [];

            $data['merge_info'] = $this->load->view('admin/invoices/merge_invoice', $_data, true);

            $this->load->model('currencies_model');

            $__data['expenses_to_bill'] = !isset($current_invoice_status) || (isset($current_invoice_status) && $current_invoice_status != 5) ? $this->invoices_model->get_expenses_to_bill($customer_id) : [];

            $data['expenses_bill_info'] = $this->load->view('admin/invoices/bill_expenses', $__data, true);
            echo json_encode($data);
        }
    }

    public function update_number_settings($id)
    {
        $response = [
            'success' => false,
            'message' => '',
        ];
        if (has_permission('invoices', '', 'edit')) {
            $affected_rows = 0;

            $this->db->where('id', $id);
            $this->db->update('tblinvoices', [
                'prefix' => $this->input->post('prefix'),
            ]);
            if ($this->db->affected_rows() > 0) {
                $affected_rows++;
            }

            if ($affected_rows > 0) {
                $response['success'] = true;
                $response['message'] = _l('updated_successfully', _l('invoice'));
            }
        }
        echo json_encode($response);
        die;
    }

    public function validate_invoice_number()
    {
        $isedit          = $this->input->post('isedit');
        $number          = $this->input->post('number');
        $date            = $this->input->post('date');
        $original_number = $this->input->post('original_number');
        $number          = trim($number);
        $number          = ltrim($number, '0');
        if ($isedit == 'true') {
            if ($number == $original_number) {
                echo json_encode(true);
                die;
            }
        }
        if (total_rows('tblinvoices', [
            'YEAR(date)' => date('Y', strtotime(to_sql_date($date))),
            'number' => $number,
        ]) > 0) {
            echo 'false';
        } else {
            echo 'true';
        }
    }

    public function add_note($rel_id)
    {
        if ($this->input->post() && user_can_view_invoice($rel_id)) {
            $this->misc_model->add_note($this->input->post(), 'invoice', $rel_id);
            echo $rel_id;
        }
    }

    public function get_notes($id)
    {
        if (user_can_view_invoice($id)) {
            $data['notes'] = $this->misc_model->get_notes($id, 'invoice');
            $this->load->view('admin/includes/sales_notes_template', $data);
        }
    }

    public function pause_overdue_reminders($id)
    {
        if (has_permission('invoices', '', 'edit')) {
            $this->db->where('id', $id);
            $this->db->update('tblinvoices', ['cancel_overdue_reminders' => 1]);
        }
        redirect(admin_url('invoices/list_invoices/' . $id));
    }

    public function resume_overdue_reminders($id)
    {
        if (has_permission('invoices', '', 'edit')) {
            $this->db->where('id', $id);
            $this->db->update('tblinvoices', ['cancel_overdue_reminders' => 0]);
        }
        redirect(admin_url('invoices/list_invoices/' . $id));
    }

    public function mark_as_cancelled($id)
    {
        /*if (!has_permission('invoices', '', 'edit') && !has_permission('invoices', '', 'create')) {
            access_denied('invoices');
        }*/

        // check against payment of invoices
        $chk_invoice = $this->db->query("SELECT * FROM `tblinvoicepaymentrecords` WHERE `invoiceid` = '".$id."' AND `paymentmethod` = 2")->row();
        if (empty($chk_invoice)){
            $success = $this->invoices_model->mark_as_cancelled($id);

            if ($success) {
                set_alert('success', _l('invoice_marked_as_cancelled_successfully'));
            }
        }
        else{
            set_alert('warning', "Invoice can't be cancel, Payment initiated against to this invoice");
        }

        redirect(admin_url('invoices/list'));
    }

    public function unmark_as_cancelled($id)
    {
        if (!has_permission('invoices', '', 'edit') && !has_permission('invoices', '', 'create')) {
            access_denied('invoices');
        }
        $success = $this->invoices_model->unmark_as_cancelled($id);
        if ($success) {
            set_alert('success', _l('invoice_unmarked_as_cancelled'));
        }
        redirect(admin_url('invoices/list_invoices/' . $id));
    }

    public function copy($id)
    {
        if (!$id) {
            redirect(admin_url('invoices'));
        }
        if (!has_permission('invoices', '', 'create')) {
            access_denied('invoices');
        }
        $new_id = $this->invoices_model->copy($id);
        if ($new_id) {
            set_alert('success', _l('invoice_copy_success'));
            redirect(admin_url('invoices/invoice/' . $new_id));
        } else {
            set_alert('success', _l('invoice_copy_fail'));
        }
        redirect(admin_url('invoices/invoice/' . $id));
    }

    public function get_merge_data($id)
    {
        $invoice = $this->invoices_model->get($id);
        $cf      = get_custom_fields('items');

        $i = 0;

        foreach ($invoice->items as $item) {
            $invoice->items[$i]['taxname']          = get_invoice_item_taxes($item['id']);
            $invoice->items[$i]['long_description'] = clear_textarea_breaks($item['long_description']);
            $this->db->where('item_id', $item['id']);
            $rel              = $this->db->get('tblitemsrelated')->result_array();
            $item_related_val = '';
            $rel_type         = '';
            foreach ($rel as $item_related) {
                $rel_type = $item_related['rel_type'];
                $item_related_val .= $item_related['rel_id'] . ',';
            }
            if ($item_related_val != '') {
                $item_related_val = substr($item_related_val, 0, -1);
            }
            $invoice->items[$i]['item_related_formatted_for_input'] = $item_related_val;
            $invoice->items[$i]['rel_type']                         = $rel_type;

            $invoice->items[$i]['custom_fields'] = [];

            foreach ($cf as $custom_field) {
                $custom_field['value']                 = get_custom_field_value($item['id'], $custom_field['id'], 'items');
                $invoice->items[$i]['custom_fields'][] = $custom_field;
            }
            $i++;
        }
        echo json_encode($invoice);
    }

    public function get_bill_expense_data($id)
    {
        $this->load->model('expenses_model');
        $expense = $this->expenses_model->get($id);

        $expense->qty              = 1;
        $expense->long_description = clear_textarea_breaks($expense->description);
        $expense->description      = $expense->name;
        $expense->rate             = $expense->amount;
        if ($expense->tax != 0) {
            $expense->taxname = [];
            array_push($expense->taxname, $expense->tax_name . '|' . $expense->taxrate);
        }
        if ($expense->tax2 != 0) {
            array_push($expense->taxname, $expense->tax_name2 . '|' . $expense->taxrate2);
        }
        echo json_encode($expense);
    }

    /* Add new invoice or update existing */
    public function invoice($id = '')
    {
        if ($this->input->post()) {
            $invoice_data = $this->input->post();
            if ($id == '') {
                if (!has_permission('invoices', '', 'create')) {
                    access_denied('invoices');
                }
                $id = $this->invoices_model->add($invoice_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('invoice')));
                    redirect(admin_url('invoices/list_invoices/' . $id));
                }
            } else {
                if (!has_permission('invoices', '', 'edit')) {
                    access_denied('invoices');
                }
                $success = $this->invoices_model->update($invoice_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('invoice')));
                }
                redirect(admin_url('invoices/list_invoices/' . $id));
            }
        }
        if ($id == '') {
            $title                  = _l('create_new_invoice');
            $data['billable_tasks'] = [];
        } else {
            $invoice = $this->invoices_model->get($id);

            if (!$invoice || !user_can_view_invoice($id)) {
                blank_page(_l('invoice_not_found'));
            }

            $data['invoices_to_merge'] = $this->invoices_model->check_for_merge_invoice($invoice->clientid, $invoice->id);
            $data['expenses_to_bill']  = $this->invoices_model->get_expenses_to_bill($invoice->clientid);

            $data['invoice']        = $invoice;
            $data['edit']           = true;
            $data['billable_tasks'] = $this->tasks_model->get_billable_tasks($invoice->clientid, !empty($invoice->project_id) ? $invoice->project_id : '');

            $title = _l('edit', _l('invoice_lowercase')) . ' - ' . format_invoice_number($invoice->id);
        }

        if ($this->input->get('customer_id')) {
            $data['customer_id'] = $this->input->get('customer_id');
        }

        $this->load->model('payment_modes_model');
        $data['payment_modes'] = $this->payment_modes_model->get('', [
            'expenses_only !=' => 1,
        ]);

        $this->load->model('taxes_model');
        $data['taxes'] = $this->taxes_model->get();
        $this->load->model('invoice_items_model');

        $data['ajaxItems'] = false;
        if (total_rows('tblitems') <= ajax_on_total_items()) {
            $data['items'] = $this->invoice_items_model->get_grouped();
        } else {
            $data['items']     = [];
            $data['ajaxItems'] = true;
        }
        $data['items_groups'] = $this->invoice_items_model->get_groups();

        $this->load->model('currencies_model');
        $data['currencies'] = $this->currencies_model->get();

        $data['base_currency'] = $this->currencies_model->get_base_currency();

        $data['staff']     = $this->staff_model->get('', ['active' => 1]);
        $data['title']     = $title;
        $data['bodyclass'] = 'invoice';
        $this->load->view('admin/invoices/invoice', $data);
    }


    public function invoices($id = '')
    {

        check_permission('17,18','create');
        if ($this->input->post()) {
            $invoice_data = $this->input->post();
            $termsdata = $invoice_data["terms"];
            unset($invoice_data["terms"]);

            if(($invoice_data['rentproposal']['totalamount'] == 0) && ($invoice_data['saleproposal']['totalamount'] == 0)){
                set_alert('danger', 'Bill amount cannot be empty!');
                redirect($_SERVER['HTTP_REFERER']);
            }

            /*echo '<pre/>';
                print_r($invoice_data);
                die;*/

            if ($id == '') {
                $this->load->model('proposals_model');
                $id = $this->invoices_model->add_invoice($invoice_data);

                update_invoice_final_amount($id);
                 $s_type = value_by_id('tblinvoices',$id,'service_type');
                if ($id) {

                    //Move client if he is in other collection
                    $client_id = value_by_id('tblinvoices',$id,'clientid');
                    $this->home_model->update('tblclientbranch',array('other_collection'=>'0'),array('client_id'=>$client_id));

                    /* this function use for add custom terms and condition */
                    $this->proposals_model->addCustomTermsAndCondition($id, 'invoice', $termsdata, "tblinvoices");

                    set_alert('success', _l('added_successfully', _l('invoice')));
                    if($s_type == 1){
                       redirect(admin_url('invoices/rent_list/'));
                    }else{
                       redirect(admin_url('invoices/list/'));
                    }

                }
            } else {
              $this->load->model('proposals_model');
                check_permission('17,18','edit');
                $success = $this->invoices_model->update_invoice($invoice_data, $id);

                /* this function use for add custom terms and condition */
                $this->proposals_model->addCustomTermsAndCondition($id, 'invoice', $termsdata, "tblinvoices");

                update_invoice_final_amount($id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('invoice')));
                }
                $s_type = value_by_id('tblinvoices',$id,'service_type');
                if($s_type == 1){
                   redirect(admin_url('invoices/rent_list/'));
                }else{
                   redirect(admin_url('invoices/list/'));
                }
            }
        }
        if ($id == '') {
            $title                  = _l('create_new_invoice');
            $data['billable_tasks'] = [];
        } else {
            

            $invoice = $this->invoices_model->get($id);
            $this->db->where('rel_id', $id);
            $this->db->where('is_sale', '0');
            $this->db->where('rel_type', 'invoice');
            $rentalprolist = $this->db->get('tblitems_in')->result_array();
            $this->db->where('rel_id', $id);
            $this->db->where('is_sale', '1');
            $this->db->where('rel_type', 'invoice');
            $saleprolist = $this->db->get('tblitems_in')->result_array();
            $this->db->where('proposalid', $id);
            $this->db->where('is_sale', '0');
            $this->db->order_by("id", "asc");
            $otherchargesforrent = $this->db->get('tblinvoiceothercharges')->result_array();
            $this->db->where('proposalid', $id);
            $proposalfields = $this->db->get('tblinvoiceproductfields')->result_array();
            $proposalfieldname = array_column($proposalfields, 'field_id');
            $this->db->where('proposalid', $id);
            $this->db->where('is_sale', '1');
            $this->db->order_by("id", "asc");
            $otherchargesforsale = $this->db->get('tblinvoiceothercharges')->result_array();
            $data['sale_othercharges'] = $otherchargesforsale;
            $data['rent_othercharges'] = $otherchargesforrent;
            $data['rent_prolist'] = $rentalprolist;
            $data['sale_prolist'] = $saleprolist;
            $data['proposalfields'] = $proposalfieldname;
            /*if (!$invoice || !user_can_view_invoice($id)) {
                blank_page(_l('invoice_not_found'));
            }*/
            
            $data['invoice'] = $invoice;
            $data['is_proposal'] = true;
            $title = _l('edit', _l('invoice_lowercase'));
            $data['invoices_to_merge'] = $this->invoices_model->check_for_merge_invoice($invoice->clientid, $invoice->id);
            $data['expenses_to_bill']  = $this->invoices_model->get_expenses_to_bill($invoice->clientid);
            $data['invoice']        = $invoice;
            $data['edit']           = true;
            $data['billable_tasks'] = $this->tasks_model->get_billable_tasks($invoice->clientid, !empty($invoice->project_id) ? $invoice->project_id : '');
            $title = _l('edit', _l('invoice_lowercase')) . ' - ' . format_invoice_number($invoice->id);
            $data['contactdata']=$this->db->query("SELECT *,c.id as contactid FROM `tblinvoiceclientperson` icp LEFT JOIN `tblcontacts` c ON icp.`contact_id`=c.`id` WHERE `invoice_id`='".$id."' AND `type`='invoice'")->result_array();
            $data['challan_info'] = $this->db->query("SELECT `chalanno`,`id` from tblchalanmst where clientid = '".$invoice->clientid."' ")->result();
        }

        if ($this->input->get('customer_id')) {
            $data['customer_id'] = $this->input->get('customer_id');
        }

        $this->load->model('payment_modes_model');
        $data['payment_modes'] = $this->payment_modes_model->get('', [
            'expenses_only !=' => 1,
        ]);

        $this->load->model('taxes_model');
        $data['taxes'] = $this->taxes_model->get();
        $this->load->model('invoice_items_model');

        $data['ajaxItems'] = false;
        /*if (total_rows('tblitems') <= ajax_on_total_items()) {
            $data['items'] = $this->invoice_items_model->get_grouped();
        } else {
            $data['items']     = [];
            $data['ajaxItems'] = true;
        }
        $data['items_groups'] = $this->invoice_items_model->get_groups();*/

        $this->load->model('currencies_model');
        $data['currencies'] = $this->currencies_model->get();

        $data['base_currency'] = $this->currencies_model->get_base_currency();
        $this->load->model('Other_charges_model');
        $data['othercharges'] = $this->Other_charges_model->get();
        /*$data['product_data'] = $this->db->query("SELECT p.* FROM `tblproducts` p LEFT JOIN `tblcategorymultiselect` cm ON p.`product_cat_id`=cm.category_id LEFT JOIN `tblmultiselectmaster` ms ON cm.multiselect_id=ms.id WHERE ms.multiselect='proposal' OR ms.multiselect='invoice'")->result_array();*/
        $data['product_data'] = $this->db->query("SELECT * FROM `tblproducts` where status = 1 and is_approved = 1 ORDER BY name ASC")->result_array();

        $data['staff']     = $this->staff_model->get('', ['active' => 1]);
        $data['title']     = $title;
        $data['bodyclass'] = 'invoice';
        $this->load->model('Site_manager_model');
        $data['all_site'] = $this->Site_manager_model->get();
        $this->load->model('Contact_type_model');
        $data['contact_type_data'] = $this->Contact_type_model->get();
        $this->load->model('Designation_model');
        $data['designation_data'] = $this->Designation_model->get();
        $this->load->model('Site_manager_model');
        $data['state_data'] = $this->Site_manager_model->get_state();
         $data['city_data'] = array();
         if(isset($data['site_manager']['state_id']) && $data['site_manager']['state_id'] != "") {
            $data['city_data'] = $this->Site_manager_model->get_cities_by_state_id($data['site_manager']['state_id']);
        }

        $this->load->model('Enquiryfor_model');
        //$data['service_type'] = $this->Enquiryfor_model->get();
        $data['service_type'] = get_service_type();

        $data['client_branch_data'] = $this->db->query("SELECT `client_branch_name`,`userid`,`email_id`,`phone_no_1` FROM `tblclientbranch` WHERE `active` = 1 AND `client_branch_name` !='' ORDER BY `client_branch_name` ASC")->result();

        $data['productfield_info'] = $this->db->query("SELECT * FROM `tblproductcustomfields` where status = 1 order by field_for desc")->result();

        $data['bank_info'] = $this->db->query("SELECT * FROM tblbankmaster WHERE status = '1' AND id != 1 order by name ASC")->result();
        $data['product_types_list'] = $this->db->query("SELECT * FROM `tblproducttypemaster` WHERE `status`= 1 order by `name` ASC")->result();

        $this->load->view('admin/invoices/invoices', $data);
    }


    public function renew_invoice($id = '')
    {
        if ($this->input->post()) {
            $invoice_data = $this->input->post();
            $termsdata = $invoice_data["terms"];
            unset($invoice_data["terms"]);

            if(($invoice_data['rentproposal']['totalamount'] == 0) && ($invoice_data['saleproposal']['totalamount'] == 0)){
                set_alert('danger', 'Bill amount cannot be empty!');
                redirect($_SERVER['HTTP_REFERER']);
            }
            /*echo '<pre/>';
            print_r($invoice_data);
            die;*/

            //Change renewal status
            $this->home_model->update('tblinvoices', array('renewal'=>1, 'rental_status'=>0),array('id'=>$id));

            //Getting parent_id
            $main_id = $id;
            $parent_id = value_by_id('tblinvoices',$main_id,'parent_id');
            if($parent_id > 0){
               $main_id = $parent_id;
            }
            $financial_year_id = $invoice_data['financial_yearid'];
            unset($invoice_data['financial_yearid']);
            $id = $this->invoices_model->add_invoice($invoice_data);

            if ($id) {

                $client_id = value_by_id('tblinvoices',$id,'clientid');

                $this->home_model->update('tblclientbranch',array('other_collection'=>'0'),array('client_id'=>$client_id));

                update_invoice_final_amount($id);
                //Updating parent id
                $updateinvoice_data = array('parent_id'=>$main_id);
                if (!empty($financial_year_id)){
                    $updateinvoice_data['year_id'] = $financial_year_id;
                }
                $this->home_model->update('tblinvoices', $updateinvoice_data,array('id'=>$id));

                /* this function use for add custom terms and condition */
                $this->load->model('proposals_model');
                $this->proposals_model->addCustomTermsAndCondition($id, 'invoice', $termsdata, "tblinvoices");

                set_alert('success', _l('added_successfully', _l('invoice')));
                //redirect(admin_url('invoices/list_invoices/' . $id));
                redirect(admin_url('invoices/rent_list/'));
            }
        }
        $invoice = $this->invoices_model->get($id);
        $this->db->where('rel_id', $id);
        $this->db->where('is_sale', '0');
        $this->db->where('rel_type', 'invoice');
        $rentalprolist = $this->db->get('tblitems_in')->result_array();
        $this->db->where('rel_id', $id);
        $this->db->where('is_sale', '1');
        $this->db->where('rel_type', 'invoice');
        $saleprolist = $this->db->get('tblitems_in')->result_array();
        $this->db->where('proposalid', $id);
        $this->db->where('is_sale', '0');
        $otherchargesforrent = $this->db->get('tblinvoiceothercharges')->result_array();
        $this->db->where('proposalid', $id);
        $proposalfields = $this->db->get('tblinvoiceproductfields')->result_array();
        $proposalfieldname = array_column($proposalfields, 'fieldname');
        $this->db->where('proposalid', $id);
        $this->db->where('is_sale', '1');
        $otherchargesforsale = $this->db->get('tblinvoiceothercharges')->result_array();
        $data['sale_othercharges'] = $otherchargesforsale;
        $data['rent_othercharges'] = $otherchargesforrent;
        $data['rent_prolist'] = $rentalprolist;
        $data['sale_prolist'] = $saleprolist;
        $data['proposalfields'] = $proposalfieldname;
        if (!$invoice) {
            blank_page(_l('invoice_not_found'));
        }
        $data['invoice'] = $invoice;
        $data['is_proposal'] = true;
        $data['invoices_to_merge'] = $this->invoices_model->check_for_merge_invoice($invoice->clientid, $invoice->id);
        $data['expenses_to_bill']  = $this->invoices_model->get_expenses_to_bill($invoice->clientid);
        $data['invoice']        = $invoice;
        $data['edit']           = true;
        $data['billable_tasks'] = $this->tasks_model->get_billable_tasks($invoice->clientid, !empty($invoice->project_id) ? $invoice->project_id : '');
        $title = 'Renew Invlice - ' . format_invoice_number($invoice->id);
        $data['contactdata']=$this->db->query("SELECT *,c.id as contactid FROM `tblinvoiceclientperson` icp LEFT JOIN `tblcontacts` c ON icp.`contact_id`=c.`id` WHERE `invoice_id`='".$id."' AND `type`='invoice'")->result_array();

        if ($this->input->get('customer_id')) {
            $data['customer_id'] = $this->input->get('customer_id');
        }

        $this->load->model('payment_modes_model');
        $data['payment_modes'] = $this->payment_modes_model->get('', [
            'expenses_only !=' => 1,
        ]);

        $this->load->model('taxes_model');
        $data['taxes'] = $this->taxes_model->get();
        $this->load->model('invoice_items_model');

        $data['ajaxItems'] = false;
        /*if (total_rows('tblitems') <= ajax_on_total_items()) {
            $data['items'] = $this->invoice_items_model->get_grouped();
        } else {
            $data['items']     = [];
            $data['ajaxItems'] = true;
        }
        $data['items_groups'] = $this->invoice_items_model->get_groups();*/

        $this->load->model('currencies_model');
        $data['currencies'] = $this->currencies_model->get();

        $data['base_currency'] = $this->currencies_model->get_base_currency();
        $this->load->model('Other_charges_model');
        $data['othercharges'] = $this->Other_charges_model->get();
        $data['product_data'] = $this->db->query("SELECT * FROM `tblproducts` where status = 1 and is_approved = 1 ORDER BY name ASC")->result_array();

        $data['staff']     = $this->staff_model->get('', ['active' => 1]);
        $data['title']     = $title;
        $data['bodyclass'] = 'invoice';
        $this->load->model('Site_manager_model');
        $data['all_site'] = $this->Site_manager_model->get();
        $this->load->model('Contact_type_model');
        $data['contact_type_data'] = $this->Contact_type_model->get();
        $this->load->model('Designation_model');
        $data['designation_data'] = $this->Designation_model->get();
        $this->load->model('Site_manager_model');
        $data['state_data'] = $this->Site_manager_model->get_state();
         $data['city_data'] = array();
         if(isset($data['site_manager']['state_id']) && $data['site_manager']['state_id'] != "") {
            $data['city_data'] = $this->Site_manager_model->get_cities_by_state_id($data['site_manager']['state_id']);
        }

        $this->load->model('Enquiryfor_model');
        //$data['service_type'] = $this->Enquiryfor_model->get();
        $data['service_type'] = get_service_type();

        $data['client_branch_data'] = $this->db->query("SELECT `client_branch_name`,`userid`,`email_id`,`phone_no_1` FROM `tblclientbranch` WHERE `active` = 1 AND `client_branch_name` !='' ORDER BY `client_branch_name` ASC")->result();
         $data['productfield_info'] = $this->db->query("SELECT * FROM `tblproductcustomfields` where status = 1 order by field_for desc")->result();
        $data['bank_info'] = $this->db->query("SELECT * FROM tblbankmaster WHERE status = '1' AND id != 1  order by name ASC")->result();
        $data['product_types_list'] = $this->db->query("SELECT * FROM `tblproducttypemaster` WHERE `status`= 1 order by `name` ASC")->result();
        $this->load->view('admin/invoices/renew_invoice', $data);
    }

    /* Get all invoice data used when user click on invoiec number in a datatable left side*/
    public function get_invoice_data_ajax($id)
    {
        if (!has_permission('invoices', '', 'view') && !has_permission('invoices', '', 'view_own') && get_option('allow_staff_view_invoices_assigned') == '0') {
            echo _l('access_denied');
            die;
        }

        if (!$id) {
            die(_l('invoice_not_found'));
        }

        $invoice = $this->invoices_model->get($id);

        if (!$invoice) {
            echo _l('invoice_not_found');
            die;
        }

        $invoice->date    = _d($invoice->date);
        $invoice->duedate = _d($invoice->duedate);
        $template_name    = 'invoice-send-to-client';
        if ($invoice->sent == 1) {
            $template_name = 'invoice-already-send';
        }

        $template_name = do_action('after_invoice_sent_template_statement', $template_name);

        $contact = $this->clients_model->get_contact(get_primary_contact_user_id($invoice->clientid));
        $email   = '';
        if ($contact) {
            $email = $contact->email;
        }

        $data['template'] = get_email_template_for_sending($template_name, $email);

        $data['invoices_to_merge'] = $this->invoices_model->check_for_merge_invoice($invoice->clientid, $id);
        $data['template_name']     = $template_name;
        $this->db->where('slug', $template_name);
        $this->db->where('language', 'english');
        $template_result = $this->db->get('tblemailtemplates')->row();

        $data['template_system_name'] = $template_result->name;
        $data['template_id']          = $template_result->emailtemplateid;

        $data['template_disabled'] = false;
        if (total_rows('tblemailtemplates', ['slug' => $data['template_name'], 'active' => 0]) > 0) {
            $data['template_disabled'] = true;
        }
        // Check for recorded payments
        $this->load->model('payments_model');
        $data['members']                    = $this->staff_model->get('', ['active' => 1]);
        $data['payments']                   = $this->payments_model->get_invoice_payments($id);
        $data['activity']                   = $this->invoices_model->get_invoice_activity($id);
        $data['totalNotes']                 = total_rows('tblnotes', ['rel_id' => $id, 'rel_type' => 'invoice']);
        $data['invoice_recurring_invoices'] = $this->invoices_model->get_invoice_recurring_invoices($id);

        $data['applied_credits'] = $this->credit_notes_model->get_applied_invoice_credits($id);
        // This data is used only when credit can be applied to invoice
        if (credits_can_be_applied_to_invoice($invoice->status)) {
            $data['credits_available'] = $this->credit_notes_model->total_remaining_credits_by_customer($invoice->clientid);

            if ($data['credits_available'] > 0) {
                $data['open_credits'] = $this->credit_notes_model->get_open_credits($invoice->clientid);
            }

            $customer_currency = $this->clients_model->get_customer_default_currency($invoice->clientid);
            $this->load->model('currencies_model');

            if ($customer_currency != 0) {
                $data['customer_currency'] = $this->currencies_model->get($customer_currency);
            } else {
                $data['customer_currency'] = $this->currencies_model->get_base_currency();
            }
        }

        $data['invoice'] = $invoice;
        $this->load->view('admin/invoices/invoice_preview_template', $data);
    }

    public function apply_credits($invoice_id)
    {
        $total_credits_applied = 0;
        foreach ($this->input->post('amount') as $credit_id => $amount) {
            $success = $this->credit_notes_model->apply_credits($credit_id, [
            'invoice_id' => $invoice_id,
            'amount'     => $amount,
        ]);
            if ($success) {
                $total_credits_applied++;
            }
        }

        if ($total_credits_applied > 0) {
            update_invoice_status($invoice_id, true);
            set_alert('success', _l('invoice_credits_applied'));
        }
        redirect(admin_url('invoices/list_invoices/' . $invoice_id));
    }

    public function get_invoices_total()
    {
        if ($this->input->post()) {
            load_invoices_total_template();
        }
    }

    /* Record new inoice payment view */
    public function record_invoice_payment_ajax($id)
    {
        $this->load->model('payment_modes_model');
        $this->load->model('payments_model');
        $data['payment_modes'] = $this->payment_modes_model->get('', [
            'expenses_only !=' => 1,
        ]);
        $data['invoice']  = $invoice  = $this->invoices_model->get($id);
        $data['payments'] = $this->payments_model->get_invoice_payments($id);
        $this->load->view('admin/invoices/record_payment_template', $data);
    }

    /* This is where invoice payment record $_POST data is send */
    public function record_payment()
    {
        if (!has_permission('payments', '', 'create')) {
            access_denied('Record Payment');
        }
        if ($this->input->post()) {
            $this->load->model('payments_model');
            $id = $this->payments_model->process_payment($this->input->post(), '');
            if ($id) {
                set_alert('success', _l('invoice_payment_recorded'));
                redirect(admin_url('payments/payment/' . $id));
            } else {
                set_alert('danger', _l('invoice_payment_record_failed'));
            }
            redirect(admin_url('invoices/list_invoices/' . $this->input->post('invoiceid')));
        }
    }

    /* Send invoiece to email */
    public function send_to_email($id)
    {
        $canView = user_can_view_invoice($id);
        if (!$canView) {
            access_denied('Invoices');
        } else {
            if (!has_permission('invoices', '', 'view') && !has_permission('invoices', '', 'view_own') && $canView == false) {
                access_denied('Invoices');
            }
        }

        try {
            $success = $this->invoices_model->send_invoice_to_client($id, '', $this->input->post('attach_pdf'), $this->input->post('cc'));
        } catch (Exception $e) {
            $message = $e->getMessage();
            echo $message;
            if (strpos($message, 'Unable to get the size of the image') !== false) {
                show_pdf_unable_to_get_image_size_error();
            }
            die;
        }

        // In case client use another language
        load_admin_language();
        if ($success) {
            set_alert('success', _l('invoice_sent_to_client_success'));
        } else {
            set_alert('danger', _l('invoice_sent_to_client_fail'));
        }
        redirect(admin_url('invoices/list_invoices/' . $id));
    }

    /* Delete invoice payment*/
    public function delete_payment($id, $invoiceid)
    {
        if (!has_permission('payments', '', 'delete')) {
            access_denied('payments');
        }
        $this->load->model('payments_model');
        if (!$id) {
            redirect(admin_url('payments'));
        }
        $response = $this->payments_model->delete($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('payment')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('payment_lowercase')));
        }
        redirect(admin_url('invoices/list_invoices/' . $invoiceid));
    }

    /* Delete invoice */
    public function delete($id)
    {
        check_permission('17,18','delete');
        if (!$id) {
            redirect(admin_url('invoices/list_invoices'));
        }
        $success = $this->invoices_model->delete($id);

        if ($success) {
            set_alert('success', _l('deleted', _l('invoice')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('invoice_lowercase')));
        }
        if (strpos($_SERVER['HTTP_REFERER'], 'list_invoices') !== false) {
            redirect(admin_url('invoices/list_invoices'));
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function delete_attachment($id)
    {
        $file = $this->misc_model->get_file($id);
        if ($file->staffid == get_staff_user_id() || is_admin()) {
            echo $this->invoices_model->delete_attachment($id);
        } else {
            header('HTTP/1.0 400 Bad error');
            echo _l('access_denied');
            die;
        }
    }

    /* Will send overdue notice to client */
    public function send_overdue_notice($id)
    {
        $canView = user_can_view_invoice($id);
        if (!$canView) {
            access_denied('Invoices');
        } else {
            if (!has_permission('invoices', '', 'view') && !has_permission('invoices', '', 'view_own') && $canView == false) {
                access_denied('Invoices');
            }
        }

        $send = $this->invoices_model->send_invoice_overdue_notice($id);
        if ($send) {
            set_alert('success', _l('invoice_overdue_reminder_sent'));
        } else {
            set_alert('warning', _l('invoice_reminder_send_problem'));
        }
        redirect(admin_url('invoices/list_invoices/' . $id));
    }

    /* Generates invoice PDF and senting to email of $send_to_email = true is passed */
    public function pdf($id)
    {
        if (!$id) {
            redirect(admin_url('invoices/list_invoices'));
        }

        $canView = user_can_view_invoice($id);
        if (!$canView) {
            access_denied('Invoices');
        } else {
            if (!has_permission('invoices', '', 'view') && !has_permission('invoices', '', 'view_own') && $canView == false) {
                access_denied('Invoices');
            }
        }

        $invoice        = $this->invoices_model->get($id);
        $invoice        = do_action('before_admin_view_invoice_pdf', $invoice);
        $invoice_number = format_invoice_number($invoice->id);

        try {
            $pdf = invoice_pdf($invoice);
        } catch (Exception $e) {
            $message = $e->getMessage();
            echo $message;
            if (strpos($message, 'Unable to get the size of the image') !== false) {
                show_pdf_unable_to_get_image_size_error();
            }
            die;
        }

        $type = 'D';

        if ($this->input->get('output_type')) {
            $type = $this->input->get('output_type');
        }

        if ($this->input->get('print')) {
            $type = 'I';
        }

        $pdf->Output(mb_strtoupper(slug_it($invoice_number)) . '.pdf', $type);
    }

    public function mark_as_sent($id)
    {
        if (!$id) {
            redirect(admin_url('invoices/list_invoices'));
        }
        if (!user_can_view_invoice($id)) {
            access_denied('Invoice Mark As Sent');
        }
        $success = $this->invoices_model->set_invoice_sent($id, true);
        if ($success) {
            set_alert('success', _l('invoice_marked_as_sent'));
        } else {
            set_alert('warning', _l('invoice_marked_as_sent_failed'));
        }
        redirect(admin_url('invoices/list_invoices/' . $id));
    }

    public function get_due_date()
    {
        if ($this->input->post()) {
            $date    = $this->input->post('date');
            $duedate = '';
            if (get_option('invoice_due_after') != 0) {
                $date    = to_sql_date($date);
                $d       = date('Y-m-d', strtotime('+' . get_option('invoice_due_after') . ' DAY', strtotime($date)));
                $duedate = _d($d);
                echo $duedate;
            }
        }
    }


    public function download_pdf($id)
    {
        require_once APPPATH.'third_party/pdfcrowd.php';

        $invoice        = $this->invoices_model->get($id);
        $invoice_number = format_invoice_number($invoice->id);
        /*echo $html = infoice_pdf($invoice);
        die;*/




            $file_name = $invoice_number;

            if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
                $html = nturm_infoice_pdf($invoice);
            }else{
                $html = infoice_pdf($invoice);
            }


            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
           // $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();

        if ($invoice->status == 5){
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

             $dompdf->stream($file_name, array("Attachment" => false));


    }

    public function get_branch()
    {
        if ($this->input->post()) {
            extract($this->input->post());
            $branch_info = $this->db->query("SELECT * from tblclientbranch where client_id = '".$client_id."' order by client_branch_name asc ")->result();
            $html = '<option value="">--Select One-</option>';
            if(!empty($branch_info)){
                foreach ($branch_info as $key => $value) {
                    $html .= '<option value="'.$value->userid.'">'.cc($value->client_branch_name).'</option>';
                }
            }

            echo $html;
        }
    }

    public function get_sites()
    {
        if ($this->input->post()) {
            extract($this->input->post());

            $client_str = implode(",",$client_branch);

            if (is_array($service_type)){
                $servicetype_str = implode(",",$service_type);
                $site_info = $this->db->query("SELECT i.site_id, s.name FROM tblinvoices as  i LEFT JOIN tblsitemanager as s ON i.site_id = s.id where i.clientid IN (".$client_str.") and i.site_id > 0 and i.service_type IN (".$servicetype_str.")  GROUP By i.site_id ORDER by s.name ASC")->result();
            }else{
                $site_info = $this->db->query("SELECT i.site_id, s.name FROM tblinvoices as  i LEFT JOIN tblsitemanager as s ON i.site_id = s.id where i.clientid IN (".$client_str.") and i.site_id > 0 and i.service_type = '".$service_type."'  GROUP By i.site_id ORDER by s.name ASC")->result();
            }
            
            $html = '<option value="">--Select One-</option>';
            if(!empty($site_info)){
                foreach ($site_info as $key => $value) {
                    $html .= '<option value="'.$value->site_id.'">'.cc($value->name).'</option>';
                }
            }

            echo $html;
        }
    }

    public function ledger($client_id='',$page = '')
    {
        check_permission('58,82','view');

        $staff_id = $this->session->userdata('staff_user_id');

        if(!empty($client_id) && $page == 'under_over_limit'){

            $branch = $this->db->query("SELECT * from tblclientbranch where userid = '".$client_id."' order by client_branch_name asc")->row();

            $site = array();
            $client_branch = array();
            if(!empty($branch)){
                $data['client_id'] = $branch->client_id;
            }
            $client_branch[] = $client_id;
             $data['client_branch'] = $client_branch;

            $site_info = $this->db->query("SELECT i.site_id, s.name FROM tblinvoices as  i LEFT JOIN tblsitemanager as s ON i.site_id = s.id where i.clientid = '".$client_id."' and i.site_id > 0  GROUP By i.site_id ORDER by i.id DESC")->result();
            if(!empty($site_info)){
                foreach ($site_info as $r) {
                   $site[] = $r->site_id;
                }
            }
            $data['site_ids'] = $site;
            $data['flow'] = 'asc';
            $data['service_type'] = 1;
        }elseif(!empty($client_id)){
            $data['client_id'] = $client_id;
            $branch = $this->db->query("SELECT `userid` from tblclientbranch where client_id = '".$client_id."' order by client_branch_name asc ")->result();
            $client_branch = array();
            $site = array();
            if(!empty($branch)){
                foreach ($branch as $value) {
                   $client_branch[] = $value->userid;
                }
            }
            $data['client_branch'] = $client_branch;

            $client_str = implode(",",$client_branch);
            $site_info = $this->db->query("SELECT i.site_id, s.name FROM tblinvoices as  i LEFT JOIN tblsitemanager as s ON i.site_id = s.id where i.clientid IN (".$client_str.") and i.site_id > 0  GROUP By i.site_id ORDER by i.id DESC")->result();
            if(!empty($site_info)){
                foreach ($site_info as $r) {
                   $site[] = $r->site_id;
                }
            }
            $data['site_ids'] = $site;
            $data['flow'] = 'asc';
            $data['service_type'] = 1;

        }

        //$data['client_info'] = $this->db->query("SELECT i.clientid, c.* FROM tblinvoices as i LEFT JOIN tblclients as c ON i.clientid = c.userid GROUP By i.clientid ")->result();
        $data['client_info'] = $this->db->query("SELECT * FROM tblclients order by company asc")->result();

        if ($this->input->post()) {
            extract($this->input->post());


            $site_arr = array();
            if(empty($site_id)){
                $client_str = implode(",",$client_branch);
                $site_info = $this->db->query("SELECT i.site_id FROM tblinvoices as  i LEFT JOIN tblsitemanager as s ON i.site_id = s.id where i.clientid IN (".$client_str.") and i.site_id > 0  GROUP By i.site_id ORDER by i.id DESC")->result();
                if(!empty($site_info)){
                    foreach ($site_info as $s_id) {
                       $site_arr[] = $s_id->site_id;
                    }
                    $data['site_ids'] = $site_arr;
                }
            }else{
                $data['site_ids'] = $site_id;
            }

            $data['client_id'] = $client_id;

            $data['client_branch'] = $client_branch;
            $data['flow'] = $flow;
            $data['service_type'] = $service_type;
            $data['year_id'] = $year_id;

        }

        $data['title'] = 'Client Ledger';
        $data["financial_year_list"] = $this->db->query("SELECT * FROM `tblfinancialyear` WHERE `status` = 1 ORDER BY `name` DESC")->result();
        $this->load->view('admin/invoices/ledger', $data);
    }

    public function udpate_amount()
    {

        $invoice_info = $this->db->query("SELECT id  FROM `tblinvoices`  ")->result();

        if(!empty($invoice_info)){
            foreach ($invoice_info as $value) {
                $id = $value->id;
                update_invoice_final_amount($id);

            }
        }


    }


    public function ledger_pdf()
    {
        $data = $this->input->post();

        if ($data["mark"] == 1){
            require_once APPPATH.'third_party/pdfcrowd.php';

            $file_name = 'Ledger PDF -'.date('d_m_y');

            if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
                $html = nturm_ledger_pdf($data);
            }else{
                $html = ledger_pdf($data);
            }

            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            // $dompdf->setPaper('A4', 'portrait');
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            $dompdf->stream($file_name, array("Attachment" => false));

        }elseif ($data["mark"] == 2) {

            $this->ledger_export($data);
        }
    }


    public function renewal_invoice()
    {
        check_permission(20,'view');


        //$where = "service_type = 1 and renewal = 0 and rental_status  = 0 and duedate >= '".date('Y-m-d')."' and year_id = '".financial_year()."' ";
        /*if(financial_year() == 1){
            $where = "service_type = 1 and renewal = 0 and rental_status  = 0 and duedate >= '".date('Y-m-d')."' and year_id = '".financial_year()."' ";
        }elseif(financial_year() == 6){
            $where = "service_type = 1 and renewal = 0 and rental_status  = 0 and duedate >= '".date('Y-m-d')."' ";
        }else{
            $where = "service_type = 1 and renewal = 0 and rental_status  = 0 and year_id = '".financial_year()."' ";
        }*/
        if(financial_year() == 1){
            $where = "service_type = 1 and renewal = 0 and rental_status  = 0 and duedate >= '".date('Y-m-d')."' and year_id = '".financial_year()."' ";
        }else{
            $where = "service_type = 1 and renewal = 0 and rental_status  = 0 and year_id = '".financial_year()."' ";
        }
        $data['s_client_id'] = 0;
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($client_id)){
                $data['s_client_id'] = $client_id;
                $where .= " and clientid = '".$client_id."'";
            }

            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $f_date = date("Y-m-d",strtotime($f_date));

                $t_date = str_replace("/","-",$t_date);
                $t_date = date("Y-m-d",strtotime($t_date));

                $where .= " and duedate between '".$f_date."' and '".$t_date."' ";
            }
        }

        $data['invoice_list'] = $this->db->query("SELECT * from `tblinvoices` where ".$where." ORDER BY duedate asc ")->result();
        $data['invoice_amount'] = $this->db->query("SELECT sum(total) as ttl_amt from `tblinvoices` where ".$where." ")->row()->ttl_amt;


        $data['client_data'] = $this->db->query("SELECT `company`,`userid` from `tblclientbranch` WHERE company !='' ORDER BY company ASC ")->result();

        $data['title'] = 'Renewal Invoice List';
        $this->load->view('admin/invoices/renewal_invoice', $data);

    }

    public function update_rental_status($status,$invoice_id)
    {
        $this->home_model->update('tblinvoices', array('rental_status'=>$status),array('id'=>$invoice_id));

        set_alert('success', 'Invoice status updated successfully');
        if($status == 1){
            redirect(admin_url('invoices/pickup_invoice'));
        }elseif($status == 2){
            redirect(admin_url('invoices/hold_invoice'));
        }elseif($status == 3){
            redirect(admin_url('invoices/renewal_invoice'));
        }

    }

    public function pickup_invoice()
    {
        check_permission(21,'view');



        $data['s_client_id'] = 0;

        if(!empty($_POST)){
            extract($this->input->post());
            $where = "service_type = 1 and rental_status  = 1 ";
            if(!empty($client_id)){
                $data['s_client_id'] = $client_id;
                $where .= " and clientid = '".$client_id."'";
            }

            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $f_date = date("Y-m-d",strtotime($f_date));

                $t_date = str_replace("/","-",$t_date);
                $t_date = date("Y-m-d",strtotime($t_date));

                $where .= " and invoice_date between '".$f_date."' and '".$t_date."' ";
            }
        }else{
            $where = "service_type = 1 and rental_status  = 1 and year_id = '".financial_year()."'";
        }

        $data['invoice_list'] = $this->db->query("SELECT * from `tblinvoices` where ".$where." ORDER BY id asc ")->result();
        $data['invoice_amount'] = $this->db->query("SELECT sum(total) as ttl_amt from `tblinvoices` where ".$where." ")->row()->ttl_amt;


        $data['client_data'] = $this->db->query("SELECT `client_branch_name`,`userid` from `tblclientbranch` WHERE client_branch_name !='' ORDER BY client_branch_name ASC ")->result();

        $data['title'] = 'Pickup Invoice List';
        $this->load->view('admin/invoices/pickup_invoice', $data);
    }

    public function hold_invoice()
    {
        check_permission(22,'view');

        $data['s_client_id'] = 0;
        if(!empty($_POST)){
            extract($this->input->post());
            $where = "service_type = 1 and rental_status  = 2 ";
            if(!empty($client_id)){
                $data['s_client_id'] = $client_id;
                $where .= " and clientid = '".$client_id."'";
            }

            if(!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;

                $f_date = str_replace("/","-",$f_date);
                $f_date = date("Y-m-d",strtotime($f_date));

                $t_date = str_replace("/","-",$t_date);
                $t_date = date("Y-m-d",strtotime($t_date));

                $where .= " and invoice_date between '".$f_date."' and '".$t_date."' ";
            }
        }else{
            $where = "service_type = 1 and rental_status  = 2 and year_id = '".financial_year()."'";
        }

        $data['invoice_list'] = $this->db->query("SELECT * from `tblinvoices` where ".$where." ORDER BY id asc ")->result();
        $data['invoice_amount'] = $this->db->query("SELECT sum(total) as ttl_amt from `tblinvoices` where ".$where." ")->row()->ttl_amt;


        $data['client_data'] = $this->db->query("SELECT `company`,`userid` from `tblclientbranch` WHERE company !='' ORDER BY company ASC ")->result();

        $data['title'] = 'Hold Invoice List';

        $this->load->view('admin/invoices/hold_invoice', $data);
    }


    public function export()
    {
        /*if(!empty($this->session->userdata('invoice_where'))){
            $where = $this->session->userdata('invoice_where');
        }
        if(!empty($this->session->userdata('rent_invoice_where'))){
            $where = $this->session->userdata('rent_invoice_where');
        }

        if(!empty($where)){
            $where .= " and service_type = '".$type."' and status != 5 and year_id = '".financial_year()."' ";
        }else{
            $where = "service_type = '".$type."' and status != 5 and year_id = '".financial_year()."' ";
        }*/


        $where = "i.status != 5 and cb.company_branch = '0'";

        if(!empty($_GET)){
            extract($this->input->get());

            if(!empty($service_type)){
               $where .= " and i.service_type = '".$service_type."'";
            }
            if(!empty($client_id)){
                $where .= " and i.clientid = '".$client_id."'";
            }

            if(!empty($staff_id)){
                $where .= " and i.addedfrom = '".$staff_id."'";
            }

            if(!empty($f_date) && !empty($t_date)){
                $where .= " and i.invoice_date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }else{
                $where .= " and i.year_id = '".financial_year()."' ";
            }

            if(!empty($status)){
                $where .= " and i.status = '".$status."'";
            }

        }

        if($service_type == 1){
            $service_type = 'Rent';
        }else{
            $service_type = 'Sales';
        }

        // create file name
        $fileName = $service_type.'-invoice.xlsx';
        // load excel library
        $this->load->library('excel');

//        $invoice_list = $this->db->query("SELECT * from `tblinvoices` where ".$where." ORDER BY id desc ")->result();
            $invoice_list = $this->db->query("SELECT * FROM `tblinvoices` as i LEFT JOIN `tblclientbranch` as cb ON i.clientid = cb.userid WHERE ".$where." ORDER BY id DESC ")->result();

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);


        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Service Type : '.$service_type.'');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J3');
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date : '.date('d/m/Y').'');


        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Sales Person');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Product Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Company GST Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Client Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Client GST Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Invoice Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Invoice Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'Total Invoice Value');
        $objPHPExcel->getActiveSheet()->SetCellValue('J4', 'Total Taxable Value');
        $objPHPExcel->getActiveSheet()->SetCellValue('K4', 'CGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('L4', 'SGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('M4', 'IGST');
        if($service_type == 'Rent'){
            $objPHPExcel->getActiveSheet()->SetCellValue('N4', 'SAC');
        }else{
            $objPHPExcel->getActiveSheet()->SetCellValue('O4', 'HSN');
            $objPHPExcel->getActiveSheet()->SetCellValue('P4', 'Qty');
            $objPHPExcel->getActiveSheet()->SetCellValue('Q4', 'UOM');
        }
        
        // set Row
        $rowCount = 5;
        $i = 1;
        foreach ($invoice_list as $val)
        {
            $client_info = $this->db->query("SELECT `client_branch_name`,`vat` from `tblclientbranch` where userid = '".$val->clientid."'  ")->row();
            $sales_person = $this->db->query("SELECT `staff_id` FROM tblleadassignstaff WHERE type = 2 and lead_id = '".$val->lead_id."' ")->row();
            $cgst = '--';
            $sgst = '--';
            $igst = '--';
            if($val->tax_type == 1){
                $tax = ($val->total_tax/2);
                $sgst = number_format(round($tax), 2, '.', '');
                $cgst = number_format(round($tax), 2, '.', '');
            }else{
                $igst = $val->total_tax;
            }

            $billing_info = get_branch_details($val->billing_branch_id);
            $hsnsac_code = $hsnqty = $hsnunit = '--';
            if ($val->service_type == 1 && $val->product_type > 0){
                $hsnsac_code = ($val->product_type == '2') ? '997313' : '995457';
            }else if ($val->service_type == 2){
                $productlist = $this->db->query("SELECT `hsn_code`,`pro_id`,`temp_product`,`qty` FROM tblitems_in WHERE rel_id = ".$val->id." and rel_type = 'invoice' ")->result();   
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
                            $qty_arr[] = $proval->qty;
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

            $taxable_value = ($val->total-$val->total_tax);
            $sales_person_name = (!empty($sales_person) && $sales_person->staff_id > 0) ? get_employee_name($sales_person->staff_id) : '--';
            $product_type_name = ($val->product_type > 0) ? value_by_id_empty('tblproducttypemaster',$val->product_type,'name') : '--';
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $sales_person_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $product_type_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $billing_info['gst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $client_info->client_branch_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $client_info->vat);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, format_invoice_number($val->id));
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, _d($val->invoice_date));
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $val->total);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $taxable_value);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $cgst);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $sgst);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $igst);
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $hsnsac_code);
            if ($val->service_type == 2){
                $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $hsnqty);
                $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $hsnunit);
            }

            $i++;
            $rowCount++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(site_url().$fileName);



    }


    public function get_invoice_number()
    {
        extract($this->input->post());
        echo get_invoice_number($service_type);

    }


    public function parent_invoice()
    {

        $data['s_client_id'] = 0;
        $where = "status != 5 ";
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($client_id)){
                $data['s_client_id'] = $client_id;
                $where .= " and clientid = '".$client_id."'";
            }

        }

        $data['invoice_list'] = $this->db->query("SELECT * from `tblinvoices` where ".$where." ORDER BY id desc ")->result();


        $data['client_data'] = $this->db->query("SELECT `company`,`userid` from `tblclientbranch`  ")->result();

        $data['title'] = 'Update Parent Invoice';
        $this->load->view('admin/invoices/parent_invoice', $data);

    }


    public function get_parent_modal()
    {
        if(!empty($_POST)){
            extract($this->input->post());

            $invoice_info  = $this->db->query("SELECT * from tblinvoices where id = '".$id."' ")->row();
            $invice_list  = $this->db->query("SELECT `id`,`number` from tblinvoices where parent_id = '0' and status != 5 ")->result();
            ?>
            <form action="<?php echo admin_url('invoices/parent_update');?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="row">

             <div class="col-md-12">


            <hr>
            <br>
            <div class="col-md-12">
            <h4 class="text-center"><u>Invoice No. (<?php echo $invoice_info->number;  ?>)</u></h4>

              </div>
              <div class="col-md-12">
                    <div class="form-group ">
                        <label for="branch_id" class="control-label">Select Parent</label>
                        <select class="form-control selectpicker" id="parent_id" name="parent_id" data-live-search="true">
                            <option value="0" selected >--Select One-</option>
                            <?php
                            if(!empty($invice_list)){
                                foreach ($invice_list as $row) {
                                    ?>
                                    <option value="<?php echo $row->id; ?>" <?php if($invoice_info->parent_id == $row->id){ echo 'selected'; } ?>><?php echo $row->number; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
              <div class="col-md-12">
               <div class="form-group text-right">
                    <button class="btn btn-info" type="submit">Update</button>
                </div>
                </div>
                </div>

                </div>
                 <input type="hidden" value="<?php echo $id; ?>" name="id">

            </form>
            <?php
        }
    }


    public function parent_update()
    {
        if(!empty($_POST)){
            extract($this->input->post());

           $this->home_model->update('tblinvoices', array('parent_id'=>$parent_id),array('id'=>$id));
           redirect(admin_url('invoices/parent_invoice'));
        }

    }

    public function getclientchallans()
    {
        if ($this->input->post()) {
            extract($this->input->post());
            $challan_info = $this->db->query("SELECT `chalanno`,`id` from tblchalanmst where clientid = '".$client_id."' ")->result();
            $html = '<option value="">--Select One-</option>';
            if(!empty($challan_info)){
                foreach ($challan_info as $key => $value) {
                    $html .= '<option value="'.$value->id.'">'.$value->chalanno.'</option>';
                }
            }

            echo $html;
        }
    }


    public function running_invoice()
    {

        check_permission(179,'view');
        $data['s_client_id'] = 0;
        $where = "service_type = 1 ";
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($client_id)){
                $data['s_client_id'] = $client_id;
                $where .= " and clientid = '".$client_id."'";
            }

        }

        $data['invoice_list'] = $this->db->query("SELECT * from `tblinvoices` where ".$where." ORDER BY id desc ")->result();

        $running_data[] = array(
                'id' => 0,
                'name' => 'Closed'
             );
        $running_data[] = array(
                'id' => 1,
                'name' => 'Running'
             );

        /*echo '<pre/>';
        print_r($running_data);
        die;*/
        $data['running_data'] = $running_data;



        $data['client_data'] = $this->db->query("SELECT `company`,`userid` from `tblclientbranch`  ")->result();

        $data['title'] = 'Update Running Invoice';
        $this->load->view('admin/invoices/running_invoice', $data);

    }

    public function update_running_status()
    {
        if ($this->input->post() && $this->input->is_ajax_request()) {
            extract($this->input->post());
            $update_data = array(
                'running_status' => $status
            );

            $this->home_model->update('tblinvoices',$update_data,array('id'=>$invoice_id));
        }
    }


    public function invoice_products($s_id,$branch_str,$service_type,$flow)
    {
        $data['parent_invoice'] = $this->db->query("SELECT * FROM tblinvoices where clientid IN (".$branch_str.") and site_id = '".$s_id."' and service_type = '".$service_type."' and parent_id = '0' and status != '5' order by date ".$flow." ")->result();


        $data['title'] = 'Invoice Product Details';
        $this->load->view('admin/invoices/invoice_products', $data);
    }

    /* this function use for send mail of lead */
    public function invoice_send_to_mail(){
        $this->load->model('emails_model');

        if ($_POST){
            extract($this->input->post());
            $service_url = ($service_type == 2) ? "invoices/list" : "invoices/rent_list";
            $invoice_data = $this->db->query("SELECT * FROM tblinvoices WHERE id = ".$invoice_id."")->row();
            if (!empty($invoice_data)){
                $response = $this->emails_model->send_mail($invoice_id, "invoice", $module_template_id, $invoice_data, $sent_to, $message, $cc);
                if ($response == TRUE){
                    set_alert('success', "Invoice send on mail successfully");
                    redirect(admin_url($service_url));
                }
                else{
                    set_alert('danger', "Something went wrong.");
                    redirect(admin_url($service_url));
                }
            }
            else{
                set_alert('danger', "Estimate not found");
                redirect(admin_url($service_url));
            }
        }
        else{
            redirect(admin_url($service_url));
        }
    }

    /* this function use for get lead list for invoice */
    public function getleadlist() {
        $postData = $this->input->post();
        $response = array();
        if(isset($postData['search']) ){
          // Select record
          $this->db->select('*');
          $this->db->like("leadno", $postData['search']);
          $records = $this->db->get('tblleads')->result();
          foreach($records as $row ){
              $invoice_data = $this->db->query("SELECT id FROM tblinvoices WHERE lead_id = ".$row->id."")->row();
              if (empty($invoice_data)){
                  $response[] = array("value"=>$row->id,"label"=>$row->leadno);
              }
          }
        }
        echo json_encode($response);
    }

    /* this function use for check lead connected to invoice  or not */
    public function chk_lead($invoice_id = 0) {
        $leadno = $lead_id = "";
        $invoice_data = $this->db->query("SELECT lead_id FROM tblinvoices WHERE id = ".$invoice_id."")->row();
        if (!empty($invoice_data) && $invoice_data->lead_id > 0){
            $lead_id = $invoice_data->lead_id;
            $leadno = value_by_id("tblleads", $invoice_data->lead_id, "leadno");
        }

        echo json_encode(array("lead_id" => $lead_id, "leadno" => $leadno));
    }

    /* this function use for send mail of lead */
    public function connect_to_lead(){

        if ($_POST){
            extract($this->input->post());
           
            $service_url = ($service_type == 2) ? "invoices/list" : "invoices/rent_list";
            $up_data = array("lead_id" => $lead_number);
            $update = $this->home_model->update("tblinvoices", $up_data, array("id" => $invoice_id));
          
            if($update){
                set_alert('success', "Invoice connected to lead successfully");
                redirect(admin_url($service_url));
            }
        }
    }

    function getNameFromNumber($num) {
        $numeric = $num % 26;
        $letter = chr(65 + $numeric);
        $num2 = intval($num / 26);
        if ($num2 > 0) {
            return getNameFromNumber($num2 - 1) . $letter;
        } else {
            return $letter;
        }
    }

    public function ledger_export($data){

        $file_name = 'Ledger Excel -'.date('d_m_y').'.xls';
            $site_ids = explode(",",$data['site_ids']);
            $branch_str = $data['client_branch'];
            $client_id = $data['client_id'];
            $flow = $data['flow'];
            $service_type = $data['service_type'];
            $year_id = $data['year_id'];
            $this->load->library('excel');

            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);

            $styleArray = array(
                'font'  => array(
                'bold'  => false,
                'size'  => 14,
                'name'  => 'Arial'
            ));

            $textFormat='@';//'General','0.00','@'
            $allinvoice_ids = $alldn_ids = 0;
            $ledger_for = ($service_type == 1) ? 'Rental Ledger' : 'Sales Ledger';
            $client_info = main_client_info($data['client_id']);

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
            $objPHPExcel->getActiveSheet()->setCellValue('A2', $ledger_for);

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J3');
            $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Client Name : '.$client_info->company);

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A4:J4');
            $objPHPExcel->getActiveSheet()->setCellValue('A4', 'Client Address : '.$client_info->address.'');

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A5:J5');
            $objPHPExcel->getActiveSheet()->setCellValue('A5', 'GST Number : '.$client_info->vat.'');

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A6:J6');
            $objPHPExcel->getActiveSheet()->setCellValue('A6', 'Print Date : '.date('d/m/Y').'');

            $styleArray = array(
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
                );
            $grand_bal = $grand_recevied = $i = $ttl_billing = 0;
            $siteheadingcol = 7;
            foreach ($site_ids as $s_id) {
                $i++;
                $col_span = 0;
                $cols = "A";
                $site_info = $this->db->query("SELECT * FROM tblsitemanager where id = '".$s_id."' ")->row();

                if (!empty($year_id) && $year_id != ''){
                    $parent_invoice = $this->db->query("SELECT * FROM tblinvoices where clientid IN (".$branch_str.") and site_id = '".$s_id."' and service_type = '".$service_type."' and parent_id = '0' and status != '5' and year_id = '".$year_id."' order by date ".$flow." ")->result();
                }else{
                    $parent_invoice = $this->db->query("SELECT * FROM tblinvoices where clientid IN (".$branch_str.") and site_id = '".$s_id."' and service_type = '".$service_type."' and parent_id = '0' and status != '5' order by date ".$flow." ")->result();
                }


                $ttl_bal = $ttl_tds = $ttl_recv = $ttl_amt = $parent_ids = 0;
                if(!empty($parent_invoice)){

                    $siteheadingcol = $siteheadingcol + 1;
                    $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A$siteheadingcol:J$siteheadingcol");
                    $objPHPExcel->getActiveSheet()->SetCellValue("A$siteheadingcol", cc($site_info->name))->getStyle("A$siteheadingcol:J$siteheadingcol")->getFont()->setBold(true);
                    $objPHPExcel->getActiveSheet()->SetCellValue("A$siteheadingcol", cc($site_info->name))->getStyle("A$siteheadingcol:J$siteheadingcol")->applyFromArray($styleArray);
                    $objPHPExcel->getActiveSheet()->SetCellValue("A$siteheadingcol", cc($site_info->name))->getStyle("A$siteheadingcol:J$siteheadingcol")->getAlignment()->setHorizontal('center');

                    ++$siteheadingcol;
                    if(!empty($data['printdata']['start_end_date']) && $service_type == 1){

                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol)->getStyle($cols.$siteheadingcol)->applyFromArray($styleArray);
                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, 'Start-End Date')->getStyle($cols.$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                        $col_span += 1;
    //                    $cols = ($cols == "A") ? "B": "A";
                    }
                    if(!empty($data['printdata']['inv_no'])){
                        $cols = $this->getNameFromNumber($col_span);
                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol)->getStyle($cols.$siteheadingcol)->applyFromArray($styleArray);
                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, 'Inv. Number')->getStyle($cols.$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                        $col_span += 1;
    //                    $cols = ($cols == "B") ? "C": "B";
                    }
                    if(!empty($data['printdata']['inv_date'])){
                        $cols = $this->getNameFromNumber($col_span);
                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol)->getStyle($cols.$siteheadingcol)->applyFromArray($styleArray);
                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, 'Inv. Date')->getStyle($cols.$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                        $col_span += 1;
    //                    $cols = ($cols == "C") ? "D": "C";
                    }
                    if(!empty($data['printdata']['inv_amt'])){
                        $cols = $this->getNameFromNumber($col_span);
                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol)->getStyle($cols.$siteheadingcol)->applyFromArray($styleArray);
                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, 'Inv. Amt')->getStyle($cols.$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                        $col_span += 1;
    //                    $cols = ($cols == "D") ? "E": "D";
                    }
                    if(!empty($data['printdata']['ttl_recd'])){
                        $cols = $this->getNameFromNumber($col_span);
                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol)->getStyle($cols.$siteheadingcol)->applyFromArray($styleArray);
                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, 'Total Recd')->getStyle($cols.$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                        $col_span += 1;
    //                    $cols = ($cols == "E") ? "F": "E";
                    }
                    if(!empty($data['printdata']['inv_recd'])){
                        $cols = $this->getNameFromNumber($col_span);
                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol)->getStyle($cols.$siteheadingcol)->applyFromArray($styleArray);
                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, 'Received')->getStyle($cols.$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                        $col_span += 1;
    //                    $cols = ($cols == "F") ? "G": "F";
                    }
                    if(!empty($data['printdata']['tds'])){
                        $cols = $this->getNameFromNumber($col_span);
                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol)->getStyle($cols.$siteheadingcol)->applyFromArray($styleArray);
                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, 'TDS')->getStyle($cols.$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                        $col_span += 1;
    //                    $cols = ($cols == "G") ? "H": "G";
                    }
                    if(!empty($data['printdata']['balance'])){
                        $cols = $this->getNameFromNumber($col_span);
                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol)->getStyle($cols.$siteheadingcol)->applyFromArray($styleArray);
                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, 'Balance')->getStyle($cols.$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                        $col_span += 1;
    //                    $cols = ($cols == "H") ? "I": "H";
                    }
                    if(!empty($data['printdata']['receipt_date'])){
                        $cols = $this->getNameFromNumber($col_span);
                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol)->getStyle($cols.$siteheadingcol)->applyFromArray($styleArray);
                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, 'Receipt Date')->getStyle($cols.$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                        $col_span += 1;
    //                    $cols = ($cols == "I") ? "J": "I";
                    }
                    if(!empty($data['printdata']['ref_details'])){
                        $cols = $this->getNameFromNumber($col_span);
                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol)->getStyle($cols.$siteheadingcol)->applyFromArray($styleArray);
                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, 'Ref Detail')->getStyle($cols.$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                        $col_span += 1;
    //                    $cols = ($cols == "J") ? "K": "J";
                    }
                    if(!empty($data['printdata']['contact_person'])){
                        $cols = $this->getNameFromNumber($col_span);
                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol)->getStyle($cols.$siteheadingcol)->applyFromArray($styleArray);
                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, 'Contact Person')->getStyle($cols.$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                        $col_span += 1;
    //                    $cols = ($cols == "K") ? "L": "K";
                    }
                    if(!empty($data['printdata']['due_days'])){
                        $cols = $this->getNameFromNumber($col_span);
                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol)->getStyle($cols.$siteheadingcol)->applyFromArray($styleArray);
                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, 'Due Days')->getStyle($cols.$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                        $col_span += 1;
                    }

                    foreach ($parent_invoice as $parent) {
                        $parent_ids .= ','.$parent->id;
                        $allinvoice_ids .= ','.$parent->id;
                        $item_info = $this->db->query("SELECT is_sale FROM `tblitems_in` where  `rel_type` = 'invoice' and `rel_id` = '".$parent->id."' ")->row();

                        $type = '--';
                        if(!empty($item_info)){
                            if($item_info->is_sale == 0){
                                $type = 'Rent';
                            }elseif($item_info->is_sale == 1){
                                $type = 'Sale';
                            }
                        }

                        if ($type == 'Rent') {
                            $start_date = _d($parent->date);
                            $due_date = _d($parent->duedate);
                        } else {
                            $start_date = '-';
                            $due_date = '-';
                        }

                        $due_days = due_days($parent->payment_due_date);


                        $received = invoice_received($parent->id);
                        $received_tds = invoice_tds_received($parent->id);

                        $bal_amt = ($parent->total - $received - $received_tds);

                        $ttl_recv += $received;
                        $ttl_tds += $received_tds;
                        $ttl_amt += $parent->total;
                        $ttl_bal += $bal_amt;
                        $grand_bal += $bal_amt;

                        $ttl_billing += $parent->total;

                        $payment_info = $this->db->query("SELECT cp.payment_mode,cp.chaque_status,cp.chaque_clear_date,p.* FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '2' and p.invoiceid = '".$parent->id."' and cp.status = 1 order by p.id asc ")->result();

                        if (count($payment_info) == 1) {
                            if ($payment_info[0]->payment_mode == 1 && $payment_info[0]->chaque_status != 1) {
                                $payment_info = '';
                            }
                        }

                         //Getting site person
                        $person_info = invoice_contact_person($parent->id);
                        $site_name = (!empty($person_info['site_name'])) ? $person_info['site_name'] : '--';

                        if(!empty($payment_info)){
                            $j = 0;
                            foreach ($payment_info as  $r1) {
                                $to_see = ($r1->payment_mode == 1 && $r1->chaque_status != 1) ? '0' : '1';

                                if($to_see == 1){
                                    $ref_no = value_by_id('tblclientpayment',$r1->pay_id,'reference_no');

                                    $receipt_date = _d($r1->date);
                                    if($r1->payment_mode == 1 && $r1->chaque_status == 1 && !empty($r1->chaque_clear_date)){
                                      $receipt_date = _d($r1->chaque_clear_date);
                                    }

                                    $total = ($j == 0) ? $parent->total : '--';
                                    $ttl_received = ($j == 0) ? $received : '--';
                                    $bal = ($j == 0) ? number_format($bal_amt, 2, '.', '') : '--';
                                    $due_days = ($j == 0) ? $due_days : '--';
                                    $pay_date = ($r1->amount > 0) ? $receipt_date : '--';
                                    $cols = "A";
                                    ++$siteheadingcol;
                                    if(!empty($data['printdata']['start_end_date']) && $service_type == 1){

                                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $start_date.' - '.$due_date);
                                        $cols = ($cols == "A") ? "B": "A";
                                    }
                                    if(!empty($data['printdata']['inv_no'])){

                                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $parent->number);
                                        $cols = ($cols == "B") ? "C": "B";
                                    }
                                    if(!empty($data['printdata']['inv_date'])){

                                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, _d($parent->invoice_date));
                                        $cols = ($cols == "C") ? "D": "C";
                                    }
                                    if(!empty($data['printdata']['inv_amt'])){

                                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $total);
                                        $cols = ($cols == "D") ? "E": "D";
                                    }
                                    if(!empty($data['printdata']['ttl_recd'])){

                                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $ttl_received);
                                        $cols = ($cols == "E") ? "F": "E";
                                    }
                                    if(!empty($data['printdata']['inv_recd'])){

                                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $r1->amount);
                                        $cols = ($cols == "F") ? "G": "F";
                                    }
                                    if(!empty($data['printdata']['tds'])){

                                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $r1->paid_tds_amt);
                                        $cols = ($cols == "G") ? "H": "G";
                                    }
                                    if(!empty($data['printdata']['balance'])){

                                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $bal);
                                        $cols = ($cols == "H") ? "I": "H";
                                    }
                                    if(!empty($data['printdata']['receipt_date'])){

                                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $pay_date);
                                        $cols = ($cols == "I") ? "J": "I";
                                    }
                                    if(!empty($data['printdata']['ref_details'])){

                                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $ref_no);
                                        $cols = ($cols == "J") ? "K": "J";
                                    }
                                    if(!empty($data['printdata']['contact_person'])){

                                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $site_name);
                                        $cols = ($cols == "K") ? "L": "K";
                                    }
                                    if(!empty($data['printdata']['due_days'])){

                                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $due_days);
                                    }
                                    $j++;
                                }
                            }
                        }else{
                            $cols = "A";
                            ++$siteheadingcol;
                            if(!empty($data['printdata']['start_end_date']) && $service_type == 1){

                                $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $start_date.' - '.$due_date);
                                $cols = ($cols == "A") ? "B": "A";
                            }
                            if(!empty($data['printdata']['inv_no'])){

                                $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $parent->number);
                                $cols = ($cols == "B") ? "C": "B";
                            }
                            if(!empty($data['printdata']['inv_date'])){

                                $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, _d($parent->invoice_date));
                                $cols = ($cols == "C") ? "D": "C";
                            }
                            if(!empty($data['printdata']['inv_amt'])){

                                $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $parent->total);
                                $cols = ($cols == "D") ? "E": "D";
                            }
                            if(!empty($data['printdata']['ttl_recd'])){

                                $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, '0.00');
                                $cols = ($cols == "E") ? "F": "E";
                            }
                            if(!empty($data['printdata']['inv_recd'])){

                                $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, '0.00');
                                $cols = ($cols == "F") ? "G": "F";
                            }
                            if(!empty($data['printdata']['tds'])){

                                $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, '0.00');
                                $cols = ($cols == "G") ? "H": "G";
                            }
                            if(!empty($data['printdata']['balance'])){

                                $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, number_format($bal_amt, 2, '.', ''));
                                $cols = ($cols == "H") ? "I": "H";
                            }
                            if(!empty($data['printdata']['receipt_date'])){

                                $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, '--');
                                $cols = ($cols == "I") ? "J": "I";
                            }
                            if(!empty($data['printdata']['ref_details'])){

                                $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, '--');
                                $cols = ($cols == "J") ? "K": "J";
                            }
                            if(!empty($data['printdata']['contact_person'])){

                                $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $site_name);
                                $cols = ($cols == "K") ? "L": "K";
                            }
                            if(!empty($data['printdata']['due_days'])){

                                $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $due_days);
                            }
                        }

                        //Getting Child Invoice
                        if (!empty($year_id)){
                            $child_invoice = $this->db->query("SELECT * FROM tblinvoices where clientid IN (".$branch_str.") and site_id = '".$s_id."' and service_type = '".$service_type."' and parent_id = '".$parent->id."' and year_id = '".$year_id."' and status != '5' order by date ".$flow." ")->result();
                          }else{
                            $child_invoice = $this->db->query("SELECT * FROM tblinvoices where clientid IN (".$branch_str.") and site_id = '".$s_id."' and service_type = '".$service_type."' and parent_id = '".$parent->id."' and status != '5' order by date ".$flow." ")->result();
                          }
                        if (!empty($child_invoice)) {
                            foreach ($child_invoice as $child) {


                                $allinvoice_ids .= ',' . $child->id;
                                $item_info = $this->db->query("SELECT is_sale FROM `tblitems_in` where  `rel_type` = 'invoice' and `rel_id` = '" . $child->id . "' ")->row();
                                $type = '--';
                                if (!empty($item_info)) {
                                    if ($item_info->is_sale == 0) {
                                        $type = 'Rent';
                                    } elseif ($item_info->is_sale == 1) {
                                        $type = 'Sale';
                                    }
                                }

                                if ($type == 'Rent') {
                                    $start_date = _d($child->date);
                                    $due_date = _d($child->duedate);
                                } else {
                                    $start_date = '-';
                                    $due_date = '-';
                                }
                                $due_days = due_days($child->payment_due_date);


                                $received = invoice_received($child->id);
                                $received_tds = invoice_tds_received($child->id);

                                $bal_amt = ($child->total - $received - $received_tds);

                                $ttl_recv += $received;
                                $ttl_tds += $received_tds;
                                $ttl_amt += $child->total;
                                $ttl_bal += $bal_amt;
                                $grand_bal += $bal_amt;

                                $ttl_billing += $child->total;

                                $payment_info = $this->db->query("SELECT cp.payment_mode,cp.chaque_status,cp.chaque_clear_date,p.* FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '2' and p.invoiceid = '" . $child->id . "' and cp.status = 1 order by p.id asc ")->result();

                                // IF there is only one recored of payment which is made by cheque and cheque is not clear
                                if (count($payment_info) == 1) {
                                    if ($payment_info[0]->payment_mode == 1 && $payment_info[0]->chaque_status != 1) {
                                        $payment_info = '';
                                    }
                                }

                                //Getting site person
                                $person_info = invoice_contact_person($child->id);
                                $site_name = (!empty($person_info['site_name'])) ? $person_info['site_name'] : '--';

                                if (!empty($payment_info)) {
                                    $j = 0;
                                    foreach ($payment_info as $r1) {

                                        $to_see = ($r1->payment_mode == 1 && $r1->chaque_status != 1) ? '0' : '1';

                                        if ($to_see == 1) {
                                            $cols = "A";
                                            ++$siteheadingcol;

                                            $ref_no = value_by_id('tblclientpayment', $r1->pay_id, 'reference_no');

                                            $receipt_date = _d($r1->date);
                                            if ($r1->payment_mode == 1 && $r1->chaque_status == 1 && !empty($r1->chaque_clear_date)) {
                                                $receipt_date = _d($r1->chaque_clear_date);
                                            }

                                            $total = ($j == 0) ? $child->total : '--';
                                            $ttl_received = ($j == 0) ? $received : '--';
                                            $bal = ($j == 0) ? number_format($bal_amt, 2, '.', '') : '--';
                                            $due_days = ($j == 0) ? $due_days : '--';
                                            $pay_date = ($r1->amount > 0) ? $receipt_date : '--';
                                            //$tds = ($r1->showInReconciliation == 2) ? $r1->tds_amt : '0.00';

                                            if(!empty($data['printdata']['start_end_date']) && $service_type == 1){

                                                $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $start_date . ' - ' . $due_date);
                                                $cols = ($cols == "A") ? "B": "A";
                                            }
                                            if(!empty($data['printdata']['inv_no'])){

                                                $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $child->number);
                                                $cols = ($cols == "B") ? "C": "B";
                                            }
                                            if(!empty($data['printdata']['inv_date'])){

                                                $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, _d($child->invoice_date));
                                                $cols = ($cols == "C") ? "D": "C";
                                            }
                                            if(!empty($data['printdata']['inv_amt'])){

                                                $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $total);
                                                $cols = ($cols == "D") ? "E": "D";
                                            }
                                            if(!empty($data['printdata']['ttl_recd'])){

                                                $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $ttl_received);
                                                $cols = ($cols == "E") ? "F": "E";
                                            }
                                            if(!empty($data['printdata']['inv_recd'])){

                                                $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $r1->amount);
                                                $cols = ($cols == "F") ? "G": "F";
                                            }
                                            if(!empty($data['printdata']['tds'])){

                                                $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $r1->paid_tds_amt);
                                                $cols = ($cols == "G") ? "H": "G";
                                            }
                                            if(!empty($data['printdata']['balance'])){

                                                $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $bal);
                                                $cols = ($cols == "H") ? "I": "H";
                                            }
                                            if(!empty($data['printdata']['receipt_date'])){

                                                $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $pay_date);
                                                $cols = ($cols == "I") ? "J": "I";
                                            }
                                            if(!empty($data['printdata']['ref_details'])){

                                                $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $ref_no);
                                                $cols = ($cols == "J") ? "K": "J";
                                            }
                                            if(!empty($data['printdata']['contact_person'])){

                                                $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $site_name);
                                                $cols = ($cols == "K") ? "L": "K";
                                            }
                                            if(!empty($data['printdata']['due_days'])){

                                                $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $due_days);
                                            }
                                            $j++;
                                        }
                                    }
                                } else {
                                    $cols = "A";
                                    ++$siteheadingcol;

                                    if(!empty($data['printdata']['start_end_date']) && $service_type == 1){

                                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $start_date . ' - ' . $due_date);
                                        $cols = ($cols == "A") ? "B": "A";
                                    }

                                    if(!empty($data['printdata']['inv_no'])){

                                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $child->number);
                                        $cols = ($cols == "B") ? "C": "B";
                                    }
                                    if(!empty($data['printdata']['inv_date'])){

                                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, _d($child->invoice_date));
                                        $cols = ($cols == "C") ? "D": "C";
                                    }
                                    if(!empty($data['printdata']['inv_amt'])){

                                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $child->total);
                                        $cols = ($cols == "D") ? "E": "D";
                                    }
                                    if(!empty($data['printdata']['ttl_recd'])){

                                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, '0.00');
                                        $cols = ($cols == "E") ? "F": "E";
                                    }
                                    if(!empty($data['printdata']['inv_recd'])){

                                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, '0.00');
                                        $cols = ($cols == "F") ? "G": "F";
                                    }
                                    if(!empty($data['printdata']['tds'])){

                                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, '0.00');
                                        $cols = ($cols == "G") ? "H": "G";
                                    }
                                    if(!empty($data['printdata']['balance'])){

                                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, number_format($bal_amt, 2, '.', ''));
                                        $cols = ($cols == "H") ? "I": "H";
                                    }
                                    if(!empty($data['printdata']['receipt_date'])){

                                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, '--');
                                        $cols = ($cols == "I") ? "J": "I";
                                    }
                                    if(!empty($data['printdata']['ref_details'])){

                                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, '--');
                                        $cols = ($cols == "J") ? "K": "J";
                                    }
                                    if(!empty($data['printdata']['contact_person'])){

                                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $site_name);
                                        $cols = ($cols == "K") ? "L": "K";
                                    }
                                    if(!empty($data['printdata']['due_days'])){

                                        $objPHPExcel->getActiveSheet()->SetCellValue($cols.$siteheadingcol, $due_days);
                                    }
                                }
                            }
                        }
                    }

                    //Getting Debit Notes againt parent invoice
                    if (!empty($year_id)){
                        $debit_note_info = $this->db->query("SELECT * FROM tbldebitnote where invoice_id IN (".$parent_ids.") and invoice_id > '0' and year_id = '".$year_id."' and status = '1' order by dabit_note_date ".$flow." ")->result();
                    }else{
                        $debit_note_info = $this->db->query("SELECT * FROM tbldebitnote where invoice_id IN (".$parent_ids.") and invoice_id > '0' and status = '1' order by dabit_note_date ".$flow." ")->result();
                    }
                    if (!empty($debit_note_info)) {
                        foreach ($debit_note_info as $debitnote) {

                            $alldn_ids .= ',' . $debitnote->id;

                            $received = debitnote_received($debitnote->number);
                            $received_tds = debitnote_tds_received($debitnote->number);
                            $bal_amt = ($debitnote->totalamount - $received - $received_tds);

                            $ttl_recv += $received;
                            $ttl_tds += $received_tds;
                            $ttl_amt += $debitnote->totalamount;
                            $ttl_bal += $bal_amt;
                            $grand_bal += $bal_amt;

                            $ttl_billing += $debitnote->totalamount;

                            $debitnote_payment = $this->db->query("SELECT cp.payment_mode,cp.chaque_status,cp.chaque_clear_date,p.* FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '3' and p.debitnote_no = '" . $debitnote->number . "' and cp.status = 1 order by p.id asc ")->result();

                            // IF there is only one recored of payment which is made by cheque and cheque is not clear
                            if (count($debitnote_payment) == 1) {
                                if ($debitnote_payment[0]->payment_mode == 1 && $debitnote_payment[0]->chaque_status != 1) {
                                    $debitnote_payment = '';
                                }
                            }


                            if (!empty($debitnote_payment)) {
                                $j = 0;
                                foreach ($debitnote_payment as $r3) {

                                    $to_see = ($r3->payment_mode == 1 && $r3->chaque_status != 1) ? '0' : '1';

                                    if ($to_see == 1) {

                                        $cols = "A";
                                        ++$siteheadingcol;

                                        $ref_no = value_by_id('tblclientpayment', $r3->pay_id, 'reference_no');

                                        $receipt_date = _d($r3->date);
                                        if ($r3->payment_mode == 1 && $r3->chaque_status == 1 && !empty($r3->chaque_clear_date)) {
                                            $receipt_date = _d($r3->chaque_clear_date);
                                        }

                                        $total = ($j == 0) ? $debitnote->totalamount : '--';
                                        $ttl_received = ($j == 0) ? $received : '--';
                                        $bal = ($j == 0) ? number_format($bal_amt, 2, '.', '') : '--';
                                        //$tds = ($r3->showInReconciliation == 2) ? $r3->tds_amt : '0.00';

                                        if(!empty($data['printdata']['start_end_date']) && $service_type == 1) {

                                            $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, 'DN');
                                            $cols = ($cols == "A") ? "B": "A";
                                        }

                                        if(!empty($data['printdata']['inv_no'])) {

                                            $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, $debitnote->number);
                                            $cols = ($cols == "B") ? "C": "B";
                                        }

                                        if(!empty($data['printdata']['inv_date'])) {

                                            $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, _d($debitnote->dabit_note_date));
                                            $cols = ($cols == "C") ? "D": "C";
                                        }

                                        if(!empty($data['printdata']['inv_amt'])) {

                                            $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, $total);
                                            $cols = ($cols == "D") ? "E": "D";
                                        }

                                        if(!empty($data['printdata']['ttl_recd'])) {

                                            $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, $ttl_received);
                                            $cols = ($cols == "E") ? "F": "E";
                                        }
                                        if(!empty($data['printdata']['inv_recd'])) {

                                            $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, $r3->amount);
                                            $cols = ($cols == "F") ? "G": "F";
                                        }
                                        if(!empty($data['printdata']['tds'])) {

                                            $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, $r3->paid_tds_amt);
                                            $cols = ($cols == "G") ? "H": "G";
                                        }
                                        if(!empty($data['printdata']['balance'])) {

                                            $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, $bal);
                                            $cols = ($cols == "H") ? "I": "H";
                                        }
                                        if(!empty($data['printdata']['receipt_date'])) {

                                            $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, $receipt_date);
                                            $cols = ($cols == "I") ? "J": "I";
                                        }
                                        if(!empty($data['printdata']['ref_details'])) {

                                            $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, $ref_no);
                                            $cols = ($cols == "J") ? "K": "J";
                                        }
                                        if(!empty($data['printdata']['contact_person'])) {

                                            $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, '--');
                                            $cols = ($cols == "K") ? "L": "K";
                                        }
                                        if(!empty($data['printdata']['due_days'])) {

                                            $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, '--');
                                        }
                                        $j++;
                                    }
                                }
                            } else {
                                $cols = "A";
                                ++$siteheadingcol;

                                if(!empty($data['printdata']['start_end_date']) && $service_type == 1) {

                                    $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, 'DN');
                                    $cols = ($cols == "A") ? "B": "A";
                                }

                                if(!empty($data['printdata']['inv_no'])) {

                                    $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, $debitnote->number );
                                    $cols = ($cols == "B") ? "C": "B";
                                }

                                if(!empty($data['printdata']['inv_date'])) {

                                    $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, _d($debitnote->dabit_note_date));
                                    $cols = ($cols == "C") ? "D": "C";
                                }

                                if(!empty($data['printdata']['inv_amt'])) {

                                    $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, $debitnote->totalamount);
                                    $cols = ($cols == "D") ? "E": "D";
                                }

                                if(!empty($data['printdata']['ttl_recd'])) {

                                    $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, '0.00');
                                    $cols = ($cols == "E") ? "F": "E";
                                }
                                if(!empty($data['printdata']['inv_recd'])) {

                                    $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, '0.00');
                                    $cols = ($cols == "F") ? "G": "F";
                                }
                                if(!empty($data['printdata']['tds'])) {

                                    $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, '0.00');
                                    $cols = ($cols == "G") ? "H": "G";
                                }
                                if(!empty($data['printdata']['balance'])) {

                                    $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, number_format($bal_amt, 2, '.', ''));
                                    $cols = ($cols == "H") ? "I": "H";
                                }
                                if(!empty($data['printdata']['receipt_date'])) {

                                    $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, '--');
                                    $cols = ($cols == "I") ? "J": "I";
                                }
                                if(!empty($data['printdata']['ref_details'])) {

                                    $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, '--');
                                    $cols = ($cols == "J") ? "K": "J";
                                }
                                if(!empty($data['printdata']['contact_person'])) {

                                    $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, '--');
                                    $cols = ($cols == "K") ? "L": "K";
                                }
                                if(!empty($data['printdata']['due_days'])) {

                                    $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, '--');
                                }
                            }
                        }
                    }

                    //Getting Credit Notes againt parent invoice
                    if (!empty($year_id)){
                        $credit_note_info = $this->db->query("SELECT * FROM tblcreditnote where invoice_id IN (".$parent_ids.") and invoice_id > '0' and status = '1' and year_id = '".$year_id."' order by date ".$flow." ")->result();
                      }else{
                        $credit_note_info = $this->db->query("SELECT * FROM tblcreditnote where invoice_id IN (".$parent_ids.") and invoice_id > '0' and status = '1' order by date ".$flow." ")->result();
                      }
                    if (!empty($credit_note_info)) {
                        foreach ($credit_note_info as $creditnote) {

                            $cols = "A";
                            ++$siteheadingcol;
                            $ttl_recv += $creditnote->totalamount;

                            $ttl_bal -= $creditnote->totalamount;
                            $grand_bal -= $creditnote->totalamount;

                            if(!empty($data['printdata']['start_end_date']) && $service_type == 1) {

                                $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, 'CN');
                                $cols = ($cols == "A") ? "B": "A";
                            }
                            if(!empty($data['printdata']['inv_no'])) {

                                $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, $creditnote->number );
                                $cols = ($cols == "B") ? "C": "B";
                            }
                            if(!empty($data['printdata']['inv_date'])) {

                                $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, _d($creditnote->date));
                                $cols = ($cols == "C") ? "D": "C";
                            }
                            if(!empty($data['printdata']['inv_amt'])) {

                                $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, '0.00');
                                $cols = ($cols == "D") ? "E": "D";
                            }

                            if(!empty($data['printdata']['ttl_recd'])) {

                                $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, $creditnote->totalamount);
                                $cols = ($cols == "E") ? "F": "E";
                            }

                            if(!empty($data['printdata']['inv_recd'])) {

                                $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, '0.00');
                                $cols = ($cols == "F") ? "G": "F";
                            }
                            if(!empty($data['printdata']['balance'])) {

                                $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, '0.00');
                                $cols = ($cols == "G") ? "I": "G";
                            }

                            if(!empty($data['printdata']['tds'])) {

                                $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, '0.00');
                                $cols = ($cols == "I") ? "H": "I";
                            }

                            if(!empty($data['printdata']['receipt_date'])) {

                                $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, '--');
                                $cols = ($cols == "H") ? "J": "H";
                            }

                            if(!empty($data['printdata']['ref_details'])) {

                                $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, '--');
                                $cols = ($cols == "J") ? "K": "J";
                            }
                            if(!empty($data['printdata']['contact_person'])) {

                                $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, '--');
                                $cols = ($cols == "K") ? "L": "K";
                            }
                            if(!empty($data['printdata']['due_days'])) {

                                $objPHPExcel->getActiveSheet()->SetCellValue($cols . $siteheadingcol, '--');
                            }
                        }
                    }

                     ++$siteheadingcol;
                    $colspan = ($service_type == 1) ? "C" : "B" ;
                    $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A$siteheadingcol:".$colspan.$siteheadingcol);
                    $objPHPExcel->getActiveSheet()->SetCellValue("A$siteheadingcol")->getStyle("A$siteheadingcol");
                    $objPHPExcel->getActiveSheet()->SetCellValue("A$siteheadingcol", "TOTAL")->getStyle("A$siteheadingcol:".$colspan.$siteheadingcol)->getAlignment()->setHorizontal('center');

                    $colspan = ($colspan == "C") ? "D" : "C" ;
                    $objPHPExcel->getActiveSheet()->SetCellValue($colspan.$siteheadingcol, number_format($ttl_amt, 2, '.', ''));
                    $colspan = ($colspan == "D") ? "E" : "D" ;
                    $objPHPExcel->getActiveSheet()->SetCellValue($colspan.$siteheadingcol, number_format($ttl_recv, 2, '.', ''));
                    $colspan = ($colspan == "E") ? "F" : "E" ;
                    $objPHPExcel->getActiveSheet()->SetCellValue($colspan.$siteheadingcol, number_format($ttl_recv, 2, '.', ''));

                    $colspan = ($colspan == "F") ? "G" : "F" ;
                    if(!empty($data['printdata']['tds'])){
                        $objPHPExcel->getActiveSheet()->SetCellValue($colspan.$siteheadingcol, number_format($ttl_tds, 2, '.', ''));
                        $colspan = ($colspan == "G") ? "H" : "G" ;
                    }
                    $objPHPExcel->getActiveSheet()->SetCellValue($colspan.$siteheadingcol, number_format($ttl_bal, 2, '.', ''));


                    $siteheadingcol++;
                    $grand_recevied += ($ttl_recv + $ttl_tds);
                }


            }

            //Payment Debit Notes
            $financialyearwhere = (!empty($year_id)) ? 'and dn.year_id='.$year_id : '';
            $payment_debitnote = $this->db->query("SELECT dn.* from tbldebitnotepayment as dn LEFT JOIN tbldebitnotepaymentitems as i ON dn.id = i.debitnote_id where i.invoice_id IN (".$allinvoice_ids.") and i.invoice_id > 0 and i.type = 1 ".$financialyearwhere." GROUP by dn.id ")->result();
            if(empty($payment_debitnote)){
                $payment_debitnote = $this->db->query("SELECT dn.* from tbldebitnotepayment as dn LEFT JOIN tbldebitnotepaymentitems as i ON dn.id = i.debitnote_id where i.invoice_id IN (".$alldn_ids.") and i.invoice_id > 0 and i.type = 2 ".$financialyearwhere." GROUP by dn.id ")->result();
            }
            if(!empty($payment_debitnote)){
                ++ $siteheadingcol;
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A$siteheadingcol:I$siteheadingcol");
                $objPHPExcel->getActiveSheet()->getStyle("A$siteheadingcol:I$siteheadingcol")->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle("A$siteheadingcol:I$siteheadingcol")->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->SetCellValue("A$siteheadingcol", "Delay in Payment")->getStyle("A$siteheadingcol:I$siteheadingcol")->getAlignment()->setHorizontal('center');

                $ttl_tds = $ttl_bal = $ttl_recv = $ttl_amt = 0;
                ++ $siteheadingcol;
                $objPHPExcel->getActiveSheet()->SetCellValue("A".$siteheadingcol)->getStyle("A$siteheadingcol:"."I".$siteheadingcol)->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->SetCellValue("A".$siteheadingcol, 'Details')->getStyle("A".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                $objPHPExcel->getActiveSheet()->SetCellValue("B".$siteheadingcol, 'DN Number')->getStyle("B".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                $objPHPExcel->getActiveSheet()->SetCellValue("C".$siteheadingcol, 'DN Date')->getStyle("C".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                $objPHPExcel->getActiveSheet()->SetCellValue("D".$siteheadingcol, 'Amount')->getStyle("D".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                $objPHPExcel->getActiveSheet()->SetCellValue("E".$siteheadingcol, 'Payment recd')->getStyle("E".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                $objPHPExcel->getActiveSheet()->SetCellValue("F".$siteheadingcol, 'TDS')->getStyle("F".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                $objPHPExcel->getActiveSheet()->SetCellValue("G".$siteheadingcol, 'Payment Balance')->getStyle("G".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                $objPHPExcel->getActiveSheet()->SetCellValue("H".$siteheadingcol, 'Payment Receipt Date')->getStyle("H".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                $objPHPExcel->getActiveSheet()->SetCellValue("I".$siteheadingcol, 'Payment Ref Detail')->getStyle("I".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');

                foreach ($payment_debitnote as $debitnote) {

                    $received = debitnote_received($debitnote->number);
                    $received_tds = debitnote_tds_received($debitnote->number);
                    $bal_amt = ($debitnote->amount - $received - $received_tds);

                    $ttl_recv += $received;
                    $ttl_amt += $debitnote->amount;
                    $ttl_bal += $bal_amt;
                    $grand_bal += $bal_amt;

                    $ttl_billing += $debitnote->amount;

                    $debitnote_payment = $this->db->query("SELECT cp.payment_mode,cp.chaque_status,cp.chaque_clear_date,p.* FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '3' and p.debitnote_no = '".$debitnote->number."' and cp.status = 1 order by p.id asc ")->result();
                    // IF there is only one recored of payment which is made by cheque and cheque is not clear
                    if(count($debitnote_payment) == 1){
                        if($debitnote_payment[0]->payment_mode == 1 && $debitnote_payment[0]->chaque_status != 1){
                            $debitnote_payment = '';
                        }
                    }
                    $j = 0;
                    $total = ($j == 0) ? $debitnote->amount : '--';
                    $bal = ($j == 0) ? number_format($bal_amt, 2, '.', '') : '--';
                    if (!empty($debitnote_payment)) {

                        foreach ($debitnote_payment as $r4) {

                            $to_see = ($r4->payment_mode == 1 && $r4->chaque_status != 1) ? '0' : '1';
                            if ($to_see == 1) {
                                ++ $siteheadingcol;
                                $ref_no = value_by_id('tblclientpayment', $r4->pay_id, 'reference_no');
                                //$tds = ($r4->showInReconciliation == 2) ? $r4->tds_amt : '0.00';
                                $receipt_date = _d($r4->date);
                                if ($r4->payment_mode == 1 && $r4->chaque_status == 1 && !empty($r4->chaque_clear_date)) {
                                    $receipt_date = _d($r4->chaque_clear_date);
                                }
                                $objPHPExcel->getActiveSheet()->SetCellValue("A" . $siteheadingcol, 'DN (Delay in Payment)');
                                $objPHPExcel->getActiveSheet()->SetCellValue("B" . $siteheadingcol, $debitnote->number);
                                $objPHPExcel->getActiveSheet()->SetCellValue("C" . $siteheadingcol, _d($debitnote->date));
                                $objPHPExcel->getActiveSheet()->SetCellValue("D" . $siteheadingcol, $total);
                                $objPHPExcel->getActiveSheet()->SetCellValue("E" . $siteheadingcol, $r4->amount);
                                $objPHPExcel->getActiveSheet()->SetCellValue("F" . $siteheadingcol, $r4->paid_tds_amt);
                                $objPHPExcel->getActiveSheet()->SetCellValue("G" . $siteheadingcol, $bal);
                                $objPHPExcel->getActiveSheet()->SetCellValue("H" . $siteheadingcol, $receipt_date);
                                $objPHPExcel->getActiveSheet()->SetCellValue("I" . $siteheadingcol, $ref_no);
                                $j++;
                            }
                        }
                    } else {
                        ++ $siteheadingcol;

                        $objPHPExcel->getActiveSheet()->SetCellValue("A" . $siteheadingcol, 'DN (Delay in Payment)');
                        $objPHPExcel->getActiveSheet()->SetCellValue("B" . $siteheadingcol, $debitnote->number);
                        $objPHPExcel->getActiveSheet()->SetCellValue("C" . $siteheadingcol, _d($debitnote->date));
                        $objPHPExcel->getActiveSheet()->SetCellValue("D" . $siteheadingcol, $total);
                        $objPHPExcel->getActiveSheet()->SetCellValue("E" . $siteheadingcol, '0.00');
                        $objPHPExcel->getActiveSheet()->SetCellValue("F" . $siteheadingcol, '--');
                        $objPHPExcel->getActiveSheet()->SetCellValue("G" . $siteheadingcol, $bal);
                        $objPHPExcel->getActiveSheet()->SetCellValue("H" . $siteheadingcol, '--');
                        $objPHPExcel->getActiveSheet()->SetCellValue("I" . $siteheadingcol, '--');
                    }
                }

                ++ $siteheadingcol;
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A$siteheadingcol:"."C".$siteheadingcol);
                $objPHPExcel->getActiveSheet()->SetCellValue("A$siteheadingcol", "TOTAL")->getStyle("A$siteheadingcol:"."C".$siteheadingcol)->getAlignment()->setHorizontal('center');
                $objPHPExcel->getActiveSheet()->SetCellValue("D" . $siteheadingcol, number_format($ttl_amt, 2, '.', ''));
                $objPHPExcel->getActiveSheet()->SetCellValue("E" . $siteheadingcol, number_format($ttl_recv, 2, '.', ''));
                $objPHPExcel->getActiveSheet()->SetCellValue("F" . $siteheadingcol, number_format($ttl_tds, 2, '.', ''));
                $objPHPExcel->getActiveSheet()->SetCellValue("G" . $siteheadingcol, number_format($ttl_bal, 2, '.', ''));
                $objPHPExcel->getActiveSheet()->SetCellValue("H" . $siteheadingcol, "");
                $objPHPExcel->getActiveSheet()->SetCellValue("I" . $siteheadingcol, "");

                $grand_recevied += ($ttl_recv + $ttl_tds);
            }

            $ondatefilter = '';
            if (!empty($year_id)){
                $from_date = value_by_id("tblfinancialyear", $year_id, "from_date");
                $to_date = value_by_id("tblfinancialyear", $year_id, "to_date");
                $ondatefilter = 'and date BETWEEN '.$from_date.' and '.$to_date;
            }
            $onaccout_info = $this->db->query("SELECT * FROM `tblclientpayment` where client_id IN (".$data['client_branch'].") and payment_behalf = 1 and service_type = '".$service_type."' and status = 1 ".$ondatefilter." ")->result();

            // IF there is only one recored of payment which is made by cheque and cheque is not clear
            if(count($onaccout_info) == 1){
                if($onaccout_info[0]->payment_mode == 1 && $onaccout_info[0]->chaque_status != 1){
                    $onaccout_info = '';
                }
            }
            if(!empty($onaccout_info)){

                ++ $siteheadingcol;
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A$siteheadingcol:I$siteheadingcol");
                $objPHPExcel->getActiveSheet()->getStyle("A$siteheadingcol:I$siteheadingcol")->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle("A$siteheadingcol:I$siteheadingcol")->applyFromArray($styleArray);
                $objPHPExcel->getActiveSheet()->SetCellValue("A$siteheadingcol", "On Account Details")->getStyle("A$siteheadingcol:I$siteheadingcol")->getAlignment()->setHorizontal('center');

                ++$siteheadingcol;
                $objPHPExcel->getActiveSheet()->SetCellValue("A".$siteheadingcol, 'Sr. No')->getStyle("A".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                $objPHPExcel->getActiveSheet()->SetCellValue("B".$siteheadingcol, 'Date')->getStyle("B".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                $objPHPExcel->getActiveSheet()->SetCellValue("C".$siteheadingcol, 'Reference No.')->getStyle("C".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                $objPHPExcel->getActiveSheet()->SetCellValue("D".$siteheadingcol, 'Amount')->getStyle("D".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                $ttl_onaccount = 0;
                foreach ($onaccout_info as $key => $on_acc) {
                    $to_see = ($on_acc->payment_mode == 1 && $on_acc->chaque_status != 1) ? '0' : '1';
                    if($to_see == 1){
                        ++$siteheadingcol;
                        $ttl_onaccount += $on_acc->ttl_amt;
                        $objPHPExcel->getActiveSheet()->SetCellValue("A" . $siteheadingcol, ++$key);
                        $objPHPExcel->getActiveSheet()->SetCellValue("B" . $siteheadingcol, _d($on_acc->date));
                        $objPHPExcel->getActiveSheet()->SetCellValue("C" . $siteheadingcol, $on_acc->reference_no);
                        $objPHPExcel->getActiveSheet()->SetCellValue("D" . $siteheadingcol, $on_acc->ttl_amt);

                   }
                }
                ++$siteheadingcol;
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A$siteheadingcol:"."C".$siteheadingcol);
                $objPHPExcel->getActiveSheet()->SetCellValue("A$siteheadingcol", "TOTAL")->getStyle("A$siteheadingcol:"."C".$siteheadingcol)->getAlignment()->setHorizontal('center');
                $objPHPExcel->getActiveSheet()->SetCellValue("D" . $siteheadingcol, number_format($ttl_onaccount, 2, '.', ''));
            }

            $datefilter = $refubddatefilter = $createdatefilter = '';
            if (!empty($year_id)){
                $from_date = value_by_id("tblfinancialyear", $year_id, "from_date");
                $to_date = value_by_id("tblfinancialyear", $year_id, "to_date");
                $datefilter = 'and date BETWEEN '.$from_date.' and '.$to_date;
                $refubddatefilter = 'and r.date BETWEEN '.$from_date.' and '.$to_date;
                $createdatefilter = 'and created_date BETWEEN '.$from_date.' and '.$to_date;
            }
            //$onaccout_amt = $this->db->query("SELECT COALESCE(SUM(ttl_amt),0) AS ttl_amount FROM `tblclientpayment`  where client_id IN (".$data['client_branch'].") and payment_behalf = 1 and service_type = '".$service_type."' ")->row()->ttl_amount;
            $onaccout_amt = 0;
            $onaccout_amt_info = $this->db->query("SELECT * FROM `tblclientpayment`  where client_id IN (".$data['client_branch'].") and payment_behalf = 1 and service_type = '".$service_type."' and status = 1 ".$datefilter."")->result();
            if(!empty($onaccout_amt_info)){
                foreach ($onaccout_amt_info as $on_am) {
                    $to_see = ($on_am->payment_mode == 1 && $on_am->chaque_status != 1) ? '0' : '1';
                    if($to_see == 1){
                    $onaccout_amt += $on_am->ttl_amt;
                    }
                }
            }

            $waveoff_amt = $this->db->query("SELECT COALESCE(SUM(amount),0) AS ttl_amount FROM `tblclientwaveoff`  where client_id IN (".$data['client_branch'].") and status = 1 and service_type = '".$service_type."' ".$createdatefilter." ")->row()->ttl_amount;
            $waveoff_info = $this->db->query("SELECT * FROM `tblclientwaveoff`  where client_id IN (".$data['client_branch'].") and status = 1 and service_type = '".$service_type."' ".$createdatefilter." ")->result();
            $clientrefund_amt = $this->db->query("SELECT COALESCE(SUM(r.amount),0) AS ttl_amount from  tblclientrefund as r LEFT JOIN tblbankpaymentdetails as pd ON r.id = pd.pay_type_id and pd.pay_type = 'client_refund' where client_id IN (".$data['client_branch'].") and pd.utr_no != '' and service_type = '".$service_type."' ".$refubddatefilter." order by r.id desc")->row()->ttl_amount;

            $final_balance = (round($grand_bal) - round($onaccout_amt) - round($waveoff_amt) + round($clientrefund_amt));

            ++$siteheadingcol;
            ++$siteheadingcol;
                $objPHPExcel->getActiveSheet()->SetCellValue("A".$siteheadingcol)->getStyle("A$siteheadingcol:"."I".$siteheadingcol)->applyFromArray($styleArray);
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A$siteheadingcol:"."E".$siteheadingcol);
                $objPHPExcel->getActiveSheet()->SetCellValue("A".$siteheadingcol)->getStyle("A$siteheadingcol:"."E".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                $objPHPExcel->getActiveSheet()->SetCellValue("A$siteheadingcol", "Total Billing")->getStyle("A$siteheadingcol:"."E".$siteheadingcol)->getAlignment()->setHorizontal('center');

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells("F$siteheadingcol:"."I".$siteheadingcol);
                $objPHPExcel->getActiveSheet()->SetCellValue("F".$siteheadingcol)->getStyle("F$siteheadingcol:"."I".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                $objPHPExcel->getActiveSheet()->SetCellValue("F" . $siteheadingcol, number_format($ttl_billing, 2, '.', ''))->getStyle("F$siteheadingcol:"."I".$siteheadingcol)->getAlignment()->setHorizontal('center');

            ++$siteheadingcol;
                $objPHPExcel->getActiveSheet()->SetCellValue("A".$siteheadingcol)->getStyle("A$siteheadingcol:"."I".$siteheadingcol)->applyFromArray($styleArray);
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A$siteheadingcol:"."E".$siteheadingcol);
                $objPHPExcel->getActiveSheet()->SetCellValue("A".$siteheadingcol)->getStyle("A$siteheadingcol:"."E".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                $objPHPExcel->getActiveSheet()->SetCellValue("A$siteheadingcol", "Total Recevied")->getStyle("A$siteheadingcol:"."E".$siteheadingcol)->getAlignment()->setHorizontal('center');

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells("F$siteheadingcol:"."I".$siteheadingcol);
                $objPHPExcel->getActiveSheet()->SetCellValue("F".$siteheadingcol)->getStyle("F$siteheadingcol:"."I".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                $objPHPExcel->getActiveSheet()->SetCellValue("F" . $siteheadingcol, number_format($grand_recevied, 2, '.', ''))->getStyle("F$siteheadingcol:"."I".$siteheadingcol)->getAlignment()->setHorizontal('center');

            ++$siteheadingcol;
                $objPHPExcel->getActiveSheet()->SetCellValue("A".$siteheadingcol)->getStyle("A$siteheadingcol:"."I".$siteheadingcol)->applyFromArray($styleArray);
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A$siteheadingcol:"."E".$siteheadingcol);
                $objPHPExcel->getActiveSheet()->SetCellValue("A".$siteheadingcol)->getStyle("A$siteheadingcol:"."E".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                $objPHPExcel->getActiveSheet()->SetCellValue("A$siteheadingcol", "Total Balance")->getStyle("A$siteheadingcol:"."E".$siteheadingcol)->getAlignment()->setHorizontal('center');

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells("F$siteheadingcol:"."I".$siteheadingcol);
                $objPHPExcel->getActiveSheet()->SetCellValue("F".$siteheadingcol)->getStyle("F$siteheadingcol:"."I".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                $objPHPExcel->getActiveSheet()->SetCellValue("F" . $siteheadingcol, number_format($grand_bal, 2, '.', ''))->getStyle("F$siteheadingcol:"."I".$siteheadingcol)->getAlignment()->setHorizontal('center');

            ++$siteheadingcol;
                $objPHPExcel->getActiveSheet()->SetCellValue("A".$siteheadingcol)->getStyle("A$siteheadingcol:"."I".$siteheadingcol)->applyFromArray($styleArray);
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A$siteheadingcol:"."E".$siteheadingcol);
                $objPHPExcel->getActiveSheet()->SetCellValue("A".$siteheadingcol)->getStyle("A$siteheadingcol:"."E".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                $objPHPExcel->getActiveSheet()->SetCellValue("A$siteheadingcol", "Onaccount")->getStyle("A$siteheadingcol:"."E".$siteheadingcol)->getAlignment()->setHorizontal('center');

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells("F$siteheadingcol:"."I".$siteheadingcol);
                $objPHPExcel->getActiveSheet()->SetCellValue("F".$siteheadingcol)->getStyle("F$siteheadingcol:"."I".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                $objPHPExcel->getActiveSheet()->SetCellValue("F" . $siteheadingcol, "- ".number_format($onaccout_amt, 2, '.', ''))->getStyle("F$siteheadingcol:"."I".$siteheadingcol)->getAlignment()->setHorizontal('center');

            if (!empty($waveoff_info)) {
                foreach ($waveoff_info as $wave_row) {
                    $waveoff_title = (!empty($wave_row->remark)) ? $wave_row->remark : 'Waveoff';
                    $waveoff_sign = ($wave_row->amount > 0) ? '-' : '+';
                    ++$siteheadingcol;
                    $objPHPExcel->getActiveSheet()->SetCellValue("A".$siteheadingcol)->getStyle("A$siteheadingcol:"."I".$siteheadingcol)->applyFromArray($styleArray);
                    $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A$siteheadingcol:"."E".$siteheadingcol);
                    $objPHPExcel->getActiveSheet()->SetCellValue("A".$siteheadingcol)->getStyle("A$siteheadingcol:"."E".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                    $objPHPExcel->getActiveSheet()->SetCellValue("A$siteheadingcol", $waveoff_sign . ' ' . $waveoff_title)->getStyle("A$siteheadingcol:"."E".$siteheadingcol)->getAlignment()->setHorizontal('center');

                    $objPHPExcel->setActiveSheetIndex(0)->mergeCells("F$siteheadingcol:"."I".$siteheadingcol);
                    $objPHPExcel->getActiveSheet()->SetCellValue("F".$siteheadingcol)->getStyle("F$siteheadingcol:"."I".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
                    $objPHPExcel->getActiveSheet()->SetCellValue("F" . $siteheadingcol, number_format($wave_row->amount, 2, '.', ''))->getStyle("F$siteheadingcol:"."I".$siteheadingcol)->getAlignment()->setHorizontal('center');
                }
            }


            if ($clientrefund_amt > 0){
               ++$siteheadingcol;
               $objPHPExcel->getActiveSheet()->SetCellValue("A".$siteheadingcol)->getStyle("A$siteheadingcol:"."I".$siteheadingcol)->applyFromArray($styleArray);
               $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A$siteheadingcol:"."E".$siteheadingcol);
               $objPHPExcel->getActiveSheet()->SetCellValue("A".$siteheadingcol)->getStyle("A$siteheadingcol:"."E".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
               $objPHPExcel->getActiveSheet()->SetCellValue("A$siteheadingcol", "Client Refund")->getStyle("A$siteheadingcol:"."E".$siteheadingcol)->getAlignment()->setHorizontal('center');

               $objPHPExcel->setActiveSheetIndex(0)->mergeCells("F$siteheadingcol:"."I".$siteheadingcol);
               $objPHPExcel->getActiveSheet()->SetCellValue("F".$siteheadingcol)->getStyle("F$siteheadingcol:"."I".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
               $objPHPExcel->getActiveSheet()->SetCellValue("F" . $siteheadingcol, number_format($clientrefund_amt, 2, '.', ''))->getStyle("F$siteheadingcol:"."I".$siteheadingcol)->getAlignment()->setHorizontal('center');

            }
             ++$siteheadingcol;
            $objPHPExcel->getActiveSheet()->SetCellValue("A".$siteheadingcol)->getStyle("A$siteheadingcol:"."I".$siteheadingcol)->applyFromArray($styleArray);
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A$siteheadingcol:"."E".$siteheadingcol);
            $objPHPExcel->getActiveSheet()->SetCellValue("A".$siteheadingcol)->getStyle("A$siteheadingcol:"."E".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
            $objPHPExcel->getActiveSheet()->SetCellValue("A$siteheadingcol", "Final Balance")->getStyle("A$siteheadingcol:"."E".$siteheadingcol)->getAlignment()->setHorizontal('center');

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells("F$siteheadingcol:"."I".$siteheadingcol);
            $objPHPExcel->getActiveSheet()->SetCellValue("F".$siteheadingcol)->getStyle("F$siteheadingcol:"."I".$siteheadingcol)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FFDBE2F1');
            $objPHPExcel->getActiveSheet()->SetCellValue("F" . $siteheadingcol, number_format($final_balance, 2, '.', ''))->getStyle("F$siteheadingcol:"."I".$siteheadingcol)->getAlignment()->setHorizontal('center');

            foreach(range('A','Y') as $columnID) {
                $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
                    ->setAutoSize(true);
            }

            $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
            $objWriter->save($file_name);
            // download file
            header("Content-Type: application/vnd.ms-excel");
            redirect(site_url().$file_name);
    }

    public function internal_billing()
    {
        check_permission('17,18','view');
        $designation_id = get_staff_info(get_staff_user_id())->designation_id;
        if(is_admin() == 1 || in_array($designation_id, [12,28,52])){
            $where = "i.status != 5 AND cb.company_branch = '1'";
        }else{
            $where = "i.status != 5 AND i.addedfrom = '".get_staff_user_id()."' and cb.company_branch = '1'";
        }

        if(!empty($_POST)){
            extract($this->input->post());

            $where_ttl = "i.status != 5 and cb.company_branch = '1'";
            if(!empty($client_id) || !empty($staff_id) || !empty($f_date) || !empty($t_date) || !empty($status)){

                    if(!empty($client_id)){
                        $data['client_id'] = $client_id;
                        $where .= " and i.clientid = '".$client_id."'";
                        $where_ttl .= " and i.clientid = '".$client_id."'";
                    }

                    if(!empty($staff_id)){
                        $data['staff_id'] = $staff_id;
                        $where .= " and i.addedfrom = '".$staff_id."'";
                        $where_ttl .= " and i.addedfrom = '".$staff_id."'";
                    }

                    if(!empty($f_date) && !empty($t_date)){
                        $data['f_date'] = $f_date;
                        $data['t_date'] = $t_date;

                        $f_date = str_replace("/","-",$f_date);
                        $f_date = date("Y-m-d",strtotime($f_date));

                        $t_date = str_replace("/","-",$t_date);
                        $t_date = date("Y-m-d",strtotime($t_date));

                        $where .= " and i.invoice_date between '".$f_date."' and '".$t_date."' ";
                        $where_ttl .= " and i.invoice_date between '".$f_date."' and '".$t_date."' ";
                    }

                    if(!empty($status)){
                        $data['status'] = $status;
                        $where .= " and i.status = '".$status."'";
                        $where_ttl .= " and i.status = '".$status."'";
                    }

            }
        }else{
            $where .= " and i.year_id = '".financial_year()."'";
            $where_ttl = "i.status != 5 and i.year_id = '".financial_year()."' and cb.company_branch = '1'";
        }


       $data['invoice_list'] = $this->db->query("SELECT i.* FROM `tblinvoices` as i LEFT JOIN `tblclientbranch` as cb ON i.clientid = cb.userid WHERE ".$where." ORDER BY id DESC ")->result();

       $data['invoice_amount'] = $this->db->query("SELECT sum(total) as ttl_amt from `tblinvoices` as i LEFT JOIN `tblclientbranch` as cb ON i.clientid = cb.userid WHERE ".$where_ttl." ")->row()->ttl_amt;

       $data['taxable_value'] = $this->db->query("SELECT sum(total_tax) as tax_val from `tblinvoices` as i LEFT JOIN `tblclientbranch` as cb ON i.clientid = cb.userid WHERE ".$where_ttl." ")->row()->tax_val;

        $data['client_data'] = $this->db->query("SELECT `client_branch_name`,`userid` from `tblclientbranch` WHERE company_branch = '1' ORDER BY client_branch_name ASC ")->result();
        $data['staff_list'] = get_staff_list();

        $data['title'] = 'Internal Billing List';
        $this->load->view('admin/invoices/internal_billing_list', $data);

    }

    public function internal_billing_export()
    {
        $where = "i.status != 5 and cb.company_branch = '1'";

        if(!empty($_GET)){
            extract($this->input->get());

            if(!empty($client_id) || !empty($staff_id) || !empty($f_date) || !empty($t_date) || !empty($status)){
                if(!empty($client_id)){
                    $where .= " and i.clientid = '".$client_id."'";
                }

                if(!empty($staff_id)){
                    $where .= " and i.addedfrom = '".$staff_id."'";
                }

                if(!empty($f_date) && !empty($t_date)){
                    $where .= " and i.invoice_date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
                }

                if(!empty($status)){
                    $where .= " and i.status = '".$status."'";
                }
            }else{
                $where .= " and i.year_id = '".financial_year()."'";
            }
        }else{
            $where .= " and i.year_id = '".financial_year()."'";
        }

        // create file name
        $fileName = 'internal billing invoice.xlsx';
        // load excel library
        $this->load->library('excel');

//        $invoice_list = $this->db->query("SELECT * from `tblinvoices` where ".$where." ORDER BY id desc ")->result();
    $invoice_list = $this->db->query("SELECT * FROM `tblinvoices` as i LEFT JOIN `tblclientbranch` as cb ON i.clientid = cb.userid WHERE ".$where." ORDER BY id DESC ")->result();
//        echo $this->db->last_query();
//        exit;
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);


        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Service Type : '.$service_type.'');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J3');
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date : '.date('d/m/Y').'');


        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Company GST Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Client Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Client GST Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Invoice Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Service Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Invoice Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Total Invoice Value');
        $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'Total Taxable Value');
        $objPHPExcel->getActiveSheet()->SetCellValue('J4', 'CGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('K4', 'SGST');
        $objPHPExcel->getActiveSheet()->SetCellValue('L4', 'IGST');
        // set Row
        $rowCount = 5;
        $i = 1;
        foreach ($invoice_list as $val)
        {
            $client_info = $this->db->query("SELECT `client_branch_name`,`vat` from `tblclientbranch` where userid = '".$val->clientid."'  ")->row();
            $service_type = ($val->service_type == 1) ? "Rent" : "Sales";
            $cgst = '--';
            $sgst = '--';
            $igst = '--';
            if($val->tax_type == 1){
                $tax = ($val->total_tax/2);
                $sgst = number_format(round($tax), 2, '.', '');
                $cgst = number_format(round($tax), 2, '.', '');
            }else{
                $igst = $val->total_tax;
            }

            $billing_info = get_branch_details($val->billing_branch_id);

            $taxable_value = ($val->total-$val->total_tax);

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $billing_info['gst']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $client_info->client_branch_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $client_info->vat);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, format_invoice_number($val->id));
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $service_type);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, _d($val->invoice_date));
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $val->total);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $taxable_value);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $cgst);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $sgst);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $igst);

            $i++;
            $rowCount++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(site_url().$fileName);



    }

    public function clientbalancesheet($client_id='',$page = '')
    {
        $data['client_info'] = $this->db->query("SELECT * FROM tblclients order by company asc")->result();
        check_permission(377,'view');
        if ($this->input->post()) {
            extract($this->input->post());

            $site_arr = array();
            if(empty($site_id)){
                $client_str = implode(",",$client_branch);
                $site_info = $this->db->query("SELECT i.site_id FROM tblinvoices as  i LEFT JOIN tblsitemanager as s ON i.site_id = s.id where i.clientid IN (".$client_str.") and i.site_id > 0  GROUP By i.site_id ORDER by i.id DESC")->result();
                if(!empty($site_info)){
                    foreach ($site_info as $s_id) {
                       $site_arr[] = $s_id->site_id;
                    }
                    $data['site_ids'] = $site_arr;
                }
            }else{
                $data['site_ids'] = $site_id;
            }


            $data['client_id'] = $client_id;
            $data['f_date'] = $data['t_date'] = '';
            if (!empty($f_date) && !empty($t_date)){
                $data['f_date'] = $f_date;
                $data['t_date'] = $t_date;
            }
            $data['client_branch'] = $client_branch;
            $data['flow'] = $flow;
            $data['service_type'] = $service_type;
        }

        $data['title'] = 'Client Tally Type Report';

        $this->load->view('admin/invoices/client_balance_sheet', $data);
    }

    function addsendemaildate(){
        if ($this->input->post()) {
            extract($this->input->post());

            $update = false;
            if ($section == "invoice"){
               $redirect = ($type == 'sales') ? 'invoices/list' : 'invoices/rent_list';
               $update = $this->home_model->update("tblinvoices", array("email_send_date"=> db_date($email_send_date)), array("id" => $rel_id));
            }else if($section == "CN"){
              $redirect = 'creditnotes';
               $update = $this->home_model->update("tblcreditnote", array("email_send_date"=> db_date($email_send_date)), array("id" => $rel_id));
            }else if($section == "DN"){
               $redirect = 'debit_note';
               $update = $this->home_model->update("tbldebitnote", array("email_send_date"=> db_date($email_send_date)), array("id" => $rel_id));
            }
            if($update){
                set_alert('success', "Send Email Date updated successfully");
                redirect(admin_url($redirect));
            }
        }
    }

    function add_courier_info(){
      if ($this->input->post()) {
          extract($this->input->post());
          if ($rel_type == "invoice"){
             $redirect = ($type == 'sales') ? 'invoices/list' : 'invoices/rent_list';
          }else if($rel_type == "CN"){
             $redirect = 'creditnotes';
          }else if($rel_type == "DN"){
             $redirect = 'debit_note';
          }

          if (!empty($courier_name)){

              $courier_info = $this->db->query("SELECT `id`,`files` FROM `tblcouriersend` WHERE `rel_type` = 'invoice' and `rel_id` = '".$rel_id."' ")->row();

              $insertdata = array(
                "rel_id" => $rel_id,
                "rel_type" => $rel_type,
                "courier_name" => $courier_name,
                "tracking_number" => $tracking_number,
                "date" => db_date($courier_date),
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
              );
              if (!empty($courier_info)){
                 unset($insertdata["created_at"]);
                 $this->home_model->update("tblcouriersend", $insertdata, array("id" => $courier_info->id));
                 $insert_id = $courier_info->id;
              }else{
                 $insert_id = $this->home_model->insert("tblcouriersend", $insertdata);
              }

              if($insert_id){
                if (isset($_FILES['courier_file'])){
                  $path = get_upload_path_by_type('courier_files');

                  $dataInfo = array();
                  $cpt = count($_FILES['courier_file']['name']);
                  for($i=0; $i<$cpt; $i++)
                  {
                      // Get the temp file path
                      $tmpFilePath = $_FILES['courier_file']['tmp_name'][$i];
                      if (!empty($tmpFilePath) && $tmpFilePath != '') {
                          _maybe_create_upload_path($path);

                          $filename = $_FILES['courier_file']['name'][$i];
                          $newFilePath = $path . $filename;
                          // Upload the file into the temp dir
                          if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                              $dataInfo[] = $filename;
                          }
                      }
                  }

                    if (!empty($dataInfo)){
                        $courier_files = json_encode($dataInfo);
                        $this->home_model->update('tblcouriersend', array("files" => $courier_files), array("rel_id" => $rel_id, "rel_type" => $rel_type));

                        /* remove old files */
                        if (!empty($courier_info)){
                            $filesdata = json_decode($courier_info->files);
                            foreach ($filesdata as $k => $file1) {
                               unlink($path.$file1);
                            }
                        }
                    }
                }
                  set_alert('success', "Courier Details added successfully");
              }
          }
          redirect(admin_url($redirect));
       }

    }

    function load_certificate_list($invoice_id){
        $data["title"] = "Load Test Certificate";
        $data["invoice_id"] = $invoice_id;
        $data["certificate_list"] = $this->db->query("SELECT * FROM tblloadtestcertificate WHERE `invoice_id`='".$invoice_id."' AND status=1 ORDER BY id DESC")->result();
        $this->load->view("admin/invoices/load_certificate_list", $data);
    }

    function add_load_certificate($invoice_id, $certificate_id = ''){
        $chkinvoice = $this->db->query("SELECT `product_type` FROM tblinvoices WHERE id='".$invoice_id."'")->row();
        if (!empty($chkinvoice)){
            $ptype = value_by_id("tblproducttypemaster", $chkinvoice->product_type, "name");
            if ($ptype != 'Alu Scaffolding'){
                set_alert('danger', "Certificate will only create for Aluminum Scaffolding");
                redirect(admin_url("invoices/load_certificate_list/".$invoice_id));
            }
        }
        if (!empty($_POST)){
            extract($this->input->post());
            $adddata = array(
                "invoice_id" => $invoice_id,
                "certificate_number" => $certificate_no,
                "date" => db_date($date),
                "width_type" => $width_type,
                "tested_by" => $tested_by,
                "remark" => $remark,
                "note" => $note,
                "added_by" => get_staff_user_id(),
                "status" => 1,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            );
            if ($certificate_id != ''){
                unset($adddata["created_at"]);
                unset($adddata["added_by"]);
                $this->home_model->update("tblloadtestcertificate", $adddata, array('id' => $certificate_id));
                $insert_id = $certificate_id;
            }else{
                $insert_id = $this->home_model->insert("tblloadtestcertificate", $adddata);
            }
            
            if (!empty($insert_id)){

                if ($certificate_id != ''){
                    $this->home_model->delete("tblloadtestcertificate_items", array("certificate_id" => $certificate_id));
                }
                
                if (isset($invoice_item) && !empty($invoice_item)){
                    foreach ($invoice_item as $value) {
                        $certificate_item = array(
                            "certificate_id" => $insert_id,
                            "item_id" => $value["item_id"],
                            "load_cap" => $value["load_cap"],
                            "load_applied" => $value["load_applied"],
                            "remark" => $value["remarks"],
                            "spl_remark" => $value["spl_remarks"],
                            "created_at" => date("Y-m-d H:i:s"),
                            "updated_at" => date("Y-m-d H:i:s")
                        );
                        $this->home_model->insert("tblloadtestcertificate_items", $certificate_item);
                    }
                }
                set_alert('success', "load Certificate Created successfully");
                redirect(admin_url("invoices/load_certificate_list/".$invoice_id));
            }else{
                set_alert('warning', "Something went wrong");
                redirect(admin_url("invoices/add_load_certificate/".$invoice_id));
            }
        }
        
        if ($certificate_id != ''){
            $data["title"] = "Edit Load Certificate";
            $data["certificate_info"] = $this->db->query("SELECT * FROM tblloadtestcertificate WHERE id = '".$certificate_id."' ")->row();
            $data["certificate_items"] = $this->db->query("SELECT * FROM tblloadtestcertificate_items WHERE certificate_id = '".$certificate_id."' ")->result();
        }else{
            $data["title"] = "Add Load Certificate";
            $data["invoice_products"] = $this->db->query("SELECT * FROM `tblitems_in` WHERE `rel_id` = '".$invoice_id."' AND `rel_type`='invoice' ")->result();
        }
        
        $data["invoice_id"] = $invoice_id;
        
        $data['stafflist'] = $this->db->query("SELECT * FROM tblstaff WHERE active=1 ORDER BY firstname ASC")->result();
        $this->load->view("admin/invoices/add_load_certificate", $data);
    }

    public function load_certificate_pdf($certificate_id){

        $certificate_info = $this->db->query("SELECT * FROM tblloadtestcertificate WHERE id = '".$certificate_id."' ")->row();
        $file_name = $certificate_info->certificate_number;

        $html = load_certificate_pdf($certificate_info);
        // echo $html;
        // exit;
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

        $dompdf->stream($file_name, array("Attachment" => false));
    }

    /* this is for delete load certificate */
    public function delete_load_certificate($certificate_id){
        $certificate_info = $this->db->query("SELECT * FROM tblloadtestcertificate WHERE id = '".$certificate_id."' ")->row();
        if (!empty($certificate_info)){
            $response = $this->home_model->delete("tblloadtestcertificate", array("id" => $certificate_id));
            if ($response == TRUE){
                $this->home_model->delete("tblloadtestcertificate_items", array("certificate_id" => $certificate_id));
                set_alert('success', "load certificate delete successfully");
            }else{
                set_alert('warning', "Something went wrong");
            }
        }
        redirect(admin_url("invoices/load_certificate_list/".$certificate_info->invoice_id));
    }

    /* This is sales invoices list for sales parson */
    public function sales_person_invoice()
    {
        $where = "cb.company_branch = '0' and i.year_id = '".financial_year()."'";
        $where_ttl = "i.status != 5 and i.year_id = '".financial_year()."' and cb.company_branch = '0'";
        if(!empty($_POST)){
            extract($this->input->post());
            if(!empty($client_id) || !empty($service_type) || !empty($f_date) || !empty($t_date) || !empty($status)){

                $where = "cb.company_branch = '0'";
                $where_ttl = "i.status != 5 and cb.company_branch = '0'";

                if(!empty($client_id)){
                    $data['client_id'] = $client_id;
                    $where .= " and i.clientid = '".$client_id."'";
                    $where_ttl .= " and i.clientid = '".$client_id."'";
                }

                if(!empty($f_date) && !empty($t_date)){
                    $data['f_date'] = $f_date;
                    $data['t_date'] = $t_date;

                    $where .= " and i.invoice_date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
                    $where_ttl .= " and i.invoice_date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
                }

                if(!empty($status)){
                    $data['status'] = $status;
                    $where .= " and i.status = '".$status."'";
                    $where_ttl .= " and i.status = '".$status."'";
                }

                if(!empty($service_type)){
                    $data['service_type'] = $service_type;
                    $where .= " and i.service_type = '".$service_type."'";
                    $where_ttl .= " and i.service_type = '".$service_type."'";
                }
            }
        }
        
        $data['invoice_list'] = $this->db->query("SELECT i.* FROM `tblinvoices` as i LEFT JOIN `tblleadassignstaff` as l ON l.lead_id = i.lead_id LEFT JOIN `tblclientbranch` as cb ON i.clientid = cb.userid WHERE ".$where." and l.staff_id = '".get_staff_user_id()."' AND l.type = 2 ORDER BY id DESC ")->result();
        $data['invoice_amount'] = $this->db->query("SELECT COALESCE(SUM(total),0) as ttl_amt  from `tblinvoices` as i LEFT JOIN `tblleadassignstaff` as l ON l.lead_id = i.lead_id LEFT JOIN `tblclientbranch` as cb ON i.clientid = cb.userid WHERE ".$where_ttl." and l.staff_id = '".get_staff_user_id()."' AND l.type = 2 ")->row()->ttl_amt;

        $data['taxable_value'] = $this->db->query("SELECT COALESCE(SUM(total_tax),0) as tax_val  from `tblinvoices` as i LEFT JOIN `tblleadassignstaff` as l ON l.lead_id = i.lead_id LEFT JOIN `tblclientbranch` as cb ON i.clientid = cb.userid WHERE ".$where_ttl." and l.staff_id = '".get_staff_user_id()."' AND l.type = 2")->row()->tax_val;

        $data['client_data'] = $this->db->query("SELECT `client_branch_name`,`userid`,`email_id`,`phone_no_1` FROM `tblclientbranch` WHERE `active` = 1 AND `client_branch_name` !='' AND company_branch = '0' ORDER BY `client_branch_name` ASC")->result();
        $data['title'] = 'My Sales Invoices';
        $this->load->view('admin/invoices/sales_person_invoice_list', $data);
    }

    //this is a temprory report for priyanka
    public function invoce_export()
    {

        $data['invoice_list'] = $this->db->query("SELECT i.id,i.number FROM tblinvoices as i LEFT JOIN tbltermsandconditionsdetails as tc ON i.id = tc.rel_id where i.year_id = 7 and i.parent_id = 0  and i.transportation_charges = 0 and tc.document_name = 'invoice' and tc.value1 = 'Included' and tc.master_id = 6 GROUP by i.id ")->result();

        $this->load->view('admin/invoices/invoce_export', $data);

    }
}
