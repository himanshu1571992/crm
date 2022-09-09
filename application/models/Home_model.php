<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model
{

    public function insert($table_name = '', $data = '')
    {

        $query = $this->db->insert($table_name, $data);

       if ($query) return $this->db->insert_id();
		/*if($query->num_rows == 1)
        {
			$this->load->view('print_receipt');
		}*/

        else return FALSE;

    }
    

    public function get_row($table_name = '', $id_array = '', $columns = array())
    {

        if (!empty($columns)):

            $all_columns = implode(",", $columns);

            $this->db->select($all_columns);

        endif;

        if (!empty($id_array)):

            foreach ($id_array as $key => $value) {

                $this->db->where($key, $value);

            }

        endif;

        $query = $this->db->get($table_name);

        if ($query->num_rows() > 0) return $query->row();

        else return FALSE;

    }



    public function update($table_name = '', $data = '', $id_array = '')
    {

        if (!empty($id_array)):

            foreach ($id_array as $key => $value) {

                $this->db->where($key, $value);

            }

        endif;

        return $this->db->update($table_name, $data);

    }



    public function delete($table_name = '', $id_array = ''){

        return $this->db->delete($table_name, $id_array);

    }


    public function collections($offset='',$per_page=''){   

        $this->db->from('collections');

        if($offset >= 0 && $per_page > 0) {

            $this->db->limit($per_page, $offset);

            $this->db->order_by('id','desc');

            $query = $this->db->get();

            if ($query->num_rows() > 0)

                return $query->result();

            else

                return FALSE;

        }else {

            return $this->db->count_all_results();

        }

    }

	//Common Get Numrows Starts Here
 	public function custom_where_search($table, $where, $numrow)
	{
		if(isset($where) && ($where != ''))
		{	
		$this->db->where($where);
		}
		
        $this->db->from($table);
        $query = $this->db->get();

        //$rs = $this->db->last_query();
		if(isset($numrow) && ($numrow == 1))
		{
			return $query->num_rows();	
		}else
		{
			if($query->num_rows > 0)
			{ 
				return $query->result_array();
			}
			else
			{
				return 0;	
			}
			
		}
		
	}


	 public function get_result($table_name = '', $id_array = '', $columns = array(),$order_by = array())
    {
        if (!empty($columns)):
            $all_columns = implode(",", $columns);
            $this->db->select($all_columns);
        endif;
        if (!empty($id_array)):
            foreach ($id_array as $key => $value) {
                $this->db->where($key, $value);
            }
        endif;
        if (!empty($order_by)):
            $this->db->order_by($order_by[0], $order_by[1]);
        endif;
        $query = $this->db->get($table_name);
        if ($query->num_rows() > 0) return $query->result();
        else return FALSE;
    }
	
	public function get_designation($table_name = '', $id_array = '', $columns = array(),$order_by = array())
    {
   if (!empty($columns)):
            $all_columns = implode(",", $columns);
            $this->db->select($all_columns);
        endif;
        if (!empty($id_array)):
            
                $this->db->where_in('id',$id_array);
           
        endif;
        if (!empty($order_by)):
            $this->db->order_by($order_by[0], $order_by[1]);
        endif;
        $query = $this->db->get($table_name);
        if ($query->num_rows() > 0) return $query->result();
        else return FALSE;
    }



    public function get_challan($where,$start_from,$limit)
    {

         return $this->db->query("SELECT * from `tblchalanmst` where ".$where." ORDER BY id desc LIMIT ".$start_from.",".$limit." ")->result();
    }

    public function get_challan_count($where)
    {

         return $this->db->query("SELECT count(id) as `ttl_count` from `tblchalanmst` where ".$where."  ")->row()->ttl_count;
    }

    public function get_extrusion_stock($where,$start_from,$limit)
    {

         return $this->db->query("SELECT * from `tblmanufacturestock` where ".$where." ORDER BY id desc LIMIT ".$start_from.",".$limit." ")->result();
    }

    public function get_extrusion_stock_count($where)
    {

         return $this->db->query("SELECT count(id) as `ttl_count` from `tblmanufacturestock` where ".$where."  ")->row()->ttl_count;
    }


    public function get_running_clients($client_ids,$status)
    { 
          $i=0;    

          $running_clinets = $this->db->query("SELECT `client_status`,`credit_limit`,`userid` from `tblclientbranch` where userid IN (".$client_ids.") and client_status = '".$status."' ")->result();

          if(!empty($running_clinets)){
            foreach ($running_clinets as $row) { 
             
                $bal_amt = client_balance_amt($row->userid,1);

                  if($row->credit_limit == 0 || $bal_amt <= $row->credit_limit ){

                    if($bal_amt > 1){
                        $i++;  
                      
                  }
              }
            }  
          }          
           
      return $i;
    }

    public function get_closed_clients($client_ids,$status)
    { 
          $i=0;    

          $closed_clinets = $this->db->query("SELECT `client_status`,`credit_limit`,`userid` from `tblclientbranch` where userid NOT IN (".$client_ids.") and client_status = '".$status."' ")->result();

          if(!empty($closed_clinets)){
            foreach ($closed_clinets as $row) { 
             
                $bal_amt = client_balance_amt($row->userid,1);

                  if($row->credit_limit == 0 || $bal_amt <= $row->credit_limit ){

                    if($bal_amt > 1){
                         $i++;   
                      
                  }
              }
            }  
          }          
           
      return $i;
    }

    public function get_sales_clients($client_ids,$status)
    { 
          $i=0;   
          $sales_clinets = $this->db->query("SELECT `client_status`,`credit_limit`,`userid` from `tblclientbranch` where userid IN (".$client_ids.") and client_status = '".$status."' ")->result();

          if(!empty($sales_clinets)){
            foreach ($sales_clinets as $row) { 
             
                $bal_amt = client_balance_amt($row->userid,1);

                  if($row->credit_limit == 0 || $bal_amt <= $row->credit_limit ){

                    if($bal_amt > 1){
                        $i++; 
                      
                  }
              }
            }  
          }          
           
      return $i;
    }
  
}