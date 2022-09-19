<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
class Approval_API extends CRM_Controller
{
    public function __construct()
    {
        parent::__construct();   
		$this->load->model('home_model');

    }
   public function getNotificationList()
    {
        $return_arr = array();

        if(!empty($_GET)){
          extract($this->input->get());
        }
        elseif(!empty($_POST)){
          extract($this->input->post());  
        }

        if(!empty($user_id)){
          $where = " staff_id = '".$user_id."' ";

        if($status != ''){
          $where .= " and status = '".$status."' and approve_status = '".$status."' ";
        }else{
          $where .= " and status = 0 and approve_status = 0 ";  
        }

        if($module_id != ''){
          $where .= " and module_id = '".$module_id."'";
        }

        if(!empty($f_date) && !empty($t_date)){
              $f_date = str_replace("/","-",$f_date);
              $t_date = str_replace("/","-",$t_date);
              $from_date = date('Y-m-d',strtotime($f_date));           
              $to_date = date('Y-m-d',strtotime($t_date));
              $where .= " and date  BETWEEN  '".$from_date."' and  '".$to_date."' ";
         }

            $notification_list =  $this->db->query("SELECT * from tblmasterapproval where  ".$where." order by id desc ")->result();
           if(!empty($notification_list)){
              foreach ($notification_list as  $value) {
                 
                  if ($value->readdate != '') {
                        $readdate= _d($value->readdate);
                  }else{
                        $readdate='--';
                  }

                    $from_name = '--';
                    $profile_image = '';
                    if($value->fromuserid){
                    $from_name = get_employee_name($value->fromuserid);

                        $profile = $this->staff_model->get($value->fromuserid);
                        if(!empty($profile->profile_image)){
                            $profile_image = base_url('uploads/staff_profile_images/'.$value->fromuserid.'/'.$profile->profile_image);
                        }
                    }



                  $pdf_html = '';

                  $table_module_id = 'ID-'.$value->table_id;
                  if($value->module_id == 3){
                     $pdf_html =admin_url('purchase/download_pdf/').$value->table_id;                     
                  }

                  if($value->module_id == 3){
                      $table_module_id = 'PO-'.value_by_id('tblpurchaseorder',$value->table_id,'number');
                  }elseif($value->module_id == 4){
                      $table_module_id = 'MR-'.$value->table_id;
                  }

                  $head_info = getModuleHeadName($value->module_id, $value->table_id);

                      $data_arr[] = array(
                           'id' => $value->id,
                           'web_url' => $value->link,
                           'table_module_id' => $table_module_id,
                           'profile_image' => $profile_image,
                           'name' => $from_name,
                           'description' => $value->description,
                           'date_time' =>  _dt($value->date_time),
                           'date' =>  _d($value->date),
                           'updated_at' =>  _dt($value->updated_at),
                           'module_name' => value_by_id('tblcrmmodules',$value->module_id,'name'),
                           'isread' =>$value->isread,
                           'table_id' =>$value->table_id,
                           'module_id' =>$value->module_id,
                           'status' =>$value->approve_status,
                           'read_date'=>$readdate,
                           'pdf'=> $pdf_html,
                           'client_name'=> $head_info['name'],
                           'approved_by'=> $head_info['approved_by']
                     );
              }
                   $return_arr['status'] = true;
                   $return_arr['message'] = "Success";
                   $return_arr['data'] = $data_arr;
        }else{
              $return_arr['status'] = false;  
              $return_arr['message'] = "Record not found!";
              $return_arr['data'] = [];
         }
        }else{
            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are missing!";
            $return_arr['data'] = [];
        }
        
          
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($return_arr);
        //http://localhost/crm/Approval_API/getNotificationList?module_id=1&status=1&f_date=& t_date=
  }

  public function readNotification()
  {
        $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

       elseif(!empty($_POST)){
            extract($this->input->post());  
        }

       if(!empty($id) ){

              $ad_data = array(
                  'isread' => 1,
                  'readdate' => date('Y-m-d H:i:s')
              );
              $update = $this->home_model->update('tblmasterapproval', $ad_data,array('id'=>$id));

              $return_arr['status'] = true;
              $return_arr['message'] = "Record Updated Successfully!";
              $return_arr['data'] = [];
        }else{
            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are missing";
            $return_arr['data'] = [];
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($return_arr);
        //http://localhost/crm/Approval_API/readNotification?id=4
  }

  public function ApprovalStatus()
  {
        $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

       elseif(!empty($_POST)){
            extract($this->input->post());  
        }

       if(!empty($mr_id)  && !empty($status) && !empty($user_id)){

            if($remark==''){
                $remark='--'; 
              }else{
                $remark=$remark;
              }

              $ad_data = array(
                  'approve_status' => $status,
                  'remark' => $remark,
                  'updated_at' => date('Y-m-d H:i:s')
              );
              $update = $this->home_model->update('tblmaterialreceiptapproval', $ad_data,array('mr_id'=>$mr_id,'staff_id'=>$user_id));

              update_masterapproval_single($user_id,4,$mr_id,$status);

              $reject_info = $this->db->query("SELECT * FROM `tblmaterialreceiptapproval` where mr_id='".$mr_id."' and approve_status = 2 ")->row_array();

                   if(!empty($reject_info)){
                        update_masterapproval_all(4,$mr_id,2);
                        $this->home_model->update('tblmaterialreceipt', array('status'=>2),array('id'=>$mr_id));   
                    }

                    $approval_info = $this->db->query("SELECT * FROM `tblmaterialreceiptapproval` where mr_id='".$mr_id."' and ( approve_status = 0 || approve_status = 2 ) ")->row_array();

                    if(empty($approval_info)){
                        update_masterapproval_all(4,$mr_id,1);
                        $this->home_model->update('tblmaterialreceipt', array('status'=>1),array('id'=>$mr_id)); 
                     }

                    $return_arr['status'] = true;
                    $return_arr['message'] = "Action taken Successfully";
                    $return_arr['data'] = [];
        }else{
          $return_arr['status'] = false;  
          $return_arr['message'] = "Required Parameters are missing";
          $return_arr['data'] = [];
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($return_arr);
        //http://localhost/crm/Approval_API/ApprovalStatus?status=1&user_id=27&mr_id=43&remark=xyz
  }


  public function crmmodule_list()
  {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }
        elseif(!empty($_POST)){
            extract($this->input->post());  
        }

          if(empty($user_id)){
            $user_id = 0;
          }

          $crmmodules_info  = $this->db->query("SELECT * FROM tblcrmmodules WHERE  status = '1' ")->result();
          if(!empty($crmmodules_info)){
            
            foreach ($crmmodules_info as $value) {
              
                $module_count = getModulePendingCount($value->id, $user_id);
                $module_count = ($module_count > 0) ? ' ('.$module_count.')' : '';
                $arr[] = array(
                    'id' => $value->id,
                    'name' => $value->name.$module_count                  
                );
            }

            $return_arr['status'] = true;
            $return_arr['message'] = "Success";
            $return_arr['data'] = $arr;

          }else{
            $return_arr['status'] = false;  
            $return_arr['message'] = "Records Not found!";
            $return_arr['data'] = [];
          }
        
      header('Content-type: application/json');
      echo json_encode($return_arr);

        //http://schachengineers.com/schacrm/Approval_API/crmmodule_list
    }
}
