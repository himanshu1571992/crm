<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Products_list_model extends CRM_Model {

    private $table_name = "tblproducts";
    var $column_order = array(null, 'name','id','unit_2','product_cat_id','photo','status','is_varified','created_at'); //set column field database for datatable orderable
    var $column_search = array('name','id','unit_2','product_cat_id','photo','status','is_varified','created_at'); //set column field database for datatable searchable 
    var $order = array('id' => 'desc'); // default order 

    public function __construct() {
        parent::__construct();
    }
    
    private function _get_query()
    {
        //add custom filter here
        $this->db->where('status', 1);
        if(!empty($this->input->post('product_cat_id')))
        {
            $this->db->where('product_cat_id', $this->input->post('product_cat_id'));
        }
        if(!empty($this->input->post('product_sub_cat_id')))
        {
            $this->db->where('product_sub_cat_id', $this->input->post('product_sub_cat_id'));
        }
        if(!empty($this->input->post('parent_category_id')))
        {
            $this->db->where('parent_category_id', $this->input->post('parent_category_id'));
        }
        if(!empty($this->input->post('child_category_id')))
        {
            $this->db->where('child_category_id', $this->input->post('child_category_id'));
        }
        if($this->input->post('is_varified') != '' && strlen($this->input->post('is_varified')) > 0)
        {
            $this->db->where('is_varified', $this->input->post('is_varified'));
            $this->db->where('is_approved', 1);
        }
        if(!empty($this->input->post('pro_id')))
        {
            $this->db->where('id', $this->input->post('pro_id'));
        }
        if(!empty($this->input->post('product_name')))
        {
            $this->db->like('name', $this->input->post('product_name'));
        }
        $this->db->from($this->table_name);
        $i = 0;
        foreach ($this->column_search as $item) // loop column 
        {
            if(!empty($_POST['search']) && $_POST['search']['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
        
    }

    function get_products()
    {
        /* START GET PRODUCTS CODE */
        $this->_get_query();
        if($_POST['length'] != -1){
            $this->db->limit($_POST['length'], $_POST['start']);
        }    
        $query = $this->db->get();
        $result = $query->result();
        /* END GET PRODUCTS CODE */

        /* START PRODUCT LIST ARRAY */
        $data = array();
        $no = $_POST['start'];
        foreach ($result as $product) {

            $img_url = base_url('assets/images/no_image_available.jpeg');
            if($product->photo != "" && $product->photo != "--") {
                $img_url = base_url('uploads/product') . "/" . $product->photo;
            }
            $checked = ($product->status == 1 ) ? 'checked' : '';
            $toggleActive = '<div class="onoffswitch">
                                <input type="checkbox" data-switch-url="' . admin_url() . 'product_new/change_product_status" name="onoffswitch" class="onoffswitch-checkbox" id="' . $product->id . '" data-id="' . $product->id . '" ' . $checked . '>
                                <label class="onoffswitch-label" for="' . $product->id . '"></label>
                            </div>';

            if($product->is_varified == 1){
                $is_varified = '<button disabled="" class="btn-sm btn-success">Verified</button>';
            }else{
                $is_varified = '<button disabled="" class="btn-sm btn-danger">Pending</button>';
            }
            
            $url = admin_url('product_new/product/' . $product->id);
            $viewurl = admin_url('product_new/view/' . $product->id);
            $detail_url = admin_url('product_new/product_used/' . $product->id);
            $inspection_url = admin_url('product_new/product_inspection/' . $product->id);

            $name_html = '<a href="' . $url . '">' . cc($product->sub_name) . '</a>';
            $name_html .= '<div class="row-options">';
            $name_html .= '<a target="_blank" href="' . $viewurl . '">' . _l('view') . '</a>';
            $name_html .= ' | <a target="_blank" href="' . $detail_url . '">Details</a>';
            if(check_permission_page(2,'delete') ){
                $name_html .= ' | <a href="' . admin_url('product_new/delete/' . $product->id) . '" class="text-danger _delete">' . _l('delete') . '</a>';
            }
            $name_html .= ' | <a target="_blank" href="' . $inspection_url . '">Inspection Details</a>';
            $name_html .= '</div>';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $name_html;
            $row[] = "PRO-" .number_series($product->id);
            $row[] = cc(value_by_id('tblunitmaster',$product->unit_2,'name'));
            $row[] = cc(value_by_id('tblproductcategory',$product->product_cat_id,'name'));
            $row[] = $is_varified;
            $row[] = _d($product->created_at);
            $row[] = '<img src="' . $img_url . '" class="image-responsive" style="height: 100px; width : 100px;" alt="' . cc($product->name) . '" />';
            $row[] = $toggleActive;
 
            $data[] = $row;
        }
        /* END PRODUCT LIST ARRAY */

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->count_all(),
                        "recordsFiltered" => $this->count_filtered(),
                        "data" => $data,
                );
        return $output;        
    }
 
    /* this function use for count filter data */
    function count_filtered()
    {
        $this->_get_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    /* this function use for count all products */
    public function count_all()
    {
        $this->db->where('status', 1);
        $this->db->from($this->table_name);
        return $this->db->count_all_results();
    }

    /* this function use for verified count filter data */
    function verified_count()
    {
        $where = array('is_varified' => 1, 'is_approved' => 1, 'status' => 1);
        $this->db->where($where);
        $this->_get_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    /* this function use for unverified count filter data */
    function unverified_count()
    {
        $where = array('is_varified' => 0, 'is_approved' => 1, 'status' => 1);
        $this->db->where($where);
        $this->_get_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
}
