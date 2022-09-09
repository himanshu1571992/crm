<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Follow_up_model extends CRM_Model
{
    public $todo_limit;

    public function __construct()
    {
        parent::__construct();
        $this->todo_limit = do_action('todos_limit', 20);
    }

    public function setTodosLimit($limit)
    {
        $this->todo_limit = $limit;
    }

    public function getTodosLimit()
    {
        return $this->todo_limit;
    }

    public function get($id = '')
    {
        $this->db->where('staffid', get_staff_user_id());

        if (is_numeric($id)) {
            $this->db->where('todoid', $id);

            return $this->db->get('tbltodoitems')->row();
        }

        return $this->db->get('tbltodoitems')->result_array();
    }

    /**
     * Get all user todos
     * @param  boolean $finished is finished todos or not
     * @param  mixed $page     pagination limit page
     * @return array
     */
    public function get_todo_items($finished, $page = '')
    {
        $this->db->select();
        $this->db->from('tblpaymentfollowupclients');
        $this->db->where('finished', $finished);
        $this->db->where('date', date('Y-m-d'));
        $this->db->where('staffid', get_staff_user_id());
        $this->db->order_by('id', 'asc');
        
        $todos = $this->db->get()->result_array();
        // format date
        $i = 0;
        foreach ($todos as $todo) {


            $todos[$i]['date']    = _d($todo['date']);
            $todos[$i]['datefinished'] = _dt($todo['datefinished']);
            $todos[$i]['description']  = get_company_name($todo['client_id']);
            $todos[$i]['due_amt']  = client_balance_amt($todo['client_id']);
            $i++;
        }

        return $todos;
    }

    public function get_lead_items($finished, $page = '')
    {
        $this->db->select();
        $this->db->from('tblleadfollowup');
        $this->db->where('finished', $finished);
        $this->db->where('date', date('Y-m-d'));
        $this->db->where('staffid', get_staff_user_id());
        $this->db->order_by('id', 'asc');
        
        $todos = $this->db->get()->result_array();
        // format date
        $i = 0;
        foreach ($todos as $todo) {

            $lead_info = $this->db->query("SELECT `leadno`,`client_branch_id`,`company` FROM `tblleads` where id = '".$todo['lead_id']."' ")->row_array();
            if(!empty($lead_info)){

                if($lead_info['client_branch_id'] > 0){
                    $client_info = $this->db->query("SELECT * FROM tblclientbranch WHERE userid = '".$lead_info['client_branch_id']."' ")->row();
                    $company = $client_info->client_branch_name;
                }else{
                    $company = $lead_info['company'];
                }

                $todos[$i]['date']    = _d($todo['date']);
                $todos[$i]['datefinished'] = _dt($todo['datefinished']);
                $todos[$i]['description']  = $company.' ('.$lead_info['leadno'].')';
                
                //$todos[$i]['due_amt']  = client_balance_amt($todo['client_id']);
                $i++;   
            }
            
        }

        return $todos;
    }

    /**
     * Add new user todo
     * @param mixed $data todo $_POST data
     */
    public function add($data)
    {
        $data['dateadded']   = date('Y-m-d H:i:s');
        $data['description'] = nl2br($data['description']);
        $data['staffid']     = get_staff_user_id();
        $this->db->insert('tbltodoitems', $data);

        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $data['description'] = nl2br($data['description']);

        $this->db->where('todoid', $id);
        $this->db->update('tbltodoitems', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }

    /**
     * Update todo's order / Ajax - Sortable
     * @param  mixed $data todo $_POST data
     */
    public function update_todo_items_order($data)
    {
        for ($i = 0; $i < count($data['data']); $i++) {
            $update = [
                'item_order' => $data['data'][$i][1],
                'finished'   => $data['data'][$i][2],
            ];
            if ($data['data'][$i][2] == 1) {
                $update['datefinished'] = date('Y-m-d H:i:s');
            }
            $this->db->where('todoid', $data['data'][$i][0]);
            $this->db->update('tbltodoitems', $update);
        }
    }

    /**
     * Delete todo
     * @param  mixed $id todo id
     * @return boolean
     */
    public function delete_todo_item($id)
    {
        $this->db->where('todoid', $id);
        $this->db->where('staffid', get_staff_user_id());
        $this->db->delete('tbltodoitems');
        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }

    /**
     * Change todo status / finished or not finished
     * @param  mixed $id     todo id
     * @param  integer $status can be passed 1 or 0
     * @return array
     */
    public function change_todo_status($id, $status)
    {
        $this->db->where('todoid', $id);
        $this->db->where('staffid', get_staff_user_id());
        $date = date('Y-m-d H:i:s');
        $this->db->update('tbltodoitems', [
            'finished'     => $status,
            'datefinished' => $date,
        ]);
        if ($this->db->affected_rows() > 0) {
            return [
                'success' => true,
            ];
        }

        return [
            'success' => false,
        ];
    }
}
