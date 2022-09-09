<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Menu_master extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

    public function index()
    {
        if(!empty($_POST)){
            extract($this->input->post());

            $where = "status =  '1' ";

            if(!empty($parent_id)){
                $where .= " and parent_id = '".$parent_id."' ";
                $data['s_parent_id'] = $parent_id;
            }

            if(!empty($is_main)){
                $where .= " and is_main = '".$is_main."' ";
                $data['s_is_main'] = $is_main;
            }

            $data['menu_info']  = $this->db->query("SELECT * FROM tblmenumaster WHERE ".$where." order by order_no asc ")->result();
            
           
        }else{
             $data['menu_info']  = $this->db->query("SELECT * FROM tblmenumaster WHERE status =  '1' order by id desc ")->result();
        }

        
        $data['main_menu']  = $this->db->query("SELECT * FROM tblmenumaster WHERE parent_id = 0 and status = 1 ")->result();
       
        $data['title'] = 'Menu List';
        $this->load->view('admin/menu_master/manage', $data);

    }

    public function add($id="")
    {

        if(!empty($_POST)){
            extract($this->input->post());

            
            if(empty($is_main)){
                $is_main = 0;
            }

            if(empty($is_sub)){
                $is_sub = 0;
            }

            if(empty($parent_id)){
                $parent_id = 0;
            }

            if(empty($sub_id)){
                $sub_id = 0;
            }
        
            $ad_data = array(                            
                'parent_id' => $parent_id,
                'sub_id' => $sub_id,
                'name' => $name,
                'link' => $link,
                'icon' => $icon,
                'is_main' => $is_main,
                'is_sub' => $is_sub,
                'order_no' => $order_no,
                'status' => 1
            );
                    
            $insert = $this->home_model->insert('tblmenumaster', $ad_data);  

            if($insert){
            
                set_alert('success', 'New Menu added Successfully');
                redirect(admin_url('menu_master/add'));
            }
        }

        if(!empty($id)){
            $data['menu_info']  = $this->db->query("SELECT * FROM tblmenumaster WHERE id = '".$id."'")->row();
            $data['id'] = $id;
            $data['title'] = 'Edit Menu';
        }else{
            $data['title'] = 'Add Menu';
        }

        $data['main_menu']  = $this->db->query("SELECT * FROM tblmenumaster WHERE parent_id = 0 and status = 1 order by id desc")->result();
        $data['sub_menu']  = $this->db->query("SELECT * FROM tblmenumaster WHERE is_sub = 1 and status = 1 order by id desc")->result();
        
        $this->load->view('admin/menu_master/add', $data);

    }


    public function edit($id="")
    {


        if(!empty($_POST)){
            extract($this->input->post());


            if(empty($is_main)){
                $is_main = 0;
            }

            if(empty($is_sub)){
                $is_sub = 0;
            }

            if(empty($parent_id)){
                $parent_id = 0;
            }

            if(empty($sub_id)){
                $sub_id = 0;
            }
        
            $ad_data = array(                            
                'parent_id' => $parent_id,
                'sub_id' => $sub_id,
                'name' => $name,
                'link' => $link,
                'icon' => $icon,
                'is_main' => $is_main,
                'is_sub' => $is_sub,
                'order_no' => $order_no,
                'status' => 1
            );
                    
                    
            $update = $this->home_model->update('tblmenumaster', $ad_data,array('id'=>$id));  

            if($update){
            
                set_alert('success', 'Menu updated Successfully');
                redirect(admin_url('menu_master'));
            }
        }


    }




    public function delete($id)
    {
        
        $response = $this->home_model->delete('tblmenumaster', array('id'=>$id));
        if ($response == true) {
            set_alert('success', _l('deleted', 'menu'));
        } else {
            set_alert('warning', _l('problem_deleting', 'menu'));
        }
        redirect(admin_url('menu_master'));
    }

    public function assign($staffid = 0)
    {
        $data['staffid'] = $staffid;

        if(!empty($_POST)){
            extract($this->input->post());
            /*echo '<pre/>';
            print_r($_POST);
            die;*/
            
            if(!empty($mark)){

               $data['staffid']  = $staff_id;

            }else{

                $this->home_model->delete('tblmenuassigned', array('staff_id'=>$staff_id));

                foreach ($row as $id) {
                    $view = 0;
                    $create = 0;
                    $edit = 0;
                    $delete = 0;
                    if(!empty($_POST['view_'.$id])){
                        $view = 1;
                    }

                    if(!empty($_POST['create_'.$id])){
                        $create = 1;
                    }

                    if(!empty($_POST['edit_'.$id])){
                        $edit = 1;
                    }

                    if(!empty($_POST['delete_'.$id])){
                        $delete = 1;
                    }

                    if($view == 1 || $create == 1 || $edit == 1 || $delete == 1){

                        $ad_data = array(                            
                            'staff_id' => $staff_id,
                            'menu_id' => $id,
                            'view' => $view,
                            'create' => $create,
                            'edit' => $edit,
                            'delete' => $delete
                        );
                                
                        $insert = $this->home_model->insert('tblmenuassigned', $ad_data);

                    }


                }

                set_alert('success', 'Menu Alloted Successfully');
                redirect(admin_url('menu_master/assign/'.$staff_id));
            }      
                
        }

        $menu_data = array();

        /*$perent_menu  = $this->db->query("SELECT * FROM tblmenumaster WHERE is_main = 1 and status =  '1' order by order_no asc ")->result();
        foreach ($perent_menu as $r) {
            $child_menu  = $this->db->query("SELECT * FROM tblmenumaster WHERE parent_id = '".$r->id."' and sub_id = 0 and status =  '1' order by order_no asc ")->result();
            $menu_data[] = $r;

            if(!empty($child_menu)){
                foreach ($child_menu as $r1) {

                    if($r1->is_sub == 1){
                        $sub_child_menu  = $this->db->query("SELECT * FROM tblmenumaster WHERE sub_id = '".$r1->id."' and status =  '1' order by order_no asc ")->result();
                        if(!empty($sub_child_menu)){
                            foreach ($sub_child_menu as $r2) {
                                $menu_data[] = $r2;
                            }
                        }                        
                    }else{
                        $menu_data[] = $r1;
                    }
                    
                }
            }
        }*/


        $perent_menu  = $this->db->query("SELECT * FROM tblmenumaster WHERE is_main = 1 and status =  '1' order by order_no asc ")->result();
        foreach ($perent_menu as $r) {
            $menu_data[] = $r;
            $child_menu  = $this->db->query("SELECT * FROM tblmenumaster WHERE parent_id = '".$r->id."' and sub_id = 0 and status =  '1' order by order_no asc ")->result();
            if(!empty($child_menu)){
                foreach ($child_menu as $r1) {
                    if($r1->is_sub == 1){
                        $menu_data[] = $r1;
                        $sub_child_menu  = $this->db->query("SELECT * FROM tblmenumaster WHERE sub_id = '".$r1->id."' and status =  '1' order by order_no asc ")->result();
                        if(!empty($sub_child_menu)){
                            foreach ($sub_child_menu as $r2) {
                                $menu_data[] = $r2;
                            }
                        }
                    }else{
                      $menu_data[] = $r1;  
                    }
                }
            }
        }



        $data['menu_info'] = $menu_data;
        $data['staff_list'] = get_staff_list();
       
        $data['title'] = 'Assign Menu';
        $this->load->view('admin/menu_master/assign', $data);

    }

    public function get_sub_menu() {
        if ($this->input->post()) {
            extract($this->input->post());
            $sub_menu  = $this->db->query("SELECT * FROM tblmenumaster WHERE parent_id = '".$id."' and is_sub = 1 and status = 1 order by id desc")->result();
            $html = '<option value=""></option>';
            if(!empty($sub_menu)){
                $html .= '<option value="" selected>-- Select One --</option>';
                foreach ($sub_menu as $key => $value) {
                    $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
                }
            }
            echo $html;
        }
    }
    
    /* this is for assign designation */
    public function designation_assign($designation_id = 0)
    {
        $data['designation_id'] = $designation_id;

        if(!empty($_POST)){
            extract($this->input->post());
            /*echo '<pre/>';
            print_r($_POST);
            die;*/
            
            if(!empty($mark)){

               $data['designation_id']  = $designation_id;

            }else{

                $this->home_model->delete('tblmenuassigned', array('designation_id'=>$designation_id));

                foreach ($row as $id) {
                    $view = 0;
                    $create = 0;
                    $edit = 0;
                    $delete = 0;
                    if(!empty($_POST['view_'.$id])){
                        $view = 1;
                    }

                    if(!empty($_POST['create_'.$id])){
                        $create = 1;
                    }

                    if(!empty($_POST['edit_'.$id])){
                        $edit = 1;
                    }

                    if(!empty($_POST['delete_'.$id])){
                        $delete = 1;
                    }

                    if($view == 1 || $create == 1 || $edit == 1 || $delete == 1){

                        $ad_data = array(                            
                            'designation_id' => $designation_id,
                            'menu_id' => $id,
                            'view' => $view,
                            'create' => $create,
                            'edit' => $edit,
                            'delete' => $delete
                        );
                                
                        $insert = $this->home_model->insert('tblmenuassigned', $ad_data);

                    }


                }

                set_alert('success', 'Menu Alloted Successfully');
                redirect(admin_url('menu_master/designation_assign/'.$designation_id));
            }      
        }

        $menu_data = array();

        $perent_menu  = $this->db->query("SELECT * FROM tblmenumaster WHERE is_main = 1 and status =  '1' order by order_no asc ")->result();
        foreach ($perent_menu as $r) {
            $menu_data[] = $r;
            $child_menu  = $this->db->query("SELECT * FROM tblmenumaster WHERE parent_id = '".$r->id."' and sub_id = 0 and status =  '1' order by order_no asc ")->result();
            if(!empty($child_menu)){
                foreach ($child_menu as $r1) {
                    if($r1->is_sub == 1){
                        $menu_data[] = $r1;
                        $sub_child_menu  = $this->db->query("SELECT * FROM tblmenumaster WHERE sub_id = '".$r1->id."' and status =  '1' order by order_no asc ")->result();
                        if(!empty($sub_child_menu)){
                            foreach ($sub_child_menu as $r2) {
                                $menu_data[] = $r2;
                            }
                        }
                    }else{
                      $menu_data[] = $r1;  
                    }
                }
            }
        }

        $data['menu_info'] = $menu_data;
        $data['designation_list'] = $this->db->query("SELECT * FROM `tbldesignation` where status = 1 order by designation asc")->result();
       
        $data['title'] = 'Set Designation Menu';
        $this->load->view('admin/menu_master/designation_assign', $data);
    }
     
   
}
