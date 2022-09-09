<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Proposals_model extends CRM_Model
{
    private $statuses;

    private $copy = false;

    public function __construct()
    {
        parent::__construct();
        $this->statuses = do_action('before_set_proposal_statuses', [
            6,
            4,
            1,
            5,
            2,
            3,
        ]);
    }

    public function get_statuses()
    {
        return $this->statuses;
    }

    public function get_sale_agents()
    {
        return $this->db->query('SELECT DISTINCT(assigned) as sale_agent FROM tblproposals WHERE assigned != 0')->result_array();
    }

    public function get_proposals_years()
    {
        return $this->db->query('SELECT DISTINCT(YEAR(date)) as year FROM tblproposals')->result_array();
    }

    public function do_kanban_query($status, $search = '', $page = 1, $sort = [], $count = false)
    {
        $default_pipeline_order      = get_option('default_proposals_pipeline_sort');
        $default_pipeline_order_type = get_option('default_proposals_pipeline_sort_type');
        $limit                       = get_option('proposals_pipeline_limit');

        $has_permission_view                 = has_permission('proposals', '', 'view');
        $has_permission_view_own             = has_permission('proposals', '', 'view_own');
        $allow_staff_view_proposals_assigned = get_option('allow_staff_view_proposals_assigned');
        $staffId                             = get_staff_user_id();

        $this->db->select('id,invoice_id,estimate_id,subject,rel_type,rel_id,total,date,open_till,currency,proposal_to,status');
        $this->db->from('tblproposals');
        $this->db->where('status', $status);
        if (!$has_permission_view) {
            $this->db->where(get_proposals_sql_where_staff(get_staff_user_id()));
        }
        if ($search != '') {
            if (!_startsWith($search, '#')) {
                $this->db->where('(
                phone LIKE "%' . $search . '%"
                OR
                zip LIKE "%' . $search . '%"
                OR
                content LIKE "%' . $search . '%"
                OR
                state LIKE "%' . $search . '%"
                OR
                city LIKE "%' . $search . '%"
                OR
                email LIKE "%' . $search . '%"
                OR
                address LIKE "%' . $search . '%"
                OR
                proposal_to LIKE "%' . $search . '%"
                OR
                total LIKE "%' . $search . '%"
                OR
                subject LIKE "%' . $search . '%")');
            } else {
                $this->db->where('tblproposals.id IN
                (SELECT rel_id FROM tbltags_in WHERE tag_id IN
                (SELECT id FROM tbltags WHERE name="' . strafter($search, '#') . '")
                AND tbltags_in.rel_type=\'proposal\' GROUP BY rel_id HAVING COUNT(tag_id) = 1)
                ');
            }
        }

        if (isset($sort['sort_by']) && $sort['sort_by'] && isset($sort['sort']) && $sort['sort']) {
            $this->db->order_by($sort['sort_by'], $sort['sort']);
        } else {
            $this->db->order_by($default_pipeline_order, $default_pipeline_order_type);
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
     * Inserting new proposal function
     * @param mixed $data $_POST data
     */
    public function add($data)
    {
//        echo"<pre>";print_r($data);exit;
		$data['allow_comments'] = isset($data['allow_comments']) ? 1 : 0;
        $save_and_send = isset($data['save_and_send']);
        $tags = isset($data['tags']) ? $data['tags'] : '';
        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            unset($data['custom_fields']);
        }
        if(!empty($data['assignid'])){
            $assignstaff=$data['assignid'];
        }

        $data['source'] = implode(',', $data['source']);

        $data['address'] = trim($data['address']);
        $data['address'] = nl2br($data['address']);
		$rentproposal=$data['rentproposal'];
		$saleproposal=$data['saleproposal'];
		$productfields= (isset($data['productfields'])) ? $data['productfields'] : [];
		$othercharges=$data['othercharges'];
		$saleothercharges=$data['saleothercharges'];
        $data['datecreated'] = date('Y-m-d H:i:s');
        $data['addedfrom']   = get_staff_user_id();
        $data['hash']        = app_generate_hash();
		$data['total']=$data['saleproposal']['totalamount']+$data['rentproposal']['totalamount'];
		$data['subtotal']=$data['saleproposal']['finalsubtotalamount']+$data['rentproposal']['finalsubtotalamount'];

        if(empty($data['saleproposal']['finaldiscountpercentage'])){
            $data['saleproposal']['finaldiscountpercentage'] = 0;
        }

        if(empty($data['rentproposal']['finaldiscountpercentage'])){
            $data['rentproposal']['finaldiscountpercentage'] = 0;
        }

		$data['discount_percent']=$data['saleproposal']['finaldiscountpercentage']+$data['rentproposal']['finaldiscountpercentage'];
		$data['discount_total']=$data['saleproposal']['finaldiscountamount']+$data['rentproposal']['finaldiscountamount'];
		$data['saletotal']=$data['saleproposal']['totalamount'];
		$data['renttotal']=$data['rentproposal']['totalamount'];
		$data['salesubtotal']=$data['saleproposal']['finalsubtotalamount'];
		$data['rentsubtotal']=$data['rentproposal']['finalsubtotalamount'];
		if($data['saleproposal']['finaldiscountpercentage']!='')
		{
			$data['sale_discount_percent']=$data['saleproposal']['finaldiscountpercentage'];
		}
		else
		{
			$data['sale_discount_percent']=0;
		}
		if($data['rentproposal']['finaldiscountpercentage']!='')
		{
			$data['rent_discount_percent']=$data['rentproposal']['finaldiscountpercentage'];
		}
		else
		{
			$data['rent_discount_percent']=0;
		}
		$data['sale_discount_total']=$data['saleproposal']['finaldiscountamount'];
		$data['rent_discount_total']=$data['rentproposal']['finaldiscountamount'];
		if(count($rentproposal)>0)
		{
            if(!empty($data['rentproposal'][1]['isgst'])){
                $data['is_gst']=$data['rentproposal'][1]['isgst'];
            }else{
                $data['is_gst'] = 0;
            }
		}
		else if(count($saleproposal)>0)
		{
            if(!empty($data['saleproposal'][1]['isgst'])){
                $data['is_gst']=$data['saleproposal'][1]['isgst'];
            }else{
                $data['is_gst'] = 0;
            }
		}
        $data['group_id'] = $data['assign'];
        $group_id=$data['assign'];
        unset($data['assign']);
        unset($data['rentproposal']);
        unset($data['service_type']);
        unset($data['assignid']);
        unset($data['othercharges']);
        unset($data['saleothercharges']);
        unset($data['saleproposal']);
        unset($data['productfields']);
		if (empty($data['rel_type'])) {
            unset($data['rel_type']);
            unset($data['rel_id']);
        } else {
            if (empty($data['rel_id'])) {
                unset($data['rel_type']);
                unset($data['rel_id']);
            }
        }

        $items = [];
        if (isset($data['newitems'])) {
            $items = $data['newitems'];
            unset($data['newitems']);
        }

        if ($this->copy == false) {
            $data['content'] = '{proposal_items}';
        }

        $hook_data = do_action('before_create_proposal', [
            'data'  => $data,
            'items' => $items,
        ]);
        $data  = $hook_data['data'];
        $items = $hook_data['items'];


        //getting tax type
        //$data['tax_type'] = get_proposal_gst_type($data['state']);

        $data['billing_branch_id'] = get_login_branch();

        /*if(count($rentproposal) > 4){
            $data['number'] = get_quotation_number(1);
        }else{
            $data['number'] = get_quotation_number(2);
        }*/


        $proposal_number = '0';
        $number_arr = explode("/",$data['number']);

        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            if(!empty($number_arr[3])){
                $proposal_number = $number_arr[3];
            }
        }else{
            if(!empty($number_arr[0])){
                $proposal_number = $number_arr[0];
            }
        }

        $data['year_id'] = financial_year();
        $data['proposal_number'] = $proposal_number;

        /* this is for new terms and condition */
        $terms_conditionarr = (isset($data["termscondition"])) ? $data["termscondition"] : [];
        unset($data["termscondition"]);
        unset($data["relsection_id"]);

        $this->db->insert('tblproposals', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id)
		    {

                /* store terms and condtion in new table */
                if (!empty($terms_conditionarr)){
                    foreach ($terms_conditionarr as $terms) {
                        if (!empty($terms['condition'])){
                            $insertterms["rel_id"] = $insert_id;
                            $insertterms["rel_type"] = 'proposal';
                            $insertterms["condition_type"] = 2;
                            $insertterms["condition"] = $terms['condition'];
                            $this->home_model->insert('tbltermsandconditionsales', $insertterms);
                        }
                    }
                }
                unset($rentproposal['finalsubtotalamount']);
                unset($rentproposal['finaldiscountpercentage']);
                unset($rentproposal['finaldiscountamount']);
                unset($rentproposal['totalamount']);
            
                foreach($othercharges as $odata)
                {
                    if (!empty($odata['amount'])){
                        if(!isset($odata['igst'])){$totaltax=$odata['gst']+$odata['sgst'];$odata['isgst']=1;}else{$totaltax=$odata['igst'];$odata['isgst']=0;}
                        $otherchargeamt[]=$odata['amount']+(($odata['amount']*$totaltax)/100);
                        $odata['proposalid']=$insert_id;
                        $odata['is_sale']=0;
                        $odata['created_at'] = date("Y-m-d H:i:s");
                        $odata['updated_at'] = date("Y-m-d H:i:s");
                        $this->db->insert('tblproposalothercharges',$odata);
                    }
                }

                foreach($productfields as $singleprofield)
                {
          			$podata['proposalid']=$insert_id;
          			$podata['field_id']=$singleprofield;
        		    $podata['created_at'] = date("Y-m-d H:i:s");
                    $podata['updated_at'] = date("Y-m-d H:i:s");
      		        $this->db->insert('tblproposalproductfields',$podata);
      		    }
                foreach($saleothercharges as $osdata)
                {
                    if (!empty($osdata['amount'])){
                        if(!isset($osdata['igst'])){$totalsaletax=$osdata['gst']+$osdata['sgst'];$osdata['isgst']=1;}else{$totalsaletax=$osdata['igst'];$osdata['isgst']=0;}
                        $otherchargesaleamt[]=$osdata['amount']+(($osdata['amount']*$totalsaletax)/100);
                        $osdata['proposalid']=$insert_id;
                        $osdata['is_sale']=1;
                        $osdata['created_at'] = date("Y-m-d H:i:s");
                        $osdata['updated_at'] = date("Y-m-d H:i:s");
                        $this->db->insert('tblproposalothercharges',$osdata);
                    }
      		    }
                $totalothercharges = (isset($otherchargeamt)) ? array_sum($otherchargeamt) : 0;
                $totalothersalecharges = (isset($otherchargesaleamt)) ? array_sum($otherchargesaleamt) : 0;
                $otherdata['rent_othercharges_amount']=$totalothercharges;
                $otherdata['sale_othercharges_amount']=$totalothersalecharges;
                $this->db->where('id', $insert_id);
                $this->db->update('tblproposals', $otherdata);
                foreach($rentproposal as $singlerentalpro)
                {
                    if(isset($singlerentalpro['temp_product'])){
                        $singlerentalpro['temp_product'] = $singlerentalpro['temp_product'];
                    }else{
                        $singlerentalpro['temp_product'] = 0;
                    }

                    if($singlerentalpro['temp_product'] == 0){
                        $description = get_product_print_name($singlerentalpro['product_id']);
                    }else{
                        $description = value_by_id('tbltemperoryproduct',$singlerentalpro['product_id'],'product_name');
                    }

                    $log_description = $singlerentalpro['remark'];
                    /*if ($singlerentalpro['remark'] != ''){
                        $log_description = htmlspecialchars($singlerentalpro['remark'], ENT_QUOTES);
                    }*/
                    
                    $itemdata['rel_type']=$data['rel_type'];
                    $itemdata['rel_id']=$insert_id;
                    $itemdata['pro_id']=$singlerentalpro['product_id'];
                    $itemdata['description']=$description;
                    $itemdata['hsn_code']=$singlerentalpro['hsn_code'];
                    $itemdata['long_description']=$log_description;
                    $itemdata['qty']=$singlerentalpro['qty'];
                    $itemdata['weight']=$singlerentalpro['weight'];
                    $itemdata['months']=$singlerentalpro['months'];
                    $itemdata['days']=$singlerentalpro['days'];
                    $itemdata['rate']=$singlerentalpro['price'];
                    $itemdata['rate_view']=$singlerentalpro['price_view'];
                    $itemdata['discount']=$singlerentalpro['discount'];
                    $itemdata['prodtax'] =$singlerentalpro['prodtax'];
                    $itemdata['is_gst']=$singlerentalpro['isgst'];
                    $itemdata['temp_product']=$singlerentalpro['temp_product'];
                    $itemdata['is_sale']=0;
                    $is_gst=$singlerentalpro['isgst'];
                    $this->db->insert('tblitems_in',$itemdata);
                    $itemid = $this->db->insert_id();
                    $taxdata['itemid']=$itemid;
                    $taxdata['rel_id']=$insert_id;
                    $taxdata['rel_type']=$data['rel_type'];
                    $taxdata['taxrate']=18;
                    $tax = ($is_gst==1) ? 'GST/SGST' : 'IGST';
                    $taxdata['taxname']=$tax;

                    $this->db->insert('tblitemstax',$taxdata);
                }

                unset($saleproposal['finalsubtotalamount']);
                unset($saleproposal['finaldiscountpercentage']);
                unset($saleproposal['finaldiscountamount']);
                unset($saleproposal['totalamount']);
                foreach($saleproposal as $singlesalepro)
                {
                    if(isset($singlesalepro['temp_product'])){
                        $singlesalepro['temp_product'] = $singlesalepro['temp_product'];
                    }else{
                        $singlesalepro['temp_product'] = 0;
                    }

                    if($singlesalepro['temp_product'] == 0){
                        $description = get_product_print_name($singlesalepro['product_id']);
                    }else{
                        $description = value_by_id('tbltemperoryproduct',$singlesalepro['product_id'],'product_name');
                    }

                    $log_description = $singlesalepro['remark'];
                    /*if ($singlesalepro['remark'] != ''){
                        $log_description = htmlspecialchars($singlesalepro['remark'], ENT_QUOTES);
                    }*/

                    $saleitemdata['rel_type']=$data['rel_type'];
                    $saleitemdata['rel_id']=$insert_id;
                    $saleitemdata['pro_id']=$singlesalepro['product_id'];
                    $saleitemdata['description']=$description;
                    $saleitemdata['hsn_code']=$singlesalepro['hsn_code'];
                    $saleitemdata['long_description']=$log_description;
                    $saleitemdata['qty']=$singlesalepro['qty'];
                    $saleitemdata['weight']=$singlesalepro['weight'];
                    $saleitemdata['rate']=$singlesalepro['price'];
                    $saleitemdata['discount']=$singlesalepro['discount'];
                    $saleitemdata['prodtax'] =$singlesalepro['prodtax'];
                    $saleitemdata['is_gst']=$singlesalepro['isgst'];
                    $saleitemdata['temp_product']=$singlesalepro['temp_product'];
                    $saleitemdata['is_sale']=1;
                    $is_gst=$singlesalepro['isgst'];
                    $this->db->insert('tblitems_in',$saleitemdata);
                    $saleitemid = $this->db->insert_id();

                    $saletaxdata['itemid']=$saleitemid;
                    $saletaxdata['rel_id']=$insert_id;
                    $saletaxdata['rel_type']=$data['rel_type'];
                    $saletaxdata['taxrate']=18;
                    $tax = ($is_gst==1) ? 'GST/SGST' : 'IGST';
                    $saletaxdata['taxname']=$tax;
                    $this->db->insert('tblitemstax',$saletaxdata);
                }
                if (isset($custom_fields)) {
                    handle_custom_fields_post($insert_id, $custom_fields);
                }
                // handle_tags_save($tags, $insert_id, 'proposal');

            /* foreach ($items as $key => $item) {
                    if ($itemid = add_new_sales_items_post($item, $insert_id, 'proposal')) {
                        _maybe_insert_post_item_tax($itemid, $item, $insert_id, 'proposal');
                    }
                }*/

                $assignstaffarr = array();
                $lead_staff_info = $this->db->query("SELECT * FROM tblleadstaffgroup where id = '".$group_id."' ")->row_array();
                $superiordata = explode(',', $lead_staff_info['superior_ids']);
                if (!empty($superiordata)){
                    foreach ($superiordata as $staffid) {
                        array_push($assignstaffarr, $staffid);
                    }
                }
                $quotedata = explode(',', $lead_staff_info['quote_person_ids']);
                if (!empty($quotedata)){
                    foreach ($quotedata as $staffid) {
                        array_push($assignstaffarr, $staffid);
                    }
                }
                $saledata = $lead_staff_info['sales_person_id'];
                if (!empty($saledata)){
                    array_push($assignstaffarr, $saledata);
                }
                $assign_arr = array_unique($assignstaffarr);
                if(!empty($assign_arr))
                {
                foreach($assign_arr as $staffid)
                    {
                        $sdata['staff_id']=$staffid;
                        $sdata['lead_id']=$insert_id;
                        $sdata['status'] = '1';
                        $sdata['created_at'] = date("Y-m-d H:i:s");
                        $sdata['updated_at'] = date("Y-m-d H:i:s");
                        $this->db->insert('tblproposalassignstaff', $sdata);

                        $proposal_subject = (isset($proposal)) ? $proposal->subject : '';
                        $notified = add_notification([
                            'description'     => 'not_proposal_assigned_to_you',
                            'touserid'        => $staffid,
                            'fromuserid'      => get_staff_user_id(),
                            'link'            => 'proposals/list_proposals/' . $insert_id,
                            'additional_data' => serialize([
                                $proposal_subject,
                            ]),
                        ]);
                        if ($notified) {
                            pusher_trigger_notification([$staffid]);
                        }
                    }
                }


//            if(!empty($assignstaff)){
//               foreach($assignstaff as $single_staff)
//                {
//                    if (strpos($single_staff, 'staff') !== false)
//                    {
//                        $staff_id[]=str_replace("staff","",$single_staff);
//                    }
//                    if (strpos($single_staff, 'group') !== false)
//                    {
//                        $single_staff=str_replace("group","",$single_staff);
//                        $staffgroup=$this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='".$single_staff."'")->result_array();
//                        foreach($staffgroup as $singlestaff)
//                        {
//                            $staff_id[]=$singlestaff['staff_id'];
//                        }
//                    }
//                }
//                $staff_id=array_unique($staff_id);
//                foreach($staff_id as $staffid)
//                {
//                    $sdata['staff_id']=$staffid;
//                    $sdata['lead_id']=$insert_id;
//                    $sdata['status'] = '1';
//                    $sdata['created_at'] = date("Y-m-d H:i:s");
//                    $sdata['updated_at'] = date("Y-m-d H:i:s");
//                    $this->db->insert('tblproposalassignstaff', $sdata);
//                    $notified = add_notification([
//                            'description'     => 'not_proposal_assigned_to_you',
//                            'touserid'        => $staffid,
//                            'fromuserid'      => get_staff_user_id(),
//                            'link'            => 'proposals/list_proposals/' . $insert_id,
//                            'additional_data' => serialize([
//                                $proposal->subject,
//                            ]),
//                        ]);
//                        if ($notified) {
//                            pusher_trigger_notification([$staffid]);
//                        }
//                    //$this->lead_assigned_member_notification($insert_id, $staffid);
//                }
//            }


                    $proposal = $this->get($insert_id);
                    if ($proposal->assigned != 0) {
                        if ($proposal->assigned != get_staff_user_id()) {
                            $notified = add_notification([
                                'description'     => 'not_proposal_assigned_to_you',
                                'touserid'        => $proposal->assigned,
                                'fromuserid'      => get_staff_user_id(),
                                'link'            => 'proposals/list_proposals/' . $insert_id,
                                'additional_data' => serialize([
                                    $proposal->subject,
                                ]),
                            ]);
                            if ($notified) {
                                pusher_trigger_notification([$proposal->assigned]);
                            }
                        }
                    }

            if ($data['rel_type'] == 'lead') {
                $this->load->model('leads_model');
                $this->leads_model->log_lead_activity($data['rel_id'], 'not_lead_activity_created_proposal', false, serialize([
                    '<a href="' . admin_url('proposals/list_proposals/' . $insert_id) . '" target="_blank">' . $data['subject'] . '</a>',
                ]));
            }

            update_sales_total_tax_column($insert_id, 'proposal', 'tblproposals');
            logActivity('New Proposal Created [ID:' . $insert_id . ']');

            if ($save_and_send === true) {
                $this->send_proposal_to_email($insert_id, 'proposal-send-to-customer', true);
            }

            do_action('proposal_created', $insert_id);

            return $insert_id;
        }

        return false;
    }

    /**
     * Update proposal
     * @param  mixed $data $_POST data
     * @param  mixed $id   proposal id
     * @return boolean
     */
    public function update($data, $id) {
        $affectedRows = 0;
        $data['allow_comments'] = isset($data['allow_comments']) ? 1 : 0;
        $current_proposal = $this->get($id);
        $save_and_send = isset($data['save_and_send']);
        $data['address'] = trim($data['address']);
        $data['address'] = nl2br($data['address']);
        $rentproposal = $data['rentproposal'];
        $saleproposal = $data['saleproposal'];
        $productfields = (isset($data['productfields'])) ? $data['productfields'] : [];
        $othercharges = $data['othercharges'];
        $saleothercharges = $data['saleothercharges'];
        if (!empty($data['assignid'])) {
            $assignstaff = $data['assignid'];
        }
        $group_id = $data['assign'];
        $data['group_id'] = $data['assign'];
        unset($data['assign']);
        unset($data['service_type']);


        $data['source'] = implode(',', $data['source']);

        $data['datecreated'] = date('Y-m-d H:i:s');
        //$data['addedfrom']   = get_staff_user_id();
        $data['hash'] = app_generate_hash();
        $data['total'] = $data['saleproposal']['totalamount'] + $data['rentproposal']['totalamount'];
        $data['subtotal'] = $data['saleproposal']['finalsubtotalamount'] + $data['rentproposal']['finalsubtotalamount'];
        $data['discount_percent'] = $data['saleproposal']['finaldiscountpercentage'] + $data['rentproposal']['finaldiscountpercentage'];
        $data['discount_total'] = $data['saleproposal']['finaldiscountamount'] + $data['rentproposal']['finaldiscountamount'];
        $data['saletotal'] = $data['saleproposal']['totalamount'];
        $data['renttotal'] = $data['rentproposal']['totalamount'];
        $data['salesubtotal'] = $data['saleproposal']['finalsubtotalamount'];
        $data['rentsubtotal'] = $data['rentproposal']['finalsubtotalamount'];
        $data['sale_discount_percent'] = $data['saleproposal']['finaldiscountpercentage'];
        $data['rent_discount_percent'] = $data['rentproposal']['finaldiscountpercentage'];
        $data['sale_discount_total'] = $data['saleproposal']['finaldiscountamount'];
        $data['rent_discount_total'] = $data['rentproposal']['finaldiscountamount'];
        if (count($rentproposal) > 0) {
            if (!empty($data['rentproposal'][1]['isgst'])) {
                $data['is_gst'] = $data['rentproposal'][1]['isgst'];
            } else {
                $data['is_gst'] = 0;
            }
        } else if (count($saleproposal) > 0) {
            if (!empty($data['saleproposal'][1]['isgst'])) {
                $data['is_gst'] = $data['saleproposal'][1]['isgst'];
            } else {
                $data['is_gst'] = 0;
            }
        }
        unset($data['rentproposal']);
        unset($data['saleproposal']);
        unset($data['othercharges']);
        unset($data['assignid']);
        unset($data['saleothercharges']);
        unset($data['productfields']);
        if (empty($data['rel_type'])) {
            $data['rel_id'] = null;
            $data['rel_type'] = '';
        } else {
            if (empty($data['rel_id'])) {
                $data['rel_id'] = null;
                $data['rel_type'] = '';
            }
        }
        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            if (handle_custom_fields_post($id, $custom_fields)) {
                $affectedRows++;
            }
            unset($data['custom_fields']);
        }
        $items = [];
        if (isset($data['items'])) {
            $items = $data['items'];
            unset($data['items']);
        }
        $newitems = [];
        if (isset($data['newitems'])) {
            $newitems = $data['newitems'];
            unset($data['newitems']);
        }
        if (isset($data['tags'])) {
            if (handle_tags_save($data['tags'], $id, 'proposal')) {
                $affectedRows++;
            }
        }
        $hook_data = do_action('before_proposal_updated', [
            'data' => $data,
            'id' => $id,
            'items' => $items,
            'newitems' => $newitems,
            'removed_items' => isset($data['removed_items']) ? $data['removed_items'] : [],
        ]);
        $data = $hook_data['data'];
        $data['removed_items'] = $hook_data['removed_items'];
        $newitems = $hook_data['newitems'];
        $items = $hook_data['items'];
        // Delete items checked to be removed from database
        foreach ($data['removed_items'] as $remove_item_id) {
            if (handle_removed_sales_item_post($remove_item_id, 'proposal')) {
                $affectedRows++;
            }
        }


        //getting tax type
        //$data['tax_type'] = get_proposal_gst_type($data['state']);

        $data['billing_branch_id'] = get_login_branch();
        $data['billing_branch_id'] = get_login_branch();
        $proposal_number = '0';
        $number_arr = explode("/", $data['number']);
        if (APP_BASE_URL == 'https://schachengineers.com/nturm/') {
            if (!empty($number_arr[3])) {
                $proposal_number = $number_arr[3];
            }
        } else {
            if (!empty($number_arr[0])) {
                $proposal_number = $number_arr[0];
            }
        }

        $data['year_id'] = financial_year();
        $data['proposal_number'] = $proposal_number;

        /* this is for new terms and condition */
        $terms_conditionarr = (isset($data["termscondition"])) ? $data["termscondition"] : [];
        unset($data["termscondition"]);

        unset($data['removed_items']);
        unset($data['relsection_id']);
        // echo "<pre>";
        // print_r($data);
        // exit;
        $this->db->where('id', $id);
        $this->db->update('tblproposals', $data);
        $insert_id = $id;

        $this->db->where('proposalid', $insert_id);
        $this->db->delete('tblproposalothercharges');
        $this->db->where('proposalid', $insert_id);
        $this->db->delete('tblproposalproductfields');

        /* store terms and condtion in new table */
        if (!empty($terms_conditionarr)){
           $this->home_model->update('tblproposals', array("terms_and_conditions" => NULL), array("id" => $insert_id));
           $this->home_model->delete('tbltermsandconditionsales', array('rel_id' => $insert_id, 'condition_type'=> 2,'rel_type'=> 'proposal'));
           foreach ($terms_conditionarr as $terms) {

               if (!empty($terms['condition'])){
                   $insertterms["rel_id"] = $insert_id;
                   $insertterms["rel_type"] = 'proposal';
                   $insertterms["condition_type"] = 2;
                   $insertterms["condition"] = $terms['condition'];
                   $this->home_model->insert('tbltermsandconditionsales', $insertterms);
               }
           }
        }

        foreach ($othercharges as $odata) {
            if (!isset($odata['igst'])) {
                $totaltax = $odata['gst'] + $odata['sgst'];
                $odata['isgst'] = 1;
            } else {
                $totaltax = $odata['igst'];
                $odata['isgst'] = 0;
            }
            if (!empty($odata['amount'])){
                $otherchargeamt[] = $odata['amount'] + (($odata['amount'] * $totaltax) / 100);
                $odata['proposalid'] = $insert_id;
                $odata['is_sale'] = 0;
                $odata['created_at'] = date("Y-m-d H:i:s");
                $odata['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblproposalothercharges', $odata);
            }
        }
        $totalothercharges = (isset($otherchargeamt)) ? array_sum($otherchargeamt) : 0;
        foreach ($productfields as $singleprofield) {
            $podata['proposalid'] = $insert_id;
            $podata['field_id'] = $singleprofield;
            $podata['created_at'] = date("Y-m-d H:i:s");
            $podata['updated_at'] = date("Y-m-d H:i:s");
            $this->db->insert('tblproposalproductfields', $podata);
        }
        foreach ($saleothercharges as $osdata) {
            if (!isset($osdata['igst'])) {
                $totalsaletax = $osdata['gst'] + $osdata['sgst'];
                $osdata['isgst'] = 1;
            } else {
                $totalsaletax = $osdata['igst'];
                $osdata['isgst'] = 0;
            }
            if (!empty($osdata['amount'])){
                $otherchargesaleamt[] = $osdata['amount'] + (($osdata['amount'] * $totalsaletax) / 100);
                $osdata['proposalid'] = $insert_id;
                $osdata['is_sale'] = 1;
                $osdata['created_at'] = date("Y-m-d H:i:s");
                $osdata['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblproposalothercharges', $osdata);
            }
        }
        $totalsaleothercharges = (isset($otherchargesaleamt)) ? array_sum($otherchargesaleamt) : 0;
        unset($rentproposal['finalsubtotalamount']);
        unset($rentproposal['finaldiscountpercentage']);
        unset($rentproposal['finaldiscountamount']);
        unset($rentproposal['totalamount']);
        $otherdata['rent_othercharges_amount'] = $totalothercharges;
        $otherdata['sale_othercharges_amount'] = $totalsaleothercharges;
        $this->db->where('id', $insert_id);
        $this->db->update('tblproposals', $otherdata);
        $this->db->where('rel_id', $insert_id);
        $this->db->where('rel_type', 'proposal');
        $this->db->delete('tblitems_in');
        $this->db->where('rel_id', $insert_id);
        $this->db->delete('tblitemstax');
        $this->db->where('lead_id', $insert_id);
        $this->db->delete('tblproposalassignstaff');
        foreach ($rentproposal as $singlerentalpro) {
            if (isset($singlerentalpro['temp_product'])) {
                $singlerentalpro['temp_product'] = $singlerentalpro['temp_product'];
            } else {
                $singlerentalpro['temp_product'] = 0;
            }

            if ($singlerentalpro['temp_product'] == 0) {
                $description = get_product_print_name($singlerentalpro['product_id']);
            } else {
                $description = value_by_id('tbltemperoryproduct', $singlerentalpro['product_id'], 'product_name');
            }

            $log_description = $singlerentalpro['remark'];
            /*if ($singlerentalpro['remark'] != ''){
                $log_description = htmlspecialchars($singlerentalpro['remark'], ENT_QUOTES);
            }*/

            $itemdata['rel_type'] = $data['rel_type'];
            $itemdata['rel_id'] = $insert_id;
            $itemdata['pro_id'] = $singlerentalpro['product_id'];
            $itemdata['description'] = $description;
            $itemdata['hsn_code'] = $singlerentalpro['hsn_code'];
            $itemdata['long_description'] = $log_description;
            $itemdata['weight'] = $singlerentalpro['weight'];
            $itemdata['qty'] = $singlerentalpro['qty'];
            $itemdata['months'] = $singlerentalpro['months'];
            $itemdata['days'] = $singlerentalpro['days'];
            $itemdata['rate'] = $singlerentalpro['price'];
            $itemdata['rate_view'] = $singlerentalpro['price_view'];
            $itemdata['discount'] = $singlerentalpro['discount'];
            $itemdata['is_gst'] = $singlerentalpro['isgst'];
            $itemdata['prodtax'] = $singlerentalpro['prodtax'];
            $itemdata['temp_product'] = $singlerentalpro['temp_product'];
            $itemdata['is_sale'] = 0;
            $is_gst = $singlerentalpro['isgst'];
            $this->db->insert('tblitems_in', $itemdata);
            $itemid = $this->db->insert_id();
            $taxdata['itemid'] = $itemid;
            $taxdata['rel_id'] = $insert_id;
            $taxdata['rel_type'] = $data['rel_type'];
            $taxdata['taxrate'] = 18;
            if ($is_gst == 1) {
                $tax = 'GST/SGST';
            } else {
                $tax = 'IGST';
            }
            $taxdata['taxname'] = $tax;
            $this->db->insert('tblitemstax', $taxdata);
        }
        unset($saleproposal['finalsubtotalamount']);
        unset($saleproposal['finaldiscountpercentage']);
        unset($saleproposal['finaldiscountamount']);
        unset($saleproposal['totalamount']);
        foreach ($saleproposal as $singlesalepro) {

            if (isset($singlesalepro['temp_product'])) {
                $singlesalepro['temp_product'] = $singlesalepro['temp_product'];
            } else {
                $singlesalepro['temp_product'] = 0;
            }

            if ($singlesalepro['temp_product'] == 0) {
                $description = get_product_print_name($singlesalepro['product_id']);
            } else {
                $description = value_by_id('tbltemperoryproduct', $singlesalepro['product_id'], 'product_name');
            }

            $log_description = $singlesalepro['remark'];
            /*if ($singlesalepro['remark'] != ''){
                $log_description = htmlspecialchars($singlesalepro['remark'], ENT_QUOTES);
            }*/
            $saleitemdata['rel_type'] = $data['rel_type'];
            $saleitemdata['rel_id'] = $insert_id;
            $saleitemdata['pro_id'] = $singlesalepro['product_id'];
            $saleitemdata['description'] = $description;
            $saleitemdata['hsn_code'] = $singlesalepro['hsn_code'];
            $saleitemdata['long_description'] = $log_description;
            $saleitemdata['weight'] = $singlesalepro['weight'];
            $saleitemdata['qty'] = $singlesalepro['qty'];
            $saleitemdata['rate'] = $singlesalepro['price'];
            $saleitemdata['discount'] = $singlesalepro['discount'];
            $saleitemdata['is_gst'] = $singlesalepro['isgst'];
            $saleitemdata['prodtax'] = $singlesalepro['prodtax'];
            $saleitemdata['temp_product'] = $singlesalepro['temp_product'];
            $saleitemdata['is_sale'] = 1;
            $is_gst = $singlesalepro['isgst'];
            $this->db->insert('tblitems_in', $saleitemdata);
            $saleitemid = $this->db->insert_id();

            $saletaxdata['itemid'] = $saleitemid;
            $saletaxdata['rel_id'] = $insert_id;
            $saletaxdata['rel_type'] = $data['rel_type'];
            $saletaxdata['taxrate'] = 18;
            if ($is_gst == 1) {
                $tax = 'GST/SGST';
            } else {
                $tax = 'IGST';
            }
            $saletaxdata['taxname'] = $tax;
            $this->db->insert('tblitemstax', $saletaxdata);



//			if(!empty($assignstaff)){
//                foreach($assignstaff as $single_staff)
//                {
//                    if (strpos($single_staff, 'staff') !== false)
//                    {
//                        $staff_id[]=str_replace("staff","",$single_staff);
//                    }
//                    if (strpos($single_staff, 'group') !== false)
//                    {
//                        $single_staff=str_replace("group","",$single_staff);
//                        $staffgroup=$this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='".$single_staff."'")->result_array();
//                        foreach($staffgroup as $singlestaff)
//                        {
//                            $staff_id[]=$singlestaff['staff_id'];
//                        }
//                    }
//                }
//                $staff_id=array_unique($staff_id);
//                foreach($staff_id as $staffid)
//                {
//                    $sdata['staff_id']=$staffid;
//                    $sdata['lead_id']=$insert_id;
//                    $sdata['status'] = '1';
//                    $sdata['created_at'] = date("Y-m-d H:i:s");
//                    $sdata['updated_at'] = date("Y-m-d H:i:s");
//                    $this->db->insert('tblproposalassignstaff', $sdata);
//
//                    $notified = add_notification([
//                            'description'     => 'not_proposal_assigned_to_you',
//                            'touserid'        => $staffid,
//                            'fromuserid'      => get_staff_user_id(),
//                            'link'            => 'proposals/list_proposals/' . $insert_id,
//                            'additional_data' => serialize([
//                                $proposal->subject,
//                            ]),
//                        ]);
//                        if ($notified) {
//                            pusher_trigger_notification([$staffid]);
//                        }
//                    //$this->lead_assigned_member_notification($insert_id, $staffid);
//                }
//            }

            $affectedRows++;
            $proposal_now = $this->get($id);
            if ($current_proposal->assigned != $proposal_now->assigned) {
                if ($proposal_now->assigned != get_staff_user_id()) {
                    $notified = add_notification([
                        'description' => 'not_proposal_assigned_to_you',
                        'touserid' => $proposal_now->assigned,
                        'fromuserid' => get_staff_user_id(),
                        'link' => 'proposals/list_proposals/' . $id,
                        'additional_data' => serialize([
                            $proposal_now->subject,
                        ]),
                    ]);
                    if ($notified) {
                        pusher_trigger_notification([$proposal_now->assigned]);
                    }
                }
            }
        }

        /* assign parson for approval */
            $assignstaffarr = array();
            $lead_staff_info = $this->db->query("SELECT * FROM tblleadstaffgroup where id = '" . $group_id . "' ")->row_array();
            $superiordata = explode(',', $lead_staff_info['superior_ids']);
            if (!empty($superiordata)) {
                foreach ($superiordata as $staffid) {
                    array_push($assignstaffarr, $staffid);
                }
            }
            $quotedata = explode(',', $lead_staff_info['quote_person_ids']);
            if (!empty($quotedata)) {
                foreach ($quotedata as $staffid) {
                    array_push($assignstaffarr, $staffid);
                }
            }
            $saledata = $lead_staff_info['sales_person_id'];
            if (!empty($saledata)) {
                array_push($assignstaffarr, $saledata);
            }
            $assign_arr = array_unique($assignstaffarr);
            if (!empty($assign_arr)) {

                $this->db->where('lead_id', $insert_id);
                $this->db->delete('tblproposalassignstaff');
                foreach ($assign_arr as $staffid) {
                    $sdata['staff_id'] = $staffid;
                    $sdata['lead_id'] = $insert_id;
                    $sdata['status'] = '1';
                    $sdata['created_at'] = date("Y-m-d H:i:s");
                    $sdata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tblproposalassignstaff', $sdata);

                    $proposal_subject = (!empty($proposal)) ? $proposal->subject : "";
                    $notified = add_notification([
                        'description' => 'not_proposal_assigned_to_you',
                        'touserid' => $staffid,
                        'fromuserid' => get_staff_user_id(),
                        'link' => 'proposals/list_proposals/' . $insert_id,
                        'additional_data' => serialize([
                            $proposal_subject,
                        ]),
                    ]);
                    if ($notified) {
                        pusher_trigger_notification([$staffid]);
                    }
                }
            }
        if ($save_and_send === true) {
            $this->send_proposal_to_email($id, 'proposal-send-to-customer', true);
        }
        if ($affectedRows > 0) {
            do_action('after_proposal_updated', $id);

            return true;
        }
        return false;
    }

    /**
     * Get proposals
     * @param  mixed $id proposal id OPTIONAL
     * @return mixed
     */
    public function get($id = '', $where = [], $for_editor = false)
    {
        $this->db->where($where);

        if (is_client_logged_in()) {
            $this->db->where('status !=', 0);
        }

        $this->db->select('*,tblcurrencies.id as currencyid, tblproposals.id as id, tblcurrencies.name as currency_name');
        $this->db->from('tblproposals');
        $this->db->join('tblcurrencies', 'tblcurrencies.id = tblproposals.currency', 'left');

        if (is_numeric($id)) {
            $this->db->where('tblproposals.id', $id);
            $proposal = $this->db->get()->row();
            if ($proposal) {
                $proposal->attachments                           = $this->get_attachments($id);
                $proposal->items                                 = get_items_by_type('proposal', $id);
                $proposal->visible_attachments_to_customer_found = false;
                foreach ($proposal->attachments as $attachment) {
                    if ($attachment['visible_to_customer'] == 1) {
                        $proposal->visible_attachments_to_customer_found = true;

                        break;
                    }
                }
                if ($for_editor == false) {
                     $proposal = parse_proposal_content_merge_fields($proposal);
                }
            }

            return $proposal;
        }

        return $this->db->get()->result_array();
    }

    public function clear_signature($id)
    {
        $this->db->select('signature');
        $this->db->where('id', $id);
        $proposal = $this->db->get('tblproposals')->row();

        if ($proposal) {
            $this->db->where('id', $id);
            $this->db->update('tblproposals', ['signature' => null]);

            if (!empty($proposal->signature)) {
                unlink(get_upload_path_by_type('proposal') . $id . '/' . $proposal->signature);
            }

            return true;
        }

        return false;
    }

    public function update_pipeline($data)
    {
        $this->mark_action_status($data['status'], $data['proposalid']);
        foreach ($data['order'] as $order_data) {
            $this->db->where('id', $order_data[0]);
            $this->db->update('tblproposals', [
                'pipeline_order' => $order_data[1],
            ]);
        }
    }

    public function get_attachments($proposal_id, $id = '')
    {
        // If is passed id get return only 1 attachment
        if (is_numeric($id)) {
            $this->db->where('id', $id);
        } else {
            $this->db->where('rel_id', $proposal_id);
        }
        $this->db->where('rel_type', 'proposal');
        $result = $this->db->get('tblfiles');
        if (is_numeric($id)) {
            return $result->row();
        }

        return $result->result_array();
    }

    /**
     *  Delete proposal attachment
     * @param   mixed $id  attachmentid
     * @return  boolean
     */
    public function delete_attachment($id)
    {
        $attachment = $this->get_attachments('', $id);
        $deleted    = false;
        if ($attachment) {
            if (empty($attachment->external)) {
                unlink(get_upload_path_by_type('proposal') . $attachment->rel_id . '/' . $attachment->file_name);
            }
            $this->db->where('id', $attachment->id);
            $this->db->delete('tblfiles');
            if ($this->db->affected_rows() > 0) {
                $deleted = true;
                logActivity('Proposal Attachment Deleted [ID: ' . $attachment->rel_id . ']');
            }
            if (is_dir(get_upload_path_by_type('proposal') . $attachment->rel_id)) {
                // Check if no attachments left, so we can delete the folder also
                $other_attachments = list_files(get_upload_path_by_type('proposal') . $attachment->rel_id);
                if (count($other_attachments) == 0) {
                    // okey only index.html so we can delete the folder also
                    delete_dir(get_upload_path_by_type('proposal') . $attachment->rel_id);
                }
            }
        }

        return $deleted;
    }

    /**
     * Add proposal comment
     * @param mixed  $data   $_POST comment data
     * @param boolean $client is request coming from the client side
     */
    public function add_comment($data, $client = false)
    {
        if (is_staff_logged_in()) {
            $client = false;
        }

        if (isset($data['action'])) {
            unset($data['action']);
        }
        $data['dateadded'] = date('Y-m-d H:i:s');
        if ($client == false) {
            $data['staffid'] = get_staff_user_id();
        }
        $data['content'] = nl2br($data['content']);
        $this->db->insert('tblproposalcomments', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            $proposal = $this->get($data['proposalid']);

            // No notifications client when proposal is with draft status
            if ($proposal->status == '6' && $client == false) {
                return true;
            }

            $merge_fields = [];
            $merge_fields = array_merge($merge_fields, get_proposal_merge_fields($proposal->id));

            $this->load->model('emails_model');

            $this->emails_model->set_rel_id($data['proposalid']);
            $this->emails_model->set_rel_type('proposal');

            if ($client == true) {
                // Get creator and assigned
                $this->db->select('staffid,email,phonenumber');
                $this->db->where('staffid', $proposal->addedfrom);
                $this->db->or_where('staffid', $proposal->assigned);
                $staff_proposal = $this->db->get('tblstaff')->result_array();
                $notifiedUsers  = [];
                foreach ($staff_proposal as $member) {
                    $notified = add_notification([
                        'description'     => 'not_proposal_comment_from_client',
                        'touserid'        => $member['staffid'],
                        'fromcompany'     => 1,
                        'fromuserid'      => null,
                        'link'            => 'proposals/list_proposals/' . $data['proposalid'],
                        'additional_data' => serialize([
                            $proposal->subject,
                        ]),
                    ]);

                    if ($notified) {
                        array_push($notifiedUsers, $member['staffid']);
                    }

                    // Send email/sms to admin that client commented
                    $this->emails_model->send_email_template('proposal-comment-to-admin', $member['email'], $merge_fields);
                    $this->sms->trigger(SMS_TRIGGER_PROPOSAL_NEW_COMMENT_TO_STAFF, $member['phonenumber'], $merge_fields);
                }
                pusher_trigger_notification($notifiedUsers);
            } else {
                // Send email/sms to client that admin commented
                $this->emails_model->send_email_template('proposal-comment-to-client', $proposal->email, $merge_fields);
                $this->sms->trigger(SMS_TRIGGER_PROPOSAL_NEW_COMMENT_TO_CUSTOMER, $proposal->phone, $merge_fields);
            }

            return true;
        }

        return false;
    }

    public function edit_comment($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tblproposalcomments', [
            'content' => nl2br($data['content']),
        ]);
        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }

    /**
     * Get proposal comments
     * @param  mixed $id proposal id
     * @return array
     */
    public function get_comments($id)
    {
        $this->db->where('proposalid', $id);
        $this->db->order_by('dateadded', 'ASC');

        return $this->db->get('tblproposalcomments')->result_array();
    }

    /**
     * Get proposal single comment
     * @param  mixed $id  comment id
     * @return object
     */
    public function get_comment($id)
    {
        $this->db->where('id', $id);

        return $this->db->get('tblproposalcomments')->row();
    }

    /**
     * Remove proposal comment
     * @param  mixed $id comment id
     * @return boolean
     */
    public function remove_comment($id)
    {
        $comment = $this->get_comment($id);
        $this->db->where('id', $id);
        $this->db->delete('tblproposalcomments');
        if ($this->db->affected_rows() > 0) {
            logActivity('Proposal Comment Removed [ProposalID:' . $comment->proposalid . ', Comment Content: ' . $comment->content . ']');

            return true;
        }

        return false;
    }

    /**
     * Copy proposal
     * @param  mixed $id proposal id
     * @return mixed
     */
    public function copy($id)
    {
        $this->copy      = true;
        $proposal        = $this->get($id, [], true);
        $not_copy_fields = [
            'addedfrom',
            'id',
            'datecreated',
            'hash',
            'status',
            'invoice_id',
            'estimate_id',
            'is_expiry_notified',
            'date_converted',
            'acceptance_firstname',
            'acceptance_lastname',
            'acceptance_email',
            'acceptance_date',
            'acceptance_ip',
        ];
        $fields      = $this->db->list_fields('tblproposals');
        $insert_data = [];
        foreach ($fields as $field) {
            if (!in_array($field, $not_copy_fields)) {
                $insert_data[$field] = $proposal->$field;
            }
        }

        $insert_data['addedfrom']   = get_staff_user_id();
        $insert_data['datecreated'] = date('Y-m-d H:i:s');
        $insert_data['date']        = _d(date('Y-m-d'));
        $insert_data['status']      = 6;
        $insert_data['hash']        = app_generate_hash();

        // in case open till is expired set new 7 days starting from current date
        if ($insert_data['open_till'] && get_option('proposal_due_after') != 0) {
            $insert_data['open_till'] = _d(date('Y-m-d', strtotime('+' . get_option('proposal_due_after') . ' DAY', strtotime(date('Y-m-d')))));
        }

        $insert_data['newitems'] = [];
        $custom_fields_items     = get_custom_fields('items');
        $key                     = 1;
        foreach ($proposal->items as $item) {
            $insert_data['newitems'][$key]['description']      = $item['description'];
            $insert_data['newitems'][$key]['long_description'] = clear_textarea_breaks($item['long_description']);
            $insert_data['newitems'][$key]['qty']              = $item['qty'];
            $insert_data['newitems'][$key]['unit']             = $item['unit'];
            $insert_data['newitems'][$key]['taxname']          = [];
            $taxes                                             = get_proposal_item_taxes($item['id']);
            foreach ($taxes as $tax) {
                // tax name is in format TAX1|10.00
                array_push($insert_data['newitems'][$key]['taxname'], $tax['taxname']);
            }
            $insert_data['newitems'][$key]['rate']  = $item['rate'];
            $insert_data['newitems'][$key]['order'] = $item['item_order'];
            foreach ($custom_fields_items as $cf) {
                $insert_data['newitems'][$key]['custom_fields']['items'][$cf['id']] = get_custom_field_value($item['id'], $cf['id'], 'items', false);

                if (!defined('COPY_CUSTOM_FIELDS_LIKE_HANDLE_POST')) {
                    define('COPY_CUSTOM_FIELDS_LIKE_HANDLE_POST', true);
                }
            }
            $key++;
        }

        $id = $this->add($insert_data);

        if ($id) {
            $custom_fields = get_custom_fields('proposal');
            foreach ($custom_fields as $field) {
                $value = get_custom_field_value($proposal->id, $field['id'], 'proposal', false);
                if ($value == '') {
                    continue;
                }
                $this->db->insert('tblcustomfieldsvalues', [
                    'relid'   => $id,
                    'fieldid' => $field['id'],
                    'fieldto' => 'proposal',
                    'value'   => $value,
                ]);
            }

            $tags = get_tags_in($proposal->id, 'proposal');
            handle_tags_save($tags, $id, 'proposal');

            logActivity('Copied Proposal ' . format_proposal_number($proposal->id));

            return $id;
        }

        return false;
    }

    /**
     * Take proposal action (change status) manually
     * @param  mixed $status status id
     * @param  mixed  $id     proposal id
     * @param  boolean $client is request coming from client side or not
     * @return boolean
     */
    public function mark_action_status($status, $id, $client = false)
    {
        $original_proposal = $this->get($id);
        $this->db->where('id', $id);
        $this->db->update('tblproposals', [
            'status' => $status,
        ]);

        if ($this->db->affected_rows() > 0) {
            // Client take action
            if ($client == true) {
                $revert = false;
                // Declined
                if ($status == 2) {
                    $message = 'not_proposal_proposal_declined';
                } elseif ($status == 3) {
                    $message = 'not_proposal_proposal_accepted';
                // Accepted
                } else {
                    $revert = true;
                }
                // This is protection that only 3 and 4 statuses can be taken as action from the client side
                if ($revert == true) {
                    $this->db->where('id', $id);
                    $this->db->update('tblproposals', [
                        'status' => $original_proposal->status,
                    ]);

                    return false;
                }
                $merge_fields = [];
                $merge_fields = array_merge($merge_fields, get_proposal_merge_fields($original_proposal->id));

                // Get creator and assigned;
                $this->db->where('staffid', $original_proposal->addedfrom);
                $this->db->or_where('staffid', $original_proposal->assigned);
                $staff_proposal = $this->db->get('tblstaff')->result_array();
                $notifiedUsers  = [];
                foreach ($staff_proposal as $member) {
                    $notified = add_notification([
                            'fromcompany'     => true,
                            'touserid'        => $member['staffid'],
                            'description'     => $message,
                            'link'            => 'proposals/list_proposals/' . $id,
                            'additional_data' => serialize([
                                format_proposal_number($id),
                            ]),
                        ]);
                    if ($notified) {
                        array_push($notifiedUsers, $member['staffid']);
                    }
                }

                pusher_trigger_notification($notifiedUsers);

                $this->load->model('emails_model');

                $this->emails_model->set_rel_id($id);
                $this->emails_model->set_rel_type('proposal');

                // Send thank you to the customer email template
                if ($status == 3) {
                    foreach ($staff_proposal as $member) {
                        $this->emails_model->send_email_template('proposal-client-accepted', $member['email'], $merge_fields);
                    }
                    $this->emails_model->send_email_template('proposal-client-thank-you', $original_proposal->email, $merge_fields);
                    do_action('proposal_accepted', $id);
                } else {
                    // Client declined send template to admin
                    foreach ($staff_proposal as $member) {
                        $this->emails_model->send_email_template('proposal-client-declined', $member['email'], $merge_fields);
                    }
                    do_action('proposal_declined', $id);
                }
            } else {
                // in case admin mark as open the the open till date is smaller then current date set open till date 7 days more
                if ((date('Y-m-d', strtotime($original_proposal->open_till)) < date('Y-m-d')) && $status == 1) {
                    $open_till = date('Y-m-d', strtotime('+7 DAY', strtotime(date('Y-m-d'))));
                    $this->db->where('id', $id);
                    $this->db->update('tblproposals', [
                        'open_till' => $open_till,
                    ]);
                }
            }
            logActivity('Proposal Status Changes [ProposalID:' . $id . ', Status:' . format_proposal_status($status, '', false) . ',Client Action: ' . (int) $client . ']');

            return true;
        }

        return false;
    }

    /**
     * Delete proposal
     * @param  mixed $id proposal id
     * @return boolean
     */
    public function delete($id)
    {
        $this->clear_signature($id);
        $proposal = $this->get($id);

        $this->db->where('id', $id);
        $this->db->delete('tblproposals');
        if ($this->db->affected_rows() > 0) {
            delete_tracked_emails($id, 'proposal');

            $this->db->where('proposalid', $id);
            $this->db->delete('tblproposalcomments');
            // Get related tasks
            $this->db->where('rel_type', 'proposal');
            $this->db->where('rel_id', $id);

            $tasks = $this->db->get('tblstafftasks')->result_array();
            foreach ($tasks as $task) {
                $this->tasks_model->delete_task($task['id']);
            }

            $attachments = $this->get_attachments($id);
            foreach ($attachments as $attachment) {
                $this->delete_attachment($attachment['id']);
            }

            $this->db->where('relid IN (SELECT id from tblitems_in WHERE rel_type="proposal" AND rel_id="' . $id . '")');
            $this->db->where('fieldto', 'items');
            $this->db->delete('tblcustomfieldsvalues');

            $this->db->where('rel_id', $id);
            $this->db->where('rel_type', 'proposal');
            $this->db->delete('tblitems_in');


            $this->db->where('rel_id', $id);
            $this->db->where('rel_type', 'proposal');
            $this->db->delete('tblitemstax');

            $this->db->where('rel_id', $id);
            $this->db->where('rel_type', 'proposal');
            $this->db->delete('tbltags_in');

            // Delete the custom field values
            $this->db->where('relid', $id);
            $this->db->where('fieldto', 'proposal');
            $this->db->delete('tblcustomfieldsvalues');

            $this->db->where('rel_type', 'proposal');
            $this->db->where('rel_id', $id);
            $this->db->delete('tblreminders');

            $this->db->where('rel_type', 'proposal');
            $this->db->where('rel_id', $id);
            $this->db->delete('tblviewstracking');

            logActivity('Proposal Deleted [ProposalID:' . $id . ']');

            return true;
        }

        return false;
    }

    /**
     * Get relation proposal data. Ex lead or customer will return the necesary db fields
     * @param  mixed $rel_id
     * @param  string $rel_type customer/lead
     * @return object
     */
    public function get_relation_data_values($rel_id, $rel_type)
    {
        $data = new StdClass();
        if ($rel_type == 'customer') {
            $this->db->where('userid', $rel_id);
            $_data = $this->db->get('tblclientbranch')->row();

            $primary_contact_id = get_primary_contact_user_id($rel_id);

            if ($primary_contact_id) {
                $contact     = $this->clients_model->get_contact($primary_contact_id);
                //$data->email = $contact->email;
            }

            $data->phone            = $_data->phonenumber;
            $data->is_using_company = false;
            if (isset($contact)) {
                //$data->to = $contact->firstname . ' ' . $contact->lastname;
				 $data->to               = $_data->client_branch_name;
				 $data->email = $_data->email_id;
            } else {
                if (!empty($_data->company)) {
                    $data->to               = $_data->company;
                    $data->is_using_company = true;
                }
            }
            $data->company = $_data->company;
            $data->address = clear_textarea_breaks($_data->address);
            $data->zip     = $_data->zip;
            $data->country = $_data->country;
            $data->state   = $_data->state;
            $data->city    = $_data->city;

            $default_currency = $this->clients_model->get_customer_default_currency($rel_id);
            if ($default_currency != 0) {
                $data->currency = $default_currency;
            }
        } elseif ($rel_type = 'proposal') {
            $this->db->where('id', $rel_id);
            $_data       = $this->db->get('tblleads')->row();
            $data->phone = $_data->phonenumber;
            $data->source = $_data->source;

            $data->is_using_company = false;

            if (empty($_data->company)) {

			  $clientbranchdet=$this->db->query("SELECT * FROM `tblclientbranch` WHERE `userid`='".$_data->client_branch_id."'")->row_array();
              //$clientbranchdet=$this->db->query("SELECT * FROM `tblclients` WHERE `userid`='".$_data->client_id."'")->row_array();
			  $data->to  = $clientbranchdet['client_branch_name'];
            } else {
                $data->to               = $_data->company;
                $data->is_using_company = true;
            }

            $data->company = $_data->company;
            $data->address = $_data->address;
            $data->email   = $_data->email;
            $data->zip     = $_data->zip;
            $data->country = $_data->country;
            $data->state   = $_data->state;
            $data->city    = $_data->city;
            $data->tax_type    = get_gst_type_by_state($_data->state);
        }

        return $data;
    }

    /**
     * Sent proposal to email
     * @param  mixed  $id        proposalid
     * @param  string  $template  email template to sent
     * @param  boolean $attachpdf attach proposal pdf or not
     * @return boolean
     */
    public function send_expiry_reminder($id)
    {
        $proposal = $this->get($id);
        $pdf      = proposal_pdf($proposal);
        $attach   = $pdf->Output(slug_it($proposal->subject) . '.pdf', 'S');

        // For all cases update this to prevent sending multiple reminders eq on fail
        $this->db->where('id', $proposal->id);
        $this->db->update('tblproposals', [
            'is_expiry_notified' => 1,
        ]);

        $this->load->model('emails_model');

        $this->emails_model->set_rel_id($id);
        $this->emails_model->set_rel_type('proposal');

        $this->emails_model->add_attachment([
            'attachment' => $attach,
            'filename'   => slug_it($proposal->subject) . '.pdf',
            'type'       => 'application/pdf',
        ]);

        $merge_fields = [];
        $merge_fields = array_merge($merge_fields, get_proposal_merge_fields($proposal->id));
        $sent         = $this->emails_model->send_email_template('proposal-expiry-reminder', $proposal->email, $merge_fields);

        if (can_send_sms_based_on_creation_date($proposal->datecreated)) {
            $sms_sent = $this->sms->trigger(SMS_TRIGGER_PROPOSAL_EXP_REMINDER, $proposal->phone, $merge_fields);
        }

        return true;
    }

    public function send_proposal_to_email($id, $template = '', $attachpdf = true, $cc = '')
    {
        $this->load->model('emails_model');

        $this->emails_model->set_rel_id($id);
        $this->emails_model->set_rel_type('proposal');

        $proposal = $this->get($id);

        // Proposal status is draft update to sent
        if ($proposal->status == 6) {
            $this->db->where('id', $id);
            $this->db->update('tblproposals', ['status' => 4]);
            $proposal = $this->get($id);
        }

        /*if ($attachpdf) {
            $pdf    = proposal_pdf($proposal);
            $attach = $pdf->Output(slug_it($proposal->subject) . '.pdf', 'S');
            $this->emails_model->add_attachment([
                'attachment' => $attach,
                'filename'   => slug_it($proposal->subject) . '.pdf',
                'type'       => 'application/pdf',
            ]);
        }*/


        if ($this->input->post('email_attachments')) {
            $_other_attachments = $this->input->post('email_attachments');
            foreach ($_other_attachments as $attachment) {
                $_attachment = $this->get_attachments($id, $attachment);
                $this->emails_model->add_attachment([
                    'attachment' => get_upload_path_by_type('proposal') . $id . '/' . $_attachment->file_name,
                    'filename'   => $_attachment->file_name,
                    'type'       => $_attachment->filetype,
                    'read'       => true,
                ]);
            }
        }

        $merge_fields = [];
        $merge_fields = array_merge($merge_fields, get_proposal_merge_fields($proposal->id));


        $sent         = $this->emails_model->send_email_template($template, $proposal->email, $merge_fields, '', $cc);
        if ($sent) {

            // Set to status sent
            $this->db->where('id', $id);
            $this->db->update('tblproposals', [
                'status' => 4,
            ]);

            do_action('proposal_sent', $id);

            return true;
        }

        return false;
    }


    public function get_proposal($where,$start_from,$limit)
    {

        if(!empty($this->session->userdata('proposal_where_amt_desc'))){
           return $this->db->query("SELECT * from `tblproposals` where ".$where." ORDER BY total desc LIMIT ".$start_from.",".$limit." ")->result();
        }else{
            return $this->db->query("SELECT * from `tblproposals` where ".$where." ORDER BY id desc LIMIT ".$start_from.",".$limit." ")->result();
        }

    }

    public function get_proposal_count($where)
    {

        return $this->db->query("SELECT count(id) as `ttl_count` from `tblproposals` where ".$where."  ")->row()->ttl_count;
    }

    /*
     *  this function use for add custom terms and condition
     *  $rel_id @ use for main table id;
     *  $section_name @ use for section name;
     *  $postdata @ use for post data;
     */
    public function addCustomTermsAndCondition($rel_id, $section_name, $termsdata, $tablename){
        $termstext = "";
        // echo "<pre>";
        // print_r($termsdata);
        // exit;
        if (isset($termsdata)){

            /* this is delete old terms and condition details */
            $this->home_model->delete("tbltermsandconditionsdetails", array("rel_id" => $rel_id, "document_name" => $section_name));
            $this->home_model->delete('tbltermsandconditionsales', array('rel_id' => $rel_id, 'condition_type'=> 1, 'rel_type'=> $section_name));
            $groupdata = array();
            foreach ($termsdata as $terms_id => $value) {

                $value1 = (isset($termsdata[$terms_id]["value1"])) ? $termsdata[$terms_id]["value1"] : "";
                $value2 = (isset($termsdata[$terms_id]["value2"])) ? $termsdata[$terms_id]["value2"] : "";
                if ($value1 != ""){
                    if (isset($termsdata[$terms_id]["active"]) && $termsdata[$terms_id]["active"] == 'on'){
                      $status = (isset($termsdata[$terms_id]["active"]) && $termsdata[$terms_id]["active"] == 'on') ? 1 : 0;

                      $insertdata["master_id"] = $terms_id;
                      $insertdata["rel_id"] = $rel_id;
                      $insertdata["document_name"] = $section_name;
                      $insertdata["value1"] = trim($value1);
                      $insertdata["value2"] = trim($value2);
                      $insertdata["status"] = $status;
                      $insertdata["created_at"] = date("Y-m-d h:i:s");
                      $insertdata["updated_at"] = date("Y-m-d h:i:s");

                      $this->home_model->insert("tbltermsandconditionsdetails", $insertdata);

                      /* this is for update custom terms and condition text in main db */
                      $termsconditiondata = $this->db->query("SELECT `parent_id`,`input_type`,`terms_condition_text` FROM `tbltermsandconditions_selection_master` WHERE `id` = '".$terms_id."' ")->row();
                      $terms_text = "";
                      if (!empty($termsconditiondata)){
                          $terms_text = $termsconditiondata->terms_condition_text;
                          if (array_key_exists("value1", $termsdata[$terms_id])){
                              if (trim($value1) == "Required"){
                                  $exploaddata = explode(",", $terms_text);
                                  $material_value = $this->getMaterialVal($rel_id, $section_name);
                                  $terms_text = str_replace(["{value}", "{material_value}"], [$value1, $material_value], $exploaddata[1]);
                              }else if (trim($value1) == "Not Required - SOP Sign"){
                                  $exploaddata = explode(",", $terms_text);
                                  $terms_text = str_replace("{value}", $value1, $exploaddata[0]);
                              }else{
                                  $terms_text = str_replace(["{percent}", "{value}", "{time}"], $value1 ,$terms_text);
                              }
                          }
                          if (array_key_exists("value2", $termsdata[$terms_id])){
                              $terms_text = str_replace(["{days}", "{days_week}", "{month_year}"], $value2, $terms_text);
                          }
                          if (!empty($terms_text)){
                              if ($termsconditiondata->parent_id > 0){
                                $groupdata[$termsconditiondata->parent_id][] = $terms_text;
                              }else{
                                $groupdata[$terms_id][] = $terms_text;
                              }
                              /* store terms and condition in new table */
                              $insertterms["rel_id"] = $rel_id;
                              $insertterms["rel_type"] = $section_name;
                              $insertterms["condition_type"] = 1;
                              $insertterms["condition"] = $terms_text;
                              $this->home_model->insert('tbltermsandconditionsales', $insertterms);
                          }
                      }
                    }
                }
            }

            if (!empty($groupdata) && $tablename != 'tblpurchaseorder'){
                $i = 1;
                $termstext = NULL;
                // foreach ($groupdata as $value) {
                //   $sno = str_pad($i,2,"0", STR_PAD_LEFT);
                //   $termstext .= $sno.") ".implode('&nbsp;', $value)."<br>";
                //   $i++;
                // }

                $this->home_model->update($tablename, array("custom_terms_conditions" => $termstext), array("id" => $rel_id));
            }
        }
    }

    public function getMaterialVal($rel_id, $section_name){
        $ttl_value = 0;
        $getproducts = $this->db->query("SELECT `pro_id`,`qty`,`temp_product` FROM `tblitems_in` WHERE `rel_id` = '".$rel_id."' AND `rel_type`='".$section_name."' ")->result();
        if (!empty($getproducts)){
           foreach ($getproducts as $val) {
               if($val->temp_product == 0){
                  $ttl_value += get_material_value($val->pro_id, $val->qty);
               }else{
                 $pro_price = value_by_id('tbltemperoryproduct',$value['pro_id'],'price');
                 $ttl_value += ($pro_price*$val->qty);
               }
           }
        }
        return number_format(round($ttl_value), 2, '.', '');
    }
}
