<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Document extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

    public function view($id='')
    {
        check_permission(153,'view');

        if(!empty($id)){
        	$parent_id = $id;
        }else{
        	$parent_id = 0;	
        }	

        $data['document_info']  = $this->db->query("SELECT * FROM tbldocuments WHERE parent_id = '".$parent_id."' and status = '1'  order by type ASC")->result();

        $data['parent_id'] = $parent_id;
        

        $data['title'] = 'Document List';
        $this->load->view('admin/document/manage', $data);

    }


	public function create_folder()
    {

    	if(!empty($_POST)){
            extract($this->input->post());
          
            if(!empty($id)){ 

          		 $ad_data = array(                            
                            'staff_id' => get_staff_user_id(),
		                    'parent_id' => $parent_id,
		                    'name' => $folder_name,
		                    'type' => 1,
		                    'created_at' => date('Y-m-d H:i:s'),
		                    'status' => 1
                        );
                    
          		$update = $this->home_model->update('tbldocuments', $ad_data,array('id'=>$id));  
          	}else{

          		$ad_data = array(                            
                    'staff_id' => get_staff_user_id(),
                    'parent_id' => $parent_id,
                    'name' => $folder_name,
                    'type' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'status' => 1
                );

          		$insert = $this->home_model->insert('tbldocuments', $ad_data); 
          	}

          	  

          	
        
            set_alert('success', 'Folder Created Successfully');

            if($parent_id > 0){
          		redirect(admin_url('document/view/'.$parent_id));
          	}else{
          		redirect(admin_url('document/view'));
          	}
            

        }

    }    


    public function upload_file()
    {

    	if(!empty($_POST)){
            extract($this->input->post());
          
    	    $ad_data = array(                            
                'staff_id' => get_staff_user_id(),
                'parent_id' => $parent_id,
                'type' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'status' => 1
            );

      		$insert = $this->home_model->insert('tbldocuments', $ad_data); 

          	$doc_id = $this->db->insert_id();
            $ff =  handle_document_attachments($doc_id);  

        
            set_alert('success', 'File Uploaded Successfully');

            if($parent_id > 0){
          		redirect(admin_url('document/view/'.$parent_id));
          	}else{
          		redirect(admin_url('document/view'));
          	}
            

        }

    } 



    public function get_editdata()
    {
       
    	 if(!empty($_POST)){
            extract($this->input->post());

            $folder_info  = $this->db->query("SELECT * FROM tbldocuments WHERE id =  '".$id."'  ")->row();


            ?>
            <div  class="col-md-12">
                <div class="form-group">
                    <label for="title" class="control-label">Folder Name *</label>
                    <input type="text" id="folder_name" name="folder_name" class="form-control" required="" value="<?php echo $folder_info->name; ?>">
                </div>

                <input type="hidden" value="<?php echo $id; ?>" name="id">


            </div>

            <?php
        }

    }


    public function delete_file($id,$parent_id="")
    {
        
        //$response = $this->home_model->delete('tbldocuments', array('id'=>$id));
        $response = $this->home_model->delete('tblfiles', array('id'=>$id));
        if ($response == true) {
            //$this->home_model->delete('tblfiles', array('rel_type'=>'office_document','rel_id'=>$id));
            set_alert('success', _l('deleted', 'document'));
        } else {
            set_alert('warning', _l('problem_deleting', 'document'));
        }
        if($parent_id > 0){
      		redirect(admin_url('document/view/'.$parent_id));
      	}else{
      		redirect(admin_url('document/view'));
      	}
    }


    



}
