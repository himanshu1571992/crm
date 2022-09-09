<?php

defined('BASEPATH') or exit('No direct script access allowed');
define('EMAIL_TEMPLATE_SEND', true);
class Emails_model extends CRM_Model
{
    private $attachment = [];

    private $client_email_templates;

    private $staff_email_templates;

    private $rel_id;

    private $rel_type;

    private $staff_id;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('email');
        $this->client_email_templates = get_client_email_templates_slugs();
        $this->staff_email_templates  = get_staff_email_templates_slugs();
    }

    /**
     * @param  string
     * @return array
     * Get email template by type
     */
    public function get($where = [])
    {
        $this->db->where($where);

        return $this->db->get('tblemailtemplates')->result_array();
    }

    /**
     * @param  integer
     * @return object
     * Get email template by id
     */
    public function get_email_template_by_id($id)
    {
        $this->db->where('emailtemplateid', $id);

        return $this->db->get('tblemailtemplates')->row();
    }

    /**
     * Create new email template
     * @param mixed $data
     */
    public function add_template($data)
    {
        $this->db->insert('tblemailtemplates', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            return $insert_id;
        }

        return false;
    }

    /**
     * @param  array $_POST data
     * @param  integer ID
     * @return boolean
     * Update email template
     */
    public function update($data)
    {
        if (isset($data['plaintext'])) {
            $data['plaintext'] = 1;
        } else {
            $data['plaintext'] = 0;
        }

        if (isset($data['disabled'])) {
            $data['active'] = 0;
            unset($data['disabled']);
        } else {
            $data['active'] = 1;
        }
        $main_id      = false;
        $affectedRows = 0;
        $i            = 0;
        foreach ($data['subject'] as $id => $val) {
            if ($i == 0) {
                $main_id = $id;
            }

            $_data              = [];
            $_data['subject']   = $val;
            $_data['fromname']  = $data['fromname'];
            $_data['fromemail'] = $data['fromemail'];
            $_data['message']   = $data['message'][$id];
            $_data['plaintext'] = $data['plaintext'];
            $_data['active']    = $data['active'];

            $this->db->where('emailtemplateid', $id);
            $this->db->update('tblemailtemplates', $_data);
            if ($this->db->affected_rows() > 0) {
                $affectedRows++;
            }

            $i++;
        }
        $main_template = $this->get_email_template_by_id($main_id);

        if ($affectedRows > 0 && $main_template) {
            logActivity('Email Template Updated [' . $main_template->name . ']');

            return true;
        }

        return false;
    }

    /**
     * Change template to active/inactive
     * @param  string $slug    template slug
     * @param  mixed $enabled enabled or disabled / 1 or 0
     * @return boolean
     */
    public function mark_as($slug, $enabled)
    {
        $this->db->where('slug', $slug);
        $this->db->update('tblemailtemplates', ['active' => $enabled]);

        return $this->db->affected_rows() > 0 ? true : false;
    }

    /**
     * Change template to active/inactive
     * @param  string $type    template type
     * @param  mixed $enabled enabled or disabled / 1 or 0
     * @return boolean
     */
    public function mark_as_by_type($type, $enabled)
    {
        $this->db->where('type', $type);
        $this->db->update('tblemailtemplates', ['active' => $enabled]);

        return $this->db->affected_rows() > 0 ? true : false;
    }

    /**
     * Send email - No templates used only simple string
     * @since Version 1.0.2
     * @param  string $email   email
     * @param  string $message message
     * @param  string $subject email subject
     * @return boolean
     */
    public function send_simple_email($email, $subject, $message)
    {
        $cnf = [
            'from_email' => get_option('smtp_email'),
            'from_name'  => get_option('companyname'),
            'email'      => $email,
            'subject'    => $subject,
            'message'    => $message,
        ];

        // Simulate fake template to be parsed
        $template           = new StdClass();
        $template->message  = get_option('email_header') . $cnf['message'] . get_option('email_footer');
        $template->fromname = $cnf['from_name'];
        $template->subject  = $cnf['subject'];

        $template = parse_email_template($template);

        $cnf['message']   = $template->message;
        $cnf['from_name'] = $template->fromname;
        $cnf['subject']   = $template->subject;

        $cnf['message'] = check_for_links($cnf['message']);

        $cnf = do_action('before_send_simple_email', $cnf);

        if (isset($cnf['prevent_sending']) && $cnf['prevent_sending'] == true) {
            $this->clear_attachments();

            return false;
        }
        $this->load->config('email');
        $this->email->clear(true);
        $this->email->set_newline(config_item('newline'));
        $this->email->from($cnf['from_email'], $cnf['from_name']);
        $this->email->to($cnf['email']);

        $bcc = '';
        // Used for action hooks
        if (isset($cnf['bcc'])) {
            $bcc = $cnf['bcc'];
            if (is_array($bcc)) {
                $bcc = implode(', ', $bcc);
            }
        }

        $systemBCC = get_option('bcc_emails');
        if ($systemBCC != '') {
            if ($bcc != '') {
                $bcc .= ', ' . $systemBCC;
            } else {
                $bcc .= $systemBCC;
            }
        }
        if ($bcc != '') {
            $this->email->bcc($bcc);
        }

        if (isset($cnf['cc'])) {
            $this->email->cc($cnf['cc']);
        }

        if (isset($cnf['reply_to'])) {
            $this->email->reply_to($cnf['reply_to']);
        }

        $this->email->subject($cnf['subject']);
        $this->email->message($cnf['message']);

        $this->email->set_alt_message(strip_html_tags($cnf['message'], '<br/>, <br>, <br />'));

        if (count($this->attachment) > 0) {
            foreach ($this->attachment as $attach) {
                if (!isset($attach['read'])) {
                    $this->email->attach($attach['attachment'], 'attachment', $attach['filename'], $attach['type']);
                } else {
                    if (!isset($attach['filename']) || (isset($attach['filename']) && empty($attach['filename']))) {
                        $attach['filename'] = basename($attach['attachment']);
                    }
                    $this->email->attach($attach['attachment'], '', $attach['filename']);
                }
            }
        }

        $this->clear_attachments();
        if ($this->email->send()) {
            logActivity('Email sent to: ' . $cnf['email'] . ' Subject: ' . $cnf['subject']);

            return true;
        }

        return false;
    }

    /**
     * Send email template
     * @param  string $template_slug email template slug
     * @param  string $email         email to send
     * @param  array $merge_fields  merge field
     * @param  string $ticketid      used only when sending email templates linked to ticket / used for piping
     * @param  mixed $cc
     * @return boolean
     */
    public function send_email_template($template_slug, $email, $merge_fields, $ticketid = '', $cc = '')
    {
        $email = do_action('send_email_template_to', $email);

        $template                     = get_email_template_for_sending($template_slug, $email);
        $staff_email_templates_slugs  = get_staff_email_templates_slugs();
        $client_email_templates_slugs = get_client_email_templates_slugs();

        $inactive_user_table_check = '';

        /**
         * Dont send email templates for non active contacts/staff
         * Do checking here
         */
        if (in_array($template_slug, $staff_email_templates_slugs)) {
            $inactive_user_table_check = 'tblstaff';
        } elseif (in_array($template_slug, $client_email_templates_slugs)) {
            $inactive_user_table_check = 'tblcontacts';
        }

        /**
         * Is really inactive?
         */
        if ($inactive_user_table_check != '') {
            $this->db->select('active')->where('email', $email);
            $user = $this->db->get($inactive_user_table_check)->row();
            if ($user && $user->active == 0) {
                $this->clear_attachments();
                $this->set_staff_id(null);

                return false;
            }
        }

        /**
         * Template not found?
         */
        if (!$template) {
            logActivity('Failed to send email template [Template not found]');
            $this->clear_attachments();
            $this->set_staff_id(null);

            return false;
        }

        /**
         * Template is disabled or invalid email?
         * Log activity
         */
        if ($template->active == 0 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->clear_attachments();

            $this->db->where('language', 'english');
            $this->db->where('slug', $template->slug);
            $tmpTemplate = $this->db->get('tblemailtemplates')->row();

            if (!$tmpTemplate) {
                logActivity('Failed to send email template [<a href="' . admin_url('emails/email_template/' . $tmpTemplate->emailtemplateid) . '">' . $template->name . '</a>] [Reason: Email template is disabled.]');
            }

            return false;
        }

        $template = do_action('before_parse_email_template_message', $template);

        $template = parse_email_template($template, $merge_fields);

        //adding company signatur 
        $template->message = $template->message. get_company_signature();
       
        $template = do_action('after_parse_email_template_message', $template);

        $template->message = get_option('email_header') . $template->message . get_option('email_footer');

        // Parse merge fields again in case there is merge fields found in email_header and email_footer option.
        // We cant parse this in parse_email_template function because in case the template content is send via $_POST wont work
        $template = _parse_email_template_merge_fields($template, $merge_fields);

        /**
         * Template is plain text?
         */
        if ($template->plaintext == 1) {
            $this->config->set_item('mailtype', 'text');
            $template->message = strip_html_tags($template->message, '<br/>, <br>, <br />');
        }

        $fromemail = $template->fromemail;
        $fromname  = $template->fromname;

        if ($fromemail == '') {
            $fromemail = get_option('smtp_email');
        }
        if ($fromname == '') {
            $fromname = get_option('companyname');
        }

        /**
         * Ticket variables
        */
        $reply_to               = false;
        $from_header_dept_email = false;
        /**
         * Tickets template
         * For tickets there is different config
         */
        if (is_numeric($ticketid) && $template->type == 'ticket') {
            if (!class_exists('tickets_model')) {
                $this->load->model('tickets_model');
            }

            $this->db->select('tbldepartments.email as department_email, email_from_header as dept_email_from_header')
            ->where('ticketid', $ticketid)
            ->join('tbldepartments', 'tbldepartments.departmentid=tbltickets.department', 'left');

            $ticket = $this->db->get('tbltickets')->row();

            if (!empty($ticket->department_email) && filter_var($ticket->department_email, FILTER_VALIDATE_EMAIL)) {
                $reply_to               = $ticket->department_email;
                $from_header_dept_email = $ticket->dept_email_from_header == 1;
            }
            /**
             * IMPORTANT
             * Do not change/remove this line, this is used for email piping so the software can recognize the ticket id.
             */
            if (substr($template->subject, 0, 10) != '[Ticket ID') {
                $template->subject = '[Ticket ID: ' . $ticketid . '] ' . $template->subject;
            }
        }

        $hook_data['template']    = $template;
        $hook_data['email']       = $email;
        $hook_data['attachments'] = $this->attachment;

        $hook_data['template']->message = check_for_links($hook_data['template']->message);

        $hook_data = do_action('before_email_template_send', $hook_data);

        $template    = $hook_data['template'];
        $email       = $hook_data['email'];
        $attachments = $hook_data['attachments'];

        if (isset($template->prevent_sending) && $template->prevent_sending == true) {
            $this->clear_attachments();
            $this->set_staff_id(null);

            return false;
        }

        $this->load->config('email');
        $this->email->clear(true);
        $this->email->set_newline(config_item('newline'));
        $this->email->from(($from_header_dept_email ? $ticket->department_email : $fromemail), $fromname);
        $this->email->subject($template->subject);

        $this->email->message($template->message);
        $this->email->to($email);

        $bcc = '';
        // Used for action hooks
        if (isset($template->bcc)) {
            $bcc = $template->bcc;
            if (is_array($bcc)) {
                $bcc = implode(', ', $bcc);
            }
        }

        $systemBCC = get_option('bcc_emails');
        if ($systemBCC != '') {
            if ($bcc != '') {
                $bcc .= ', ' . $systemBCC;
            } else {
                $bcc .= $systemBCC;
            }
        }

        if ($bcc != '') {
            $bcc = array_map('trim', explode(',', $bcc));
            $bcc = array_unique($bcc);
            $bcc = implode(', ', $bcc);
            $this->email->bcc($bcc);
        }

        if ($reply_to != false) {
            $this->email->reply_to($reply_to);
        } elseif (isset($template->reply_to)) {
            $this->email->reply_to($template->reply_to);
        }

        if ($template->plaintext == 0) {
            $alt_message = strip_html_tags($template->message, '<br/>, <br>, <br />');
            // Replace <br /> with \n
            $alt_message = clear_textarea_breaks($alt_message, "\r\n");
            $this->email->set_alt_message($alt_message);
        }

        if (is_array($cc) || !empty($cc)) {
            $this->email->cc($cc);
        }

        if (count($attachments) > 0) {
            foreach ($attachments as $attach) {
                if (!isset($attach['read'])) {
                    $this->email->attach($attach['attachment'], 'attachment', $attach['filename'], $attach['type']);
                } else {
                    $this->email->attach($attach['attachment'], '', $attach['filename']);
                }
            }
        }

        $this->clear_attachments();
        $this->set_staff_id(null);

        if ($this->email->send()) {
            logActivity('Email Send To [Email: ' . $email . ', Template: ' . $template->name . ']');
            do_action('email_template_sent', ['template' => $template, 'email' => $email]);

            return true;
        }
        if (ENVIRONMENT !== 'production') {
            logActivity('Failed to send email template - ' . $this->email->print_debugger());
        }


        return false;
    }

    /**
     * @param resource
     * @param string
     * @param string (mime type)
     * @return none
     * Add attachment to property to check before an email is send
     */
    public function add_attachment($attachment)
    {
        $this->attachment[] = $attachment;
    }

    /**
     * @return none
     * Clear all attachment properties
     */
    private function clear_attachments()
    {
        $this->attachment = [];
    }

    public function set_rel_id($rel_id)
    {
        $this->rel_id = $rel_id;
    }

    public function set_rel_type($rel_type)
    {
        $this->rel_type = $rel_type;
    }

    public function get_rel_id()
    {
        return $this->rel_id;
    }

    public function get_rel_type()
    {
        return $this->rel_type;
    }

    public function set_staff_id($id)
    {
        $this->staff_id = $id;
    }

    public function get_staff_id()
    {
        return $this->staff_id;
    }
    
    public function send_mail($rel_id, $module_name, $module_temp_id, $module_data, $sent_to, $message_body, $cc = ""){
        
        require_once APPPATH.'third_party/email_config.php';
        $response = FALSE;

        $module_attech = $this->input->post("module_attech");
        $email_to = $this->input->post("email_to");
        $from_email = $this->input->post("from_email");
        $from_name = $this->input->post("from_name");
        $staff_cc = $this->input->post("staff_cc");
        $sent_to = ($email_to != "") ? array_merge($sent_to, explode(",", $email_to)) : $sent_to;
        $cc = (isset($staff_cc)) ? array_merge($staff_cc, explode(",", $cc)) : $cc;
        
        $template_info = $this->db->query("SELECT * FROM tblemailmoduletemplate WHERE id = ".$module_temp_id." AND status = 1")->row();
        
        if (!empty($template_info)){

            $email_message = $this->get_email_message($rel_id, $module_name, $module_data, $message_body);

            if ($email_message["message"] != "" && (!empty($sent_to))){
                
                $subject = strtr($template_info->subject, $email_message["subject_data"]);
                $this->email->from($from_email, $from_name);
                $this->email->to($sent_to);
                $this->email->subject($subject);
                $this->email->message($email_message["message"]);
                if (is_array($cc) || !empty($cc)) {
                    $this->email->cc($cc);
                }
                
                /* this is use for attach all uploaded files with mails */
                $i = 0;
                if (isset($_FILES["attach_files"]["tmp_name"])){
                    foreach ($_FILES["attach_files"]["tmp_name"] as $attach) {

                        $this->email->attach("$attach", '', $_FILES["attach_files"]["name"][$i]);

                      $i++;    
                    }
                }
                
                /* this is for check module attechment files */
                if (isset($module_attech) OR !empty($module_attech)){
                    foreach ($module_attech as $attach_file) {
                        $path = get_upload_path_by_type("email_template").$module_temp_id."/".$attach_file;
                        $this->email->attach("$path", '', $attach_file);
                    }
                }
                
                /* this is use for send product drawing */
                if (isset($email_message["product_ids"]) && !empty($email_message["product_ids"])){
                    $pro_ids = explode(",", $email_message["product_ids"]);
                  
                    foreach ($pro_ids as $pid) {
                        $drawing = $this->db->query("SELECT `file_name` FROM tblproductfiles WHERE `rel_id` = '".$pid."' AND `rel_type` = 'drawing' AND `file_name` != ''")->row();
                        if (!empty($drawing) && !empty($drawing->file_name)){
                            $dpath = get_upload_path_by_type('product_drawing').$drawing->file_name;
                            $this->email->attach("$dpath", '', $drawing->file_name);
                        }
                    }
                }
                
                /* this is use for send document */
                if (isset($email_message["document"]) && !empty($email_message["document"])){
                    $document_path = $email_message["document"];
                    $file_name = $email_message["document_number"].".pdf";
//                    $docpath = TEMP_FOLDER."$file_name";
                    $docpath = TEMP_FOLDER.time().".pdf";
                    if(file_put_contents($docpath,  file_get_contents($document_path))) {
                        $this->email->attach("$docpath", '', $file_name);
                    } 
                    unlink($docpath);
                }
                
                $res = $this->email->send();
                if ($res){
                    /* store send email log */
                    $staff_id = get_staff_user_id();
                    $mail_cc = (!empty($cc)) ? json_encode($cc) : "";
                    $logdata = array(
                      "staff_id" => $staff_id,
                      "template_id" => $module_temp_id,  
                      "rel_id" => $rel_id,  
                      "message" => $email_message["message"],  
                      "mail_to" => json_encode($sent_to), 
                      "mail_cc" => $mail_cc, 
                      "created_date" => date("Y-m-d H:i:s"), 
                    );
                    $this->db->insert('tblsendemaillog', $logdata);
                    $response = TRUE;
                }
            }
        }
        return $response;
    }
    
    public function get_email_message($rel_id, $module_name, $module_data, $message_body){
        
        $mail_fields = [];
        $template_fields = $this->db->query("SELECT slug FROM tblemailtemplatesfields WHERE status = 1")->result();
        if ($template_fields){
            foreach ($template_fields as $value) {
                array_push($mail_fields, $value->slug);
            }
        }
        $company_data = get_company_details();
        $company_name = $company_data["company_name"];
        $company_signature = get_company_signature(get_staff_user_id());
        $getproducts = $document_path = $purl = $document_number = $client_name = "";
        switch ($module_name) {
            case "leads":
                
                $quotation_info = $this->db->query("SELECT `total` FROM `tblproposals` WHERE total > 0 and `rel_id` = '".$rel_id."' order by id desc  ")->row();
                $amount = (!empty($quotation_info)) ? $quotation_info->total : '0.00';
                $cinfo = $this->get_client_info($module_data, $module_data->client_id);
                $document_number = $module_data->leadno;
                $client_name = $cinfo["client_name"];
                /* this is for check product drawing have to send or not */
                if ((strpos($message_body, '{product_drawing}') !== false)){
                    $message_body = str_replace("{product_drawing}","",$message_body);
                    $getproducts = $this->db->query("SELECT GROUP_CONCAT(`product_id`) as ids FROM `tblproductinquiry` WHERE `enquiry_id` = '".$rel_id."'")->row();
                    $getproducts = (!empty($getproducts)) ? $getproducts->ids : "";
                }
                
                $m_change_var = array($company_name, $cinfo["client_name"], $cinfo["client_contact_no"], $cinfo["client_address"], $cinfo["client_state"], $cinfo["client_city"], $cinfo["client_zip"], $module_data->leadno, $amount, _d($module_data->enquiry_date), "", $company_signature);	
                break;
            case "proposals":
                
                $amount = $module_data->total;
                $state = get_state($module_data->state);
                $city = get_city($module_data->city);
                $document_number = $module_data->number;
                $client_name = $module_data->proposal_to;
                
                /* this is for check product drawing have to send or not */
                if ((strpos($message_body, '{product_drawing}') !== false)){
                    $message_body = str_replace("{product_drawing}","",$message_body);
                    $getproducts = $this->db->query("SELECT GROUP_CONCAT(`pro_id`) as ids FROM `tblitems_in` WHERE `rel_id` = '".$rel_id."' AND `rel_type` = 'proposal'")->row();
                    $getproducts = (!empty($getproducts)) ? $getproducts->ids : "";
                }
                
                $purl = site_url("General_API/download_pdf/proposals/".$module_data->id);
                $pdf_url = '<a href="'.$purl.'" class="actionBtn" title="PDF">'.$module_data->number.'</a>';
                
                $m_change_var = array($company_name, $module_data->proposal_to, $module_data->phone, $module_data->address, $state, $city, $module_data->zip, $module_data->number, $amount, _d($module_data->date), $pdf_url, $company_signature);	
                break;
            case "estimates":
                
                /* this is for check product drawing have to send or not */
                if ((strpos($message_body, '{product_drawing}') !== false)){
                    $message_body = str_replace("{product_drawing}","",$message_body);
                    $getproducts = $this->db->query("SELECT GROUP_CONCAT(`pro_id`) as ids FROM `tblitems_in` WHERE `rel_id` = '".$rel_id."' AND `rel_type` = 'estimate'")->row();
                    $getproducts = (!empty($getproducts)) ? $getproducts->ids : "";
                }
                $document_number = $module_data->number;
                $amount = $module_data->total;
                $cinfo = $this->get_client_info($module_data, $module_data->clientid);
                $purl = site_url("General_API/download_pdf/estimates/".$module_data->id);
                $client_name = $cinfo["client_name"];
                $pdf_url = '<a href="'.$purl.'" target="_blank" class="actionBtn" title="PDF">'.$module_data->number.'</a>';
                
                $m_change_var = array($company_name, $cinfo["client_name"], $cinfo["client_contact_no"], $cinfo["client_address"], $cinfo["client_state"], $cinfo["client_city"], $cinfo["client_zip"], $module_data->number, $amount, _d($module_data->date), $pdf_url, $company_signature);	
                break;
            case "invoice":
                $service_type = $this->input->post("service_type");
                /* this is for check product drawing have to send or not */
                if ((strpos($message_body, '{product_drawing}') !== false)){
                    $message_body = str_replace("{product_drawing}","",$message_body);
                    $getproducts = $this->db->query("SELECT GROUP_CONCAT(`pro_id`) as ids FROM `tblitems_in` WHERE `rel_id` = '".$rel_id."' AND `rel_type` = 'invoice'")->row();
                    $getproducts = (!empty($getproducts)) ? $getproducts->ids : "";
                }
                
                $document_number = $module_data->number;
                $amount = $module_data->total;
                $cinfo = $this->get_client_info($module_data, $module_data->clientid);
                $client_name = $cinfo["client_name"];
                $purl = site_url("General_API/download_pdf/invoices/".$module_data->id.'/?output_type=I');
                $pdf_url = '<a href="'.$purl.'" target="_blank" class="actionBtn" title="PDF">'.$module_data->number.'</a>';
                
                $m_change_var = array($company_name, $cinfo["client_name"], $cinfo["client_contact_no"], $cinfo["client_address"], $cinfo["client_state"], $cinfo["client_city"], $cinfo["client_zip"], $module_data->number, $amount, _d($module_data->invoice_date), $pdf_url, $company_signature);	
                break;
            case "challan":
                
                /* this is for check product drawing have to send or not */
                if ((strpos($message_body, '{product_drawing}') !== false)){
                    $message_body = str_replace("{product_drawing}","",$message_body);
                    if (!empty($module_data->product_json)){
                        $products = json_decode($module_data->product_json);
                        $i = 1;
                        foreach ($products as $pro){
                            $getproducts .= ($i == 1) ? $pro->product_id: ",".$pro->product_id;
                            $i++;    
                        }
                    }
                }
                
                $document_number = $module_data->chalanno;
                $amount = "";
                $cinfo = $this->get_client_info($module_data, $module_data->clientid);
                $client_name = $cinfo["client_name"];
                $purl = site_url("General_API/download_pdf/challan/".$module_data->id.'/?output_type=I');
                $pdf_url = '<a href="'.$purl.'" target="_blank" class="actionBtn" title="PDF">'.$module_data->chalanno.'</a>';
                
                $m_change_var = array($company_name, $cinfo["client_name"], $cinfo["client_contact_no"], $cinfo["client_address"], $cinfo["client_state"], $cinfo["client_city"], $cinfo["client_zip"], $module_data->chalanno, $amount, _d($module_data->challandate), $pdf_url, $company_signature);	
                break;
            case "debit_note":
                
                $amount = $module_data->totalamount;
                if($module_data->challan_id > 0){
                        $challan_no = value_by_id('tblchalanmst',$module_data->challan_id,'chalanno');
                }else{
                        $challan_no = $module_data->challan_number;
                }
                $document_number = $challan_no;
                $cinfo = $this->get_client_info($module_data, $module_data->clientid);
                $client_name = $cinfo["client_name"];
                $purl = site_url("General_API/download_pdf/debitnote/".$module_data->id);
                $pdf_url = '<a href="'.$purl.'" target="_blank" class="actionBtn" title="PDF">'.$challan_no.'</a>';
                
                $m_change_var = array($company_name, $cinfo["client_name"], $cinfo["client_contact_no"], $cinfo["client_address"], $cinfo["client_state"], $cinfo["client_city"], $cinfo["client_zip"], $challan_no, $amount, _d($module_data->dabit_note_date), $pdf_url, $company_signature);	
                break;
            case "debit_note_payment":
                
                $amount = $this->db->query("SELECT COALESCE(SUM(final_amount),0) as amt from tbldebitnotepaymentitems where debitnote_id = '".$module_data->id."' ")->row()->amt;
                $cinfo = $this->get_client_info($module_data, $module_data->clientid);
                $purl = site_url("General_API/download_pdf/debitnotepayment/".$module_data->id);
                $pdf_url = '<a href="'.$purl.'" target="_blank" class="actionBtn" title="PDF">'.$module_data->number.'</a>';
                $document_number = $module_data->number;
                $client_name = $cinfo["client_name"];
                
                $m_change_var = array($company_name, $cinfo["client_name"], $cinfo["client_contact_no"], $cinfo["client_address"], $cinfo["client_state"], $cinfo["client_city"], $cinfo["client_zip"], $module_data->number, $amount, _d($module_data->date), $pdf_url, $company_signature);	
                break;
            case "credit_note":
                
                $amount = $module_data->totalamount;
                $cinfo = $this->get_client_info($module_data, $module_data->clientid);
                $purl = site_url("General_API/download_pdf/creditnote/".$module_data->id);
                $pdf_url = '<a href="'.$purl.'" target="_blank" class="actionBtn" title="PDF">'.$module_data->number.'</a>';
                $document_number = $module_data->number;
                $client_name = $cinfo["client_name"];
                
                /* this is for check product drawing have to send or not */
                if ((strpos($message_body, '{document}') !== false)){
                    $message_body = str_replace("{document}","",$message_body);
                    $document_path = $purl;
                    $document_number = $module_data->number;
                }
                
                $m_change_var = array($company_name, $cinfo["client_name"], $cinfo["client_contact_no"], $cinfo["client_address"], $cinfo["client_state"], $cinfo["client_city"], $cinfo["client_zip"], $module_data->number, $amount, _d($module_data->date), $pdf_url, $company_signature);	
                break;
            case "purchase_order":
                
                /* this is for check product drawing have to send or not */
                if ((strpos($message_body, '{product_drawing}') !== false)){
                    $message_body = str_replace("{product_drawing}","",$message_body);
                    $getproducts = $this->db->query("SELECT GROUP_CONCAT(`product_id`) as ids FROM `tblpurchaseorderproduct` WHERE `po_id` = '".$rel_id."'")->row();
                    $getproducts = (!empty($getproducts)) ? $getproducts->ids : "";
                }
                
                $amount = $module_data->totalamount;
                $venderinfo = $this->db->query("SELECT * FROM `tblvendor` where id = '".$module_data->vendor_id."' ")->row();
                $state = get_state($venderinfo->state_id);
                $city = get_state($venderinfo->city_id);
                $purl = site_url("General_API/download_pdf/purchaseorder/".$module_data->id);
                $document_number = "PO-".$module_data->number;
                $client_name = $venderinfo->name;
                
                $pdf_url = '<a href="'.$purl.'" target="_blank" class="actionBtn" title="PDF">PO-'.$module_data->number.'</a>';
                
                $m_change_var = array($company_name, $venderinfo->name, $venderinfo->contact_number, $venderinfo->address, $state, $city, $venderinfo->pincode, 'PO-'.$module_data->number, $amount, _d($module_data->date), $pdf_url, $company_signature);	
                break;
            case "client_enquiry_form":
                
                $purl = site_url("client_enquiry_form/index/".$module_data->token);
                $link = '<a href="'.$purl.'" target="_blank" class="actionBtn" title="Enquiry Form">Click Here</a>';
                
                $m_change_var = array($company_name, "", "", "", "", "", "", "", "", "", "", get_company_signature(), $link);	
                break;
            default:
                
                $m_change_var = array();
                break;
        }
        
        $email_message = "";
        if (count($m_change_var) > 0 && !empty($message_body)) {
            $emailmessage = str_replace($mail_fields, $m_change_var, $message_body);
            $email_message = get_option('email_header') . $emailmessage . get_option('email_footer');
        }
        
        /* this is for check document have to send or not */
        if ((strpos($message_body, '{document}') !== false) && $document_number != ""){
            $message_body = str_replace("{document}","",$message_body);
            $document_path = $purl;
        }
        $subject_arr = array("{client_name}" => $client_name, "{company_name}" => $company_name);
        return array("message" => $email_message, "product_ids" => $getproducts, "document" => $document_path, "subject_data"=> $subject_arr, "document_number" => $document_number);
    }
    
    public function get_client_info($module_data, $client_id){
        if ($client_id > 0){
            $client_info = client_info($client_id);
            $data["client_name"] = $client_info->client_branch_name;
            $data["client_contact_no"] = $client_info->phone_no_1;
            $data["client_address"] = $client_info->address;
            $data["client_state"] = get_state($client_info->state);
            $data["client_city"] = get_city($client_info->city);
            $data["client_zip"] = $client_info->zip;
        }else{
            $data["client_name"] = $module_data->company;
            $data["client_contact_no"] = $module_data->phonenumber;
            $data["client_address"] = $module_data->address;
            $data["client_state"] = get_state($module_data->state);
            $data["client_city"] = get_city($module_data->city);
            $data["client_zip"] = $module_data->zip;
        }
        return $data;
    }
    
}
