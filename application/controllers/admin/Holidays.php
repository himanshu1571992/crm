<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Holidays extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

    public function new_page()
    {
        $s_r = '';
        if(!empty($_POST)){
            extract($this->input->post());
           /* echo '<pre/>';
            print_r($_POST);
            die;*/
            $data['s_r'] = $range;
        }
        $data['title'] = 'Notification List';
        $this->load->view('admin/holidays/new_page', $data);

    }

    public function test_pdf()
    {
        require_once APPPATH.'third_party/pdfcrowd.php';


        $file_name = 'Challan PDF -';

        /*echo $html = test_pdf();
        die;*/


        $html = test_pdf();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Parameters
		$x          = 521;
		$y          = 820;
		$text       = "{PAGE_NUM} of {PAGE_COUNT}";
		$font       = $dompdf->getFontMetrics()->get_font('Helvetica', 'normal');
		$size       = 8;
		$color      = array(0,0,0);
		$word_space = 0.0;
		$char_space = 0.0;
		$angle      = 0.0;

		$dompdf->getCanvas()->page_text(
		  $x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle
		);
        //$dompdf->stream($file_name);
        $dompdf->stream($file_name, array("Attachment" => false));


    }

    public function index()
    {

        check_permission(111,'view');

        //check_permission(104,'view');
        if(!empty($_POST)){
            extract($this->input->post());

            $data['year'] = $year;

            $data['holiday_info']  = $this->db->query("SELECT * FROM tblholidays WHERE status =  '1' and year = '".$year."' order by date ASC ")->result();
        }else{
             $data['holiday_info']  = $this->db->query("SELECT * FROM tblholidays WHERE status =  '1' order by date ASC ")->result();
        }

        $data['title'] = 'Holiday List';
        $this->load->view('admin/holidays/manage', $data);
    }

    public function add($id="")
    {

        check_permission(111,'create');

        if(!empty($_POST)){
            extract($this->input->post());


            $date = str_replace("/","-",$date);
            $date = date("Y-m-d",strtotime($date));


            $ad_data = array(
                            'added_by' => get_staff_user_id(),
                            'title' => $title,
                            'year' => $year,
                            'date' => $date,
                            'description' => $description,
                            'religion_id' => $religion_id,
                            'created_at' => date('Y-m-d H:i:s'),
                            'status' => 1
                        );
            $insert = $this->home_model->insert('tblholidays', $ad_data);

            if($insert){

                set_alert('success', 'Holiday added Successfully');
                redirect(admin_url('holidays'));
            }
        }

        if(!empty($id)){
            $data['holiday_info']  = $this->db->query("SELECT * FROM tblholidays WHERE id = '".$id."'")->row();
            $data['id'] = $id;
            $data['title'] = 'Edit Holiday';
        }else{
            $data['title'] = 'Add Holiday';
        }

        $data['religion_list']  = $this->db->query("SELECT * FROM tblreligion WHERE status = '1' order by name asc")->result();
        $this->load->view('admin/holidays/add', $data);
    }


    public function edit($id="")
    {
        check_permission(111,'edit');
        if(!empty($_POST)){
            extract($this->input->post());


            $date = str_replace("/","-",$date);
            $date = date("Y-m-d",strtotime($date));



            $ad_data = array(
                            'title' => $title,
                            'year' => $year,
                            'date' => $date,
                            'description' => $description,
                            'religion_id' => $religion_id,
                            'created_at' => date('Y-m-d H:i:s'),
                            'status' => 1
                        );


            $update = $this->home_model->update('tblholidays', $ad_data,array('id'=>$id));

            if($update){

                set_alert('success', 'Holiday updated Successfully');
                redirect(admin_url('holidays'));
            }
        }
    }

    public function delete($id)
    {
        check_permission(111,'delete');

        $response = $this->home_model->delete('tblholidays', array('id'=>$id));
        if ($response == true) {
            set_alert('success', _l('deleted', 'holiday'));
        } else {
            set_alert('warning', _l('problem_deleting', 'holiday'));
        }
        redirect(admin_url('holidays'));
    }

    public function setholidaydate()
    {
        if(!empty($_POST)){
            extract($this->input->post());

            $holidayinfo = $this->db->query("SELECT * FROM `tblholidays` WHERE `id` = '".$holiday_id."' ")->row();
            if (!empty($holidayinfo)){
                $ad_data = array(
                                'title' => $holidayinfo->title,
                                'year' => $year,
                                'date' => db_date($date),
                                'description' => $holidayinfo->description,
                                'religion_id' => $holidayinfo->religion_id,
                                'created_at' => date('Y-m-d H:i:s'),
                                'status' => 1
                            );
                $insert = $this->home_model->insert('tblholidays', $ad_data);
                if($insert){
                    $this->home_model->update("tblholidays", array("status"=>0), array("id" => $holiday_id));
                    set_alert('success', 'Holiday added Successfully');
                    redirect(admin_url('holidays'));
                }
            }else{
              set_alert('warning', 'Something went wrong.');
              redirect(admin_url('holidays'));
            }
        }
    }

}
