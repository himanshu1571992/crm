<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Store_model extends CRM_Model {

    
    public function __construct() {
        parent::__construct();
    }

	/* this is for product stock log opening amount */
	function getProductlogOpeningAmt($date, $product_id, $warehouse_id){
		
		$opening_amt = $this->db->query("SELECT COALESCE(SUM(total_qty),0) as ttl_qty FROM `tblproduct_store_log` WHERE date = '".$date."' and pro_id = '".$product_id."' and main_store = 1 and warehouse_id = '".$warehouse_id."' and ref_type = 'add_stock'")->row()->ttl_qty;
		return $opening_amt;
	}

	/* this is for product stock log warding amount */
	function getProductlogWardingAmt($date, $product_id, $warehouse_id){
		
		$warding_amt = 0;
		$productlog = $this->db->query("SELECT total_qty,main_store_rejected_qty FROM `tblproduct_store_log` WHERE date = '".$date."' and pro_id = '".$product_id."' and main_store = 1 and warehouse_id = '".$warehouse_id."' and (ref_type = 'material_receipt' || ref_type = 'store_transfer')")->result();
		if (!empty($productlog)){
			foreach ($productlog as $key => $value) {
				$warding_amt += $value->total_qty + $value->main_store_rejected_qty;
			}
		}
		return $warding_amt;
	}

	/* this is for product stock log issued qty amount */
	function getProductlogIssuedqtyAmt($date, $product_id, $warehouse_id){
		
		$issuedqty_amt = $this->db->query("SELECT COALESCE(SUM(total_qty),0) as ttl_qty FROM `tblproduct_store_log` WHERE main_store = 1 and material_status = 0 and ref_type = 'store_issue' and warehouse_id = '".$warehouse_id."' and (shop_floor_store = 1 || finish_goods_store = 1 || consumable_store = 1) and date = '".$date."' and pro_id = '".$product_id."'")->row()->ttl_qty;
		return $issuedqty_amt;
	}

	/* this is for product stock log issued qty amount */
	function getProductlogRejectAmt($date, $product_id, $warehouse_id){
		
		$rejectedqty_amt = $this->db->query("SELECT COALESCE(SUM(main_store_rejected_qty),0) as ttl_qty FROM `tblproduct_store_log` WHERE main_store_rejected_qty > 0 and main_store = 1 and ref_type = 'material_receipt' and warehouse_id = '".$warehouse_id."' and date = '".$date."' and pro_id = '".$product_id."'")->row()->ttl_qty;
		return $rejectedqty_amt;
	}

	/* this is for product stock log outward amount */
	function getProductlogOutwardAmt($date, $product_id, $warehouse_id){
		
		$storetransfer_amt = $this->db->query("SELECT COALESCE(SUM(l.total_qty),0) as ttl_qty FROM `tblstore_transfer` as t LEFT JOIN tblproduct_store_log as l ON t.id = l.ref_id WHERE l.ref_type = 'store_transfer' and l.pro_id = '".$product_id."' and l.date = '".$date."' and t.from_warehouse = '".$warehouse_id."' and t.store_id = 1 and t.status = 1")->row()->ttl_qty;
		$jobwork_amt = $this->db->query("SELECT COALESCE(SUM(total_qty),0) as ttl_qty FROM `tblproduct_store_log` WHERE date = '".$date."' and pro_id = '".$product_id."' and main_store = 1 and warehouse_id = '".$warehouse_id."' and job_work_store = 1 and ref_type = 'job_work'")->row()->ttl_qty;
		return $storetransfer_amt + $jobwork_amt;
	}

	/* this is for get Bin card Opening Amount function which is return according to service type sales or rent */
	public function getBincardOpeningAmt($date, $product_id, $warehouse_id, $service_type){
		$opening_qty = $this->db->query("SELECT COALESCE(SUM(total_qty),0) as ttl_qty FROM `tblproduct_store_log` WHERE date = '".$date."' and pro_id = '".$product_id."' and finish_goods_store = 1 and warehouse_id = '".$warehouse_id."' and service_type = '".$service_type."'  and ref_type = 'store_issue' ORDER BY `id` ASC")->row()->ttl_qty;
		return $opening_qty;
	}

	/* this is for get Bin card issue qty function which is return according to service type sales or rent */
	public function getBincardIssuedqtyAmt($date, $product_id, $warehouse_id, $service_type){
		$issueqty_qty = $this->db->query("SELECT COALESCE(SUM(l.total_qty),0) as ttl_qty FROM `tblstore_transfer` as t LEFT JOIN tblproduct_store_log as l ON t.id = l.ref_id WHERE l.ref_type = 'store_transfer' and l.service_type = '".$service_type."' and l.pro_id = '".$product_id."' and l.date = '".$date."' and t.from_warehouse = '".$warehouse_id."' and t.store_id = 3 and t.status = 1")->row()->ttl_qty;
		return $issueqty_qty;
	}

	/* this is for get Bin card rejected qty function which is return according to service type sales or rent */
	public function getBincardRejectAmt($date, $product_id, $warehouse_id, $service_type){
		$rejected_qty = $this->db->query("SELECT COALESCE(SUM(total_qty),0) as ttl_qty FROM `tblproduct_store_log` WHERE scrap_store = 1 and material_status = 2 and finish_goods_store = 1 and ref_type = 'finished_goods_verify' and warehouse_id = '".$warehouse_id."' and service_type = '".$service_type."' and date = '".$date."' and pro_id = '".$product_id."'")->row()->ttl_qty;
		return $rejected_qty;
	}

	/* this is for get Bin card outward qty function which is return according to service type sales or rent */
	public function getBincardOutwardAmt($date, $product_id, $warehouse_id, $service_type){
		$outward_qty = $this->db->query("SELECT COALESCE(SUM(total_qty),0) as ttl_qty FROM `tblproduct_store_log` WHERE  material_status = 1 and outward_store = 1 and finish_goods_store = 1 and ref_type = 'challan_created' and warehouse_id = '".$warehouse_id."' and service_type = '".$service_type."' and date = '".$date."' and pro_id = '".$product_id."'")->row()->ttl_qty;
		return $outward_qty;
	}
}
