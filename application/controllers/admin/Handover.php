<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Handover extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

    public function index()
    {

        check_permission(154,'view');
        $data['staff_info']  = $this->db->query("SELECT * FROM tblstaff WHERE active = '1' ORDER BY firstname ASC ")->result();
        //check_permission(104,'view');
        if(!empty($_POST)){
            extract($this->input->post());

            $data['s_receiver'] = $receiver;

            $data['handover_info']  = $this->db->query("SELECT * FROM tblhandover WHERE receiver_id = '".$receiver."' order by id desc ")->result();


        }else{
             $data['handover_info']  = $this->db->query("SELECT * FROM tblhandover  order by id desc ")->result();
        }



        $data['title'] = 'Handover List';
        $this->load->view('admin/handover/manage', $data);

    }

    public function add($id="")
    {

        check_permission(154,'create');

        $data['staff_info']  = $this->db->query("SELECT * FROM tblstaff WHERE active = '1' order by firstname asc ")->result();

        if(!empty($_POST)){
            extract($this->input->post());


            $ad_data = array(
                'title' => $title,
                'staff_id' => get_staff_user_id(),
                'receiver_id' => $receiver_id,
                'remark' => $remark,
                'created_at' => date('Y-m-d'),
                'status' => 1
            );



            $insert = $this->home_model->insert('tblhandover', $ad_data);

            if($insert){

                $handover_id = $this->db->insert_id();

                handle_multi_handover_attachments($handover_id,'handover_master');

                $data_1 = array(
                        'handover_id' => $handover_id,
                        'sender_staff_id' => get_staff_user_id(),
                        'receiver_id' => $staff_id,
                        'sender_remark' => $remark,
                        'status' => 1,
                        'created_date' => date('Y-m-d H:i:s')
                    );

                $insert_1 = $this->home_model->insert('tblhandoverlog', $data_1);

                if($insert_1 == true){
                    $insert_id = $this->db->insert_id();
                    $n_data = array(
                            'description' => 'Document Hand-Over for Accept',
                            'touserid' => $staff_id,
                            'fromuserid' => get_staff_user_id(),
                            'table_id' => $insert_id,
                            'type' => 0,
                            'isread' => 0,
                            'isread_inline' => 0,
                            'module_id' => 12,
                            'category_id' => 1,
                            'link'            => '#',
                            'date' => date('Y-m-d H:i:s')
                        );

                    $insert_1 = $this->home_model->insert('tblnotifications', $n_data);

                     //Sending Mobile Intimation
                        $token = get_staff_token($staff_id);
                        $message = 'Document Hand-Over for Accept';
                        $title = 'Schach';
                        $send_intimation = sendFCM($message, $title, $token, $page = 2);
                }

                set_alert('success', 'Handover added Successfully');
                redirect(admin_url('handover'));
            }
        }

        $data['title'] = 'Add Handover';


        $this->load->view('admin/handover/add', $data);

    }




    public function delete($id)
    {
        check_permission(154,'delete');

        $response = $this->home_model->delete('tblhandover', array('id'=>$id));
        if ($response == true) {
            $handover_log  = $this->db->query("SELECT * FROM tblhandoverlog WHERE handover_id = '".$id."'")->result();
            foreach ($handover_log as $row) {
                $this->home_model->delete('tblnotifications', array('module_id'=>12,'table_id'=>$row->id));
            }
            $this->home_model->delete('tblhandoverlog', array('handover_id'=>$id));
            set_alert('success', _l('deleted', 'handover'));
        } else {
            set_alert('warning', _l('problem_deleting', 'handover'));
        }
        redirect(admin_url('handover'));
    }


    public function get_handover_data() {
        if(!empty($_POST)){
            extract($this->input->post());

            $handoverlog_info = $this->db->query("SELECT * from tblhandoverlog where handover_id = '".$handover_id."' ")->result();
            $handover_info = $this->db->query("SELECT * from tblhandover where id = '".$handover_id."' ")->row();


            if(!empty($handover_info) && ($handover_info->final_receive == 1)){
                echo '<h5 class="text-success">Document Reached to Final Receiver ('.get_employee_name($handover_info->receiver_id).')</h5>';
            }
            ?>
            <div class="col-md-12">
                <table class="table ui-table">
                    <thead>
                      <tr>
                        <th>S.No</th>
                        <th>Sender</th>
                        <th>Receiver</th>
                        <th>Sender Remark</th>
                        <th>Receiver Remark</th>
                        <th>Status</th>
                        <th>Receive Date</th>
                        <th>Attachments</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($handoverlog_info)){
                        foreach ($handoverlog_info as $key => $value) {

                            $file_info = $this->db->query("SELECT * from tblfiles where rel_type = 'handover' and rel_id = '".$value->id."' ")->result();
                            ?>

                         <tr>
                            <td><?php echo ++$key; ?></td>
                            <td><?php echo cc(get_employee_name($value->sender_staff_id));?></td>
                            <td><?php echo cc(get_employee_name($value->receiver_id));?></td>
                            <td><?php echo (!empty($value->sender_remark)) ? cc($value->sender_remark) : '--'; ?></td>
                            <td><?php echo (!empty($value->receiver_remark)) ? $value->receiver_remark : '--'; ?></td>
                            <td><?php echo ($value->received_status == 1) ? 'Received' : 'Not Received'; ?></td>
                            <td><?php echo ($value->receive_date > 0) ? _d($value->receive_date) : '--'; ?></td>
                            <td><?php
                                if(!empty($file_info)){
                                    foreach ($file_info as $file) {
                                        ?>
                                        <a target="_blank" href="<?php echo base_url('uploads/handover/'.$file->rel_id.'/'.$file->file_name); ?>"><?php echo $file->file_name; ?></a><br>
                                        <?php
                                    }
                                }else{
                                    echo '--';
                                }
                                ?>
                            </td>

                         </tr>

                         <?php
                        }
                    }else{
                        echo '<tr><td colspan="8" class="text-center">Record Not Found!</td></tr>';
                    }
                    ?>
                     </tbody>
                </table>
            </div>
            <?php

        }
    }

}
