<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Cities extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }


    public function index()
    {

        check_permission('88,98,256','view');

        $data['cities_info']  = $this->db->query("SELECT * FROM tblcities order by name ASC ")->result();
       
        $data['title'] = 'City List';
        $this->load->view('admin/cities/manage', $data);

    }
  

   public function city($id = '')
    {
	   
       check_permission('88,98,256','create');
       		
	   $data['state_info'] = $this->home_model->get_result('tblstates', array('status'=>1), '');
			
	   if ($this->input->post()) {
		extract($this->input->post());
		/*echo '<pre/>';
		print_r($_POST);
		die;*/
            if ($id == '') {
				
				
              $exist_info = $this->home_model->get_row('tblcities', array('name'=>$city,'state_id'=>$state_id), '');
			  if(!empty($exist_info)){
				  set_alert('warning', 'This City is Already Exist!');
                    redirect(admin_url('cities/city'));
					die;
			  }
				
				$ad_data = array(
							'name' => $city,     
							'state_id' => $state_id,                               
							'status' => $status,                
                            'added_by' => get_staff_user_id(),
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s'),
						);
						
				$insert = $this->home_model->insert('tblcities',$ad_data);	
				
				
                if ($insert) {
					set_alert('success', _l('added_successfully', 'city'));
                    redirect(admin_url('cities/city'));
						die;
                   
                }
                echo json_encode([
                    'url' => admin_url('expenses/expense'),
                ]);
                die;
				
            }else{
				
				$ad_data = array(
							'name' => $city,     
							'state_id' => $state_id,                               
							'status' => $status,
                            'updated_at' => date('Y-m-d H:i:s'),
						);
				$success = $this->home_model->update('tblcities',$ad_data,array('id'=>$id));			
								
				if ($success) {
					set_alert('success', _l('updated_successfully', 'city'));
					 redirect(admin_url('cities'));
					
				}
				
			}
			
           
            
        }
        if ($id == '') {
            $title = 'Add New City';
        }else {
            $data['city'] = $this->home_model->get_row('tblcities', array('id'=>$id), '');
           $title = 'Update City';
        }
        
        $data['bodyclass']  = 'Add City';
        $data['title']      = $title;
        $this->load->view('admin/cities/add_city', $data);
    }
	

  
}