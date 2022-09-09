<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Estimates_model extends CRM_Model {

    private $statuses;
    private $shipping_fields = ['shipping_street', 'shipping_city', 'shipping_city', 'shipping_state', 'shipping_zip', 'shipping_country'];

    public function __construct() {
        parent::__construct();
        $this->statuses = do_action('before_set_estimate_statuses', [
            1,
            2,
            5,
            3,
            4,
            6,
        ]);
    }

    /**
     * Get unique sale agent for estimates / Used for filters
     * @return array
     */
    public function addchalan($data) {
        // echo "<pre>";
        // print_r($data);exit;

        $sessiondata = $this->session->userdata();
        $service_type = (!empty($data["service_type"])) ? $data["service_type"] : $sessiondata['service_type'];
        $warehouse_id = (!empty($data["warehouse_id"])) ? $data["warehouse_id"] : $sessiondata['warehouse_id'][0];

        $data['warehouse_id'] = $warehouse_id;
        $data['service_type'] = $service_type;
        $data['currency'] = 3;
        $assignstaff = (!empty($data['assignid'])) ? $data['assignid'] : [];
        $componentdata = $data['componentdata'];
        $group_id = $data['assign'];
        $data['group_id'] = $data['assign'];
        unset($data['assign']);
        unset($data['include_shipping']);
        unset($data['assignid']);
        unset($data['show_shipping_on_estimate']);
        unset($data['componentdata']);

        $workdate = str_replace("/","-",$data['workdate']);
        $data['workdate'] = date("Y-m-d",strtotime($workdate));

        $challandate = str_replace("/","-",$data['challandate']);
        $data['challandate'] = date("Y-m-d",strtotime($challandate));

        $data['datecreated'] = date('Y-m-d H:i:s');
        $data['addedfrom'] = get_staff_user_id();
        $data['billing_branch_id'] = get_login_branch();


        $ch_number = '0';
        $number_arr = explode("/",$data['chalanno']);
        if(!empty($number_arr[0])){
            $ch_number = $number_arr[0];
        }

        $data['year_id'] = financial_year();
        $data['ch_number'] = $ch_number;
        $data['approve_status'] = 0;

        
        $this->db->insert('tblchalanmst', $data);
        //echo $this->db->last_query();exit;
        $insert_id = $this->db->insert_id();

        unset($data['year_id']);
        unset($data['ch_number']);
        unset($data['challandate']);
        unset($data['office_person']);
        unset($data['office_person_number']);
        unset($data['site_person']);
        unset($data['site_person_number']);
        unset($data['note']);
        unset($data['group_id']);
        unset($data['approve_status']);
        $this->db->insert('tblcreatedchalanmst', $data);
        //echo $this->db->last_query();exit;
        $chalan_insert_id = $this->db->insert_id();
        /*$pretct = 'CHA';
        $chalanno = $pretct . str_pad($insert_id, 4, "0", STR_PAD_LEFT);
        $createdchalanno = $pretct . str_pad($chalan_insert_id, 4, "0", STR_PAD_LEFT);
        $udata['chalanno'] = $chalanno;*/
        $cudata['original_chalan_idd'] = $insert_id;
        /*$cudata['chalanno'] = $createdchalanno;
        $this->db->where('id', $insert_id);
        $this->db->update('tblchalanmst', $udata);*/
        $this->db->where('id', $chalan_insert_id);
        $this->db->update('tblcreatedchalanmst', $cudata);
        foreach ($componentdata as $singlecomponent) {
            $cdata['chalan_id'] = $insert_id;
            $cdata['component_id'] = $singlecomponent['componentid'];
            $cdata['required_qty'] = $singlecomponent['requiredqty'];
            $cdata['available_qty'] = $singlecomponent['availableqty'];
            $cdata['pending_qty'] = $singlecomponent['remainingqty'];
            $cdata['deleverable_qty'] = $singlecomponent['deliverableqty'];
            $cdata['flag'] = $singlecomponent['flag'];
            $this->db->insert('tblchalandetailsmst', $cdata);

            $ccdata['chalan_id'] = $chalan_insert_id;
            $ccdata['component_id'] = $singlecomponent['componentid'];
            $ccdata['deleverable_qty'] = $singlecomponent['deliverableqty'];
            $ccdata['flag'] = $singlecomponent['flag'];
            $this->db->insert('tblcreatedchalandetailsmst', $ccdata);
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

                $this->db->where('challan_id', $insert_id);
                $this->db->delete('tblchallanapproval');
                $this->db->where('table_id', $insert_id);
                $this->db->where('module_id', 29);
                $this->db->delete('tblmasterapproval');
                foreach ($assign_arr as $staffid) {

                    if($staffid!=get_staff_user_id())
                    {
                        $prdata['staff_id'] = $staffid;
                        $prdata['challan_id'] = $insert_id;
                        $prdata['status'] = 1;
                        $prdata['created_at'] = date("Y-m-d H:i:s");
                        $prdata['updated_at'] = date("Y-m-d H:i:s");
                        $this->db->insert('tblchallanapproval', $prdata);


                        $adata = array(
                                'staff_id' => $staffid,
                                'fromuserid' => get_staff_user_id(),
                                'module_id' => 29,
                                'table_id' => $insert_id,
                                'approve_status' => 0,
                                'status' => 0,
                                'description'     => 'Delivery Challan send to you for approval',
                                'link' => 'chalan/delivery_chalan_approval/'.$insert_id,
                                'date' => date('Y-m-d'),
                                'date_time' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('tblmasterapproval', $adata);

                        $notified = add_notification([
                            'description' => 'Challan Send to you for Approval',
                            'touserid' => $staffid,
                            'fromuserid' => get_staff_user_id(),
                            'link' => 'chalan/view/'.$chalan_insert_id,
                            'additional_data' => serialize([
                                    //$proposal->subject,
                            ]),
                        ]);
                        if ($notified) {
                            pusher_trigger_notification([$staffid]);
                        }
                    }
                }
            }

//        foreach ($assignstaff as $single_staff) {
//            if (strpos($single_staff, 'staff') !== false) {
//                $staff_id[] = str_replace("staff", "", $single_staff);
//            }
//
//            if (strpos($single_staff, 'group') !== false) {
//                $single_staff = str_replace("group", "", $single_staff);
//                $staffgroup = $this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='" . $single_staff . "'")->result_array();
//                foreach ($staffgroup as $singlestaff) {
//                    $staff_id[] = $singlestaff['staff_id'];
//                }
//            }
//        }
//        $staff_id = array_unique($staff_id);
//
//        foreach ($staff_id as $staffid)
//        {
//            if($staffid!=get_staff_user_id())
//            {
//                $prdata['staff_id'] = $staffid;
//                $prdata['challan_id'] = $insert_id;
//                $prdata['status'] = 1;
//                $prdata['created_at'] = date("Y-m-d H:i:s");
//                $prdata['updated_at'] = date("Y-m-d H:i:s");
//                $this->db->insert('tblchallanapproval', $prdata);
//
//
//                $adata = array(
//                        'staff_id' => $staffid,
//                        'fromuserid' => get_staff_user_id(),
//                        'module_id' => 29,
//                        'table_id' => $insert_id,
//                        'approve_status' => 0,
//                        'status' => 0,
//                        'description'     => 'Delivery Challan send to you for approval',
//                        'link' => 'chalan/delivery_chalan_approval/'.$insert_id,
//                        'date' => date('Y-m-d'),
//                        'date_time' => date('Y-m-d H:i:s'),
//                        'updated_at' => date('Y-m-d H:i:s')
//                );
//                $this->db->insert('tblmasterapproval', $adata);
//
//                $notified = add_notification([
//                    'description' => 'Challan Send to you for Approval',
//                    'touserid' => $staffid,
//                    'fromuserid' => get_staff_user_id(),
//                    'link' => 'chalan/view/'.$chalan_insert_id,
//                    'additional_data' => serialize([
//                            //$proposal->subject,
//                    ]),
//                ]);
//                if ($notified) {
//                    pusher_trigger_notification([$staffid]);
//                }
//            }
//        }
    //  print_r($staff_id);exit;
         return $insert_id;
        //return $this->db->query("SELECT DISTINCT(sale_agent) as sale_agent, CONCAT(firstname, ' ', lastname) as full_name FROM tblestimates JOIN tblstaff on tblstaff.staffid=tblestimates.sale_agent WHERE sale_agent != 0")->result_array();
    }

    public function updatechalan($data, $id) {

        $componentdata = $data['componentdata'];
        $assignstaff = $data['assignid'];
        $workdate = str_replace("/","-",$data['workdate']);
        $workdate = date("Y-m-d",strtotime($workdate));

        $challandate = str_replace("/","-",$data['challandate']);
        $challandate = date("Y-m-d",strtotime($challandate));

        $datecreated = date('Y-m-d H:i:s');

        $ch_number = '0';
        $number_arr = explode("/",$data['chalanno']);
        if(!empty($number_arr[0])){
            $ch_number = $number_arr[0];
        }

        $product_ids = $pro_arr = array();
        if (!empty($data['productdata'])){
            foreach ($data['productdata'] as $value) {
                $product_ids[] = $value["product_id"];
                $pro_arr[] = array(
                    'product_id' => $value["product_id"],
                    'product_qty' => $value["product_qty"]
                );
            }
        }
        $product_json = json_encode($pro_arr);
        $product_ids = implode(",", $product_ids);
        $group_id = $data['assign'];

//        foreach ($assignstaff as $single_staff) {
//            if (strpos($single_staff, 'staff') !== false) {
//                $staff_id[] = str_replace("staff", "", $single_staff);
//            }
//            if (strpos($single_staff, 'group') !== false) {
//                $single_staff = str_replace("group", "", $single_staff);
//                $staffgroup = $this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='" . $single_staff . "'")->result_array();
//                foreach ($staffgroup as $singlestaff) {
//                    $staff_id[] = $singlestaff['staff_id'];
//                }
//            }
//        }
//        $staff_id = array_unique($staff_id);

        $year_id = financial_year();
        $ch_number = $ch_number;
        $ad_data = array(
            'challandate' => $challandate,
            'work_no' => $data['work_no'],
            'chalanno' => $data['chalanno'],
            'year_id' => $year_id,
            'ch_number' => $ch_number,
            'workdate' => $workdate,
            'datecreated' => $datecreated,
            'product_json' => $product_json,
            'pro_id' => $product_ids,
            'office_person' => $data['office_person'],
            'office_person_number' => $data['office_person_number'],
            'site_person' => $data['site_person'],
            'site_person_number' => $data['site_person_number'],
            'note' => $data['note'],
            'billing_branch_id' => get_login_branch(),
            'terms_and_conditions' => $data['terms_and_conditions'],
            'approve_status' => 0,
            'group_id' => $group_id,
            'site_id' => $data['site_id'],
            'shipping_street' => $data['shipping_street'],
            'shipping_city' => $data['shipping_city'],
            'shipping_state' => $data['shipping_state'],
            'shipping_zip' => $data['shipping_zip'],
            'pdf_line_break' => $data["pdf_line_break"]
        );


        $this->db->where('id', $id);
        $this->db->update('tblchalanmst', $ad_data);

         $ad_data2 = array(
            'work_no' => $data['work_no'],
            'workdate' => $workdate,
            'datecreated' => $datecreated,
            'product_json' => $product_json,
            'terms_and_conditions' => $data['terms_and_conditions']
        );

        $this->db->where('original_chalan_idd', $id);
        $this->db->update('tblcreatedchalanmst', $ad_data2);


        $this->db->where('chalan_id', $id);
        $this->db->delete('tblcreatedchalandetailsmst');

        $this->db->where('chalan_id', $id);
        $this->db->delete('tblchalandetailsmst');

        $this->db->where('challan_id', $id);
        $this->db->delete('tblchallanapproval');

        $this->db->where('module_id', 29);
        $this->db->where('table_id', $id);
        $this->db->delete('tblmasterapproval');
       // return $componentdata;

        if(!empty($componentdata)){

        }
        foreach ($componentdata as $singlecomponent) {
            if(!empty($singlecomponent['requiredqty'])){
                $cdata['chalan_id'] = $id;
                $cdata['component_id'] = $singlecomponent['componentid'];
                $cdata['required_qty'] = $singlecomponent['requiredqty'];
                $cdata['pending_qty'] = $singlecomponent['remainingqty'];
                $cdata['deleverable_qty'] = $singlecomponent['deliverableqty'];
                $cdata['flag'] = $singlecomponent['flag'];
                $this->db->insert('tblchalandetailsmst', $cdata);

                $ccdata['chalan_id'] = $id;
                $ccdata['component_id'] = $singlecomponent['componentid'];
                $ccdata['deleverable_qty'] = $singlecomponent['deliverableqty'];
                $ccdata['flag'] = $singlecomponent['flag'];
                $this->db->insert('tblcreatedchalandetailsmst', $ccdata);
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

                $this->db->where('challan_id', $id);
                $this->db->delete('tblchallanapproval');
                $this->db->where('table_id', $id);
                $this->db->where('module_id', 29);
                $this->db->delete('tblmasterapproval');
                foreach ($assign_arr as $staffid) {

                    if($staffid!=get_staff_user_id())
                    {
                        $prdata['staff_id'] = $staffid;
                        $prdata['challan_id'] = $id;
                        $prdata['status'] = 1;
                        $prdata['created_at'] = date("Y-m-d H:i:s");
                        $prdata['updated_at'] = date("Y-m-d H:i:s");
                        $this->db->insert('tblchallanapproval', $prdata);


                        $adata = array(
                                'staff_id' => $staffid,
                                'fromuserid' => get_staff_user_id(),
                                'module_id' => 29,
                                'table_id' => $id,
                                'approve_status' => 0,
                                'status' => 0,
                                'description'     => 'Delivery Challan send to you for approval',
                                'link' => 'chalan/delivery_chalan_approval/'.$id,
                                'date' => date('Y-m-d'),
                                'date_time' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('tblmasterapproval', $adata);

                        $notified = add_notification([
                            'description' => 'Challan Send to you for Approval',
                            'touserid' => $staffid,
                            'fromuserid' => get_staff_user_id(),
                            'link' => 'chalan/view/'.$id,
                            'additional_data' => serialize([
                                    //$proposal->subject,
                            ]),
                        ]);
                        if ($notified) {
                            pusher_trigger_notification([$staffid]);
                        }
                    }
                }
            }
//        foreach ($staff_id as $staffid)
//        {
//            if($staffid!=get_staff_user_id())
//            {
//                $prdata['staff_id'] = $staffid;
//                $prdata['challan_id'] = $id;
//                $prdata['status'] = 1;
//                $prdata['created_at'] = date("Y-m-d H:i:s");
//                $prdata['updated_at'] = date("Y-m-d H:i:s");
//                $this->db->insert('tblchallanapproval', $prdata);
//
//                $adata = array(
//                        'staff_id' => $staffid,
//                        'fromuserid' => get_staff_user_id(),
//                        'module_id' => 29,
//                        'table_id' => $id,
//                        'approve_status' => 0,
//                        'status' => 0,
//                        'description'     => 'Delivery Challan send to you for approval',
//                        'link' => 'chalan/delivery_chalan_approval/'.$id,
//                        'date' => date('Y-m-d'),
//                        'date_time' => date('Y-m-d H:i:s'),
//                        'updated_at' => date('Y-m-d H:i:s')
//                );
//                $this->db->insert('tblmasterapproval', $adata);
//            }
//        }
         return $id;
    }

    public function get_sale_agents() {
        return $this->db->query("SELECT DISTINCT(sale_agent) as sale_agent, CONCAT(firstname, ' ', lastname) as full_name FROM tblestimates JOIN tblstaff on tblstaff.staffid=tblestimates.sale_agent WHERE sale_agent != 0")->result_array();
    }

    /**
     * Get estimate/s
     * @param  mixed $id    estimate id
     * @param  array  $where perform where
     * @return mixed
     */
    public function get($id = '', $where = []) {
        $this->db->select('*,tblcurrencies.id as currencyid, tblestimates.id as id, tblcurrencies.name as currency_name');
        $this->db->from('tblestimates');
        $this->db->join('tblcurrencies', 'tblcurrencies.id = tblestimates.currency', 'left');
        $this->db->where($where);
        if (is_numeric($id)) {
            $this->db->where('tblestimates.id', $id);
            $estimate = $this->db->get()->row();
            if ($estimate) {
                $estimate->attachments = $this->get_attachments($id);
                $estimate->visible_attachments_to_customer_found = false;
                foreach ($estimate->attachments as $attachment) {
                    if ($attachment['visible_to_customer'] == 1) {
                        $estimate->visible_attachments_to_customer_found = true;

                        break;
                    }
                }
                $estimate->items = get_items_by_type('estimate', $id);

                if ($estimate->project_id != 0) {
                    $this->load->model('projects_model');
                    $estimate->project_data = $this->projects_model->get($estimate->project_id);
                }
                $estimate->client = $this->clients_model->get($estimate->clientid);
                if (!$estimate->client) {
                    $estimate->client = new stdClass();
                    $estimate->client->company = $estimate->deleted_customer_name;
                }
            }

            return $estimate;
        }
        $this->db->order_by('number,YEAR(date)', 'desc');

        return $this->db->get()->result_array();
    }

    public function getchalan($id = '', $where = []) {
        $this->db->select('*,tblcurrencies.id as currencyid, tblchalanmst.id as id, tblcurrencies.name as currency_name');
        $this->db->from('tblchalanmst');
        $this->db->join('tblcurrencies', 'tblcurrencies.id = tblchalanmst.currency', 'left');
        $this->db->where($where);
        if (is_numeric($id)) {
            $this->db->where('tblchalanmst.id', $id);
            $estimate = $this->db->get()->row();
            if ($estimate) {
                $estimate->attachments = $this->get_attachments($id);
                $estimate->visible_attachments_to_customer_found = false;
                foreach ($estimate->attachments as $attachment) {
                    if ($attachment['visible_to_customer'] == 1) {
                        $estimate->visible_attachments_to_customer_found = true;

                        break;
                    }
                }
                $estimate->items = get_items_by_chalan($id);


                $estimate->client = $this->clients_model->get($estimate->clientid);
                if (!$estimate->client) {
                    $estimate->client = new stdClass();
                    $estimate->client->company = $estimate->deleted_customer_name;
                }
            }

            return $estimate;
        }
        $this->db->order_by('id,YEAR(datecreated)', 'desc');

        return $this->db->get()->result_array();
    }

    public function getcreatedchalan($id = '', $where = []) {
        $this->db->select('*,tblcurrencies.id as currencyid, tblchalanmst.id as id, tblcurrencies.name as currency_name');
        $this->db->from('tblchalanmst');
        $this->db->join('tblcurrencies', 'tblcurrencies.id = tblchalanmst.currency', 'left');
        $this->db->where($where);
        if (is_numeric($id)) {
            $this->db->where('tblchalanmst.id', $id);
            $estimate = $this->db->get()->row();
            if ($estimate) {
                $estimate->attachments = $this->get_attachments($id);
                $estimate->visible_attachments_to_customer_found = false;
                foreach ($estimate->attachments as $attachment) {
                    if ($attachment['visible_to_customer'] == 1) {
                        $estimate->visible_attachments_to_customer_found = true;

                        break;
                    }
                }
                $estimate->items = get_items_by_chalan($id);


                $estimate->client = $this->clients_model->get($estimate->clientid);
                if (!$estimate->client) {
                    $estimate->client = new stdClass();
                    $estimate->client->company = $estimate->deleted_customer_name;
                }
            }

            return $estimate;
        }
        $this->db->order_by('id,YEAR(datecreated)', 'desc');

        return $this->db->get()->result_array();
    }

    /**
     * Get estimate statuses
     * @return array
     */
    public function get_statuses() {
        return $this->statuses;
    }

    public function clear_signature($id) {
        $this->db->select('signature');
        $this->db->where('id', $id);
        $estimate = $this->db->get('tblestimates')->row();

        if ($estimate) {
            $this->db->where('id', $id);
            $this->db->update('tblestimates', ['signature' => null]);

            if (!empty($estimate->signature)) {
                unlink(get_upload_path_by_type('estimate') . $id . '/' . $estimate->signature);
            }

            return true;
        }

        return false;
    }

    /**
     * Function that will perform estimates pipeline query
     * @param  mixed  $status
     * @param  string  $search
     * @param  integer $page
     * @param  array   $sort
     * @param  boolean $count
     * @return array
     */
    public function do_kanban_query($status, $search = '', $page = 1, $sort = [], $count = false) {
        $default_pipeline_order = get_option('default_estimates_pipeline_sort');
        $default_pipeline_order_type = get_option('default_estimates_pipeline_sort_type');
        $limit = get_option('estimates_pipeline_limit');

        $fields_client = $this->db->list_fields('tblclients');
        $fields_estimates = $this->db->list_fields('tblestimates');

        $has_permission_view = has_permission('estimates', '', 'view');

        $this->db->select('tblestimates.id,status,invoiceid,' . get_sql_select_client_company() . ',total,currency,symbol,date,expirydate,clientid');
        $this->db->from('tblestimates');
        $this->db->join('tblclients', 'tblclients.userid = tblestimates.clientid', 'left');
        $this->db->join('tblcurrencies', 'tblestimates.currency = tblcurrencies.id');
        $this->db->where('status', $status);

        if (!$has_permission_view) {
            $this->db->where(get_estimates_where_sql_for_staff(get_staff_user_id()));
        }

        if ($search != '') {
            if (!_startsWith($search, '#')) {
                $where = '(';
                $i = 0;
                foreach ($fields_client as $f) {
                    $where .= 'tblclients.' . $f . ' LIKE "%' . $search . '%"';
                    $where .= ' OR ';
                    $i++;
                }
                $i = 0;
                foreach ($fields_estimates as $f) {
                    $where .= 'tblestimates.' . $f . ' LIKE "%' . $search . '%"';
                    $where .= ' OR ';

                    $i++;
                }
                $where = substr($where, 0, -4);
                $where .= ')';
                $this->db->where($where);
            } else {
                $this->db->where('tblestimates.id IN
                (SELECT rel_id FROM tbltags_in WHERE tag_id IN
                (SELECT id FROM tbltags WHERE name="' . strafter($search, '#') . '")
                AND tbltags_in.rel_type=\'estimate\' GROUP BY rel_id HAVING COUNT(tag_id) = 1)
                ');
            }
        }

        if (isset($sort['sort_by']) && $sort['sort_by'] && isset($sort['sort']) && $sort['sort']) {
            $this->db->order_by('tblestimates.' . $sort['sort_by'], $sort['sort']);
        } else {
            $this->db->order_by('tblestimates.' . $default_pipeline_order, $default_pipeline_order_type);
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
     * Convert estimate to invoice
     * @param  mixed $id estimate id
     * @return mixed     New invoice ID
     */
    public function convert_to_invoice($id, $client = false, $draft_invoice = false) {
        // Recurring invoice date is okey lets convert it to new invoice
        $_estimate = $this->get($id);
        $_estimate = json_decode(json_encode($_estimate), True);
        //$estimate_otherchrges=
        $_estimate['othercharges'] = $this->db->query("SELECT * FROM `tblestimateothercharges` WHERE `proposalid`='" . $id . "'")->result_array();
        $_estimate = (object) $_estimate;
        $new_invoice_data = [];
        if ($draft_invoice == true) {
            $new_invoice_data['save_as_draft'] = true;
        }
        $new_invoice_data['clientid'] = $_estimate->clientid;
        $new_invoice_data['project_id'] = $_estimate->project_id;
        $new_invoice_data['number'] = get_option('next_invoice_number');
        $new_invoice_data['date'] = _d(date('Y-m-d'));
        $new_invoice_data['duedate'] = _d(date('Y-m-d'));
        if (get_option('invoice_due_after') != 0) {
            $new_invoice_data['duedate'] = _d(date('Y-m-d', strtotime('+' . get_option('invoice_due_after') . ' DAY', strtotime(date('Y-m-d')))));
        }
        $new_invoice_data['show_quantity_as'] = $_estimate->show_quantity_as;
        $new_invoice_data['currency'] = $_estimate->currency;
        $new_invoice_data['subtotal'] = $_estimate->subtotal;
        $new_invoice_data['total'] = $_estimate->total;
        $new_invoice_data['adjustment'] = $_estimate->adjustment;
        $new_invoice_data['discount_percent'] = $_estimate->discount_percent;
        $new_invoice_data['discount_total'] = $_estimate->discount_total;
        $new_invoice_data['discount_type'] = $_estimate->discount_type;
        $new_invoice_data['sale_agent'] = $_estimate->sale_agent;
        // Since version 1.0.6
        $new_invoice_data['billing_street'] = clear_textarea_breaks($_estimate->billing_street);
        $new_invoice_data['billing_city'] = $_estimate->billing_city;
        $new_invoice_data['billing_state'] = $_estimate->billing_state;
        $new_invoice_data['billing_zip'] = $_estimate->billing_zip;
        $new_invoice_data['billing_country'] = $_estimate->billing_country;
        $new_invoice_data['shipping_street'] = clear_textarea_breaks($_estimate->shipping_street);
        $new_invoice_data['shipping_city'] = $_estimate->shipping_city;
        $new_invoice_data['shipping_state'] = $_estimate->shipping_state;
        $new_invoice_data['shipping_zip'] = $_estimate->shipping_zip;
        $new_invoice_data['shipping_country'] = $_estimate->shipping_country;
        $new_invoice_data['saletotal'] = $_estimate->saletotal;
        $new_invoice_data['service_type'] = $_estimate->service_type;
        $new_invoice_data['renttotal'] = $_estimate->renttotal;
        $new_invoice_data['salesubtotal'] = $_estimate->salesubtotal;
        $new_invoice_data['rentsubtotal'] = $_estimate->rentsubtotal;
        $new_invoice_data['sale_discount_percent'] = $_estimate->sale_discount_percent;
        $new_invoice_data['rent_discount_percent'] = $_estimate->rent_discount_percent;
        $new_invoice_data['sale_discount_total'] = $_estimate->sale_discount_total;
        $new_invoice_data['rent_discount_total'] = $_estimate->rent_discount_total;
        $new_invoice_data['rent_othercharges_amount'] = $_estimate->rent_othercharges_amount;
        $new_invoice_data['sale_othercharges_amount'] = $_estimate->sale_othercharges_amount;
        $new_invoice_data['is_gst'] = $_estimate->is_gst;

        if ($_estimate->include_shipping == 1) {
            $new_invoice_data['include_shipping'] = 1;
        }

        $new_invoice_data['show_shipping_on_invoice'] = $_estimate->show_shipping_on_estimate;
        $new_invoice_data['terms'] = get_option('predefined_terms_invoice');
        $new_invoice_data['clientnote'] = get_option('predefined_clientnote_invoice');
        // Set to unpaid status automatically
        $new_invoice_data['status'] = 1;
        $new_invoice_data['adminnote'] = '';

        $this->load->model('payment_modes_model');
        $modes = $this->payment_modes_model->get('', [
            'expenses_only !=' => 1,
        ]);
        $temp_modes = [];
        foreach ($modes as $mode) {
            if ($mode['selected_by_default'] == 0) {
                continue;
            }
            $temp_modes[] = $mode['id'];
        }
        $new_invoice_data['allowed_payment_modes'] = $temp_modes;
        $new_invoice_data['newitems'] = [];
        $custom_fields_items = get_custom_fields('items');
        $key = 1;
        foreach ($_estimate->items as $item) {
            $new_invoice_data['newitems'][$key]['pro_id'] = $item['pro_id'];
            $new_invoice_data['newitems'][$key]['hsn_code'] = $item['hsn_code'];
            $new_invoice_data['newitems'][$key]['description'] = $item['description'];
            $new_invoice_data['newitems'][$key]['long_description'] = clear_textarea_breaks($item['long_description']);
            $new_invoice_data['newitems'][$key]['qty'] = $item['qty'];
            $new_invoice_data['newitems'][$key]['months'] = $item['months'];
            $new_invoice_data['newitems'][$key]['days'] = $item['days'];
            $new_invoice_data['newitems'][$key]['discount'] = $item['discount'];
            $new_invoice_data['newitems'][$key]['is_gst'] = $item['is_gst'];
            $new_invoice_data['newitems'][$key]['is_sale'] = $item['is_sale'];
            $new_invoice_data['newitems'][$key]['unit'] = $item['unit'];
            $new_invoice_data['newitems'][$key]['taxname'] = [];
            $taxes = get_estimate_item_taxes($item['id']);
            foreach ($taxes as $tax) {
                // tax name is in format TAX1|10.00
                array_push($new_invoice_data['newitems'][$key]['taxname'], $tax['taxname']);
            }
            $new_invoice_data['newitems'][$key]['rate'] = $item['rate'];
            $new_invoice_data['newitems'][$key]['order'] = $item['item_order'];
            foreach ($custom_fields_items as $cf) {
                $new_invoice_data['newitems'][$key]['custom_fields']['items'][$cf['id']] = get_custom_field_value($item['id'], $cf['id'], 'items', false);

                if (!defined('COPY_CUSTOM_FIELDS_LIKE_HANDLE_POST')) {
                    define('COPY_CUSTOM_FIELDS_LIKE_HANDLE_POST', true);
                }
            }
            $key++;
        }

        foreach ($_estimate->othercharges as $othercharges) {
            $odata['proposalid'] = $othercharges['proposalid'];
            $odata['category_name'] = $othercharges['category_name'];
            $odata['sac_code'] = $othercharges['sac_code'];
            $odata['amount'] = $othercharges['amount'];
            $odata['gst'] = $othercharges['gst'];
            $odata['sgst'] = $othercharges['sgst'];
            $odata['igst'] = $othercharges['igst'];
            $odata['gst_sgst_amt'] = $othercharges['gst_sgst_amt'];
            $odata['total_maount'] = $othercharges['total_maount'];
            $odata['isgst'] = $othercharges['isgst'];
            $odata['is_sale'] = $othercharges['is_sale'];
            $odata['created_at'] = date("Y-m-d H:i:s");
            $odata['updated_at'] = date("Y-m-d H:i:s");
            $this->db->insert('tblinvoiceothercharges', $odata);
        }
        //echo"<pre>";print_r($new_invoice_data);exit;
        $this->load->model('invoices_model');
        $id = $this->invoices_model->add($new_invoice_data);
        if ($id) {
            // Customer accepted the estimate and is auto converted to invoice
            if (!is_staff_logged_in()) {
                $this->db->where('rel_type', 'invoice');
                $this->db->where('rel_id', $id);
                $this->db->delete('tblsalesactivity');
                $this->invoices_model->log_invoice_activity($id, 'invoice_activity_auto_converted_from_estimate', true, serialize([
                    '<a href="' . admin_url('estimates/list_estimates/' . $_estimate->id) . '">' . format_estimate_number($_estimate->id) . '</a>',
                ]));
            }
            // For all cases update addefrom and sale agent from the invoice
            // May happen staff is not logged in and these values to be 0
            $this->db->where('id', $id);
            $this->db->update('tblinvoices', [
                'addedfrom' => $_estimate->addedfrom,
                'sale_agent' => $_estimate->sale_agent,
            ]);

            // Update estimate with the new invoice data and set to status accepted
            $this->db->where('id', $_estimate->id);
            $this->db->update('tblestimates', [
                'invoiced_date' => date('Y-m-d H:i:s'),
                'invoiceid' => $id,
                'status' => 4,
            ]);


            if (is_custom_fields_smart_transfer_enabled()) {
                $this->db->where('fieldto', 'estimate');
                $this->db->where('active', 1);
                $cfEstimates = $this->db->get('tblcustomfields')->result_array();
                foreach ($cfEstimates as $field) {
                    $tmpSlug = explode('_', $field['slug'], 2);
                    if (isset($tmpSlug[1])) {
                        $this->db->where('fieldto', 'invoice');
                        $this->db->where('slug LIKE "invoice_' . $tmpSlug[1] . '%" AND type="' . $field['type'] . '" AND options="' . $field['options'] . '" AND active=1');
                        $cfTransfer = $this->db->get('tblcustomfields')->result_array();

                        // Don't make mistakes
                        // Only valid if 1 result returned
                        // + if field names similarity is equal or more then CUSTOM_FIELD_TRANSFER_SIMILARITY%
                        if (count($cfTransfer) == 1 && ((similarity($field['name'], $cfTransfer[0]['name']) * 100) >= CUSTOM_FIELD_TRANSFER_SIMILARITY)) {
                            $value = get_custom_field_value($_estimate->id, $field['id'], 'estimate', false);

                            if ($value == '') {
                                continue;
                            }

                            $this->db->insert('tblcustomfieldsvalues', [
                                'relid' => $id,
                                'fieldid' => $cfTransfer[0]['id'],
                                'fieldto' => 'invoice',
                                'value' => $value,
                            ]);
                        }
                    }
                }
            }

            if ($client == false) {
                $this->log_estimate_activity($_estimate->id, 'estimate_activity_converted', false, serialize([
                    '<a href="' . admin_url('invoices/list_invoices/' . $id) . '">' . format_invoice_number($id) . '</a>',
                ]));
            }

            do_action('estimate_converted_to_invoice', ['invoice_id' => $id, 'estimate_id' => $_estimate->id]);
        }

        return $id;
    }

    /**
     * Copy estimate
     * @param  mixed $id estimate id to copy
     * @return mixed
     */
    public function copy($id) {
        $_estimate = $this->get($id);
        $new_estimate_data = [];
        $new_estimate_data['clientid'] = $_estimate->clientid;
        $new_estimate_data['project_id'] = $_estimate->project_id;
        $new_estimate_data['number'] = get_option('next_estimate_number');
        $new_estimate_data['date'] = _d(date('Y-m-d'));
        $new_estimate_data['expirydate'] = null;

        if ($_estimate->expirydate && get_option('estimate_due_after') != 0) {
            $new_estimate_data['expirydate'] = _d(date('Y-m-d', strtotime('+' . get_option('estimate_due_after') . ' DAY', strtotime(date('Y-m-d')))));
        }

        $new_estimate_data['show_quantity_as'] = $_estimate->show_quantity_as;
        $new_estimate_data['currency'] = $_estimate->currency;
        $new_estimate_data['subtotal'] = $_estimate->subtotal;
        $new_estimate_data['total'] = $_estimate->total;
        $new_estimate_data['adminnote'] = $_estimate->adminnote;
        $new_estimate_data['adjustment'] = $_estimate->adjustment;
        $new_estimate_data['discount_percent'] = $_estimate->discount_percent;
        $new_estimate_data['discount_total'] = $_estimate->discount_total;
        $new_estimate_data['discount_type'] = $_estimate->discount_type;
        $new_estimate_data['terms'] = $_estimate->terms;
        $new_estimate_data['sale_agent'] = $_estimate->sale_agent;
        $new_estimate_data['reference_no'] = $_estimate->reference_no;
        // Since version 1.0.6
        $new_estimate_data['billing_street'] = clear_textarea_breaks($_estimate->billing_street);
        $new_estimate_data['billing_city'] = $_estimate->billing_city;
        $new_estimate_data['billing_state'] = $_estimate->billing_state;
        $new_estimate_data['billing_zip'] = $_estimate->billing_zip;
        $new_estimate_data['billing_country'] = $_estimate->billing_country;
        $new_estimate_data['shipping_street'] = clear_textarea_breaks($_estimate->shipping_street);
        $new_estimate_data['shipping_city'] = $_estimate->shipping_city;
        $new_estimate_data['shipping_state'] = $_estimate->shipping_state;
        $new_estimate_data['shipping_zip'] = $_estimate->shipping_zip;
        $new_estimate_data['shipping_country'] = $_estimate->shipping_country;
        if ($_estimate->include_shipping == 1) {
            $new_estimate_data['include_shipping'] = $_estimate->include_shipping;
        }
        $new_estimate_data['show_shipping_on_estimate'] = $_estimate->show_shipping_on_estimate;
        // Set to unpaid status automatically
        $new_estimate_data['status'] = 1;
        $new_estimate_data['clientnote'] = $_estimate->clientnote;
        $new_estimate_data['adminnote'] = '';
        $new_estimate_data['newitems'] = [];
        $custom_fields_items = get_custom_fields('items');
        $key = 1;
        foreach ($_estimate->items as $item) {
            $new_estimate_data['newitems'][$key]['description'] = $item['description'];
            $new_estimate_data['newitems'][$key]['long_description'] = clear_textarea_breaks($item['long_description']);
            $new_estimate_data['newitems'][$key]['qty'] = $item['qty'];
            $new_estimate_data['newitems'][$key]['unit'] = $item['unit'];
            $new_estimate_data['newitems'][$key]['taxname'] = [];
            $taxes = get_estimate_item_taxes($item['id']);
            foreach ($taxes as $tax) {
                // tax name is in format TAX1|10.00
                array_push($new_estimate_data['newitems'][$key]['taxname'], $tax['taxname']);
            }
            $new_estimate_data['newitems'][$key]['rate'] = $item['rate'];
            $new_estimate_data['newitems'][$key]['order'] = $item['item_order'];
            foreach ($custom_fields_items as $cf) {
                $new_estimate_data['newitems'][$key]['custom_fields']['items'][$cf['id']] = get_custom_field_value($item['id'], $cf['id'], 'items', false);

                if (!defined('COPY_CUSTOM_FIELDS_LIKE_HANDLE_POST')) {
                    define('COPY_CUSTOM_FIELDS_LIKE_HANDLE_POST', true);
                }
            }
            $key++;
        }
        $id = $this->addd($new_estimate_data);
        if ($id) {
            $custom_fields = get_custom_fields('estimate');
            foreach ($custom_fields as $field) {
                $value = get_custom_field_value($_estimate->id, $field['id'], 'estimate', false);
                if ($value == '') {
                    continue;
                }

                $this->db->insert('tblcustomfieldsvalues', [
                    'relid' => $id,
                    'fieldid' => $field['id'],
                    'fieldto' => 'estimate',
                    'value' => $value,
                ]);
            }

            $tags = get_tags_in($_estimate->id, 'estimate');
            handle_tags_save($tags, $id, 'estimate');

            logActivity('Copied Estimate ' . format_estimate_number($_estimate->id));

            return $id;
        }

        return false;
    }

    /**
     * Performs estimates totals status
     * @param  array $data
     * @return array
     */
    public function get_estimates_total($data) {
        $statuses = $this->get_statuses();
        $has_permission_view = has_permission('estimates', '', 'view');
        $this->load->model('currencies_model');
        if (isset($data['currency'])) {
            $currencyid = $data['currency'];
        } elseif (isset($data['customer_id']) && $data['customer_id'] != '') {
            $currencyid = $this->clients_model->get_customer_default_currency($data['customer_id']);
            if ($currencyid == 0) {
                $currencyid = $this->currencies_model->get_base_currency()->id;
            }
        } elseif (isset($data['project_id']) && $data['project_id'] != '') {
            $this->load->model('projects_model');
            $currencyid = $this->projects_model->get_currency($data['project_id'])->id;
        } else {
            $currencyid = $this->currencies_model->get_base_currency()->id;
        }

        $symbol = $this->currencies_model->get_currency_symbol($currencyid);
        $where = '';
        if (isset($data['customer_id']) && $data['customer_id'] != '') {
            $where = ' AND clientid=' . $data['customer_id'];
        }

        if (isset($data['project_id']) && $data['project_id'] != '') {
            $where .= ' AND project_id=' . $data['project_id'];
        }

        if (!$has_permission_view) {
            $where .= ' AND ' . get_estimates_where_sql_for_staff(get_staff_user_id());
        }

        $sql = 'SELECT';
        foreach ($statuses as $estimate_status) {
            $sql .= '(SELECT SUM(total) FROM tblestimates WHERE status=' . $estimate_status;
            $sql .= ' AND currency =' . $currencyid;
            if (isset($data['years']) && count($data['years']) > 0) {
                $sql .= ' AND YEAR(date) IN (' . implode(', ', $data['years']) . ')';
            } else {
                $sql .= ' AND YEAR(date) = ' . date('Y');
            }
            $sql .= $where;
            $sql .= ') as "' . $estimate_status . '",';
        }

        $sql = substr($sql, 0, -1);
        $result = $this->db->query($sql)->result_array();
        $_result = [];
        $i = 1;
        foreach ($result as $key => $val) {
            foreach ($val as $status => $total) {
                $_result[$i]['total'] = $total;
                $_result[$i]['symbol'] = $symbol;
                $_result[$i]['status'] = $status;
                $i++;
            }
        }
        $_result['currencyid'] = $currencyid;

        return $_result;
    }

    /**
     * Insert new estimate to database
     * @param array $data invoiec data
     * @return mixed - false if not insert, estimate ID if succes
     */
    public function add($data) {
    //    echo"<pre>";print_r($data);exit;
        $data['bank_id'] = $data['bank_id'];
        $shipclientdata = (isset($data['shipclientdata'])) ? $data['shipclientdata'] : [];
        $clientdata = (isset($data['clientdata'])) ? $data['clientdata'] : [];
        unset($data['client_data']);
        unset($data['shipclientdata']);
        unset($data['source']);
        unset($data['proposal_to']);
        unset($data['open_till']);
        unset($data['tags']);
        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            unset($data['custom_fields']);
        }
        $assignstaff = (isset($data['assignid'])) ? $data['assignid'] : [];
        $group_id = $data['assign'];
        $data['group_id'] = $data['assign'];

        $rentproposal = $data['rentproposal'];
        $saleproposal = $data['saleproposal'];
        $productfields = (isset($data['productfields'])) ? $data['productfields'] : [];
        $othercharges = $data['othercharges'];
        $saleothercharges = $data['saleothercharges'];
        $data['datecreated'] = date('Y-m-d H:i:s');
        $data['addedfrom'] = get_staff_user_id();
        $data['hash'] = app_generate_hash();
        $data['total'] = $data['saleproposal']['totalamount'] + $data['rentproposal']['totalamount'];
        $data['subtotal'] = $data['saleproposal']['finalsubtotalamount'] + $data['rentproposal']['finalsubtotalamount'];
        $data['discount_percent'] = $data['saleproposal']['finaldiscountpercentage'] + $data['rentproposal']['finaldiscountpercentage'];
        $data['discount_total'] = $data['saleproposal']['finaldiscountamount'] + $data['rentproposal']['finaldiscountamount'];
        $data['saletotal'] = $data['saleproposal']['totalamount'];
        $data['renttotal'] = $data['rentproposal']['totalamount'];
        $data['salesubtotal'] = $data['saleproposal']['finalsubtotalamount'];
        $data['rentsubtotal'] = $data['rentproposal']['finalsubtotalamount'];
        if ($data['saleproposal']['finaldiscountpercentage'] != '') {
            $data['sale_discount_percent'] = $data['saleproposal']['finaldiscountpercentage'];
        } else {
            $data['sale_discount_percent'] = 0;
        }
        if ($data['rentproposal']['finaldiscountpercentage'] != '') {
            $data['rent_discount_percent'] = $data['rentproposal']['finaldiscountpercentage'];
        } else {
            $data['rent_discount_percent'] = 0;
        }
        $data['sale_discount_total'] = $data['saleproposal']['finaldiscountamount'];
        $data['rent_discount_total'] = $data['rentproposal']['finaldiscountamount'];
        
        if (count($rentproposal) > 0) {
            $data['is_gst'] = (!empty($data['rentproposal'][1]['isgst'])) ? $data['rentproposal'][1]['isgst'] : 0;
        } else if (count($saleproposal) > 0) {
            $data['is_gst'] = (!empty($data['saleproposal'][1]['isgst'])) ? $data['saleproposal'][1]['isgst'] : 0;;
        }

        unset($data['rentproposal']);
        // unset($data['service_type']);
        unset($data['subject']);
        unset($data['rel_type']);
        unset($data['assignid']);
        unset($data['assign']);
        unset($data['othercharges']);
        unset($data['saleothercharges']);
        unset($data['saleproposal']);
        unset($data['productfields']);
        unset($data['clientdata']);
        unset($data['warehouse_id']);
        if (isset($data['project_id']) && $data['project_id'] == '') {
            $data['project_id'] = 0;
        }
        if ($data['show_shipping_on_estimate'] == 'on') {
            $data['show_shipping_on_estimate'] = 1;
        } else {
            $data['show_shipping_on_estimate'] = 0;
        }
        //echo$data['expirydate'];
        $expirydate = $data['expirydate'];
        $expirydate = str_replace("/","-",$expirydate);
        $expirydate = date('Y-m-d', strtotime($expirydate));
        $data['expirydate'] = date('Y-m-d', strtotime($expirydate));
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

        $data['date'] = date('Y-m-d');
        $data['prefix'] = 'PI-';
        $data['number_format'] = 1;

        $data['billing_branch_id'] = get_login_branch();

        $pi_number = '0';
        $number_arr = explode("/",$data['number']);
        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            if(!empty($number_arr[3])){
                $pi_number = $number_arr[3];
            }
        }else{
            if(!empty($number_arr[0])){
                $pi_number = $number_arr[0];
            }
        }

        $data['year_id'] = financial_year();
        $data['pi_number'] = $pi_number;

        /* this is for new terms and condition */
        $terms_conditionarr = (isset($data["termscondition"])) ? $data["termscondition"] : [];
        unset($data["termscondition"]);
        

        $this->db->insert('tblestimates', $data);
        //echo $this->db->last_query();exit;
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            $this->db->where('name', 'next_estimate_number');
            $this->db->set('value', $insert_id + 1, false);
            $this->db->update('tbloptions');
            unset($rentproposal['finalsubtotalamount']);
            unset($rentproposal['finaldiscountpercentage']);
            unset($rentproposal['finaldiscountamount']);
            unset($rentproposal['totalamount']);

            /* store terms and condtion in new table */
            if (!empty($terms_conditionarr)){
               $this->home_model->update('tblestimates', array("terms_and_conditions" => NULL), array("id" => $insert_id));
               $this->home_model->delete('tbltermsandconditionsales', array('rel_id' => $insert_id, 'condition_type'=> 2,'rel_type'=> 'invoice'));
               foreach ($terms_conditionarr as $terms) {

                   if (!empty($terms['condition'])){
                       $insertterms["rel_id"] = $insert_id;
                       $insertterms["rel_type"] = 'estimate';
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
                    $this->db->insert('tblestimateothercharges', $odata);
                }
            }
            foreach ($productfields as $singleprofield) {
                $podata['proposalid'] = $insert_id;
                $podata['field_id'] = $singleprofield;
                $podata['created_at'] = date("Y-m-d H:i:s");
                $podata['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblestimateproductfields', $podata);
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
                    $this->db->insert('tblestimateothercharges', $osdata);
                }
                
            }
            $totalothercharges = (isset($otherchargeamt)) ? array_sum($otherchargeamt) : 0;
            $totalothersalecharges = (isset($otherchargesaleamt)) ? array_sum($otherchargesaleamt) : 0;
            $otherdata['rent_othercharges_amount'] = $totalothercharges;
            $otherdata['sale_othercharges_amount'] = $totalothersalecharges;
            //$otherdata['number'] = $insert_id;
            $this->db->where('id', $insert_id);
            $this->db->update('tblestimates', $otherdata);
            $data['rel_type'] = 'estimate';
            foreach ($rentproposal as $singlerentalpro) {
                if (isset($singlerentalpro['product_id'])){
                    $itemdata['rel_type'] = 'estimate';
                    $itemdata['rel_id'] = $insert_id;
                    $itemdata['pro_id'] = $singlerentalpro['product_id'];
                    $itemdata['description'] = get_product_print_name($singlerentalpro['product_id']);
                    $itemdata['hsn_code'] = $singlerentalpro['hsn_code'];
                    $itemdata['long_description'] = $singlerentalpro['remark'];
                    $itemdata['qty'] = $singlerentalpro['qty'];
                    $itemdata['weight'] = $singlerentalpro['weight'];
                    $itemdata['months'] = $singlerentalpro['months'];
                    $itemdata['days'] = $singlerentalpro['days'];
                    $itemdata['rate'] = $singlerentalpro['price'];
                    $itemdata['rate_view'] = $singlerentalpro['price_view'];
                    $itemdata['discount'] = $singlerentalpro['discount'];
                    $itemdata['prodtax'] = $singlerentalpro['prodtax'];
                    $itemdata['is_gst'] = $singlerentalpro['isgst'];
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
                
            }

            unset($saleproposal['finalsubtotalamount']);
            unset($saleproposal['finaldiscountpercentage']);
            unset($saleproposal['finaldiscountamount']);
            unset($saleproposal['totalamount']);
            foreach ($saleproposal as $singlesalepro) {
                $saleitemdata['rel_type'] = $data['rel_type'];
                $saleitemdata['rel_id'] = $insert_id;
                $saleitemdata['pro_id'] = $singlesalepro['product_id'];
                $saleitemdata['description'] = get_product_print_name($singlesalepro['product_id']);
                $saleitemdata['hsn_code'] = $singlesalepro['hsn_code'];
                $saleitemdata['long_description'] = $singlesalepro['remark'];
                $saleitemdata['qty'] = $singlesalepro['qty'];
                $saleitemdata['weight'] = $singlesalepro['weight'];
                $saleitemdata['rate'] = $singlesalepro['price'];
                $saleitemdata['discount'] = $singlesalepro['discount'];
                $saleitemdata['prodtax'] = $singlesalepro['prodtax'];
                $saleitemdata['is_gst'] = $singlesalepro['isgst'];
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
            }
            foreach ($clientdata as $singleclient) {
                //$singleclient['userid']=$data['clientid'];;
                //$this->db->insert('tblcontacts', $singleclient);
                //$cont_id = $this->db->insert_id();
                $datace['invoice_id'] = $insert_id;
                $datace['contact_id'] = $singleclient['staff_id'];
                $datace['type'] = 'estimate';
                $this->db->insert('tblinvoiceclientperson', $datace);
            }
            foreach ($shipclientdata as $singleshipclient) {
                //$singleclient['userid']=$data['clientid'];;
                //$this->db->insert('tblcontacts', $singleclient);
                //$cont_id = $this->db->insert_id();
                $datace['invoice_id'] = $insert_id;
                $datace['contact_id'] = $singleshipclient['staff_id'];
                $datace['type'] = 'shipestimate';
                $this->db->insert('tblinvoiceclientperson', $datace);
            }
            if (isset($custom_fields)) {
                handle_custom_fields_post($insert_id, $custom_fields);
            }

            // handle_tags_save($tags, $insert_id, 'proposal');

            /* foreach ($items as $key => $item) {
              if ($itemid = add_new_sales_items_post($item, $insert_id, 'proposal')) {
              _maybe_insert_post_item_tax($itemid, $item, $insert_id, 'proposal');
              }
              } */
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
                $this->db->delete('tblestimateassignstaff');
                $this->db->where('lead_id', $insert_id);
                $this->db->delete('tblestimatestaffapproval');
                foreach ($assign_arr as $staffid) {

                    $sdata['staff_id'] = $staffid;
                    $sdata['lead_id'] = $insert_id;
                    $sdata['status'] = '1';
                    $sdata['created_at'] = date("Y-m-d H:i:s");
                    $sdata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tblestimateassignstaff', $sdata);

                    $prdata['staff_id'] = $staffid;
                    $prdata['lead_id'] = $insert_id;
                    $prdata['status'] = 1;
                    $prdata['created_at'] = date("Y-m-d H:i:s");
                    $prdata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tblestimatestaffapproval', $prdata);

                    $pro_subject = (!empty($proposal)) ? $proposal->subject : '';
                    $notified = add_notification([
                        'description' => 'Proforma Invoice Send to you for Approval',
                        'touserid' => $staffid,
                        'fromuserid' => get_staff_user_id(),
                        'link' => 'estimates/#' . $insert_id,
                        'additional_data' => serialize([
                            $pro_subject,
                        ]),
                    ]);
                    if ($notified) {
                        pusher_trigger_notification([$staffid]);
                    }
                }
            }
//            foreach ($assignstaff as $single_staff) {
//                if (strpos($single_staff, 'staff') !== false) {
//                    $staff_id[] = str_replace("staff", "", $single_staff);
//                }
//                if (strpos($single_staff, 'group') !== false) {
//                    $single_staff = str_replace("group", "", $single_staff);
//                    $staffgroup = $this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='" . $single_staff . "'")->result_array();
//                    foreach ($staffgroup as $singlestaff) {
//                        $staff_id[] = $singlestaff['staff_id'];
//                    }
//                }
//            }
//            $staff_id = array_unique($staff_id);
//            foreach ($staff_id as $staffid) {
//                $sdata['staff_id'] = $staffid;
//                $sdata['lead_id'] = $insert_id;
//                $sdata['status'] = '1';
//                $sdata['created_at'] = date("Y-m-d H:i:s");
//                $sdata['updated_at'] = date("Y-m-d H:i:s");
//                $this->db->insert('tblestimateassignstaff', $sdata);
//
//                $prdata['staff_id'] = $staffid;
//                $prdata['lead_id'] = $insert_id;
//                $prdata['status'] = 1;
//                $prdata['created_at'] = date("Y-m-d H:i:s");
//                $prdata['updated_at'] = date("Y-m-d H:i:s");
//                $this->db->insert('tblestimatestaffapproval', $prdata);
//
//                $notified = add_notification([
//                    'description' => 'Proforma Invoice Send to you for Approval',
//                    'touserid' => $staffid,
//                    'fromuserid' => get_staff_user_id(),
//                    'link' => 'estimates/#' . $insert_id,
//                    'additional_data' => serialize([
//                        $proposal->subject,
//                    ]),
//                ]);
//                if ($notified) {
//                    pusher_trigger_notification([$staffid]);
//                }
//
//                /* $notified = add_notification([
//                  'description'     => 'not_proposal_assigned_to_you',
//                  'touserid'        => $staffid,
//                  'fromuserid'      => get_staff_user_id(),
//                  'link'            => 'proposals/list_proposals/' . $insert_id,
//                  'additional_data' => serialize([
//                  $proposal->subject,
//                  ]),
//                  ]);
//                  if ($notified) {
//                  pusher_trigger_notification([$staffid]);
//                  } */
//                //$this->lead_assigned_member_notification($insert_id, $staffid);
//            }

            $proposal = $this->get($insert_id);
            /* if ($proposal->assigned != 0) {
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
              } */

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

    public function addd($data) {
        $data['datecreated'] = date('Y-m-d H:i:s');

        $data['addedfrom'] = get_staff_user_id();

        $data['prefix'] = get_option('estimate_prefix');

        $data['number_format'] = get_option('estimate_number_format');

        $save_and_send = isset($data['save_and_send']);

        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            unset($data['custom_fields']);
        }

        $data['hash'] = app_generate_hash();
        $tags = isset($data['tags']) ? $data['tags'] : '';

        $items = [];
        if (isset($data['newitems'])) {
            $items = $data['newitems'];
            unset($data['newitems']);
        }

        $data = $this->map_shipping_columns($data);

        $data['billing_street'] = trim($data['billing_street']);
        $data['billing_street'] = nl2br($data['billing_street']);

        if (isset($data['shipping_street'])) {
            $data['shipping_street'] = trim($data['shipping_street']);
            $data['shipping_street'] = nl2br($data['shipping_street']);
        }

        $hook_data = do_action('before_estimate_added', [
            'data' => $data,
            'items' => $items,
        ]);

        $data = $hook_data['data'];
        $items = $hook_data['items'];

        $this->db->insert('tblestimates', $data);
        $insert_id = $this->db->insert_id();

        if ($insert_id) {
            // Update next estimate number in settings
            $this->db->where('name', 'next_estimate_number');
            $this->db->set('value', 'value+1', false);
            $this->db->update('tbloptions');

            if (isset($custom_fields)) {
                handle_custom_fields_post($insert_id, $custom_fields);
            }

            handle_tags_save($tags, $insert_id, 'estimate');

            foreach ($items as $key => $item) {
                if ($itemid = add_new_sales_item_post($item, $insert_id, 'estimate')) {
                    _maybe_insert_post_item_tax($itemid, $item, $insert_id, 'estimate');
                }
            }

            update_sales_total_tax_column($insert_id, 'estimate', 'tblestimates');
            $this->log_estimate_activity($insert_id, 'estimate_activity_created');

            do_action('after_estimate_added', $insert_id);

            if ($save_and_send === true) {
                $this->send_estimate_to_client($insert_id, '', true, '', true);
            }

            return $insert_id;
        }

        return false;
    }

    /**
     * Get item by id
     * @param  mixed $id item id
     * @return object
     */
    public function get_estimate_item($id) {
        $this->db->where('id', $id);

        return $this->db->get('tblitems_in')->row();
    }

    /**
     * Update estimate data
     * @param  array $data estimate data
     * @param  mixed $id   estimateid
     * @return boolean
     */
    public function update_pi($data, $id) {

        // echo "<pre>";
        // print_r($data);
        // exit;
    	$data['bank_id'] = $data['bank_id'];
        $clientdata = (isset($data['clientdata'])) ? $data['clientdata'] : [];
        $shipclientdata = (isset($data['shipclientdata'])) ? $data['shipclientdata'] : [];
        $client_data = (isset($data['client_data'])) ? $data['client_data'] : [];
        $affectedRows = 0;
        $current_proposal = $this->get($id);
        $save_and_send = isset($data['save_and_send']);
        $rentproposal = $data['rentproposal'];
        $saleproposal = $data['saleproposal'];
        $productfields = (isset($data['productfields'])) ? $data['productfields'] : [];
        $othercharges = $data['othercharges'];
        $saleothercharges = $data['saleothercharges'];
        $assignstaff = (isset($data['assignid'])) ? $data['assignid'] : [];
        $data['datecreated'] = date('Y-m-d H:i:s');
        //$data['addedfrom'] = get_staff_user_id();
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
            $data['is_gst'] = $data['rentproposal'][1]['isgst'];
        } else if (count($saleproposal) > 0) {
            $data['is_gst'] = $data['saleproposal'][1]['isgst'];
        }

        $group_id = $data['assign'];
        $data['group_id'] = $data['assign'];

        unset($data['warehouse_id']);
        unset($data['rentproposal']);
        unset($data['saleproposal']);
        unset($data['othercharges']);
        unset($data['assignid']);
        unset($data['assign']);
        unset($data['saleothercharges']);
        unset($data['productfields']);
        unset($data['shipclientdata']);
        unset($data['clientdata']);
        unset($data['client_data']);
        if (empty($data['rel_type'])) {
            $data['rel_id'] = null;
            $data['rel_type'] = '';
        } else {
            if (empty($data['rel_id'])) {
                $data['rel_id'] = null;
                $data['rel_type'] = '';
            }
        }
        unset($data['rel_id']);
        unset($data['rel_type']);
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
        unset($data['removed_items']);

        $data['billing_branch_id'] = get_login_branch();
        $pi_number = '0';
        $number_arr = explode("/",$data['number']);
        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            if(!empty($number_arr[3])){
                $pi_number = $number_arr[3];
            }
        }else{
            if(!empty($number_arr[0])){
                $pi_number = $number_arr[0];
            }
        }

        $data['year_id'] = financial_year();
        $data['pi_number'] = $pi_number;

        /* this is for new terms and condition */
        $terms_conditionarr = (isset($data["termscondition"])) ? $data["termscondition"] : [];
        unset($data["termscondition"]);
        unset($data["relsection_id"]);
        // echo "<pre>";
        // print_r($data);
        // exit;
        $this->db->where('id', $id);
        $this->db->update('tblestimates', $data);
        $insert_id = $id;
        $this->db->where('proposalid', $insert_id);
        $this->db->delete('tblestimateothercharges');
        $this->db->where('proposalid', $insert_id);
        $this->db->delete('tblproposalproductfields');

        /* store terms and condtion in new table */
        if (!empty($terms_conditionarr)){
           $this->home_model->update('tblestimates', array("terms_and_conditions" => NULL), array("id" => $insert_id));
           $this->home_model->delete('tbltermsandconditionsales', array('rel_id' => $insert_id, 'condition_type'=> 2,'rel_type'=> 'estimate'));
           foreach ($terms_conditionarr as $terms) {

               if (!empty($terms['condition'])){
                   $insertterms["rel_id"] = $insert_id;
                   $insertterms["rel_type"] = 'estimate';
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
                $this->db->insert('tblestimateothercharges', $odata);
            }
        }

        $this->db->where('proposalid',$insert_id);
        $this->db->delete('tblestimateproductfields');

        $totalothercharges = (isset($otherchargeamt)) ? array_sum($otherchargeamt) : 0;
        foreach ($productfields as $singleprofield) {
            $podata['proposalid'] = $insert_id;
            $podata['field_id'] = $singleprofield;
            $podata['created_at'] = date("Y-m-d H:i:s");
            $podata['updated_at'] = date("Y-m-d H:i:s");
            $this->db->insert('tblestimateproductfields', $podata);
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
                $this->db->insert('tblestimateothercharges', $osdata);
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
        $this->db->update('tblestimates', $otherdata);

        $this->db->where('rel_id', $insert_id);
        $this->db->where('rel_type', 'estimate');
        $this->db->delete('tblitems_in');
        $this->db->where('rel_id', $insert_id);
        $this->db->where('rel_type', 'estimate');
        $this->db->delete('tblitemstax');
        $this->db->where('lead_id', $insert_id);
        $this->db->delete('tblestimateassignstaff');
        $this->db->where('type', 'estimate');
        $this->db->where('invoice_id', $insert_id);
        $this->db->delete('tblinvoiceclientperson');


        $this->db->where('type', 'shipestimate');
        $this->db->where('invoice_id', $insert_id);
        $this->db->delete('tblinvoiceclientperson');

        /* foreach($client_data as $single_client_data)
          {
          $this->db->where('id',$single_client_data['clientid']);
          $this->db->delete('tblcontacts');
          } */
        foreach ($clientdata as $singleclient) {
            //$singleclient['userid']=$data['clientid'];
            //$this->db->insert('tblcontacts', $singleclient);
            //$cont_id = $this->db->insert_id();
            $datace['invoice_id'] = $insert_id;
            $datace['contact_id'] = $singleclient['staff_id'];
            $datace['type'] = 'estimate';
            $this->db->insert('tblinvoiceclientperson', $datace);
        }
        foreach ($shipclientdata as $singleshipclient) {
                //$singleclient['userid']=$data['clientid'];;
                //$this->db->insert('tblcontacts', $singleclient);
                //$cont_id = $this->db->insert_id();
                $dstace['invoice_id'] = $insert_id;
                $dstace['contact_id'] = $singleshipclient['staff_id'];
                $dstace['type'] = 'shipestimate';
                $this->db->insert('tblinvoiceclientperson', $dstace);
            }
        foreach ($rentproposal as $singlerentalpro) {
            $itemdata['rel_type'] = 'estimate';
            $itemdata['rel_id'] = $insert_id;
            $itemdata['pro_id'] = $singlerentalpro['product_id'];
            $itemdata['description'] = get_product_print_name($singlerentalpro['product_id']);
            $itemdata['hsn_code'] = $singlerentalpro['hsn_code'];
            $itemdata['long_description'] = $singlerentalpro['remark'];
            $itemdata['qty'] = $singlerentalpro['qty'];
            $itemdata['weight'] = $singlerentalpro['weight'];
            $itemdata['months'] = $singlerentalpro['months'];
            $itemdata['days'] = $singlerentalpro['days'];
            $itemdata['rate'] = $singlerentalpro['price'];
            $itemdata['rate_view'] = $singlerentalpro['price_view'];
            $itemdata['discount'] = $singlerentalpro['discount'];
            $itemdata['prodtax'] = $singlerentalpro['prodtax'];
            $itemdata['is_gst'] = $singlerentalpro['isgst'];
            $itemdata['is_sale'] = 0;
            $is_gst = $singlerentalpro['isgst'];
            $this->db->insert('tblitems_in', $itemdata);
            $itemid = $this->db->insert_id();
            $taxdata['itemid'] = $itemid;
            $taxdata['rel_id'] = $insert_id;
            $taxdata['rel_type'] = 'estimate';
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
            $saleitemdata['rel_type'] = 'estimate';
            $saleitemdata['rel_id'] = $insert_id;
            $saleitemdata['pro_id'] = $singlesalepro['product_id'];
            $saleitemdata['description'] = get_product_print_name($singlesalepro['product_id']);
            $saleitemdata['hsn_code'] = $singlesalepro['hsn_code'];
            $saleitemdata['long_description'] = $singlesalepro['remark'];
            $saleitemdata['qty'] = $singlesalepro['qty'];
            $saleitemdata['weight'] = $singlesalepro['weight'];
            $saleitemdata['rate'] = $singlesalepro['price'];
            $saleitemdata['discount'] = $singlesalepro['discount'];
            $saleitemdata['prodtax'] = $singlesalepro['prodtax'];
            $saleitemdata['is_gst'] = $singlesalepro['isgst'];
            $saleitemdata['is_sale'] = 1;
            $is_gst = $singlesalepro['isgst'];
            $this->db->insert('tblitems_in', $saleitemdata);
            $saleitemid = $this->db->insert_id();

            $saletaxdata['itemid'] = $saleitemid;
            $saletaxdata['rel_id'] = $insert_id;
            $saletaxdata['rel_type'] = 'estimate';
            $saletaxdata['taxrate'] = 18;
            if ($is_gst == 1) {
                $tax = 'GST/SGST';
            } else {
                $tax = 'IGST';
            }
            $saletaxdata['taxname'] = $tax;
            $this->db->insert('tblitemstax', $saletaxdata);
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
            $this->db->delete('tblestimateassignstaff');
            $this->db->where('lead_id', $insert_id);
            $this->db->delete('tblestimatestaffapproval');
            foreach ($assign_arr as $staffid) {

                $sdata['staff_id'] = $staffid;
                $sdata['lead_id'] = $insert_id;
                $sdata['status'] = '1';
                $sdata['created_at'] = date("Y-m-d H:i:s");
                $sdata['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblestimateassignstaff', $sdata);

                $prdata['staff_id'] = $staffid;
                $prdata['lead_id'] = $insert_id;
                $prdata['status'] = 1;
                $prdata['created_at'] = date("Y-m-d H:i:s");
                $prdata['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblestimatestaffapproval', $prdata);

                $prosubject = (!empty($proposal)) ? $proposal->subject : '';
                $notified = add_notification([
                    'description' => 'Proforma Invoice Send to you for Approval',
                    'touserid' => $staffid,
                    'fromuserid' => get_staff_user_id(),
                    'link' => 'estimates/#' . $insert_id,
                    'additional_data' => serialize([
                        $prosubject,
                    ]),
                ]);
                if ($notified) {
                    pusher_trigger_notification([$staffid]);
                }
            }
        }
//        foreach ($assignstaff as $single_staff) {
//            if (strpos($single_staff, 'staff') !== false) {
//                $staff_id[] = str_replace("staff", "", $single_staff);
//            }
//            if (strpos($single_staff, 'group') !== false) {
//                $single_staff = str_replace("group", "", $single_staff);
//                $staffgroup = $this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='" . $single_staff . "'")->result_array();
//                foreach ($staffgroup as $singlestaff) {
//                    $staff_id[] = $singlestaff['staff_id'];
//                }
//            }
//        }
//        $staff_id = array_unique($staff_id);
//        foreach ($staff_id as $staffid) {
//            $sdata['staff_id'] = $staffid;
//            $sdata['lead_id'] = $insert_id;
//            $sdata['status'] = '1';
//            $sdata['created_at'] = date("Y-m-d H:i:s");
//            $sdata['updated_at'] = date("Y-m-d H:i:s");
//            $this->db->insert('tblestimateassignstaff', $sdata);
//
//            $prdata['staff_id'] = $staffid;
//            $prdata['lead_id'] = $insert_id;
//            $prdata['status'] = 1;
//            $prdata['created_at'] = date("Y-m-d H:i:s");
//            $prdata['updated_at'] = date("Y-m-d H:i:s");
//            $this->db->insert('tblestimatestaffapproval', $prdata);
//
//            $notified = add_notification([
//                'description' => 'Proforma Invoice Send to you for Approval',
//                'touserid' => $staffid,
//                'fromuserid' => get_staff_user_id(),
//                'link' => 'estimates/#' . $insert_id,
//                'additional_data' => serialize([
//                    $proposal->subject,
//                ]),
//            ]);
//            if ($notified) {
//                pusher_trigger_notification([$staffid]);
//            }
//            /* $notified = add_notification([
//              'description'     => 'not_proposal_assigned_to_you',
//              'touserid'        => $staffid,
//              'fromuserid'      => get_staff_user_id(),
//              'link'            => 'proposals/list_proposals/' . $insert_id,
//              'additional_data' => serialize([
//              $proposal->subject,
//              ]),
//              ]);
//              if ($notified) {
//              pusher_trigger_notification([$staffid]);
//              } */
//            //$this->lead_assigned_member_notification($insert_id, $staffid);
//        }
        $affectedRows++;
        $proposal_now = $this->get($id);
        /* if ($current_proposal->assigned != $proposal_now->assigned) {
          if ($proposal_now->assigned != get_staff_user_id()) {
          $notified = add_notification([
          'description'     => 'not_proposal_assigned_to_you',
          'touserid'        => $proposal_now->assigned,
          'fromuserid'      => get_staff_user_id(),
          'link'            => 'proposals/list_proposals/' . $id,
          'additional_data' => serialize([
          $proposal_now->subject,
          ]),
          ]);
          if ($notified) {
          pusher_trigger_notification([$proposal_now->assigned]);
          }
          }
          } */

        if ($save_and_send === true) {
            //  $this->send_proposal_to_email($id, 'proposal-send-to-customer', true);
        }
        if ($affectedRows > 0) {
            do_action('after_proposal_updated', $id);

            return true;
        }
        return false;
    }

    public function update($data, $id) {
        $affectedRows = 0;

        $data['number'] = trim($data['number']);

        $original_estimate = $this->get($id);

        $original_status = $original_estimate->status;

        $original_number = $original_estimate->number;

        $original_number_formatted = format_estimate_number($id);

        $save_and_send = isset($data['save_and_send']);

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

        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            if (handle_custom_fields_post($id, $custom_fields)) {
                $affectedRows++;
            }
            unset($data['custom_fields']);
        }

        if (isset($data['tags'])) {
            if (handle_tags_save($data['tags'], $id, 'estimate')) {
                $affectedRows++;
            }
        }

        $data['billing_street'] = trim($data['billing_street']);
        $data['billing_street'] = nl2br($data['billing_street']);

        $data['shipping_street'] = trim($data['shipping_street']);
        $data['shipping_street'] = nl2br($data['shipping_street']);

        $data = $this->map_shipping_columns($data);

        $hook_data = do_action('before_estimate_updated', [
            'data' => $data,
            'id' => $id,
            'items' => $items,
            'newitems' => $newitems,
            'removed_items' => isset($data['removed_items']) ? $data['removed_items'] : [],
        ]);

        $data = $hook_data['data'];
        $data['removed_items'] = $hook_data['removed_items'];
        $items = $hook_data['items'];
        $newitems = $hook_data['newitems'];

        // Delete items checked to be removed from database
        foreach ($data['removed_items'] as $remove_item_id) {
            $original_item = $this->get_estimate_item($remove_item_id);
            if (handle_removed_sales_item_post($remove_item_id, 'estimate')) {
                $affectedRows++;
                $this->log_estimate_activity($id, 'invoice_estimate_activity_removed_item', false, serialize([
                    $original_item->description,
                ]));
            }
        }

        unset($data['removed_items']);

        $this->db->where('id', $id);
        $this->db->update('tblestimates', $data);

        if ($this->db->affected_rows() > 0) {
            // Check for status change
            if ($original_status != $data['status']) {
                $this->log_estimate_activity($original_estimate->id, 'not_estimate_status_updated', false, serialize([
                    '<original_status>' . $original_status . '</original_status>',
                    '<new_status>' . $data['status'] . '</new_status>',
                ]));
                if ($data['status'] == 2) {
                    $this->db->where('id', $id);
                    $this->db->update('tblestimates', ['sent' => 1, ['datesend' => date('Y-m-d H:i:s')]]);
                }
            }
            if ($original_number != $data['number']) {
                $this->log_estimate_activity($original_estimate->id, 'estimate_activity_number_changed', false, serialize([
                    $original_number_formatted,
                    format_estimate_number($original_estimate->id),
                ]));
            }
            $affectedRows++;
        }

        foreach ($items as $key => $item) {
            $original_item = $this->get_estimate_item($item['itemid']);

            if (update_sales_item_post($item['itemid'], $item, 'item_order')) {
                $affectedRows++;
            }

            if (update_sales_item_post($item['itemid'], $item, 'unit')) {
                $affectedRows++;
            }

            if (update_sales_item_post($item['itemid'], $item, 'rate')) {
                $this->log_estimate_activity($id, 'invoice_estimate_activity_updated_item_rate', false, serialize([
                    $original_item->rate,
                    $item['rate'],
                ]));
                $affectedRows++;
            }

            if (update_sales_item_post($item['itemid'], $item, 'qty')) {
                $this->log_estimate_activity($id, 'invoice_estimate_activity_updated_qty_item', false, serialize([
                    $item['description'],
                    $original_item->qty,
                    $item['qty'],
                ]));
                $affectedRows++;
            }

            if (update_sales_item_post($item['itemid'], $item, 'description')) {
                $this->log_estimate_activity($id, 'invoice_estimate_activity_updated_item_short_description', false, serialize([
                    $original_item->description,
                    $item['description'],
                ]));
                $affectedRows++;
            }

            if (update_sales_item_post($item['itemid'], $item, 'long_description')) {
                $this->log_estimate_activity($id, 'invoice_estimate_activity_updated_item_long_description', false, serialize([
                    $original_item->long_description,
                    $item['long_description'],
                ]));
                $affectedRows++;
            }

            if (isset($item['custom_fields'])) {
                if (handle_custom_fields_post($item['itemid'], $item['custom_fields'])) {
                    $affectedRows++;
                }
            }

            if (!isset($item['taxname']) || (isset($item['taxname']) && count($item['taxname']) == 0)) {
                if (delete_taxes_from_item($item['itemid'], 'estimate')) {
                    $affectedRows++;
                }
            } else {
                $item_taxes = get_estimate_item_taxes($item['itemid']);
                $_item_taxes_names = [];
                foreach ($item_taxes as $_item_tax) {
                    array_push($_item_taxes_names, $_item_tax['taxname']);
                }

                $i = 0;
                foreach ($_item_taxes_names as $_item_tax) {
                    if (!in_array($_item_tax, $item['taxname'])) {
                        $this->db->where('id', $item_taxes[$i]['id'])
                                ->delete('tblitemstax');
                        if ($this->db->affected_rows() > 0) {
                            $affectedRows++;
                        }
                    }
                    $i++;
                }
                if (_maybe_insert_post_item_tax($item['itemid'], $item, $id, 'estimate')) {
                    $affectedRows++;
                }
            }
        }

        foreach ($newitems as $key => $item) {
            if ($new_item_added = add_new_sales_item_post($item, $id, 'estimate')) {
                _maybe_insert_post_item_tax($new_item_added, $item, $id, 'estimate');
                $this->log_estimate_activity($id, 'invoice_estimate_activity_added_item', false, serialize([
                    $item['description'],
                ]));
                $affectedRows++;
            }
        }

        if ($affectedRows > 0) {
            update_sales_total_tax_column($id, 'estimate', 'tblestimates');
        }

        if ($save_and_send === true) {
            $this->send_estimate_to_client($id, '', true, '', true);
        }

        if ($affectedRows > 0) {
            do_action('after_estimate_updated', $id);

            return true;
        }

        return false;
    }

    public function mark_action_status($action, $id, $client = false) {
        $this->db->where('id', $id);
        $this->db->update('tblestimates', [
            'status' => $action,
        ]);

        $notifiedUsers = [];

        if ($this->db->affected_rows() > 0) {
            $estimate = $this->get($id);
            if ($client == true) {
                $this->db->where('staffid', $estimate->addedfrom);
                $this->db->or_where('staffid', $estimate->sale_agent);
                $staff_estimate = $this->db->get('tblstaff')->result_array();
                $invoiceid = false;
                $invoiced = false;

                $this->load->model('emails_model');

                $this->emails_model->set_rel_id($id);
                $this->emails_model->set_rel_type('estimate');

                $merge_fields_for_staff_email = [];
                if (!is_client_logged_in()) {
                    $contact_id = get_primary_contact_user_id($estimate->clientid);
                } else {
                    $contact_id = get_contact_user_id();
                }
                $merge_fields_for_staff_email = array_merge($merge_fields_for_staff_email, get_client_contact_merge_fields($estimate->clientid, $contact_id));
                $merge_fields_for_staff_email = array_merge($merge_fields_for_staff_email, get_estimate_merge_fields($estimate->id));


                if ($action == 4) {
                    if (get_option('estimate_auto_convert_to_invoice_on_client_accept') == 1) {
                        $invoiceid = $this->convert_to_invoice($id, true);
                        $this->load->model('invoices_model');
                        if ($invoiceid) {
                            $invoiced = true;
                            $invoice = $this->invoices_model->get($invoiceid);
                            $this->log_estimate_activity($id, 'estimate_activity_client_accepted_and_converted', true, serialize([
                                '<a href="' . admin_url('invoices/list_invoices/' . $invoiceid) . '">' . format_invoice_number($invoice->id) . '</a>',
                            ]));
                        }
                    } else {
                        $this->log_estimate_activity($id, 'estimate_activity_client_accepted', true);
                    }

                    // Send thank you email to all contacts with permission estimates
                    $contacts = $this->clients_model->get_contacts($estimate->clientid, ['active' => 1, 'estimate_emails' => 1]);
                    foreach ($contacts as $contact) {
                        $merge_fields = [];
                        $merge_fields = array_merge($merge_fields, get_client_contact_merge_fields($estimate->clientid, $contact['id']));
                        $merge_fields = array_merge($merge_fields, get_estimate_merge_fields($estimate->id));
                        $this->emails_model->send_email_template('estimate-thank-you-to-customer', $contact['email'], $merge_fields);
                    }
                    foreach ($staff_estimate as $member) {
                        $notified = add_notification([
                            'fromcompany' => true,
                            'touserid' => $member['staffid'],
                            'description' => 'not_estimate_customer_accepted',
                            'link' => 'estimates/list_estimates/' . $id,
                            'additional_data' => serialize([
                                format_estimate_number($estimate->id),
                            ]),
                        ]);
                        if ($notified) {
                            array_push($notifiedUsers, $member['staffid']);
                        }
                        // Send staff email notification that customer accepted estimate
                        $this->emails_model->send_email_template('estimate-accepted-to-staff', $member['email'], $merge_fields_for_staff_email);
                    }

                    pusher_trigger_notification($notifiedUsers);
                    do_action('estimate_accepted', $id);

                    return [
                        'invoiced' => $invoiced,
                        'invoiceid' => $invoiceid,
                    ];
                } elseif ($action == 3) {
                    foreach ($staff_estimate as $member) {
                        $notified = add_notification([
                            'fromcompany' => true,
                            'touserid' => $member['staffid'],
                            'description' => 'not_estimate_customer_declined',
                            'link' => 'estimates/list_estimates/' . $id,
                            'additional_data' => serialize([
                                format_estimate_number($estimate->id),
                            ]),
                        ]);

                        if ($notified) {
                            array_push($notifiedUsers, $member['staffid']);
                        }
                        // Send staff email notification that customer declined estimate
                        $this->emails_model->send_email_template('estimate-declined-to-staff', $member['email'], $merge_fields_for_staff_email);
                    }

                    pusher_trigger_notification($notifiedUsers);
                    $this->log_estimate_activity($id, 'estimate_activity_client_declined', true);
                    do_action('estimate_declined', $id);

                    return [
                        'invoiced' => $invoiced,
                        'invoiceid' => $invoiceid,
                    ];
                }
            } else {
                if ($action == 2) {
                    $this->db->where('id', $id);
                    $this->db->update('tblestimates', ['sent' => 1, 'datesend' => date('Y-m-d H:i:s')]);
                }
                // Admin marked estimate
                $this->log_estimate_activity($id, 'estimate_activity_marked', false, serialize([
                    '<status>' . $action . '</status>',
                ]));

                return true;
            }
        }

        return false;
    }

    /**
     * Get estimate attachments
     * @param  mixed $estimate_id
     * @param  string $id          attachment id
     * @return mixed
     */
    public function get_attachments($estimate_id, $id = '') {
        // If is passed id get return only 1 attachment
        if (is_numeric($id)) {
            $this->db->where('id', $id);
        } else {
            $this->db->where('rel_id', $estimate_id);
        }
        $this->db->where('rel_type', 'estimate');
        $result = $this->db->get('tblfiles');
        if (is_numeric($id)) {
            return $result->row();
        }

        return $result->result_array();
    }

    /**
     *  Delete estimate attachment
     * @param   mixed $id  attachmentid
     * @return  boolean
     */
    public function delete_attachment($id) {
        $attachment = $this->get_attachments('', $id);
        $deleted = false;
        if ($attachment) {
            if (empty($attachment->external)) {
                unlink(get_upload_path_by_type('estimate') . $attachment->rel_id . '/' . $attachment->file_name);
            }
            $this->db->where('id', $attachment->id);
            $this->db->delete('tblfiles');
            if ($this->db->affected_rows() > 0) {
                $deleted = true;
                logActivity('Estimate Attachment Deleted [EstimateID: ' . $attachment->rel_id . ']');
            }

            if (is_dir(get_upload_path_by_type('estimate') . $attachment->rel_id)) {
                // Check if no attachments left, so we can delete the folder also
                $other_attachments = list_files(get_upload_path_by_type('estimate') . $attachment->rel_id);
                if (count($other_attachments) == 0) {
                    // okey only index.html so we can delete the folder also
                    delete_dir(get_upload_path_by_type('estimate') . $attachment->rel_id);
                }
            }
        }

        return $deleted;
    }

    /**
     * Delete estimate items and all connections
     * @param  mixed $id estimateid
     * @return boolean
     */
    public function delete($id, $simpleDelete = false) {
        if (get_option('delete_only_on_last_estimate') == 1 && $simpleDelete == false) {
            if (!is_last_estimate($id)) {
                return false;
            }
        }
        $estimate = $this->get($id);
        if (!is_null($estimate->invoiceid) && $simpleDelete == false) {
            return [
                'is_invoiced_estimate_delete_error' => true,
            ];
        }
        do_action('before_estimate_deleted', $id);

        $number = format_estimate_number($id);

        $this->clear_signature($id);

        $this->db->where('id', $id);
        $this->db->delete('tblestimates');

        if ($this->db->affected_rows() > 0) {
            if (get_option('estimate_number_decrement_on_delete') == 1 && $simpleDelete == false) {
                $current_next_estimate_number = get_option('next_estimate_number');
                if ($current_next_estimate_number > 1) {
                    // Decrement next estimate number to
                    $this->db->where('name', 'next_estimate_number');
                    $this->db->set('value', 'value-1', false);
                    $this->db->update('tbloptions');
                }
            }

            if (total_rows('tblproposals', [
                        'estimate_id' => $id,
                    ]) > 0) {
                $this->db->where('estimate_id', $id);
                $estimate = $this->db->get('tblproposals')->row();
                $this->db->where('id', $estimate->id);
                $this->db->update('tblproposals', [
                    'estimate_id' => null,
                    'date_converted' => null,
                ]);
            }

            delete_tracked_emails($id, 'estimate');

            $this->db->where('relid IN (SELECT id from tblitems_in WHERE rel_type="estimate" AND rel_id="' . $id . '")');
            $this->db->where('fieldto', 'items');
            $this->db->delete('tblcustomfieldsvalues');

            $this->db->where('rel_id', $id);
            $this->db->where('rel_type', 'estimate');
            $this->db->delete('tblnotes');

            $this->db->where('rel_type', 'estimate');
            $this->db->where('rel_id', $id);
            $this->db->delete('tblviewstracking');

            $this->db->where('rel_type', 'estimate');
            $this->db->where('rel_id', $id);
            $this->db->delete('tbltags_in');

            $this->db->where('rel_type', 'estimate');
            $this->db->where('rel_id', $id);
            $this->db->delete('tblreminders');

            $this->db->where('rel_id', $id);
            $this->db->where('rel_type', 'estimate');
            $this->db->delete('tblitems_in');

            $this->db->where('rel_id', $id);
            $this->db->where('rel_type', 'estimate');
            $this->db->delete('tblitemstax');

            $this->db->where('rel_id', $id);
            $this->db->where('rel_type', 'estimate');
            $this->db->delete('tblsalesactivity');

            // Delete the custom field values
            $this->db->where('relid', $id);
            $this->db->where('fieldto', 'estimate');
            $this->db->delete('tblcustomfieldsvalues');

            $attachments = $this->get_attachments($id);
            foreach ($attachments as $attachment) {
                $this->delete_attachment($attachment['id']);
            }

            // Get related tasks
            $this->db->where('rel_type', 'estimate');
            $this->db->where('rel_id', $id);
            $tasks = $this->db->get('tblstafftasks')->result_array();
            foreach ($tasks as $task) {
                $this->tasks_model->delete_task($task['id']);
            }
            if ($simpleDelete == false) {
                logActivity('Estimates Deleted [Number: ' . $number . ']');
            }

            return true;
        }

        return false;
    }

    /**
     * Set estimate to sent when email is successfuly sended to client
     * @param mixed $id estimateid
     */
    public function set_estimate_sent($id, $emails_sent = []) {
        $this->db->where('id', $id);
        $this->db->update('tblestimates', [
            'sent' => 1,
            'datesend' => date('Y-m-d H:i:s'),
        ]);
        $this->log_estimate_activity($id, 'invoice_estimate_activity_sent_to_client', false, serialize([
            '<custom_data>' . implode(', ', $emails_sent) . '</custom_data>',
        ]));
        // Update estimate status to sent
        $this->db->where('id', $id);
        $this->db->update('tblestimates', [
            'status' => 2,
        ]);
    }

    /**
     * Send expiration reminder to customer
     * @param  mixed $id estimate id
     * @return boolean
     */
    public function send_expiry_reminder($id) {
        $estimate = $this->get($id);
        $estimate_number = format_estimate_number($estimate->id);
        $pdf = estimate_pdf($estimate);
        $attach = $pdf->Output($estimate_number . '.pdf', 'S');
        $emails_sent = [];
        $sms_sent = false;
        $sms_reminder_log = [];

        // For all cases update this to prevent sending multiple reminders eq on fail
        $this->db->where('id', $id);
        $this->db->update('tblestimates', [
            'is_expiry_notified' => 1,
        ]);

        $contacts = $this->clients_model->get_contacts($estimate->clientid, ['active' => 1, 'estimate_emails' => 1]);
        $this->load->model('emails_model');

        $this->emails_model->set_rel_id($id);
        $this->emails_model->set_rel_type('estimate');

        foreach ($contacts as $contact) {
            $this->emails_model->add_attachment([
                'attachment' => $attach,
                'filename' => $estimate_number . '.pdf',
                'type' => 'application/pdf',
            ]);
            $merge_fields = [];
            $merge_fields = array_merge($merge_fields, get_client_contact_merge_fields($estimate->clientid, $contact['id']));
            $merge_fields = array_merge($merge_fields, get_estimate_merge_fields($estimate->id));

            if ($this->emails_model->send_email_template('estimate-expiry-reminder', $contact['email'], $merge_fields)) {
                array_push($emails_sent, $contact['email']);
            }

            if (can_send_sms_based_on_creation_date($estimate->datecreated) && $this->sms->trigger(SMS_TRIGGER_ESTIMATE_EXP_REMINDER, $contact['phonenumber'], $merge_fields)) {
                $sms_sent = true;
                array_push($sms_reminder_log, $contact['firstname'] . ' (' . $contact['phonenumber'] . ')');
            }
        }

        if (count($emails_sent) > 0 || $sms_sent) {
            if (count($emails_sent) > 0) {
                $this->log_estimate_activity($id, 'not_expiry_reminder_sent', false, serialize([
                    '<custom_data>' . implode(', ', $emails_sent) . '</custom_data>',
                ]));
            }

            if ($sms_sent) {
                $this->log_estimate_activity($id, 'sms_reminder_sent_to', false, serialize([
                    implode(', ', $sms_reminder_log),
                ]));
            }

            return true;
        }

        return false;
    }

    /**
     * Send estimate to client
     * @param  mixed  $id        estimateid
     * @param  string  $template  email template to sent
     * @param  boolean $attachpdf attach estimate pdf or not
     * @return boolean
     */
    public function send_estimate_to_client($id, $template = '', $attachpdf = true, $cc = '', $manually = false) {
        $this->load->model('emails_model');

        $this->emails_model->set_rel_id($id);
        $this->emails_model->set_rel_type('estimate');

        $estimate = $this->get($id);
        if ($template == '') {
            if ($estimate->sent == 0) {
                $template = 'estimate-send-to-client';
            } else {
                $template = 'estimate-already-send';
            }
        }
        $estimate_number = format_estimate_number($estimate->id);


        $emails_sent = [];
        $sent = false;
        $sent_to = $this->input->post('sent_to');
        if ($manually === true) {
            $sent_to = [];
            $contacts = $this->clients_model->get_contacts($estimate->clientid, ['active' => 1, 'estimate_emails' => 1]);
            foreach ($contacts as $contact) {
                array_push($sent_to, $contact['id']);
            }
        }

        $status_now = $estimate->status;
        $status_auto_updated = false;
        if (is_array($sent_to) && count($sent_to) > 0) {
            $i = 0;
            // Auto update status to sent in case when user sends the estimate is with status draft
            if ($status_now == 1) {
                $this->db->where('id', $estimate->id);
                $this->db->update('tblestimates', [
                    'status' => 2,
                ]);
                $status_auto_updated = true;
            }

            if ($attachpdf) {
                $_pdf_estimate = $this->get($estimate->id);
                $pdf = estimate_pdf($_pdf_estimate);
                $attach = $pdf->Output($estimate_number . '.pdf', 'S');
            }

            foreach ($sent_to as $contact_id) {
                if ($contact_id != '') {
                    if ($attachpdf) {
                        $this->emails_model->add_attachment([
                            'attachment' => $attach,
                            'filename' => $estimate_number . '.pdf',
                            'type' => 'application/pdf',
                        ]);
                    }

                    if ($this->input->post('email_attachments')) {
                        $_other_attachments = $this->input->post('email_attachments');

                        foreach ($_other_attachments as $attachment) {
                            $_attachment = $this->get_attachments($id, $attachment);

                            $this->emails_model->add_attachment([
                                'attachment' => get_upload_path_by_type('estimate') . $id . '/' . $_attachment->file_name,
                                'filename' => $_attachment->file_name,
                                'type' => $_attachment->filetype,
                                'read' => true,
                            ]);
                        }
                    }

                    $contact = $this->clients_model->get_contact($contact_id);

                    $merge_fields = [];
                    $merge_fields = array_merge($merge_fields, get_client_contact_merge_fields($estimate->clientid, $contact_id));
                    $merge_fields = array_merge($merge_fields, get_estimate_merge_fields($estimate->id));
                    // Send cc only for the first contact
                    if (!empty($cc) && $i > 0) {
                        $cc = '';
                    }
                    if ($this->emails_model->send_email_template($template, $contact->email, $merge_fields, '', $cc)) {
                        $sent = true;
                        array_push($emails_sent, $contact->email);
                    }
                }
                $i++;
            }
        } else {
            return false;
        }
        if ($sent) {
            $this->set_estimate_sent($id, $emails_sent);
            do_action('estimate_sent', $id);

            return true;
        }
        if ($status_auto_updated) {
            // Estimate not send to customer but the status was previously updated to sent now we need to revert back to draft
            $this->db->where('id', $estimate->id);
            $this->db->update('tblestimates', [
                'status' => 1,
            ]);
        }


        return false;
    }

    /**
     * All estimate activity
     * @param  mixed $id estimateid
     * @return array
     */
    public function get_estimate_activity($id) {
        $this->db->where('rel_id', $id);
        $this->db->where('rel_type', 'estimate');
        $this->db->order_by('date', 'asc');

        return $this->db->get('tblsalesactivity')->result_array();
    }

    /**
     * Log estimate activity to database
     * @param  mixed $id   estimateid
     * @param  string $description activity description
     */
    public function log_estimate_activity($id, $description = '', $client = false, $additional_data = '') {
        $staffid = get_staff_user_id();
        $full_name = get_staff_full_name(get_staff_user_id());
        if (DEFINED('CRON')) {
            $staffid = '[CRON]';
            $full_name = '[CRON]';
        } elseif ($client == true) {
            $staffid = null;
            $full_name = '';
        }

        $this->db->insert('tblsalesactivity', [
            'description' => $description,
            'date' => date('Y-m-d H:i:s'),
            'rel_id' => $id,
            'rel_type' => 'estimate',
            'staffid' => $staffid,
            'full_name' => $full_name,
            'additional_data' => $additional_data,
        ]);
    }

    /**
     * Updates pipeline order when drag and drop
     * @param  mixe $data $_POST data
     * @return void
     */
    public function update_pipeline($data) {
        $this->mark_action_status($data['status'], $data['estimateid']);
        foreach ($data['order'] as $order_data) {
            $this->db->where('id', $order_data[0]);
            $this->db->update('tblestimates', [
                'pipeline_order' => $order_data[1],
            ]);
        }
    }

    /**
     * Get estimate unique year for filtering
     * @return array
     */
    public function get_estimates_years() {
        return $this->db->query('SELECT DISTINCT(YEAR(date)) as year FROM tblestimates ORDER BY year DESC')->result_array();
    }

    private function map_shipping_columns($data) {
        if (!isset($data['include_shipping'])) {
            foreach ($this->shipping_fields as $_s_field) {
                if (isset($data[$_s_field])) {
                    $data[$_s_field] = null;
                }
            }
            $data['show_shipping_on_estimate'] = 1;
            $data['include_shipping'] = 0;
        } else {
            $data['include_shipping'] = 1;
            // set by default for the next time to be checked
            if (isset($data['show_shipping_on_estimate']) && ($data['show_shipping_on_estimate'] == 1 || $data['show_shipping_on_estimate'] == 'on')) {
                $data['show_shipping_on_estimate'] = 1;
            } else {
                $data['show_shipping_on_estimate'] = 0;
            }
        }

        return $data;
    }

    public function delete_chalan($id) {

        $this->db->where('id', $id);
        $this->db->delete('tblchalanmst');
        if ($this->db->affected_rows() > 0) {
            logActivity('Challan Deleted [ID: ' . $id . ']');

            return true;
        }

        return false;
    }

    public function deletechalan($id) {

        $this->db->where('id', $id);
        $this->db->delete('tblcreatedchalanmst');
        if ($this->db->affected_rows() > 0) {
            logActivity('Challan Deleted [ID: ' . $id . ']');

            return true;
        }

        return false;
    }


    public function get_estimates($where,$start_from,$limit)
    {

        if(!empty($this->session->userdata('estimate_where_amt_desc'))){
           return $this->db->query("SELECT * from `tblestimates` where ".$where." ORDER BY total desc LIMIT ".$start_from.",".$limit." ")->result();
        }else{
            return $this->db->query("SELECT * from `tblestimates` where ".$where." ORDER BY id desc LIMIT ".$start_from.",".$limit." ")->result();
        }

    }

    public function get_estimates_count($where)
    {

        return $this->db->query("SELECT count(id) as `ttl_count` from `tblestimates` where ".$where."  ")->row()->ttl_count;
    }

    /* this function use for production */
    public function convert_to_productionplan($data, $chalan_id){
        
        $ref_type = ($data['ref_type'] == 'proforma_challan') ? 2 : 1;
        $ad_data = array(
            "chalan_id" => $chalan_id,
            "clientid" => $data['clientid'],
            "ref_type" => $ref_type,
            "date" => db_date($data["date"]),
            "department" => $data["department"],
            "assigned_to" => $data["assigned_to"],
            "note" => $data["note"],
            "added_by" => get_staff_user_id(),
            "created_at" => date("Y-m-d H:i:s"),
            "updated_at" => date("Y-m-d H:i:s"),
        );
        
        $insert_id = $this->home_model->insert("tblchalanproductionplan", $ad_data);
        if($insert_id){

            /* update id in challan table for tracking */
            if ($data['ref_type'] == 'proforma_challan'){
                $this->home_model->update("tblproformachalan", array("production_plan_id" => $insert_id), array("id" => $chalan_id));
            }else{
                $this->home_model->update("tblchalanmst", array("production_plan_id" => $insert_id), array("id" => $chalan_id));
            }

            if(isset($data["componentdata"]) && !empty($data["componentdata"])){
                foreach ($data["componentdata"] as $singlecomponent) {
                    $component_id = $singlecomponent["component_item_id"];
                    $componentid = $singlecomponent["component_id"];
                    $deleverable_qty = $singlecomponent["component_deleverable_qty"];

                    if ($data['ref_type'] == 'challan'){
                        $up_data["remark"] = $singlecomponent["remark"];

                        $this->home_model->update("tblchalandetailsmst", $up_data, array("id" => $component_id));
                    }    

                    /* this is for add / update production demand qty */
                    $chk_product = $this->db->query("SELECT id FROM tblproducts WHERE `id`='".$componentid."' AND `productmaterial_id`!='11' AND `isOtherCharge`='0'")->row();
                    if (!empty($chk_product)){
                        $chk_data = $this->db->query("SELECT id,demand_qty FROM tblproduction_component_demand WHERE `product_id`='".$componentid."'")->row();
                        if (!empty($chk_data)){
                            $demand_qty = $chk_data->demand_qty + $deleverable_qty;
                            $demand_arr = array(
                                'product_id' => $componentid,
                                'demand_qty' => $demand_qty,
                                'status' => 0
                            );
                            $this->home_model->update('tblproduction_component_demand', $demand_arr, array('id' => $chk_data->id));
                        }else{
                            $demand_arr = array(
                                'product_id' => $componentid,
                                'demand_qty' => $deleverable_qty,
                                'status' => 0
                            );
                            $this->home_model->insert('tblproduction_component_demand', $demand_arr);
                        }
                    }
                }
            }
            return $insert_id;
        }
        return false;
    }

    /* this function use for edit production */
    public function edit_production_plan($data, $id){

        $ad_data = array(
            "note" => $data["note"],
            "date" => db_date($data["date"]),
            "department" => $data["department"],
            "assigned_to" => $data["assigned_to"],
            "updated_at" => date("Y-m-d H:i:s"),
        );
        $update = $this->home_model->update("tblchalanproductionplan", $ad_data, array("id" => $id));
        if($update){

            if ($data['ref_type'] == 'challan'){
                if(isset($data["componentdata"]) && !empty($data["componentdata"])){
                    foreach ($data["componentdata"] as $singlecomponent) {
                        $component_id = $singlecomponent["component_item_id"];
                        $up_data["remark"] = $singlecomponent["remark"];
    
                        $this->home_model->update("tblchalandetailsmst", $up_data, array("id" => $component_id));
                    }
                }
            }
            return $id;
        }
        return false;
    }

    /* this function use for proforma chalan generate */
    public function addProformaChalan($proforma_data){

        $chalandate = (!empty($proforma_data["date"])) ? db_date($proforma_data["date"]) : date("Y-m-d");
        $note = (!empty($proforma_data["note"])) ? $proforma_data["note"] : "";
        $adminnote = (!empty($proforma_data["adminnote"])) ? $proforma_data["adminnote"] : "";
        $terms_and_conditions = (!empty($proforma_data["terms_and_conditions"])) ? $proforma_data["terms_and_conditions"] : "";
        $office_person = (!empty($proforma_data["office_person"])) ? $proforma_data["office_person"] : "";
        $site_person = (!empty($proforma_data["site_person"])) ? $proforma_data["site_person"] : "";
        $office_person_number = (!empty($proforma_data["office_person_number"])) ? $proforma_data["office_person_number"] : "";
        $site_person_number = (!empty($proforma_data["site_person_number"])) ? $proforma_data["site_person_number"] : "";
        $billing_street = (!empty($proforma_data["billing_street"])) ? $proforma_data["billing_street"] : "";
        $billing_city = (!empty($proforma_data["billing_city"])) ? $proforma_data["billing_city"] : "";
        $billing_state = (!empty($proforma_data["billing_state"])) ? $proforma_data["billing_state"] : "";
        $billing_zip = (!empty($proforma_data["billing_zip"])) ? $proforma_data["billing_zip"] : "";
        $shipping_street = (!empty($proforma_data["shipping_street"])) ? $proforma_data["shipping_street"] : "";
        $shipping_city = (!empty($proforma_data["shipping_city"])) ? $proforma_data["shipping_city"] : "";
        $shipping_state = (!empty($proforma_data["shipping_state"])) ? $proforma_data["shipping_state"] : "";
        $shipping_zip = (!empty($proforma_data["shipping_zip"])) ? $proforma_data["shipping_zip"] : "";
        $shipping_country = (!empty($proforma_data["shipping_country"])) ? $proforma_data["shipping_country"] : "0";
        $work_no = (!empty($proforma_data["work_no"])) ? $proforma_data["work_no"] : "";
        $workdate = (!empty($proforma_data["workdate"])) ? db_date($proforma_data["workdate"]) : "";
        $assign_group_id = (!empty($proforma_data['assign'])) ? $proforma_data['assign'] : 0;

        $pcInsertdata["year_id"] = financial_year(); 
        $pcInsertdata['billing_branch_id'] = get_login_branch();
        $pcInsertdata['date'] = $chalandate;
        $pcInsertdata['note'] = $note;
        $pcInsertdata['adminnote'] = $adminnote;
        $pcInsertdata['terms_and_conditions'] = $terms_and_conditions;
        $pcInsertdata['office_person'] = $office_person;
        $pcInsertdata['site_person'] = $site_person;
        $pcInsertdata['office_person_number'] = $office_person_number;
        $pcInsertdata['site_person_number'] = $site_person_number;
        $pcInsertdata['billing_street'] = $billing_street;
        $pcInsertdata['billing_city'] = $billing_city;
        $pcInsertdata['billing_state'] = $billing_state;
        $pcInsertdata['billing_zip'] = $billing_zip;
        $pcInsertdata['shipping_street'] = $shipping_street;
        $pcInsertdata['shipping_city'] = $shipping_city;
        $pcInsertdata['shipping_state'] = $shipping_state;
        $pcInsertdata['shipping_zip'] = $shipping_zip;
        $pcInsertdata['shipping_country'] = $shipping_country;
        $pcInsertdata['site_id'] = $proforma_data["site_id"];
        $pcInsertdata['work_no'] = $work_no;
        $pcInsertdata['workdate'] = $workdate;
        $pcInsertdata['clientid'] = $proforma_data["clientid"];
        $pcInsertdata['warehouse_id'] = $proforma_data["warehouse_id"];
        $pcInsertdata['service_type'] = $proforma_data["service_type"];
        $pcInsertdata['rel_id'] = $proforma_data["rel_id"];
        $pcInsertdata['datecreated'] = date('Y-m-d H:i:s');
        $pcInsertdata['addedfrom'] = get_staff_user_id();
        $pcInsertdata['status'] = $proforma_data["status"];
        $pcInsertdata['group_id'] = $assign_group_id;

        $insert_id = $this->home_model->insert("tblproformachalan", $pcInsertdata);
        if($insert_id){

            /* assign parson for approval */
            $assignstaffarr = array();
            $lead_staff_info = $this->db->query("SELECT * FROM tblleadstaffgroup where id = '" . $assign_group_id . "' ")->row_array();
            $superiordata = explode(',', $lead_staff_info['superior_ids']);
            if (!empty($superiordata)) {
                foreach ($superiordata as $staffid) {
                    array_push($assignstaffarr, $staffid);
                }
            }
            $salespersondata = explode(',', $lead_staff_info['sales_person_id']);
            if (!empty($salespersondata)) {
                foreach ($salespersondata as $staffid) {
                    array_push($assignstaffarr, $staffid);
                }
            }
            $quotepersondata = explode(',', $lead_staff_info['quote_person_ids']);
            if (!empty($quotepersondata)) {
                foreach ($quotepersondata as $staffid) {
                    array_push($assignstaffarr, $staffid);
                }
            }
            
            /* this is for store products */
            if(isset($proforma_data["chalanproduct"]) && !empty($proforma_data["chalanproduct"])){
                foreach ($proforma_data["chalanproduct"] as $chalanpro) {
                    $chalanprodata = array(
                        "proformachalan_id" => $insert_id,
                        "product_id" => $chalanpro["product_id"],
                        "qty" => $chalanpro["product_qty"],
                        "type" => 1,
                    );
                    $this->home_model->insert("tblproformachalandetails", $chalanprodata);
                }
            }

            /* this is for store products */
            if(isset($proforma_data["componentdata"]) && !empty($proforma_data["componentdata"])){
                foreach ($proforma_data["componentdata"] as $chalanitems) {
                    $chalanitemsdata = array(
                        "proformachalan_id" => $insert_id,
                        "product_id" => $chalanitems["componentid"],
                        "qty" => $chalanitems["requiredqty"],
                        "type" => 2,
                    );
                    $this->home_model->insert("tblproformachalandetails", $chalanitemsdata);
                }
            }

            
            $assign_arr = array_unique($assignstaffarr);
            if (!empty($assign_arr)) {

                $this->home_model->delete("tblproformachalanapproval", array("proformachallan_id" => $insert_id));
                $this->home_model->delete("tblmasterapproval", array("table_id" => $insert_id, "module_id" => '55'));

                foreach ($assign_arr as $staffid) {

                    if($staffid!=get_staff_user_id())
                    {
                        $prdata['staff_id'] = $staffid;
                        $prdata['proformachallan_id'] = $insert_id;
                        $prdata['status'] = 1;
                        $prdata['created_at'] = date("Y-m-d H:i:s");
                        $prdata['updated_at'] = date("Y-m-d H:i:s");
                        $this->db->insert('tblproformachalanapproval', $prdata);

                        $adata = array(
                                'staff_id' => $staffid,
                                'fromuserid' => get_staff_user_id(),
                                'module_id' => 55,
                                'table_id' => $insert_id,
                                'approve_status' => 0,
                                'status' => 0,
                                'description'     => 'Proforma Challan send to you for approval',
                                'link' => 'estimates/proforma_chalan_approval/'.$insert_id,
                                'date' => date('Y-m-d'),
                                'date_time' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('tblmasterapproval', $adata);
                    }
                }
            }
            return $insert_id;
        }
        return false;
    }

    /* this function use for edit proforma challan */
    public function editProformaChallan($id, $proforma_data){
        $chalandate = (!empty($proforma_data["date"])) ? db_date($proforma_data["date"]) : date("Y-m-d");
        $office_person = (!empty($proforma_data["office_person"])) ? $proforma_data["office_person"] : "";
        $site_person = (!empty($proforma_data["site_person"])) ? $proforma_data["site_person"] : "";
        $office_person_number = (!empty($proforma_data["office_person_number"])) ? $proforma_data["office_person_number"] : "";
        $site_person_number = (!empty($proforma_data["site_person_number"])) ? $proforma_data["site_person_number"] : "";
        $work_no = (!empty($proforma_data["work_no"])) ? $proforma_data["work_no"] : "";
        $workdate = (!empty($proforma_data["workdate"])) ? db_date($proforma_data["workdate"]) : "";
        $note = (!empty($proforma_data["note"])) ? $proforma_data["note"] : "";
        $terms_and_conditions = (!empty($proforma_data["terms_and_conditions"])) ? $proforma_data["terms_and_conditions"] : "";
        $assign_group_id = (!empty($proforma_data['assign'])) ? $proforma_data['assign'] : 0;

        $pcUdata['date'] = $chalandate;
        $pcUdata['office_person'] = $office_person;
        $pcUdata['site_person'] = $site_person;
        $pcUdata['office_person_number'] = $office_person_number;
        $pcUdata['site_person_number'] = $site_person_number;
        $pcUdata['work_no'] = $work_no;
        $pcUdata['workdate'] = $workdate;
        $pcUdata['note'] = $note;
        $pcUdata['terms_and_conditions'] = $terms_and_conditions;
        $pcUdata['pdf_line_break'] = $proforma_data["pdf_line_break"];
        $pcUdata['approve_status'] = '0';

        $response = $this->home_model->update("tblproformachalan", $pcUdata, array("id" => $id));
        if ($response){

            /* assign parson for approval */
            $assignstaffarr = array();
            $lead_staff_info = $this->db->query("SELECT * FROM tblleadstaffgroup where id = '" . $assign_group_id . "' ")->row_array();
            $superiordata = explode(',', $lead_staff_info['superior_ids']);
            if (!empty($superiordata)) {
                foreach ($superiordata as $staffid) {
                    array_push($assignstaffarr, $staffid);
                }
            }
            $salespersondata = explode(',', $lead_staff_info['sales_person_id']);
            if (!empty($salespersondata)) {
                foreach ($salespersondata as $staffid) {
                    array_push($assignstaffarr, $staffid);
                }
            }
            $quotepersondata = explode(',', $lead_staff_info['quote_person_ids']);
            if (!empty($quotepersondata)) {
                foreach ($quotepersondata as $staffid) {
                    array_push($assignstaffarr, $staffid);
                }
            }

            /* this is for store products */
            if(isset($proforma_data["productdata"]) && !empty($proforma_data["productdata"])){
                $this->home_model->delete("tblproformachalandetails", array("proformachalan_id" => $id,"type" => 1));

                foreach ($proforma_data["productdata"] as $chalanpro) {
                    $chalanprodata = array(
                        "proformachalan_id" => $id,
                        "product_id" => $chalanpro["product_id"],
                        "qty" => $chalanpro["qty"],
                        "type" => 1,
                    );
                    $this->home_model->insert("tblproformachalandetails", $chalanprodata);
                }
            }

            /* this is for store products */
            if(isset($proforma_data["componentdata"]) && !empty($proforma_data["componentdata"])){
                $this->home_model->delete("tblproformachalandetails", array("proformachalan_id" => $id,"type" => 2));

                foreach ($proforma_data["componentdata"] as $chalanitems) {
                    $chalanitemsdata = array(
                        "proformachalan_id" => $id,
                        "product_id" => $chalanitems["componentid"],
                        "qty" => $chalanitems["requiredqty"],
                        "type" => 2,
                    );
                    $this->home_model->insert("tblproformachalandetails", $chalanitemsdata);
                }
            }

            $assign_arr = array_unique($assignstaffarr);
            if (!empty($assign_arr)) {

                $this->home_model->delete("tblproformachalanapproval", array("proformachallan_id" => $id));
                $this->home_model->delete("tblmasterapproval", array("table_id" => $id, "module_id" => '55'));

                foreach ($assign_arr as $staffid) {

                    if($staffid!=get_staff_user_id())
                    {
                        $prdata['staff_id'] = $staffid;
                        $prdata['proformachallan_id'] = $id;
                        $prdata['status'] = 1;
                        $prdata['created_at'] = date("Y-m-d H:i:s");
                        $prdata['updated_at'] = date("Y-m-d H:i:s");
                        $this->db->insert('tblproformachalanapproval', $prdata);

                        $adata = array(
                                'staff_id' => $staffid,
                                'fromuserid' => get_staff_user_id(),
                                'module_id' => 55,
                                'table_id' => $id,
                                'approve_status' => 0,
                                'status' => 0,
                                'description'     => 'Proforma Challan send to you for approval',
                                'link' => 'estimates/proforma_chalan_approval/'.$id,
                                'date' => date('Y-m-d'),
                                'date_time' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('tblmasterapproval', $adata);
                    }
                }
            }
            return true;
        }
        return false;
    }
}
