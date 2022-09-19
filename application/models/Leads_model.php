<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Leads_model extends CRM_Model
{
    private $table_name = "tblleads as l";
    var $column_order = array(null, 'name','id','unit_2','product_cat_id','photo','status','is_varified','created_at'); //set column field database for datatable orderable
    var $column_search = array('l.enquiry_type_id','l.source','l.status','l.site_state_id','l.site_city_id','status','is_varified','created_at'); //set column field database for datatable searchable 
    var $order = array('id' => 'desc'); // default order 

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get lead
     * @param  string $id Optional - leadid
     * @return mixed
     */
    public function get($id = '', $where = [])
    {
        $this->db->select('*,tblleads.name, tblleads.id,tblleadsstatus.name as status_name,tblleadssources.name as source_name');
        $this->db->join('tblleadsstatus', 'tblleadsstatus.id=tblleads.status', 'left');
        $this->db->join('tblleadassignstaff', 'tblleadassignstaff.lead_id=tblleads.id', 'left');
        $this->db->join('tblleadssources', 'tblleadssources.id=tblleads.source', 'left');

        $this->db->where($where);
        if (is_numeric($id)) {
            $this->db->where('tblleads.id', $id);
           // $this->db->where('tblleadassignstaff.staff_id', get_staff_user_id());
            $lead = $this->db->get('tblleads')->row();
			//echo $this->db->last_query();
            if ($lead) {
                if ($lead->from_form_id != 0) {
                    $lead->form_data = $this->get_form([
                        'id' => $lead->from_form_id,
                    ]);
                }
                $lead->attachments = $this->get_lead_attachments($id);
                $lead->public_url  = leads_public_url($id);
            }

            return $lead;
        }

        return $this->db->get('tblleads')->result_array();
    }

    public function do_kanban_query($status, $search = '', $page = 1, $sort = [], $count = false)
    {
        $limit                          = get_option('leads_kanban_limit');
        $default_leads_kanban_sort      = get_option('default_leads_kanban_sort');
        $default_leads_kanban_sort_type = get_option('default_leads_kanban_sort_type');
        $has_permission_view            = has_permission('leads', '', 'view');

        $this->db->select('tblleads.name as lead_name,tblleadssources.name as source_name,tblleads.id as id,tblleads.assigned,tblleads.email,tblleads.phonenumber,tblleads.company,tblleads.dateadded,tblleads.status,tblleads.lastcontact,(SELECT COUNT(*) FROM tblclients WHERE leadid=tblleads.id) as is_lead_client, (SELECT COUNT(id) FROM tblfiles WHERE rel_id=tblleads.id AND rel_type="lead") as total_files, (SELECT COUNT(id) FROM tblnotes WHERE rel_id=tblleads.id AND rel_type="lead") as total_notes,(SELECT GROUP_CONCAT(name SEPARATOR ",") FROM tbltags_in JOIN tbltags ON tbltags_in.tag_id = tbltags.id WHERE rel_id = tblleads.id and rel_type="lead" ORDER by tag_order ASC) as tags');
        $this->db->from('tblleads');
        $this->db->join('tblleadssources', 'tblleadssources.id=tblleads.source', 'left');
        $this->db->join('tblstaff', 'tblstaff.staffid=tblleads.assigned', 'left');
        $this->db->where('status', $status);
        if (!$has_permission_view) {
            $this->db->where('(assigned = ' . get_staff_user_id() . ' OR addedfrom=' . get_staff_user_id() . ' OR is_public=1)');
        }
        if ($search != '') {
            if (!_startsWith($search, '#')) {
                $this->db->where('(tblleads.name LIKE "%' . $search . '%" OR tblleadssources.name LIKE "%' . $search . '%" OR tblleads.email LIKE "%' . $search . '%" OR tblleads.phonenumber LIKE "%' . $search . '%" OR tblleads.company LIKE "%' . $search . '%" OR CONCAT(tblstaff.firstname, \' \', tblstaff.lastname) LIKE "%' . $search . '%")');
            } else {
                $this->db->where('tblleads.id IN
                (SELECT rel_id FROM tbltags_in WHERE tag_id IN
                (SELECT id FROM tbltags WHERE name="' . strafter($search, '#') . '")
                AND tbltags_in.rel_type=\'lead\' GROUP BY rel_id HAVING COUNT(tag_id) = 1)
                ');
            }
        }

        if (isset($sort['sort_by']) && $sort['sort_by'] && isset($sort['sort']) && $sort['sort']) {
            $this->db->order_by($sort['sort_by'], $sort['sort']);
        } else {
            $this->db->order_by($default_leads_kanban_sort, $default_leads_kanban_sort_type);
        }

        if ($count == false) {
            if ($page > 1) {
                $page--;
                $position = ($page * $limit);
                $this->db->limit($limit, $position);
            } else {
                $this->db->limit($limit);
            }
        }

        if ($count == false) {
            return $this->db->get()->result_array();
        }

        return $this->db->count_all_results();
    }

    /**
     * Add new lead to database
     * @param mixed $data lead data
     * @return mixed false || leadid
     */
    public function add($data,$user_id='')
    {
        // echo "<pre>";
        // print_r($data);
        // exit;
        if (isset($data['custom_contact_date']) || isset($data['custom_contact_date'])) {
            if (isset($data['contacted_today'])) {
                $data['lastcontact'] = date('Y-m-d H:i:s');
                unset($data['contacted_today']);
            } else {
                $data['lastcontact'] = to_sql_date($data['custom_contact_date'], true);
            }
        }

        if (isset($data['is_public']) && ($data['is_public'] == 1 || $data['is_public'] === 'on')) {
            $data['is_public'] = 1;
        } else {
            $data['is_public'] = 0;
        }

        if (!isset($data['country']) || isset($data['country']) && $data['country'] == '') {
            $data['country'] = 0;
        }

        if (isset($data['custom_contact_date'])) {
            unset($data['custom_contact_date']);
        }

        $data['enquiry']['dateadded'] = date('Y-m-d H:i:s');
    		if(!empty($user_id)){
    			$data['enquiry']['addedfrom'] = $user_id;
    		}else{
    			$data['enquiry']['addedfrom'] = get_staff_user_id();
    		}

        $data = do_action('before_lead_added', $data);
        $tags = '';
        if (isset($data['tags'])) {
            $tags = $data['tags'];
            unset($data['tags']);
        }

        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            unset($data['custom_fields']);
        }
    		if(isset($data['newclient']['client_branch_name']))
    		{
    			$data['enquiry']['company']=$data['newclient']['client_branch_name'];
    		}

    		//Converting the date
    		if(!empty($data['enquiry']['enquiry_date'])){
    			$enquiry_date = str_replace("/","-",$data['enquiry']['enquiry_date']);
    			$enquiry_date = date("Y-m-d",strtotime($enquiry_date));
    		}else{
    			$enquiry_date = date("Y-m-d");
    		}

    		if(!empty($data['enquiry']['reminder_date'])){
    			$reminder_date = str_replace("/","-",$data['enquiry']['reminder_date']);
    			$reminder_date = date("Y-m-d",strtotime($reminder_date));
    		}else{
    			$reminder_date = date("Y-m-d");
    		}

    		/* this for identify of lead */
    		if (isset($data["enquirycall_id"]) && $data["enquirycall_id"] > 0){
            $data['enquiry']['enquirycall_id'] = $data["enquirycall_id"];
        }

            $client_branch_id = (!empty($data["clientbranch"]['client_branch_id'])) ? $data["clientbranch"]['client_branch_id'] : 0;
    		
            $data['enquiry']['email'] = trim($data['clients']['email_id']);
    		$data['enquiry']['website'] = trim($data['clients']['website']);
    		$data['enquiry']['phonenumber'] = trim($data['clients']['phone_no_1']);
    		$data['enquiry']['phonenumber2'] = trim($data['clients']['phone_no_2']);
            $data['enquiry']['client_person_name'] = trim($data['clients']['client_person_name']);
    		$data['enquiry']['address'] = $data['clients']['address'];
    		$data['enquiry']['zip'] = $data['clients']['zip'];
    		$data['enquiry']['landmark'] = $data['clients']['landmark'];
    		$data['enquiry']['state'] = $data['clients']['state'];
    		$data['enquiry']['city'] = $data['clients']['city'];
    		$data['enquiry']['pan_no'] = $data['clients']['pan_no'];
    		$data['enquiry']['gst_no'] = $data['clients']['vat'];
    		$data['enquiry']['cin_no'] = $data['clients']['cin_no'];
        $data['enquiry']['company_category'] = $data['clients']['client_cat_id'];
        $data['enquiry']['site_location'] = $data['site']['location'];
        $data['enquiry']['site_description'] = $data['site']['description'];
        $data['enquiry']['site_address'] = $data['site']['address'];
        $data['enquiry']['site_state_id'] = $data['site']['state_id'];
        $data['enquiry']['site_city_id'] = $data['site']['city_id'];
        $data['enquiry']['site_landmark'] = $data['site']['landmark'];
    		$data['enquiry']['site_pincode'] = $data['site']['pincode'];
    		$data['enquiry']['enquiry_date'] = $enquiry_date;
    		$data['enquiry']['last_activity_date'] = $enquiry_date;
    		$data['enquiry']['reminder_date'] = $reminder_date;
    		$data['enquiry']['created_at'] = date("Y-m-d H:i:s");
    		$data['enquiry']['updated_at'] = date("Y-m-d H:i:s");
    		$data['enquiry']['token_id'] = $data['form_token'];
	      $data['enquiry']['process_id'] = 1;
    		$data['enquiry']['group_id'] = $data['assign'];
    		$data['enquiry']['enquiry_type_main_id'] = $data["enquiry"]['enquiry_type_main_id'];
    		$data['enquiry']['client_branch_id'] = $client_branch_id;

    		$this->db->insert('tblleads', $data['enquiry']);
    		$insert_id = $this->db->insert_id();
    		$assignstaff=$data['assign']['assignid'];
    		$clientdata=$data['clientdata'];
    		$assignstaff=$data['assign']['assignid'];
    		$proenqdata=$data['proenqdata'];
        $group_id=$data['assign'];
    		if ($insert_id)
    		{

            if (isset($data["enquirycall_id"]) && $data["enquirycall_id"] > 0){
                $this->db->where('id', $data["enquirycall_id"]);
                $this->db->update('tblenquirycall', array("is_converted" => 1));
            }

      			$cid=$data['clients']['client_id'];
      			$client_branch_id= $data['clientbranch']['client_branch_id'];
      			if(!isset($data['newclient']['client_branch_name']))
      			{
      				$this->db->where('userid', $client_branch_id);
      				$this->db->update('tblclientbranch', $data['clients']);
      			}
           unset($data['clients']['client_id']);
			//$this->db->where('userid', $cid);
			//$this->db->update('tblclients', $data['clients']);

      			foreach($clientdata as $singleclient)
      			{
        				$singleclient['userid']=(!empty($client_branch_id)) ? $client_branch_id : 0;
        				$this->db->insert('tblcontacts', $singleclient);
        				$cont_id = $this->db->insert_id();
        				$datace['enquiry_id']=$insert_id;
        				$datace['contact_id']=$cont_id;
        				$this->db->insert('tblenquiryclientperson', $datace);
      			}

            //getting client id
            $branch_info = $this->db->query("SELECT `client_id` FROM `tblclientbranch` WHERE `userid`='".$client_branch_id."'")->row();

            $cdata['client_branch_id']=$client_branch_id;
      			$cdata['client_id']=$branch_info->client_id;
      			$cdata['leadno']='LEAD-'.number_series($insert_id);
      			$this->db->where('id', $insert_id);
      			$this->db->update('tblleads', $cdata);
      			foreach($proenqdata as $singleproenq)
      			{
        				$singleproenq['status'] = '1';
        				$singleproenq['enquiry_id'] = $insert_id;
        				$singleproenq['created_at'] = date("Y-m-d H:i:s");
        				$singleproenq['updated_at'] = date("Y-m-d H:i:s");
        				$this->db->insert('tblproductinquiry', $singleproenq);
      			}

            $lead_staff_info = $this->db->query("SELECT * FROM tblleadstaffgroup where id = '".$group_id."' ")->row_array();
            $superiordata = explode(',', $lead_staff_info['superior_ids']);
            $quotedata = explode(',', $lead_staff_info['quote_person_ids']);
            $saledata = $lead_staff_info['sales_person_id'];

      			foreach($assignstaff as $single_staff)
      			{
        				if (strpos($single_staff, 'Staff') !== false)
        				{
        					     $staff_id[]=str_replace("Staff","",$single_staff);
        				}
      				/*if (strpos($single_staff, 'group') !== false)
      				{
      					$single_staff=str_replace("group","",$single_staff);
      					$staffgroup=$this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='".$single_staff."'")->result_array();
      					foreach($staffgroup as $singlestaff)
      					{
      						$staff_id[]=$singlestaff['staff_id'];
      					}
      				}*/
      			}
	          $staff_id=array_unique($staff_id);
            if(!empty($superiordata))
            {
               foreach($superiordata as $staffid)
                {
                    $supdata['staff_id']=$staffid;
                    $supdata['type']= 1;
                    $supdata['lead_id']=$insert_id;
                    $supdata['status'] = '1';
                    $supdata['created_at'] = date("Y-m-d H:i:s");
                    $supdata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tblleadassignstaff', $supdata);
                    $this->lead_assigned_member_notification($insert_id, $staffid);
                }
            }

            if(!empty($quotedata))
            {
               foreach($quotedata as $staffid1)
                {
                    $quodata['staff_id']=$staffid1;
                    $quodata['type']= 3;
                    $quodata['lead_id']=$insert_id;
                    $quodata['status'] = '1';
                    $quodata['created_at'] = date("Y-m-d H:i:s");
                    $quodata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tblleadassignstaff', $quodata);
                    $this->lead_assigned_member_notification($insert_id, $staffid1);
                }
            }

            if(!empty($saledata))
            {
                $saldata['staff_id']=$saledata;
                $saldata['type']= 2;
                $saldata['lead_id']=$insert_id;
                $saldata['status'] = '1';
                $saldata['created_at'] = date("Y-m-d H:i:s");
                $saldata['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblleadassignstaff', $saldata);
                $this->lead_assigned_member_notification($insert_id, $saledata);
            }

    			logActivity('New Lead Added [ID: ' . $insert_id . ']');
    			$this->log_lead_activity($insert_id, 'not_lead_activity_created');

    			handle_tags_save($tags, $insert_id, 'lead');

    			if (isset($custom_fields)) {
    				handle_custom_fields_post($insert_id, $custom_fields);
    			}

    			do_action('lead_created', $insert_id);

    			return $insert_id;
    		}
        return false;
    }

    public function lead_assigned_member_notification($lead_id, $assigned, $integration = false,$sendapproval = false)
    {
        if ((!empty($assigned) && $assigned != 0)) {
            if ($integration == false) {
                if ($assigned == get_staff_user_id()) {
                    return false;
                }
            }

            /*$fromuserid = get_staff_user_id();
            $ad_data = array(
                'isread' => 0,
                'isread_inline' => 0,
                'date' => date('Y-m-d H:i:s'),
                'description' => 'New Lead Assigned to you',
                'fromuserid' => $fromuserid,
                'touserid' => $assigned,
                'from_fullname' => get_employee_name($fromuserid),
                'link' => 'leads/index/'.$lead_id,
                'module_id' => 7,
                'table_id' => $lead_id,
            );
            $this->db->insert('tblnotifications', $ad_data);*/

            $token = get_staff_token($assigned);
            $message = 'New Lead Assigned';
            $title = 'Schach';
            $send_intimation = sendFCM($message, $title, $token);

            $name = $this->db->select('name')->from('tblleads')->where('id', $lead_id)->get()->row()->name;

            $notification_data = [
                'description'     => 'New Lead Assigned',
                'touserid'        => $assigned,
                'module_id'       => 7,
                'table_id'        => $lead_id,
                'link'            => 'leads/index/'.$lead_id,
                'additional_data' => ($integration == false ? serialize([
                    $name,
                ]) : serialize([])),
            ];
			if ($integration != false) {
                $notification_data['fromcompany'] = 1;
            }



            if (add_notification($notification_data)) {
                pusher_trigger_notification([$assigned]);
            }

            /*$this->db->where('staffid', $assigned);
            $email = $this->db->get('tblstaff')->row()->email;

            $this->load->model('emails_model');
            $merge_fields = [];
            $merge_fields = array_merge($merge_fields, get_lead_merge_fields($lead_id));
            $this->emails_model->send_email_template('new-lead-assigned', $email, $merge_fields);

            $this->db->where('id', $lead_id);
            $this->db->update('tblleads', [
                'dateassigned' => date('Y-m-d'),
            ]);

            $not_additional_data = [
                get_staff_full_name(),
                '<a href="' . admin_url('profile/' . $assigned) . '" target="_blank">' . get_staff_full_name($assigned) . '</a>',
            ];

            if ($integration == true) {
                unset($not_additional_data[0]);
                array_values(($not_additional_data));
            }

            $not_additional_data = serialize($not_additional_data);

            $not_desc = ($integration == false ? 'not_lead_activity_assigned_to' : 'not_lead_activity_assigned_from_form');
            $this->log_lead_activity($lead_id, $not_desc, $integration, $not_additional_data);*/
        }
    }

    public function lead_approval_member_notification($lead_id, $assigned, $integration = false)
    {
        if ((!empty($assigned) && $assigned != 0)) {
            if ($integration == false) {
                if ($assigned == get_staff_user_id()) {
                    return false;
                }
            }

            $name = $this->db->select('name')->from('tblleads')->where('id', $lead_id)->get()->row()->name;

				 $notification_data2 = [
					'description'     => ($integration == false) ? 'send_lead_approval' : 'send_lead_approval',
					'touserid'        => $assigned,
					'link'            => 'leads/index/'.$lead_id.'#tab_lead_profile',
					'additional_data' => ($integration == false ? serialize([
						$name,
					]) : serialize([])),
				];
			if ($integration != false) {
                $notification_data2['fromcompany'] = 1;
            }



			if (add_notification($notification_data2)) {
                pusher_trigger_notification([$assigned]);
            }

            $this->db->where('staffid', $assigned);
            $email = $this->db->get('tblstaff')->row()->email;

            $this->load->model('emails_model');
            $merge_fields = [];
            $merge_fields = array_merge($merge_fields, get_lead_merge_fields($lead_id));
            $this->emails_model->send_email_template('new-lead-assigned', $email, $merge_fields);

            $this->db->where('id', $lead_id);
            $this->db->update('tblleads', [
                'dateassigned' => date('Y-m-d'),
            ]);

            $not_additional_data = [
                get_staff_full_name(),
                '<a href="' . admin_url('profile/' . $assigned) . '" target="_blank">' . get_staff_full_name($assigned) . '</a>',
            ];

            if ($integration == true) {
                unset($not_additional_data[0]);
                array_values(($not_additional_data));
            }

            $not_additional_data = serialize($not_additional_data);

            $not_desc = ($integration == false ? 'not_lead_activity_assigned_to' : 'not_lead_activity_assigned_from_form');
            $this->log_lead_activity($lead_id, $not_desc, $integration, $not_additional_data);
        }
    }

	public function lead_accept_member_notification($lead_id, $assigned, $integration = false)
    {
        if ((!empty($assigned) && $assigned != 0)) {
            if ($integration == false) {
                if ($assigned == get_staff_user_id()) {
                    return false;
                }
            }

            $name = $this->db->select('name')->from('tblleads')->where('id', $lead_id)->get()->row()->name;

				 $notification_data2 = [
					'description'     => 'LEAD-'.number_series($lead_id).' is Accepted By '.get_staff_full_name(get_staff_user_id()),
					'touserid'        => $assigned,
					'link'            => 'leads/index/'.$lead_id.'#tab_lead_profile',
					'additional_data' => ($integration == false ? serialize([
						$name,
					]) : serialize([])),
				];
			if ($integration != false) {
                $notification_data2['fromcompany'] = 1;
            }



			if (add_notification($notification_data2)) {
                pusher_trigger_notification([$assigned]);
            }

            $this->db->where('staffid', $assigned);
            $email = $this->db->get('tblstaff')->row()->email;

            $this->load->model('emails_model');
            $merge_fields = [];
            $merge_fields = array_merge($merge_fields, get_lead_merge_fields($lead_id));
            //$this->emails_model->send_email_template('new-lead-assigned', $email, $merge_fields);



            $not_additional_data = [
                get_staff_full_name(),
                '<a href="' . admin_url('profile/' . $assigned) . '" target="_blank"></a>',
            ];

            if ($integration == true) {
                unset($not_additional_data[0]);
                array_values(($not_additional_data));
            }

            $not_additional_data = serialize($not_additional_data);

            //$not_desc = ($integration == false ? 'not_lead_activity_assigned_to' : 'not_lead_activity_assigned_from_form');
            $not_desc = 'LEAD-'.number_series($lead_id).' is Accepted By '.get_staff_full_name(get_staff_user_id());
            $this->log_lead_activity($lead_id, $not_desc, $integration, $not_additional_data);
        }
    }

	public function lead_decline_member_notification($lead_id, $assigned, $integration = false)
    {
        if ((!empty($assigned) && $assigned != 0)) {
            if ($integration == false) {
                if ($assigned == get_staff_user_id()) {
                    return false;
                }
            }

            $name = $this->db->select('name')->from('tblleads')->where('id', $lead_id)->get()->row()->name;

				 $notification_data2 = [
					'description'     => 'LEAD-'.number_series($lead_id).' is Decline By '.get_staff_full_name(get_staff_user_id()),
					'touserid'        => $assigned,
					'link'            => 'leads/index/'.$lead_id.'#tab_lead_profile',
					'additional_data' => ($integration == false ? serialize([
						$name,
					]) : serialize([])),
				];
			if ($integration != false) {
                $notification_data2['fromcompany'] = 1;
            }



			if (add_notification($notification_data2)) {
                pusher_trigger_notification([$assigned]);
            }

            $this->db->where('staffid', $assigned);
            $email = $this->db->get('tblstaff')->row()->email;

            $this->load->model('emails_model');
            $merge_fields = [];
            $merge_fields = array_merge($merge_fields, get_lead_merge_fields($lead_id));
            //$this->emails_model->send_email_template('new-lead-assigned', $email, $merge_fields);



            $not_additional_data = [
                get_staff_full_name(),
                '<a href="' . admin_url('profile/' . $assigned) . '" target="_blank"></a>',
            ];

            if ($integration == true) {
                unset($not_additional_data[0]);
                array_values(($not_additional_data));
            }

            $not_additional_data = serialize($not_additional_data);

            //$not_desc = ($integration == false ? 'not_lead_activity_assigned_to' : 'not_lead_activity_assigned_from_form');
            $not_desc = 'LEAD-'.number_series($lead_id).' is Decline By '.get_staff_full_name(get_staff_user_id());
            $this->log_lead_activity($lead_id, $not_desc, $integration, $not_additional_data);
        }
    }

    /**
     * Update lead
     * @param  array $data lead data
     * @param  mixed $id   leadid
     * @return boolean
     */
    public function update($data, $id)
    {
        // echo '<pre>';
        // print_r($data);
        // print_r($data['clientbranch']['client_branch_id']);
        // exit();

        $sendapproval= (isset($data['send'])) ? '1' : '';
        $current_lead_data = $this->get($id);
        $current_status    = $this->get_status($current_lead_data->status);
        if ($current_status) {
            $current_status_id = $current_status->id;
            $current_status    = $current_status->name;
        } else {
            if ($current_lead_data->junk == 1) {
                $current_status = _l('lead_junk');
            } elseif ($current_lead_data->lost == 1) {
                $current_status = _l('lead_lost');
            } else {
                $current_status = '';
            }
            $current_status_id = 0;
        }

        $affectedRows = 0;
        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            if (handle_custom_fields_post($id, $custom_fields)) {
                $affectedRows++;
            }
            unset($data['custom_fields']);
        }
        if (!defined('API')) {
            if (isset($data['is_public'])) {
                $data['is_public'] = 1;
            } else {
                $data['is_public'] = 0;
            }

            if (!isset($data['country']) || isset($data['country']) && $data['country'] == '') {
                $data['country'] = 0;
            }

            if (isset($data['description'])) {
                $data['description'] = nl2br($data['description']);
            }
        }

        if (isset($data['lastcontact']) && $data['lastcontact'] == '' || isset($data['lastcontact']) && $data['lastcontact'] == null) {
            $data['lastcontact'] = null;
        } elseif (isset($data['lastcontact'])) {
            $data['lastcontact'] = to_sql_date($data['lastcontact'], true);
        }

        if (isset($data['tags'])) {
            if (handle_tags_save($data['tags'], $id, 'lead')) {
                $affectedRows++;
            }
            unset($data['tags']);
        }

        if (isset($data['remove_attachments'])) {
            foreach ($data['remove_attachments'] as $key => $val) {
                $attachment = $this->get_lead_attachments($id, $key);
                if ($attachment) {
                    $this->delete_lead_attachment($attachment->id);
                }
            }
            unset($data['remove_attachments']);
        }
		if(isset($data['newclient']['client_branch_name']))
		{
			$data['enquiry']['company']=$data['newclient']['client_branch_name'];
		}

		//Converting the date
		if(!empty($data['enquiry']['enquiry_date'])){
			$enquiry_date = str_replace("/","-",$data['enquiry']['enquiry_date']);
			$enquiry_date = date("Y-m-d",strtotime($enquiry_date));
		}else{
			$enquiry_date = date("Y-m-d");
		}

		if(!empty($data['enquiry']['reminder_date'])){
			$reminder_date = str_replace("/","-",$data['enquiry']['reminder_date']);
			$reminder_date = date("Y-m-d",strtotime($reminder_date));
		}else{
			$reminder_date = date("Y-m-d");
		}


    		$data['enquiry']['email'] = trim($data['clients']['email_id']);
    		$data['enquiry']['website'] = trim($data['clients']['website']);
    		$data['enquiry']['phonenumber'] = trim($data['clients']['phone_no_1']);
    		$data['enquiry']['phonenumber2'] = trim($data['clients']['phone_no_2']);
        $data['enquiry']['client_person_name'] = trim($data['clients']['client_person_name']);
    		$data['enquiry']['address'] = $data['clients']['address'];
    		$data['enquiry']['zip'] = $data['clients']['zip'];
    		$data['enquiry']['landmark'] = $data['clients']['landmark'];
    		$data['enquiry']['state'] = $data['clients']['state'];
    		$data['enquiry']['city'] = $data['clients']['city'];
    		$data['enquiry']['pan_no'] = $data['clients']['pan_no'];
    		$data['enquiry']['gst_no'] = $data['clients']['vat'];
    		$data['enquiry']['cin_no'] = $data['clients']['cin_no'];
    		$data['enquiry']['company_category'] = $data['clients']['client_cat_id'];
        $data['enquiry']['site_location'] = $data['site']['location'];
        $data['enquiry']['site_description'] = $data['site']['description'];
        $data['enquiry']['site_address'] = $data['site']['address'];
        $data['enquiry']['site_state_id'] = $data['site']['state_id'];
        $data['enquiry']['site_city_id'] = $data['site']['city_id'];
        $data['enquiry']['site_landmark'] = $data['site']['landmark'];
        $data['enquiry']['site_pincode'] = $data['site']['pincode'];
    		$data['enquiry']['enquiry_date'] = $enquiry_date;
    		$data['enquiry']['reminder_date'] = $reminder_date;
    		$data['enquiry']['created_at'] = date("Y-m-d H:i:s");
    		$data['enquiry']['updated_at'] = date("Y-m-d H:i:s");
    		$data['enquiry']['leadno']='LEAD-'.number_series($id);
        $data['enquiry']['group_id'] = $data['assign'];
        $data['enquiry']['client_branch_id'] = $data['clientbranch']['client_branch_id'];

		//$this->db->insert('tblleads', $data['enquiry']);
		$this->db->where('id', $id);
		$this->db->update('tblleads', $data['enquiry']);
		$insert_id = $id;
		$assignstaff=$data['assign']['assignid'];

		$assignstaff=$data['assign']['assignid'];
		$proenqdata=$data['proenqdata'];
        $group_id=$data['assign'];
		if ($insert_id)
		{
			$cid=$data['clients']['client_id'];
			$client_branch_id= $data['clientbranch']['client_branch_id'];
			if(!isset($data['newclient']['client_branch_name']))
			{
				$this->db->where('userid', $client_branch_id);
				$this->db->update('tblclientbranch', $data['clients']);
			}
			unset($data['clients']['client_id']);
			//$this->db->where('userid', $cid);
			//$this->db->update('tblclients', $data['clients']);

			$this->db->where('lead_id', $id);
			$this->db->delete('tblleadassignstaff');
			$this->db->where('enquiry_id', $id);
			$this->db->delete('tblproductinquiry');
			/*if(isset($data['clientexitingdata']))
			{
				$clientdata=$data['clientexitingdata'];
				foreach($clientdata as $singleclient)
				{
					$this->db->where('id', $singleclient['contactid']);
					$this->db->update('tblcontacts', $singleclient);
					$this->db->where('enquiry_id', $id);
					$this->db->delete('tblenquiryclientperson');
					$datace['enquiry_id']=$insert_id;
					$datace['contact_id']=$singleclient['contactid'];
					$this->db->insert('tblenquiryclientperson', $datace);
				}
			}
			else
			{
				$clientdata=$data['clientdata'];
				$this->db->where('enquiry_id', $id);
				$this->db->delete('tblenquiryclientperson');
				foreach($clientdata as $singleclient)
				{
					$singleclient['userid']=$client_branch_id;
					$this->db->insert('tblcontacts', $singleclient);
					$cont_id = $this->db->insert_id();
					$datace['enquiry_id']=$insert_id;
					$datace['contact_id']=$cont_id;
					$this->db->insert('tblenquiryclientperson', $datace);

				}
			}*/

            $client_info = $this->db->query("SELECT * FROM `tblenquiryclientperson` where `enquiry_id`='".$id."' ")->result();
            if(!empty($client_info)){
                foreach ($client_info as $r) {
                    $this->db->where('id', $r->contact_id);
                    $this->db->delete('tblcontacts');
                }
            }

            $this->db->where('enquiry_id', $id);
            $this->db->delete('tblenquiryclientperson');

            $clientdata=$data['clientdata'];
            if(!empty($clientdata)){
                foreach($clientdata as $singleclient)
                  {
                    $singleclient['userid']=$client_branch_id;
                    $this->db->insert('tblcontacts', $singleclient);
                    $cont_id = $this->db->insert_id();
                    $datace['enquiry_id']=$insert_id;
                    $datace['contact_id']=$cont_id;
                    $this->db->insert('tblenquiryclientperson', $datace);
                  }
            }

            //getting client id
            $branch_info = $this->db->query("SELECT `client_id` FROM `tblclientbranch` WHERE `userid`='".$client_branch_id."'")->row();



            $cdata['client_branch_id']=$client_branch_id;
            $cdata['client_id']=$branch_info->client_id;
			$this->db->where('id', $insert_id);
			$this->db->update('tblleads', $cdata);
			foreach($proenqdata as $singleproenq)
			{
				$singleproenq['status'] = '1';
				$singleproenq['enquiry_id'] = $insert_id;
				$singleproenq['created_at'] = date("Y-m-d H:i:s");
				$singleproenq['updated_at'] = date("Y-m-d H:i:s");
				$this->db->insert('tblproductinquiry', $singleproenq);
			}
			foreach($assignstaff as $single_staff)
			{
				if (strpos($single_staff, 'Staff') !== false)
				{
					$staff_id[]=str_replace("Staff","",$single_staff);
				}
				/*if (strpos($single_staff, 'group') !== false)
				{
					$single_staff=str_replace("group","",$single_staff);
					$staffgroup=$this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='".$single_staff."'")->result_array();
					foreach($staffgroup as $singlestaff)
					{
						$staff_id[]=$singlestaff['staff_id'];
					}
				}*/
			}

			$staff_id=array_unique($staff_id);
            $lead_staff_info = $this->db->query("SELECT * FROM tblleadstaffgroup where id = '".$group_id."' ")->row_array();
            $superiordata = explode(',', $lead_staff_info['superior_ids']);
            $quotedata = explode(',', $lead_staff_info['quote_person_ids']);
            $saledata = $lead_staff_info['sales_person_id'];

            if(!empty($superiordata))
            {
               foreach($superiordata as $staffid)
            {
                $supdata['staff_id']=$staffid;
                $supdata['type']= 1;
                $supdata['lead_id']=$insert_id;
                $supdata['status'] = '1';
                $supdata['created_at'] = date("Y-m-d H:i:s");
                $supdata['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblleadassignstaff', $supdata);
                $this->lead_assigned_member_notification($insert_id, $staffid);
            }
            }

            if(!empty($quotedata))
            {
               foreach($quotedata as $staffid1)
            {
                $quodata['staff_id']=$staffid1;
                $quodata['type']= 3;
                $quodata['lead_id']=$insert_id;
                $quodata['status'] = '1';
                $quodata['created_at'] = date("Y-m-d H:i:s");
                $quodata['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblleadassignstaff', $quodata);
                $this->lead_assigned_member_notification($insert_id, $staffid1);
            }
            }

            if(!empty($saledata))
            {
                $saldata['staff_id']=$saledata;
                $saldata['type']= 2;
                $saldata['lead_id']=$insert_id;
                $saldata['status'] = '1';
                $saldata['created_at'] = date("Y-m-d H:i:s");
                $saldata['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblleadassignstaff', $saldata);
                $this->lead_assigned_member_notification($insert_id, $saledata);
            }

			/*foreach($staff_id as $staffid)
			{
				$sdata['staff_id']=$staffid;
				$sdata['lead_id']=$insert_id;
				$sdata['status'] = '1';
				$sdata['created_at'] = date("Y-m-d H:i:s");
				$sdata['updated_at'] = date("Y-m-d H:i:s");
				$this->db->insert('tblleadassignstaff', $sdata);
				$this->lead_assigned_member_notification($insert_id, $staffid);
			}*/
			//logActivity('Exiting Enquiry for Added [ID: ' . $id . ', ' . $data['name'] . ']');
			//logActivity('Lead Updated [ID: ' . $insert_id . ']');
			$this->log_lead_activity($insert_id, 'not_lead_activity_created');

			handle_tags_save($tags, $insert_id, 'lead');

			if (isset($custom_fields)) {
				handle_custom_fields_post($insert_id, $custom_fields);
			}

			do_action('lead_created', $insert_id);

			return $insert_id;
		}

        if ($this->db->affected_rows() > 0) {
            $affectedRows++;
            if (isset($data['enquiry']['status']) && $current_status_id != $data['enquiry']['status']) {
                $this->db->where('id', $id);
                $this->db->update('tblleads', [
                    'last_status_change' => date('Y-m-d H:i:s'),
                ]);
                $new_status_name = $this->get_status($data['enquiry']['status'])->name;
                $this->log_lead_activity($id, 'not_lead_activity_status_updated', false, serialize([
                    get_staff_full_name(),
                    $current_status,
                    $new_status_name,
                ]));

                do_action('lead_status_changed', ['lead_id' => $id, 'old_status' => $current_status_id, 'new_status' => $data['status']]);
            }

            if (($current_lead_data->junk == 1 || $current_lead_data->lost == 1) && $data['enquiry']['status'] != 0) {
                $this->db->where('id', $id);
                $this->db->update('tblleads', [
                    'junk' => 0,
                    'lost' => 0,
                ]);
            }


            logActivity('Lead Updated [ID: ' . $id . ']');

            return true;
        }
        if ($affectedRows > 0) {
            return true;
        }

        return false;
    }

    /**
     * Delete lead from database and all connections
     * @param  mixed $id leadid
     * @return boolean
     */
    public function delete($id)
    {
        $affectedRows = 0;

        do_action('before_lead_deleted', $id);

        $lead = $this->get($id);

        $this->db->where('id', $id);
        $this->db->delete('tblleads');
        if ($this->db->affected_rows() > 0) {
            logActivity('Lead Deleted [Deleted by: ' . get_staff_full_name() . ', ID: ' . $id . ']');

            if ($lead->enquirycall_id > 0){
                $this->db->where('id', $lead->enquirycall_id);
                $this->db->update('tblenquirycall', array("is_converted" => 0));
            }

            $attachments = $this->get_lead_attachments($id);
            foreach ($attachments as $attachment) {
                $this->delete_lead_attachment($attachment['id']);
            }

            // Delete the custom field values
            $this->db->where('relid', $id);
            $this->db->where('fieldto', 'leads');
            $this->db->delete('tblcustomfieldsvalues');

            $this->db->where('leadid', $id);
            $this->db->delete('tblleadactivitylog');

            $this->db->where('leadid', $id);
            $this->db->delete('tblleadsemailintegrationemails');

            $this->db->where('rel_id', $id);
            $this->db->where('rel_type', 'lead');
            $this->db->delete('tblnotes');

            $this->db->where('rel_type', 'lead');
            $this->db->where('rel_id', $id);
            $this->db->delete('tblreminders');

            $this->db->where('enquiry_id', $id);
            $this->db->delete('tblproductinquiry');

            $this->db->where('rel_type', 'lead');
            $this->db->where('rel_id', $id);
            $this->db->delete('tbltags_in');

            $this->load->model('proposals_model');
            $this->db->where('rel_id', $id);
            $this->db->where('rel_type', 'lead');
            $proposals = $this->db->get('tblproposals')->result_array();

            foreach ($proposals as $proposal) {
                $this->proposals_model->delete($proposal['id']);
            }

            // Get related tasks
            $this->db->where('rel_type', 'lead');
            $this->db->where('rel_id', $id);
            $tasks = $this->db->get('tblstafftasks')->result_array();
            foreach ($tasks as $task) {
                $this->tasks_model->delete_task($task['id']);
            }

            if (is_gdpr()) {
                $this->db->where('(description LIKE "%' . $lead->email . '%" OR description LIKE "%' . $lead->name . '%" OR description LIKE "%' . $lead->phonenumber . '%")');
                $this->db->delete('tblactivitylog');
            }

            $affectedRows++;
        }
        if ($affectedRows > 0) {
            return true;
        }

        return false;
    }

    /**
     * Mark lead as lost
     * @param  mixed $id lead id
     * @return boolean
     */
    public function mark_as_lost($id)
    {
        $this->db->select('status');
        $this->db->from('tblleads');
        $this->db->where('id', $id);
        $last_lead_status = $this->db->get()->row()->status;

        $this->db->where('id', $id);
        $this->db->update('tblleads', [
            'lost'               => 1,
            'status'             => 0,
            'last_status_change' => date('Y-m-d H:i:s'),
            'last_lead_status'   => $last_lead_status,
        ]);
        if ($this->db->affected_rows() > 0) {
            $this->log_lead_activity($id, 'not_lead_activity_marked_lost');
            logActivity('Lead Marked as Lost [ID: ' . $id . ']');
            do_action('lead_marked_as_lost', $id);

            return true;
        }

        return false;
    }

    /**
     * Unmark lead as lost
     * @param  mixed $id leadid
     * @return boolean
     */
    public function unmark_as_lost($id)
    {
        $this->db->select('last_lead_status');
        $this->db->from('tblleads');
        $this->db->where('id', $id);
        $last_lead_status = $this->db->get()->row()->last_lead_status;

        $this->db->where('id', $id);
        $this->db->update('tblleads', [
            'lost'   => 0,
            'status' => $last_lead_status,
        ]);
        if ($this->db->affected_rows() > 0) {
            $this->log_lead_activity($id, 'not_lead_activity_unmarked_lost');
            logActivity('Lead Unmarked as Lost [ID: ' . $id . ']');

            return true;
        }

        return false;
    }

    /**
     * Mark lead as junk
     * @param  mixed $id lead id
     * @return boolean
     */
    public function mark_as_junk($id)
    {
        $this->db->select('status');
        $this->db->from('tblleads');
        $this->db->where('id', $id);
        $last_lead_status = $this->db->get()->row()->status;

        $this->db->where('id', $id);
        $this->db->update('tblleads', [
            'junk'               => 1,
            'status'             => 0,
            'last_status_change' => date('Y-m-d H:i:s'),
            'last_lead_status'   => $last_lead_status,
        ]);
        if ($this->db->affected_rows() > 0) {
            $this->log_lead_activity($id, 'not_lead_activity_marked_junk');
            logActivity('Lead Marked as Junk [ID: ' . $id . ']');
            do_action('lead_marked_as_junk', $id);

            return true;
        }

        return false;
    }

    /**
     * Unmark lead as junk
     * @param  mixed $id leadid
     * @return boolean
     */
    public function unmark_as_junk($id)
    {
        $this->db->select('last_lead_status');
        $this->db->from('tblleads');
        $this->db->where('id', $id);
        $last_lead_status = $this->db->get()->row()->last_lead_status;

        $this->db->where('id', $id);
        $this->db->update('tblleads', [
            'junk'   => 0,
            'status' => $last_lead_status,
        ]);
        if ($this->db->affected_rows() > 0) {
            $this->log_lead_activity($id, 'not_lead_activity_unmarked_junk');
            logActivity('Lead Unmarked as Junk [ID: ' . $id . ']');

            return true;
        }

        return false;
    }

    /**
     * Get lead attachments
     * @since Version 1.0.4
     * @param  mixed $id lead id
     * @return array
     */
    public function get_lead_attachments($id = '', $attachment_id = '', $where = [])
    {
        $this->db->where($where);
        $idIsHash = !is_numeric($attachment_id) && strlen($attachment_id) == 32;
        if (is_numeric($attachment_id) || $idIsHash) {
            $this->db->where($idIsHash ? 'attachment_key' : 'id', $attachment_id);

            return $this->db->get('tblfiles')->row();
        }
        $this->db->where('rel_id', $id);
        $this->db->where('rel_type', 'lead');
        $this->db->order_by('dateadded', 'DESC');

        return $this->db->get('tblfiles')->result_array();
    }

    public function add_attachment_to_database($lead_id, $attachment, $external = false, $form_activity = false)
    {
        $this->misc_model->add_attachment_to_database($lead_id, 'lead', $attachment, $external);

        if ($form_activity == false) {
            $this->leads_model->log_lead_activity($lead_id, 'not_lead_activity_added_attachment');
        } else {
            $this->leads_model->log_lead_activity($lead_id, 'not_lead_activity_log_attachment', true, serialize([
                $form_activity,
            ]));
        }

        // No notification when attachment is imported from web to lead form
        if ($form_activity == false) {
            $lead         = $this->get($lead_id);
            $not_user_ids = [];
            if ($lead->addedfrom != get_staff_user_id()) {
                array_push($not_user_ids, $lead->addedfrom);
            }
            if ($lead->assigned != get_staff_user_id() && $lead->assigned != 0) {
                array_push($not_user_ids, $lead->assigned);
            }
            $notifiedUsers = [];
            foreach ($not_user_ids as $uid) {
                $notified = add_notification([
                    'description'     => 'not_lead_added_attachment',
                    'touserid'        => $uid,
                    'link'            => '#leadid=' . $lead_id,
                    'additional_data' => serialize([
                        $lead->name,
                    ]),
                ]);
                if ($notified) {
                    array_push($notifiedUsers, $uid);
                }
            }
            pusher_trigger_notification($notifiedUsers);
        }
    }

    /**
     * Delete lead attachment
     * @param  mixed $id attachment id
     * @return boolean
     */
    public function delete_lead_attachment($id)
    {
        $attachment = $this->get_lead_attachments('', $id);
        $deleted    = false;

        if ($attachment) {
            if (empty($attachment->external)) {
                unlink(get_upload_path_by_type('lead') . $attachment->rel_id . '/' . $attachment->file_name);
            }
            $this->db->where('id', $attachment->id);
            $this->db->delete('tblfiles');
            if ($this->db->affected_rows() > 0) {
                $deleted = true;
                logActivity('Lead Attachment Deleted [ID: ' . $attachment->rel_id . ']');
            }

            if (is_dir(get_upload_path_by_type('lead') . $attachment->rel_id)) {
                // Check if no attachments left, so we can delete the folder also
                $other_attachments = list_files(get_upload_path_by_type('lead') . $attachment->rel_id);
                if (count($other_attachments) == 0) {
                    // okey only index.html so we can delete the folder also
                    delete_dir(get_upload_path_by_type('lead') . $attachment->rel_id);
                }
            }
        }

        return $deleted;
    }

    // Sources

    /**
     * Get leads sources
     * @param  mixed $id Optional - Source ID
     * @return mixed object if id passed else array
     */
    public function get_source($id = false)
    {
        if (is_numeric($id)) {
            $this->db->where('id', $id);

            return $this->db->get('tblleadssources')->row();
        }

        return $this->db->get('tblleadssources')->result_array();
    }

    /**
     * Add new lead source
     * @param mixed $data source data
     */
    public function add_source($data)
    {
        $data['added_by'] = get_staff_user_id();
        $data['created_at'] = date("Y-m-d H:i:s");
        $this->db->insert('tblleadssources', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            logActivity('New Leads Source Added [SourceID: ' . $insert_id . ', Name: ' . $data['name'] . ']');
        }

        return $insert_id;
    }

    /**
     * Update lead source
     * @param  mixed $data source data
     * @param  mixed $id   source id
     * @return boolean
     */
    public function update_source($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tblleadssources', $data);
        if ($this->db->affected_rows() > 0) {
            logActivity('Leads Source Updated [SourceID: ' . $id . ', Name: ' . $data['name'] . ']');

            return true;
        }

        return false;
    }

    /**
     * Delete lead source from database
     * @param  mixed $id source id
     * @return mixed
     */
    public function delete_source($id)
    {
        $current = $this->get_source($id);
        // Check if is already using in table
        if (is_reference_in_table('source', 'tblleads', $id) || is_reference_in_table('lead_source', 'tblleadsintegration', $id)) {
            return [
                'referenced' => true,
            ];
        }
        $this->db->where('id', $id);
        $this->db->delete('tblleadssources');
        if ($this->db->affected_rows() > 0) {
            if (get_option('leads_default_source') == $id) {
                update_option('leads_default_source', '');
            }
            logActivity('Leads Source Deleted [SourceID: ' . $id . ']');

            return true;
        }

        return false;
    }

    // Statuses

    /**
     * Get lead statuses
     * @param  mixed $id status id
     * @return mixed      object if id passed else array
     */
    public function get_status($id = '', $where = [])
    {
        $this->db->where($where);
        if (is_numeric($id)) {
            $this->db->where('id', $id);

            return $this->db->get('tblleadsstatus')->row();
        }

        $statuses = $this->object_cache->get('leads-all-statuses');

        if(!$statuses) {
            $this->db->order_by('statusorder', 'asc');

            $statuses = $this->db->get('tblleadsstatus')->result_array();
            $this->object_cache->add('leads-all-statuses', $statuses);
        }

        return $statuses;

    }

    public function get_enquirytype ($id = '', $where = [])
    {
        $this->db->where($where);
        if (is_numeric($id)) {
            $this->db->where('id', $id);

            return $this->db->get('tblenquirytypemaster')->row();
        }

        $statuses = $this->object_cache->get('leads-all-statuses');

        if(!$statuses) {
            $this->db->order_by('order', 'asc');

            $statuses = $this->db->get('tblenquirytypemaster')->result_array();
            $this->object_cache->add('leads-all-statuses', $statuses);
        }

        return $statuses;

    }

    /**
     * Add new lead status
     * @param array $data lead status data
     */
    public function add_status($data)
    {
        if (isset($data['color']) && $data['color'] == '') {
            $data['color'] = do_action('default_lead_status_color', '#757575');
        }

        if (!isset($data['statusorder'])) {
            $data['statusorder'] = total_rows('tblleadsstatus') + 1;
        }

        $this->db->insert('tblleadsstatus', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            logActivity('New Leads Status Added [StatusID: ' . $insert_id . ', Name: ' . $data['name'] . ']');

            return $insert_id;
        }

        return false;
    }

    public function update_status($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tblleadsstatus', $data);
        if ($this->db->affected_rows() > 0) {
            logActivity('Leads Status Updated [StatusID: ' . $id . ', Name: ' . $data['name'] . ']');

            return true;
        }

        return false;
    }

    /**
     * Delete lead status from database
     * @param  mixed $id status id
     * @return boolean
     */
    public function delete_status($id)
    {
        $current = $this->get_status($id);
        // Check if is already using in table
        if (is_reference_in_table('status', 'tblleads', $id) || is_reference_in_table('lead_status', 'tblleadsintegration', $id)) {
            return [
                'referenced' => true,
            ];
        }

        $this->db->where('id', $id);
        $this->db->delete('tblleadsstatus');
        if ($this->db->affected_rows() > 0) {
            if (get_option('leads_default_status') == $id) {
                update_option('leads_default_status', '');
            }
            logActivity('Leads Status Deleted [StatusID: ' . $id . ']');

            return true;
        }

        return false;
    }

    /**
     * Update canban lead status when drag and drop
     * @param  array $data lead data
     * @return boolean
     */
    public function update_lead_status($data)
    {
        $this->db->select('status');
        $this->db->where('id', $data['leadid']);
        $_old = $this->db->get('tblleads')->row();

        $old_status = '';

        if ($_old) {
            $old_status = $this->get_status($_old->status);
            if ($old_status) {
                $old_status = $old_status->name;
            }
        }

        $affectedRows   = 0;
        $current_status = $this->get_status($data['status'])->name;

        $this->db->where('id', $data['leadid']);
        $this->db->update('tblleads', [
            'status' => $data['status'],
        ]);

        $_log_message = '';

        if ($this->db->affected_rows() > 0) {
            $affectedRows++;
            if ($current_status != $old_status && $old_status != '') {
                $_log_message    = 'not_lead_activity_status_updated';
                $additional_data = serialize([
                    get_staff_full_name(),
                    $old_status,
                    $current_status,
                ]);

                do_action('lead_status_changed', ['lead_id' => $data['leadid'], 'old_status' => $old_status, 'new_status' => $current_status]);
            }
            $this->db->where('id', $data['leadid']);
            $this->db->update('tblleads', [
                'last_status_change' => date('Y-m-d H:i:s'),
            ]);
        }
        if (isset($data['order'])) {
            foreach ($data['order'] as $order_data) {
                $this->db->where('id', $order_data[0]);
                $this->db->update('tblleads', [
                    'leadorder' => $order_data[1],
                ]);
            }
        }
        if ($affectedRows > 0) {
            if ($_log_message == '') {
                return true;
            }
            $this->log_lead_activity($data['leadid'], $_log_message, false, $additional_data);

            return true;
        }

        return false;
    }

    /* Ajax */

    /**
     * All lead activity by staff
     * @param  mixed $id lead id
     * @return array
     */
    public function get_lead_activity_log($id)
    {
        $sorting = do_action('lead_activity_log_default_sort', 'ASC');

        $this->db->where('leadid', $id);
        $this->db->order_by('date', $sorting);

        return $this->db->get('tblleadactivitylog')->result_array();
    }

    public function staff_can_access_lead($id, $staff_id = '')
    {
        $staff_id = $staff_id == '' ? get_staff_user_id() : $staff_id;

        if (has_permission('leads', $staff_id, 'view')) {
            return true;
        }

       // if (total_rows('tblleads', 'id="' . $id . '" AND (assigned=' . $staff_id . ' OR is_public=1 OR addedfrom=' . $staff_id . ')') > 0) {
        if (total_rows('tblleadassignstaff', 'lead_id="' . $id . '" AND (staff_id=' . $staff_id . ')') > 0) {
            return true;
        }

        return false;
    }

    /**
     * Add lead activity from staff
     * @param  mixed  $id          lead id
     * @param  string  $description activity description
     */
    public function log_lead_activity($id, $description, $integration = false, $additional_data = '')
    {
        $log = [
            'date'            => date('Y-m-d H:i:s'),
            'description'     => $description,
            'leadid'          => $id,
            'staffid'         => get_staff_user_id(),
            'additional_data' => $additional_data,
            'full_name'       => get_staff_full_name(get_staff_user_id()),
        ];
        if ($integration == true) {
            $log['staffid']   = 0;
            $log['full_name'] = '[CRON]';
        }

        $this->db->insert('tblleadactivitylog', $log);

        return $this->db->insert_id();
    }

    /**
     * Get email integration config
     * @return object
     */
    public function get_email_integration()
    {
        $this->db->where('id', 1);

        return $this->db->get('tblleadsintegration')->row();
    }

    /**
     * Get lead imported email activity
     * @param  mixed $id leadid
     * @return array
     */
    public function get_mail_activity($id)
    {
        $this->db->where('leadid', $id);
        $this->db->order_by('dateadded', 'asc');

        return $this->db->get('tblleadsemailintegrationemails')->result_array();
    }

    /**
     * Update email integration config
     * @param  mixed $data All $_POST data
     * @return boolean
     */
    public function update_email_integration($data)
    {
        $this->db->where('id', 1);
        $original_settings = $this->db->get('tblleadsintegration')->row();

        $data['create_task_if_customer']        = isset($data['create_task_if_customer']) ? 1 : 0;
        $data['active']                         = isset($data['active']) ? 1 : 0;
        $data['delete_after_import']            = isset($data['delete_after_import']) ? 1 : 0;
        $data['notify_lead_imported']           = isset($data['notify_lead_imported']) ? 1 : 0;
        $data['only_loop_on_unseen_emails']     = isset($data['only_loop_on_unseen_emails']) ? 1 : 0;
        $data['notify_lead_contact_more_times'] = isset($data['notify_lead_contact_more_times']) ? 1 : 0;
        $data['mark_public']                    = isset($data['mark_public']) ? 1 : 0;
        $data['responsible']                    = !isset($data['responsible']) ? 0 : $data['responsible'];

        if ($data['notify_lead_contact_more_times'] != 0 || $data['notify_lead_imported'] != 0) {
            if (isset($data['notify_type']) && $data['notify_type'] == 'specific_staff') {
                if (isset($data['notify_ids_staff'])) {
                    $data['notify_ids'] = serialize($data['notify_ids_staff']);
                    unset($data['notify_ids_staff']);
                } else {
                    $data['notify_ids'] = serialize([]);
                    unset($data['notify_ids_staff']);
                }
                if (isset($data['notify_ids_roles'])) {
                    unset($data['notify_ids_roles']);
                }
            } else {
                if (isset($data['notify_ids_roles'])) {
                    $data['notify_ids'] = serialize($data['notify_ids_roles']);
                    unset($data['notify_ids_roles']);
                } else {
                    $data['notify_ids'] = serialize([]);
                    unset($data['notify_ids_roles']);
                }
                if (isset($data['notify_ids_staff'])) {
                    unset($data['notify_ids_staff']);
                }
            }
        } else {
            $data['notify_ids']  = serialize([]);
            $data['notify_type'] = null;
            if (isset($data['notify_ids_staff'])) {
                unset($data['notify_ids_staff']);
            }
            if (isset($data['notify_ids_roles'])) {
                unset($data['notify_ids_roles']);
            }
        }

        // Check if not empty $data['password']
        // Get original
        // Decrypt original
        // Compare with $data['password']
        // If equal unset
        // If not encrypt and save
        if (!empty($data['password'])) {
            $or_decrypted = $this->encryption->decrypt($original_settings->password);
            if ($or_decrypted == $data['password']) {
                unset($data['password']);
            } else {
                $data['password'] = $this->encryption->encrypt($data['password']);
            }
        }

        $this->db->where('id', 1);
        $this->db->update('tblleadsintegration', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }

    public function change_status_color($data)
    {
        $this->db->where('id', $data['status_id']);
        $this->db->update('tblleadsstatus', [
            'color' => $data['color'],
        ]);
    }

    public function update_status_order($data)
    {
        foreach ($data['order'] as $status) {
            $this->db->where('id', $status[0]);
            $this->db->update('tblleadsstatus', [
                'statusorder' => $status[1],
            ]);
        }
    }

    public function get_form($where)
    {
        $this->db->where($where);

        return $this->db->get('tblwebtolead')->row();
    }

    public function add_form($data)
    {
        $data                       = $this->_do_lead_web_to_form_responsibles($data);
        $data['success_submit_msg'] = nl2br($data['success_submit_msg']);
        $data['form_key']           = app_generate_hash();

        if (isset($data['create_task_on_duplicate'])) {
            $data['create_task_on_duplicate'] = 1;
        } else {
            $data['create_task_on_duplicate'] = 0;
        }

        if (isset($data['mark_public'])) {
            $data['mark_public'] = 1;
        } else {
            $data['mark_public'] = 0;
        }

        if (isset($data['allow_duplicate'])) {
            $data['allow_duplicate']           = 1;
            $data['track_duplicate_field']     = '';
            $data['track_duplicate_field_and'] = '';
            $data['create_task_on_duplicate']  = 0;
        } else {
            $data['allow_duplicate'] = 0;
        }

        $data['dateadded'] = date('Y-m-d H:i:s');

        $this->db->insert('tblwebtolead', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            logActivity('New Web to Lead Form Added [' . $data['name'] . ']');

            return $insert_id;
        }

        return false;
    }

    public function update_form($id, $data)
    {
        $data                       = $this->_do_lead_web_to_form_responsibles($data);
        $data['success_submit_msg'] = nl2br($data['success_submit_msg']);

        if (isset($data['create_task_on_duplicate'])) {
            $data['create_task_on_duplicate'] = 1;
        } else {
            $data['create_task_on_duplicate'] = 0;
        }

        if (isset($data['allow_duplicate'])) {
            $data['allow_duplicate']           = 1;
            $data['track_duplicate_field']     = '';
            $data['track_duplicate_field_and'] = '';
            $data['create_task_on_duplicate']  = 0;
        } else {
            $data['allow_duplicate'] = 0;
        }

        if (isset($data['mark_public'])) {
            $data['mark_public'] = 1;
        } else {
            $data['mark_public'] = 0;
        }

        $this->db->where('id', $id);
        $this->db->update('tblwebtolead', $data);

        return ($this->db->affected_rows() > 0 ? true : false);
    }

    public function delete_form($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tblwebtolead');

        $this->db->where('from_form_id', $id);
        $this->db->update('tblleads', [
            'from_form_id' => 0,
        ]);

        if ($this->db->affected_rows() > 0) {
            logActivity('Lead Form Deleted [' . $id . ']');

            return true;
        }

        return false;
    }

    private function _do_lead_web_to_form_responsibles($data)
    {
        if (isset($data['notify_lead_imported'])) {
            $data['notify_lead_imported'] = 1;
        } else {
            $data['notify_lead_imported'] = 0;
        }

        if ($data['responsible'] == '') {
            $data['responsible'] = 0;
        }
        if ($data['notify_lead_imported'] != 0) {
            if ($data['notify_type'] == 'specific_staff') {
                if (isset($data['notify_ids_staff'])) {
                    $data['notify_ids'] = serialize($data['notify_ids_staff']);
                    unset($data['notify_ids_staff']);
                } else {
                    $data['notify_ids'] = serialize([]);
                    unset($data['notify_ids_staff']);
                }
                if (isset($data['notify_ids_roles'])) {
                    unset($data['notify_ids_roles']);
                }
            } else {
                if (isset($data['notify_ids_roles'])) {
                    $data['notify_ids'] = serialize($data['notify_ids_roles']);
                    unset($data['notify_ids_roles']);
                } else {
                    $data['notify_ids'] = serialize([]);
                    unset($data['notify_ids_roles']);
                }
                if (isset($data['notify_ids_staff'])) {
                    unset($data['notify_ids_staff']);
                }
            }
        } else {
            $data['notify_ids']  = serialize([]);
            $data['notify_type'] = null;
            if (isset($data['notify_ids_staff'])) {
                unset($data['notify_ids_staff']);
            }
            if (isset($data['notify_ids_roles'])) {
                unset($data['notify_ids_roles']);
            }
        }

        return $data;
    }


	public function add_reminder($data)
    {

		$date = str_replace("/","-",$data['date']);
		$data['date'] = date("Y-m-d H:i:s",strtotime($date));
        $data['description'] = nl2br($data['description']);
        $this->db->insert('tblreminders', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            if ($data['rel_type'] == 'lead') {
                $this->load->model('leads_model');
                $this->leads_model->log_lead_activity($data['rel_id'], 'not_activity_new_reminder_created', false, serialize([
                    get_staff_full_name($data['staff']),
                    _dt($data['date']),
                    ]));
            }
            logActivity('New Reminder Added [' . ucfirst($data['rel_type']) . 'ID: ' . $data['rel_id'] . ' Description: ' . $data['description'] . ']');

            return true;
        } //$insert_id
        return false;
    }

	public function edit_reminder($data, $id)
    {
        $date = str_replace("/","-",$data['date']);
		$data['date'] = date("Y-m-d H:i:s",strtotime($date));
        $data['description'] = nl2br($data['description']);

        $this->db->where('id', $id);
        $this->db->update('tblreminders', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }

	public function delete_reminder($id)
    {
		$this->db->where('id', $id);
		$this->db->delete('tblreminders');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
    }



	public function add_note($data, $rel_type, $rel_id)
    {
        $data['dateadded']   = date('Y-m-d H:i:s');
        $data['addedfrom']   = get_staff_user_id();
        $data['rel_type']    = $rel_type;
        $data['rel_id']      = $rel_id;
        $data['description'] = nl2br($data['description']);
        $this->db->insert('tblnotes', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            return $insert_id;
        }

        return false;
    }

    public function get_lead($where,$start_from,$limit,$amount_filter)
    {
        if ($amount_filter != ''){
            return $this->db->query("SELECT l.*,p.total FROM `tblleads` as l INNER JOIN `tblproposals` as p ON p.id = (SELECT id FROM `tblproposals` WHERE rel_id = l.id ORDER BY id DESC LIMIT 1) WHERE ".$where." ".$amount_filter." ORDER BY l.id desc LIMIT ".$start_from.",".$limit."")->result();
        }
        return $this->db->query("SELECT * from `tblleads` as l where ".$where." ORDER BY id desc LIMIT ".$start_from.",".$limit." ")->result();
    }

    public function get_lead_count($where, $amount_filter)
    {
        if ($amount_filter != ''){
            return $this->db->query("SELECT count(l.id) as `ttl_count` FROM `tblleads` as l INNER JOIN `tblproposals` as p ON p.id = (SELECT id FROM `tblproposals` WHERE rel_id = l.id ORDER BY id DESC LIMIT 1) WHERE ".$where." ".$amount_filter." ORDER BY l.id desc")->row()->ttl_count;
        }
        return $this->db->query("SELECT count(id) as `ttl_count` from `tblleads` as l where ".$where."  ")->row()->ttl_count;
    }

    public function get_lead_search_details($where,$status_where)
    {

        $qualified_count = $this->db->query("SELECT COALESCE(count(id),0) as ttl_count from `tblleads` where ".$status_where." and status = 1 ")->row()->ttl_count;
        $unqualified_count = $this->db->query("SELECT COALESCE(count(id),0) as ttl_count from `tblleads` where ".$status_where." and status = 2 ")->row()->ttl_count;

        $ttl_amount = 0;
        $lead_info = $this->db->query("SELECT `id` from `tblleads` where ".$where." ")->result();
        if(!empty($lead_info)){
            foreach ($lead_info as $lead) {
                $quotation_info = $this->db->query("SELECT `total` FROM `tblproposals` WHERE total > 0 and `rel_id` = '".$lead->id."' order by id desc  ")->row();
                if(!empty($quotation_info)){
                    $ttl_amount += $quotation_info->total;
                }

            }
        }

        $resutnData = array(
            'qualified_count' => $qualified_count,
            'unqualified_count' => $unqualified_count,
            'ttl_amount' => $ttl_amount,
        );

        return $resutnData;
    }

    /* THIS FUNCTION USE FOR GET LEAD LIST AJAX CALL */
    function get_lead_list(){

        $where = "l.id > 0 and l.created_at > '2021-03-31 23:59:59' ";
        $amount_filter = '';
        if(!empty($_POST)){

            $enquiry_type_id = $this->input->post("enquiry_type_id");
            $lead_type = $this->input->post("lead_type");
            $lead_source = $this->input->post("lead_source");
            $state = $this->input->post("state");
            $city = $this->input->post("city");
            $lead_no = $this->input->post("lead_no");
            $customer_company = $this->input->post("customer_company");
            $client_id = $this->input->post("client_id");
            $f_date = $this->input->post("f_date");
            $t_date = $this->input->post("t_date");
            $f_amount = $this->input->post("f_amount");
            $t_amount = $this->input->post("t_amount");
            $staff_id = $this->input->post("staff_id");

            if(!empty($lead_type)){
                $where .= " and l.enquiry_type_id = '".$lead_type."'";
            }

            if(!empty($lead_source)){
                $where .= " and l.source = '".$lead_source."'";
            }

            if(!empty($status)){
                $where .= " and l.status = '".$status."'";
            }

            if(!empty($state)){
                $where .= " and l.site_state_id = '".$state."'";
            }

            if(!empty($city)){
                $where .= " and l.site_city_id = '".$city."'";
            }

            if(!empty($customer_company)){
                $where .= " and (l.company LIKE '%".$customer_company."%' || l.client_person_name LIKE '%".$customer_company."%')";
            }

            if(!empty($lead_no)){
                $where .= " and (l.leadno LIKE '%".$lead_no."%')";
            }

            if(!empty($client_id)){
                $where .= " and l.client_branch_id = '".$client_id."'";
            }

            if(!empty($enquiry_type_id)){
                $where .= " and l.enquiry_type_main_id = '".$enquiry_type_id."'";
            }

            if(!empty($f_date) && !empty($t_date)){
                $where .= " and l.enquiry_date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }

            if (!empty($f_amount) && !empty($t_amount)){
                $amount_filter .= " and p.total between '".$f_amount."' and '".$t_amount."' ";
            }

            if (!empty($staff_id)){
                $staffids = implode(',', $staff_id);
                $leadids_data = $this->db->query("SELECT lead_id FROM `tblleadassignstaff` WHERE `staff_id` IN (".$staffids.") AND `type` = 2")->result();
                $leads_ids = '0';
                if (!empty($leadids_data)){
                    foreach ($leadids_data as $value) {
                        $leads_ids .= ', '.$value->lead_id;
                    }
                }
                $where .= " and l.id IN (".$leads_ids.") ";
            }
        }
        
        $totalRec = $this->get_lead_count($where, $amount_filter);
        $total_data = $this->get_lead($where, $_POST['start'], $_POST['length'], $amount_filter);
        
        /* START PRODUCT LIST ARRAY */
        $data = array();
        $no = $_POST['start'];
        foreach ($total_data as $value) {

            $client_info = $this->db->query("SELECT * FROM tblclientbranch WHERE userid = '".$value->client_branch_id."' ")->row();

            $assign_info = $this->db->query("SELECT `staff_id` FROM tblleadassignstaff WHERE type = 2 and lead_id = '".$value->id."' ")->row();

            $company = ($value->client_branch_id > 0) ? $client_info->client_branch_name : $value->company;

            if(check_quotation($value->id) == 1){
                $quotation = 'Yes';
            }else{
                $quotation = 'No';
            }

            $checked = ($value->followup == 1 ) ? 'checked' : '';
            $toggleActive = '<div class="onoffswitch">
                <input type="checkbox" data-switch-url="' . admin_url() . 'leads/change_followup_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $value->id . '" data-id="' . $value->id . '" ' . $checked . '>
                <label class="onoffswitch-label" for="' . $value->id . '"></label>
            </div>';

            $contact_info = $this->db->query("SELECT c.id from tblcontacts as c LEFT JOIN tblenquiryclientperson as cp ON cp.contact_id = c.id where cp.enquiry_id = '".$value->id."' and c.phonenumber != '' ")->row();

            //getting last quotation amount
            $amount = '0.00';
            $quotation_info = $this->db->query("SELECT `total` FROM `tblproposals` WHERE total > 0 and `rel_id` = '".$value->id."' order by id desc  ")->row();
            if(!empty($quotation_info)){
                $amount = $quotation_info->total;
            }

            $status = $this->db->query("SELECT * from `tblleadsstatus` where id = '".$value->status."' ")->row_array();
            $type = $this->db->query("SELECT * from `tblenquirytypemaster` where id = '".$value->enquiry_type_id."' ")->row_array();
            $maintype = $this->db->query("SELECT * from `tblmainenquirytypemaster` where id = '".$value->enquiry_type_main_id."' ")->row_array();
            if ($value->enquiry_type_main_id > 0){
                $leadtype_info = $this->db->query("SELECT * from `tblenquirytypemaster` where enquiry_type_main_id = ".$value->enquiry_type_main_id." AND status = 1 ")->result();
            }else{
                $leadtype_info = $this->db->query("SELECT * from `tblenquirytypemaster` where status = 1 ")->result();
            }

            $outputType = '<div class="row"><div class="col-md-12 enquirymaintype'.$value->id.'"><span class="inline-block label label-' . (empty($maintype['color']) ? 'default': '') . '" style="color:' . $maintype['color'] . ';border:1px solid ' . $maintype['color'] . '">' . cc($maintype['name']);
                $outputType .= '<div class="dropdown inline-block mleft5 table-export-exclude">';
                $outputType .= '<a href="#" style="font-size:14px;vertical-align:middle;" class="dropdown-toggle text-dark" id="tablemainLeadsStatus-' . $value->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                $outputType .= '<span data-toggle="tooltip" title="' . _l('ticket_single_change_status') . '"><i class="fa fa-caret-down" aria-hidden="true"></i></span>';
                $outputType .= '</a>';

                $outputType .= '<ul class="dropdown-menu dropdown-menu-right scroll" aria-labelledby="tablemainLeadsStatus-' . $value->id . '">';
                
                $mainleadtype_info = $this->db->query("SELECT * from `tblmainenquirytypemaster` where status = 1 ORDER BY name ASC")->result();
                foreach ($mainleadtype_info as $mainleadChangeType) {
                    if ($value->enquiry_type_main_id != $mainleadChangeType->id) {
                        $outputType .= '<li>
                        <a href="#" onclick="change_lead_main_status('.$value->enquiry_type_main_id.',' . $mainleadChangeType->id . ',' . $value->id . '); return false;">
                            ' . cc($mainleadChangeType->name) . '
                        </a>
                    </li>';
                    }
                }
                $outputType .= '</ul>';
                $outputType .= '</div>';
            $outputType .= '</span></div><br><br>';
            
            $outputType .= '<div class="col-md-12 enquirytype'.$value->id.'"><span class="inline-block label label-' . (empty($type['color']) ? 'default': '') . '" style="color:' . $type['color'] . ';border:1px solid ' . $type['color'] . '">' . cc($type['name']);
                $outputType .= '<div class="dropdown inline-block mleft5 table-export-exclude">';
                $outputType .= '<a href="#" style="font-size:14px;vertical-align:middle;" class="dropdown-toggle text-dark" id="tableLeadsStatus-' . $value->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                $outputType .= '<span data-toggle="tooltip" title="' . _l('ticket_single_change_status') . '"><i class="fa fa-caret-down" aria-hidden="true"></i></span>';
                $outputType .= '</a>';

                $outputType .= '<ul class="dropdown-menu dropdown-menu-right scroll" aria-labelledby="tableLeadsStatus-' . $value->id . '">';
                foreach ($leadtype_info as $leadChangeType) {
                    if ($value->enquiry_type_id != $leadChangeType->id) {
                        $outputType .= '<li>
                        <a href="#" onclick="change_lead_type('.$value->enquiry_type_id.',' . $leadChangeType->id . ',' . $value->id . '); return false;">
                            ' . cc($leadChangeType->name) . '
                        </a>
                    </li>';
                    }
                }
                $outputType .= '</ul>';
                $outputType .= '</div>';
            $outputType .= '</span></div></div>';

            $leadcontact = "--";
            if(!empty($contact_info)){
                $urlcontact = admin_url('leads/lead_contact/'.$value->id);
                $leadcontact = '<a target="_blank" href="'.$urlcontact.'"><img src="https://schachengineers.com/schacrm/assets/images/make_call.png" width="35" height="35"></a><br>';
                $leadcontact .= cc(value_by_id('tblenquirytypemaster',$value->enquiry_type_id,'name'));
            }    

            $sales_parson = "--";
            if(!empty($assign_info)) { 
                $sales_parson = '<a target="_blank" href="'.admin_url('staff/member/'.$assign_info->staff_id).'">'.get_employee_name($assign_info->staff_id).'</a>';
            }

            $leadstatus = value_by_id("tblleadprocess", $value->process_id, "name");
            if ($value->process_id == 6){
                $leadstatus = '<a href="javascript:void(0);" data-remark="'.cc($value->lost_remark).'" class="lostremark" data-target="#showlostremark" data-toggle="modal">'.$leadstatus.'</a>';
            }
            $client_text = ($value->client_branch_id > 0) ? 'Update Client' : 'Make Client';
            $client_btn = ($value->client_branch_id > 0) ? 'btn-update' : 'btn-update';
            $lead_count = get_lead_call_count($value->id);
            $action_html = '<a href="'.admin_url("leads/lead_contact/".$value->id).'" class="dot circle-blue"><p>'.$lead_count["ttl_calls"].'</p></a>
                            <a href="'.admin_url("leads/lead_contact/".$value->id).'" class="dot circle-success"><p>'.$lead_count["ttlattend_calls"].'</p></a>
                            <a href="'.admin_url("leads/lead_contact/".$value->id).'" class="dot circle-danger"><p>'.$lead_count["ttlmissed_calls"].'</p></a>
                            <a href="'.admin_url("follow_up/lead_activity/".$value->id).'" class="dot circle-warning"><p>'.$lead_count["ttlactivity"].'</p></a>';
            $action_html .= '<div class="btn-group pull-right">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right toggle-menu"><li>';
                                if(check_permission_page(3,'edit')){
                                    $action_html .= '<a href="'.admin_url('leads/leads/' . $value->id).'" class="" title="Edit">Edit</a>';        
                                }
                                if(!empty($contact_info)){
                                    $action_html .= '<a target="_blank" href="'.admin_url('leads/lead_contact/'.$value->id).'">Lead Contact</a>';
                                }
                                $action_html .= '<a target="_blank" class="" href="'.admin_url('follow_up/lead_activity/'.$value->id).'" title="Active">Activity</a>';
                                $action_html .= '<a target="_blank" class="" href="'.admin_url('follow_up/special_lead_activity/'.$value->id).'" title="Active">Special Lead activity</a>';                        
                                $action_html .= '<button type="button" class="'.$client_btn.' update_client" data-toggle="modal" data-target="#clientModal" value="'.$value->id.'">'.$client_text.'</button>'; 
                                if(check_permission_page(3,'delete')){
                                    $action_html .= '<a href="'.admin_url('leads/delete/' . $value->id).'" class="_delete" title="Delete">Delete</a>';
                                }  
                                $action_html .='<a href="javascript:void(0);" class="btn-with-tooltip lead-email" data-id="'.$value->id.'"  data-target="#lead_send_to_customer" id="send_mail" data-toggle="modal">
                                                <span data-toggle="tooltip" class="btn-with-tooltip" data-title="Send to Email" data-placement="bottom" data-original-title="" title="">Send to Email</span>
                                            </a>';
                                if ($value->process_id < 6) {
                                    $action_html .='<a href="javascript:void(0);" class="btn-with-tooltip lost-leads btn btn-danger" data-id="'.$value->id.'"  data-target="#lead_lost" id="lost_lead_remark" data-toggle="modal">
                                                        <span data-toggle="tooltip" class="btn-with-tooltip" data-title="Lost Lead" data-placement="bottom" data-original-title="" title="">Lost Lead</span>
                                                    </a>';
                                }     
                                
            $action_html .= '   </li>
                                </ul>
                            </div>';                                    
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a target="_blank" href="'.admin_url('leads/lead_profile/' . $value->id).'"> LEAD-'.number_series($value->id).'</a>';
            $row[] = cc($company).'<br/>'.$outputType;
            $row[] = $quotation;
            $row[] = _d($value->enquiry_date);
            $row[] = $leadcontact;
            $row[] = value_by_id('tblleadssources',$value->source,'name');
            $row[] = $amount;
            $row[] = $sales_parson;
            $row[] = $toggleActive;
            $row[] = $leadstatus;
            $row[] = $action_html;
           
            /* THIS CODE FOR LIVE SEARCHING */
            $show_row = TRUE;
            if(!empty($_POST['search']) && $_POST['search']['value']){
                $search_val = trim($_POST['search']['value']);
                $lead_no = 'LEAD-'.number_series($value->id);
                $columns_val = array();
                foreach ($row as  $column) {
                    if (strpos($column, strtoupper($search_val)) !== false || strpos($column, cc($search_val)) !== false){
                        $show_row = TRUE;
                        $columns_val[] = 1;
                    }
                }
                if (empty($columns_val)){
                    $row[0] = $no--;
                    $show_row = FALSE;
                }
            }                    
            if ($show_row == TRUE){
                $data[] = $row;
            }                  
        }
        /* END PRODUCT LIST ARRAY */

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->count_all(),
            "recordsFiltered" => $totalRec,
            "data" => $data,
        ); 

        return $output;
    }

    /* this function use for count all products */
    public function count_all()
    {
        $this->db->where('l.id >', 0);
        $this->db->where('l.created_at >', '2021-03-31 23:59:59');
        $this->db->from($this->table_name);
        return $this->db->count_all_results();
    }

}
