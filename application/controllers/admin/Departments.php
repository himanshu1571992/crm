<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Departments extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('departments_model');
        $this->load->model('home_model');

        if (!is_admin()) {
            access_denied('Departments');
        }
    }

    /* List all departments */
    public function index()
    {
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('departments');
        }
        $data['email_exist_as_staff'] = $this->email_exist_as_staff();
        $data['title']                = _l('departments');
        $this->load->view('admin/departments/manage', $data);
    }

    /* Edit or add new department */
    public function department($id = '')
    {
        if ($this->input->post()) {
            $message          = '';
            $data             = $this->input->post();
            $data             = $this->input->post();
            $data['password'] = $this->input->post('password', false);

            if (isset($data['fakeusernameremembered']) || isset($data['fakepasswordremembered'])) {
                unset($data['fakeusernameremembered']);
                unset($data['fakepasswordremembered']);
            }

            if (!$this->input->post('id')) {
                $id = $this->departments_model->add($data);
                if ($id) {
                    $success = true;
                    $message = _l('added_successfully', _l('department'));
                }
                echo json_encode([
                    'success'              => $success,
                    'message'              => $message,
                    'email_exist_as_staff' => $this->email_exist_as_staff(),
                ]);
            } else {
                $id = $data['id'];
                unset($data['id']);
                $success = $this->departments_model->update($data, $id);
                if ($success) {
                    $message = _l('updated_successfully', _l('department'));
                }
                echo json_encode([
                    'success'              => $success,
                    'message'              => $message,
                    'email_exist_as_staff' => $this->email_exist_as_staff(),
                ]);
            }
            die;
        }
    }

    /* Delete department from database */
    public function delete($id)
    {
        if (!$id) {
            redirect(admin_url('departments'));
        }
        $response = $this->departments_model->delete($id);
        if (is_array($response) && isset($response['referenced'])) {
            set_alert('warning', _l('is_referenced', _l('department_lowercase')));
        } elseif ($response == true) {
            set_alert('success', _l('deleted', _l('department')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('department_lowercase')));
        }
        redirect(admin_url('departments'));
    }

    public function email_exists()
    {
        // First we need to check if the email is the same
        $departmentid = $this->input->post('departmentid');
        if ($departmentid) {
            $this->db->where('departmentid', $departmentid);
            $_current_email = $this->db->get('tbldepartments')->row();
            if ($_current_email->email == $this->input->post('email')) {
                echo json_encode(true);
                die();
            }
        }
        $exists = total_rows('tbldepartments', [
            'email' => $this->input->post('email'),
        ]);
        if ($exists > 0) {
            echo 'false';
        } else {
            echo 'true';
        }
    }

    public function test_imap_connection()
    {
        $email         = $this->input->post('email');
        $password      = $this->input->post('password', false);
        $host          = $this->input->post('host');
        $imap_username = $this->input->post('username');
        if ($this->input->post('encryption')) {
            $encryption = $this->input->post('encryption');
        } else {
            $encryption = '';
        }

        require_once(APPPATH . 'third_party/php-imap/Imap.php');

        $mailbox = $host;

        if ($imap_username != '') {
            $username = $imap_username;
        } else {
            $username = $email;
        }

        $password   = $password;
        $encryption = $encryption;
        // open connection
        $imap = new Imap($mailbox, $username, $password, $encryption);
        if ($imap->isConnected() === true) {
            echo json_encode([
                'alert_type' => 'success',
                'message'    => _l('lead_email_connection_ok'),
            ]);
        } else {
            echo json_encode([
                'alert_type' => 'warning',
                'message'    => $imap->getError(),
            ]);
        }
    }

    private function email_exist_as_staff()
    {
        return total_rows('tbldepartments', 'email IN (SELECT email FROM tblstaff)') > 0;
    }

    public function division_list() {

        $data['division_list']  = $this->db->query("SELECT * FROM tbldivisionmaster order by id DESC ")->result();

        $data['title'] = 'Division Master List';
        $this->load->view('admin/departments/division_list', $data);
    }

    public function add_division($id = '') {

        if ($this->input->post()) {
            extract($this->input->post());

            if ($id == '') {

                $ad_data = array(
                    'title' => $title,
                    'created_at' => date('Y-m-d H:i:s')
                );
                $insert = $this->home_model->insert('tbldivisionmaster', $ad_data);
                if ($insert) {
                    set_alert('success', _l('added_successfully', 'Division Master added successfully'));
                    redirect(admin_url('departments/division_list'));
                }
            } else {

                $ad_data = array(
                    'title' => $title,
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $update = $this->home_model->update('tbldivisionmaster', $ad_data,array('id'=>$id));
                if ($update) {
                    set_alert('success', 'Division Master updated successfully');
                }
                redirect(admin_url('departments/division_list'));
            }
        }

        if ($id == '') {
            $title = 'Add Division Master';
        } else {
            $data['division_info'] = $this->db->query("SELECT * FROM tbldivisionmaster where id = '".$id."' ")->row_array();
            $title = 'Edit Division Master';
        }

        $data['title'] = $title;

        $this->load->view('admin/departments/add_division', $data);
    }

    public function change_division_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $update_data = array(
                'status' => $status
            );
            $this->home_model->update('tbldivisionmaster',$update_data,array('id'=>$id));
        }
    }

    public function delete_divisionmaster($id) {

        $staffdivision = $this->db->query("SELECT * FROM `tblstaff` where division_id = '".$id."' ")->row();
        $subdivision = $this->db->query("SELECT * FROM `tblsubdivisionmaster` where division_id = '".$id."' ")->row();
        $prodivision = $this->db->query("SELECT * FROM `tblproducts` where division_id = '".$id."' ")->row();
        $prosubdivision = $this->db->query("SELECT * FROM `tblproducts_log` where division_id = '".$id."' ")->row();
        if (!empty($staffdivision) OR !empty($subdivision) OR !empty($prodivision) OR !empty($prosubdivision)){
            set_alert('warning', "Can't be delete, its using anywhere.");
            redirect($_SERVER['HTTP_REFERER']); die;
        }
        $response = $this->home_model->delete('tbldivisionmaster', array('id'=>$id));
        if ($response == true) {
            set_alert('success', 'Division Master Deleted Successfully');
            redirect(admin_url('departments/division_list'));
        } else {
            set_alert('warning', 'problem_deleting');
            redirect(admin_url('departments/division_list'));
        }

    }

    public function sub_division_list() {

        $data['division_list']  = $this->db->query("SELECT * FROM tblsubdivisionmaster order by id DESC ")->result();

        $data['title'] = 'Sub Division Master List';
        $this->load->view('admin/departments/sub_division_list', $data);
    }

    public function add_subdivision($id = '') {

        if ($this->input->post()) {
            extract($this->input->post());

            if ($id == '') {

                $ad_data = array(
                    'division_id' => $division_id,
                    'title' => $title,
                    'created_at' => date('Y-m-d H:i:s')
                );
                $insert = $this->home_model->insert('tblsubdivisionmaster', $ad_data);
                if ($insert) {
                    set_alert('success', _l('added_successfully', 'Sub Division Master'));
                    redirect(admin_url('departments/sub_division_list'));
                }
            } else {

                $ad_data = array(
                    'division_id' => $division_id,
                    'title' => $title,
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $update = $this->home_model->update('tblsubdivisionmaster', $ad_data,array('id'=>$id));
                if ($update) {
                    set_alert('success', 'Sub Division Master updated successfully');
                }
                redirect(admin_url('departments/sub_division_list'));
            }
        }

        if ($id == '') {
            $title = 'Add Sub Division Master';
        } else {
            $data['division_info'] = $this->db->query("SELECT * FROM tblsubdivisionmaster where id = '".$id."' ")->row_array();
            $title = 'Edit Sub Division Master';
        }

        $data['title'] = $title;
        $data['division_list'] = $this->db->query("SELECT * FROM tbldivisionmaster where status = 1 ORDER BY title ASC ")->result();
        $this->load->view('admin/departments/add_sub_division', $data);
    }

    public function change_subdivision_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $update_data = array(
                'status' => $status
            );
            $this->home_model->update('tblsubdivisionmaster',$update_data,array('id'=>$id));
        }
    }

    public function delete_subdivisionmaster($id) {

        $prodivision = $this->db->query("SELECT * FROM `tblproducts` where sub_division_id = '".$id."' ")->row();
        $prosubdivision = $this->db->query("SELECT * FROM `tblproducts_log` where sub_division_id = '".$id."' ")->row();
        if (!empty($prodivision) OR !empty($prosubdivision)){
            set_alert('warning', "Can't be delete, its using anywhere.");
            redirect($_SERVER['HTTP_REFERER']); die;
        }
        $response = $this->home_model->delete('tblsubdivisionmaster', array('id'=>$id));
        if ($response == true) {
            set_alert('success', 'Sub Division Master Deleted Successfully');
            redirect(admin_url('departments/sub_division_list'));
        } else {
            set_alert('warning', 'problem_deleting');
            redirect(admin_url('departments/sub_division_list'));
        }

    }
}
