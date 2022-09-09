<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Document extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

    public function index()
    {
       /* if (!is_admin()) {
            access_denied('expenses');
        }*/
        
        $data['title'] = 'Document List';
        $this->load->view('admin/document/manage', $data);

    }

    public function table() {
        $this->app->get_table_data('document');
    }

    public function add()
    {


        if(!empty($_POST)){
            extract($this->input->post());
        
            $ad_data = array(                            
                            'title' => $title,
                            'description' => $description,
                            'created_at' => date('Y-m-d H:i:s'),
                            'status' => 1
                        );
                    
                    
            $insert = $this->home_model->insert('tbldocuments', $ad_data);  

            if($insert){
                $doc_id = $this->db->insert_id();
                handle_multi_document_attachments($doc_id,'office_document');

                set_alert('success', 'Document Uploaded Successfully');
                redirect(admin_url('document'));
            }
        }

        /*$data['lead_info']  = $this->db->query("SELECT * FROM tblappleads WHERE id = '".$id."'")->row();
        $data['lead_attachment']  = $this->db->query("SELECT * FROM tblfiles WHERE rel_type = 'app_leads' and  rel_id = '".$id."'")->result();*/
        $data['title'] = 'Add Document';
        $this->load->view('admin/document/add', $data);

    }




    public function change_document_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $unit_data = array(
                'status' => $status
            );
            
            $this->home_model->update('tbldocuments', $unit_data, array('id' => $id));
        }
    }

    public function delete($id)
    {
        
        $response = $this->home_model->delete('tbldocuments', array('id'=>$id));
        if ($response == true) {
            $this->home_model->delete('tblfiles', array('rel_type'=>'office_document','rel_id'=>$id));
            set_alert('success', _l('deleted', 'document'));
        } else {
            set_alert('warning', _l('problem_deleting', 'document'));
        }
        redirect(admin_url('document'));
    }


    public function get_fiel_list()
    {


        if(!empty($_POST)){
            extract($this->input->post());
            $file_info  = $this->db->query("SELECT * FROM tblfiles WHERE rel_type = 'office_document' and  rel_id = '".$id."'")->result();
            ?>
            <div class="row">
                <?php
                if(!empty($file_info)){
                    foreach ($file_info as $key => $value) {
                        ?>
                        <div class="col-md-2"><?php echo ++$key; ?></div>
                        <div class="col-md-8"><?php echo $value->file_name; ?></div>
                        <div class="col-md-2"><a download="" href="<?php echo base_url('uploads/office_document/'.$id.'/'.$value->file_name);?>"><i class="fa fa-download" aria-hidden="true"></i></a></div>
                        <?php
                    }
                }
                ?>
                
            </div>
            <?php
        }

    }



}
